<?php

namespace app\admin\validate;

use think\Validate;

class SysOptionManageValidate extends Validate
{
    protected $rule = [
        "name|名称" => "alphaDash|length:1,50",
    ];

    public function sceneGetValue(): SysOptionManageValidate
    {
        return $this->only(["name"])->append("name", "require");
    }

    public function sceneSetValue(): SysOptionManageValidate
    {
        return $this->append("content", "require");
    }
}