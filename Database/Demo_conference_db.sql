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
CREATE DATABASE /*!32312 IF NOT EXISTS*/`Demo_conference_db` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `Demo_conference_db`;

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

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
