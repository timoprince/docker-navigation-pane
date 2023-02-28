<?php

namespace app\admin\controller;

use app\admin\validate\AccountValidate;
use app\common\controller\BaseController;
use app\common\model\SysUser;
use app\common\services\AccountServices;
use app\common\utils\ReturnResponse;
use hg\apidoc\annotation\Method;
use hg\apidoc\annotation\Param;
use hg\apidoc\annotation\Returned;
use hg\apidoc\annotation\Sort;
use hg\apidoc\annotation\Title;
use think\App;
use think\exception\ValidateException;

/**
 * @Title("账号相关-2023年3月1日")
 * @Sort(10)
 */
class Account extends BaseController
{
    public function __construct(App $app, AccountServices $services)
    {
        parent::__construct($app);
        $this->services = $services;
    }

    /**
     * @Title("账号登录-2023年3月1日")
     * @Method("post")
     * @Param(ref="app\common\model\SysUser",field="account,password")
     * @Returned("user_info",ref="app\common\model\SysUser",withoutField="password")
     * @return void
     */
    public function login()
    {
        $data = $this->request->post();

        try {
            \validate(AccountValidate::class)->scene("login")->check($data);

            $account = $this->request->post("account");
            $password = $this->request->post("password");

            if (!$this->services->hasAccount($account)) ReturnResponse::error("账号 $account 不存在！");
            if (!$this->services->checkPassword($account, $password)) ReturnResponse::error("密码不正确！请检查您的输入！");

            ReturnResponse::success($this->services->getInfoByAccount($account));

        } catch (ValidateException $validateException) {
            ReturnResponse::error($validateException->getError());
        }
    }
}