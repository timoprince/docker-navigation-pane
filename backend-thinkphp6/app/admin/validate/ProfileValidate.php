<?php

namespace app\admin\validate;

use think\Validate;

class ProfileValidate extends Validate
{
    protected $rule = [
        "account|账号" => "length:1,16",
        "password|密码" => "length:32",
        "name|昵称" => "length:1,16",
    ];

    protected $scene = [
        "updateInfo" => ["account", "password", "name"]
    ];
}