/*
 Navicat Premium Data Transfer

 Source Server         : bondan
 Source Server Type    : MariaDB
 Source Server Version : 100408
 Source Host           : localhost:3306
 Source Schema         : db_media

 Target Server Type    : MariaDB
 Target Server Version : 100408
 File Encoding         : 65001

 Date: 06/06/2020 00:47:10
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tb_berita
-- ----------------------------
DROP TABLE IF EXISTS `tb_berita`;
CREATE TABLE `tb_berita`  (
  `id` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `media_massa_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `judul_berita` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `narasi_berita` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `link_berita` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `screenshoot` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `share` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `jumlah_view` int(11) NOT NULL,
  `status_berita` enum('menunggu','oke','valid') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `keterangan` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `dibuat_oleh` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `dibuat_tanggal` date NOT NULL,
  `dibuat_pukul` time(0) NOT NULL,
  `diperiksa_oleh` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `diperiksa_pada` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id`(`id`, `media_massa_id`, `judul_berita`, `status_berita`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
