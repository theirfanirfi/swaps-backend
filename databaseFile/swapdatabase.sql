/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.5.5-10.1.30-MariaDB : Database - swaps
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`swaps` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `swaps`;

/*Table structure for table `followers` */

DROP TABLE IF EXISTS `followers`;

CREATE TABLE `followers` (
  `f_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `followed_user_id` int(11) NOT NULL,
  `follower_user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `followers` */

insert  into `followers`(`f_id`,`followed_user_id`,`follower_user_id`,`created_at`,`updated_at`) values (1,4,3,NULL,NULL),(2,5,3,NULL,NULL),(3,3,88,NULL,NULL),(14,3,8,'2018-12-20 18:15:47','2018-12-20 18:15:47'),(15,8,3,'2018-12-21 04:51:33','2018-12-21 04:51:33');

/*Table structure for table `messages` */

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
  `m_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL DEFAULT '0',
  `reciever_id` int(11) NOT NULL DEFAULT '0',
  `chat_id` int(11) DEFAULT '0',
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'The message is empty.',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `messages` */

insert  into `messages`(`m_id`,`sender_id`,`reciever_id`,`chat_id`,`message`,`created_at`,`updated_at`) values (1,3,8,1,'how are you 3 is the sender',NULL,NULL),(2,8,3,1,'I am fine 8 is the sender and 3 reciever',NULL,NULL),(3,3,8,1,'The message is empty.','2018-12-20 13:15:49','2018-12-20 13:15:49'),(4,3,8,1,'this message is from the browser where reciever id is 8 and sender id is 3','2018-12-20 13:16:36','2018-12-20 13:16:36'),(5,8,3,1,'hello','2018-12-20 15:37:41','2018-12-20 15:37:41'),(6,8,3,1,'hello','2018-12-20 15:38:00','2018-12-20 15:38:00'),(7,8,3,1,'how are you.','2018-12-20 15:38:47','2018-12-20 15:38:47'),(8,8,3,1,'is it refereshing?','2018-12-20 15:44:41','2018-12-20 15:44:41'),(9,3,8,1,'is it working',NULL,NULL),(10,8,3,1,'Iam fine what about you?','2018-12-20 16:23:44','2018-12-20 16:23:44'),(11,3,8,1,'I am fine as well.',NULL,NULL),(12,8,3,1,'good luck','2018-12-20 16:27:13','2018-12-20 16:27:13'),(13,3,8,1,'Thanks.',NULL,NULL),(14,8,3,1,'THIS IS MESSAGE POSITIN CHECKING. IF IT WORKED. IT WOULD BE GREAE AND I WILL PROCEED TO THE NEXT TASKT. THANKS','2018-12-20 16:32:37','2018-12-20 16:32:37'),(15,8,3,1,'working','2018-12-20 17:05:07','2018-12-20 17:05:07'),(16,3,8,0,'not working',NULL,NULL),(17,3,8,0,'wallay yar.',NULL,NULL),(18,8,3,1,'haha','2018-12-20 17:15:24','2018-12-20 17:15:24'),(19,3,8,0,'THIS IS MESSAGE POSITIN CHECKING. IF IT WORKED. IT WOULD BE GREAE AND I WILL PROCEED TO THE NEXT TASKT. THANKS',NULL,NULL),(20,8,3,1,'nothing to worry.','2018-12-20 17:27:40','2018-12-20 17:27:40'),(21,8,3,1,'time testing.','2018-12-20 22:49:56','2018-12-20 22:49:56'),(22,8,3,1,'how are you?','2018-12-21 09:35:11','2018-12-21 09:35:11'),(23,3,8,1,'I am fine, what about you?','2018-12-21 09:35:40','2018-12-21 09:35:40'),(24,8,3,1,'hello tesitng?','2018-12-21 09:38:37','2018-12-21 09:38:37'),(25,3,8,1,'yes, it is working','2018-12-21 09:38:49','2018-12-21 09:38:49'),(26,3,8,1,'hello, it is the demo video.','2018-12-21 09:46:49','2018-12-21 09:46:49'),(27,8,3,1,'okay. I got it?','2018-12-21 09:47:16','2018-12-21 09:47:16');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2018_12_04_135211_create_statuses_table',1),(2,'2018_12_04_135849_create_swaps_table',1),(3,'2018_12_04_162721_create_rattings_table',1),(4,'2018_12_04_162834_create_followers_table',1),(5,'2018_12_04_163007_create_participants_table',1),(6,'2018_12_04_163109_create_messages_table',1);

/*Table structure for table `notifications` */

DROP TABLE IF EXISTS `notifications`;

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `isStatus` tinyint(1) DEFAULT '0',
  `isFollow` tinyint(1) DEFAULT '0',
  `isFollowed` tinyint(1) DEFAULT '0',
  `isSwap` tinyint(1) DEFAULT '0',
  `isDeclined` tinyint(1) DEFAULT '0',
  `status_id` int(11) DEFAULT '0',
  `followed_id` int(11) DEFAULT '0',
  `follower_id` int(11) DEFAULT '0',
  `isAccepted` tinyint(1) DEFAULT '0',
  `swaper_id` int(11) DEFAULT '0',
  `swaped_with_id` int(11) DEFAULT '0',
  `isViewed` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `swap_id` int(11) DEFAULT NULL,
  `is_accepted` int(11) DEFAULT NULL,
  PRIMARY KEY (`notification_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `notifications` */

insert  into `notifications`(`notification_id`,`isStatus`,`isFollow`,`isFollowed`,`isSwap`,`isDeclined`,`status_id`,`followed_id`,`follower_id`,`isAccepted`,`swaper_id`,`swaped_with_id`,`isViewed`,`created_at`,`updated_at`,`swap_id`,`is_accepted`) values (1,1,0,0,0,0,7,0,0,0,3,4,0,'2018-12-15 09:56:39','2018-12-15 09:56:39',NULL,NULL),(5,1,0,0,0,0,12,0,0,1,8,3,0,'2018-12-16 16:15:22','2018-12-16 11:15:22',6,0),(7,1,0,0,0,0,7,0,0,1,3,8,0,'2018-12-17 16:19:58','2018-12-17 11:19:58',7,0),(8,1,0,0,0,0,10,0,0,0,8,3,0,'2018-12-17 11:18:13','2018-12-17 11:18:13',8,0),(9,1,0,0,0,0,13,0,0,1,3,8,0,'2018-12-17 16:22:27','2018-12-17 11:22:27',9,0),(10,1,0,0,0,0,15,0,0,1,8,3,0,'2018-12-21 09:44:24','2018-12-21 04:44:24',10,0);

/*Table structure for table `participants` */

DROP TABLE IF EXISTS `participants`;

CREATE TABLE `participants` (
  `chat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_one` int(11) NOT NULL,
  `user_two` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`chat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `participants` */

insert  into `participants`(`chat_id`,`user_one`,`user_two`,`created_at`,`updated_at`) values (1,3,8,NULL,NULL),(2,5,3,NULL,NULL);

/*Table structure for table `rattings` */

DROP TABLE IF EXISTS `rattings`;

CREATE TABLE `rattings` (
  `ratting_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ratted_by_user_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `ratting` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ratting_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `rattings` */

insert  into `rattings`(`ratting_id`,`ratted_by_user_id`,`status_id`,`ratting`,`created_at`,`updated_at`) values (5,3,2,3,NULL,NULL),(10,3,4,3,NULL,NULL),(11,3,4,5,NULL,NULL),(12,3,4,3,NULL,NULL),(13,3,7,4,'2018-12-11 08:05:17','2018-12-13 08:10:00'),(17,3,6,3,'2018-12-12 12:05:09','2018-12-13 08:09:33'),(18,3,5,4,'2018-12-12 12:06:35','2018-12-12 12:06:42'),(19,8,7,5,'2018-12-15 17:45:24','2018-12-15 17:45:56'),(20,8,6,5,'2018-12-15 17:52:33','2018-12-15 17:52:33'),(23,8,12,5,'2018-12-15 20:11:17','2018-12-15 20:13:20'),(24,3,12,3,'2018-12-16 07:51:58','2018-12-16 08:03:02'),(25,8,10,4,'2018-12-16 13:12:06','2018-12-16 13:12:06'),(26,8,13,5,'2018-12-17 11:23:06','2018-12-18 11:36:01'),(27,3,13,3,'2018-12-18 15:25:09','2018-12-21 04:45:15'),(28,3,15,2,'2018-12-21 04:44:30','2018-12-21 04:44:44');

/*Table structure for table `statuses` */

DROP TABLE IF EXISTS `statuses`;

CREATE TABLE `statuses` (
  `status_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `posting_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `statuses` */

insert  into `statuses`(`status_id`,`user_id`,`status`,`created_at`,`updated_at`,`posting_time`) values (2,3,'hello','2018-12-06 17:59:41','2018-12-06 17:59:41',NULL),(4,3,'sjsj','2018-12-07 10:25:15','2018-12-07 10:25:15',NULL),(5,3,'sjsj','2018-12-07 10:25:23','2018-12-07 10:25:23',NULL),(6,3,'hooo','2018-12-07 10:42:53','2018-12-07 10:42:53',NULL),(7,3,'this is my new post','2018-12-12 21:17:48','2018-12-12 21:17:48','1544631468'),(8,4,'this is my new post','2018-12-12 21:17:48','2018-12-12 21:17:48','1544631468'),(9,4,'hello, this is my HFM Post.','2018-12-15 22:26:52','2018-12-15 22:26:52','1544894812'),(10,8,'this my post  from hfm account.','2018-12-15 22:33:43','2018-12-15 22:33:43','1544895223'),(12,8,'mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm','2018-12-16 00:38:46','2018-12-16 00:38:46','1544902726'),(13,3,'newest post.','2018-12-17 16:21:06','2018-12-17 16:21:06','1545045666'),(14,8,'greate to see you here.','2018-12-20 22:47:32','2018-12-20 22:47:32','1545328052'),(15,8,'here is the status. do you like it?','2018-12-21 09:42:59','2018-12-21 09:42:59','1545367379');

/*Table structure for table `swaps` */

DROP TABLE IF EXISTS `swaps`;

CREATE TABLE `swaps` (
  `swap_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `poster_user_id` int(11) NOT NULL,
  `swaped_with_user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `is_accepted` int(11) DEFAULT '0',
  `is_rejected` int(11) DEFAULT '0',
  PRIMARY KEY (`swap_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `swaps` */

insert  into `swaps`(`swap_id`,`poster_user_id`,`swaped_with_user_id`,`created_at`,`updated_at`,`status_id`,`is_accepted`,`is_rejected`) values (1,3,4,'2018-12-12 16:16:56','2018-12-12 16:16:56',6,0,1),(3,3,4,'2018-12-15 09:56:38','2018-12-15 09:56:38',7,1,0),(4,3,4,'2018-12-15 09:56:38','2018-12-15 09:56:38',6,1,0),(6,8,3,'2018-12-15 20:06:30','2018-12-16 11:15:22',12,1,0),(7,3,8,'2018-12-17 11:08:20','2018-12-17 11:19:58',7,1,0),(8,8,3,'2018-12-17 11:18:13','2018-12-17 11:18:13',10,0,0),(9,3,8,'2018-12-17 11:21:30','2018-12-17 11:22:27',13,1,0),(10,8,3,'2018-12-21 04:43:34','2018-12-21 04:44:24',15,1,0);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_description` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`user_id`,`name`,`username`,`profile_description`,`email`,`email_verified_at`,`password`,`token`,`profile_image`,`remember_token`,`created_at`,`updated_at`) values (3,'Irfan Ullah','irfi','updated. Hi, My name is Irfan Ullah. I am a professional Web, Mobile and Desktop Applications developer with more than 3 years of development exprience.','theirfi@gmail.com',NULL,'$2y$10$BkKAr/DM8f6xKkZrvORtF.gLquyb0Mc.bSNfJ.WQw4TkhOYUTcq4y','$2y$10$G0RWLNAiFq/fwZe0sUA7.uqLYoHwhV0hmkcdmk87VmpIzB5QF7IWK','http://192.168.10.3/swap/public/profile/swaps.png',NULL,'2018-12-05 16:46:27','2018-12-23 07:18:36'),(4,'Shahid','shahid',NULL,'shahid@gmail.com',NULL,'$2y$10$Ro2ZWRB0JD8MeSnvVVVMkOVuLbt3v0OxSsJ5uhy6LkeSQjv/lQSTm','$2y$10$mR80fo54ji3clnjKr8x1K.K9JkHKYQ4OOHO8tfSbu9ZD2e8hP3Q0y',NULL,NULL,'2018-12-05 17:00:20','2018-12-05 17:00:20'),(5,'Shoaib','shoaib',NULL,'fsdfsdfsdfsdf',NULL,'$2y$10$fea7Ki/3Lr48R.w3v/g8oOMWck1gW/jHn1WOkvYzxZFOsm0Qp0/PO',NULL,NULL,NULL,'2018-12-05 17:13:18','2018-12-05 17:13:18'),(6,'fsfsdfd','fsdfsdf',NULL,'fsdfsdfd@mail.com',NULL,'$2y$10$Hq.vX9IEoRyxySU24oQdVu7y6TnSM1qJYD1.k6jZOvopuiuEF4O9e',NULL,NULL,NULL,'2018-12-06 09:41:06','2018-12-06 09:41:06'),(8,'HFM Irfan','hfmkhan','this is profile description.','hfm@gmail.com',NULL,'$2y$10$kH5FyznOgB3qTA0xME6gqu4/bMZ.JXX/VuhOaf8HUp6opw0MRVTXK','$2y$10$wrfzz/YU0SUYeCtE9gHAnuvPzb4IFUhNS.67JYKWpFDLaYSxb5yJ6','https://canadianpizzaunlimited.ca/images/slider/PickUpSpecial2.jpg',NULL,'2018-12-15 17:32:21','2018-12-18 10:35:45');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
