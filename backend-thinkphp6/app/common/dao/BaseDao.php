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
     * 通过id查询信息
     * @param int $id id
     * @return array|null
     */
    public function getInfoById(int $id): ?array
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
     * 通过id更新信息
     * @param int $id id
     * @param array $field 新信息
     * @param array $allowField 允许字段，留空则所有字段
     * @return void
     */
    public function updateInfoById(int $id, array $field, array $allowField = [])
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

        // 如果 $allowField 没有值，则默认更新全部传入表单字段
        if (count($allowField) === 0) {
            foreach ($field as $key => $value) {
                $allowField[] = $key;
            }
        }

        $this->getModel()->update($field, ["id" => $id], $allowField);
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
            $model = $this->getModel();

            if (count($hiddenField) > 0) $model = $model->hidden($hiddenField);

            foreach ($whereList as $where) {
                $type = $where[0];
                $args = $where[1];

                switch ($type) {
                    case "where":
                        $model = $model->where(...$args);
                        break;
                    case "whereOr":
                        $model = $model->whereOr(...$args);
                        break;
                    case "whereBetween":
                        $model = $model->whereBetween(...$args);
                        break;
                }
            }

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
}