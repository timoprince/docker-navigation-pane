<?php

namespace app\common\services;

use app\common\dao\SysUserDao;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;

class SysUserServices extends BaseServices
{
    public function __construct(SysUserDao $dao)
    {
        $this->dao = $dao;
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
        $account = $field["account"];
        try {
            $find = $this->dao->getModel()->withTrashed()->where(["account" => $account])->find();
            if (!empty($find)) return "该账号已存在，不可重复创建！";

            // 默认密码123456
            if (empty($field["password"])) $field["password"] = "123456";
            $field["password"] = password_hash($field["password"], PASSWORD_DEFAULT);

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
            if (isset($field["account"])) {
                $account = $field["account"];
                $find = $this->dao->getModel()->withTrashed()->where(["account" => $account])->find();
                if (!empty($find) && $find["id"] !== $id) return "该账号已被占用，不可重复使用！";
            }

            // 如果包含密码更新，则自动处理新密码并入库
            if (isset($field["password"]) && !empty($field["password"])) {
                $field["password"] = password_hash($field["password"], PASSWORD_DEFAULT);
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