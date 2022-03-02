<?php
// 这是系统自动生成的公共文件
use think\Response;

if (!function_exists('api_success')) {
    //成功输出
    function api_success($msg = '操作成功',$data = null){
        api_response($msg,$data);
    }
}
if (!function_exists('api_error')) {
    //失败输出
    function api_error($msg = '失败',$code=500){
        api_response($msg,null,$code);
    }
}
if (!function_exists('api_response')) {
    //api统一输出
    function api_response($msg,$data = '',$code=200){
        $response_data = [
            'code' => $code,
            'message' => $msg,
            'time' => time(),
        ];
        if(!empty($data)) $response_data['data'] = $data;
        Response::create($response_data,'json')
            ->contentType('application/json')
            ->code($code)->send();
        exit;
    }
}
