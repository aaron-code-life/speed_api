<?php

namespace app\middleware;

class Visitor
{
    public function handle($request, \Closure $next)
    {
        $request->visitor = '游客';

        return $next($request);
    }

}
