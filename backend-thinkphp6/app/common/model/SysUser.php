<?php

namespace app\common\model;

use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;

class SysUser extends CurdModel
{
    protected $hidden = ["password"];

    public function hasAccount(string $account): bool
    {
        $row = $this->getInfoByAccount($account);
        return !empty($row);
    }

    public function checkPassword(string $account, string $password): bool
    {

        $row = $this->getInfoByAccount($account, []);
        if (empty($row)) return false;
        return password_verify($password, $row["password"]);
    }

    public function getInfoByAccount(string $account, array $hidden = ["password"]): ?array
    {
        try {
            $row = $this->where(["account" => $account])->find();
            if (empty($row)) return null;
            return $row->hidden($hidden)->toArray();
        } catch (DataNotFoundException|ModelNotFoundException|DbException $e) {
            return null;
        }
    }
}