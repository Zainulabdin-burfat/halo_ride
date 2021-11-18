/*
SQLyog Ultimate v12.5.0 (64 bit)
MySQL - 10.4.21-MariaDB : Database - halo_ride
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

/*Table structure for table `bookings` */

DROP TABLE IF EXISTS `bookings`;

CREATE TABLE `bookings` (
  `booking_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) unsigned NOT NULL,
  `captain_id` int(11) unsigned NOT NULL,
  `avaiable_seats` int(11) unsigned NOT NULL,
  `route_id` int(11) unsigned NOT NULL,
  `per_seat_rate` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`booking_id`),
  KEY `route_id` (`route_id`),
  KEY `vehicle_id` (`vehicle_id`),
  KEY `captain_id` (`captain_id`),
  CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`route_id`) REFERENCES `routes` (`route_id`),
  CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_id`),
  CONSTRAINT `bookings_ibfk_3` FOREIGN KEY (`captain_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `city` */

DROP TABLE IF EXISTS `city`;

CREATE TABLE `city` (
  `city_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `city_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `routes` */

DROP TABLE IF EXISTS `routes`;

CREATE TABLE `routes` (
  `route_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `from` int(11) unsigned NOT NULL,
  `to` int(11) unsigned NOT NULL,
  PRIMARY KEY (`route_id`),
  KEY `from` (`from`),
  KEY `to` (`to`),
  CONSTRAINT `routes_ibfk_1` FOREIGN KEY (`from`) REFERENCES `city` (`city_id`),
  CONSTRAINT `routes_ibfk_2` FOREIGN KEY (`to`) REFERENCES `city` (`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `user_seat_booking` */

DROP TABLE IF EXISTS `user_seat_booking`;

CREATE TABLE `user_seat_booking` (
  `user_seat_booking_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `booking_id` int(11) unsigned NOT NULL,
  `status` int(11) DEFAULT 1,
  PRIMARY KEY (`user_seat_booking_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_seat_booking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

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

/*Table structure for table `vehicles` */

DROP TABLE IF EXISTS `vehicles`;

CREATE TABLE `vehicles` (
  `vehicle_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `registration_number` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `wheels` int(11) NOT NULL,
  `seats` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `image` blob NOT NULL,
  `added_on` datetime DEFAULT NULL,
  PRIMARY KEY (`vehicle_id`),
  UNIQUE KEY `registration_number` (`registration_number`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
