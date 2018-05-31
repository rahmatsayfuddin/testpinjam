/*
Navicat MySQL Data Transfer

Source Server         : Local
Source Server Version : 100125
Source Host           : localhost:3306
Source Database       : testing

Target Server Type    : MYSQL
Target Server Version : 100125
File Encoding         : 65001

Date: 2018-05-31 16:39:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for detail_transaksi
-- ----------------------------
DROP TABLE IF EXISTS `detail_transaksi`;
CREATE TABLE `detail_transaksi` (
  `id_transaksi` varchar(40) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `jumlah_barang` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of detail_transaksi
-- ----------------------------
INSERT INTO `detail_transaksi` VALUES ('1527645298', '1', '5', '2000', '1');
INSERT INTO `detail_transaksi` VALUES ('1527645444', '1', '1', '1000', '3');
INSERT INTO `detail_transaksi` VALUES ('1527645444', '2', '3', '2000', '4');

-- ----------------------------
-- Table structure for master
-- ----------------------------
DROP TABLE IF EXISTS `master`;
CREATE TABLE `master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(255) NOT NULL,
  `stock` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`nama_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of master
-- ----------------------------
INSERT INTO `master` VALUES ('1', 'indomi', '5');
INSERT INTO `master` VALUES ('2', 'sabun', '10');

-- ----------------------------
-- Table structure for transaksi
-- ----------------------------
DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi` (
  `id_transaksi` varchar(40) DEFAULT NULL,
  `total_amount` float DEFAULT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `nama_pelanggan` varchar(255) DEFAULT NULL,
  `status` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of transaksi
-- ----------------------------
INSERT INTO `transaksi` VALUES ('1527645298', '10000', '2018-05-30', 'Rahmat', 'true');
INSERT INTO `transaksi` VALUES ('1527645444', '7000', '2018-05-30', 'sayfuddin', 'false');

-- ----------------------------
-- View structure for v_detail_transaksi
-- ----------------------------
DROP VIEW IF EXISTS `v_detail_transaksi`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_detail_transaksi` AS SELECT
a.id_transaksi,
a.id_barang,
a.jumlah_barang,
a.id,
a.harga,
b.nama_barang,
b.stock
from detail_transaksi a INNER JOIN `master` b on a.id_barang=b.id ;
