-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for sortable
DROP DATABASE IF EXISTS `sortable`;
CREATE DATABASE IF NOT EXISTS `sortable` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sortable`;

-- Dumping structure for table sortable.data
DROP TABLE IF EXISTS `data`;
CREATE TABLE IF NOT EXISTS `data` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `brand` varchar(250) DEFAULT NULL,
  `product_name` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sortable.data: ~7 rows (approximately)
DELETE FROM `data`;
INSERT INTO `data` (`id`, `brand`, `product_name`) VALUES
	(1, 'Samsung', 'Samsung Galaxy S24 Ultra'),
	(2, 'iPhone', 'iPhone 15 Pro Max'),
	(3, 'Xiaomi', 'Xiaomi 14'),
	(4, 'Infinix', 'Infinix Note 40'),
	(5, 'Oppo', 'Oppo Find N3'),
	(6, 'Asus', 'Asus ROG Phone 8'),
	(7, 'ZTE', 'Red Magix 8S Pro');

-- Dumping structure for table sortable.data_sort
DROP TABLE IF EXISTS `data_sort`;
CREATE TABLE IF NOT EXISTS `data_sort` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `data_id` bigint DEFAULT NULL,
  `data` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sortable.data_sort: ~1 rows (approximately)
DELETE FROM `data_sort`;
INSERT INTO `data_sort` (`id`, `data_id`, `data`) VALUES
	(1, 1, '[{"id": "6", "no": "1", "name": "Asus ROG Phone 8", "brand": "Asus"}, {"id": "7", "no": "2", "name": "Red Magix 8S Pro", "brand": "ZTE"}, {"id": "5", "no": "3", "name": "Oppo Find N3", "brand": "Oppo"}, {"id": "2", "no": "4", "name": "iPhone 15 Pro Max", "brand": "iPhone"}, {"id": "3", "no": "5", "name": "Xiaomi 14", "brand": "Xiaomi"}, {"id": "1", "no": "6", "name": "Samsung Galaxy S24 Ultra", "brand": "Samsung"}, {"id": "4", "no": "7", "name": "Infinix Note 40", "brand": "Infinix"}]');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
