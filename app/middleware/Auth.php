<?php

namespace app\middleware;

use app\model\User;
use thans\jwt\exception\JWTException;
use thans\jwt\facade\JWTAuth;

class Auth
{
    public function handle($request, \Closure $next)
    {
        $request->user = null;
        try{
            $payload = JWTAuth::auth();
            $request->user = User::find($payload['data']->getValue()->id);
        }catch (JWTException $e){
            api_error('未登录!',401);
        }
        return $next($request);
    }

}
