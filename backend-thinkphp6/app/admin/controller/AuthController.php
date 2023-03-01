<?php

namespace app\admin\controller;

use app\common\controller\BaseController;
use app\common\middleware\AuthMiddleware;
use app\common\utils\Token;

class AuthController extends BaseController
{
    protected $middleware = [AuthMiddleware::class];

    /**
     * 解密令牌
     * @return \stdClass|null
     */
    public function decodeToken(): ?\stdClass
    {
        $token = $this->request->header("Authorization");
        $primary_key = env("jwt.primary_key");
        return Token::decode(preg_replace("/^Bearer\s/", "", $token), $primary_key);
    }

    /**
     * 获取当前登录用户id
     * @return int
     */
    public function getUserId(): int
    {
        return $this->decodeToken()->data->user_id;
    }

    /**
     * 获取当前登录用户角色
     * @return string|null
     */
    public function getUserRole(): ?string
    {
        return $this->decodeToken()->data->user_role;
    }

    /**
     * 检查当前登录用户是否是特定角色
     * @param string|null $role
     * @return bool
     */
    public function isRole(string $role = null): bool
    {
        return $this->getUserRole() === $role;
    }

    /**
     * 检查当前登录用户是否是管理员
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->isRole("admin");
    }
}