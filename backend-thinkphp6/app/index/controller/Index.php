<?php

namespace app\index\controller;

use app\BaseController;
use app\common\utils\ReturnResponse;

class Index extends BaseController
{
    public function index()
    {
        ReturnResponse::make(ReturnResponse::CODE_SUCCESS, "接口服务器运行正常");
    }
}