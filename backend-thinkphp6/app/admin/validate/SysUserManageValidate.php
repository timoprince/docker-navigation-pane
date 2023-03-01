<?php

namespace app\admin\validate;

use think\Validate;

class SysUserManageValidate extends Validate
{
    protected $rule = [
        "id|ID" => "integer",
        "account|账号" => "length:1,16",
        "password|密码" => "length:32",
        "name|昵称" => "length:1,16",
    ];

    public function sceneCreate(): SysUserManageValidate
    {
        return $this->only(["account", "password"])->append("account", "require")->append("password", "require");
    }

    public function sceneUpdate(): SysUserManageValidate
    {
        return $this->append("id", "require");
    }

    public function sceneDelete(): SysUserManageValidate
    {
        return $this->only(["id"]);
    }
}