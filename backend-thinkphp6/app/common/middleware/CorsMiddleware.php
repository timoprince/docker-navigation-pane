<?php

namespace app\common\middleware;

use app\Request;

class CorsMiddleware
{
    public function handle(Request $request, \Closure $next)
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");
        header("Access-Control-Allow-Methods: *");
        return $next($request);
    }
}
