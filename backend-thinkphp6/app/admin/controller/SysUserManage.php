<?php

namespace app\admin\controller;

use app\admin\validate\SysUserManageValidate;
use app\common\services\SysUserServices;
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
     * @Query(ref="app\common\model\SysUser",field="name")
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

        $name = $this->request->get("name");

        $whereList = [];
        if (!empty($name)) $whereList[] = ["whereLike", ["name", "%$name%"]];

        ReturnResponse::success($this->services->queryListByPage($page_size, $page_num, $whereList));
    }

    /**
     * @Title("创建数据-2023年3月1日")
     * @Method("POST")
     * @Param(ref="app\common\model\SysUser",field="avatar,name,account,password,role")
     * @return void
     */
    public function createRow()
    {
        $data = $this->request->post();

        try {
            validate(SysUserManageValidate::class)->scene("create")->check($data);
            $err = $this->services->createRow($data);
            if ($err) ReturnResponse::error($err);
            ReturnResponse::make(ReturnResponse::CODE_SUCCESS, "创建成功！");
        } catch (ValidateException $exception) {
            ReturnResponse::error($exception->getError());
        }
    }

    /**
     * @Title("更新数据-2023年3月1日")
     * @Method("POST")
     * @Param(ref="app\common\model\SysUser",field="id,avatar,name,account,password,role")
     * @return void
     */
    public function updateRow()
    {
        $data = $this->request->post();

        try {
            validate(SysUserManageValidate::class)->scene("update")->check($data);

            $id = $this->request->post("id");

            $err = $this->services->updateRow($id, $data);
            if ($err) ReturnResponse::error($err);
            ReturnResponse::make(ReturnResponse::CODE_SUCCESS, "更新成功！");
        } catch (ValidateException $exception) {
            ReturnResponse::error($exception->getError());
        }
    }

    /**
     * @Title("删除数据-2023年3月1日")
     * @Method("POST")
     * @Param(ref="app\common\model\SysUser",field="id")
     * @return void
     */
    public function deleteRow()
    {
        $data = $this->request->post();

        try {
            validate(SysUserManageValidate::class)->scene("delete")->check($data);

            $id = $this->request->post("id");

            $err = $this->services->deleteRow($id);
            if ($err) ReturnResponse::error($err);

            ReturnResponse::make(ReturnResponse::CODE_SUCCESS, "删除成功！");
        } catch (ValidateException $exception) {
            ReturnResponse::error($exception->getError());
        }
    }
}