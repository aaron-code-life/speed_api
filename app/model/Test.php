<?php
namespace app\model;
/**
 * 示例模型
 */
class Test extends Base
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

    /* 以下是当前模型的事件，建议充分利用模型事件，可以更好的解耦，如不需要可以删除 */

    //查询后
    public static function onAfterRead($test){}
    //新增前
    public static function onBeforeInsert($test){}
    //新增后
    public static function onAfterInsert($test){}
    //更新前
    public static function onBeforeUpdate($test){}
    //更新后
    public static function onAfterUpdate($test){}
    //写入前
    public static function onBeforeWrite($test){}
    //写入后
    public static function onAfterWrite($test){}
    //删除前
    public static function onBeforeDelete($test){}
    //删除后
    public static function onAfterDelete($test){}
    //恢复前
    public static function onBeforeRestore($test){}
    //恢复后
    public static function onAfterRestore($test){}


}
