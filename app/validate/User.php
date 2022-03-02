<?php
/**
 * 用户验证
 */
namespace app\validate;
use think\Validate;

class User extends Validate
{
    protected $rule = [
        'phone'  => 'require|mobile|unique:user',
        'password'  =>  'require|length:6,20',
        'birth_date'    =>  'date',
    ];

    protected $message = [
        'phone.require'  => '手机号必须填写',
        'phone.mobile'  => '手机号格式不对',
        'phone.unique'  => '手机号已存在',
        'password.require'  => '密码必须填写',
        'password.length'  => '密码长度必须是6到20位',
        'birth_date.date'  => '生日格式不对'
    ];

    protected $scene = [
        'add'  =>  ['phone','password'],
    ];

    // login 验证场景定义
    public function sceneLogin()
    {
        return $this->only(['phone','password'])->remove('phone', 'unique');
    }

    public function sceneEdit()
    {
        return $this
            ->remove('phone', true)
            ->remove('password', true);
    }



}
