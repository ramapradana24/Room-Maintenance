/*
SQLyog Community v12.4.1 (64 bit)
MySQL - 10.1.22-MariaDB : Database - room_maintenance2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`room_maintenance2` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `room_maintenance2`;

/*Table structure for table `complaints` */

DROP TABLE IF EXISTS `complaints`;

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `inventory_id` int(11) DEFAULT NULL,
  `detail` text,
  `active` int(11) DEFAULT NULL,
  `c_status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `complaints` */

insert  into `complaints`(`id`,`user_id`,`room_id`,`inventory_id`,`detail`,`active`,`c_status`,`created_at`,`updated_at`) values 
(1,1,1,2,'tidak ada tv',0,1,NULL,'2017-10-25 12:27:59'),
(2,1,2,1,'kontol semua rusak cuk',1,1,NULL,NULL),
(3,1,1,1,'freon rusak',1,0,'2017-10-24 16:02:09','2017-10-24 16:02:09'),
(4,1,1,2,'tv tidak mau menyala',1,0,'2017-10-24 16:03:39','2017-10-24 16:03:39'),
(5,1,2,3,'rusak',1,1,'2017-10-24 16:06:49','2017-10-24 16:06:49'),
(6,1,2,8,'jembut bet',1,0,'2017-10-24 16:18:11','2017-10-24 16:18:11'),
(7,1,1,6,'kulkas tidak mau dingin',1,0,'2017-10-25 02:58:17','2017-10-25 02:58:17'),
(8,1,1,2,'rusak',0,0,'2017-10-25 03:02:07','2017-10-25 12:28:34'),
(9,1,1,1,'rusak',1,0,'2017-10-25 11:12:43','2017-10-25 11:12:43'),
(10,1,1,1,'ac tidak mau menyala',1,0,'2017-10-25 12:05:51','2017-10-25 12:05:51'),
(11,1,1,1,'ac tidak mau menyala',1,0,'2017-10-25 12:06:22','2017-10-25 12:06:22'),
(12,1,1,1,'tidak ada ac2',1,0,'2017-10-25 12:08:02','2017-10-25 12:08:02'),
(13,1,2,1,'tidak ada ac',1,0,'2017-10-25 12:08:16','2017-10-25 12:08:16'),
(14,1,1,4,'usak gen bor awww',0,0,'2017-10-25 20:15:13','2017-10-30 21:31:29'),
(15,1,2,2,'tv kadang mau menyala kadang juga tidak',1,0,'2017-10-31 18:59:06','2017-10-31 18:59:06'),
(16,5,2,1,'ac rusak parah kemakan laler',1,0,'2017-10-31 19:38:15','2017-10-31 19:38:15'),
(17,5,1,1,'masih misteri',1,0,'2017-10-31 19:41:21','2017-10-31 19:41:21'),
(18,5,1,1,'rusak',1,0,'2017-10-31 19:46:30','2017-10-31 19:46:30'),
(19,2,1,1,'swing ac tidak mau jalan',1,0,'2017-11-02 08:56:33','2017-11-03 20:00:25'),
(20,1,1,1,'swing ac tidak mau jalan',0,0,'2017-11-02 08:58:29','2017-11-02 09:01:16');

/*Table structure for table `defects` */

DROP TABLE IF EXISTS `defects`;

CREATE TABLE `defects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `maintenance_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `inventory_id` int(11) DEFAULT NULL,
  `detail` text,
  `d_status` int(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `solved_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `defects` */

insert  into `defects`(`id`,`maintenance_id`,`room_id`,`inventory_id`,`detail`,`d_status`,`created_at`,`updated_at`,`solved_at`) values 
(1,80,1,1,'ac rusak',0,'2017-11-04 18:10:43','2017-10-28 13:38:37',NULL),
(2,80,1,7,'bantal rusak',0,'2017-11-04 18:10:44','2017-10-28 13:38:38',NULL),
(3,79,2,2,'Jelek',0,'2017-11-04 18:10:44','2017-10-28 19:35:49',NULL),
(4,88,2,1,'aman',0,'2017-11-04 18:10:44','2017-11-04 13:23:20',NULL),
(5,88,2,2,'aman',0,'2017-11-04 18:10:45','2017-11-04 13:23:20',NULL),
(6,88,2,3,'bed aman',0,'2017-11-04 18:10:45','2017-11-04 13:23:20',NULL),
(7,88,2,4,'dipan aman',0,'2017-11-04 18:10:45','2017-11-04 13:23:20',NULL),
(8,88,2,5,'lemari aman',0,'2017-11-04 18:10:45','2017-11-04 13:23:20',NULL),
(9,88,2,6,'kulkas aman',0,'2017-11-04 18:10:45','2017-11-04 13:23:20',NULL),
(10,88,2,7,'bantal aman',0,'2017-11-04 18:10:46','2017-11-04 13:23:20',NULL),
(11,88,2,8,'selimut robek',0,'2017-11-04 18:10:47','2017-11-04 13:23:21',NULL),
(12,89,1,1,'ac rusak',0,'2017-11-04 18:10:46','2017-11-04 13:43:40',NULL),
(13,89,1,5,'lemari bagian belakang rusak/bolong',0,'2017-11-04 18:10:48','2017-11-04 13:43:40',NULL),
(14,89,1,7,'bantal kelihatan kotor',0,'2017-11-04 18:10:49','2017-11-04 13:43:41',NULL);

