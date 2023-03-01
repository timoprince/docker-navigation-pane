<?php

namespace app\common\validate;

use think\Validate;

class PageValidate extends Validate
{
    protected $rule = [
        "page_num|页码" => "number|min:1",
        "page_size|每页条数" => "number|min:1"
    ];
}