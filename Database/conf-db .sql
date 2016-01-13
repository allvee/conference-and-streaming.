/*
SQLyog Enterprise - MySQL GUI v8.14 
MySQL - 5.5.19 : Database - conference
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`conference` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `conference`;

/*Table structure for table `menus` */

DROP TABLE IF EXISTS `menus`;

CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT NULL,
  `last_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `menus` */

insert  into `menus`(`id`,`name`,`url`,`status`,`last_updated`) values (1,'Configuration','firewall_config','inactive',NULL);
insert  into `menus`(`id`,`name`,`url`,`status`,`last_updated`) values (2,'Device','firewall_device_view','inactive',NULL);
insert  into `menus`(`id`,`name`,`url`,`status`,`last_updated`) values (3,'Group','firewall_group_view','active',NULL);
insert  into `menus`(`id`,`name`,`url`,`status`,`last_updated`) values (4,'Time Profile','firewall_time_profile_view','active',NULL);
insert  into `menus`(`id`,`name`,`url`,`status`,`last_updated`) values (5,'Rules','firewall_rules_view','active',NULL);
insert  into `menus`(`id`,`name`,`url`,`status`,`last_updated`) values (6,'Role Management','firewall_organization_view','active',NULL);
insert  into `menus`(`id`,`name`,`url`,`status`,`last_updated`) values (7,'Maintenance','firewall_maintenance','active',NULL);
insert  into `menus`(`id`,`name`,`url`,`status`,`last_updated`) values (8,'Firewall Log','diagnosis_firewall','inactive',NULL);
insert  into `menus`(`id`,`name`,`url`,`status`,`last_updated`) values (9,'Show Configuration',NULL,'active',NULL);
insert  into `menus`(`id`,`name`,`url`,`status`,`last_updated`) values (10,'Backup/Restore','firewall_backup','active',NULL);
insert  into `menus`(`id`,`name`,`url`,`status`,`last_updated`) values (11,'Audit Trail','audit','active',NULL);
insert  into `menus`(`id`,`name`,`url`,`status`,`last_updated`) values (12,'Settings','remote_gateway','active',NULL);
insert  into `menus`(`id`,`name`,`url`,`status`,`last_updated`) values (13,'Activity','activity','active',NULL);

/*Table structure for table `org_users` */

DROP TABLE IF EXISTS `org_users`;

CREATE TABLE `org_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `org_users` */

insert  into `org_users`(`id`,`org_id`,`user_id`) values (7,1,8);
insert  into `org_users`(`id`,`org_id`,`user_id`) values (8,5,28);
insert  into `org_users`(`id`,`org_id`,`user_id`) values (9,4,27);

/*Table structure for table `organization` */

DROP TABLE IF EXISTS `organization`;

