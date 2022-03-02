<?php

namespace app\middleware;

class Check
{
    public function handle($request, \Closure $next)
    {
        $request->check = '检测-';

        return $next($request);
    }

}
