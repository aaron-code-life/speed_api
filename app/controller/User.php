<?php
namespace app\controller;

/**
 * 用户
 */
class User extends Base
{

    //初始化
    public function initialize()
    {
        parent::initialize();
        $this->model = new \app\model\User();
    }


	/**
	* showdoc
	* @catalog 用户
	* @title 用户信息
	* @description 用户信息
	* @method post
	* @url /user/detail
	* @param id 必选 int 编号
	* @param token 必选 int token
	* @return {"code":200,"message":"获取成功","time":1646214783,"data":{"id":1,"phone":"13067833427","avatar":null,"truename":"我","introduction":"1","birth_date":null,"status":0,"create_time":"2022-03-02 17:21:53","update_time":"2022-03-02 17:21:56"}}
	* @return_param id int 编号
	* @return_param phone varchar 账号或手机号，唯一
	* @return_param password varchar 密码
	* @return_param avatar text 头像
	* @return_param truename varchar 真实姓名
	* @return_param introduction varchar 描述
	* @return_param birth_date date 出生日期
	* @return_param status tinyint 状态 0：禁用 1：启用
	* @return_param create_time datetime 创建时间
	* @return_param update_time datetime 修改时间
	*/
    public function detail(){
        $this->params['id'] = $this->_user->id;
        parent::detail();
    }

}
