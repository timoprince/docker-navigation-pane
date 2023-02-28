<?php

namespace app\admin\controller;

use app\common\controller\BaseController;
use app\common\dao\ProfileDao;
use app\common\model\SysUser;
use app\common\services\ProfileServices;
use app\common\utils\ReturnResponse;
use hg\apidoc\annotation\Returned;
use hg\apidoc\annotation\Sort;
use hg\apidoc\annotation\Title;
use think\App;

/**
 * @Title("个人档案-2023年3月1日")
 * @Sort(11)
 */
class Profile extends BaseController
{
    public function __construct(App $app, ProfileServices $services)
    {
        parent::__construct($app);
        $this->services = $services;
    }

    /**
     * @Title("获取用户信息-2023年3月1日")
     * @Returned(ref="app\common\model\SysUser",withoutField="password")
     * @return void
     */
    public function getInfo()
    {

        ReturnResponse::success($this->services->getInfo(1));
    }
}