<?php
namespace app\model;
/**
 * 用户模型
 */
class Admin extends Base
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
}
