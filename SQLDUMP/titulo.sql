/*
 Navicat Premium Data Transfer

 Source Server         : Local
 Source Server Type    : MySQL
 Source Server Version : 50731
 Source Host           : localhost:3306
 Source Schema         : censo2020

 Target Server Type    : MySQL
 Target Server Version : 50731
 File Encoding         : 65001

 Date: 08/09/2020 11:51:35
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for titulo
-- ----------------------------
DROP TABLE IF EXISTS `titulo`;
CREATE TABLE `titulo`  (
  `codigo` decimal(65, 0) NOT NULL,
  `Carrera` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL
) ENGINE = MyISAM CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of titulo
-- ----------------------------
INSERT INTO `titulo` VALUES (18, 'Secundario´');
INSERT INTO `titulo` VALUES (10, 'Tecnicatura');
INSERT INTO `titulo` VALUES (15, 'Carreara de hasta 4 años');
INSERT INTO `titulo` VALUES (25, 'Carrera superior a 4 años');

SET FOREIGN_KEY_CHECKS = 1;
