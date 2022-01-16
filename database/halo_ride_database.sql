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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `bookings` */

insert  into `bookings`(`booking_id`,`vehicle_id`,`captain_id`,`avaiable_seats`,`route_id`,`per_seat_rate`) values 
(4,4,6,17,7,500),
(5,5,6,0,8,700),
(6,6,8,0,7,500);

/*Table structure for table `city` */

DROP TABLE IF EXISTS `city`;

CREATE TABLE `city` (
  `city_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `city_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

/*Data for the table `city` */

insert  into `city`(`city_id`,`city_name`) values 
(12,'Hyderabad'),
(13,'Karachi'),
(14,'Jamshoro'),
(15,'Larkana');

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

/*Data for the table `routes` */

insert  into `routes`(`route_id`,`from`,`to`) values 
(7,12,13),
(8,13,12),
(9,14,15),
(10,15,14),
(12,12,15);

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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user_seat_booking` */

insert  into `user_seat_booking`(`user_seat_booking_id`,`user_id`,`booking_id`,`status`) values 
(15,5,4,1),
(16,5,5,1),
(17,5,5,1),
(18,5,5,1),
(19,5,5,1),
(20,5,4,1),
(21,5,6,1),
(22,5,6,1),
(23,5,6,1),
(24,5,6,1),
(25,5,4,1),
(26,7,4,1),
(27,5,4,1),
(28,5,4,1),
(29,5,4,1),
(30,5,4,1),
(31,5,4,1),
(32,5,4,1),
(33,5,4,1),
(34,5,4,1),
(35,5,4,1);

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`user_id`,`role_id`,`full_name`,`email`,`phone_number`,`cnic`,`password`,`image`,`status`,`added_on`) values 
(5,1,'Admin','admin@gmail.com','0300-1231231','41504-1231232-2','123','',1,'0000-00-00 00:00:00'),
(6,2,'Siraj','siraj@gmail.com','0312-1232123','123123123123123','123',NULL,0,'0000-00-00 00:00:00'),
(7,3,'Ahmed','ahmed@gmail.com','0321-1231231','12312312312','123',NULL,1,'0000-00-00 00:00:00'),
(8,2,'John','john@gmail.com','0300-12121212','3123123123','202cb962ac59075b964b07152d234b70','images/',1,'2021-12-12 11:15:24');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `vehicles` */

insert  into `vehicles`(`vehicle_id`,`registration_number`,`type`,`wheels`,`seats`,`status`,`image`,`added_on`) values 
(4,'ABC-123','Bus',6,30,1,'','2021-11-27 17:32:43'),
(5,'DEF-432','Car',4,4,1,'',NULL),
(6,'fgh-453','Car',4,4,0,'images/','2021-12-12 11:17:25');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
