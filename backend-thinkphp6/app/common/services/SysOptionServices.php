<?php

namespace app\common\services;

use app\common\dao\SysOptionDao;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;

class SysOptionServices extends BaseServices
{
    public function __construct(SysOptionDao $dao)
    {
        $this->dao = $dao;
    }

    /**
     * 查询配置列表
     * @param array $whereList 查询条件
     * @return array|null
     */
    public function queryList(array $whereList = []): ?array
    {
        return $this->dao->queryList($whereList);
    }

    /**
     * 分页查询数据列表
     * @param int $page_size 每页条数
     * @param int $page_num 当前页码
     * @param array $whereList 查询条件
     * @return array
     */
    public function queryListByPage(int $page_size = 10, int $page_num = 1, array $whereList = []): array
    {
        return $this->dao->queryListByPage($page_size, $page_num, $whereList, ["password"]);
    }

    /**
     * 创建行数据
     * @param array $field 表单数据
     * @return string
     */
    public function createRow(array $field): ?string
    {
        try {
            $name = $field["name"];

            $find = $this->dao->getModel()->withTrashed()->where(["name" => $name])->find();
            if (!empty($find)) return "该名称已存在，不可重复使用！";

            // 创建行数据
            $this->dao->createRow($field);

            return null;
        } catch (DataNotFoundException|ModelNotFoundException|DbException $e) {
            return $e->getMessage();
        }

    }

    /**
     * 更新行数据
     * @param int $id 行数据id
     * @param array $field 表单数据
     * @return string
     */
    public function updateRow(int $id, array $field): ?string
    {
        try {
            // 如果包含账号更新，则检查账号是否可以被更新
            if (isset($field["name"])) {
                $name = $field["name"];
                $find = $this->dao->getModel()->withTrashed()->where(["name" => $name])->find();
                if (!empty($find) && $find["id"] !== $id) return "该名称已被占用，不可重复使用！";
            }

            // 创建行数据
            $this->dao->updateRow($id, $field);

            return null;
        } catch (DataNotFoundException|ModelNotFoundException|DbException $e) {
            return $e->getMessage();
        }
    }

    /**
     * 删除行数据
     * @param int $id 行id
     * @return string
     */
    public function deleteRow(int $id): string
    {
        return $this->dao->removeRow($id);
    }
}