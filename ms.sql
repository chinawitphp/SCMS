/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50626
Source Host           : localhost:3306
Source Database       : ms

Target Server Type    : MYSQL
Target Server Version : 50626
File Encoding         : 65001

Date: 2016-10-17 20:19:07
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ms_departtype
-- ----------------------------
DROP TABLE IF EXISTS `ms_departtype`;
CREATE TABLE `ms_departtype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `departname` varchar(64) NOT NULL COMMENT '海船船员健康证书-部门',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ms_heathinfo
-- ----------------------------
DROP TABLE IF EXISTS `ms_heathinfo`;
CREATE TABLE `ms_heathinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `holderid` int(11) DEFAULT NULL,
  `dipid` varchar(64) DEFAULT NULL,
  `departid` int(11) DEFAULT NULL,
  `isdel` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ms_holdercomminfo
-- ----------------------------
DROP TABLE IF EXISTS `ms_holdercomminfo`;
CREATE TABLE `ms_holdercomminfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `realname` varchar(64) NOT NULL,
  `nation` varchar(64) NOT NULL,
  `idnumber` varchar(18) NOT NULL,
  `birthdate` int(8) NOT NULL,
  `sex` varchar(8) NOT NULL,
  `dipid` int(64) DEFAULT NULL,
  `regtime` int(64) DEFAULT NULL,
  `endtime` int(64) DEFAULT NULL,
  `isdel` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ms_leveltype
-- ----------------------------
DROP TABLE IF EXISTS `ms_leveltype`;
CREATE TABLE `ms_leveltype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `levelname` varchar(64) NOT NULL COMMENT '海船船员适任证书-等级与职务',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ms_limittype
-- ----------------------------
DROP TABLE IF EXISTS `ms_limittype`;
CREATE TABLE `ms_limittype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `limitname` varchar(64) NOT NULL COMMENT '海船船员适任证书-适用的限制',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ms_logs
-- ----------------------------
DROP TABLE IF EXISTS `ms_logs`;
CREATE TABLE `ms_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `douser` varchar(12) NOT NULL,
  `dotime` datetime NOT NULL,
  `doip` varchar(32) NOT NULL,
  `dotype` varchar(64) DEFAULT NULL,
  `status` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ms_passportinfo
-- ----------------------------
DROP TABLE IF EXISTS `ms_passportinfo`;
CREATE TABLE `ms_passportinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `holderid` int(11) DEFAULT NULL,
  `dipid` varchar(64) DEFAULT NULL,
  `signorgid` int(11) DEFAULT NULL,
  `isdel` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ms_provisimtype
-- ----------------------------
DROP TABLE IF EXISTS `ms_provisimtype`;
CREATE TABLE `ms_provisimtype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `provisimname` varchar(64) NOT NULL COMMENT '适用公约条件款',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ms_qualifyinfo
-- ----------------------------
DROP TABLE IF EXISTS `ms_qualifyinfo`;
CREATE TABLE `ms_qualifyinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `holderid` int(11) DEFAULT NULL,
  `dipid` varchar(64) DEFAULT NULL,
  `secondaryid` int(11) DEFAULT NULL,
  `limitid` int(11) DEFAULT NULL,
  `isdel` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ms_seameninfo
-- ----------------------------
DROP TABLE IF EXISTS `ms_seameninfo`;
CREATE TABLE `ms_seameninfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `holderid` int(11) DEFAULT NULL,
  `dipid` varchar(64) DEFAULT NULL,
  `birthareaid` int(11) DEFAULT NULL,
  `signorgid` int(11) DEFAULT NULL,
  `isdel` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ms_signorgtype
-- ----------------------------
DROP TABLE IF EXISTS `ms_signorgtype`;
CREATE TABLE `ms_signorgtype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `MS_Signorgname` varchar(64) NOT NULL COMMENT '签发机关',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ms_trainedinfo
-- ----------------------------
DROP TABLE IF EXISTS `ms_trainedinfo`;
CREATE TABLE `ms_trainedinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `holderid` int(11) NOT NULL,
  `dipid` varchar(255) DEFAULT NULL,
  `secondaryid` int(11) DEFAULT NULL,
  `provisimid` int(11) DEFAULT NULL,
  `regtime` int(64) DEFAULT NULL,
  `endtime` int(64) DEFAULT NULL,
  `isdel` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ms_traintype
-- ----------------------------
DROP TABLE IF EXISTS `ms_traintype`;
CREATE TABLE `ms_traintype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trainname` varchar(64) NOT NULL COMMENT '海船船员培训合格证二级证书名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ms_user
-- ----------------------------
DROP TABLE IF EXISTS `ms_user`;
CREATE TABLE `ms_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(12) NOT NULL,
  `password` varchar(18) NOT NULL DEFAULT '123456',
  `realname` varchar(64) NOT NULL,
  `regtime` datetime NOT NULL,
  `isban` int(1) DEFAULT '0',
  `phonenumber` int(20) DEFAULT NULL,
  `lastlogip` varchar(255) DEFAULT NULL,
  `lastlogtime` datetime DEFAULT NULL,
  `groupid` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