CREATE TABLE `organization` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `master_company_id` int(11) DEFAULT NULL,
  `ip_addresses` text,
  `mac_addresses` text,
  `status` enum('active','inactive') DEFAULT NULL,
  `last_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `organization` */

insert  into `organization`(`id`,`name`,`parent_id`,`master_company_id`,`ip_addresses`,`mac_addresses`,`status`,`last_updated`) values (1,'cuet',0,1,'','28:D2:44:F3:40:C2','active','2015-12-23 20:50:03');
insert  into `organization`(`id`,`name`,`parent_id`,`master_company_id`,`ip_addresses`,`mac_addresses`,`status`,`last_updated`) values (3,'we',0,1,'','28:D2:44:F3:40:C1','active','2015-12-23 21:18:28');
insert  into `organization`(`id`,`name`,`parent_id`,`master_company_id`,`ip_addresses`,`mac_addresses`,`status`,`last_updated`) values (4,'xc',0,1,'','dsf','active','2015-12-27 19:13:39');
insert  into `organization`(`id`,`name`,`parent_id`,`master_company_id`,`ip_addresses`,`mac_addresses`,`status`,`last_updated`) values (5,'kuet',0,1,'','11:@@:','active','2016-01-13 06:44:00');

/*Table structure for table `role_menus` */

DROP TABLE IF EXISTS `role_menus`;

CREATE TABLE `role_menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rule_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `permissions` text,
  `status` enum('active','inactive') DEFAULT NULL,
  `last_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;

/*Data for the table `role_menus` */

insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (1,1,1,'{\"add\":\"no\",\"edit\":\"no\",\"delete\":\"no\",\"view\":\"no\"}','active','2015-12-11 01:16:59');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (2,1,2,'{\"add\":\"yes\",\"edit\":\"yes\",\"delete\":\"yes\",\"view\":\"yes\"}','active','2015-12-11 01:16:59');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (3,1,3,'{\"add\":\"yes\",\"edit\":\"yes\",\"delete\":\"yes\",\"view\":\"yes\"}','active','2015-12-11 01:16:59');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (4,1,5,'{\"add\":\"yes\",\"edit\":\"yes\",\"delete\":\"yes\",\"view\":\"yes\"}','active','2015-12-11 01:16:59');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (5,1,6,'{\"add\":\"yes\",\"edit\":\"yes\",\"delete\":\"yes\",\"view\":\"yes\"}','active','2015-12-11 01:16:59');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (6,1,7,'{\"add\":\"yes\",\"edit\":\"yes\",\"delete\":\"yes\",\"view\":\"yes\"}','active','2015-12-11 01:16:59');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (7,1,9,'{\"add\":\"yes\",\"edit\":\"yes\",\"delete\":\"yes\",\"view\":\"yes\"}','active','2015-12-11 01:16:59');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (8,1,10,'{\"add\":\"yes\",\"edit\":\"yes\",\"delete\":\"yes\",\"view\":\"yes\"}','active','2015-12-11 01:16:59');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (9,1,11,'{\"add\":\"yes\",\"edit\":\"yes\",\"delete\":\"yes\",\"view\":\"yes\"}','active','2015-12-11 01:16:59');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (10,2,1,'{\"add\":\"no\",\"edit\":\"no\",\"delete\":\"no\",\"view\":\"no\"}','active','2015-12-11 01:33:44');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (11,2,2,'{\"add\":\"no\",\"edit\":\"no\",\"delete\":\"no\",\"view\":\"no\"}','active','2015-12-11 01:33:44');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (12,1,12,'{\"add\":\"yes\",\"edit\":\"yes\",\"delete\":\"yes\",\"view\":\"yes\"}','active','2015-12-11 01:33:44');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (13,2,5,'{\"add\":\"yes\",\"edit\":\"yes\",\"delete\":\"yes\",\"view\":\"yes\"}','active','2015-12-11 01:33:44');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (14,2,6,'{\"add\":\"no\",\"edit\":\"no\",\"delete\":\"no\",\"view\":\"no\"}','active','2015-12-11 01:33:44');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (15,2,7,'{\"add\":\"no\",\"edit\":\"no\",\"delete\":\"no\",\"view\":\"no\"}','active','2015-12-11 01:33:44');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (16,2,9,'{\"add\":\"no\",\"edit\":\"no\",\"delete\":\"no\",\"view\":\"no\"}','active','2015-12-11 01:33:44');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (17,2,10,'{\"add\":\"no\",\"edit\":\"no\",\"delete\":\"no\",\"view\":\"no\"}','active','2015-12-11 01:33:44');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (18,2,11,'{\"add\":\"no\",\"edit\":\"no\",\"delete\":\"no\",\"view\":\"no\"}','active','2015-12-11 01:33:44');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (43,7,3,'{\"add\":\"yes\",\"edit\":\"yes\",\"delete\":\"yes\",\"view\":\"yes\"}','active','2015-12-28 00:02:32');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (44,7,5,'{\"add\":\"yes\",\"edit\":\"yes\",\"delete\":\"yes\",\"view\":\"yes\"}','active','2015-12-28 00:02:32');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (45,7,6,'{\"add\":\"yes\",\"edit\":\"yes\",\"delete\":\"yes\",\"view\":\"yes\"}','active','2015-12-28 00:02:32');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (46,7,7,'{\"add\":\"yes\",\"edit\":\"yes\",\"delete\":\"yes\",\"view\":\"yes\"}','active','2015-12-28 00:02:32');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (47,7,9,'{\"add\":\"no\",\"edit\":\"no\",\"delete\":\"no\",\"view\":\"no\"}','active','2015-12-28 00:02:32');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (48,7,10,'{\"add\":\"no\",\"edit\":\"no\",\"delete\":\"no\",\"view\":\"yes\"}','active','2015-12-28 00:02:32');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (49,7,11,'{\"add\":\"yes\",\"edit\":\"no\",\"delete\":\"no\",\"view\":\"yes\"}','active','2015-12-28 00:02:32');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (50,7,12,'{\"add\":\"no\",\"edit\":\"no\",\"delete\":\"no\",\"view\":\"no\"}','active','2015-12-28 00:02:32');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (51,8,3,'{\"add\":\"no\",\"edit\":\"yes\",\"delete\":\"no\",\"view\":\"no\"}','active','2015-12-30 02:22:45');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (52,8,4,'{\"add\":\"no\",\"edit\":\"no\",\"delete\":\"no\",\"view\":\"no\"}','active','2015-12-30 02:22:45');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (53,8,5,'{\"add\":\"no\",\"edit\":\"no\",\"delete\":\"no\",\"view\":\"no\"}','active','2015-12-30 02:22:45');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (54,8,6,'{\"add\":\"no\",\"edit\":\"no\",\"delete\":\"no\",\"view\":\"no\"}','active','2015-12-30 02:22:45');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (55,8,7,'{\"add\":\"no\",\"edit\":\"no\",\"delete\":\"no\",\"view\":\"no\"}','active','2015-12-30 02:22:45');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (56,8,9,'{\"add\":\"no\",\"edit\":\"no\",\"delete\":\"no\",\"view\":\"no\"}','active','2015-12-30 02:22:45');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (57,8,10,'{\"add\":\"no\",\"edit\":\"no\",\"delete\":\"no\",\"view\":\"no\"}','active','2015-12-30 02:22:45');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (58,8,11,'{\"add\":\"no\",\"edit\":\"no\",\"delete\":\"no\",\"view\":\"no\"}','active','2015-12-30 02:22:45');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (59,8,12,'{\"add\":\"no\",\"edit\":\"no\",\"delete\":\"no\",\"view\":\"no\"}','active','2015-12-30 02:22:45');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (60,9,3,'{\"add\":\"no\",\"edit\":\"no\",\"delete\":\"no\",\"view\":\"yes\"}','active','2016-01-13 12:46:56');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (61,9,4,'{\"add\":\"no\",\"edit\":\"no\",\"delete\":\"no\",\"view\":\"yes\"}','active','2016-01-13 12:46:56');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (62,9,5,'{\"add\":\"no\",\"edit\":\"no\",\"delete\":\"no\",\"view\":\"yes\"}','active','2016-01-13 12:46:56');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (63,9,6,'{\"add\":\"no\",\"edit\":\"no\",\"delete\":\"no\",\"view\":\"yes\"}','active','2016-01-13 12:46:56');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (64,9,7,'{\"add\":\"no\",\"edit\":\"no\",\"delete\":\"no\",\"view\":\"no\"}','active','2016-01-13 12:46:56');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (65,9,9,'{\"add\":\"no\",\"edit\":\"no\",\"delete\":\"no\",\"view\":\"yes\"}','active','2016-01-13 12:46:56');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (66,9,10,'{\"add\":\"no\",\"edit\":\"no\",\"delete\":\"no\",\"view\":\"yes\"}','active','2016-01-13 12:46:56');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (67,9,11,'{\"add\":\"no\",\"edit\":\"no\",\"delete\":\"no\",\"view\":\"no\"}','active','2016-01-13 12:46:56');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (68,9,12,'{\"add\":\"no\",\"edit\":\"no\",\"delete\":\"no\",\"view\":\"no\"}','active','2016-01-13 12:46:56');
insert  into `role_menus`(`id`,`rule_id`,`menu_id`,`permissions`,`status`,`last_updated`) values (69,9,13,'{\"add\":\"no\",\"edit\":\"no\",\"delete\":\"no\",\"view\":\"no\"}','active','2016-01-13 12:46:56');

/*Table structure for table `role_mgmt_sync_status_log` */

DROP TABLE IF EXISTS `role_mgmt_sync_status_log`;

CREATE TABLE `role_mgmt_sync_status_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `component` varchar(20) DEFAULT NULL,
  `status` enum('Success','Failed') DEFAULT NULL,
  `remote_host` varchar(30) DEFAULT NULL,
  `write_time` datetime DEFAULT NULL,
  `last_updated` datetime DEFAULT NULL,
  `last_updated_by` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `role_mgmt_sync_status_log` */

