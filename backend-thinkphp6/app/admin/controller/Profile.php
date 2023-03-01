<?php

namespace app\admin\controller;

use app\admin\validate\ProfileValidate;
use app\common\controller\BaseController;
use app\common\dao\ProfileDao;
use app\common\middleware\AuthMiddleware;
use app\common\model\SysUser;
use app\common\services\ProfileServices;
use app\common\utils\ReturnResponse;
use hg\apidoc\annotation\Method;
use hg\apidoc\annotation\Param;
use hg\apidoc\annotation\Returned;
use hg\apidoc\annotation\Sort;
use hg\apidoc\annotation\Title;
use think\App;
use think\exception\ValidateException;

/**
 * @Title("个人档案-2023年3月1日")
 * @Sort(11)
 */
class Profile extends AuthController
{
    protected $middleware = [AuthMiddleware::class];

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
        ReturnResponse::success($this->services->getInfo($this->getUserId()));
    }

    /**
     * @Title("更新用户信息-2023年3月1日")
     * @Method("POST")
     * @Param(ref="app\common\model\SysUser",field="name,avatar,password")
     * @Returned(ref="app\common\model\SysUser",withoutField="password")
     * @return void
     */
    public function updateInfo()
    {
        $data = $this->request->post();

        try {
            validate(ProfileValidate::class)->scene("updateInfo")->check($data);
            $this->services->updateInfo($this->getUserId(), $data);
            ReturnResponse::success($this->services->getInfo($this->getUserId()));
        } catch (ValidateException $exception) {
            ReturnResponse::error($exception->getError());
        }
    }
}