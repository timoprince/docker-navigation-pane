<?php

namespace app\common\utils;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Token
{
    public const ALG_HS256 = "HS256";

    /**
     * 颁发令牌
     * @param array $payload 数据
     * @param string $primary_key 私钥
     * @param int $expire 有效期,单位：秒，默认1天
     * @param string $alg 加密方式，默认HS256
     * @return string
     */
    public static function encode(array $payload, string $primary_key, int $expire = 86400, string $alg = self::ALG_HS256): string
    {
        $iat = time();
        $exp = $iat + $expire;
        return JWT::encode([
            "iat" => $iat,
            "exp" => $exp,
            "data" => $payload
        ], $primary_key, strtoupper($alg));
    }

    /**
     * 解密令牌
     * @param string $token 令牌
     * @param string $primary_key 私钥
     * @param string $alg 加密方式，默认HS256
     * @return \stdClass|null
     */
    public static function decode(string $token, string $primary_key, string $alg = self::ALG_HS256): ?\stdClass
    {
        try {
            return JWT::decode($token, new Key($primary_key, $alg));
        } catch (\Exception $exception) {
            return null;
        }
    }
}