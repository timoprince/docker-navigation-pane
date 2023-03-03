<?php

namespace app\common\dao;

use app\common\model\BaseModel;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;

abstract class BaseDao
{

    public $model;

    /**
     * 清洗表单数据
     * @param array $field 表单数据
     * @return array
     */
    public function clearField(array $field): array
    {
        $ignoreField = ["id", "create_time", "update_time", "delete_time"];
        // 数据处理
        foreach ($field as $key => $value) {
            // 移除不需要录入的字段
            if (in_array($key, $ignoreField)) {
                unset($field[$key]);
            }
            // 去除字符串数据头尾空格
            if (is_string($value) && !empty($value)) {
                $value = trim($value);
                $field[$key] = $value;
            }
        }
        return $field;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model): void
    {
        $this->model = $model;
    }

    /**
     * 获取模型
     * @return BaseModel
     */
    public function getModel(): BaseModel
    {
        return app()->make($this->model);
    }

    /**
     * 通过id查询行信息
     * @param int $id id
     * @return array|null
     */
    public function getRow(int $id): ?array
    {
        try {
            $row = $this->getModel()->where(["id" => $id])->find();
            if (empty($row)) return null;
            return $row->toArray();
        } catch (DataNotFoundException|ModelNotFoundException|DbException $e) {
            return null;
        }
    }

    /**
     * 创建一条新数据
     * @param array $field 表单数据
     * @param array $allowField 允许字段，留空则所有字段
     * @return void
     */
    public function createRow(array $field, array $allowField = [])
    {
        // 数据处理
        $field = $this->clearField($field);

        if (count($allowField) == 0) {
            foreach ($field as $key => $value) {
                $allowField[] = $key;
            }
        }

        $this->getModel()->allowField($allowField)->save($field);
    }

    /**
     * 通过id更新行信息
     * @param int $id id
     * @param array $field 新信息
     * @param array $allowField 允许字段，留空则所有字段
     * @return void
     */
    public function updateRow(int $id, array $field, array $allowField = [])
    {
        $this->updateRowByWhere($field, ["id" => $id], $allowField);
    }

    /**
     * 根据过滤条件更新行数据
     * @param array $field 新信息
     * @param array $whereList 过滤条件
     * @param array $allowField 允许字段，留空则所有字段
     * @return void
     */
    public function updateRowByWhere(array $field, array $whereList = [], array $allowField = [])
    {
        // 数据处理
        $field = $this->clearField($field);

        // 如果 $allowField 没有值，则默认更新全部传入表单字段
        if (count($allowField) === 0) {
            foreach ($field as $key => $value) {
                $allowField[] = $key;
            }
        }

        $this->getModel()->update($field, $whereList, $allowField);
    }

    /**
     * 删除行
     * @param int $id 行id
     * @param bool $force 是否真实删除
     * @return string
     */
    public function removeRow(int $id, bool $force = false): string
    {
        try {
            $find = $this->getModel()->where(["id" => $id])->find();
            if (empty($find)) return "删除数据失败！没有找到对应记录！";
            $find->force($force)->delete();
            return "";
        } catch (DataNotFoundException|ModelNotFoundException|DbException $e) {
            return $e->getMessage();
        }
    }

    /**
     * 查询全部数据
     * @return void
     */
    public function queryList(array $whereList = [], array $hiddenField = []): array
    {
        try {
            return $this->getBaseModel($whereList, $hiddenField)->select();
        } catch (DbException $e) {
            return [];
        }
    }

    /**
     * 分页查询数据列表
     * @param int $page_size 每页条数
     * @param int $page_num 当前页码
     * @param array $whereList 查询条件
     * @param array $hiddenField 隐藏字段
     * @return array
     */
    public function queryListByPage(int $page_size = 10, int $page_num = 1, array $whereList = [], array $hiddenField = []): array
    {
        try {
            $model = $this->getBaseModel($whereList, $hiddenField);

            $result = $model->paginate(["list_rows" => $page_size, "page" => $page_num]);

            return [
                "total" => $result->total(),
                "page_size" => $result->listRows(),
                "page_num" => $result->currentPage(),
                "data" => $result->items()
            ];

        } catch (DbException $e) {
            return [
                "total" => 0,
                "data" => [],
                "page_size" => $page_size,
                "page_num" => $page_num
            ];
        }
    }

    /**
     * 获取基础过滤模型数据
     * @param array $whereList 查询条件
     * @param array $hiddenField 隐藏字段
     */
    public function getBaseModel(array $whereList, array $hiddenField)
    {
        $model = $this->getModel();

        foreach ($whereList as $where) {
            $type = $where[0];
            $args = $where[1];

            switch ($type) {
                case "where":
                    $model = $model->where($args);
                    break;
                case "whereOr":
                    $model = $model->whereOr($args);
                    break;
                case "whereBetweenTime":
                    if (count($args) === 3) $model = $model->whereBetweenTime($args[0], $args[1], $args[2]);
                    break;
                case "whereLike":
                    if (count($args) == 2) $model = $model->whereLike($args[0], $args[1]);
                    break;
            }
        }

        if (count($hiddenField) > 0) $model = $model->hidden($hiddenField);

        return $model;
    }

}