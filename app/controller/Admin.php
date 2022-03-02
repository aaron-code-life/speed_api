<?php
namespace app\controller;

/**
 * 用户
 */
class Admin extends Base
{
    public function initialize()
    {
        parent::initialize();
        $this->model = new \app\model\Admin();
    }


	/**
	* showdoc
	* @catalog 用户
	* @title 新增用户
	* @description 新增用户
	* @method post
	* @url /api/写上你设置的的路由！！！！
	* @param id 必选 int 编号
	* @param username 必选 varchar 账号或手机号，唯一
	* @param password 必选 varchar 密码
	* @param company_id 必选 int 公司编号
	* @param role_id 必选 int 后台角色组编号/菜单编号-----不变
	* @param app_role_id 必选 int APP菜单编号-----可变，永远只有一个
	* @param department 必选 tinyint 部门级别 1：设计师 2：版师 3：样衣工 4：裁床 5：车工 6：检验 7：后道 8：财务 9：门店 10：业务经理 11：采购 12：其他(代表平台)
	* @param avatar 必选 text 头像
	* @param is_level 必选 tinyint 用户等级 0：平台 1：商户 2：普通
	* @param truename 必选 varchar 真实姓名
	* @param introduction 必选 varchar 描述
	* @param birth_date 必选 date 出生日期
	* @param id_card 必选 varchar 身份证号码
	* @param id_card_positive 必选 varchar 身份证正面
	* @param id_card_back 必选 varchar 身份证背面
	* @param status 必选 tinyint 状态 0：禁用 1：启用
	* @param create_time 必选 datetime 创建时间
	* @param update_time 必选 datetime 修改时间
	* @return {"code":20000,"message":"成功","time":"成功","data":{"id":"编号","username":"账号或手机号，唯一","password":"密码","company_id":"公司编号","role_id":"后台角色组编号\/菜单编号-----不变","app_role_id":"APP菜单编号-----可变，永远只有一个","department":"部门级别 1：设计师 2：版师 3：样衣工 4：裁床 5：车工 6：检验 7：后道 8：财务 9：门店 10：业务经理 11：采购 12：其他(代表平台)","avatar":"头像","is_level":"用户等级 0：平台 1：商户 2：普通","truename":"真实姓名","introduction":"描述","birth_date":"出生日期","id_card":"身份证号码","id_card_positive":"身份证正面","id_card_back":"身份证背面","status":"状态 0：禁用 1：启用","create_time":"创建时间","update_time":"修改时间"}}
	* @return_param id int 编号
	* @return_param username varchar 账号或手机号，唯一
	* @return_param password varchar 密码
	* @return_param company_id int 公司编号
	* @return_param role_id int 后台角色组编号/菜单编号-----不变
	* @return_param app_role_id int APP菜单编号-----可变，永远只有一个
	* @return_param department tinyint 部门级别 1：设计师 2：版师 3：样衣工 4：裁床 5：车工 6：检验 7：后道 8：财务 9：门店 10：业务经理 11：采购 12：其他(代表平台)
	* @return_param avatar text 头像
	* @return_param is_level tinyint 用户等级 0：平台 1：商户 2：普通
	* @return_param truename varchar 真实姓名
	* @return_param introduction varchar 描述
	* @return_param birth_date date 出生日期
	* @return_param id_card varchar 身份证号码
	* @return_param id_card_positive varchar 身份证正面
	* @return_param id_card_back varchar 身份证背面
	* @return_param status tinyint 状态 0：禁用 1：启用
	* @return_param create_time datetime 创建时间
	* @return_param update_time datetime 修改时间
	*/
    public function add(){
        parent::add();
    }

}
