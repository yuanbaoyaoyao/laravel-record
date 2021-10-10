/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 80026
 Source Host           : localhost:3306
 Source Schema         : laravel_record

 Target Server Type    : MySQL
 Target Server Version : 80026
 File Encoding         : 65001

 Date: 11/10/2021 00:16:16
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_menu`;
CREATE TABLE `admin_menu`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int NOT NULL DEFAULT 0,
  `order` int NOT NULL DEFAULT 0,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `uri` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `permission` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_menu
-- ----------------------------
INSERT INTO `admin_menu` VALUES (1, 0, 1, '首页', 'fa-bar-chart', '/', NULL, NULL, '2021-10-10 15:49:12');
INSERT INTO `admin_menu` VALUES (2, 0, 5, '系统管理', 'fa-tasks', NULL, NULL, NULL, '2021-10-10 15:57:12');
INSERT INTO `admin_menu` VALUES (3, 2, 6, '管理员', 'fa-users', 'auth/users', NULL, NULL, '2021-10-10 15:57:12');
INSERT INTO `admin_menu` VALUES (4, 2, 7, '角色', 'fa-user', 'auth/roles', NULL, NULL, '2021-10-10 15:57:12');
INSERT INTO `admin_menu` VALUES (5, 2, 8, '权限', 'fa-ban', 'auth/permissions', NULL, NULL, '2021-10-10 15:57:12');
INSERT INTO `admin_menu` VALUES (6, 2, 9, '菜单', 'fa-bars', 'auth/menu', NULL, NULL, '2021-10-10 15:57:12');
INSERT INTO `admin_menu` VALUES (7, 2, 10, '操作日志', 'fa-history', 'auth/logs', NULL, NULL, '2021-10-10 15:57:12');
INSERT INTO `admin_menu` VALUES (8, 0, 2, '用户管理', 'fa-users', '/users', NULL, '2021-10-10 15:47:13', '2021-10-10 15:51:17');
INSERT INTO `admin_menu` VALUES (9, 0, 3, '耗材管理', 'fa-cubes', '/products', NULL, '2021-10-10 15:52:30', '2021-10-10 15:52:43');
INSERT INTO `admin_menu` VALUES (10, 0, 4, '需求单管理', 'fa-files-o', '/orders', NULL, '2021-10-10 15:57:04', '2021-10-10 15:58:03');

-- ----------------------------
-- Table structure for admin_operation_log
-- ----------------------------
DROP TABLE IF EXISTS `admin_operation_log`;
CREATE TABLE `admin_operation_log`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `input` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `admin_operation_log_user_id_index`(`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 119 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_operation_log
-- ----------------------------
INSERT INTO `admin_operation_log` VALUES (1, 1, 'admin', 'GET', '172.23.0.1', '[]', '2021-10-10 09:02:46', '2021-10-10 09:02:46');
INSERT INTO `admin_operation_log` VALUES (2, 1, 'admin/orders', 'GET', '172.23.0.1', '[]', '2021-10-10 09:02:55', '2021-10-10 09:02:55');
INSERT INTO `admin_operation_log` VALUES (3, 1, 'admin/orders/2', 'GET', '172.23.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 09:03:00', '2021-10-10 09:03:00');
INSERT INTO `admin_operation_log` VALUES (4, 1, 'admin/orders/2/ship', 'POST', '172.23.0.1', '{\"_token\":\"yQzN3hOZdvUJapGvvQksor5BP4iQcc7FuzIiilzT\"}', '2021-10-10 09:03:03', '2021-10-10 09:03:03');
INSERT INTO `admin_operation_log` VALUES (5, 1, 'admin/orders/2', 'GET', '172.23.0.1', '[]', '2021-10-10 09:03:04', '2021-10-10 09:03:04');
INSERT INTO `admin_operation_log` VALUES (6, 1, 'admin/orders/2', 'GET', '172.23.0.1', '[]', '2021-10-10 09:03:38', '2021-10-10 09:03:38');
INSERT INTO `admin_operation_log` VALUES (7, 1, 'admin/orders', 'GET', '172.23.0.1', '[]', '2021-10-10 09:03:45', '2021-10-10 09:03:45');
INSERT INTO `admin_operation_log` VALUES (8, 1, 'admin/orders/2', 'GET', '172.23.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 09:17:51', '2021-10-10 09:17:51');
INSERT INTO `admin_operation_log` VALUES (9, 1, 'admin/orders', 'GET', '172.23.0.1', '[]', '2021-10-10 09:17:53', '2021-10-10 09:17:53');
INSERT INTO `admin_operation_log` VALUES (10, 1, 'admin/orders/2', 'GET', '172.23.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 09:19:27', '2021-10-10 09:19:27');
INSERT INTO `admin_operation_log` VALUES (11, 1, 'admin/orders/2/refund', 'POST', '172.23.0.1', '{\"agree\":false,\"reason\":\"hfgh\",\"_token\":\"yQzN3hOZdvUJapGvvQksor5BP4iQcc7FuzIiilzT\"}', '2021-10-10 09:19:49', '2021-10-10 09:19:49');
INSERT INTO `admin_operation_log` VALUES (12, 1, 'admin/orders/2', 'GET', '172.23.0.1', '[]', '2021-10-10 09:19:55', '2021-10-10 09:19:55');
INSERT INTO `admin_operation_log` VALUES (13, 1, 'admin/orders/2', 'GET', '172.23.0.1', '[]', '2021-10-10 09:24:25', '2021-10-10 09:24:25');
INSERT INTO `admin_operation_log` VALUES (14, 1, 'admin', 'GET', '172.23.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 09:41:18', '2021-10-10 09:41:18');
INSERT INTO `admin_operation_log` VALUES (15, 1, 'admin/orders', 'GET', '172.23.0.1', '[]', '2021-10-10 09:41:25', '2021-10-10 09:41:25');
INSERT INTO `admin_operation_log` VALUES (16, 1, 'admin/orders/2', 'GET', '172.23.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 09:41:31', '2021-10-10 09:41:31');
INSERT INTO `admin_operation_log` VALUES (17, 1, 'admin/orders/2/refund', 'POST', '172.23.0.1', '{\"agree\":true,\"_token\":\"yQzN3hOZdvUJapGvvQksor5BP4iQcc7FuzIiilzT\"}', '2021-10-10 09:41:39', '2021-10-10 09:41:39');
INSERT INTO `admin_operation_log` VALUES (18, 1, 'admin/orders/2', 'GET', '172.23.0.1', '[]', '2021-10-10 09:41:41', '2021-10-10 09:41:41');
INSERT INTO `admin_operation_log` VALUES (19, 1, 'admin/orders', 'GET', '172.23.0.1', '[]', '2021-10-10 09:42:59', '2021-10-10 09:42:59');
INSERT INTO `admin_operation_log` VALUES (20, 1, 'admin/orders/2', 'GET', '172.23.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 09:45:15', '2021-10-10 09:45:15');
INSERT INTO `admin_operation_log` VALUES (21, 1, 'admin/orders/2', 'GET', '172.23.0.1', '[]', '2021-10-10 09:45:18', '2021-10-10 09:45:18');
INSERT INTO `admin_operation_log` VALUES (22, 1, 'admin/orders', 'GET', '172.23.0.1', '[]', '2021-10-10 09:45:25', '2021-10-10 09:45:25');
INSERT INTO `admin_operation_log` VALUES (23, 1, 'admin', 'GET', '172.24.0.1', '[]', '2021-10-10 10:11:57', '2021-10-10 10:11:57');
INSERT INTO `admin_operation_log` VALUES (24, 1, 'admin/orders', 'GET', '172.24.0.1', '[]', '2021-10-10 10:12:07', '2021-10-10 10:12:07');
INSERT INTO `admin_operation_log` VALUES (25, 1, 'admin/orders/2', 'GET', '172.24.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 10:12:16', '2021-10-10 10:12:16');
INSERT INTO `admin_operation_log` VALUES (26, 1, 'admin', 'GET', '172.25.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 11:30:58', '2021-10-10 11:30:58');
INSERT INTO `admin_operation_log` VALUES (27, 1, 'admin/orders', 'GET', '172.25.0.1', '[]', '2021-10-10 11:31:15', '2021-10-10 11:31:15');
INSERT INTO `admin_operation_log` VALUES (28, 1, 'admin/orders/3', 'GET', '172.25.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 11:31:35', '2021-10-10 11:31:35');
INSERT INTO `admin_operation_log` VALUES (29, 1, 'admin/orders/3/ship', 'POST', '172.25.0.1', '{\"_token\":\"yQzN3hOZdvUJapGvvQksor5BP4iQcc7FuzIiilzT\"}', '2021-10-10 11:31:59', '2021-10-10 11:31:59');
INSERT INTO `admin_operation_log` VALUES (30, 1, 'admin/orders/3', 'GET', '172.25.0.1', '[]', '2021-10-10 11:31:59', '2021-10-10 11:31:59');
INSERT INTO `admin_operation_log` VALUES (31, 1, 'admin/orders/3', 'GET', '172.25.0.1', '[]', '2021-10-10 11:33:56', '2021-10-10 11:33:56');
INSERT INTO `admin_operation_log` VALUES (32, 1, 'admin/orders/3', 'GET', '172.25.0.1', '[]', '2021-10-10 11:34:22', '2021-10-10 11:34:22');
INSERT INTO `admin_operation_log` VALUES (33, 1, 'admin/orders/3', 'GET', '172.25.0.1', '[]', '2021-10-10 11:36:35', '2021-10-10 11:36:35');
INSERT INTO `admin_operation_log` VALUES (34, 1, 'admin/orders', 'GET', '172.25.0.1', '[]', '2021-10-10 11:36:54', '2021-10-10 11:36:54');
INSERT INTO `admin_operation_log` VALUES (35, 1, 'admin/orders/3', 'GET', '172.25.0.1', '[]', '2021-10-10 11:38:28', '2021-10-10 11:38:28');
INSERT INTO `admin_operation_log` VALUES (36, 1, 'admin/orders/3', 'GET', '172.25.0.1', '[]', '2021-10-10 11:39:01', '2021-10-10 11:39:01');
INSERT INTO `admin_operation_log` VALUES (37, 1, 'admin/orders/3', 'GET', '172.25.0.1', '[]', '2021-10-10 11:40:00', '2021-10-10 11:40:00');
INSERT INTO `admin_operation_log` VALUES (38, 1, 'admin/orders', 'GET', '172.25.0.1', '{\"_sort\":{\"column\":\"confirmed_at\",\"type\":\"desc\"},\"_pjax\":\"#pjax-container\"}', '2021-10-10 11:41:07', '2021-10-10 11:41:07');
INSERT INTO `admin_operation_log` VALUES (39, 1, 'admin/orders', 'GET', '172.25.0.1', '{\"_sort\":{\"column\":\"confirmed_at\",\"type\":\"asc\"},\"_pjax\":\"#pjax-container\"}', '2021-10-10 11:41:09', '2021-10-10 11:41:09');
INSERT INTO `admin_operation_log` VALUES (40, 1, 'admin/orders/2', 'GET', '172.25.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 11:56:30', '2021-10-10 11:56:30');
INSERT INTO `admin_operation_log` VALUES (41, 1, 'admin/orders', 'GET', '172.25.0.1', '{\"_sort\":{\"column\":\"confirmed_at\",\"type\":\"asc\"},\"_pjax\":\"#pjax-container\"}', '2021-10-10 11:56:37', '2021-10-10 11:56:37');
INSERT INTO `admin_operation_log` VALUES (42, 1, 'admin/orders', 'GET', '172.25.0.1', '{\"_sort\":{\"column\":\"confirmed_at\",\"type\":\"asc\"}}', '2021-10-10 15:42:07', '2021-10-10 15:42:07');
INSERT INTO `admin_operation_log` VALUES (43, 1, 'admin/auth/menu', 'GET', '172.25.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 15:46:33', '2021-10-10 15:46:33');
INSERT INTO `admin_operation_log` VALUES (44, 1, 'admin/auth/menu', 'POST', '172.25.0.1', '{\"parent_id\":\"0\",\"title\":\"\\u7528\\u6237\\u7ba1\\u7406\",\"icon\":\"fa-users\",\"uri\":\"\\/users\",\"roles\":[null],\"permission\":null,\"_token\":\"7hO137Vhqr9vZeI1ol7lZVIH0JPlMC6NimS0v8lp\"}', '2021-10-10 15:47:13', '2021-10-10 15:47:13');
INSERT INTO `admin_operation_log` VALUES (45, 1, 'admin/auth/menu', 'GET', '172.25.0.1', '[]', '2021-10-10 15:47:14', '2021-10-10 15:47:14');
INSERT INTO `admin_operation_log` VALUES (46, 1, 'admin/auth/menu/1/edit', 'GET', '172.25.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 15:48:53', '2021-10-10 15:48:53');
INSERT INTO `admin_operation_log` VALUES (47, 1, 'admin/auth/menu/1', 'PUT', '172.25.0.1', '{\"parent_id\":\"0\",\"title\":\"\\u9996\\u9875\",\"icon\":\"fa-bar-chart\",\"uri\":\"\\/\",\"roles\":[null],\"permission\":null,\"_token\":\"7hO137Vhqr9vZeI1ol7lZVIH0JPlMC6NimS0v8lp\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/localhost\\/admin\\/auth\\/menu\"}', '2021-10-10 15:49:11', '2021-10-10 15:49:11');
INSERT INTO `admin_operation_log` VALUES (48, 1, 'admin/auth/menu', 'GET', '172.25.0.1', '[]', '2021-10-10 15:49:12', '2021-10-10 15:49:12');
INSERT INTO `admin_operation_log` VALUES (49, 1, 'admin/auth/menu/2/edit', 'GET', '172.25.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 15:49:20', '2021-10-10 15:49:20');
INSERT INTO `admin_operation_log` VALUES (50, 1, 'admin/auth/menu/2', 'PUT', '172.25.0.1', '{\"parent_id\":\"0\",\"title\":\"\\u7cfb\\u7edf\\u7ba1\\u7406\",\"icon\":\"fa-tasks\",\"uri\":null,\"roles\":[\"1\",null],\"permission\":null,\"_token\":\"7hO137Vhqr9vZeI1ol7lZVIH0JPlMC6NimS0v8lp\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/localhost\\/admin\\/auth\\/menu\"}', '2021-10-10 15:49:28', '2021-10-10 15:49:28');
INSERT INTO `admin_operation_log` VALUES (51, 1, 'admin/auth/menu', 'GET', '172.25.0.1', '[]', '2021-10-10 15:49:29', '2021-10-10 15:49:29');
INSERT INTO `admin_operation_log` VALUES (52, 1, 'admin/auth/menu/3/edit', 'GET', '172.25.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 15:49:31', '2021-10-10 15:49:31');
INSERT INTO `admin_operation_log` VALUES (53, 1, 'admin/auth/menu/3', 'PUT', '172.25.0.1', '{\"parent_id\":\"2\",\"title\":\"\\u7ba1\\u7406\\u5458\",\"icon\":\"fa-users\",\"uri\":\"auth\\/users\",\"roles\":[null],\"permission\":null,\"_token\":\"7hO137Vhqr9vZeI1ol7lZVIH0JPlMC6NimS0v8lp\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/localhost\\/admin\\/auth\\/menu\"}', '2021-10-10 15:49:40', '2021-10-10 15:49:40');
INSERT INTO `admin_operation_log` VALUES (54, 1, 'admin/auth/menu', 'GET', '172.25.0.1', '[]', '2021-10-10 15:49:41', '2021-10-10 15:49:41');
INSERT INTO `admin_operation_log` VALUES (55, 1, 'admin/auth/menu/4/edit', 'GET', '172.25.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 15:49:44', '2021-10-10 15:49:44');
INSERT INTO `admin_operation_log` VALUES (56, 1, 'admin/auth/menu/4', 'PUT', '172.25.0.1', '{\"parent_id\":\"2\",\"title\":\"\\u89d2\\u8272\",\"icon\":\"fa-user\",\"uri\":\"auth\\/roles\",\"roles\":[null],\"permission\":null,\"_token\":\"7hO137Vhqr9vZeI1ol7lZVIH0JPlMC6NimS0v8lp\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/localhost\\/admin\\/auth\\/menu\"}', '2021-10-10 15:49:51', '2021-10-10 15:49:51');
INSERT INTO `admin_operation_log` VALUES (57, 1, 'admin/auth/menu', 'GET', '172.25.0.1', '[]', '2021-10-10 15:49:52', '2021-10-10 15:49:52');
INSERT INTO `admin_operation_log` VALUES (58, 1, 'admin/auth/menu/5/edit', 'GET', '172.25.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 15:49:55', '2021-10-10 15:49:55');
INSERT INTO `admin_operation_log` VALUES (59, 1, 'admin/auth/menu/5', 'PUT', '172.25.0.1', '{\"parent_id\":\"2\",\"title\":\"\\u6743\\u9650\",\"icon\":\"fa-ban\",\"uri\":\"auth\\/permissions\",\"roles\":[null],\"permission\":null,\"_token\":\"7hO137Vhqr9vZeI1ol7lZVIH0JPlMC6NimS0v8lp\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/localhost\\/admin\\/auth\\/menu\"}', '2021-10-10 15:50:06', '2021-10-10 15:50:06');
INSERT INTO `admin_operation_log` VALUES (60, 1, 'admin/auth/menu', 'GET', '172.25.0.1', '[]', '2021-10-10 15:50:06', '2021-10-10 15:50:06');
INSERT INTO `admin_operation_log` VALUES (61, 1, 'admin/auth/menu/6/edit', 'GET', '172.25.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 15:50:10', '2021-10-10 15:50:10');
INSERT INTO `admin_operation_log` VALUES (62, 1, 'admin/auth/menu/6', 'PUT', '172.25.0.1', '{\"parent_id\":\"2\",\"title\":\"\\u83dc\\u5355\",\"icon\":\"fa-bars\",\"uri\":\"auth\\/menu\",\"roles\":[null],\"permission\":null,\"_token\":\"7hO137Vhqr9vZeI1ol7lZVIH0JPlMC6NimS0v8lp\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/localhost\\/admin\\/auth\\/menu\"}', '2021-10-10 15:50:17', '2021-10-10 15:50:17');
INSERT INTO `admin_operation_log` VALUES (63, 1, 'admin/auth/menu', 'GET', '172.25.0.1', '[]', '2021-10-10 15:50:18', '2021-10-10 15:50:18');
INSERT INTO `admin_operation_log` VALUES (64, 1, 'admin/auth/menu/7/edit', 'GET', '172.25.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 15:50:21', '2021-10-10 15:50:21');
INSERT INTO `admin_operation_log` VALUES (65, 1, 'admin/auth/menu/7', 'PUT', '172.25.0.1', '{\"parent_id\":\"2\",\"title\":\"\\u64cd\\u4f5c\\u65e5\\u5fd7\",\"icon\":\"fa-history\",\"uri\":\"auth\\/logs\",\"roles\":[null],\"permission\":null,\"_token\":\"7hO137Vhqr9vZeI1ol7lZVIH0JPlMC6NimS0v8lp\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/localhost\\/admin\\/auth\\/menu\"}', '2021-10-10 15:50:28', '2021-10-10 15:50:28');
INSERT INTO `admin_operation_log` VALUES (66, 1, 'admin/auth/menu', 'GET', '172.25.0.1', '[]', '2021-10-10 15:50:29', '2021-10-10 15:50:29');
INSERT INTO `admin_operation_log` VALUES (67, 1, 'admin/auth/menu', 'GET', '172.25.0.1', '[]', '2021-10-10 15:51:02', '2021-10-10 15:51:02');
INSERT INTO `admin_operation_log` VALUES (68, 1, 'admin/auth/menu', 'POST', '172.25.0.1', '{\"_token\":\"7hO137Vhqr9vZeI1ol7lZVIH0JPlMC6NimS0v8lp\",\"_order\":\"[{\\\"id\\\":1},{\\\"id\\\":8},{\\\"id\\\":2,\\\"children\\\":[{\\\"id\\\":3},{\\\"id\\\":4},{\\\"id\\\":5},{\\\"id\\\":6},{\\\"id\\\":7}]}]\"}', '2021-10-10 15:51:16', '2021-10-10 15:51:16');
INSERT INTO `admin_operation_log` VALUES (69, 1, 'admin/auth/menu', 'GET', '172.25.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 15:51:17', '2021-10-10 15:51:17');
INSERT INTO `admin_operation_log` VALUES (70, 1, 'admin/auth/menu', 'GET', '172.25.0.1', '[]', '2021-10-10 15:51:20', '2021-10-10 15:51:20');
INSERT INTO `admin_operation_log` VALUES (71, 1, 'admin/users', 'GET', '172.25.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 15:51:27', '2021-10-10 15:51:27');
INSERT INTO `admin_operation_log` VALUES (72, 1, 'admin/auth/menu', 'GET', '172.25.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 15:51:59', '2021-10-10 15:51:59');
INSERT INTO `admin_operation_log` VALUES (73, 1, 'admin/auth/menu', 'POST', '172.25.0.1', '{\"parent_id\":\"0\",\"title\":null,\"icon\":\"fa-cubes\",\"uri\":\"\\/products\",\"roles\":[null],\"permission\":null,\"_token\":\"7hO137Vhqr9vZeI1ol7lZVIH0JPlMC6NimS0v8lp\"}', '2021-10-10 15:52:23', '2021-10-10 15:52:23');
INSERT INTO `admin_operation_log` VALUES (74, 1, 'admin/auth/menu', 'GET', '172.25.0.1', '[]', '2021-10-10 15:52:23', '2021-10-10 15:52:23');
INSERT INTO `admin_operation_log` VALUES (75, 1, 'admin/auth/menu', 'POST', '172.25.0.1', '{\"parent_id\":\"0\",\"title\":\"\\u8017\\u6750\\u7ba1\\u7406\",\"icon\":\"fa-cubes\",\"uri\":\"\\/products\",\"roles\":[null],\"permission\":null,\"_token\":\"7hO137Vhqr9vZeI1ol7lZVIH0JPlMC6NimS0v8lp\"}', '2021-10-10 15:52:30', '2021-10-10 15:52:30');
INSERT INTO `admin_operation_log` VALUES (76, 1, 'admin/auth/menu', 'GET', '172.25.0.1', '[]', '2021-10-10 15:52:31', '2021-10-10 15:52:31');
INSERT INTO `admin_operation_log` VALUES (77, 1, 'admin/auth/menu', 'POST', '172.25.0.1', '{\"_token\":\"7hO137Vhqr9vZeI1ol7lZVIH0JPlMC6NimS0v8lp\",\"_order\":\"[{\\\"id\\\":1},{\\\"id\\\":8},{\\\"id\\\":9},{\\\"id\\\":2,\\\"children\\\":[{\\\"id\\\":3},{\\\"id\\\":4},{\\\"id\\\":5},{\\\"id\\\":6},{\\\"id\\\":7}]}]\"}', '2021-10-10 15:52:43', '2021-10-10 15:52:43');
INSERT INTO `admin_operation_log` VALUES (78, 1, 'admin/auth/menu', 'GET', '172.25.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 15:52:44', '2021-10-10 15:52:44');
INSERT INTO `admin_operation_log` VALUES (79, 1, 'admin/auth/menu', 'POST', '172.25.0.1', '{\"_token\":\"7hO137Vhqr9vZeI1ol7lZVIH0JPlMC6NimS0v8lp\",\"_order\":\"[{\\\"id\\\":1},{\\\"id\\\":8},{\\\"id\\\":9},{\\\"id\\\":2,\\\"children\\\":[{\\\"id\\\":3},{\\\"id\\\":4},{\\\"id\\\":5},{\\\"id\\\":6},{\\\"id\\\":7}]}]\"}', '2021-10-10 15:52:52', '2021-10-10 15:52:52');
INSERT INTO `admin_operation_log` VALUES (80, 1, 'admin/auth/menu', 'GET', '172.25.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 15:52:53', '2021-10-10 15:52:53');
INSERT INTO `admin_operation_log` VALUES (81, 1, 'admin/auth/menu', 'GET', '172.25.0.1', '[]', '2021-10-10 15:52:56', '2021-10-10 15:52:56');
INSERT INTO `admin_operation_log` VALUES (82, 1, 'admin/products', 'GET', '172.25.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 15:53:02', '2021-10-10 15:53:02');
INSERT INTO `admin_operation_log` VALUES (83, 1, 'admin/products', 'GET', '172.25.0.1', '{\"_pjax\":\"#pjax-container\",\"page\":\"2\"}', '2021-10-10 15:53:10', '2021-10-10 15:53:10');
INSERT INTO `admin_operation_log` VALUES (84, 1, 'admin/products', 'GET', '172.25.0.1', '{\"_pjax\":\"#pjax-container\",\"page\":\"1\"}', '2021-10-10 15:53:24', '2021-10-10 15:53:24');
INSERT INTO `admin_operation_log` VALUES (85, 1, 'admin/products', 'GET', '172.25.0.1', '{\"page\":\"1\"}', '2021-10-10 15:54:12', '2021-10-10 15:54:12');
INSERT INTO `admin_operation_log` VALUES (86, 1, 'admin/auth/menu', 'GET', '172.25.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 15:55:38', '2021-10-10 15:55:38');
INSERT INTO `admin_operation_log` VALUES (87, 1, 'admin/products', 'GET', '172.25.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 15:56:37', '2021-10-10 15:56:37');
INSERT INTO `admin_operation_log` VALUES (88, 1, 'admin/auth/menu', 'GET', '172.25.0.1', '[]', '2021-10-10 15:56:38', '2021-10-10 15:56:38');
INSERT INTO `admin_operation_log` VALUES (89, 1, 'admin/auth/menu', 'POST', '172.25.0.1', '{\"parent_id\":\"0\",\"title\":\"\\u8ba2\\u5355\\u7ba1\\u7406\",\"icon\":\"fa-files-o\",\"uri\":\"\\/orders\",\"roles\":[null],\"permission\":null,\"_token\":\"7hO137Vhqr9vZeI1ol7lZVIH0JPlMC6NimS0v8lp\"}', '2021-10-10 15:57:04', '2021-10-10 15:57:04');
INSERT INTO `admin_operation_log` VALUES (90, 1, 'admin/auth/menu', 'GET', '172.25.0.1', '[]', '2021-10-10 15:57:05', '2021-10-10 15:57:05');
INSERT INTO `admin_operation_log` VALUES (91, 1, 'admin/auth/menu', 'POST', '172.25.0.1', '{\"_token\":\"7hO137Vhqr9vZeI1ol7lZVIH0JPlMC6NimS0v8lp\",\"_order\":\"[{\\\"id\\\":1},{\\\"id\\\":8},{\\\"id\\\":9},{\\\"id\\\":10},{\\\"id\\\":2,\\\"children\\\":[{\\\"id\\\":3},{\\\"id\\\":4},{\\\"id\\\":5},{\\\"id\\\":6},{\\\"id\\\":7}]}]\"}', '2021-10-10 15:57:11', '2021-10-10 15:57:11');
INSERT INTO `admin_operation_log` VALUES (92, 1, 'admin/auth/menu', 'GET', '172.25.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 15:57:12', '2021-10-10 15:57:12');
INSERT INTO `admin_operation_log` VALUES (93, 1, 'admin/auth/menu', 'GET', '172.25.0.1', '[]', '2021-10-10 15:57:18', '2021-10-10 15:57:18');
INSERT INTO `admin_operation_log` VALUES (94, 1, 'admin/orders', 'GET', '172.25.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 15:57:22', '2021-10-10 15:57:22');
INSERT INTO `admin_operation_log` VALUES (95, 1, 'admin/auth/menu', 'GET', '172.25.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 15:57:47', '2021-10-10 15:57:47');
INSERT INTO `admin_operation_log` VALUES (96, 1, 'admin/auth/menu/10/edit', 'GET', '172.25.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 15:57:52', '2021-10-10 15:57:52');
INSERT INTO `admin_operation_log` VALUES (97, 1, 'admin/auth/menu/10', 'PUT', '172.25.0.1', '{\"parent_id\":\"0\",\"title\":\"\\u9700\\u6c42\\u5355\\u7ba1\\u7406\",\"icon\":\"fa-files-o\",\"uri\":\"\\/orders\",\"roles\":[null],\"permission\":null,\"_token\":\"7hO137Vhqr9vZeI1ol7lZVIH0JPlMC6NimS0v8lp\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/localhost\\/admin\\/auth\\/menu\"}', '2021-10-10 15:58:02', '2021-10-10 15:58:02');
INSERT INTO `admin_operation_log` VALUES (98, 1, 'admin/auth/menu', 'GET', '172.25.0.1', '[]', '2021-10-10 15:58:03', '2021-10-10 15:58:03');
INSERT INTO `admin_operation_log` VALUES (99, 1, 'admin/auth/menu', 'POST', '172.25.0.1', '{\"_token\":\"7hO137Vhqr9vZeI1ol7lZVIH0JPlMC6NimS0v8lp\",\"_order\":\"[{\\\"id\\\":1},{\\\"id\\\":8},{\\\"id\\\":9},{\\\"id\\\":10},{\\\"id\\\":2,\\\"children\\\":[{\\\"id\\\":3},{\\\"id\\\":4},{\\\"id\\\":5},{\\\"id\\\":6},{\\\"id\\\":7}]}]\"}', '2021-10-10 15:58:06', '2021-10-10 15:58:06');
INSERT INTO `admin_operation_log` VALUES (100, 1, 'admin/auth/menu', 'GET', '172.25.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 15:58:08', '2021-10-10 15:58:08');
INSERT INTO `admin_operation_log` VALUES (101, 1, 'admin/auth/menu', 'GET', '172.25.0.1', '[]', '2021-10-10 15:58:11', '2021-10-10 15:58:11');
INSERT INTO `admin_operation_log` VALUES (102, 1, 'admin/auth/permissions', 'GET', '172.25.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 15:58:24', '2021-10-10 15:58:24');
INSERT INTO `admin_operation_log` VALUES (103, 1, 'admin/auth/permissions/create', 'GET', '172.25.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 15:58:38', '2021-10-10 15:58:38');
INSERT INTO `admin_operation_log` VALUES (104, 1, 'admin/auth/permissions', 'POST', '172.25.0.1', '{\"slug\":\"products\",\"name\":\"\\u8017\\u6750\\u7ba1\\u7406\",\"http_method\":[null],\"http_path\":\"\\/products*\",\"_token\":\"7hO137Vhqr9vZeI1ol7lZVIH0JPlMC6NimS0v8lp\",\"_previous_\":\"http:\\/\\/localhost\\/admin\\/auth\\/permissions\"}', '2021-10-10 15:59:12', '2021-10-10 15:59:12');
INSERT INTO `admin_operation_log` VALUES (105, 1, 'admin/auth/permissions', 'GET', '172.25.0.1', '[]', '2021-10-10 15:59:13', '2021-10-10 15:59:13');
INSERT INTO `admin_operation_log` VALUES (106, 1, 'admin/auth/permissions/create', 'GET', '172.25.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 15:59:20', '2021-10-10 15:59:20');
INSERT INTO `admin_operation_log` VALUES (107, 1, 'admin/auth/permissions', 'POST', '172.25.0.1', '{\"slug\":\"orders\",\"name\":\"\\u9700\\u6c42\\u5355\\u7ba1\\u7406\",\"http_method\":[null],\"http_path\":\"\\/orders*\",\"_token\":\"7hO137Vhqr9vZeI1ol7lZVIH0JPlMC6NimS0v8lp\",\"_previous_\":\"http:\\/\\/localhost\\/admin\\/auth\\/permissions\"}', '2021-10-10 16:00:18', '2021-10-10 16:00:18');
INSERT INTO `admin_operation_log` VALUES (108, 1, 'admin/auth/permissions', 'GET', '172.25.0.1', '[]', '2021-10-10 16:00:20', '2021-10-10 16:00:20');
INSERT INTO `admin_operation_log` VALUES (109, 1, 'admin/auth/permissions/create', 'GET', '172.25.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 16:00:43', '2021-10-10 16:00:43');
INSERT INTO `admin_operation_log` VALUES (110, 1, 'admin/auth/permissions', 'POST', '172.25.0.1', '{\"slug\":\"users\",\"name\":\"\\u7528\\u6237\\u7ba1\\u7406\",\"http_method\":[null],\"http_path\":\"\\/users*\",\"_token\":\"7hO137Vhqr9vZeI1ol7lZVIH0JPlMC6NimS0v8lp\",\"_previous_\":\"http:\\/\\/localhost\\/admin\\/auth\\/permissions\"}', '2021-10-10 16:01:05', '2021-10-10 16:01:05');
INSERT INTO `admin_operation_log` VALUES (111, 1, 'admin/auth/permissions', 'GET', '172.25.0.1', '[]', '2021-10-10 16:01:06', '2021-10-10 16:01:06');
INSERT INTO `admin_operation_log` VALUES (112, 1, 'admin/auth/roles', 'GET', '172.25.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 16:01:20', '2021-10-10 16:01:20');
INSERT INTO `admin_operation_log` VALUES (113, 1, 'admin/auth/roles/create', 'GET', '172.25.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 16:01:25', '2021-10-10 16:01:25');
INSERT INTO `admin_operation_log` VALUES (114, 1, 'admin/auth/roles', 'GET', '172.25.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 16:02:55', '2021-10-10 16:02:55');
INSERT INTO `admin_operation_log` VALUES (115, 1, 'admin/auth/roles', 'GET', '172.25.0.1', '[]', '2021-10-10 16:02:57', '2021-10-10 16:02:57');
INSERT INTO `admin_operation_log` VALUES (116, 1, 'admin/auth/roles/create', 'GET', '172.25.0.1', '{\"_pjax\":\"#pjax-container\"}', '2021-10-10 16:02:59', '2021-10-10 16:02:59');
INSERT INTO `admin_operation_log` VALUES (117, 1, 'admin/auth/roles', 'POST', '172.25.0.1', '{\"slug\":\"operator\",\"name\":\"\\u8fd0\\u8425\",\"permissions\":[\"2\",\"3\",\"4\",\"6\",\"7\",\"8\",null],\"_token\":\"7hO137Vhqr9vZeI1ol7lZVIH0JPlMC6NimS0v8lp\",\"_previous_\":\"http:\\/\\/localhost\\/admin\\/auth\\/roles\"}', '2021-10-10 16:03:37', '2021-10-10 16:03:37');
INSERT INTO `admin_operation_log` VALUES (118, 1, 'admin/auth/roles', 'GET', '172.25.0.1', '[]', '2021-10-10 16:03:38', '2021-10-10 16:03:38');

