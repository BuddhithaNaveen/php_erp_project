/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.32-MariaDB : Database - php_erp_system
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`php_erp_system` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;

USE `php_erp_system`;

/*Table structure for table `customers` */

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` enum('Mr','Mrs','Miss','Dr') NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `district_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `district_id` (`district_id`),
  CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `customers` */

/*Table structure for table `district` */

DROP TABLE IF EXISTS `district`;

CREATE TABLE `district` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `district_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `district` */

insert  into `district`(`id`,`district_name`) values 
(1,'Ampara'),
(2,'Anuradhapura'),
(3,'Badulla'),
(4,'Batticaloa'),
(5,'Colombo'),
(6,'Galle'),
(7,'Gampaha'),
(8,'Hambantota'),
(9,'Jaffna'),
(10,'Kalutara'),
(11,'Kandy'),
(12,'Kegalle'),
(13,'Kilinochchi'),
(14,'Kurunegala'),
(15,'Mannar'),
(16,'Matale'),
(17,'Matara'),
(18,'Monaragala'),
(19,'Mullaitivu'),
(20,'Nuwara Eliya'),
(21,'Polonnaruwa'),
(22,'Puttalam'),
(23,'Ratnapura'),
(24,'Trincomalee'),
(25,'Vavuniya'),
(26,'Ampara'),
(27,'Anuradhapura'),
(28,'Badulla'),
(29,'Batticaloa'),
(30,'Colombo'),
(31,'Galle'),
(32,'Gampaha'),
(33,'Hambantota'),
(34,'Jaffna'),
(35,'Kalutara'),
(36,'Kandy'),
(37,'Kegalle'),
(38,'Kilinochchi'),
(39,'Kurunegala'),
(40,'Mannar'),
(41,'Matale'),
(42,'Matara'),
(43,'Monaragala'),
(44,'Mullaitivu'),
(45,'Nuwara Eliya'),
(46,'Polonnaruwa'),
(47,'Puttalam'),
(48,'Ratnapura'),
(49,'Trincomalee'),
(50,'Vavuniya');

/*Table structure for table `invoice` */

DROP TABLE IF EXISTS `invoice`;

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(20) NOT NULL,
  `invoice_date` date NOT NULL,
  `customer_id` int(11) NOT NULL,
  `item_count` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoice_no` (`invoice_no`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `invoice` */

/*Table structure for table `invoice_items` */

DROP TABLE IF EXISTS `invoice_items`;

CREATE TABLE `invoice_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_id` (`invoice_id`),
  KEY `item_id` (`item_id`),
  CONSTRAINT `invoice_items_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`),
  CONSTRAINT `invoice_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `invoice_items` */

/*Table structure for table `item_category` */

DROP TABLE IF EXISTS `item_category`;

CREATE TABLE `item_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `item_category` */

insert  into `item_category`(`id`,`category_name`) values 
(1,'Electronics'),
(2,'Furniture'),
(3,'Clothing'),
(4,'Food & Beverage'),
(5,'Stationery'),
(6,'Hardware'),
(7,'Software'),
(8,'Medical'),
(9,'Automotive'),
(10,'Sports'),
(11,'Electronics'),
(12,'Furniture'),
(13,'Clothing'),
(14,'Food & Beverage'),
(15,'Stationery'),
(16,'Hardware'),
(17,'Software'),
(18,'Medical'),
(19,'Automotive'),
(20,'Sports');

/*Table structure for table `item_sub_category` */

DROP TABLE IF EXISTS `item_sub_category`;

CREATE TABLE `item_sub_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_category_name` varchar(150) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `item_sub_category_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `item_category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `item_sub_category` */

insert  into `item_sub_category`(`id`,`sub_category_name`,`category_id`) values 
(1,'Mobile Phones',1),
(2,'Laptops',1),
(3,'Tablets',1),
(4,'Accessories',1),
(5,'Office Furniture',2),
(6,'Home Furniture',2),
(7,'Outdoor Furniture',2),
(8,'Men',3),
(9,'Women',3),
(10,'Kids',3),
(11,'Beverages',4),
(12,'Snacks',4),
(13,'Fresh Produce',4),
(14,'Pens & Pencils',5),
(15,'Paper Products',5),
(16,'Office Supplies',5),
(17,'Power Tools',6),
(18,'Hand Tools',6),
(19,'Safety Equipment',6),
(20,'Antivirus',7),
(21,'Productivity',7),
(22,'Design Tools',7),
(23,'Medicines',8),
(24,'Equipment',8),
(25,'Supplements',8),
(26,'Car Parts',9),
(27,'Accessories',9),
(28,'Tyres',9),
(29,'Cricket',10),
(30,'Football',10),
(31,'Fitness',10),
(32,'Mobile Phones',1),
(33,'Laptops',1),
(34,'Tablets',1),
(35,'Accessories',1),
(36,'Office Furniture',2),
(37,'Home Furniture',2),
(38,'Outdoor Furniture',2),
(39,'Men',3),
(40,'Women',3),
(41,'Kids',3),
(42,'Beverages',4),
(43,'Snacks',4),
(44,'Fresh Produce',4),
(45,'Pens & Pencils',5),
(46,'Paper Products',5),
(47,'Office Supplies',5),
(48,'Power Tools',6),
(49,'Hand Tools',6),
(50,'Safety Equipment',6),
(51,'Antivirus',7),
(52,'Productivity',7),
(53,'Design Tools',7),
(54,'Medicines',8),
(55,'Equipment',8),
(56,'Supplements',8),
(57,'Car Parts',9),
(58,'Accessories',9),
(59,'Tyres',9),
(60,'Cricket',10),
(61,'Football',10),
(62,'Fitness',10);

/*Table structure for table `items` */

DROP TABLE IF EXISTS `items`;

CREATE TABLE `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_code` varchar(20) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `item_code` (`item_code`),
  KEY `category_id` (`category_id`),
  KEY `subcategory_id` (`subcategory_id`),
  CONSTRAINT `items_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `item_category` (`id`),
  CONSTRAINT `items_ibfk_2` FOREIGN KEY (`subcategory_id`) REFERENCES `item_sub_category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `items` */

insert  into `items`(`id`,`item_code`,`item_name`,`category_id`,`subcategory_id`,`quantity`,`unit_price`,`created_at`,`updated_at`) values 
(1,'ITM2607-0001','Arduino',1,4,10,800.00,'2026-07-14 19:50:31','2026-07-14 19:50:31'),
(2,'ITM2607-0002','LED',11,4,1000,5.00,'2026-07-15 03:57:37','2026-07-15 04:09:03');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
