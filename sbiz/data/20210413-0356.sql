/*
 Navicat Premium Data Transfer

 Source Server         : SBIZ Mahira
 Source Server Type    : MySQL
 Source Server Version : 50733
 Source Host           : 203.161.184.58:3306
 Source Schema         : shopilli_shr_mahira

 Target Server Type    : MySQL
 Target Server Version : 50733
 File Encoding         : 65001

 Date: 13/03/2021 03:56:13
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
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of asset
-- ----------------------------
INSERT INTO `asset` VALUES (6, 8, '', 'x', 0, '', '0000-00-00', '0', NULL, '1', '1');
INSERT INTO `asset` VALUES (7, 8, 'AST00001', 'HP Infinix Hot 9', 1350000, 'IME1: 358104108493428, IME2 358104108493436', '2020-01-01', '1', 'asset_7.jpg', '1', '0');
INSERT INTO `asset` VALUES (8, 8, 'AST00001', 'HP Infinix Hot 9', 1350000, 'IME1: 358104108493428, IME2 358104108493436', '2020-01-01', '1', NULL, '1', '1');
INSERT INTO `asset` VALUES (9, 8, 'AST00001', 'HP Infinix Hot 9', 1350000, 'IME1: 358104108493428, IME2 358104108493436', '2020-01-01', '1', NULL, '1', '1');
INSERT INTO `asset` VALUES (10, 7, 'AST00002', 'Lenovo Thinkpad X240', 6000000, 'Serial Number PB03118C, IMEI Laptop : 11S92P1109Z1ZBTZ74DCK9', '2020-12-01', '1', 'asset_10.png', '1', '0');
INSERT INTO `asset` VALUES (11, 8, 'xx', 'x', 0, '', '0000-00-00', '0', 'asset_11.png', '1', '1');
INSERT INTO `asset` VALUES (12, 8, 'xx', 'sd', 0, '', '0000-00-00', '0', 'asset_12.png', '1', '1');

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
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of asset_borrow
-- ----------------------------
INSERT INTO `asset_borrow` VALUES (20, 10, 8, '2020-12-01', '0000-00-00', 'Semua berfungsi baik', '', '0');
INSERT INTO `asset_borrow` VALUES (22, 7, 7, '2020-01-13', '2021-02-26', 'Kondis baik tidak ada yang rusak', 'sdfdsf', '0');

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
INSERT INTO `company` VALUES (1, 'PT. MAHIRA GLOBAL NUSANTARA', 'Jl.Raya Pejuang Blok C No.680 B (Kota Bekasi)', '021-88388161', 'mahiraworkshop@gmail.com', 'logo_company.png');

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
INSERT INTO `departement` VALUES (6, 'Legal &amp; HRGA', '1', '0');
INSERT INTO `departement` VALUES (7, 'Creative', '1', '0');

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
) ENGINE = InnoDB AUTO_INCREMENT = 52 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of employee
-- ----------------------------
INSERT INTO `employee` VALUES (7, 1, 1, 7, 'MGN001', '0', '0', 'Adristi Ardelia Hanifah', 'Isti', '0', '2001-07-15', 'Jakarta', '2020-01-06', '3275115507010010', '', '2', '', '', '085780138015', 'adristiardelia15@gmail.com', 'Bekasi Timur Regensi Blok E8 No.36', 'BRI', 'Adristi Ardelia Hanifah', '791001009245534', '', '1', '0');
INSERT INTO `employee` VALUES (8, 7, 2, 7, 'MGN002', '0', '1', 'Angel Gunawan', 'Angel', '0', '2002-02-20', 'Jakarta,', '2020-01-12', '3275066206020009', '', '2', '', '', '081317176221', '', 'Jl. Mawar Indah Blok CH/ No.5', 'BCA', '7410859968', 'Angel Gunawan', NULL, '1', '0');
INSERT INTO `employee` VALUES (9, 6, 3, 7, 'MGN003', '0', '2', 'Antonius Sharen Tiboth', 'Anton', '1', '1994-04-24', 'Magelang', '2020-06-22', '3275062404940016', '', '5', '', '', '081296269292', 'antonysharen2@gmail.com', 'Taman Harapan Baru Blok  D3 No.7', 'MANDIRI', '1560012972669', 'Antonius Sharen Tiboth', 'employee_9.png', '1', '0');
INSERT INTO `employee` VALUES (39, 5, 1, 7, 'x', '0', '0', 'dd', '', '1', '0000-00-00', '', '0000-00-00', '', '', '0', '', '', '', '', '', '', '', '', '', '1', '1');
INSERT INTO `employee` VALUES (40, 7, 8, 7, 'MGN014', '0', '0', 'Agnes Sarila Wiridhani', 'Agnes', '0', '1998-06-08', 'Depok', '2021-02-01', '3276064806980003', 'None', '5', '', '', '085773784382', 'agnes.sw080698@gmail.com', 'Jl. Turi III, Kota Depok', 'BNI', 'Agnes Sarila Wiridhani', '0535024977', NULL, '1', '0');
INSERT INTO `employee` VALUES (41, 1, 5, 7, 'MGN005', '0', '0', 'Dian Kuspriyantini', 'Dian', '0', '1994-12-20', 'Karang Anyar', '0000-00-00', '3216016012940004', '', '2', '', '', '08998709442', '', 'Peru Puri Harapan Blok B No.3/14', 'MANDIRI', 'Dian Kuspriyantini', '1560010161372', NULL, '1', '0');
INSERT INTO `employee` VALUES (42, 1, 1, 7, 'MGN006', '0', '0', 'Dina Badriyanti', 'Dina', '0', '1999-12-30', 'Jakarta', '2020-06-22', '3171087012990002', '', '2', '', '', '', '', 'KP Pedurenan', 'BCA', '6331074141', 'Dina Badriyanti', NULL, '1', '0');
INSERT INTO `employee` VALUES (43, 1, 9, 7, 'MGN007', '0', '0', 'Endang Pratiwi', 'Endang', '0', '1997-05-01', 'Bekasi', '2020-06-22', '3275034105970023', '', '5', '', '', '', '', 'Jl. Swadaya II', 'MANDIRI', '1560015531504', 'Endang Pratiwi', NULL, '1', '0');
INSERT INTO `employee` VALUES (44, 5, 6, 7, 'MGN008', '0', '0', 'Muhammad Fajar Zulio', 'Fajar', '1', '2002-07-30', 'Bekasi', '2020-11-02', '3216053007020010', '', '2', '', '', '085770549878', '', 'Vila Mutiara Gading 2 Blok X 15 No.12', 'BCA', 'Ani  Darmini', '61155654', NULL, '1', '0');
INSERT INTO `employee` VALUES (45, 1, 1, 7, 'MGN009', '0', '0', 'Intan Kamildra', 'Intan', '0', '2000-03-06', 'Jakarta', '2020-08-21', '3174034603000002', '', '2', '', '', '081317105466', '', 'Jl. Bintara IX No.147', 'BCA', 'Intan Kamildra', '6630707526', NULL, '1', '0');
INSERT INTO `employee` VALUES (46, 1, 1, 7, 'MGN010', '0', '0', 'Irmawati', 'Irma', '0', '2000-01-24', 'Bekasi', '0000-00-00', '3275066401000008', '', '2', '', '', '', '', 'Jl. Kali Abang Bungur', 'BCA', 'Irmawati', '5211320282', NULL, '1', '0');
INSERT INTO `employee` VALUES (47, 1, 10, 7, 'MGN011', '0', '0', 'Nabila Ayu Eka Suci', 'Ayu', '0', '2001-06-26', 'Jakarta', '2020-01-06', '3275036606010035', '95.818.443.4-407.000', '2', '', '', '', '', 'Jl. Alia I Kav Bulak Sentul', 'BCA', 'Nabila Ayu Eka Suci', '5211364361', NULL, '1', '0');
INSERT INTO `employee` VALUES (48, 2, 14, 7, 'MGN012', '0', '0', 'Pramudya Hernowo', 'Aan', '1', '1999-12-01', 'Jakarta', '2020-01-06', '317506112990009', 'None', '2', '', '', '088290221877', '', 'KP Pedurenan', 'BCA', 'Pramudya Hernowo', '2750494865', NULL, '1', '0');
INSERT INTO `employee` VALUES (49, 2, 15, 7, 'MGN013', '0', '0', 'Septia Chika Nurul Kamila', 'Chika', '0', '2000-09-05', 'Bekasi', '2021-01-04', '3275024509000008', 'None', '2', '', '', '087890003702', '', 'Rawa Bebek', 'BCA', 'Septia Chika Nurul Kamila', '920101755', NULL, '1', '0');
INSERT INTO `employee` VALUES (50, 7, 13, 7, 'MGN015', '0', '0', 'Rohmat Subekhan', 'Han', '1', '1996-08-28', 'Bekasi', '2021-02-03', '3275042908960016', 'None', '2', '', '', '081283538253', 'Han.fseie@email.com', 'Taman Vila Baru Blok C3', 'BCA', 'Rohmat Subekhan', '7391349979', NULL, '1', '0');
INSERT INTO `employee` VALUES (51, 7, 11, 7, 'MGN016', '0', '0', 'Nabilah Muthmainnah Qurani', 'Bilah', '0', '1993-06-20', 'Bekasi', '2021-02-09', '3275096006930026', '', '4', '', '', '089504158441', 'nabilah.mq@gmail.com', 'Jl. Teratai VIII No.167', 'BNI Syariah', '0538545976', 'Nabilah Muthmainnah Qur\'ani', NULL, '1', '0');

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
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of employee_position
-- ----------------------------
INSERT INTO `employee_position` VALUES (1, 'Admin Customer Sales (ACS)', '1', '0', '0');
INSERT INTO `employee_position` VALUES (2, 'Social Media Strategist', '1', '0', '0');
INSERT INTO `employee_position` VALUES (3, 'Staff', '1', '0', '0');
INSERT INTO `employee_position` VALUES (5, 'Supervisor', '1', '0', '0');
INSERT INTO `employee_position` VALUES (6, 'Riset &amp; Admin Keuangan', '1', '0', '0');
INSERT INTO `employee_position` VALUES (7, 'Jurnalis Editor', '1', '0', '1');
INSERT INTO `employee_position` VALUES (8, 'Jurnalis Editor', '1', '0', '0');
INSERT INTO `employee_position` VALUES (9, 'Admin Project', '1', '0', '0');
INSERT INTO `employee_position` VALUES (10, 'ACS Marketplace', '1', '0', '0');
INSERT INTO `employee_position` VALUES (11, 'Product &amp; Grafis Designer', '1', '0', '0');
INSERT INTO `employee_position` VALUES (12, 'Breast-feed Consultant &amp; Parenting', '1', '0', '0');
INSERT INTO `employee_position` VALUES (13, 'Videografer', '1', '0', '0');
INSERT INTO `employee_position` VALUES (14, 'Operational Packing', '1', '0', '0');
INSERT INTO `employee_position` VALUES (15, 'Admin Operational', '1', '0', '0');

-- ----------------------------
-- Table structure for employee_relation_sbiz_user
-- ----------------------------
DROP TABLE IF EXISTS `employee_relation_sbiz_user`;
CREATE TABLE `employee_relation_sbiz_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NULL DEFAULT NULL,
  `sbiz_user_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 40 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of employee_relation_sbiz_user
-- ----------------------------
INSERT INTO `employee_relation_sbiz_user` VALUES (36, 9, 43);
INSERT INTO `employee_relation_sbiz_user` VALUES (38, 7, 64);
INSERT INTO `employee_relation_sbiz_user` VALUES (39, 7, 23);

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
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of employee_status
-- ----------------------------
INSERT INTO `employee_status` VALUES (7, 'Kontrak', '1', '0', '0');
INSERT INTO `employee_status` VALUES (8, 'Tetap', '1', '0', '0');
INSERT INTO `employee_status` VALUES (9, 'Magang', '1', '0', '0');
INSERT INTO `employee_status` VALUES (10, 'Profesional Hire', '1', '0', '0');
INSERT INTO `employee_status` VALUES (11, 'xc', '1', '0', '1');
INSERT INTO `employee_status` VALUES (12, 'Probation', '1', '0', '0');

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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of member
-- ----------------------------
INSERT INTO `member` VALUES (1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 0, 1, '1');

-- ----------------------------
-- Table structure for payroll_insentif_payment
-- ----------------------------
DROP TABLE IF EXISTS `payroll_insentif_payment`;
CREATE TABLE `payroll_insentif_payment`  (
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
  `date_fee_sales_start` date NULL DEFAULT NULL,
  `date_fee_sales_end` date NULL DEFAULT NULL,
  `is_pay` enum('0','1','2') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0' COMMENT '0=not pay, 1=allready pay transfer, 2=1=allready pay cash',
  `date_payment` date NOT NULL,
  `is_delete` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0' COMMENT '0=not delete,1=delete',
  `date_create` datetime(0) NULL DEFAULT NULL,
  `date_lastupdate` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of payroll_insentif_payment
-- ----------------------------
INSERT INTO `payroll_insentif_payment` VALUES (1, 7, 'IF210000001', 'MARKETING', 'ADMIN CUSTOMER SALES (ACS)', 'MGN001', 'Adristi Ardelia Hanifah', 'Wanita', 2021, 2, 0, 0, '', '2021-01-16', '2021-02-15', '0', '2021-02-18', '1', '2021-02-21 22:03:54', NULL);
INSERT INTO `payroll_insentif_payment` VALUES (2, 7, 'IF210000002', 'MARKETING', 'ADMIN CUSTOMER SALES (ACS)', 'MGN001', 'Adristi Ardelia Hanifah', 'Wanita', 2021, 2, 2442000, 0, 'BRI an. Adristi Ardelia Hanifah / 791001009245534', '2021-01-16', '2021-02-15', '1', '2021-02-17', '0', '2021-02-21 22:10:16', '2021-02-21 22:29:01');
INSERT INTO `payroll_insentif_payment` VALUES (3, 0, 'IF210000003', '', '', '', '', '', 2021, 2, 0, 0, '', '2021-01-16', '2021-02-15', '0', '2021-02-16', '1', '2021-03-02 17:45:36', NULL);
INSERT INTO `payroll_insentif_payment` VALUES (4, 0, 'IF210000004', '', '', '', '', '', 2021, 3, 0, 0, '', '2021-03-02', '2021-03-02', '0', '2021-03-02', '1', '2021-03-02 17:47:48', NULL);

-- ----------------------------
-- Table structure for payroll_insentif_payment_detail
-- ----------------------------
DROP TABLE IF EXISTS `payroll_insentif_payment_detail`;
CREATE TABLE `payroll_insentif_payment_detail`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payroll_insentif_payment_id` int(11) NOT NULL,
  `sbiz_username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `payroll_stuff_id` int(11) NOT NULL,
  `payroll_stuff_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `qty` double NOT NULL,
  `fee` double NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 51 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of payroll_insentif_payment_detail
-- ----------------------------
INSERT INTO `payroll_insentif_payment_detail` VALUES (26, 2, 'isti <sup>(Busui Sehat (Isti))</sup>', 62, '(. PAKET GOLD) 2 ALMOON PLUS 2 RED GINGER }}', 2, 16000);
INSERT INTO `payroll_insentif_payment_detail` VALUES (27, 2, 'isti <sup>(Busui Sehat (Isti))</sup>', 64, '(. SUPER BOOSTER PAKET 4 BOX) 4 ALMOON PLUS 1 POUCH RED GINGER }}', 6, 90000);
INSERT INTO `payroll_insentif_payment_detail` VALUES (28, 2, 'isti <sup>(Busui Sehat (Isti))</sup>', 133, '(..FREE 10 PCS Kantong ASI }}', 8, 0);
INSERT INTO `payroll_insentif_payment_detail` VALUES (29, 2, 'isti <sup>(Busui Sehat (Isti))</sup>', 132, '(..FREE 5 PCS Kantong ASI }}', 31, 0);
INSERT INTO `payroll_insentif_payment_detail` VALUES (30, 2, 'isti <sup>(Busui Sehat (Isti))</sup>', 63, '(.BOOSTER PAKET PLATINUM) 3 ALMOON PLUS 3 RED GINGER }}', 4, 48000);
INSERT INTO `payroll_insentif_payment_detail` VALUES (31, 2, 'isti <sup>(Busui Sehat (Isti))</sup>', 137, '(.GUDANG YUBI DEPOK) ALMOON PLUS 200gram Rasa Cokelat }}', 25, 100000);
INSERT INTO `payroll_insentif_payment_detail` VALUES (32, 2, 'isti <sup>(Busui Sehat (Isti))</sup>', 138, '(.GUDANG YUBI DEPOK) ALMOON PLUS 200gram Rasa ORIGINAL }}', 15, 60000);
INSERT INTO `payroll_insentif_payment_detail` VALUES (33, 2, 'isti <sup>(Busui Sehat (Isti))</sup>', 139, '(.GUDANG YUBI DEPOK) ALMOON PLUS 200gram Rasa STRAWBERRY }}', 4, 16000);
INSERT INTO `payroll_insentif_payment_detail` VALUES (34, 2, 'isti <sup>(Busui Sehat (Isti))</sup>', 148, '(.GUDANG YUBI DEPOK) RED GINGER 180 GRAM }}', 34, 68000);
INSERT INTO `payroll_insentif_payment_detail` VALUES (35, 2, 'isti <sup>(Busui Sehat (Isti))</sup>', 142, '(.GUDANG YUBI MEDAN) ALMOON PLUS 200gram Rasa COKELAT }}', 11, 44000);
INSERT INTO `payroll_insentif_payment_detail` VALUES (36, 2, 'isti <sup>(Busui Sehat (Isti))</sup>', 141, '(.GUDANG YUBI MEDAN) ALMOON PLUS 200gram Rasa ORIGINAL }}', 23, 92000);
INSERT INTO `payroll_insentif_payment_detail` VALUES (37, 2, 'isti <sup>(Busui Sehat (Isti))</sup>', 140, '(.GUDANG YUBI MEDAN) ALMOON PLUS 200gram Rasa STRAWBERRY }}', 2, 8000);
INSERT INTO `payroll_insentif_payment_detail` VALUES (38, 2, 'isti <sup>(Busui Sehat (Isti))</sup>', 147, '(.GUDANG YUBI MEDAN) RED GINGER 180 GRAM }}', 25, 50000);
INSERT INTO `payroll_insentif_payment_detail` VALUES (39, 2, 'isti <sup>(Busui Sehat (Isti))</sup>', 143, '(.GUDANG YUBI SOLO) ALMOON PLUS 200gram Rasa COKELAT }}', 16, 64000);
INSERT INTO `payroll_insentif_payment_detail` VALUES (40, 2, 'isti <sup>(Busui Sehat (Isti))</sup>', 144, '(.GUDANG YUBI SOLO) ALMOON PLUS 200gram Rasa ORIGINAL }}', 27, 108000);
INSERT INTO `payroll_insentif_payment_detail` VALUES (41, 2, 'isti <sup>(Busui Sehat (Isti))</sup>', 145, '(.GUDANG YUBI SOLO) ALMOON PLUS 200gram Rasa STRAWBERRY }}', 7, 28000);
INSERT INTO `payroll_insentif_payment_detail` VALUES (42, 2, 'isti <sup>(Busui Sehat (Isti))</sup>', 146, '(.GUDANG YUBI SOLO) RED GINGER 180 GRAM }}', 33, 66000);
INSERT INTO `payroll_insentif_payment_detail` VALUES (43, 2, 'isti <sup>(Busui Sehat (Isti))</sup>', 152, '(.GUDANG YUBI) BONUS KANTONG ASI LEMBAR }}', 15, 0);
INSERT INTO `payroll_insentif_payment_detail` VALUES (44, 2, 'isti <sup>(Busui Sehat (Isti))</sup>', 48, '(PAKET GOLD) 2 KOTAK Almoon Plus 200g & 1 RED GINGER }}', 69, 552000);
INSERT INTO `payroll_insentif_payment_detail` VALUES (45, 2, 'isti <sup>(Busui Sehat (Isti))</sup>', 43, '(PAKET SILVER) Almoon Plus 200g RASA COKLAT & RED GINGER }}', 45, 270000);
INSERT INTO `payroll_insentif_payment_detail` VALUES (46, 2, 'isti <sup>(Busui Sehat (Isti))</sup>', 45, '(PAKET SILVER) Almoon Plus 200g RASA ORIGINAL & RED GINGER }}', 76, 456000);
INSERT INTO `payroll_insentif_payment_detail` VALUES (47, 2, 'isti <sup>(Busui Sehat (Isti))</sup>', 44, '(PAKET SILVER) Almoon Plus 200g RASA Strawberry & RED GINGER }}', 23, 138000);
INSERT INTO `payroll_insentif_payment_detail` VALUES (48, 2, 'isti <sup>(Busui Sehat (Isti))</sup>', 40, 'ALMOON PLUS 200gram Rasa Cokelat }}', 18, 72000);
INSERT INTO `payroll_insentif_payment_detail` VALUES (49, 2, 'isti <sup>(Busui Sehat (Isti))</sup>', 42, 'ALMOON PLUS 200gram Rasa Original }}', 16, 64000);
INSERT INTO `payroll_insentif_payment_detail` VALUES (50, 2, 'isti <sup>(Busui Sehat (Isti))</sup>', 41, 'ALMOON PLUS 200gram Rasa Strawberry }}', 8, 32000);

-- ----------------------------
-- Table structure for payroll_month_component
-- ----------------------------
DROP TABLE IF EXISTS `payroll_month_component`;
CREATE TABLE `payroll_month_component`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `type` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0' COMMENT '0=componet out, 1=component in',
  `is_hide` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0' COMMENT '0=not hide, 1=hide',
  `is_delete` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0' COMMENT '0=not delete,1=delete',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of payroll_month_component
-- ----------------------------
INSERT INTO `payroll_month_component` VALUES (16, 'Gaji Pokok', '1', '0', '0');
INSERT INTO `payroll_month_component` VALUES (17, 'Tunjangan Operasional', '1', '0', '0');
INSERT INTO `payroll_month_component` VALUES (18, 'Komisi', '1', '0', '0');
INSERT INTO `payroll_month_component` VALUES (19, 'Bonus', '1', '0', '0');
INSERT INTO `payroll_month_component` VALUES (20, 'Lembur', '1', '0', '0');
INSERT INTO `payroll_month_component` VALUES (21, 'Tunjangan Pulsa', '1', '0', '0');
INSERT INTO `payroll_month_component` VALUES (22, 'Tidak Hadir', '0', '0', '0');
INSERT INTO `payroll_month_component` VALUES (23, 'PPH 21', '0', '0', '0');
INSERT INTO `payroll_month_component` VALUES (24, 'BPJS Kesehatan', '0', '0', '0');
INSERT INTO `payroll_month_component` VALUES (25, 'BPJS Tenaga Kerja', '0', '0', '0');
INSERT INTO `payroll_month_component` VALUES (26, 'Pinjaman', '0', '0', '0');
INSERT INTO `payroll_month_component` VALUES (27, 'x', '0', '0', '1');
INSERT INTO `payroll_month_component` VALUES (28, 'Tunjangan Jabatan', '1', '0', '0');
INSERT INTO `payroll_month_component` VALUES (29, 'Tunjangan Shooting', '1', '0', '0');

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
) ENGINE = InnoDB AUTO_INCREMENT = 438 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of payroll_month_list
-- ----------------------------
INSERT INTO `payroll_month_list` VALUES (344, 9, 16, 2000000, '1');
INSERT INTO `payroll_month_list` VALUES (345, 9, 17, 1000000, '1');
INSERT INTO `payroll_month_list` VALUES (351, 8, 16, 1200000, '1');
INSERT INTO `payroll_month_list` VALUES (352, 8, 17, 600000, '1');
INSERT INTO `payroll_month_list` VALUES (353, 8, 21, 100000, '1');
INSERT INTO `payroll_month_list` VALUES (354, 40, 16, 2400000, '1');
INSERT INTO `payroll_month_list` VALUES (355, 40, 28, 600000, '1');
INSERT INTO `payroll_month_list` VALUES (356, 40, 21, 150000, '1');
INSERT INTO `payroll_month_list` VALUES (357, 41, 19, 0, '1');
INSERT INTO `payroll_month_list` VALUES (358, 41, 16, 1500000, '1');
INSERT INTO `payroll_month_list` VALUES (359, 41, 18, 0, '1');
INSERT INTO `payroll_month_list` VALUES (360, 41, 20, 0, '1');
INSERT INTO `payroll_month_list` VALUES (361, 41, 28, 900000, '1');
INSERT INTO `payroll_month_list` VALUES (362, 41, 17, 600000, '1');
INSERT INTO `payroll_month_list` VALUES (363, 41, 21, 100000, '1');
INSERT INTO `payroll_month_list` VALUES (364, 42, 19, 0, '1');
INSERT INTO `payroll_month_list` VALUES (365, 42, 16, 700000, '1');
INSERT INTO `payroll_month_list` VALUES (366, 42, 18, 0, '1');
INSERT INTO `payroll_month_list` VALUES (367, 42, 20, 0, '1');
INSERT INTO `payroll_month_list` VALUES (368, 42, 17, 600000, '1');
INSERT INTO `payroll_month_list` VALUES (369, 43, 19, 0, '1');
INSERT INTO `payroll_month_list` VALUES (370, 43, 16, 2000000, '1');
INSERT INTO `payroll_month_list` VALUES (371, 43, 20, 0, '1');
INSERT INTO `payroll_month_list` VALUES (372, 43, 17, 600000, '1');
INSERT INTO `payroll_month_list` VALUES (373, 44, 19, 0, '1');
INSERT INTO `payroll_month_list` VALUES (374, 44, 16, 2200000, '1');
INSERT INTO `payroll_month_list` VALUES (375, 44, 20, 0, '1');
INSERT INTO `payroll_month_list` VALUES (376, 44, 17, 600000, '1');
INSERT INTO `payroll_month_list` VALUES (377, 45, 19, 0, '1');
INSERT INTO `payroll_month_list` VALUES (378, 45, 16, 700000, '1');
INSERT INTO `payroll_month_list` VALUES (379, 45, 18, 0, '1');
INSERT INTO `payroll_month_list` VALUES (380, 45, 20, 0, '1');
INSERT INTO `payroll_month_list` VALUES (381, 45, 17, 600000, '1');
INSERT INTO `payroll_month_list` VALUES (382, 45, 26, 0, '1');
INSERT INTO `payroll_month_list` VALUES (389, 47, 19, 0, '1');
INSERT INTO `payroll_month_list` VALUES (390, 47, 16, 1000000, '1');
INSERT INTO `payroll_month_list` VALUES (391, 47, 20, 0, '1');
INSERT INTO `payroll_month_list` VALUES (392, 47, 17, 600000, '1');
INSERT INTO `payroll_month_list` VALUES (393, 47, 26, 0, '1');
INSERT INTO `payroll_month_list` VALUES (394, 48, 19, 0, '1');
INSERT INTO `payroll_month_list` VALUES (395, 48, 16, 1000000, '1');
INSERT INTO `payroll_month_list` VALUES (396, 48, 18, 0, '1');
INSERT INTO `payroll_month_list` VALUES (397, 48, 20, 0, '1');
INSERT INTO `payroll_month_list` VALUES (398, 48, 17, 600000, '1');
INSERT INTO `payroll_month_list` VALUES (399, 48, 21, 50000, '1');
INSERT INTO `payroll_month_list` VALUES (400, 48, 26, 0, '1');
INSERT INTO `payroll_month_list` VALUES (401, 49, 16, 1000000, '1');
INSERT INTO `payroll_month_list` VALUES (402, 49, 20, 0, '1');
INSERT INTO `payroll_month_list` VALUES (403, 49, 17, 600000, '1');
INSERT INTO `payroll_month_list` VALUES (404, 49, 21, 50000, '1');
INSERT INTO `payroll_month_list` VALUES (405, 49, 26, 0, '1');
INSERT INTO `payroll_month_list` VALUES (406, 50, 19, 0, '1');
INSERT INTO `payroll_month_list` VALUES (407, 50, 16, 3000000, '1');
INSERT INTO `payroll_month_list` VALUES (408, 50, 20, 0, '1');
INSERT INTO `payroll_month_list` VALUES (409, 50, 17, 600000, '1');
INSERT INTO `payroll_month_list` VALUES (410, 50, 21, 100000, '1');
INSERT INTO `payroll_month_list` VALUES (411, 50, 29, 0, '1');
INSERT INTO `payroll_month_list` VALUES (412, 50, 26, 0, '1');
INSERT INTO `payroll_month_list` VALUES (413, 51, 19, 0, '1');
INSERT INTO `payroll_month_list` VALUES (414, 51, 16, 3400000, '1');
INSERT INTO `payroll_month_list` VALUES (415, 51, 20, 0, '1');
INSERT INTO `payroll_month_list` VALUES (416, 51, 17, 600000, '1');
INSERT INTO `payroll_month_list` VALUES (417, 51, 21, 100000, '1');
INSERT INTO `payroll_month_list` VALUES (418, 51, 26, 0, '1');
INSERT INTO `payroll_month_list` VALUES (419, 7, 19, 0, '1');
INSERT INTO `payroll_month_list` VALUES (420, 7, 16, 700000, '1');
INSERT INTO `payroll_month_list` VALUES (421, 7, 18, 0, '1');
INSERT INTO `payroll_month_list` VALUES (422, 7, 20, 0, '1');
INSERT INTO `payroll_month_list` VALUES (423, 7, 17, 600000, '1');
INSERT INTO `payroll_month_list` VALUES (424, 7, 26, 0, '1');
INSERT INTO `payroll_month_list` VALUES (425, 7, 23, 0, '1');
INSERT INTO `payroll_month_list` VALUES (432, 46, 19, 1000000, '1');
INSERT INTO `payroll_month_list` VALUES (433, 46, 16, 700000, '1');
INSERT INTO `payroll_month_list` VALUES (434, 46, 18, 0, '1');
INSERT INTO `payroll_month_list` VALUES (435, 46, 20, 0, '1');
INSERT INTO `payroll_month_list` VALUES (436, 46, 17, 600000, '1');
INSERT INTO `payroll_month_list` VALUES (437, 46, 26, 0, '1');

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
  `is_pay` enum('0','1','2') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0' COMMENT '0=not pay, 1=allready pay transfer, 2=1=allready pay cash',
  `is_delete` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0' COMMENT '0=not delete,1=delete',
  `date_create` datetime(0) NULL DEFAULT NULL,
  `date_lastupdate` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of payroll_month_payment
-- ----------------------------
INSERT INTO `payroll_month_payment` VALUES (1, 7, 'SL210000001', 'MARKETING', 'ADMIN CUSTOMER SALES (ACS)', 'MGN001', 'Adristi Ardelia Hanifah', 'Wanita', 2021, 2, 0, 0, '', '2021-02-25', '0', '1', '2021-02-21 22:29:29', NULL);
INSERT INTO `payroll_month_payment` VALUES (2, 7, 'SL210000002', 'MARKETING', 'ADMIN CUSTOMER SALES (ACS)', 'MGN001', 'Adristi Ardelia Hanifah', 'Wanita', 2021, 2, 3742000, 0, 'BRI an. Adristi Ardelia Hanifah / 791001009245534', '2021-02-26', '0', '0', '2021-02-21 22:30:56', NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of payroll_month_payment_detail
-- ----------------------------
INSERT INTO `payroll_month_payment_detail` VALUES (1, 2, 1, 'Insentif Penjualan Februari 2021 <sup><b>(IF210000002)</b></sup>', '1', '1', 0, 0, 2442000);
INSERT INTO `payroll_month_payment_detail` VALUES (2, 2, 419, 'Bonus', '1', '1', 0, 0, 0);
INSERT INTO `payroll_month_payment_detail` VALUES (3, 2, 420, 'Gaji Pokok', '1', '1', 0, 0, 700000);
INSERT INTO `payroll_month_payment_detail` VALUES (4, 2, 421, 'Komisi', '1', '1', 0, 0, 0);
INSERT INTO `payroll_month_payment_detail` VALUES (5, 2, 422, 'Lembur', '1', '1', 0, 0, 0);
INSERT INTO `payroll_month_payment_detail` VALUES (6, 2, 423, 'Tunjangan Operasional', '1', '1', 0, 0, 600000);
INSERT INTO `payroll_month_payment_detail` VALUES (7, 2, 424, 'Pinjaman', '0', '1', 0, 0, 0);
INSERT INTO `payroll_month_payment_detail` VALUES (8, 2, 425, 'PPH 21', '0', '1', 0, 0, 0);

SET FOREIGN_KEY_CHECKS = 1;
