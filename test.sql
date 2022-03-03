/*
 Navicat Premium Data Transfer

 Source Server         : homestead
 Source Server Type    : MySQL
 Source Server Version : 80027
 Source Host           : 127.0.0.1:33060
 Source Schema         : test

 Target Server Type    : MySQL
 Target Server Version : 80027
 File Encoding         : 65001

 Date: 02/03/2022 17:56:00
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for test
-- ----------------------------
DROP TABLE IF EXISTS `test`;
CREATE TABLE `test` (
  `id` int NOT NULL COMMENT '主键id',
  `name` varchar(255) DEFAULT NULL COMMENT '姓名',
  `content` varchar(255) DEFAULT NULL COMMENT '内容',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  `status` tinyint(1) DEFAULT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='示例表';

-- ----------------------------
-- Records of test
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '编号',
  `phone` varchar(11) NOT NULL COMMENT '账号或手机号，唯一',
  `password` varchar(60) NOT NULL COMMENT '密码',
  `avatar` text COMMENT '头像',
  `truename` varchar(20) DEFAULT NULL COMMENT '真实姓名',
  `introduction` varchar(120) NOT NULL COMMENT '描述',
  `birth_date` date DEFAULT NULL COMMENT '出生日期',
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '状态 0：禁用 1：启用',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC COMMENT='用户表';

-- ----------------------------
-- Records of user
-- ----------------------------
BEGIN;
INSERT INTO `user` (`id`, `phone`, `password`, `avatar`, `truename`, `introduction`, `birth_date`, `status`, `create_time`, `update_time`) VALUES (1, '13066666666', 'eaeb8c1250f18a13b72c212ceb85f4cfc100f817', NULL, '我', '1', NULL, 0, '2022-03-02 17:21:53', '2022-03-02 09:55:39');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