-- ----------------------------
-- Table structure for admin_permissions
-- ----------------------------
DROP TABLE IF EXISTS `admin_permissions`;
CREATE TABLE `admin_permissions`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `http_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `http_path` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `admin_permissions_name_unique`(`name`) USING BTREE,
  UNIQUE INDEX `admin_permissions_slug_unique`(`slug`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_permissions
-- ----------------------------
INSERT INTO `admin_permissions` VALUES (1, 'All permission', '*', '', '*', NULL, NULL);
INSERT INTO `admin_permissions` VALUES (2, 'Dashboard', 'dashboard', 'GET', '/', NULL, NULL);
INSERT INTO `admin_permissions` VALUES (3, 'Login', 'auth.login', '', '/auth/login\r\n/auth/logout', NULL, NULL);
INSERT INTO `admin_permissions` VALUES (4, 'User setting', 'auth.setting', 'GET,PUT', '/auth/setting', NULL, NULL);
INSERT INTO `admin_permissions` VALUES (5, 'Auth management', 'auth.management', '', '/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs', NULL, NULL);
INSERT INTO `admin_permissions` VALUES (6, '耗材管理', 'products', '', '/products*', '2021-10-10 15:59:13', '2021-10-10 15:59:13');
INSERT INTO `admin_permissions` VALUES (7, '需求单管理', 'orders', '', '/orders*', '2021-10-10 16:00:19', '2021-10-10 16:00:19');
INSERT INTO `admin_permissions` VALUES (8, '用户管理', 'users', '', '/users*', '2021-10-10 16:01:06', '2021-10-10 16:01:06');

-- ----------------------------
-- Table structure for admin_role_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_menu`;
CREATE TABLE `admin_role_menu`  (
  `role_id` int NOT NULL,
  `menu_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  INDEX `admin_role_menu_role_id_menu_id_index`(`role_id`, `menu_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_role_menu
-- ----------------------------
INSERT INTO `admin_role_menu` VALUES (1, 2, NULL, NULL);

-- ----------------------------
-- Table structure for admin_role_permissions
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_permissions`;
CREATE TABLE `admin_role_permissions`  (
  `role_id` int NOT NULL,
  `permission_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  INDEX `admin_role_permissions_role_id_permission_id_index`(`role_id`, `permission_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_role_permissions
-- ----------------------------
INSERT INTO `admin_role_permissions` VALUES (1, 1, NULL, NULL);
INSERT INTO `admin_role_permissions` VALUES (2, 2, NULL, NULL);
INSERT INTO `admin_role_permissions` VALUES (2, 3, NULL, NULL);
INSERT INTO `admin_role_permissions` VALUES (2, 4, NULL, NULL);
INSERT INTO `admin_role_permissions` VALUES (2, 6, NULL, NULL);
INSERT INTO `admin_role_permissions` VALUES (2, 7, NULL, NULL);
INSERT INTO `admin_role_permissions` VALUES (2, 8, NULL, NULL);

-- ----------------------------
-- Table structure for admin_role_users
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_users`;
CREATE TABLE `admin_role_users`  (
  `role_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  INDEX `admin_role_users_role_id_user_id_index`(`role_id`, `user_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_role_users
-- ----------------------------
INSERT INTO `admin_role_users` VALUES (1, 1, NULL, NULL);

-- ----------------------------
-- Table structure for admin_roles
-- ----------------------------
DROP TABLE IF EXISTS `admin_roles`;
CREATE TABLE `admin_roles`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `admin_roles_name_unique`(`name`) USING BTREE,
  UNIQUE INDEX `admin_roles_slug_unique`(`slug`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_roles
-- ----------------------------
INSERT INTO `admin_roles` VALUES (1, 'Administrator', 'administrator', '2021-10-10 08:56:31', '2021-10-10 08:56:31');
INSERT INTO `admin_roles` VALUES (2, '运营', 'operator', '2021-10-10 16:03:37', '2021-10-10 16:03:37');

-- ----------------------------
-- Table structure for admin_user_permissions
-- ----------------------------
DROP TABLE IF EXISTS `admin_user_permissions`;
CREATE TABLE `admin_user_permissions`  (
  `user_id` int NOT NULL,
  `permission_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  INDEX `admin_user_permissions_user_id_permission_id_index`(`user_id`, `permission_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_user_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for admin_users
-- ----------------------------
DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(190) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `admin_users_username_unique`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_users
-- ----------------------------
INSERT INTO `admin_users` VALUES (1, 'admin', '$2y$10$BDG3H/wF5UB/ptprvQa.Ie4zL6Qplyu5Nk8HHVploiE6KUweNgMDi', 'Administrator', NULL, 'vN6jXM54W79QBLPDQQzVhNWugMCy7BiaqqxUVXPdCejCE7rhVJapvVEd7lN5', '2021-10-10 08:56:31', '2021-10-10 08:56:31');

SET FOREIGN_KEY_CHECKS = 1;
