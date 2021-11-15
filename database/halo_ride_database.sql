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
  `seats_number` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`booking_seat_id`),
  KEY `booking_id` (`booking_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `booking_seat_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `booking_seat` */

insert  into `booking_seat`(`booking_seat_id`,`booking_id`,`user_id`,`status`,`seats_number`) values 
(1,1,3,1,3);

/*Table structure for table `bookings` */

DROP TABLE IF EXISTS `bookings`;

CREATE TABLE `bookings` (
  `booking_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `bus_id` bigint(20) DEFAULT NULL,
  `driver_id` bigint(20) DEFAULT NULL,
  `avaiable_seats` bigint(20) DEFAULT NULL,
  `route_id` bigint(20) DEFAULT NULL,
  `per_seat_rate` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`booking_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `bookings` */

insert  into `bookings`(`booking_id`,`bus_id`,`driver_id`,`avaiable_seats`,`route_id`,`per_seat_rate`) values 
(1,1,1,31,1,NULL),
(2,0,2,34,2,NULL);

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

/*Table structure for table `routes` */

DROP TABLE IF EXISTS `routes`;

CREATE TABLE `routes` (
  `route_id` bigint(20) NOT NULL,
  `from` bigint(20) DEFAULT NULL,
  `to` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`route_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `routes` */

/*Table structure for table `user_seat_booking` */

DROP TABLE IF EXISTS `user_seat_booking`;

CREATE TABLE `user_seat_booking` (
  `user_seat_booking_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `status` bigint(20) DEFAULT 1,
  `booking_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`user_seat_booking_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `user_seat_booking` */

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`user_id`,`role_id`,`full_name`,`email`,`phone_number`,`cnic`,`password`,`image`,`status`,`added_on`) values 
(1,1,'admin','admin@gmail.com','0312-1231232','41405-1231231-1','123','',1,'2021-11-06 02:38:54'),
(2,2,'Siraj','siraj@gmail.com','0312-1231232','41405-1231231-1','123123123','images/technology.jpg',0,'2021-11-06 02:39:41'),
(3,2,'Muhammad','muhammad@gmail.com','0312-12334512','1123123124124124','4297f44b13955235245b2497399d7a93','images/boutique-logo.png',0,'2021-11-07 10:32:24'),
(4,3,'Ahmed','ahmed@gmail.com','0300-1231231','41234-1231245-2','123',NULL,0,'0000-00-00 00:00:00');

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
