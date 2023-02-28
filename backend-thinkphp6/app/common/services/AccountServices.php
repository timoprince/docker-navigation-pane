<?php

namespace app\common\services;

use app\common\dao\AccountDao;

class AccountServices extends BaseServices
{
    public function __construct(AccountDao $dao)
    {
        $this->dao = $dao;
    }

    /**
     * 检查账号是否存在
     * @param string $account 账号
     * @return bool
     */
    public function hasAccount(string $account): bool
    {
        return $this->dao->hasAccount($account);
    }

    /**
     * 检查密码是否正确
     * @param string $account 账号
     * @param string $password 密码
     * @return bool
     */
    public function checkPassword(string $account, string $password): bool
    {
        return $this->dao->checkPassword($account, $password);
    }

    /**
     * 获取用户信息
     * @param string $account 账号
     * @param array $hidden 隐藏字段，默认密码字段隐藏
     * @return array|null
     */
    public function getInfoByAccount(string $account, array $hidden = ["password"]): ?array
    {
        return $this->dao->getInfoByAccount($account, $hidden);
    }
}