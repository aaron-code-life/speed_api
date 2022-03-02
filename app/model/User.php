<?php
namespace app\model;

class User extends Base
{
    protected $hidden = ['password'];//隐藏字段
    //允许写入的字段
    protected $field = [
        'phone',
        'password',
        'nickname',
        'avatar',
        'truename',
        'birth_date',
    ];

    //模型写入前事件
    public static function onBeforeWrite($user)
    {
        //密码加密
        $user->password = sha1($user->password);
    }

}
