<?php

namespace app\common\utils;

class ReturnResponse
{
    public const CODE_SUCCESS = 0;
    public const CODE_FAIL = -1;
    public const CODE_ERROR = 50100;
    public const CODE_MISS_TOKEN = 40101;
    public const CODE_TOKEN_EXPIRE = 40102;
    public const CODE_NOT_PERMISSION = 40103;

    /**
     * 返回一个报文
     * @param int $code 状态码
     * @param string $msg 消息
     * @param mixed $data 数据
     * @return void
     */
    public static function make(int $code, string $msg, $data = null)
    {
        header("content-type:application/json;");
        $map = ["code" => $code, "msg" => $msg, "data" => $data];
        foreach ($map as $key => $value) {
            if (is_null($value)) unset($map[$key]);
        }
        echo json_encode($map);
        exit();
    }

    /**
     * 请求成功
     * @param mixed $data 数据
     * @param string $msg 成功信息
     * @return void
     */
    public static function success($data, string $msg = "操作成功")
    {

        self::make(self::CODE_SUCCESS, "请求成功", $data);
    }

    /**
     * 请求失败
     * @param string $msg 失败信息
     * @return void
     */
    public static function fail(string $msg = "操作失败！")
    {
        self::make(self::CODE_FAIL, $msg);
    }

    /**
     * 系统错误
     * @param string $msg 错误信息
     * @return void
     */
    public static function error(string $msg = "系统故障，请联系开发人员处理！")
    {
        self::make(self::CODE_ERROR, $msg);
    }

    /**
     * 丢失令牌
     * @return void
     */
    public static function missToken()
    {
        self::make(self::CODE_MISS_TOKEN, "未传入登录令牌，请检查您的参数！");
    }

    /**
     * 授权过期
     * @return void
     */
    public static function tokenExpire()
    {
        self::make(self::CODE_TOKEN_EXPIRE, "登录状态已过期，请重新登陆！");
    }

    /**
     * 没有权限
     * @return void
     */
    public static function notPermission()
    {
        self::make(self::CODE_NOT_PERMISSION, "你没有权限执行该操作！");
    }
}