<?php

namespace app\admin\validate;

use think\Validate;

class SysOptionManageValidate extends Validate
{
    protected $rule = [
        "id|ID" => "integer",
        "name|昵称" => "length:1,16",
    ];

    public function sceneCreate(): SysOptionManageValidate
    {
        return $this->only(["name"])->append("name", "require");
    }

    public function sceneUpdate(): SysOptionManageValidate
    {
        return $this->append("id", "require");
    }

    public function sceneDelete(): SysOptionManageValidate
    {
        return $this->only(["id"]);
    }
}