/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 100408
 Source Host           : localhost:3306
 Source Schema         : shr

 Target Server Type    : MySQL
 Target Server Version : 100408
 File Encoding         : 65001

 Date: 10/02/2021 01:14:47
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for asset
-- ----------------------------
DROP TABLE IF EXISTS `asset`;
CREATE TABLE `asset`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_category_id` int(11) NULL DEFAULT NULL,
  `number_asset` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `price_buy` double NULL DEFAULT NULL,
  `description` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `date_buy` date NULL DEFAULT NULL,
  `status_asset` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0' COMMENT '0=available,1=borrow,2=broken,3=lost',
  `path_foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `is_active` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0' COMMENT '0=not active, 1=active',
  `is_delete` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '0=not delete, 1=delete',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of asset
-- ----------------------------
INSERT INTO `asset` VALUES (6, 8, '', 'x', 0, '', '0000-00-00', '0', NULL, '1', '1');
INSERT INTO `asset` VALUES (7, 8, 'AST00001', 'HP Infinix Hot 9', 1350000, 'IME1: 358104108493428, IME2 358104108493436', '2020-01-01', '1', 'asset_7.jpg', '1', '0');
INSERT INTO `asset` VALUES (8, 8, 'AST00001', 'HP Infinix Hot 9', 1350000, 'IME1: 358104108493428, IME2 358104108493436', '2020-01-01', '1', NULL, '1', '1');
INSERT INTO `asset` VALUES (9, 8, 'AST00001', 'HP Infinix Hot 9', 1350000, 'IME1: 358104108493428, IME2 358104108493436', '2020-01-01', '1', NULL, '1', '1');
INSERT INTO `asset` VALUES (10, 7, 'AST00002', 'Lenovo Thinkpad X240', 6000000, 'Serial Number PB03118C, IMEI Laptop : 11S92P1109Z1ZBTZ74DCK9', '2020-12-01', '1', 'asset_10.png', '1', '0');

-- ----------------------------
-- Table structure for asset_borrow
-- ----------------------------
DROP TABLE IF EXISTS `asset_borrow`;
CREATE TABLE `asset_borrow`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_id` int(11) NULL DEFAULT NULL,
  `employee_id` int(11) NULL DEFAULT NULL,
  `date_borrow` date NULL DEFAULT NULL,
  `date_return` date NULL DEFAULT NULL,
  `description_borrow` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `description_return` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `is_delete` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0' COMMENT '0=not delete, 1=delete',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of asset_borrow
-- ----------------------------
INSERT INTO `asset_borrow` VALUES (15, 7, 7, '2020-01-13', '2021-02-26', 'Kondis baik tidak ada yang rusak c', 'sdfdsf', '0');
INSERT INTO `asset_borrow` VALUES (20, 10, 8, '2020-12-01', '0000-00-00', 'Semua berfungsi baik', '', '0');

-- ----------------------------
-- Table structure for asset_category
-- ----------------------------
DROP TABLE IF EXISTS `asset_category`;
CREATE TABLE `asset_category`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT ' ',
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `is_active` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT '0=not active 1=active',
  `is_delete` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0' COMMENT '0=not delete 1=delete',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of asset_category
-- ----------------------------
INSERT INTO `asset_category` VALUES (7, 'Laptop', '1', '0');
INSERT INTO `asset_category` VALUES (8, 'Hand Phone', '1', '0');
INSERT INTO `asset_category` VALUES (9, 'x', '1', '1');

-- ----------------------------
-- Table structure for company
-- ----------------------------
DROP TABLE IF EXISTS `company`;
CREATE TABLE `company`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `address` tinytext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `logo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of company
-- ----------------------------
INSERT INTO `company` VALUES (1, 'PT. MAHIRA GLOBAL NUSANTARA', 'Jl.Raya Pejuang Blok C No.680 B (Kota Bekasi)', '', 'cs@mahira.co.id', '');

-- ----------------------------
-- Table structure for const
-- ----------------------------
DROP TABLE IF EXISTS `const`;
CREATE TABLE `const`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `type` enum('1','2','3','4') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '1' COMMENT '1= Metric 2=Location 3=Tipe Concact 4=Lokasi Stock',
  `is_delete` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0' COMMENT '0 = not delete, 1 = delete',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 61 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of const
