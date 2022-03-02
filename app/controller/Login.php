<?php
/**
 * 登录控制管理
 */
namespace app\controller;
use thans\jwt\exception\JWTException;
use thans\jwt\facade\JWTAuth;
use app\model\User;

/**
 * 登录
 */
class Login extends Base
{

    /**
     * showdoc
     * @catalog 登录
     * @title 账号密码登录
     * @description 账号密码登录
     * @method post
     * @url /dologin
     * @param phone 必选 varchar 手机号
     * @param password 必选 varchar 密码
     * @return {"code":200,"message":"登录成功","time":1646213112,"data":{"id":1,"phone":"13067833427","avatar":null,"truename":"我","introduction":"1","birth_date":null,"status":0,"create_time":"2022-03-02 17:21:53","update_time":"2022-03-02 17:21:56","token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJkYXRhIjp7ImlkIjoxLCJwaG9uZSI6IjEzMDY3ODMzNDI3IiwiYXZhdGFyIjpudWxsLCJ0cnVlbmFtZSI6Ilx1NjIxMSIsImludHJvZHVjdGlvbiI6IjEiLCJiaXJ0aF9kYXRlIjpudWxsLCJzdGF0dXMiOjAsImNyZWF0ZV90aW1lIjoiMjAyMi0wMy0wMiAxNzoyMTo1MyIsInVwZGF0ZV90aW1lIjoiMjAyMi0wMy0wMiAxNzoyMTo1NiJ9LCJhdWQiOiIiLCJleHAiOjE2NDYyMzMyNzIsImlhdCI6MTY0NjIxMzExMiwiaXNzIjoiIiwianRpIjoiMDA5MDc5NmY0NjhlNTU2MDA2YmRjMTY4NjQ5M2E1YzEiLCJuYmYiOjE2NDYyMTMxMTIsInN1YiI6IiJ9.EIclpjBdvkjhrHhOZFB_2QD3Hi1wPJqA6s-0U_zzPtY"}}
     * @return_param id int 主键id
     * @return_param phone varchar 手机号
     * @return_param avatar varchar 头像
     * @return_param truename varchar 真实姓名
     * @return_param birth_date varchar 生日
     * @return_param introduction varchar 介绍
     * @return_param create_time datetime 创建时间
     * @return_param update_time datetime 更新时间
     * @return_param status tinyint 状态
     */
    public function dologin(){

        //参数验证器
        $this->validateParams($this->params,\app\validate\User::class,'login','登录');

        //查询账号密码是否匹配
        if($user = User::where([
            ['phone','=',$this->params['phone']],
            ['password','=',sha1($this->params['password'])]
        ])->find()){
            //生成token，并将用户信息数据保存
            $token = JWTAuth::builder(['data' => $user->toArray()]);
            $user['token'] = $token;
            //返回成功信息
            api_success('登录成功',$user);
        }
        api_error('手机号或密码错误',401);

    }

    /**
     * showdoc
     * @catalog 登录
     * @title 刷新token
     * @description 刷新token
     * @method get
     * @url /refresh_token
     * @param token 必选 varchar token
     * @return {"code":20000,"message":"成功","time":"成功","data":{"id":"主键id","name":"姓名","content":"内容","create_time":"创建时间","update_time":"更新时间","status":"状态"}}
     */
    public function refreshToken(){
        try{
            $token = JWTAuth::refresh();
            api_success('刷新成功',$token);
        }catch (JWTException $e){
            api_error('刷新失败：'.$e->getMessage());
        }
    }

}
