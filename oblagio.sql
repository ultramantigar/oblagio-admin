/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50532
Source Host           : localhost:3306
Source Database       : oblagio

Target Server Type    : MYSQL
Target Server Version : 50532
File Encoding         : 65001

Date: 2015-03-18 16:23:36
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for crud
-- ----------------------------
DROP TABLE IF EXISTS `crud`;
CREATE TABLE `crud` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `crud` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of crud
-- ----------------------------

-- ----------------------------
-- Table structure for hak_akses
-- ----------------------------
DROP TABLE IF EXISTS `hak_akses`;
CREATE TABLE `hak_akses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_hak_akses_to_role` (`role_id`),
  KEY `fk_hak_akses_to_menu` (`menu_id`),
  CONSTRAINT `fk_hak_akses_to_menu` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_hak_akses_to_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of hak_akses
-- ----------------------------
INSERT INTO `hak_akses` VALUES ('25', '1', '8');
INSERT INTO `hak_akses` VALUES ('26', '2', '8');
INSERT INTO `hak_akses` VALUES ('27', '3', '8');
INSERT INTO `hak_akses` VALUES ('28', '4', '8');
INSERT INTO `hak_akses` VALUES ('29', '1', '7');
INSERT INTO `hak_akses` VALUES ('30', '3', '7');
INSERT INTO `hak_akses` VALUES ('31', '4', '7');

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `nama_menu` varchar(50) DEFAULT NULL,
  `modules` varchar(50) DEFAULT NULL,
  `controller` varchar(50) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  `pos` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', '0', 'Security', '#', '#', '#', null);
INSERT INTO `menu` VALUES ('2', '1', 'Role', 'administrator', 'role', 'index', null);
INSERT INTO `menu` VALUES ('3', '1', 'User', 'administrator', 'user', 'index', null);
INSERT INTO `menu` VALUES ('4', '1', 'Hak Akses', 'administrator', 'hakAkses', 'index', null);

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES ('7', 'Admin');
INSERT INTO `role` VALUES ('8', 'Super Admin');
INSERT INTO `role` VALUES ('9', 'tes');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_to_role` (`role_id`),
  CONSTRAINT `fk_user_to_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('2', '8', 'reza', 'Muhamad Reza Abdul Rohim', 'reza.wikrama3@gmail.com', 'd0ff542e7f293a6f31d721e5c914442f');
INSERT INTO `user` VALUES ('3', '7', 'tenyom', 'anggi rahman', 'tenyom@tenyom.com', '3c1ab4f571a43feaed5f8145304083c2');
INSERT INTO `user` VALUES ('4', '9', 'tes', 'tes', 'tes@tes.com', '20c72e4ce56306e782b7b29e25d24760');
