<?php

namespace app\admin\controller;

use app\common\services\SysUserServices;
use app\common\utils\ReturnResponse;
use app\common\validate\PageValidate;
use hg\apidoc\annotation\Method;
use hg\apidoc\annotation\Query;
use hg\apidoc\annotation\Returned;
use hg\apidoc\annotation\Sort;
use hg\apidoc\annotation\Title;
use think\App;

/**
 * @Title("系统用户管理-2023年3月1日")
 * @Sort(20)
 */
class SysUserManage extends AuthController
{
    public function __construct(App $app, SysUserServices $services)
    {
        parent::__construct($app);
        $this->services = $services;
        if (!$this->isAdmin()) ReturnResponse::notPermission();
    }

    /**
     * @Title("分页查询用户列表-2023年3月1日")
     * @Method("GET")
     * @Query(ref="pageQuery")
     * @Returned(ref="pageReturn")
     * @Returned("data",type="array",desc="数据集合",ref="app\common\model\SysUser",withoutField="password")
     * @return void
     */
    public function queryListByPage()
    {
        $data = $this->request->get();
        $valid = new PageValidate();

        if (!$valid->check($data)) ReturnResponse::error($valid->getError());

        $page_size = $this->request->get("page_size", 10);
        $page_num = $this->request->get("page_num", 1);

        ReturnResponse::success($this->services->queryListByPage($page_size, $page_num));
    }
}