/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100422
 Source Host           : localhost:3306
 Source Schema         : wings_shop

 Target Server Type    : MySQL
 Target Server Version : 100422
 File Encoding         : 65001

 Date: 31/03/2022 12:57:33
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for m_products
-- ----------------------------
DROP TABLE IF EXISTS `m_products`;
CREATE TABLE `m_products`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(6, 0) NOT NULL,
  `currency` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `discount` decimal(6, 0) NOT NULL,
  `dimension` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `unit` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `thumbnail` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime(0) NOT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_products
-- ----------------------------
INSERT INTO `m_products` VALUES (4, '10000001', 'Lux Giv (Update)', 10000, 'IDR', 0, '10mm x 10mm', 'PCS', 'storage/products/lux-giv-update.jpg', 1, '2022-03-31 11:08:54', 1, '2022-03-31 11:17:23');
INSERT INTO `m_products` VALUES (5, '10000002', 'SO Klin', 500000, 'IDR', 10, '120mm x 100mm', 'PCS', 'storage/products/so-klin.jpg', 1, '2022-03-31 11:18:47', NULL, NULL);
INSERT INTO `m_products` VALUES (6, '10000003', 'Sabun Krim Wings Biru', 5500, 'IDR', 0, '10mm x 10mm', 'PCS', 'storage/products/sabun-krim-wings-biru.jpg', 1, '2022-03-31 11:22:07', NULL, NULL);

-- ----------------------------
-- Table structure for trx_d_penjualan
-- ----------------------------
DROP TABLE IF EXISTS `trx_d_penjualan`;
CREATE TABLE `trx_d_penjualan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trx_h_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `sub_total` decimal(10, 0) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `trx_header`(`trx_h_id`) USING BTREE,
  INDEX `product`(`product_id`) USING BTREE,
  CONSTRAINT `product` FOREIGN KEY (`product_id`) REFERENCES `m_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `trx_header` FOREIGN KEY (`trx_h_id`) REFERENCES `trx_h_penjualan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of trx_d_penjualan
-- ----------------------------
INSERT INTO `trx_d_penjualan` VALUES (1, 7, 4, 10000, 1, '2022-03-31 12:45:13');
INSERT INTO `trx_d_penjualan` VALUES (2, 7, 5, 500000, 1, '2022-03-31 12:45:13');
INSERT INTO `trx_d_penjualan` VALUES (3, 7, 6, 5500, 1, '2022-03-31 12:45:13');
INSERT INTO `trx_d_penjualan` VALUES (4, 9, 4, 10000, 1, '2022-03-31 12:46:21');
INSERT INTO `trx_d_penjualan` VALUES (5, 9, 5, 1000000, 1, '2022-03-31 12:46:21');
INSERT INTO `trx_d_penjualan` VALUES (6, 9, 6, 5500, 1, '2022-03-31 12:46:21');
INSERT INTO `trx_d_penjualan` VALUES (7, 10, 4, 10000, 1, '2022-03-31 12:47:10');
INSERT INTO `trx_d_penjualan` VALUES (8, 10, 5, 1000000, 1, '2022-03-31 12:47:10');
INSERT INTO `trx_d_penjualan` VALUES (9, 10, 6, 5500, 1, '2022-03-31 12:47:10');

-- ----------------------------
-- Table structure for trx_h_penjualan
-- ----------------------------
DROP TABLE IF EXISTS `trx_h_penjualan`;
CREATE TABLE `trx_h_penjualan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `total` decimal(10, 0) NOT NULL,
  `trans_date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of trx_h_penjualan
-- ----------------------------
INSERT INTO `trx_h_penjualan` VALUES (7, 'TRX00001.22', 1015500, '2022-03-31', 1, '2022-03-31 12:45:13');
INSERT INTO `trx_h_penjualan` VALUES (9, 'TRX00002.22', 1015500, '2022-03-31', 1, '2022-03-31 12:46:21');
INSERT INTO `trx_h_penjualan` VALUES (10, 'TRX00003.22', 1015500, '2022-03-31', 1, '2022-03-31 12:47:10');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime(0) NOT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Agus Suandi', 'agus.suandi', 'agussuandi48@gmail.com', '$2a$12$iU9V23YbMFailPq49GLKp.3PpAlpum94Q7HDfLKD9c6R5dYiv5bKG', 1, '2022-03-31 09:33:31', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