/*Table structure for table `inventories` */

DROP TABLE IF EXISTS `inventories`;

CREATE TABLE `inventories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `inventories` */

insert  into `inventories`(`id`,`name`) values 
(1,'AC'),
(2,'TV'),
(3,'Bed'),
(4,'Dipan'),
(5,'Lemari'),
(6,'Kulkas'),
(7,'Bantal'),
(8,'Selimut');

/*Table structure for table `inventory_rooms` */

DROP TABLE IF EXISTS `inventory_rooms`;

CREATE TABLE `inventory_rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` int(11) DEFAULT NULL,
  `inventory_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `inventory_rooms` */

insert  into `inventory_rooms`(`id`,`room_id`,`inventory_id`) values 
(1,1,1),
(2,1,2),
(3,1,3),
(4,1,4),
(5,1,5),
(6,1,6),
(7,1,7),
(8,1,8),
(9,2,1),
(10,2,2),
(11,2,3),
(12,2,4),
(13,2,5),
(14,2,6),
(15,2,7),
(16,2,8),
(17,3,1),
(18,3,2),
(19,3,3),
(20,3,4),
(21,3,5),
(22,3,6),
(23,3,7),
(24,3,8);

/*Table structure for table `maintenance_rooms` */

DROP TABLE IF EXISTS `maintenance_rooms`;

