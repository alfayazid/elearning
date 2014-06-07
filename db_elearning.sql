/*
Navicat MySQL Data Transfer

Source Server         : januarfonti
Source Server Version : 50133
Source Host           : localhost:3306
Source Database       : db_elearning

Target Server Type    : MYSQL
Target Server Version : 50133
File Encoding         : 65001

Date: 2014-06-07 22:41:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tbl_matkul`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_matkul`;
CREATE TABLE `tbl_matkul` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_matkul` varchar(50) DEFAULT NULL,
  `enroll` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_matkul
-- ----------------------------
INSERT INTO `tbl_matkul` VALUES ('1', 'Manajemen Industri Teknologi Informasi', null);
INSERT INTO `tbl_matkul` VALUES ('2', 'Sistem Terdistribusi', null);

-- ----------------------------
-- Table structure for `tbl_user`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` int(1) DEFAULT NULL,
  `nama` varchar(70) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `create_user` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES ('1', '0', '0', '0', '0', 'asd', '2014-06-04 18:50:52', '2014-06-04 18:51:01');
INSERT INTO `tbl_user` VALUES ('2', '1', 'Aditya Kurniawan', 'adyt', 'adyt', 'cok', null, null);
INSERT INTO `tbl_user` VALUES ('3', '1', 'Cahyo Sri Agus', 'cahyo', 'cahyo', 'Tidak Aktif', null, null);
INSERT INTO `tbl_user` VALUES ('4', '1', 'Alfa Yazid', 'alfayazid', 'alfayazid', 'Tidak Aktif', null, null);
INSERT INTO `tbl_user` VALUES ('5', '1', 'Coba', 'coba', 'coba', 'Tidak Aktif', null, null);
INSERT INTO `tbl_user` VALUES ('6', '1', 'cobaaa', 'cobaaa', 'cobaaaa', 'Tidak Aktif', null, null);
INSERT INTO `tbl_user` VALUES ('7', '1', '1230', 'lkdla', 'lakdlsads', 'Aktif', null, null);
INSERT INTO `tbl_user` VALUES ('8', '1', 'jancooooooook', 'gak iso iso', 'asuuu', '0', null, null);
INSERT INTO `tbl_user` VALUES ('9', '999', '999', '999', '999', '0', null, null);
