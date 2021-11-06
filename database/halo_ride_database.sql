/*
SQLyog Ultimate v12.5.0 (64 bit)
MySQL - 10.4.17-MariaDB : Database - halo_ride
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`halo_ride` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `halo_ride`;

/*Table structure for table `booking_seat` */

DROP TABLE IF EXISTS `booking_seat`;

CREATE TABLE `booking_seat` (
  `booking_seat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`booking_seat_id`),
  KEY `booking_id` (`booking_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `booking_seat_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `booking_seat` */

/*Table structure for table `city` */

DROP TABLE IF EXISTS `city`;

CREATE TABLE `city` (
  `city_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `city_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

/*Data for the table `city` */

insert  into `city`(`city_id`,`city_name`) values 
(1,'jamshoro'),
(2,'sehwan'),
(3,'dadu'),
(4,'larkana'),
(5,'karachi'),
(6,'hyderabad'),
(7,'sukkur'),
(8,'moro'),
(9,'ghambat'),
(10,'khairpur'),
(11,'nooriabad');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(1) DEFAULT NULL COMMENT '1=admin, 2=captain, 3=customer',
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `cnic` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `added_on` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

/*Table structure for table `vehicle` */

DROP TABLE IF EXISTS `vehicle`;

CREATE TABLE `vehicle` (
  `vehicle_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `registration_number` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `wheels` int(11) NOT NULL,
  `seats` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `image` blob NOT NULL,
  PRIMARY KEY (`vehicle_id`),
  UNIQUE KEY `registration_number` (`registration_number`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `vehicle` */

insert  into `vehicle`(`vehicle_id`,`registration_number`,`type`,`wheels`,`seats`,`status`,`image`) values 
(1,'437-FMD','Car',4,4,1,'images/images (8).jpg');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