insert  into `role_mgmt_sync_status_log`(`id`,`component`,`status`,`remote_host`,`write_time`,`last_updated`,`last_updated_by`) values (1,'Role','Failed','192.168.245.34','2016-01-08 11:07:13','2016-01-08 11:07:13','admin');
insert  into `role_mgmt_sync_status_log`(`id`,`component`,`status`,`remote_host`,`write_time`,`last_updated`,`last_updated_by`) values (2,'Role Menus','Failed','192.168.245.34','2016-01-08 11:07:04','2016-01-08 11:07:04','admin');
insert  into `role_mgmt_sync_status_log`(`id`,`component`,`status`,`remote_host`,`write_time`,`last_updated`,`last_updated_by`) values (3,'Organization','Failed','192.168.245.34','2016-01-08 11:07:33','2016-01-08 11:07:33','admin');
insert  into `role_mgmt_sync_status_log`(`id`,`component`,`status`,`remote_host`,`write_time`,`last_updated`,`last_updated_by`) values (4,'Role Menus','Failed','192.168.245.34','2016-01-08 11:07:46','2016-01-08 11:07:46','admin');
insert  into `role_mgmt_sync_status_log`(`id`,`component`,`status`,`remote_host`,`write_time`,`last_updated`,`last_updated_by`) values (5,'Role','Failed','192.168.245.34','2016-01-08 11:17:43','2016-01-08 11:17:43','admin');
insert  into `role_mgmt_sync_status_log`(`id`,`component`,`status`,`remote_host`,`write_time`,`last_updated`,`last_updated_by`) values (6,'Organization','Failed','192.168.245.34','2016-01-08 11:17:54','2016-01-08 11:17:54','admin');
insert  into `role_mgmt_sync_status_log`(`id`,`component`,`status`,`remote_host`,`write_time`,`last_updated`,`last_updated_by`) values (7,'Organization','Success','192.168.245.34','2016-01-08 11:26:12','2016-01-08 11:26:12','admin');
insert  into `role_mgmt_sync_status_log`(`id`,`component`,`status`,`remote_host`,`write_time`,`last_updated`,`last_updated_by`) values (8,'Role','Success','192.168.245.34','2016-01-13 05:56:59','2016-01-13 05:56:59','admin');

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `org_id` varchar(100) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT NULL,
  `last_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`org_id`,`status`,`last_updated`) values (7,'Full Access','3','active','2016-01-13 07:01:54');
insert  into `roles`(`id`,`name`,`org_id`,`status`,`last_updated`) values (8,'sdsad','5','active','2016-01-13 07:08:47');
insert  into `roles`(`id`,`name`,`org_id`,`status`,`last_updated`) values (9,'kuet_access','5','active','2016-01-13 07:01:57');
insert  into `roles`(`id`,`name`,`org_id`,`status`,`last_updated`) values (10,'qwewq','3','active','2016-01-13 07:02:08');
insert  into `roles`(`id`,`name`,`org_id`,`status`,`last_updated`) values (11,'safaf','3','active','2016-01-13 07:08:59');

/*Table structure for table `tbl_conference` */

DROP TABLE IF EXISTS `tbl_conference`;

CREATE TABLE `tbl_conference` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `Conf_Name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `long_number` varchar(20) DEFAULT NULL,
  `User` varchar(50) CHARACTER SET utf8 NOT NULL,
  `room_number` varchar(10) NOT NULL,
  `weblink` varchar(200) DEFAULT NULL,
  `Code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Start_Time` datetime NOT NULL,
  `End_Time` datetime NOT NULL,
  `Participants` int(10) unsigned DEFAULT NULL,
  `Recording` enum('yes','no') CHARACTER SET utf8 DEFAULT NULL,
  `Status` enum('active','done') CHARACTER SET utf8 NOT NULL,
  `Schedule_Conf` varchar(10) DEFAULT NULL,
  `Notification_Channel` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_conference` */

insert  into `tbl_conference`(`ID`,`Conf_Name`,`long_number`,`User`,`room_number`,`weblink`,`Code`,`Start_Time`,`End_Time`,`Participants`,`Recording`,`Status`,`Schedule_Conf`,`Notification_Channel`) values (28,'conf1','01720258009','admin','3001','weblink','3111','2016-01-13 19:13:27','2016-01-13 15:00:00',5,'yes','done','Daily','SMS / EMAIL ');
insert  into `tbl_conference`(`ID`,`Conf_Name`,`long_number`,`User`,`room_number`,`weblink`,`Code`,`Start_Time`,`End_Time`,`Participants`,`Recording`,`Status`,`Schedule_Conf`,`Notification_Channel`) values (29,'conf1','01720258009','admin','3001','weblink','3111','2016-01-13 19:15:41','2016-01-13 15:00:00',5,'yes','done','Once','SMS  ');
insert  into `tbl_conference`(`ID`,`Conf_Name`,`long_number`,`User`,`room_number`,`weblink`,`Code`,`Start_Time`,`End_Time`,`Participants`,`Recording`,`Status`,`Schedule_Conf`,`Notification_Channel`) values (30,'abcd','','admin','','weblink','3111','2016-01-13 19:18:20','2016-01-13 15:00:00',5,'yes','done','Once','  ');
insert  into `tbl_conference`(`ID`,`Conf_Name`,`long_number`,`User`,`room_number`,`weblink`,`Code`,`Start_Time`,`End_Time`,`Participants`,`Recording`,`Status`,`Schedule_Conf`,`Notification_Channel`) values (31,'conf1','01720258009','admin','3002','weblink','3111','2016-01-13 19:19:39','2016-01-13 15:00:00',5,'no','done','Once','SMS  ');
insert  into `tbl_conference`(`ID`,`Conf_Name`,`long_number`,`User`,`room_number`,`weblink`,`Code`,`Start_Time`,`End_Time`,`Participants`,`Recording`,`Status`,`Schedule_Conf`,`Notification_Channel`) values (32,'conf1','01720258009','admin','3002','weblink','3111','2016-01-13 19:21:30','2016-01-13 15:00:00',5,'no','done','Once','SMS  ');

/*Table structure for table `tbl_conference_room` */

DROP TABLE IF EXISTS `tbl_conference_room`;

CREATE TABLE `tbl_conference_room` (
  `ID` int(11) NOT NULL,
  `room_name` varchar(20) NOT NULL,
  `room_status` enum('busy','free') DEFAULT NULL,
  `room_admin` varchar(20) NOT NULL,
  `room_number` varchar(10) NOT NULL,
  `last_update` datetime NOT NULL,
  `room_caller` varchar(20) NOT NULL,
  `web_link` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_conference_room` */

