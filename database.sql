/*
Navicat MySQL Data Transfer

Source Server         : localhost 2
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : viettel

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-03-28 14:31:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for appointment
-- ----------------------------
DROP TABLE IF EXISTS `appointment`;
CREATE TABLE `appointment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `place` varchar(255) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `finish_time` datetime DEFAULT NULL,
  `active` tinyint(2) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `approver_uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of appointment
-- ----------------------------
INSERT INTO `appointment` VALUES ('1', '1', 'test', '28 Hue', '2018-03-20 16:11:00', '2018-03-21 16:11:00', '1', '1', '1');
INSERT INTO `appointment` VALUES ('2', '1', '2', '2', '2018-03-22 16:11:00', '2018-03-23 16:55:00', '2', '1', '1');

-- ----------------------------
-- Table structure for business
-- ----------------------------
DROP TABLE IF EXISTS `business`;
CREATE TABLE `business` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `daily_revenue` decimal(10,2) DEFAULT NULL,
  `monthly_revenue_accumulated` decimal(10,2) DEFAULT NULL,
  `goal_revenue` decimal(10,2) DEFAULT NULL,
  `percent_completed` double DEFAULT NULL,
  `lack_revenue` decimal(10,2) DEFAULT NULL,
  `compare_with_1st` varchar(255) DEFAULT NULL,
  `ranking` tinyint(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of business
-- ----------------------------

-- ----------------------------
-- Table structure for company
-- ----------------------------
DROP TABLE IF EXISTS `company`;
CREATE TABLE `company` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) DEFAULT NULL,
  `tax_identification_number` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `person_charge` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `bank_branch` varchar(255) DEFAULT NULL,
  `person_charge_phone_number` varchar(255) DEFAULT NULL,
  `person_charge_email_address` varchar(255) DEFAULT NULL,
  `active` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of company
-- ----------------------------
INSERT INTO `company` VALUES ('1', 'Test', '123456', '02445868963', 'email@congty.com', '26 main st', 'Nguyen A', 'congty.com', '123456', 'VCB', '0982555239', 'a@congty.com', '1');

-- ----------------------------
-- Table structure for goals
-- ----------------------------
DROP TABLE IF EXISTS `goals`;
CREATE TABLE `goals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goals` bigint(11) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goals
-- ----------------------------
INSERT INTO `goals` VALUES ('1', '5000', '2017-11-10 15:15:32', '2017-11-10 15:30:55');

-- ----------------------------
-- Table structure for history
-- ----------------------------
DROP TABLE IF EXISTS `history`;
CREATE TABLE `history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `entity_id` int(10) unsigned DEFAULT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assets` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `history_type_id_foreign` (`type_id`),
  KEY `history_user_id_foreign` (`user_id`),
  CONSTRAINT `history_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `history_types` (`id`) ON DELETE CASCADE,
  CONSTRAINT `history_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of history
-- ----------------------------
INSERT INTO `history` VALUES ('1', '1', '1', '2', 'save', 'bg-aqua', 'trans(\"history.backend.users.updated\") <strong>{user}</strong>', '{\"user_link\":[\"admin.access.user.show\",\"Backend User\",2]}', '2017-11-10 14:25:59', '2017-11-10 14:25:59');
INSERT INTO `history` VALUES ('2', '1', '1', '3', 'lock', 'bg-blue', 'trans(\"history.backend.users.changed_password\") <strong>{user}</strong>', '{\"user_link\":[\"admin.access.user.show\",\"Default User\",3]}', '2017-11-11 10:27:21', '2017-11-11 10:27:21');
INSERT INTO `history` VALUES ('3', '1', '1', '2', 'lock', 'bg-blue', 'trans(\"history.backend.users.changed_password\") <strong>{user}</strong>', '{\"user_link\":[\"admin.access.user.show\",\"Backend User\",2]}', '2017-11-11 10:31:17', '2017-11-11 10:31:17');

-- ----------------------------
-- Table structure for history_types
-- ----------------------------
DROP TABLE IF EXISTS `history_types`;
CREATE TABLE `history_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of history_types
-- ----------------------------
INSERT INTO `history_types` VALUES ('1', 'User', '2017-11-09 10:33:04', '2017-11-09 10:33:04');
INSERT INTO `history_types` VALUES ('2', 'Role', '2017-11-09 10:33:04', '2017-11-09 10:33:04');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2015_12_28_171741_create_social_logins_table', '1');
INSERT INTO `migrations` VALUES ('4', '2015_12_29_015055_setup_access_tables', '1');
INSERT INTO `migrations` VALUES ('5', '2016_07_03_062439_create_history_tables', '1');
INSERT INTO `migrations` VALUES ('6', '2017_04_04_131153_create_sessions_table', '1');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES ('1', 'view-backend', 'Xem Backend', '2017-11-09 10:33:04', '2017-11-09 10:33:04');
INSERT INTO `permissions` VALUES ('2', 'add-users', 'Thêm người dùng', '2017-11-09 14:50:49', '2017-11-09 14:50:51');
INSERT INTO `permissions` VALUES ('3', 'remove-users', 'Xóa người dùng', '2017-11-09 14:52:29', '2017-11-09 14:52:32');
INSERT INTO `permissions` VALUES ('4', 'print-business-report', 'In báo cáo kinh doanh', '2017-11-09 14:54:42', '2017-11-09 14:54:45');

-- ----------------------------
-- Table structure for permission_role
-- ----------------------------
DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE `permission_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_foreign` (`permission_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permission_role
-- ----------------------------
INSERT INTO `permission_role` VALUES ('2', '1', '3');
INSERT INTO `permission_role` VALUES ('7', '1', '2');
INSERT INTO `permission_role` VALUES ('8', '2', '2');
INSERT INTO `permission_role` VALUES ('9', '4', '2');
INSERT INTO `permission_role` VALUES ('10', '1', '4');
INSERT INTO `permission_role` VALUES ('11', '2', '4');
INSERT INTO `permission_role` VALUES ('12', '4', '4');

-- ----------------------------
-- Table structure for revenues
-- ----------------------------
DROP TABLE IF EXISTS `revenues`;
CREATE TABLE `revenues` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `company` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `revenue` decimal(10,2) DEFAULT NULL,
  `advisor` varchar(255) DEFAULT NULL,
  `reason_for_update` varchar(255) DEFAULT NULL,
  `profit` decimal(10,2) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of revenues
-- ----------------------------
INSERT INTO `revenues` VALUES ('1', '1', 'Công Ty A', 'a@a.com', '123456789', '2017-11-11 21:33:40', '2332.00', 'VV', '323', '11.00', null, null);
INSERT INTO `revenues` VALUES ('2', '1', 'Công Ty B', 'b@b.com', '098255696', '2017-11-07 21:33:44', '345.00', 'Nguyễn văn B', null, '11.00', null, null);
INSERT INTO `revenues` VALUES ('3', '2', 'ViettelGlobal', 'c@gmail.com', '0988888888', '2017-11-11 10:40:00', '25200000.00', 'Nguyễn Văn C', null, '2000000.00', null, null);
INSERT INTO `revenues` VALUES ('4', '2', 'Công Ty C', 'admin@x.com', '098255696', '2017-11-09 10:42:00', '4324234.00', 'a', null, '3244324.00', null, null);
INSERT INTO `revenues` VALUES ('5', '2', 'Công Ty D', 'd@gmail.com', '0999999999', '2017-11-08 10:43:00', '13333333.00', 'Nguyễn Văn D', null, '1300000.00', null, null);
INSERT INTO `revenues` VALUES ('6', '3', 'Viettel Global', 'user@user.com', '098255696', '2017-11-07 11:05:00', '100000.00', 'Nguyễn văn B', null, '100000.00', null, null);
INSERT INTO `revenues` VALUES ('7', '3', 'Viettel Global', 'user@user.com', '098255696', '2017-11-08 11:05:00', '100000.00', 'Nguyễn văn B', '', '100000.00', null, null);
INSERT INTO `revenues` VALUES ('8', '1', null, null, null, '2018-03-21 16:59:00', '25000000.00', null, null, '10000000.00', '1', '1');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `all` tinyint(1) NOT NULL DEFAULT '0',
  `sort` smallint(5) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'Kỹ thuật', '1', '1', '2017-11-09 10:33:04', '2017-11-09 14:46:43');
INSERT INTO `roles` VALUES ('2', 'Trưởng phòng', '0', '2', '2017-11-09 10:33:04', '2017-11-09 15:08:09');
INSERT INTO `roles` VALUES ('3', 'Nhân viên', '0', '3', '2017-11-09 10:33:04', '2017-11-09 14:46:27');
INSERT INTO `roles` VALUES ('4', 'Giám đốc', '0', '4', '2017-11-09 14:47:19', '2017-11-09 15:08:26');

-- ----------------------------
-- Table structure for role_user
-- ----------------------------
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_user_id_foreign` (`user_id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of role_user
-- ----------------------------
INSERT INTO `role_user` VALUES ('1', '1', '1');
INSERT INTO `role_user` VALUES ('3', '3', '3');
INSERT INTO `role_user` VALUES ('4', '2', '2');
INSERT INTO `role_user` VALUES ('5', '2', '3');

-- ----------------------------
-- Table structure for service
-- ----------------------------
DROP TABLE IF EXISTS `service`;
CREATE TABLE `service` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `active` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of service
-- ----------------------------
INSERT INTO `service` VALUES ('1', 'test', '1');

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of sessions
-- ----------------------------
INSERT INTO `sessions` VALUES ('mHP8uFBY3Zn3WOHeAWhfzlgF6jsQlvXsQcdETySQ', '1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0', 'ZXlKcGRpSTZJbnBqU0VkUU5XVkdXazlFY1U5a2IzZzJOVzEyYW5jOVBTSXNJblpoYkhWbElqb2lVVmxwVFZGalVuTlBTekJSUkdaVlpVczJhWFlyTTFGRFZFeHJhU3REYmxOSGNtWndkM2RZYVVWQ1MwcEdNbUo2TTJSVVdUWk1ObXBQYmxCY0wxd3ZRU3MyV1ROdlNsUTNaeXNyTkhoMWFHbFJiR0pDVXpJNWR6UmpXbVZUT0d0UGNFVjVNMFkxTWtSWVVWQk5iRGhrU0RCa2NUUXdVVk5KUkRkamVERlVaU3REZEVweVVuWkxhR05FVDBwVWVtZERVR2RqTTNOS1RuazNhbXBXWlZCeWRpdHFXbnAwSzNWNmRHTkNaSE5qTUhKbWJXb3JRbHBEZWxJMU56QmtaVzB5ZDI5U2NXbGxXSEZ1WW5salExTk1LekpDUkc4clREWmNMMWwwWkZkclJWd3ZiVlV4WkhGSFpXTXpkVnd2YVd0d09ETkxWbEZvY0ZwME56UmpabVJWUmpsclhDOXRiMUEwYlhaak1HaG5VRWsyUWt4Qk1ETlNVVTFGWEM5NVNrUjBWa1JWYUd3M1Mxd3ZTaXRyVFZOR2FXeHdlSGN6WEM5NVpXbGhNRU1yV0N0MlJHNVVSbTFJU1ZWQmVVaFZNbmhET1RSclNHczFXVTVvWjJ0VE5XZHNTek51UjNsTlVtSTVXamhwZFVkbk1sTXlhWFV3UFNJc0ltMWhZeUk2SWpoak1UQXpOV1E0WkRJMU5UZGlPVFEwT1daaE9EUTFPRGhqWmpnMk0yUTFZalF5T0RkaU56a3dNR1psT0dKak16aGtOV1UxWkRRMU5tSmxNbVpqTUdJaWZRPT0=', '1521626504');

-- ----------------------------
-- Table structure for social_logins
-- ----------------------------
DROP TABLE IF EXISTS `social_logins`;
CREATE TABLE `social_logins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `provider` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `social_logins_user_id_foreign` (`user_id`),
  CONSTRAINT `social_logins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of social_logins
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `confirmation_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pid` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone2` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `hobbies` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `strength` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `advisor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `goal` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Admin', 'Istrator', 'admin@admin.com', '$2y$10$DRqTWd78Y/SsRM8vUObZy.NXCuuBpgsAQgOf4tFFRhOTNrttsl9Aa', '1', '2c959e83b79aa3e938b61ff9dbaa0e56', '1', 'xTndaEubbCSCgIhVjLjpgFaBIwPJYssVPMv7lkEliYLw80IWLhwE6UcvtnCB', '2017-11-09 10:33:04', '2018-03-21 14:40:37', null, '1_21-03-2018-14-40-37.jpg', null, null, null, null, null, null, null, null, null, null, '208.00');
INSERT INTO `users` VALUES ('2', 'Backend', 'User', 'executive@executive.com', '$2y$10$T5oN6VHLhXn5OsMhaRucnOhtHZo/4SWavfBERjmikI.m0sEfHImiu', '1', '790eb0439981e217afdb500def406a99', '1', 'zB9A7u3unICFH2tByy65MHcDgJJg59M6YNM5sSwtd95Tnw2tHhzXXTRtKZei', '2017-11-09 10:33:04', '2017-11-11 10:31:17', null, null, null, null, null, null, null, null, null, null, null, null, '208.33');
INSERT INTO `users` VALUES ('3', 'Default', 'User', 'user@user.com', '$2y$10$4osjHn87P.rj0z0OeYMC/.prGRS1LDXIh6T5LNBYasfgx2sUoFeIq', '1', '4339c781eb59a35c120708339cc7c496', '1', 'B4pnqK4DBqxk40CPqUtA2jxSv7kDlWbanLvmnfIFbOdBP3AkPA0SJMDowO4V', '2017-11-09 10:33:04', '2017-11-11 10:27:20', null, null, null, null, null, null, null, null, null, null, null, null, '208.33');