-- ----------------------------
INSERT INTO `const` VALUES (1, 'LUSIN', '1', '0');
INSERT INTO `const` VALUES (2, 'KOTAK', '1', '0');
INSERT INTO `const` VALUES (4, 'KODI', '1', '0');
INSERT INTO `const` VALUES (5, 'BUAH', '1', '0');
INSERT INTO `const` VALUES (6, 'EKOR', '1', '0');
INSERT INTO `const` VALUES (7, 'METER', '1', '0');
INSERT INTO `const` VALUES (8, 'KALENG', '1', '0');
INSERT INTO `const` VALUES (9, 'RIM', '1', '0');
INSERT INTO `const` VALUES (10, 'KEPING', '1', '0');
INSERT INTO `const` VALUES (19, 'BIJI', '1', '0');
INSERT INTO `const` VALUES (20, 'SET', '1', '0');
INSERT INTO `const` VALUES (21, 'BUKU', '1', '0');
INSERT INTO `const` VALUES (22, 'DUS ', '1', '0');
INSERT INTO `const` VALUES (23, 'PCS', '1', '0');
INSERT INTO `const` VALUES (24, 'LITER', '1', '0');
INSERT INTO `const` VALUES (25, 'ROL', '1', '0');
INSERT INTO `const` VALUES (26, 'PAK', '1', '0');
INSERT INTO `const` VALUES (27, 'UNIT', '1', '0');
INSERT INTO `const` VALUES (28, 'BOTOL', '1', '0');
INSERT INTO `const` VALUES (29, 'IKAT', '1', '0');
INSERT INTO `const` VALUES (30, 'BOX', '1', '0');
INSERT INTO `const` VALUES (31, 'KG', '1', '0');
INSERT INTO `const` VALUES (32, 'LEBAR', '1', '1');
INSERT INTO `const` VALUES (33, 'BUNGKUS', '1', '0');
INSERT INTO `const` VALUES (34, 'LEMBAR', '1', '0');
INSERT INTO `const` VALUES (35, 'PLANO', '1', '0');
INSERT INTO `const` VALUES (36, '1/4 KG', '1', '0');
INSERT INTO `const` VALUES (37, 'LEMPENG', '1', '0');
INSERT INTO `const` VALUES (38, '1/2 KG', '1', '0');
INSERT INTO `const` VALUES (39, 'GULUNG', '1', '0');
INSERT INTO `const` VALUES (40, 'GALON', '1', '0');
INSERT INTO `const` VALUES (41, 'BATANG', '1', '0');
INSERT INTO `const` VALUES (42, 'BAL', '1', '0');
INSERT INTO `const` VALUES (43, 'COPY', '1', '0');
INSERT INTO `const` VALUES (44, 'JAM', '1', '0');
INSERT INTO `const` VALUES (45, 'PHOTO', '1', '0');
INSERT INTO `const` VALUES (46, 'PAKET', '1', '0');
INSERT INTO `const` VALUES (47, 'SMS', '3', '0');
INSERT INTO `const` VALUES (48, 'WA', '3', '0');
INSERT INTO `const` VALUES (49, 'TELEPON', '3', '0');
INSERT INTO `const` VALUES (50, 'EMAIL', '3', '0');
INSERT INTO `const` VALUES (51, 'WEB', '3', '0');
INSERT INTO `const` VALUES (52, 'IG', '3', '0');
INSERT INTO `const` VALUES (53, 'FACEBOOK', '3', '0');
INSERT INTO `const` VALUES (54, 'TOKO', '3', '0');
INSERT INTO `const` VALUES (56, 'KARDUS', '4', '0');
INSERT INTO `const` VALUES (57, 'RAK', '4', '0');
INSERT INTO `const` VALUES (58, 'PESANAN', '4', '0');
INSERT INTO `const` VALUES (59, 'TOKO', '4', '0');
INSERT INTO `const` VALUES (60, 'aa xyy', '1', '1');

-- ----------------------------
-- Table structure for departement
-- ----------------------------
DROP TABLE IF EXISTS `departement`;
CREATE TABLE `departement`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT ' ',
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `is_active` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT '0=not active 1=active',
  `is_delete` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0' COMMENT '0=not delete 1=delete',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of departement
-- ----------------------------
INSERT INTO `departement` VALUES (1, 'Marketing', '1', '0');
INSERT INTO `departement` VALUES (2, 'Operasional', '1', '0');
INSERT INTO `departement` VALUES (3, 'produksi 2 xx', '0', '1');
INSERT INTO `departement` VALUES (4, 'Penjahit', '1', '1');
INSERT INTO `departement` VALUES (5, 'Keuangan', '1', '0');
INSERT INTO `departement` VALUES (6, 'Legal dan HR', '1', '0');

