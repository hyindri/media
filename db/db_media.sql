/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 100411
 Source Host           : localhost:3306
 Source Schema         : db_media

 Target Server Type    : MySQL
 Target Server Version : 100411
 File Encoding         : 65001

 Date: 04/06/2020 10:38:32
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tb_agenda
-- ----------------------------
DROP TABLE IF EXISTS `tb_agenda`;
CREATE TABLE `tb_agenda`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `status` enum('aktif','nonaktif') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `file` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `dibuat_oleh` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dibuat_pada` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_berita
-- ----------------------------
DROP TABLE IF EXISTS `tb_berita`;
CREATE TABLE `tb_berita`  (
  `id` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `media_massa_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `link_berita` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `screenshoot` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `share` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `jumlah_view` int(11) NOT NULL,
  `status_berita` enum('oke','belum') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `keterangan` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `dibuat_oleh` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `dibuat_tanggal` date NOT NULL,
  `dibuat_pukul` time(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_berita
-- ----------------------------
INSERT INTO `tb_berita` VALUES ('5ece4797eaf5e', '5ed86c6ba5cf3', 'https://www.suara.com/tag/bintan', 'ss.jpg', 'Share Test', 20, 'oke', '', 'Media Satu', '2020-06-04', '01:41:17');

-- ----------------------------
-- Table structure for tb_log
-- ----------------------------
DROP TABLE IF EXISTS `tb_log`;
CREATE TABLE `tb_log`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aktivitas` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `oleh` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pada` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tmst_media_massa
-- ----------------------------
DROP TABLE IF EXISTS `tmst_media_massa`;
CREATE TABLE `tmst_media_massa`  (
  `id` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `perusahaan` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `npwp` char(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `rekening` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pimpinan` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `kabiro` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `surat_kabiro` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `no_telp` varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `wartawan` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sertifikat_uji` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `verifikasi_pers` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `penawaran_kerja_sama` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `tipe_publikasi` enum('harian','mingguan','bulanan') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tipe_media_massa` enum('cetak','online','cetak dan online') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `mulai_mou` date NOT NULL,
  `akhir_mou` date NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `pk_media_user`(`user_id`) USING BTREE,
  CONSTRAINT `pk_media_user` FOREIGN KEY (`user_id`) REFERENCES `tmst_user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tmst_media_massa
-- ----------------------------
INSERT INTO `tmst_media_massa` VALUES ('5ed86c6ba5cf3', 2, 'Media satu', 'Perusahaan Test', 'Alamat Test', '123456789123456', '0222-201002', 'Pemimpin Test', 'Kabiro Test', 'Surat Kabiro Test', '0812314151', 'Wartawan Test', 'Sertifikat Test', 'Verifikasi Test', 'Penawaran Test', 'harian', 'cetak', '2020-06-01', '2020-06-30');

-- ----------------------------
-- Table structure for tmst_setting
-- ----------------------------
DROP TABLE IF EXISTS `tmst_setting`;
CREATE TABLE `tmst_setting`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `waktu` time(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tmst_setting
-- ----------------------------
INSERT INTO `tmst_setting` VALUES (1, '12:23:00');

-- ----------------------------
-- Table structure for tmst_user
-- ----------------------------
DROP TABLE IF EXISTS `tmst_user`;
CREATE TABLE `tmst_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `level` enum('superadmin','admin','user') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dibuat_pada` datetime(0) NULL DEFAULT NULL,
  `status` enum('aktif','registrasi','suspend') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tmst_user
-- ----------------------------
INSERT INTO `tmst_user` VALUES (1, 'Admin', '$2y$10$Q8ub.ipbt9w0HSov64BrX.3pA8FzWFu7glSehtEhBTs7t7tHuOcCy', 'admin', '2020-06-03 14:09:45', 'aktif');
INSERT INTO `tmst_user` VALUES (2, 'Media_satu', '$2y$10$Q8ub.ipbt9w0HSov64BrX.3pA8FzWFu7glSehtEhBTs7t7tHuOcCy', 'user', '2020-06-05 01:36:01', 'aktif');

SET FOREIGN_KEY_CHECKS = 1;
