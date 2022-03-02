<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

Route::group(function(){

    /*登录者路由*/
    Route::group(function(){

        Route::get('refresh_token','Login/refreshToken');//刷新token

    })->middleware(['auth']);

    /*游客路由*/
    Route::group(function(){
        Route::post('dologin','Login/dologin');//登录
    })->middleware('visitor');

})->middleware(['throttle']);//限流中间件

Route::miss(function() {
    api_error('地址不存在',404);
});