-- ----------------------------
-- Table structure for employee
-- ----------------------------
DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `departement_id` int(11) NULL DEFAULT NULL,
  `employee_position_id` int(11) NULL DEFAULT NULL,
  `employee_status_id` int(11) NULL DEFAULT NULL,
  `number_identify` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status_marriage` enum('0','1','2','3') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT '0=belum menikah\r\n1=sudah meningkah\r\n2=duda\r\n3=janda\r\n',
  `religion` enum('0','1','2','3','4','5','6') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0' COMMENT '0=islam\r\n1=kristen\r\n2=katolik\r\n3=hindu\r\n4=budha\r\n5=konghucu\r\n6=lainya',
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nick_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `gander` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT '0=wanita, 1=pria',
  `date_birthday` date NULL DEFAULT NULL,
  `date_place` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_start_work` date NULL DEFAULT NULL,
  `ktp` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `npwp` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `education` enum('0','1','2','3','4','5','6','7') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT '0=sd, 1=smp, 2=sma, 3=Diploma 1, 4=Diploma 3, 5=Sarjana, 6=Magister, 7-Doktor ',
  `bpjs_kesehatan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `bpjs_tenaga_kerja` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `address` tinytext CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `bank_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `bank_account_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `bank_account_number` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `path_foto` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `is_active` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT '0=not active\r\n1=active',
  `is_delete` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0' COMMENT '0=not delete 1=delete',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 39 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of employee
-- ----------------------------
INSERT INTO `employee` VALUES (7, 1, 1, 7, 'MGN001', '0', '0', 'Adristi Ardelia Hanifah', 'Isti', '0', '2001-07-15', 'Jakarta', '2020-01-01', '3275115507010010', '', '2', '', '', '', '', 'Bekasi timur regensi Blok E8 No.36', 'BRI', 'Adristi Ardelia Hanifah', '791001009245534', NULL, '1', '0');
INSERT INTO `employee` VALUES (8, 1, 1, 7, 'MGN002', '0', '1', 'Angel Gunawan', 'Angel', '0', '2002-02-20', 'Jakarta,', '2020-01-12', '3275066206020009', '', '2', '', '', '', '', '', 'BCA', 'Angel Gunawan', '7410859968', NULL, '1', '0');
INSERT INTO `employee` VALUES (9, 6, 3, 7, 'MGN003', '0', '0', 'Antonius Sharen Tiboth', 'Antonius Sharen Tiboth', '1', '1994-04-24', 'Magelang', '0000-00-00', '3275062404940016', '', '5', '', '', '081296269292', 'antonysharen2@gmail.com', 'Taman Harapan Baru Blok  D3 No.7', 'MANDIRI', '1560012972669', 'Antonius Sharen Tiboth', 'employee_9.png', '1', '0');

-- ----------------------------
-- Table structure for employee_position
-- ----------------------------
DROP TABLE IF EXISTS `employee_position`;
CREATE TABLE `employee_position`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT ' ',
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `is_active` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT '0=not active 1=active',
  `is_fix` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT '0=tidak fix, 1=tidak bis dihapus',
  `is_delete` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0' COMMENT '0=not delete 1=delete',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of employee_position
-- ----------------------------
INSERT INTO `employee_position` VALUES (1, 'Acs', '1', '0', '0');
INSERT INTO `employee_position` VALUES (2, 'Admin Sosmed', '1', '0', '0');
INSERT INTO `employee_position` VALUES (3, 'Staff', '1', '0', '0');
INSERT INTO `employee_position` VALUES (5, 'Supervisor', '1', '0', '0');
INSERT INTO `employee_position` VALUES (6, 'Advertiser', '1', '0', '0');

-- ----------------------------
-- Table structure for employee_relation_sbiz_user
-- ----------------------------
DROP TABLE IF EXISTS `employee_relation_sbiz_user`;
CREATE TABLE `employee_relation_sbiz_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NULL DEFAULT NULL,
  `sbiz_user_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for employee_status
-- ----------------------------
DROP TABLE IF EXISTS `employee_status`;
CREATE TABLE `employee_status`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT ' ',
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `is_active` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT '0=not active 1=active',
  `is_fix` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT '0=tidak fix, 1=tidak bis dihapus',
  `is_delete` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0' COMMENT '0=not delete 1=delete',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of employee_status
-- ----------------------------
INSERT INTO `employee_status` VALUES (7, 'Kontrak', '1', '0', '0');
INSERT INTO `employee_status` VALUES (8, 'Tetap', '1', '0', '0');
INSERT INTO `employee_status` VALUES (9, 'Magang', '1', '0', '0');
INSERT INTO `employee_status` VALUES (10, 'Profesional Hire', '1', '0', '0');
INSERT INTO `employee_status` VALUES (11, 'xc', '1', '0', '1');

-- ----------------------------
-- Table structure for member
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `employee_id` int(11) NOT NULL,
  `member_access_id` int(11) NOT NULL,
  `is_enabled` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of member
-- ----------------------------
INSERT INTO `member` VALUES (1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 0, 1, '1');

-- ----------------------------
-- Table structure for payroll_month_component
-- ----------------------------
DROP TABLE IF EXISTS `payroll_month_component`;
CREATE TABLE `payroll_month_component`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `type` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0' COMMENT '0=componet out, 1=component in',
  `is_delete` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0' COMMENT '0=not delete,1=delete',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of payroll_month_component
-- ----------------------------
INSERT INTO `payroll_month_component` VALUES (16, 'Gaji Pokok', '1', '0');
INSERT INTO `payroll_month_component` VALUES (17, 'Tunjangan Operasional', '1', '0');
INSERT INTO `payroll_month_component` VALUES (18, 'Komisi', '1', '0');
INSERT INTO `payroll_month_component` VALUES (19, 'Bonus', '1', '0');
INSERT INTO `payroll_month_component` VALUES (20, 'Lembur', '1', '0');
INSERT INTO `payroll_month_component` VALUES (21, 'Tunjangan Pulsa', '1', '0');
INSERT INTO `payroll_month_component` VALUES (22, 'Tidak Hadir', '0', '0');
INSERT INTO `payroll_month_component` VALUES (23, 'PPH 21', '0', '0');
INSERT INTO `payroll_month_component` VALUES (24, 'BPJS Kesehatan', '0', '0');
INSERT INTO `payroll_month_component` VALUES (25, 'BPJS Tenaga Kerja', '0', '0');
INSERT INTO `payroll_month_component` VALUES (26, 'Pinjaman', '0', '0');
INSERT INTO `payroll_month_component` VALUES (27, 'x', '0', '1');

-- ----------------------------
-- Table structure for payroll_month_list
-- ----------------------------
DROP TABLE IF EXISTS `payroll_month_list`;
CREATE TABLE `payroll_month_list`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `payroll_month_component_id` int(11) NOT NULL,
  `default_val` double NOT NULL,
  `type` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '1' COMMENT '0=perhari,1=perbulan',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 331 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of payroll_month_list
-- ----------------------------
INSERT INTO `payroll_month_list` VALUES (309, 9, 19, 0, '1');
INSERT INTO `payroll_month_list` VALUES (310, 9, 16, 2000000, '1');
INSERT INTO `payroll_month_list` VALUES (311, 9, 18, 0, '1');
INSERT INTO `payroll_month_list` VALUES (312, 9, 20, 0, '1');
INSERT INTO `payroll_month_list` VALUES (313, 9, 17, 50000, '1');
INSERT INTO `payroll_month_list` VALUES (314, 9, 21, 0, '1');
INSERT INTO `payroll_month_list` VALUES (315, 9, 24, 0, '1');
INSERT INTO `payroll_month_list` VALUES (316, 9, 25, 0, '1');
INSERT INTO `payroll_month_list` VALUES (317, 9, 26, 0, '1');
INSERT INTO `payroll_month_list` VALUES (318, 9, 23, 0, '1');
INSERT INTO `payroll_month_list` VALUES (319, 9, 22, 10000, '0');
INSERT INTO `payroll_month_list` VALUES (320, 7, 19, 0, '1');
INSERT INTO `payroll_month_list` VALUES (321, 7, 16, 500000, '1');
INSERT INTO `payroll_month_list` VALUES (322, 7, 18, 0, '1');
INSERT INTO `payroll_month_list` VALUES (323, 7, 20, 0, '1');
INSERT INTO `payroll_month_list` VALUES (324, 7, 17, 30000, '1');
INSERT INTO `payroll_month_list` VALUES (325, 7, 21, 0, '1');
INSERT INTO `payroll_month_list` VALUES (326, 7, 24, 0, '1');
INSERT INTO `payroll_month_list` VALUES (327, 7, 25, 0, '1');
INSERT INTO `payroll_month_list` VALUES (328, 7, 26, 0, '1');
INSERT INTO `payroll_month_list` VALUES (329, 7, 23, 0, '1');
INSERT INTO `payroll_month_list` VALUES (330, 7, 22, 10000, '0');

-- ----------------------------
-- Table structure for payroll_month_payment
-- ----------------------------
DROP TABLE IF EXISTS `payroll_month_payment`;
CREATE TABLE `payroll_month_payment`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `number_payroll` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `employee_departement_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `employee_position_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `employee_number_identity` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `employee_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `gander` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `total_in` double NOT NULL,
  `total_out` double NOT NULL,
  `pay_to` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `date_payment` date NOT NULL,
  `is_delete` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0' COMMENT '0=not delete,1=delete',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for payroll_month_payment_detail
-- ----------------------------
DROP TABLE IF EXISTS `payroll_month_payment_detail`;
CREATE TABLE `payroll_month_payment_detail`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payroll_month_payment_id` int(11) NOT NULL,
  `payroll_month_component_id` int(11) NOT NULL,
  `payroll_month_component_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `type_component` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT '0=componet out, 1=component in',
  `type` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0' COMMENT '0=perhari 1=perbulan',
  `amount_day` int(11) NOT NULL,
  `val_day` double NOT NULL,
  `val_total` double NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 554 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
