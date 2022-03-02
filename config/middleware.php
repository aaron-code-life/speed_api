<?php
// 中间件配置
return [
    // 别名或分组
    'alias' => [
        //登录用户需要用到的中间件
        'throttle'=> \think\middleware\Throttle::class,
        'check' => [
            app\middleware\Check::class,
        ],
        'auth' => [
            app\middleware\Auth::class,
        ],
        'visitor' => [
            app\middleware\Visitor::class,
        ],
    ],
    // 优先级设置，此数组中的中间件会按照数组中的顺序优先执行
    'priority' => [],
];
