<?php
namespace app\validate;
use think\Validate;
/**
 * 示例验证器
 */
class Test extends Validate
{
    /*
CREATE TABLE `test` (
  `id` int NOT NULL COMMENT '主键id',
  `name` varchar(255) DEFAULT NULL COMMENT '姓名',
  `content` varchar(255) DEFAULT NULL COMMENT '内容',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  `status` tinyint(1) DEFAULT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='示例表'
     * */
    protected $rule = [
        'id'  => 'require',//主键id
		'name'  => 'require|max:255',//姓名
		'content'  => 'require|max:255',//内容
		'create_time'  => 'require',//创建时间
		'update_time'  => 'require',//更新时间
		'status'  => 'require|max:1',//状态
    ];

    protected $message = [
        'id.require'  => '主键id必须填写',//主键id
		'name.require'  => '姓名必须填写',//姓名
		'name.max'  => '姓名字符长度不能超过255',//姓名
		'content.require'  => '内容必须填写',//内容
		'content.max'  => '内容字符长度不能超过255',//内容
		'create_time.require'  => '创建时间必须填写',//创建时间
		'update_time.require'  => '更新时间必须填写',//更新时间
		'status.require'  => '状态必须填写',//状态
		'status.max'  => '状态字符长度不能超过1',//状态
    ];

    protected $scene = [
        'add'  =>  [
			'id',
			'name',
			'content',
			'create_time',
			'update_time',
			'status',
			],
    ];

}