insert  into `tbl_conference_room`(`ID`,`room_name`,`room_status`,`room_admin`,`room_number`,`last_update`,`room_caller`,`web_link`) values (0,'room1','free','3001','3002','2015-12-27 19:38:32','3101','http://ssd-tech.com/');
insert  into `tbl_conference_room`(`ID`,`room_name`,`room_status`,`room_admin`,`room_number`,`last_update`,`room_caller`,`web_link`) values (1,'room11','free','3011','3012','2015-12-09 17:35:36','3111','http://ssd-tech.com/');
insert  into `tbl_conference_room`(`ID`,`room_name`,`room_status`,`room_admin`,`room_number`,`last_update`,`room_caller`,`web_link`) values (2,'room13','free','3014','3013','2015-11-09 17:35:36','3113','http://ssd-tech.com/');
insert  into `tbl_conference_room`(`ID`,`room_name`,`room_status`,`room_admin`,`room_number`,`last_update`,`room_caller`,`web_link`) values (3,'room15','free','3016','3015','2015-10-09 13:35:36','3115','http://ssd-tech.com/');
insert  into `tbl_conference_room`(`ID`,`room_name`,`room_status`,`room_admin`,`room_number`,`last_update`,`room_caller`,`web_link`) values (4,'room17','free','3018','3017','2016-01-12 16:35:36','3117','http://ssd-tech.com/');
insert  into `tbl_conference_room`(`ID`,`room_name`,`room_status`,`room_admin`,`room_number`,`last_update`,`room_caller`,`web_link`) values (5,'room19','free','3020','3019','2015-11-09 16:35:36','3118','http://ssd-tech.com/products/enterprise-networking-solutions/');
insert  into `tbl_conference_room`(`ID`,`room_name`,`room_status`,`room_admin`,`room_number`,`last_update`,`room_caller`,`web_link`) values (6,'room3','free','3004','3003','2015-08-09 11:35:36','3103','http://ssd-tech.com/products/enterprise-networking-solutions/');
insert  into `tbl_conference_room`(`ID`,`room_name`,`room_status`,`room_admin`,`room_number`,`last_update`,`room_caller`,`web_link`) values (7,'room7','free','3008','3007','2015-11-09 16:35:36','3107','http://ssd-tech.com/products/enterprise-networking-solutions/');
insert  into `tbl_conference_room`(`ID`,`room_name`,`room_status`,`room_admin`,`room_number`,`last_update`,`room_caller`,`web_link`) values (8,'room9','free','3010','3009','2016-01-09 06:35:36','3109','http://ssd-tech.com/products/enterprise-networking-solutions/');