CREATE TABLE `maintenance_rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `maintenance_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `inventory_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=362 DEFAULT CHARSET=latin1;

/*Data for the table `maintenance_rooms` */

insert  into `maintenance_rooms`(`id`,`maintenance_id`,`room_id`,`inventory_id`,`date`,`status`,`description`,`created_at`,`updated_at`) values 
(218,70,2,1,NULL,0,NULL,'2017-10-25 20:03:13','2017-10-25 20:03:13'),
(219,70,2,2,NULL,0,NULL,'2017-10-25 20:03:13','2017-10-25 20:03:13'),
(220,70,2,3,NULL,0,NULL,'2017-10-25 20:03:13','2017-10-25 20:03:13'),
(221,70,2,4,NULL,0,NULL,'2017-10-25 20:03:13','2017-10-25 20:03:13'),
(222,70,2,5,NULL,0,NULL,'2017-10-25 20:03:13','2017-10-25 20:03:13'),
(223,70,2,6,NULL,0,NULL,'2017-10-25 20:03:13','2017-10-25 20:03:13'),
(224,70,2,7,NULL,0,NULL,'2017-10-25 20:03:13','2017-10-25 20:03:13'),
(225,70,2,8,NULL,0,NULL,'2017-10-25 20:03:13','2017-10-25 20:03:13'),
(226,71,2,1,NULL,0,NULL,'2017-10-25 20:04:24','2017-10-25 20:04:24'),
(227,71,2,2,NULL,0,NULL,'2017-10-25 20:04:24','2017-10-25 20:04:24'),
(228,71,2,3,NULL,0,NULL,'2017-10-25 20:04:24','2017-10-25 20:04:24'),
(229,71,2,4,NULL,0,NULL,'2017-10-25 20:04:24','2017-10-25 20:04:24'),
(230,71,2,5,NULL,0,NULL,'2017-10-25 20:04:25','2017-10-25 20:04:25'),
(231,71,2,6,NULL,0,NULL,'2017-10-25 20:04:25','2017-10-25 20:04:25'),
(232,71,2,7,NULL,0,NULL,'2017-10-25 20:04:25','2017-10-25 20:04:25'),
(233,71,2,8,NULL,0,NULL,'2017-10-25 20:04:25','2017-10-25 20:04:25'),
(234,72,2,1,NULL,0,NULL,'2017-10-25 20:07:23','2017-10-25 20:07:23'),
(235,72,2,2,NULL,0,NULL,'2017-10-25 20:07:23','2017-10-25 20:07:23'),
(236,72,2,3,NULL,0,NULL,'2017-10-25 20:07:23','2017-10-25 20:07:23'),
(237,72,2,4,NULL,0,NULL,'2017-10-25 20:07:24','2017-10-25 20:07:24'),
(238,72,2,5,NULL,0,NULL,'2017-10-25 20:07:24','2017-10-25 20:07:24'),
(239,72,2,6,NULL,0,NULL,'2017-10-25 20:07:24','2017-10-25 20:07:24'),
(240,72,2,7,NULL,0,NULL,'2017-10-25 20:07:24','2017-10-25 20:07:24'),
(241,72,2,8,NULL,0,NULL,'2017-10-25 20:07:24','2017-10-25 20:07:24'),
(242,73,1,1,NULL,1,NULL,'2017-10-25 20:07:41','2017-10-25 20:07:41'),
(243,73,1,2,NULL,1,NULL,'2017-10-25 20:07:41','2017-10-25 20:07:41'),
(244,73,1,3,NULL,1,NULL,'2017-10-25 20:07:41','2017-10-25 20:07:41'),
(245,73,1,4,NULL,1,NULL,'2017-10-25 20:07:41','2017-10-25 20:07:41'),
(246,73,1,5,NULL,1,NULL,'2017-10-25 20:07:41','2017-10-25 20:07:41'),
(247,73,1,6,NULL,1,NULL,'2017-10-25 20:07:41','2017-10-25 20:07:41'),
(248,73,1,7,NULL,1,NULL,'2017-10-25 20:07:42','2017-10-25 20:07:42'),
(249,73,1,8,NULL,1,NULL,'2017-10-25 20:07:42','2017-10-25 20:07:42'),
(250,74,2,1,NULL,1,'ac','2017-10-25 20:08:05','2017-10-28 09:45:16'),
(251,74,2,2,NULL,1,'tv','2017-10-25 20:08:05','2017-10-28 09:45:16'),
(252,74,2,3,NULL,1,'bed','2017-10-25 20:08:05','2017-10-28 09:45:16'),
(253,74,2,4,NULL,1,'pan','2017-10-25 20:08:06','2017-10-28 09:45:16'),
(254,74,2,5,NULL,1,'lemari','2017-10-25 20:08:06','2017-10-28 09:45:16'),
(255,74,2,6,NULL,1,'kulkas','2017-10-25 20:08:06','2017-10-28 09:45:16'),
(256,74,2,7,NULL,1,'bantasl','2017-10-25 20:08:06','2017-10-28 09:45:16'),
(257,74,2,8,NULL,1,'selimut','2017-10-25 20:08:06','2017-10-28 09:45:16'),
(258,77,1,1,NULL,0,'Pegawai belum mengecek','2017-10-27 21:14:16','2017-10-27 21:14:16'),
(259,77,1,2,NULL,0,'Pegawai belum mengecek','2017-10-27 21:14:16','2017-10-27 21:14:16'),
(260,77,1,3,NULL,0,'Pegawai belum mengecek','2017-10-27 21:14:17','2017-10-27 21:14:17'),
(261,77,1,4,NULL,0,'Pegawai belum mengecek','2017-10-27 21:14:17','2017-10-27 21:14:17'),
(262,77,1,5,NULL,0,'Pegawai belum mengecek','2017-10-27 21:14:17','2017-10-27 21:14:17'),
(263,77,1,6,NULL,0,'Pegawai belum mengecek','2017-10-27 21:14:17','2017-10-27 21:14:17'),
(264,77,1,7,NULL,0,'Pegawai belum mengecek','2017-10-27 21:14:17','2017-10-27 21:14:17'),
(265,77,1,8,NULL,0,'Pegawai belum mengecek','2017-10-27 21:14:17','2017-10-27 21:14:17'),
(266,78,3,1,'2017-10-28 09:48:43',0,'rusak nook','2017-10-27 21:18:23','2017-10-27 21:18:23'),
(267,78,3,2,'2017-10-28 09:48:43',1,'bagus bang','2017-10-27 21:18:23','2017-10-27 21:18:23'),
(268,78,3,3,'2017-10-28 09:48:43',1,'masih bagus dan nyaman','2017-10-27 21:18:23','2017-10-27 21:18:23'),
(269,78,3,4,'2017-10-28 09:48:43',1,'mantappp','2017-10-27 21:18:23','2017-10-27 21:18:23'),
(270,78,3,5,'2017-10-28 09:48:43',0,'hampir jebol','2017-10-27 21:18:23','2017-10-27 21:18:23'),
(271,78,3,6,'2017-10-28 09:48:44',1,'aman','2017-10-27 21:18:23','2017-10-27 21:18:23'),
(272,78,3,7,'2017-10-28 09:48:44',1,'bersih dan ada sisa teteh','2017-10-27 21:18:23','2017-10-27 21:18:23'),
(273,78,3,8,'2017-10-28 09:48:44',0,'aman','2017-10-27 21:18:23','2017-10-27 21:18:23'),
(274,79,2,1,'2017-10-28 19:35:48',1,'Bagus','2017-10-28 10:22:06','2017-10-28 19:35:48'),
(275,79,2,2,'2017-10-28 19:35:49',0,'Jelek','2017-10-28 10:22:06','2017-10-28 19:35:49'),
(276,79,2,3,'2017-10-28 19:35:49',1,'Bagus','2017-10-28 10:22:06','2017-10-28 19:35:49'),
(277,79,2,4,'2017-10-28 19:35:49',1,'Bagus','2017-10-28 10:22:07','2017-10-28 19:35:49'),
(278,79,2,5,'2017-10-28 19:35:49',1,'Bagus','2017-10-28 10:22:07','2017-10-28 19:35:49'),
(279,79,2,6,'2017-10-28 19:35:49',1,'Bagus','2017-10-28 10:22:07','2017-10-28 19:35:49'),
(280,79,2,7,'2017-10-28 19:35:49',1,'Bagus','2017-10-28 10:22:07','2017-10-28 19:35:49'),
(281,79,2,8,'2017-10-28 19:35:50',1,'Bagus','2017-10-28 10:22:07','2017-10-28 19:35:50'),
(282,80,1,1,'2017-10-28 13:38:37',0,'ac rusak','2017-10-28 13:34:50','2017-10-28 13:38:37'),
(283,80,1,2,'2017-10-28 13:38:37',1,'bagus','2017-10-28 13:34:50','2017-10-28 13:38:37'),
(284,80,1,3,'2017-10-28 13:38:37',1,'asasd','2017-10-28 13:34:50','2017-10-28 13:38:37'),
(285,80,1,4,'2017-10-28 13:38:38',1,'asdsad','2017-10-28 13:34:50','2017-10-28 13:38:38'),
(286,80,1,5,'2017-10-28 13:38:38',1,'asdsd','2017-10-28 13:34:50','2017-10-28 13:38:38'),
(287,80,1,6,'2017-10-28 13:38:38',1,'asdasdas','2017-10-28 13:34:50','2017-10-28 13:38:38'),
(288,80,1,7,'2017-10-28 13:38:38',0,'bantal rusak','2017-10-28 13:34:50','2017-10-28 13:38:38'),
(289,80,1,8,'2017-10-28 13:38:38',1,'asdasd','2017-10-28 13:34:50','2017-10-28 13:38:38'),
(290,81,2,1,NULL,0,'inventory ini belum dicek','2017-10-28 13:48:41','2017-10-28 13:48:41'),
(291,81,2,2,NULL,0,'inventory ini belum dicek','2017-10-28 13:48:41','2017-10-28 13:48:41'),
(292,81,2,3,NULL,0,'inventory ini belum dicek','2017-10-28 13:48:41','2017-10-28 13:48:41'),
(293,81,2,4,NULL,0,'inventory ini belum dicek','2017-10-28 13:48:41','2017-10-28 13:48:41'),
(294,81,2,5,NULL,0,'inventory ini belum dicek','2017-10-28 13:48:41','2017-10-28 13:48:41'),
(295,81,2,6,NULL,0,'inventory ini belum dicek','2017-10-28 13:48:41','2017-10-28 13:48:41'),
(296,81,2,7,NULL,0,'inventory ini belum dicek','2017-10-28 13:48:41','2017-10-28 13:48:41'),
(297,81,2,8,NULL,0,'inventory ini belum dicek','2017-10-28 13:48:41','2017-10-28 13:48:41'),
(298,82,1,1,NULL,0,'inventory ini belum dicek','2017-10-30 12:22:38','2017-10-30 12:22:38'),
(299,82,1,2,NULL,0,'inventory ini belum dicek','2017-10-30 12:22:38','2017-10-30 12:22:38'),
(300,82,1,3,NULL,0,'inventory ini belum dicek','2017-10-30 12:22:38','2017-10-30 12:22:38'),
(301,82,1,4,NULL,0,'inventory ini belum dicek','2017-10-30 12:22:38','2017-10-30 12:22:38'),
(302,82,1,5,NULL,0,'inventory ini belum dicek','2017-10-30 12:22:38','2017-10-30 12:22:38'),
(303,82,1,6,NULL,0,'inventory ini belum dicek','2017-10-30 12:22:38','2017-10-30 12:22:38'),
(304,82,1,7,NULL,0,'inventory ini belum dicek','2017-10-30 12:22:38','2017-10-30 12:22:38'),
(305,82,1,8,NULL,0,'inventory ini belum dicek','2017-10-30 12:22:38','2017-10-30 12:22:38'),
(306,83,1,1,NULL,0,'inventory ini belum dicek','2017-10-31 18:35:30','2017-10-31 18:35:30'),
(307,83,1,2,NULL,0,'inventory ini belum dicek','2017-10-31 18:35:30','2017-10-31 18:35:30'),
(308,83,1,3,NULL,0,'inventory ini belum dicek','2017-10-31 18:35:30','2017-10-31 18:35:30'),
(309,83,1,4,NULL,0,'inventory ini belum dicek','2017-10-31 18:35:30','2017-10-31 18:35:30'),
(310,83,1,5,NULL,0,'inventory ini belum dicek','2017-10-31 18:35:30','2017-10-31 18:35:30'),
(311,83,1,6,NULL,0,'inventory ini belum dicek','2017-10-31 18:35:30','2017-10-31 18:35:30'),
(312,83,1,7,NULL,0,'inventory ini belum dicek','2017-10-31 18:35:30','2017-10-31 18:35:30'),
(313,83,1,8,NULL,0,'inventory ini belum dicek','2017-10-31 18:35:30','2017-10-31 18:35:30'),
(314,84,2,1,NULL,0,'inventory ini belum dicek','2017-10-31 20:14:33','2017-10-31 20:14:33'),
(315,84,2,2,NULL,0,'inventory ini belum dicek','2017-10-31 20:14:33','2017-10-31 20:14:33'),
(316,84,2,3,NULL,0,'inventory ini belum dicek','2017-10-31 20:14:33','2017-10-31 20:14:33'),
(317,84,2,4,NULL,0,'inventory ini belum dicek','2017-10-31 20:14:33','2017-10-31 20:14:33'),
(318,84,2,5,NULL,0,'inventory ini belum dicek','2017-10-31 20:14:33','2017-10-31 20:14:33'),
(319,84,2,6,NULL,0,'inventory ini belum dicek','2017-10-31 20:14:33','2017-10-31 20:14:33'),
(320,84,2,7,NULL,0,'inventory ini belum dicek','2017-10-31 20:14:34','2017-10-31 20:14:34'),
(321,84,2,8,NULL,0,'inventory ini belum dicek','2017-10-31 20:14:34','2017-10-31 20:14:34'),
(322,85,2,1,'2017-11-04 14:16:18',1,'ac aman','2017-11-02 09:16:45','2017-11-04 14:16:18'),
(323,85,2,2,'2017-11-04 14:16:18',1,'tv aman','2017-11-02 09:16:45','2017-11-04 14:16:18'),
(324,85,2,3,'2017-11-04 14:16:18',1,'bed aman','2017-11-02 09:16:45','2017-11-04 14:16:18'),
(325,85,2,4,'2017-11-04 14:16:18',1,'dipan aman','2017-11-02 09:16:45','2017-11-04 14:16:18'),
(326,85,2,5,'2017-11-04 14:16:18',1,'lemari aman','2017-11-02 09:16:46','2017-11-04 14:16:18'),
(327,85,2,6,'2017-11-04 14:16:18',1,'kulkas aman','2017-11-02 09:16:46','2017-11-04 14:16:18'),
(328,85,2,7,'2017-11-04 14:16:18',1,'bantal aman','2017-11-02 09:16:46','2017-11-04 14:16:18'),
(329,85,2,8,'2017-11-04 14:16:19',1,'selimut aman','2017-11-02 09:16:46','2017-11-04 14:16:19'),
(330,86,2,1,'2017-11-04 14:03:40',1,'aman','2017-11-02 09:17:35','2017-11-04 14:03:40'),
(331,86,2,2,'2017-11-04 14:03:40',1,'aman','2017-11-02 09:17:35','2017-11-04 14:03:40'),
(332,86,2,3,'2017-11-04 14:03:40',1,'aman','2017-11-02 09:17:35','2017-11-04 14:03:40'),
(333,86,2,4,'2017-11-04 14:03:40',1,'aman','2017-11-02 09:17:35','2017-11-04 14:03:40'),
(334,86,2,5,'2017-11-04 14:03:40',1,'aman','2017-11-02 09:17:35','2017-11-04 14:03:40'),
(335,86,2,6,'2017-11-04 14:03:40',1,'aman','2017-11-02 09:17:35','2017-11-04 14:03:40'),
(336,86,2,7,'2017-11-04 14:03:40',1,'aman','2017-11-02 09:17:36','2017-11-04 14:03:40'),
(337,86,2,8,'2017-11-04 14:03:40',1,'aman','2017-11-02 09:17:36','2017-11-04 14:03:40'),
(338,87,1,1,'2017-11-04 14:01:08',1,'aman','2017-11-02 09:22:56','2017-11-04 14:01:08'),
(339,87,1,2,'2017-11-04 14:01:09',1,'aman','2017-11-02 09:22:56','2017-11-04 14:01:09'),
(340,87,1,3,'2017-11-04 14:01:09',1,'aman','2017-11-02 09:22:56','2017-11-04 14:01:09'),
(341,87,1,4,'2017-11-04 14:01:09',1,'aman','2017-11-02 09:22:56','2017-11-04 14:01:09'),
(342,87,1,5,'2017-11-04 14:01:09',1,'aman','2017-11-02 09:22:56','2017-11-04 14:01:09'),
(343,87,1,6,'2017-11-04 14:01:09',1,'aman','2017-11-02 09:22:56','2017-11-04 14:01:09'),
(344,87,1,7,'2017-11-04 14:01:09',1,'aman','2017-11-02 09:22:56','2017-11-04 14:01:09'),
(345,87,1,8,'2017-11-04 14:01:09',1,'aman','2017-11-02 09:22:56','2017-11-04 14:01:09'),
(346,88,2,1,'2017-11-04 13:23:19',0,'aman','2017-11-02 09:24:25','2017-11-04 13:23:19'),
(347,88,2,2,'2017-11-04 13:23:20',0,'aman','2017-11-02 09:24:25','2017-11-04 13:23:20'),
(348,88,2,3,'2017-11-04 13:23:20',0,'bed aman','2017-11-02 09:24:25','2017-11-04 13:23:20'),
(349,88,2,4,'2017-11-04 13:23:20',0,'dipan aman','2017-11-02 09:24:25','2017-11-04 13:23:20'),
(350,88,2,5,'2017-11-04 13:23:20',0,'lemari aman','2017-11-02 09:24:25','2017-11-04 13:23:20'),
(351,88,2,6,'2017-11-04 13:23:20',0,'kulkas aman','2017-11-02 09:24:25','2017-11-04 13:23:20'),
(352,88,2,7,'2017-11-04 13:23:20',0,'bantal aman','2017-11-02 09:24:26','2017-11-04 13:23:20'),
(353,88,2,8,'2017-11-04 13:23:20',0,'selimut robek','2017-11-02 09:24:26','2017-11-04 13:23:20'),
(354,89,1,1,'2017-11-04 13:43:40',0,'ac rusak','2017-11-04 13:41:14','2017-11-04 13:43:40'),
(355,89,1,2,'2017-11-04 13:43:40',1,'tv  aman','2017-11-04 13:41:14','2017-11-04 13:43:40'),
(356,89,1,3,'2017-11-04 13:43:40',1,'bed aman','2017-11-04 13:41:14','2017-11-04 13:43:40'),
(357,89,1,4,'2017-11-04 13:43:40',1,'dipan aman','2017-11-04 13:41:14','2017-11-04 13:43:40'),
(358,89,1,5,'2017-11-04 13:43:40',0,'lemari bagian belakang rusak/bolong','2017-11-04 13:41:14','2017-11-04 13:43:40'),
(359,89,1,6,'2017-11-04 13:43:41',1,'kulkas aman','2017-11-04 13:41:14','2017-11-04 13:43:41'),
(360,89,1,7,'2017-11-04 13:43:41',0,'bantal kelihatan kotor','2017-11-04 13:41:14','2017-11-04 13:43:41'),
(361,89,1,8,'2017-11-04 13:43:41',1,'selimut aman','2017-11-04 13:41:14','2017-11-04 13:43:41');

/*Table structure for table `maintenances` */

DROP TABLE IF EXISTS `maintenances`;

CREATE TABLE `maintenances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `s_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `m_status` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;

/*Data for the table `maintenances` */

insert  into `maintenances`(`id`,`room_id`,`user_id`,`s_date`,`created_at`,`updated_at`,`m_status`,`active`) values 
(70,2,4,'2017-08-12','2017-10-25 20:03:13','2017-10-25 20:03:19',0,0),
(71,2,4,'2017-08-12','2017-10-25 20:04:24','2017-10-25 20:05:11',0,0),
(72,2,4,'2017-08-12','2017-10-25 20:07:23','2017-10-25 20:07:23',0,1),
(73,1,5,'2017-09-12','2017-10-25 20:07:41','2017-10-25 20:07:41',1,1),
(74,2,5,'2017-07-12','2017-10-25 20:08:05','2017-10-25 20:08:05',1,1),
(77,1,4,'2017-10-13','2017-10-27 21:14:16','2017-10-27 21:14:16',0,1),
(78,3,5,'2017-10-06','2017-10-27 21:18:23','2017-10-27 21:18:23',1,1),
(79,3,2,'2017-10-16','2017-10-28 10:22:06','2017-10-30 19:57:20',1,0),
(80,1,5,'2017-09-30','2017-10-28 13:34:50','2017-10-30 14:51:14',1,0),
(81,2,5,'2017-12-21','2017-10-28 13:48:41','2017-10-30 14:47:56',0,0),
(82,1,3,'2018-10-29','2017-10-30 12:22:37','2017-10-30 14:47:04',0,0),
(83,1,2,'2018-12-21','2017-10-31 18:35:29','2017-10-31 18:35:29',0,1),
(84,2,3,'2018-11-30','2017-10-31 20:14:33','2017-10-31 20:14:33',0,1),
(85,2,5,'2017-12-25','2017-11-02 09:16:45','2017-11-04 14:16:19',1,1),
(86,2,5,'2017-12-25','2017-11-02 09:17:35','2017-11-04 14:03:41',1,1),
(87,1,5,'2017-12-26','2017-11-02 09:22:56','2017-11-04 14:01:09',1,1),
(88,2,5,'2017-12-27','2017-11-02 09:24:25','2017-11-04 13:23:21',1,1),
(89,1,5,'2017-12-20','2017-11-04 13:41:13','2017-11-04 13:43:41',1,1);

/*Table structure for table `notifications` */

DROP TABLE IF EXISTS `notifications`;

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `subject` varchar(25) DEFAULT NULL,
  `text` text,
  `n_status` int(1) DEFAULT NULL,
  `active` int(1) DEFAULT NULL,
  `appear` int(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `notifications` */

insert  into `notifications`(`id`,`user_id`,`subject`,`text`,`n_status`,`active`,`appear`,`created_at`,`updated_at`) values 
(1,1,'Pengaduan','Agus Arisna baru saja menambah pengaduan',1,1,1,NULL,NULL),
(2,1,'Jadwal Pengecekan','Agus Arisna baru saja mengecek kamar 101',1,1,1,NULL,NULL),
(3,1,'Jadwal Pengecekan','Ary Suta baru saja mengecek kamar 201',1,1,1,NULL,NULL),
(4,1,'Pengaduan','Gus Pradipta baru saja mengecek kamar 202',1,1,1,NULL,NULL),
(5,1,'Pengaduan','Iduar Perdana baru saja menambah pengaduan pada pada kamar 101',1,1,1,NULL,NULL),
(6,1,'Pengaduan','Iduar baru saja menambah pengaduan',1,1,1,NULL,NULL),
(7,1,'Pengaduan','Pandika baru saja pulang',1,1,1,NULL,NULL),
(8,2,'Pengaduan','Rama Pradana baru saja menambah pengaduan baru. <br>Silakan melihat pada menu Pengaduan',0,1,1,'2017-11-02 08:58:29','2017-11-02 08:58:29'),
(9,3,'Pengaduan','Rama Pradana baru saja menambah pengaduan baru. Silakan melihat pada menu Pengaduan',0,1,1,'2017-11-02 08:58:29','2017-11-02 08:58:29'),
(10,4,'Pengaduan','Rama Pradana baru saja menambah pengaduan baru. Silakan melihat pada menu Pengaduan',0,1,1,'2017-11-02 08:58:29','2017-11-02 08:58:29'),
(11,5,'Pengaduan','Rama Pradana baru saja menambah pengaduan baru. Silakan melihat pada menu Pengaduan',1,1,1,'2017-11-02 08:58:29','2017-11-02 08:58:29'),
(12,5,'Jadwal Pengecekan','Rama Pradana baru saja menambahkan jadwal pengecekan untuk anda.<br>Silakan refresh beranda anda untuk melihat jadwal tersebut.',1,1,1,'2017-11-02 09:16:46','2017-11-02 09:16:46'),
(13,5,'Jadwal Pengecekan','Rama Pradana baru saja menambahkan jadwal pengecekan untuk anda. Silakan refresh beranda anda untuk melihat jadwal tersebut.',1,1,1,'2017-11-02 09:17:36','2017-11-02 09:17:36'),
(14,5,'Jadwal Pengecekan','Rama Pradana baru saja menambahkan jadwal pengecekan untuk anda.<br>Silakan refresh beranda anda untuk melihat jadwal tersebut.',1,1,1,'2017-11-02 09:22:56','2017-11-02 09:22:56'),
(15,5,'Jadwal Pengecekan','Rama Pradana baru saja menambahkan jadwal pengecekan untuk anda.<br>Silakan refresh beranda anda untuk melihat jadwal tersebut.',1,1,1,'2017-11-02 09:24:26','2017-11-02 09:24:26'),
(16,1,'Jadwal Pengecekan','Arisna baru saja mengecek kamar 100',1,1,1,NULL,NULL),
(17,5,'Jadwal Pengecekan','Rama Pradana baru saja menambahkan jadwal pengecekan untuk anda.<br>Silakan refresh beranda anda untuk melihat jadwal tersebut.',1,1,1,'2017-11-04 13:41:14','2017-11-04 13:41:14'),
(18,1,'Jadwal Pengecekan','Agus Pradipta baru saja melakukan pengecekan pada kamar no.100',1,1,1,'2017-11-04 14:01:09','2017-11-04 14:01:09'),
(19,1,'Jadwal Pengecekan','Agus Pradipta baru saja melakukan pengecekan pada kamar no.101',1,1,1,'2017-11-04 14:03:41','2017-11-04 14:03:41'),
(20,1,'Jadwal Pengecekan','Agus barusaja mengecek kamar 101',1,1,1,'2017-11-04 14:08:49','2017-11-04 14:08:53'),
(21,1,'Jadwal Pengecekan','Agus Pradipta baru saja melakukan pengecekan pada kamar no.101 tanggalDec 25th, 2017<br>Anda bisa melihat hasil pengecekannya di Beranda atau Penjadwalan',1,1,1,'2017-11-04 14:16:19','2017-11-04 14:16:19');

/*Table structure for table `privileges` */

DROP TABLE IF EXISTS `privileges`;

CREATE TABLE `privileges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `privileges` */

