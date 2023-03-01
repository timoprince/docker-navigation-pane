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
}