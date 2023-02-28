<?php

namespace app\admin\validate;

use think\Validate;

class AccountValidate extends Validate
{
    protected $rule = [
        "account|账号" => "length:1,16",
        "password|密码" => "length:32",
        "name|昵称" => "length:1,16",
    ];

    public function sceneLogin(): AccountValidate
    {
        return $this->only(["account", "password"])->append("account", "require")->append("password", "require");
    }
}