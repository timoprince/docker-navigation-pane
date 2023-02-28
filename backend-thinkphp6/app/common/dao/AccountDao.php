<?php

namespace app\common\dao;

use app\common\model\SysUser;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;

class AccountDao extends BaseDao
{
    public function __construct()
    {
        $this->setModel(SysUser::class);
    }

    /**
     * 检查账号是否存在
     * @param string $account 账号
     * @return bool
     */
    public function hasAccount(string $account): bool
    {
        $row = $this->getInfoByAccount($account);
        return !empty($row);
    }

    /**
     * 检查密码是否正确
     * @param string $account 账号
     * @param string $password 密码
     * @return bool
     */
    public function checkPassword(string $account, string $password): bool
    {
        $row = $this->getInfoByAccount($account, []);
        if (empty($row)) return false;
        return password_verify($password, $row["password"]);
    }

    /**
     * 获取用户信息
     * @param string $account 账号
     * @param array $hidden 隐藏字段，默认密码字段隐藏
     * @return array|null
     */
    public function getInfoByAccount(string $account, array $hidden = ["password"]): ?array
    {
        try {
            $row = $this->getModel()->where(["account" => $account])->find();
            if (empty($row)) return null;
            return $row->hidden($hidden)->toArray();
        } catch (DataNotFoundException|ModelNotFoundException|DbException $e) {
            return null;
        }
    }
}