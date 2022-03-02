<?php
namespace app\validate;
use think\Validate;
/**
 * 用户验证器
 */
class Admin extends Validate
{
    /*
CREATE TABLE `bb_admin` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `username` varchar(40) NOT NULL COMMENT '账号或手机号，唯一',
  `password` varchar(60) NOT NULL COMMENT '密码',
  `company_id` int(10) DEFAULT '0' COMMENT '公司编号',
  `role_id` int(10) DEFAULT NULL COMMENT '后台角色组编号/菜单编号-----不变',
  `app_role_id` int(10) DEFAULT NULL COMMENT 'APP菜单编号-----可变，永远只有一个',
  `department` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '部门级别 1：设计师 2：版师 3：样衣工 4：裁床 5：车工 6：检验 7：后道 8：财务 9：门店 10：业务经理 11：采购 12：其他(代表平台)',
  `avatar` text COMMENT '头像',
  `is_level` tinyint(2) unsigned NOT NULL DEFAULT '2' COMMENT '用户等级 0：平台 1：商户 2：普通',
  `truename` varchar(20) DEFAULT NULL COMMENT '真实姓名',
  `introduction` varchar(120) NOT NULL COMMENT '描述',
  `birth_date` date DEFAULT NULL COMMENT '出生日期',
  `id_card` varchar(18) DEFAULT NULL COMMENT '身份证号码',
  `id_card_positive` varchar(200) DEFAULT NULL COMMENT '身份证正面',
  `id_card_back` varchar(200) DEFAULT NULL COMMENT '身份证背面',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态 0：禁用 1：启用',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `username` (`username`) USING BTREE,
  KEY `department` (`department`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='用户表'
     * */
    protected $rule = [
        'id'  => 'require|max:10',//编号
		'username'  => 'require|max:40',//账号或手机号，唯一
		'password'  => 'require|max:60',//密码
		'company_id'  => 'require|max:10',//公司编号
		'role_id'  => 'require|max:10',//后台角色组编号/菜单编号-----不变
		'app_role_id'  => 'require|max:10',//APP菜单编号-----可变，永远只有一个
		'department'  => 'require|max:3 unsigned',//部门级别 1：设计师 2：版师 3：样衣工 4：裁床 5：车工 6：检验 7：后道 8：财务 9：门店 10：业务经理 11：采购 12：其他(代表平台)
		'avatar'  => 'require',//头像
		'is_level'  => 'require|max:2 unsigned',//用户等级 0：平台 1：商户 2：普通
		'truename'  => 'require|max:20',//真实姓名
		'introduction'  => 'require|max:120',//描述
		'birth_date'  => 'require',//出生日期
		'id_card'  => 'require|max:18',//身份证号码
		'id_card_positive'  => 'require|max:200',//身份证正面
		'id_card_back'  => 'require|max:200',//身份证背面
		'status'  => 'require|max:2',//状态 0：禁用 1：启用
		'create_time'  => 'require',//创建时间
		'update_time'  => 'require',//修改时间
    ];

    protected $message = [
        'id.require'  => '编号必须填写',//编号
		'id.max'  => '编号字段长度最多为10',//编号
		'username.require'  => '账号或手机号，唯一必须填写',//账号或手机号，唯一
		'username.max'  => '账号或手机号，唯一字段长度最多为40',//账号或手机号，唯一
		'password.require'  => '密码必须填写',//密码
		'password.max'  => '密码字段长度最多为60',//密码
		'company_id.require'  => '公司编号必须填写',//公司编号
		'company_id.max'  => '公司编号字段长度最多为10',//公司编号
		'role_id.require'  => '后台角色组编号/菜单编号-----不变必须填写',//后台角色组编号/菜单编号-----不变
		'role_id.max'  => '后台角色组编号/菜单编号-----不变字段长度最多为10',//后台角色组编号/菜单编号-----不变
		'app_role_id.require'  => 'APP菜单编号-----可变，永远只有一个必须填写',//APP菜单编号-----可变，永远只有一个
		'app_role_id.max'  => 'APP菜单编号-----可变，永远只有一个字段长度最多为10',//APP菜单编号-----可变，永远只有一个
		'department.require'  => '部门级别 1：设计师 2：版师 3：样衣工 4：裁床 5：车工 6：检验 7：后道 8：财务 9：门店 10：业务经理 11：采购 12：其他(代表平台)必须填写',//部门级别 1：设计师 2：版师 3：样衣工 4：裁床 5：车工 6：检验 7：后道 8：财务 9：门店 10：业务经理 11：采购 12：其他(代表平台)
		'department.max'  => '部门级别 1：设计师 2：版师 3：样衣工 4：裁床 5：车工 6：检验 7：后道 8：财务 9：门店 10：业务经理 11：采购 12：其他(代表平台)字段长度最多为3 unsigned',//部门级别 1：设计师 2：版师 3：样衣工 4：裁床 5：车工 6：检验 7：后道 8：财务 9：门店 10：业务经理 11：采购 12：其他(代表平台)
		'avatar.require'  => '头像必须填写',//头像
		'is_level.require'  => '用户等级 0：平台 1：商户 2：普通必须填写',//用户等级 0：平台 1：商户 2：普通
		'is_level.max'  => '用户等级 0：平台 1：商户 2：普通字段长度最多为2 unsigned',//用户等级 0：平台 1：商户 2：普通
		'truename.require'  => '真实姓名必须填写',//真实姓名
		'truename.max'  => '真实姓名字段长度最多为20',//真实姓名
		'introduction.require'  => '描述必须填写',//描述
		'introduction.max'  => '描述字段长度最多为120',//描述
		'birth_date.require'  => '出生日期必须填写',//出生日期
		'id_card.require'  => '身份证号码必须填写',//身份证号码
		'id_card.max'  => '身份证号码字段长度最多为18',//身份证号码
		'id_card_positive.require'  => '身份证正面必须填写',//身份证正面
		'id_card_positive.max'  => '身份证正面字段长度最多为200',//身份证正面
		'id_card_back.require'  => '身份证背面必须填写',//身份证背面
		'id_card_back.max'  => '身份证背面字段长度最多为200',//身份证背面
		'status.require'  => '状态 0：禁用 1：启用必须填写',//状态 0：禁用 1：启用
		'status.max'  => '状态 0：禁用 1：启用字段长度最多为2',//状态 0：禁用 1：启用
		'create_time.require'  => '创建时间必须填写',//创建时间
		'update_time.require'  => '修改时间必须填写',//修改时间
    ];

    protected $scene = [
        'add'  =>  [
			'id',
			'username',
			'password',
			'company_id',
			'role_id',
			'app_role_id',
			'department',
			'avatar',
			'is_level',
			'truename',
			'introduction',
			'birth_date',
			'id_card',
			'id_card_positive',
			'id_card_back',
			'status',
			'create_time',
			'update_time',
			],
    ];

}
