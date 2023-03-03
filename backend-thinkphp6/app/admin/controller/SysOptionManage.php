<?php

namespace app\admin\controller;

use app\admin\validate\SysOptionManageValidate;
use app\common\services\SysOptionServices;
use app\common\utils\ReturnResponse;
use app\common\validate\PageValidate;
use hg\apidoc\annotation\Method;
use hg\apidoc\annotation\Param;
use hg\apidoc\annotation\Query;
use hg\apidoc\annotation\Returned;
use hg\apidoc\annotation\Sort;
use hg\apidoc\annotation\Title;
use think\App;
use think\exception\ValidateException;

/**
 * @Title("系统设置管理-2023年3月3日")
 * @Sort(21)
 */
class SysOptionManage extends AuthController
{
    public function __construct(App $app, SysOptionServices $services)
    {
        parent::__construct($app);
        $this->services = $services;
        if (!$this->isAdmin()) ReturnResponse::notPermission();
    }

    /**
     * @Title("获取配置-2023年3月3日")
     * @Method("GET")
     * @Query(ref="app\common\model\SysOption",field="name")
     * @Returned(ref="app\common\model\SysOption",field="name,value")
     * @return void
     */
    public function getValue()
    {
        $data = $this->request->get();

        try {
            validate(SysOptionManageValidate::class)->scene("getValue")->check($data);
            $name = $this->request->get("name");
            ReturnResponse::success($this->services->get($name));
        } catch (ValidateException $exception) {
            ReturnResponse::error($exception->getMessage());
        }
    }

    /**
     * @Title("更新配置-2023年3月3日")
     * @Method("POST")
     * @Param(ref="app\common\model\SysOption",field="name,content")
     * @return void
     */
    public function setValue()
    {
        $data = $this->request->post();
        try {
            validate(SysOptionManageValidate::class)->scene("setValue")->check($data);
            $name = $this->request->post("name");
            $content = $this->request->post("content");
            $this->services->set($name, $content);
            ReturnResponse::make(ReturnResponse::CODE_SUCCESS, "更新成功！");
        } catch (ValidateException $exception) {
            ReturnResponse::error($exception->getMessage());
        }
    }
}