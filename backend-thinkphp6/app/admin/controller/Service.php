<?php

namespace app\admin\controller;

use app\common\utils\ReturnResponse;
use hg\apidoc\annotation\Desc;
use hg\apidoc\annotation\Method;
use hg\apidoc\annotation\Param;
use hg\apidoc\annotation\ParamType;
use hg\apidoc\annotation\Returned;
use hg\apidoc\annotation\Sort;
use hg\apidoc\annotation\Title;
use think\facade\Filesystem;

/**
 * @Title("公共服务-2023年3月2日")
 * @Sort(1)
 */
class Service
{
    /**
     * @Title("文件上传-2023年3月2日")
     * @Method("POST")
     * @ParamType("formdata")
     * @Param("file",type="file", require=true,desc="附件")
     * @Returned("url", type="string",desc="文件地址")
     * @return void
     */
    public function upload()
    {
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file("file");

        if (empty($file)) ReturnResponse::error("请选择需要上传的文件！");

        // 上传到本地服务器
        $path = Filesystem::putFile('uploads', $file);
        $url = implode("/", [request()->domain(), "storage", $path]);
        ReturnResponse::success(["url" => $url], "上传成功！");
    }
}