insert  into `privileges`(`id`,`name`) values 
(1,'Administrator'),
(2,'Pegawai');

/*Table structure for table `rooms` */

DROP TABLE IF EXISTS `rooms`;

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `rooms` */

insert  into `rooms`(`id`,`number`) values 
(1,'100'),
(2,'101'),
(3,'102'),
(4,'103'),
(5,'104'),
(6,'105'),
(7,'200'),
(8,'201');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `sex` int(11) DEFAULT NULL,
  `address` text,
  `dateofbirth` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `privilege_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`user_name`,`email`,`password`,`remember_token`,`sex`,`address`,`dateofbirth`,`created_at`,`updated_at`,`privilege_id`) values 
(1,'Rama Pradana','ramapradana67@gmail.com','$2y$10$sAtkKANZ7g7N6h7/1T37Ye9aizOARLUXeNUTeXwjQofE2pl3xZEHG','aozc2zEfawDXEYpNqVFMsA601RDArsGBSwUjooKS3okXUdNUxzdkLIQvWrXz',1,'jalan raya sesetan','1989-10-09','2017-11-04 17:45:11','2017-10-09 09:11:37',1),
(2,'Arisna CGEEK','arisna@gmal.com','$2y$10$DMGe5DvMY1HOqtTVV09Qb.Nmtdn6nAgJnt133N2wxF3y.1eJYVVuu','9g3JrIfYRm3NCpHjVWuJMsETbK1oUingdul1zD6YSBhSGUYLxNxwWOQ6Yfzo',1,'jalan nusa indah nusa dua bali','1998-12-01','2017-10-09 23:02:41','2017-10-09 10:40:06',2),
(3,'Ary Suta Sanjaya','arysuta@gmail.com','$2y$10$sC2PRBmfV0N4JBwIJtMJy.N9h/cinFjbOtTy3gQLTlGdzfNG8TMHu','hCE0nFoqNulKsn2moLfKtU5xw9T34NoXvY6Vq3NERQYHGHGjkSWxXYKs0gcJ',1,'jalan tukad barito no 66','1997-07-07','2017-10-09 23:02:42','2017-10-09 14:59:17',2),
(4,'Iduar Perdana','iduar@gmail.com','$2y$10$VdXVEMBYtwbifJxcskM6UeTIoab1hsVgR7tZZpJiaqJOiK4d8hnLq','fKcdeGlwMxVOEeD2YvuwIqr1OZYuspKEteWeSDpBL6wjF3j9Eo32vDwUm36g',1,'jalan raya candidasa no 99 Karangasem Bali','1998-09-07','2017-10-25 20:06:59','2017-10-09 15:00:15',2),
(5,'Agus Pradipta','pradipta@gmail.com','$2y$10$ANabUQkCd5/HN/F9CZyw/OmGD60UAQwSxMY4Z8iwvKNoyOuTjwK6e','bgXM37G7U1erwXxeamaS2FMnKq1bCq6exJeyPzTPZDiYP3ePcIrAT9cdeWbF',1,'jalan raya klunkung semarapura deket gunung agung','1977-08-12','2017-11-04 17:42:38','2017-10-09 15:16:50',2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
