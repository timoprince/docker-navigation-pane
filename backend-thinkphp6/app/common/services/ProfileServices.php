<?php

namespace app\common\services;

use app\common\dao\ProfileDao;

class ProfileServices extends BaseServices
{
    public function __construct(ProfileDao $dao)
    {
        $this->dao = $dao;
    }

    /**
     * 获取当前登录用户信息
     * @param int $id 当前登录用户id
     * @return array|null
     */
    public function getInfo(int $id): ?array
    {
        return $this->dao->getRow($id);
    }

    /**
     * 更新用户信息
     * @param int $id 当前登录用户id
     * @param array $data 更新的数据
     * @return void
     */
    public function updateInfo(int $id, array $data)
    {
        $allowField = ["name", "avatar"];

        // 如果期望更新密码，则处理密码后保存
        if (isset($data["password"]) && !empty($data["password"])) {
            $data["password"] = password_hash($data["password"], PASSWORD_DEFAULT);
            $allowField[] = "password";
        }

        $this->dao->updateRow($id, $data, $allowField);
    }
}