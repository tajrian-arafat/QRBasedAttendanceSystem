/*
SQLyog Community v13.1.5  (64 bit)
MySQL - 10.4.25-MariaDB : Database - qrproject
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`qrproject` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `qrproject`;

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
(5,'2022_12_11_183100_create_sessions_table',2);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `qr_admins` */

DROP TABLE IF EXISTS `qr_admins`;

CREATE TABLE `qr_admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `qr_admins` */

insert  into `qr_admins`(`id`,`name`,`email`,`password`) values 
(1,'Admin 1','admin@gmail.com','1234abcd');

/*Table structure for table `qr_attendance_data` */

DROP TABLE IF EXISTS `qr_attendance_data`;

CREATE TABLE `qr_attendance_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `attendance` int(11) NOT NULL DEFAULT 0,
  `device_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

/*Data for the table `qr_attendance_data` */

insert  into `qr_attendance_data`(`id`,`student_id`,`section_id`,`date`,`attendance`,`device_id`) values 
(2,2,1,'2022-12-12',1,NULL),
(3,3,1,'2022-12-12',1,NULL),
(4,4,1,'2022-12-12',0,NULL),
(5,5,1,'2022-12-12',0,NULL),
(6,2,1,'2022-12-11',0,NULL),
(7,3,1,'2022-12-11',0,NULL),
(8,4,1,'2022-12-11',0,NULL),
(9,5,1,'2022-12-11',0,NULL),
(10,1,1,'2022-12-14',1,NULL),
(11,2,1,'2022-12-14',0,NULL),
(12,3,1,'2022-12-14',0,NULL),
(13,4,1,'2022-12-14',0,NULL),
(14,5,1,'2022-12-14',0,NULL),
(15,1,1,'2022-12-19',0,NULL),
(16,2,1,'2022-12-19',0,NULL),
(17,3,1,'2022-12-19',0,NULL),
(18,4,1,'2022-12-19',0,NULL),
(19,5,1,'2022-12-19',0,NULL),
(20,1,1,'2022-12-20',1,'0'),
(21,2,1,'2022-12-20',0,NULL),
(22,3,1,'2022-12-20',0,NULL),
(23,4,1,'2022-12-20',0,NULL),
(24,5,1,'2022-12-20',0,NULL);

/*Table structure for table `qr_courses` */

DROP TABLE IF EXISTS `qr_courses`;

CREATE TABLE `qr_courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `qr_courses` */

insert  into `qr_courses`(`id`,`name`) values 
(1,'CSE370'),
(2,'CSE320'),
(3,'CSE330'),
(4,'CSE250'),
(5,'CSE331');

/*Table structure for table `qr_sections` */

DROP TABLE IF EXISTS `qr_sections`;

CREATE TABLE `qr_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `course_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*Data for the table `qr_sections` */

insert  into `qr_sections`(`id`,`name`,`course_id`,`teacher_id`) values 
(1,'Group 1',1,3),
(2,'Group 2',1,3),
(3,'Group 1',2,3),
(4,'Group 2',2,4),
(5,'Group 1',3,3),
(6,'Group 2',3,4),
(7,'Group 1',4,3),
(8,'Group 2',4,4),
(9,'Group 1',5,3),
(10,'Group B',5,4);

/*Table structure for table `qr_students` */

DROP TABLE IF EXISTS `qr_students`;

CREATE TABLE `qr_students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(300) NOT NULL,
  `name` varchar(300) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL,
  `section_ids` longtext DEFAULT NULL,
  `device_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `qr_students` */

insert  into `qr_students`(`id`,`student_id`,`name`,`email`,`password`,`section_ids`,`device_id`) values 
(1,'20201186','Alvi','alvi@gmail.com','','\"3\",\"6\",\"7\",\"9\"',NULL),
(2,'20201022','Sabiha','sabiha@gmail.com','','\"1\",\"3\",\"6\",\"7\",\"10\"',NULL),
(3,'20201047','Sharif','sharif@gmail.com','','\"2\",\"4\",\"6\",\"7\",\"9\"',NULL),
(4,'20211021','Hasib','hasib@gmail.com','','\"1\",\"3\",\"5\",\"8\",\"9\"',NULL),
(5,'40000004','Shihab','shihab@gmail.com','','\"1\",\"4\",\"5\",\"7\",\"9\"',NULL);

/*Table structure for table `qr_teachers` */

DROP TABLE IF EXISTS `qr_teachers`;

CREATE TABLE `qr_teachers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `qr_teachers` */

insert  into `qr_teachers`(`id`,`name`,`email`,`password`) values 
(1,'Instructor A','teacherone@gmail.com','123456'),
(2,'Instructor B ','teachertwo@gmail.com','123456'),
(3,'Mobashir Monim','mobashir.monim@bracu.ac.bd','mom1234'),
(4,'Sabiha Nasrin','sabiha.nasrin@bracu.ac.bd','sabiha1234');

/*Table structure for table `qr_validation_storage` */

DROP TABLE IF EXISTS `qr_validation_storage`;

CREATE TABLE `qr_validation_storage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_datetime` varchar(100) NOT NULL,
  `qr_hash` varchar(500) NOT NULL,
  `qr_section_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=604 DEFAULT CHARSET=utf8mb4;

/*Data for the table `qr_validation_storage` */

insert  into `qr_validation_storage`(`id`,`create_datetime`,`qr_hash`,`qr_section_id`) values 
(603,'2022-12-20 18:07:32','1999-2794039459283954704',1);

/*Table structure for table `sessions` */

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sessions` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
