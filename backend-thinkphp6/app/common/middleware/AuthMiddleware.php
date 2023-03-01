<?php

namespace app\common\middleware;

use app\common\utils\ReturnResponse;
use app\Request;

class AuthMiddleware
{
    public function handle(Request $request, \Closure $next)
    {
        $token = $request->header("Authorization");
        if(empty($token)) ReturnResponse::missToken();

        return $next($request);
    }
}