/*Table structure for table `tbl_group_management` */

DROP TABLE IF EXISTS `tbl_group_management`;

CREATE TABLE `tbl_group_management` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `Group_Name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Address` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `Contact` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `Admin_User_ID` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `Password` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `Email_Address` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_group_management` */

insert  into `tbl_group_management`(`ID`,`Group_Name`,`Address`,`Contact`,`Admin_User_ID`,`Password`,`Email_Address`) values (1,'Group_Name','Address','Contact','Admin_User_ID','Password','Email_Address');
insert  into `tbl_group_management`(`ID`,`Group_Name`,`Address`,`Contact`,`Admin_User_ID`,`Password`,`Email_Address`) values (2,'$group_name','$group_address','$group_contact','$admin_user_id','$group_pass','$email_id');
insert  into `tbl_group_management`(`ID`,`Group_Name`,`Address`,`Contact`,`Admin_User_ID`,`Password`,`Email_Address`) values (3,'','','','','','');
insert  into `tbl_group_management`(`ID`,`Group_Name`,`Address`,`Contact`,`Admin_User_ID`,`Password`,`Email_Address`) values (4,'abcd group','test address','test group name','test Admin UserID','pass','ddf@sad.sadf');
insert  into `tbl_group_management`(`ID`,`Group_Name`,`Address`,`Contact`,`Admin_User_ID`,`Password`,`Email_Address`) values (5,'abcd group','test address','test group name','test Admin UserID','pass','sdsd@adj.df');

/*Table structure for table `tbl_pariticipant` */

DROP TABLE IF EXISTS `tbl_pariticipant`;

CREATE TABLE `tbl_pariticipant` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `participant_name` varchar(100) NOT NULL,
  `msisdn` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `conference_name` varchar(50) NOT NULL,
  `organization` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pariticipant` */

