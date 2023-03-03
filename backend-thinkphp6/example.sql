/*
 Navicat Premium Data Transfer

 Source Server         : docker-navigation-pane
 Source Server Type    : MySQL
 Source Server Version : 50741 (5.7.41)
 Source Host           : localhost:8802
 Source Schema         : example

 Target Server Type    : MySQL
 Target Server Version : 50741 (5.7.41)
 File Encoding         : 65001

 Date: 03/03/2023 16:38:08
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for sys_option
-- ----------------------------
DROP TABLE IF EXISTS `sys_option`;
CREATE TABLE `sys_option`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `create_time` datetime NULL DEFAULT NULL,
  `update_time` datetime NULL DEFAULT NULL,
  `delete_time` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sys_option
-- ----------------------------
INSERT INTO `sys_option` VALUES (1, 'template_variable', '{}', '2023-03-03 16:36:31', '2023-03-03 16:36:31', NULL);

-- ----------------------------
-- Table structure for sys_user
-- ----------------------------
DROP TABLE IF EXISTS `sys_user`;
CREATE TABLE `sys_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '测试账号：admin',
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '测试密码：e10adc3949ba59abbe56e057f20f883e',
  `name` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '用户名',
  `avatar` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '头像',
  `role` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '角色',
  `is_system` int(1) NOT NULL DEFAULT 0 COMMENT '是否是系统账户？系统账户不可删除！',
  `create_time` datetime NULL DEFAULT NULL,
  `update_time` datetime NULL DEFAULT NULL,
  `delete_time` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sys_user
-- ----------------------------
INSERT INTO `sys_user` VALUES (1, 'admin', '$2y$10$WPnF/fHsF22QOLJwqGtnSenG6yGIUUk5aKel/zVgCHd92vSCarDAK', '超级管理员', NULL, 'admin', 1, '2023-03-01 05:06:08', '2023-03-03 15:23:58', NULL);
INSERT INTO `sys_user` VALUES (2, 'demo', '$2y$10$EjzUJR2VNoke/m5lkEDHhecznWBy5WVbQCsfqZsJv6FXlsbEu3Fi6', '普通用户', '', NULL, 0, '2023-03-01 05:06:24', '2023-03-03 15:22:13', NULL);
INSERT INTO `sys_user` VALUES (3, 'timoprince', '$2y$10$vsXo5eGZIUW.UMVrbvKT7.Ur4QEqx9THlHN9GCk7TBJfv4NrJMeV6', '提莫小王子', '', 'admin', 0, '2023-03-01 21:19:39', '2023-03-01 21:34:50', NULL);

-- ----------------------------
-- Table structure for template_table
-- ----------------------------
DROP TABLE IF EXISTS `template_table`;
CREATE TABLE `template_table`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_time` datetime NULL DEFAULT NULL,
  `update_time` datetime NULL DEFAULT NULL,
  `delete_time` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of template_table
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