insert  into `tbl_pariticipant`(`ID`,`participant_name`,`msisdn`,`email`,`conference_name`,`organization`) values (1,'jamal','01720258009','jamal@ssd-tech.com','conf1','ssd-tech');

/*Table structure for table `tbl_user` */

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `user_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `UserID` varchar(20) CHARACTER SET utf8 NOT NULL,
  `UserName` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Password` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Organization` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `UserType` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ReferenceInfo` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Remarks` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `LastModifiedUserID` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `LastUpdate` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_user` */

insert  into `tbl_user`(`user_id`,`UserID`,`UserName`,`Password`,`Email`,`Organization`,`UserType`,`ReferenceInfo`,`Remarks`,`LastModifiedUserID`,`LastUpdate`) values (1,'admin','admin','21232f297a57a5a743894a0e4a801fc3','admin@softswitch.com',NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00');

/*Table structure for table `tbl_user_management` */

DROP TABLE IF EXISTS `tbl_user_management`;

CREATE TABLE `tbl_user_management` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `User_ID` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Group_Name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Password` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `Conference_Create` varchar(20) DEFAULT NULL,
  `Conference_Edit` varchar(20) DEFAULT NULL,
  `Conference_Delete` varchar(20) DEFAULT NULL,
  `User_role_Management` varchar(20) DEFAULT NULL,
  `Create_Date` date DEFAULT NULL,
  `Status` enum('active','inactive') DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_user_management` */

insert  into `tbl_user_management`(`ID`,`User_ID`,`Name`,`Group_Name`,`Type`,`Password`,`Conference_Create`,`Conference_Edit`,`Conference_Delete`,`User_role_Management`,`Create_Date`,`Status`) values (20,'123','test name','test group name',' test type',' pass','1','1','1','1','2016-01-07','active');
insert  into `tbl_user_management`(`ID`,`User_ID`,`Name`,`Group_Name`,`Type`,`Password`,`Conference_Create`,`Conference_Edit`,`Conference_Delete`,`User_role_Management`,`Create_Date`,`Status`) values (21,'123','test name','test group name',' test type',' pass','','','','','2016-01-10','active');

/*Table structure for table `user_role_association` */

DROP TABLE IF EXISTS `user_role_association`;

CREATE TABLE `user_role_association` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(10) DEFAULT NULL,
  `role_id` bigint(11) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `user_role_association` */

insert  into `user_role_association`(`id`,`user_id`,`role_id`,`status`) values (6,39,7,'active');
insert  into `user_role_association`(`id`,`user_id`,`role_id`,`status`) values (7,7,7,'inactive');
insert  into `user_role_association`(`id`,`user_id`,`role_id`,`status`) values (8,8,8,'active');
insert  into `user_role_association`(`id`,`user_id`,`role_id`,`status`) values (9,28,9,'active');

/*Table structure for table `user_types` */

DROP TABLE IF EXISTS `user_types`;

CREATE TABLE `user_types` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `user_types` */

insert  into `user_types`(`id`,`user_type`) values (1,'Super User');
insert  into `user_types`(`id`,`user_type`) values (2,'Administrator');
insert  into `user_types`(`id`,`user_type`) values (3,'General User');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
