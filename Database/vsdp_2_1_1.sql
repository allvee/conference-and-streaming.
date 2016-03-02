/*
SQLyog Enterprise - MySQL GUI v8.14 
MySQL - 5.5.47 : Database - vsdp_2_1_1
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`vsdp_2_1_1` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `vsdp_2_1_1`;

/*Table structure for table `UserHistory` */

DROP TABLE IF EXISTS `UserHistory`;

CREATE TABLE `UserHistory` (
  `ano` int(11) DEFAULT NULL,
  `bno` int(11) DEFAULT NULL,
  `serviceName` varchar(100) DEFAULT NULL,
  `CallStartTime` varchar(100) DEFAULT NULL,
  `CallEndTime` varchar(100) DEFAULT NULL,
  `CallID` varchar(100) DEFAULT NULL,
  `traversedFileList` varchar(10000) DEFAULT NULL,
  `lastPlayedFile` varchar(100) DEFAULT NULL,
  `sentBytes` int(11) DEFAULT NULL,
  `releasecause` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `UserHistory` */

insert  into `UserHistory`(`ano`,`bno`,`serviceName`,`CallStartTime`,`CallEndTime`,`CallID`,`traversedFileList`,`lastPlayedFile`,`sentBytes`,`releasecause`) values (401,4001,'OBD_Test','2015-11-08_15:57:09','2015-11-08_15:57:09','19806208112015155709','','',0,'1B5E');
insert  into `UserHistory`(`ano`,`bno`,`serviceName`,`CallStartTime`,`CallEndTime`,`CallID`,`traversedFileList`,`lastPlayedFile`,`sentBytes`,`releasecause`) values (3101,2002,'callconnect','2015-11-08_15:57:10','2015-11-08_15:57:38','19806008112015155709','main_prompt.wav','/ismp/shared/test/Prompts/News_Portal/main_prompt.wav',16000,'0');
insert  into `UserHistory`(`ano`,`bno`,`serviceName`,`CallStartTime`,`CallEndTime`,`CallID`,`traversedFileList`,`lastPlayedFile`,`sentBytes`,`releasecause`) values (2001,3001,'callconnectpatch','2015-11-08_15:57:11','2015-11-08_15:57:38','19809908112015155711','','',0,'1B7B');
insert  into `UserHistory`(`ano`,`bno`,`serviceName`,`CallStartTime`,`CallEndTime`,`CallID`,`traversedFileList`,`lastPlayedFile`,`sentBytes`,`releasecause`) values (4101,4001,'OBD_Test','2015-11-08_16:00:58','2015-11-08_16:00:58','19806208112015160058','','',0,'1B5E');
insert  into `UserHistory`(`ano`,`bno`,`serviceName`,`CallStartTime`,`CallEndTime`,`CallID`,`traversedFileList`,`lastPlayedFile`,`sentBytes`,`releasecause`) values (3101,2003,'callconnect','2015-11-08_16:01:00','2015-11-08_16:01:14','19806108112015160100','main_prompt.wav','/ismp/shared/test/Prompts/News_Portal/main_prompt.wav',16000,'0');
insert  into `UserHistory`(`ano`,`bno`,`serviceName`,`CallStartTime`,`CallEndTime`,`CallID`,`traversedFileList`,`lastPlayedFile`,`sentBytes`,`releasecause`) values (2001,3001,'callconnectpatch','2015-11-08_16:01:01','2015-11-08_16:01:14','19809808112015160101','','',0,'1B7B');
insert  into `UserHistory`(`ano`,`bno`,`serviceName`,`CallStartTime`,`CallEndTime`,`CallID`,`traversedFileList`,`lastPlayedFile`,`sentBytes`,`releasecause`) values (2002,4001,'OBD_Test','2015-11-08_16:04:20','2015-11-08_16:04:20','19806208112015160420','','',0,'1B5E');
insert  into `UserHistory`(`ano`,`bno`,`serviceName`,`CallStartTime`,`CallEndTime`,`CallID`,`traversedFileList`,`lastPlayedFile`,`sentBytes`,`releasecause`) values (2002,4001,'OBD_Test','2015-11-08_16:07:24','2015-11-08_16:12:32','19806208112015160724','Song08.wav','/ismp/shared/2580_Kitchen/WAV8KHz8BitMono/Song08.wav',2458370,'1B5E');
insert  into `UserHistory`(`ano`,`bno`,`serviceName`,`CallStartTime`,`CallEndTime`,`CallID`,`traversedFileList`,`lastPlayedFile`,`sentBytes`,`releasecause`) values (3101,2003,'callconnect','2015-11-08_16:07:29','2015-11-08_16:44:59','19806108112015160729','main_prompt.wav','/ismp/shared/test/Prompts/News_Portal/main_prompt.wav',16000,'0');
insert  into `UserHistory`(`ano`,`bno`,`serviceName`,`CallStartTime`,`CallEndTime`,`CallID`,`traversedFileList`,`lastPlayedFile`,`sentBytes`,`releasecause`) values (2001,3001,'callconnectpatch','2015-11-08_16:07:30','2015-11-08_16:44:59','19809808112015160730','','',0,'1B7B');
insert  into `UserHistory`(`ano`,`bno`,`serviceName`,`CallStartTime`,`CallEndTime`,`CallID`,`traversedFileList`,`lastPlayedFile`,`sentBytes`,`releasecause`) values (3101,2002,'callconnect','2015-11-08_16:07:25','2015-11-08_17:04:10','19806008112015160725','main_prompt.wav','/ismp/shared/test/Prompts/News_Portal/main_prompt.wav',16000,'0');
insert  into `UserHistory`(`ano`,`bno`,`serviceName`,`CallStartTime`,`CallEndTime`,`CallID`,`traversedFileList`,`lastPlayedFile`,`sentBytes`,`releasecause`) values (2001,3001,'callconnectpatch','2015-11-08_16:07:26','2015-11-08_17:04:10','19809908112015160726','','',0,'1B7B');
insert  into `UserHistory`(`ano`,`bno`,`serviceName`,`CallStartTime`,`CallEndTime`,`CallID`,`traversedFileList`,`lastPlayedFile`,`sentBytes`,`releasecause`) values (2002,4001,'OBD_Test','2015-11-08_17:06:04','2015-11-08_17:09:50','19806208112015170604','Song02.wav','/ismp/shared/2580_Kitchen/WAV8KHz8BitMono/Song02.wav',1800960,'1B5E');
insert  into `UserHistory`(`ano`,`bno`,`serviceName`,`CallStartTime`,`CallEndTime`,`CallID`,`traversedFileList`,`lastPlayedFile`,`sentBytes`,`releasecause`) values (2003,4001,'OBD_Test','2015-12-27_17:23:48','2015-12-27_17:23:48','4606027122015172348','','',0,'1B5E');
insert  into `UserHistory`(`ano`,`bno`,`serviceName`,`CallStartTime`,`CallEndTime`,`CallID`,`traversedFileList`,`lastPlayedFile`,`sentBytes`,`releasecause`) values (2008,2003,'OBD_Test','2015-12-27_17:25:59','2015-12-27_17:25:59','4606027122015172558','','',0,'1B5E');
insert  into `UserHistory`(`ano`,`bno`,`serviceName`,`CallStartTime`,`CallEndTime`,`CallID`,`traversedFileList`,`lastPlayedFile`,`sentBytes`,`releasecause`) values (2003,2003,'OBD_Test','2015-12-27_17:27:29','2015-12-27_17:27:29','4606027122015172729','','',0,'1B5E');
insert  into `UserHistory`(`ano`,`bno`,`serviceName`,`CallStartTime`,`CallEndTime`,`CallID`,`traversedFileList`,`lastPlayedFile`,`sentBytes`,`releasecause`) values (2003,2003,'OBD_Test','2015-12-27_17:28:01','2015-12-27_17:28:01','4606027122015172801','','',0,'1B5E');
insert  into `UserHistory`(`ano`,`bno`,`serviceName`,`CallStartTime`,`CallEndTime`,`CallID`,`traversedFileList`,`lastPlayedFile`,`sentBytes`,`releasecause`) values (2003,2003,'OBD_Test','2015-12-27_17:29:40','2015-12-27_17:29:55','4606027122015172940','Song04.wav','/ismp/shared/2580_Kitchen/WAV8KHz8BitMono/Song04.wav',120000,'0');
insert  into `UserHistory`(`ano`,`bno`,`serviceName`,`CallStartTime`,`CallEndTime`,`CallID`,`traversedFileList`,`lastPlayedFile`,`sentBytes`,`releasecause`) values (2003,4001,'OBD_Test','2015-12-27_17:31:30','2015-12-27_17:37:49','4606027122015173130','Song04.wav','/ismp/shared/2580_Kitchen/WAV8KHz8BitMono/Song04.wav',3036674,'1B5E');
insert  into `UserHistory`(`ano`,`bno`,`serviceName`,`CallStartTime`,`CallEndTime`,`CallID`,`traversedFileList`,`lastPlayedFile`,`sentBytes`,`releasecause`) values (2003,3101,'callconnect3001','2015-12-27_17:58:07','2015-12-27_17:58:07','4600127122015175807','','',0,'1B5D');
insert  into `UserHistory`(`ano`,`bno`,`serviceName`,`CallStartTime`,`CallEndTime`,`CallID`,`traversedFileList`,`lastPlayedFile`,`sentBytes`,`releasecause`) values (3101,3001,'callconnectpatch','2015-12-27_17:59:47','2015-12-27_18:01:08','4609927122015175947','','',0,'1B7B');
insert  into `UserHistory`(`ano`,`bno`,`serviceName`,`CallStartTime`,`CallEndTime`,`CallID`,`traversedFileList`,`lastPlayedFile`,`sentBytes`,`releasecause`) values (2003,3101,'callconnect3001','2015-12-27_17:59:46','2015-12-27_18:01:08','4600127122015175946','main_prompt.wav','/ismp/shared/test/Prompts/News_Portal/main_prompt.wav',16000,'0');
insert  into `UserHistory`(`ano`,`bno`,`serviceName`,`CallStartTime`,`CallEndTime`,`CallID`,`traversedFileList`,`lastPlayedFile`,`sentBytes`,`releasecause`) values (3101,3001,'callconnectpatch','2015-12-27_18:01:28','2015-12-27_18:01:33','4609927122015180128','','',0,'1B7B');
insert  into `UserHistory`(`ano`,`bno`,`serviceName`,`CallStartTime`,`CallEndTime`,`CallID`,`traversedFileList`,`lastPlayedFile`,`sentBytes`,`releasecause`) values (2002,3101,'callconnect3001','2015-12-27_18:01:27','2015-12-27_18:01:33','4600127122015180127','main_prompt.wav','/ismp/shared/test/Prompts/News_Portal/main_prompt.wav',16000,'0');
insert  into `UserHistory`(`ano`,`bno`,`serviceName`,`CallStartTime`,`CallEndTime`,`CallID`,`traversedFileList`,`lastPlayedFile`,`sentBytes`,`releasecause`) values (2004,3101,'callconnect3001','2015-12-27_18:01:53','2015-12-27_18:01:59','4600127122015180153','main_prompt.wav','/ismp/shared/test/Prompts/News_Portal/main_prompt.wav',16000,'0');
insert  into `UserHistory`(`ano`,`bno`,`serviceName`,`CallStartTime`,`CallEndTime`,`CallID`,`traversedFileList`,`lastPlayedFile`,`sentBytes`,`releasecause`) values (3101,3001,'callconnectpatch','2015-12-27_18:01:54','2015-12-27_18:01:59','4609927122015180154','','',0,'1B7B');
insert  into `UserHistory`(`ano`,`bno`,`serviceName`,`CallStartTime`,`CallEndTime`,`CallID`,`traversedFileList`,`lastPlayedFile`,`sentBytes`,`releasecause`) values (2003,4001,'OBD_Test','2015-12-27_17:57:02','2015-12-27_18:03:21','4606027122015175702','Song04.wav','/ismp/shared/2580_Kitchen/WAV8KHz8BitMono/Song04.wav',3036674,'1B5E');
insert  into `UserHistory`(`ano`,`bno`,`serviceName`,`CallStartTime`,`CallEndTime`,`CallID`,`traversedFileList`,`lastPlayedFile`,`sentBytes`,`releasecause`) values (2003,3101,'callconnect3001','2015-12-27_18:02:18','2015-12-27_18:05:12','4600127122015180218','main_prompt.wav','/ismp/shared/test/Prompts/News_Portal/main_prompt.wav',16000,'0');
insert  into `UserHistory`(`ano`,`bno`,`serviceName`,`CallStartTime`,`CallEndTime`,`CallID`,`traversedFileList`,`lastPlayedFile`,`sentBytes`,`releasecause`) values (3101,3001,'callconnectpatch','2015-12-27_18:02:19','2015-12-27_18:05:12','4609927122015180219','','',0,'1B7B');
insert  into `UserHistory`(`ano`,`bno`,`serviceName`,`CallStartTime`,`CallEndTime`,`CallID`,`traversedFileList`,`lastPlayedFile`,`sentBytes`,`releasecause`) values (2003,2008,'bmp','2015-12-27_19:36:41','2015-12-27_19:37:38','4600127122015193641','main_prompt.wav,Song01.wav,Song02.wav,Song03.wav,Song04.wav,Song05.wav,Song06.wav','/ismp/shared/2580_Kitchen/WAV8KHz8BitMono/Song06.wav',104000,'1B89');
insert  into `UserHistory`(`ano`,`bno`,`serviceName`,`CallStartTime`,`CallEndTime`,`CallID`,`traversedFileList`,`lastPlayedFile`,`sentBytes`,`releasecause`) values (2003,3001,'record_conference','2015-12-27_19:38:38','2015-12-27_19:38:38','4606027122015193838','','',0,'1B5D');
insert  into `UserHistory`(`ano`,`bno`,`serviceName`,`CallStartTime`,`CallEndTime`,`CallID`,`traversedFileList`,`lastPlayedFile`,`sentBytes`,`releasecause`) values (3101,2003,'callconnect','2015-12-27_19:38:39','2015-12-27_19:41:12','4606127122015193839','main_prompt.wav','/ismp/shared/test/Prompts/News_Portal/main_prompt.wav',16000,'0');
insert  into `UserHistory`(`ano`,`bno`,`serviceName`,`CallStartTime`,`CallEndTime`,`CallID`,`traversedFileList`,`lastPlayedFile`,`sentBytes`,`releasecause`) values (2001,3001,'callconnectpatch','2015-12-27_19:38:40','2015-12-27_19:41:12','4609927122015193840','','',0,'1B7B');
insert  into `UserHistory`(`ano`,`bno`,`serviceName`,`CallStartTime`,`CallEndTime`,`CallID`,`traversedFileList`,`lastPlayedFile`,`sentBytes`,`releasecause`) values (2003,2008,'bmp','2015-12-27_19:41:14','2015-12-27_19:42:00','4600127122015194114','main_prompt.wav,conference__111115120238pm2003198061.wav,conference__22111544038pm2003198063.wav','/ismp/shared/test/recordings/record_conference/conference__22111544038pm2003198063.wav',245440,'0');
insert  into `UserHistory`(`ano`,`bno`,`serviceName`,`CallStartTime`,`CallEndTime`,`CallID`,`traversedFileList`,`lastPlayedFile`,`sentBytes`,`releasecause`) values (2003,4001,'OBD_Test','2015-12-27_19:38:38','2015-12-27_19:44:06','4606427122015193838','Song06.wav','/ismp/shared/2580_Kitchen/WAV8KHz8BitMono/Song06.wav',2624850,'1B5E');

/*Table structure for table `UserUpdatedInfo` */

DROP TABLE IF EXISTS `UserUpdatedInfo`;

CREATE TABLE `UserUpdatedInfo` (
  `ano` int(11) NOT NULL,
  `bno` int(11) NOT NULL,
  `serviceName` varchar(100) NOT NULL,
  `lastPlayedFile` varchar(100) DEFAULT NULL,
  `sentBytes` int(11) DEFAULT NULL,
  `currentState` varchar(100) DEFAULT NULL,
  `lastPressedKey` int(11) DEFAULT '0',
  `lastFilePosition` int(11) DEFAULT '0',
  `lastActionCommand` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ano`,`bno`,`serviceName`),
  KEY `id_index` (`bno`,`serviceName`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `UserUpdatedInfo` */

insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (100,2008,'callconnect','',0,'0',0,0,'PlaceStream');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (123,2001,'OBD_Test','/ismp/shared/test/Prompts/full_test/hindi10.wav',33890,'1',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (123,2002,'OBD_Test','/ismp/shared/test/Prompts/full_test/hindi10.wav',33890,'1',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (301,3001,'record_conference','/ismp/shared/test/Prompts/record_conference/record_voice.wav',56160,'10',1,0,'Disconnectcall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (401,4001,'OBD_Test','',0,'1',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (425,2000,'OBD_Test','/ismp/shared/test/Prompts/full_test/hindi10.wav',48000,'0',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (425,2001,'OBD_Test','/ismp/shared/test/Prompts/full_test/hindi10.wav',40000,'0',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (425,2002,'OBD_Test','/ismp/shared/test/Prompts/full_test/hindi10.wav',216000,'0',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (543,2000,'OBD_Test','/ismp/shared/test/Prompts/full_test/hindi10.wav',896000,'0',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (543,2001,'OBD_Test','/ismp/shared/test/Prompts/full_test/hindi10.wav',808000,'0',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (543,2002,'OBD_Test','/ismp/shared/test/Prompts/full_test/hindi10.wav',240000,'0',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (628,2001,'OBD_Test','/ismp/shared/test/Prompts/full_test/hindi10.wav',272000,'0',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (628,2002,'OBD_Test','/ismp/shared/test/Prompts/full_test/hindi10.wav',232000,'0',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (629,2000,'OBD_Test','/ismp/shared/test/Prompts/full_test/hindi10.wav',104000,'0',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (629,2001,'OBD_Test','/ismp/shared/test/Prompts/full_test/hindi10.wav',152000,'0',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (629,2002,'OBD_Test','/ismp/shared/test/Prompts/full_test/hindi10.wav',200000,'0',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (639,2000,'OBD_Test','/ismp/shared/test/Prompts/full_test/hindi10.wav',280000,'0',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (639,2001,'OBD_Test','/ismp/shared/test/Prompts/full_test/hindi10.wav',248000,'0',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (641,2000,'OBD_Test','/ismp/shared/test/Prompts/full_test/hindi10.wav',456000,'0',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (641,2001,'OBD_Test','/ismp/shared/test/Prompts/full_test/hindi10.wav',104000,'0',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (641,2002,'OBD_Test','/ismp/shared/test/Prompts/full_test/hindi10.wav',304000,'0',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (644,2000,'OBD_Test','/ismp/shared/test/Prompts/full_test/hindi10.wav',108752,'1',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (644,2001,'OBD_Test','/ismp/shared/test/Prompts/full_test/hindi10.wav',104000,'0',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (1000,2580,'callconnectpatch','',0,'0',0,0,'Patchcall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (1000,2580,'full_test','/ismp/shared/test/prompts/News_Portal/full_test/arc.wav',32000,'0',0,0,'Inputs');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (1000,2580,'test_patch_call','',0,'0',0,0,'Patchcall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (1124,2001,'OBD_Test','/ismp/shared/test/prompts/test_place_call/arc.wav',10,'1',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (1124,2580,'OBD_Test','/ismp/shared/test/prompts/test_place_call/arc.wav',86342,'1',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (1156,2001,'OBD_Test','/ismp/shared/test/prompts/test_place_call/arc.wav',10,'1',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (1234,2001,'OBD_Test','/ismp/shared/test/Prompts/OBD_1.wav',200000,'0',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (1234,2002,'OBD_Test','/ismp/shared/test/Prompts/OBD_1.wav',211196,'1',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2000,32,'callconnectpatch','',-1,'0',0,0,'Patchcall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2000,1000,'callconnectpatch','',0,'0',0,0,'Patchcall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2000,2001,'callconnectpatch','',0,'0',0,0,'Patchcall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2000,2001,'test_patch_call','',-1,'0',0,0,'Patchcall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2000,2008,'callconnect','/ismp/shared/test/prompts/News_Portal/hindi10.wav',1,'0',0,0,'Conference');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2000,2200,'callconnectpatch','',-1,'0',0,0,'Patchcall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2000,2300,'callconnectpatch','',0,'0',0,0,'Patchcall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2000,2580,'callconnectpatch','',0,'0',0,0,'Patchcall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2000,2580,'DhakaGate','/ismp/shared/test/prompts/News_Portal/full_test/1.wav',6004,'2',0,0,'Disconnectcall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2000,2580,'full_test','/ismp/shared/test/prompts/News_Portal/full_test/interview_direction.wav',16000,'1',3,0,'Inputs');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2000,2580,'full_test_2','/ismp/shared/test/prompts/full_test_2/arc.wav',86342,'0',0,0,'Inputs');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2000,2580,'record_2','/ismp/shared/test/recordings/test_record_file/recording_test_180815112639pm2000207001.wav',5,'1',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2000,2580,'record_listen','/ismp/shared/test/recordings/test_record_file/recording_test_180815103333pm2000207001.wav',4,'0',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2000,2580,'test_browselist','/ismp/shared/2580_Kitchen/WAV8KHz8BitMono/ranna1.wav',7,'0',0,0,'Browselist');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2000,2580,'test_patch_call','',-1,'0',0,0,'Patchcall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2000,2580,'test_pause','/ismp/shared/test/prompts/test_pause/hindi10.wav',58,'0',0,0,'Pause_File');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2000,2580,'test_place_call','',0,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2000,2580,'test_play_file','/ismp/shared/test/prompts/test_play_file/arc.wav',10,'0',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2000,2580,'test_record_file','/ismp/shared/test/prompts/test_record_file/record.wav',1,'0',0,0,'RecordWithTime');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2000,2580,'test_resume','/ismp/shared/2580_Kitchen/WAV8KHz8BitMono/ranna1.wav',80000,'13',2,0,'Browselist');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2001,111,'callconnectpatch','',0,'0',0,0,'Patchcall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2001,333,'callconnectpatch','',0,'0',0,0,'Patchcall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2001,666,'callconnectpatch','',0,'0',0,0,'Patchcall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2001,2000,'callconnectpatch','',0,'0',0,0,'Patchcall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2001,2000,'OBD_Test','/ismp/shared/test/prompts/full_test_2/likeDrama.wav',1,'1',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2001,2000,'test_patch_call','',-1,'0',0,0,'Patchcall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2001,2001,'callconnect','',0,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2001,2008,'callconnect','/ismp/shared/test/Prompts/News_Portal/hindi10.wav',1,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2001,2008,'full_test_2','/ismp/shared/test/prompts/full_test_2/arc.wav',7,'0',0,0,'Inputs');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2001,2008,'record_play_test','/ismp/shared/test/prompts/record_play_test/arc.wav',3,'12',0,0,'Disconnectcall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2001,2008,'test_record_file','/ismp/shared/test/prompts/test_record_file/record.wav',1,'1',0,0,'Disconnectcall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2001,2200,'','',-1,'1',0,0,'');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2001,2200,'OBD_Test','/ismp/shared/test/prompts/full_test_2/likeDrama.wav',1,'1',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2001,2200,'test_patch_call','',-1,'0',0,0,'Patchcall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2001,2580,'','',0,'0',0,0,'');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2001,2580,'DhakaGate','/ismp/shared/test/prompts/News_Portal/full_test/1.wav',6004,'2',0,0,'Disconnectcall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2001,2580,'full_test','/ismp/shared/test/prompts/News_Portal/full_test/arc.wav',16000,'0',0,0,'Inputs');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2001,2580,'full_test_2','/ismp/shared/test/prompts/full_test_2/welcome.wav',216000,'0',0,0,'Inputs');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2001,2580,'OBD_Test','/ismp/shared/test/prompts/full_test_2/likeDrama.wav',14530,'1',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2001,2580,'record_2','',-1,'0',0,0,'');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2001,2580,'test_input','/ismp/shared/test/prompts/test_input/record_voice.wav',56160,'1',3,0,'RecordWithTime');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2001,2580,'test_patch_call','',-1,'0',0,0,'Patchcall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2001,2580,'test_pause','/ismp/shared/test/prompts/test_pause/hindi10.wav',88000,'0',0,0,'Pause_File');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2001,2580,'test_place_call','/ismp/shared/test/Prompts/News_Portal/hindi10.wav',8000,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2001,2580,'test_play_file','/ismp/shared/test/prompts/test_play_file/hindi10.wav',6,'1',0,0,'Disconnectcall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2001,2580,'test_record_file','/ismp/shared/test/prompts/test_record_file/record.wav',1,'1',0,0,'Disconnectcall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2001,3001,'callconnectpatch','',0,'0',0,0,'Patchcall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2001,3011,'callconnectpatch','',0,'0',0,0,'Patchcall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2001,3013,'callconnectpatch','',0,'0',0,0,'Patchcall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2001,3015,'callconnectpatch','',0,'0',0,0,'Patchcall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2001,3101,'callconnect3001','/ismp/shared/test/Prompts/News_Portal/hindi10.wav',16000,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2001,3103,'callconnect3003','',0,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2001,3111,'callconnect3011','/ismp/shared/test/Prompts/News_Portal/hindi10.wav',8000,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2001,3113,'callconnect3013','',0,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2002,666,'callconnectpatch','',-1,'0',0,0,'Patchcall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2002,2002,'callconnect','',0,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2002,2008,'callconnect','/ismp/shared/test/Prompts/News_Portal/hindi10.wav',8000,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2002,2008,'full_test_2','/ismp/shared/test/prompts/full_test_2/arc.wav',10,'0',0,0,'Inputs');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2002,2580,'full_test_2','/ismp/shared/test/prompts/full_test_2/welcome.wav',2,'1',2,0,'Pause_File');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2002,2580,'test_patch_call','',-1,'0',0,0,'Patchcall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2002,2580,'test_place_call','/ismp/shared/test/Prompts/News_Portal/hindi10.wav',8000,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2002,3001,'record_conference','/ismp/shared/test/Prompts/record_conference/record_voice.wav',56160,'10',1,0,'Disconnectcall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2002,3101,'callconnect3001','/ismp/shared/test/Prompts/News_Portal/main_prompt.wav',16000,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2002,3103,'callconnect3003','/ismp/shared/test/Prompts/News_Portal/hindi10.wav',280000,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2002,3111,'callconnect3011','/ismp/shared/test/Prompts/News_Portal/hindi10.wav',8000,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2002,3113,'callconnect3013','/ismp/shared/test/Prompts/News_Portal/hindi10.wav',8000,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2002,4001,'OBD_Test','/ismp/shared/2580_Kitchen/WAV8KHz8BitMono/Song02.wav',1800960,'1',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2002,4101,'test_play_file','/ismp/shared/test/Prompts/DiGi-BanglaNewsNew/JukexoxOBD.wav',237570,'1',0,0,'Disconnectcall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2003,2003,'callconnect','/ismp/shared/test/Prompts/News_Portal/hindi10.wav',8000,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2003,2003,'OBD_Test','/ismp/shared/2580_Kitchen/WAV8KHz8BitMono/Song04.wav',120000,'0',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2003,2008,'bmp','/ismp/shared/test/recordings/record_conference/conference__22111544038pm2003198063.wav',245440,'1',1,9,'Browselist');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2003,2008,'callconnect','/ismp/shared/test/Prompts/News_Portal/hindi10.wav',8000,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2003,2580,'test_place_call','/ismp/shared/test/Prompts/News_Portal/hindi10.wav',8000,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2003,3001,'record_conference','',0,'0',0,0,'RECORD_CONFERENCE');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2003,3101,'callconnect3001','/ismp/shared/test/Prompts/News_Portal/main_prompt.wav',16000,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2003,3111,'callconnect3011','/ismp/shared/test/Prompts/News_Portal/hindi10.wav',8000,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2003,3113,'callconnect3013','/ismp/shared/test/Prompts/News_Portal/hindi10.wav',8000,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2003,4001,'OBD_Test','/ismp/shared/2580_Kitchen/WAV8KHz8BitMono/Song06.wav',2624850,'1',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2004,2004,'callconnect','/ismp/shared/test/Prompts/News_Portal/hindi10.wav',8000,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2004,2008,'callconnect','/ismp/shared/test/Prompts/News_Portal/hindi10.wav',8000,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2004,2580,'test_place_call','/ismp/shared/test/Prompts/News_Portal/hindi10.wav',8000,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2004,3101,'callconnect3001','/ismp/shared/test/Prompts/News_Portal/main_prompt.wav',16000,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2005,2005,'callconnect','/ismp/shared/test/Prompts/News_Portal/hindi10.wav',8000,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2005,2008,'callconnect','/ismp/shared/test/Prompts/News_Portal/hindi10.wav',8000,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2005,2580,'full_test_2','/ismp/shared/test/Prompts/2008_MobileDrama_7_4/full_test_2/arc.wav',48000,'0',0,0,'Inputs');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2005,2580,'test_place_call','/ismp/shared/test/Prompts/News_Portal/hindi10.wav',8000,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2006,2006,'callconnect','/ismp/shared/test/Prompts/News_Portal/hindi10.wav',8000,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2006,2008,'callconnect','/ismp/shared/test/Prompts/News_Portal/hindi10.wav',8000,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2006,2580,'full_test_2','/ismp/shared/test/Prompts/2008_MobileDrama_7_4/full_test_2/hindi10.wav',1744000,'13',3,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2006,2580,'test_place_call','/ismp/shared/test/Prompts/News_Portal/hindi10.wav',8000,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2008,1000,'OBD_Test','/ismp/shared/test/prompts/News_Portal/full_test/hindi10.wav',312000,'0',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2008,2000,'OBD_Test','/ismp/shared/test/prompts/test_place_call/arc.wav',10,'1',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2008,2001,'callconnect','',0,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2008,2001,'OBD_Test','/ismp/shared/test/prompts/test_place_call/playnews.wav',47,'0',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2008,2002,'callconnect','',0,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2008,2002,'OBD_Test','/ismp/shared/test/Prompts/full_test/hindi10.wav',272000,'0',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2008,2003,'OBD_Test','',0,'1',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2008,2580,'OBD_Test','/ismp/shared/test/prompts/test_place_call/arc.wav',86342,'1',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2580,2000,'OBD_Test','/ismp/shared/test/prompts/full_test_2/likeDrama.wav',1,'1',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2580,2001,'OBD_Test','/ismp/shared/test/prompts/full_test_2/likeDrama.wav',108752,'1',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2580,2002,'OBD_Test','/ismp/shared/test/Prompts/full_test/hindi10.wav',408000,'0',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2580,2200,'OBD_Test','/ismp/shared/test/prompts/full_test_2/likeDrama.wav',1,'1',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2580,2580,'OBD_Test','/ismp/shared/test/prompts/full_test_2/likeDrama.wav',1,'1',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (2580,2580,'test_play_file','/ismp/shared/test/prompts/test_play_file/hindi10.wav',264000,'0',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (3001,2002,'OBD_Test','/ismp/shared/tes',0,'0',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (3001,4001,'OBD_Test','/ismp/shared/test/Prompts/full_test_2/hindi10.wav',2512176,'1',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (3101,2001,'callconnect','/ismp/shared/test/Prompts/News_Portal/hindi10.wav',16000,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (3101,2002,'callconnect','/ismp/shared/test/Prompts/News_Portal/main_prompt.wav',16000,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (3101,2003,'callconnect','/ismp/shared/test/Prompts/News_Portal/main_prompt.wav',16000,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (3101,2004,'callconnect','/ismp/shared/test/Prompts/News_Portal/hindi10.wav',16000,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (3101,2005,'callconnect','/ismp/shared/test/Prompts/News_Portal/hindi10.wav',16000,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (3101,3001,'callconnectpatch','',0,'0',0,0,'Patchcall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (3101,4001,'OBD_Test','/ismp/shared/test/Prompts/full_test_2/hindi10.wav',2512176,'1',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (3111,2001,'callconnect','/ismp/shared/test/Prompts/News_Portal/hindi10.wav',8000,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (3111,2002,'callconnect','/ismp/shared/test/Prompts/News_Portal/hindi10.wav',8000,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (3111,2003,'callconnect','/ismp/shared/test/Prompts/News_Portal/hindi10.wav',8000,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (3113,2001,'callconnect','/ismp/shared/test/Prompts/News_Portal/hindi10.wav',8000,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (3113,2002,'callconnect','/ismp/shared/test/Prompts/News_Portal/hindi10.wav',8000,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (3113,2003,'callconnect','/ismp/shared/test/Prompts/News_Portal/hindi10.wav',8000,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (3115,2001,'callconnect','/ismp/shared/test/Prompts/News_Portal/hindi10.wav',8000,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (3115,2002,'callconnect','/ismp/shared/test/Prompts/News_Portal/hindi10.wav',8000,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (4001,2300,'callconnect','',0,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (4101,2300,'callconnect','',0,'0',0,0,'Placecall');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (4101,4001,'OBD_Test','',0,'1',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (12345,2000,'OBD_Test','/ismp/shared/test/Prompts/full_test/hindi10.wav',64000,'0',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (12345,2001,'OBD_Test','/ismp/shared/test/Prompts/full_test/hindi10.wav',64000,'0',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (12345,2002,'OBD_Test','/ismp/shared/test/Prompts/full_test/hindi10.wav',120000,'0',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (22222,2000,'OBD_Test','/ismp/shared/test/Prompts/full_test/hindi10.wav',48000,'0',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (22222,2001,'OBD_Test','/ismp/shared/test/Prompts/full_test/hindi10.wav',176000,'0',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (8020221,2000,'OBD_Test','/ismp/shared/test/Prompts/full_test/hindi10.wav',56000,'0',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (8020221,2001,'OBD_Test','/ismp/shared/test/Prompts/full_test/hindi10.wav',480000,'0',0,0,'Playfile');
insert  into `UserUpdatedInfo`(`ano`,`bno`,`serviceName`,`lastPlayedFile`,`sentBytes`,`currentState`,`lastPressedKey`,`lastFilePosition`,`lastActionCommand`) values (8020221,2002,'OBD_Test','/ismp/shared/test/Prompts/full_test/hindi10.wav',480000,'0',0,0,'Playfile');

/*Table structure for table `allowedtime` */

DROP TABLE IF EXISTS `allowedtime`;

CREATE TABLE `allowedtime` (
  `timeslotid` varchar(50) NOT NULL,
  `startday` int(11) DEFAULT NULL,
  `endday` int(11) DEFAULT NULL,
  `starttime` int(11) DEFAULT NULL,
  `endtime` int(11) DEFAULT NULL,
  `activestart` datetime DEFAULT NULL,
  `activeend` datetime DEFAULT NULL,
  `serviceID` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `allowedtime` */

/*Table structure for table `applicationsettings` */

DROP TABLE IF EXISTS `applicationsettings`;

CREATE TABLE `applicationsettings` (
  `pName` varchar(50) NOT NULL,
  `pValue` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`pName`),
  UNIQUE KEY `PK_ApplicationSettings` (`pName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `applicationsettings` */

/*Table structure for table `blocklist` */

DROP TABLE IF EXISTS `blocklist`;

CREATE TABLE `blocklist` (
  `blocked_msisdn` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `blocklist` */

/*Table structure for table `blocktime` */

DROP TABLE IF EXISTS `blocktime`;

CREATE TABLE `blocktime` (
  `id` varchar(50) NOT NULL,
  `startday` int(11) DEFAULT NULL,
  `endday` int(11) DEFAULT NULL,
  `starttime` int(11) DEFAULT NULL,
  `endtime` int(11) DEFAULT NULL,
  `activestart` datetime DEFAULT NULL,
  `activeend` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `blocktime` */

/*Table structure for table `cdr` */

DROP TABLE IF EXISTS `cdr`;

CREATE TABLE `cdr` (
  `slno` int(11) NOT NULL AUTO_INCREMENT,
  `callid` varchar(100) DEFAULT NULL,
  `ANo` varchar(20) NOT NULL,
  `BNo` varchar(20) NOT NULL,
  `startTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `endTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Channel` int(10) DEFAULT NULL,
  `MachineID` bigint(19) NOT NULL,
  `direction` int(10) DEFAULT NULL,
  `isConnected` int(10) NOT NULL,
  `CauseVal` int(10) NOT NULL,
  PRIMARY KEY (`ANo`,`BNo`,`startTime`,`MachineID`),
  UNIQUE KEY `slno` (`slno`),
  UNIQUE KEY `PK_cdr` (`ANo`,`BNo`,`startTime`,`MachineID`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

/*Data for the table `cdr` */

insert  into `cdr`(`slno`,`callid`,`ANo`,`BNo`,`startTime`,`endTime`,`Channel`,`MachineID`,`direction`,`isConnected`,`CauseVal`) values (2,'16300725022016120910','01197454390','09612332211','2016-02-25 12:09:10','2016-02-25 12:09:36',7,163,0,1,7049);
insert  into `cdr`(`slno`,`callid`,`ANo`,`BNo`,`startTime`,`endTime`,`Channel`,`MachineID`,`direction`,`isConnected`,`CauseVal`) values (3,'16300925022016135908','01521498113','09612332211','2016-02-25 13:59:08','2016-02-25 13:59:34',9,163,0,1,7049);
insert  into `cdr`(`slno`,`callid`,`ANo`,`BNo`,`startTime`,`endTime`,`Channel`,`MachineID`,`direction`,`isConnected`,`CauseVal`) values (4,'16300925022016135942','01521498113','09612332211','2016-02-25 13:59:42','2016-02-25 14:00:08',9,163,0,1,7049);
insert  into `cdr`(`slno`,`callid`,`ANo`,`BNo`,`startTime`,`endTime`,`Channel`,`MachineID`,`direction`,`isConnected`,`CauseVal`) values (5,'16301125022016140126','01521498113','09612332211','2016-02-25 14:01:26','2016-02-25 14:01:26',11,163,0,1,7049);
insert  into `cdr`(`slno`,`callid`,`ANo`,`BNo`,`startTime`,`endTime`,`Channel`,`MachineID`,`direction`,`isConnected`,`CauseVal`) values (7,'16301125022016140206','01521498113','09612332211','2016-02-25 14:02:06','2016-02-25 14:02:06',11,163,0,1,7049);
insert  into `cdr`(`slno`,`callid`,`ANo`,`BNo`,`startTime`,`endTime`,`Channel`,`MachineID`,`direction`,`isConnected`,`CauseVal`) values (13,'16301125022016140435','01521498113','09612332211','2016-02-25 14:04:35','2016-02-25 14:04:35',11,163,0,1,7049);
insert  into `cdr`(`slno`,`callid`,`ANo`,`BNo`,`startTime`,`endTime`,`Channel`,`MachineID`,`direction`,`isConnected`,`CauseVal`) values (18,'16301125022016140700','01521498113','09612332211','2016-02-25 14:07:00','2016-02-25 14:07:00',11,163,0,1,7049);
insert  into `cdr`(`slno`,`callid`,`ANo`,`BNo`,`startTime`,`endTime`,`Channel`,`MachineID`,`direction`,`isConnected`,`CauseVal`) values (20,'16301125022016140734','01521498113','09612332211','2016-02-25 14:07:34','2016-02-25 14:07:34',11,163,0,1,7049);
insert  into `cdr`(`slno`,`callid`,`ANo`,`BNo`,`startTime`,`endTime`,`Channel`,`MachineID`,`direction`,`isConnected`,`CauseVal`) values (6,'16301125022016140151','01755693496','09612332211','2016-02-25 14:01:51','2016-02-25 14:01:51',11,163,0,1,7049);
insert  into `cdr`(`slno`,`callid`,`ANo`,`BNo`,`startTime`,`endTime`,`Channel`,`MachineID`,`direction`,`isConnected`,`CauseVal`) values (9,'16301125022016140214','01755693496','09612332211','2016-02-25 14:02:14','2016-02-25 14:02:14',11,163,0,1,7049);
insert  into `cdr`(`slno`,`callid`,`ANo`,`BNo`,`startTime`,`endTime`,`Channel`,`MachineID`,`direction`,`isConnected`,`CauseVal`) values (10,'16301125022016140240','01755693496','09612332211','2016-02-25 14:02:40','2016-02-25 14:02:40',11,163,0,1,7049);
insert  into `cdr`(`slno`,`callid`,`ANo`,`BNo`,`startTime`,`endTime`,`Channel`,`MachineID`,`direction`,`isConnected`,`CauseVal`) values (8,'16301125022016140208','01911200762','09612332211','2016-02-25 14:02:08','2016-02-25 14:02:08',11,163,0,1,7049);
insert  into `cdr`(`slno`,`callid`,`ANo`,`BNo`,`startTime`,`endTime`,`Channel`,`MachineID`,`direction`,`isConnected`,`CauseVal`) values (11,'16301125022016140348','01911200762','09612332211','2016-02-25 14:03:48','2016-02-25 14:03:48',11,163,0,1,7049);
insert  into `cdr`(`slno`,`callid`,`ANo`,`BNo`,`startTime`,`endTime`,`Channel`,`MachineID`,`direction`,`isConnected`,`CauseVal`) values (12,'16301125022016140433','01911200762','09612332211','2016-02-25 14:04:33','2016-02-25 14:04:33',11,163,0,1,7049);
insert  into `cdr`(`slno`,`callid`,`ANo`,`BNo`,`startTime`,`endTime`,`Channel`,`MachineID`,`direction`,`isConnected`,`CauseVal`) values (14,'16301125022016140450','01911200762','09612332211','2016-02-25 14:04:50','2016-02-25 14:04:50',11,163,0,1,7049);
insert  into `cdr`(`slno`,`callid`,`ANo`,`BNo`,`startTime`,`endTime`,`Channel`,`MachineID`,`direction`,`isConnected`,`CauseVal`) values (19,'16301125022016140720','01911200762','09612332211','2016-02-25 14:07:20','2016-02-25 14:07:20',11,163,0,1,7049);
insert  into `cdr`(`slno`,`callid`,`ANo`,`BNo`,`startTime`,`endTime`,`Channel`,`MachineID`,`direction`,`isConnected`,`CauseVal`) values (21,'16301125022016140801','01911200762','09612332211','2016-02-25 14:08:01','2016-02-25 14:08:01',11,163,0,1,7049);
insert  into `cdr`(`slno`,`callid`,`ANo`,`BNo`,`startTime`,`endTime`,`Channel`,`MachineID`,`direction`,`isConnected`,`CauseVal`) values (1,'16300625022016120239','01922113354','09612332211','2016-02-25 12:02:39','2016-02-25 12:03:05',6,163,0,1,7049);

/*Table structure for table `conference` */

DROP TABLE IF EXISTS `conference`;

CREATE TABLE `conference` (
  `msisdn` varchar(20) NOT NULL,
  `called` varchar(20) NOT NULL,
  `ano` varchar(20) NOT NULL,
  `bno` varchar(20) NOT NULL,
  `admin_status` varchar(10) NOT NULL DEFAULT 'false',
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `conference` */

/*Table structure for table `conference_obd` */

DROP TABLE IF EXISTS `conference_obd`;

CREATE TABLE `conference_obd` (
  `msisdn` varchar(20) NOT NULL,
  `called` varchar(20) NOT NULL,
  `ano` varchar(20) NOT NULL,
  `bno` varchar(20) NOT NULL,
  `admin_status` varchar(10) NOT NULL DEFAULT 'false',
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `conference_obd` */

/*Table structure for table `conference_room` */

DROP TABLE IF EXISTS `conference_room`;

CREATE TABLE `conference_room` (
  `room_name` varchar(20) NOT NULL,
  `room_status` varchar(20) NOT NULL,
  `room_admin` varchar(20) NOT NULL,
  `room_id` varchar(20) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `room_caller` varchar(20) NOT NULL,
  PRIMARY KEY (`room_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `conference_room` */

insert  into `conference_room`(`room_name`,`room_status`,`room_admin`,`room_id`,`last_update`,`room_caller`) values ('room1','FREE','3002','3001','2015-12-27 19:38:32','3101');
insert  into `conference_room`(`room_name`,`room_status`,`room_admin`,`room_id`,`last_update`,`room_caller`) values ('room11','FREE','3012','3011','2015-11-09 16:35:36','3111');
insert  into `conference_room`(`room_name`,`room_status`,`room_admin`,`room_id`,`last_update`,`room_caller`) values ('room13','FREE','3014','3013','2015-10-11 16:53:24','3113');
insert  into `conference_room`(`room_name`,`room_status`,`room_admin`,`room_id`,`last_update`,`room_caller`) values ('room15','FREE','3016','3015','2015-10-11 17:00:06','3115');
insert  into `conference_room`(`room_name`,`room_status`,`room_admin`,`room_id`,`last_update`,`room_caller`) values ('room17','FREE','3018','3017','2015-10-11 15:45:09','3117');
insert  into `conference_room`(`room_name`,`room_status`,`room_admin`,`room_id`,`last_update`,`room_caller`) values ('room19','FREE','3020','3019','2015-10-11 15:45:09','3119');
insert  into `conference_room`(`room_name`,`room_status`,`room_admin`,`room_id`,`last_update`,`room_caller`) values ('room3','FREE','3004','3003','2015-10-11 15:45:09','3103');
insert  into `conference_room`(`room_name`,`room_status`,`room_admin`,`room_id`,`last_update`,`room_caller`) values ('room5','FREE','3006','3005','2015-10-11 15:45:09','3105');
insert  into `conference_room`(`room_name`,`room_status`,`room_admin`,`room_id`,`last_update`,`room_caller`) values ('room7','FREE','3008','3007','2015-10-11 15:45:09','3107');
insert  into `conference_room`(`room_name`,`room_status`,`room_admin`,`room_id`,`last_update`,`room_caller`) values ('room9','FREE','3010','3009','2015-10-11 15:45:09','3109');

/*Table structure for table `geturl` */

DROP TABLE IF EXISTS `geturl`;

CREATE TABLE `geturl` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ano` varchar(50) NOT NULL,
  `bno` varchar(50) NOT NULL,
  `url` varchar(500) NOT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `ProvisionEndDate` timestamp NULL DEFAULT NULL,
  `callingType` varchar(20) NOT NULL DEFAULT 'audio',
  PRIMARY KEY (`id`),
  UNIQUE KEY `PK_GetUrl` (`ano`,`bno`,`callingType`),
  KEY `Combined` (`ano`,`bno`,`Status`,`ProvisionEndDate`),
  KEY `PK` (`ano`,`bno`),
  KEY `ProvDate` (`ProvisionEndDate`),
  KEY `Status_Index` (`Status`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;

/*Data for the table `geturl` */

insert  into `geturl`(`id`,`ano`,`bno`,`url`,`Status`,`ProvisionEndDate`,`callingType`) values (2,'%','20085678%','/vsdp_test/vsdpservices/flowmanager.php?service=callconnect&','Active','2020-12-31 00:00:00','audio');
insert  into `geturl`(`id`,`ano`,`bno`,`url`,`Status`,`ProvisionEndDate`,`callingType`) values (3,'%','707%','/vsdp_test/vsdpservices/flowmanager.php?service=test_pause&','Active ','2020-06-29 09:00:00','audio');
insert  into `geturl`(`id`,`ano`,`bno`,`url`,`Status`,`ProvisionEndDate`,`callingType`) values (5,'%','%','/vsdp_test/vsdpservices/flowmanager.php?service=callconnectpatch&','Active','2020-06-30 06:00:00','audio');
insert  into `geturl`(`id`,`ano`,`bno`,`url`,`Status`,`ProvisionEndDate`,`callingType`) values (6,'%','2584560%','/vsdp_test/vsdpservices/flowmanager.php?service=full_test_2&','Active ','2020-07-02 07:00:00','audio');
insert  into `geturl`(`id`,`ano`,`bno`,`url`,`Status`,`ProvisionEndDate`,`callingType`) values (7,'%','258045345%','/vsdp_test/vsdpservices/flowmanager.php?service=DhakaGate&','Provision','2020-07-02 07:00:00','audio');
insert  into `geturl`(`id`,`ano`,`bno`,`url`,`Status`,`ProvisionEndDate`,`callingType`) values (8,'%','443434','/vsdp_test/vsdpservices/flowmanager.php?service=callconnectpatch_test&','Active ','2020-07-02 07:00:00','audio');
insert  into `geturl`(`id`,`ano`,`bno`,`url`,`Status`,`ProvisionEndDate`,`callingType`) values (24,'%','34567','/vsdp_test/vsdpservices/flowmanager.php?service=test&','Active ','2015-07-31 09:00:00','audio');
insert  into `geturl`(`id`,`ano`,`bno`,`url`,`Status`,`ProvisionEndDate`,`callingType`) values (25,'%','4101676%','/vsdp_test/vsdpservices/flowmanager.php?service=test_play_file&','Active ','2015-08-09 23:53:00','audio');
insert  into `geturl`(`id`,`ano`,`bno`,`url`,`Status`,`ProvisionEndDate`,`callingType`) values (28,'%','25804455%','/vsdp_test/vsdpservices/flowmanager.php?service=test_input&','Active ','2015-08-10 00:14:00','audio');
insert  into `geturl`(`id`,`ano`,`bno`,`url`,`Status`,`ProvisionEndDate`,`callingType`) values (31,'%','882008%','/vsdp_test/vsdpservices/flowmanager.php?service=test_browselist&&','Active ','2015-08-10 01:03:00','audio');
insert  into `geturl`(`id`,`ano`,`bno`,`url`,`Status`,`ProvisionEndDate`,`callingType`) values (32,'%','200888%','/vsdp_test/vsdpservices/flowmanager.php?service=test_record_file&&','Active ','2015-08-10 01:20:00','audio');
insert  into `geturl`(`id`,`ano`,`bno`,`url`,`Status`,`ProvisionEndDate`,`callingType`) values (33,'%','25804543','/vsdp_test/vsdpservices/flowmanager.php?service=test_resume&','Active ','2015-08-10 01:46:00','audio');
insert  into `geturl`(`id`,`ano`,`bno`,`url`,`Status`,`ProvisionEndDate`,`callingType`) values (34,'%','25803453425%','/vsdp_test/vsdpservices/flowmanager.php?service=test_place_call&','Active ','2015-08-10 02:48:00','audio');
insert  into `geturl`(`id`,`ano`,`bno`,`url`,`Status`,`ProvisionEndDate`,`callingType`) values (35,'%','25803','/vsdp_test/vsdpservices/flowmanager.php?service=test_pause&','Active ','2015-08-10 02:59:00','audio');
insert  into `geturl`(`id`,`ano`,`bno`,`url`,`Status`,`ProvisionEndDate`,`callingType`) values (37,'%','11111%','/vsdp_test/vsdpservices/flowmanager.php?service=test_patch_call&','Active ','2015-07-31 04:27:00','audio');
insert  into `geturl`(`id`,`ano`,`bno`,`url`,`Status`,`ProvisionEndDate`,`callingType`) values (38,'%','2580452345','/vsdp_test/vsdpservices/flowmanager.php?service=record_2&','Active ','2015-08-17 07:00:00','audio');
insert  into `geturl`(`id`,`ano`,`bno`,`url`,`Status`,`ProvisionEndDate`,`callingType`) values (39,'220022%','3009%','/vsdp_test/vsdpservices/flowmanager.php?service=test_play_file&','Active ','2015-08-17 07:00:00','audio');
insert  into `geturl`(`id`,`ano`,`bno`,`url`,`Status`,`ProvisionEndDate`,`callingType`) values (40,'%','258045645','/vsdp_test/vsdpservices/flowmanager.php?service=record_listen&','Active','2015-08-17 07:00:00','audio');
insert  into `geturl`(`id`,`ano`,`bno`,`url`,`Status`,`ProvisionEndDate`,`callingType`) values (41,'%','096123322%','/vsdp_test/vsdpservices/flowmanager.php?service=callconnect3001&','Active','2015-08-17 07:00:00','audio');
insert  into `geturl`(`id`,`ano`,`bno`,`url`,`Status`,`ProvisionEndDate`,`callingType`) values (42,'%','3103%','/vsdp_test/vsdpservices/flowmanager.php?service=callconnect3003&','Active','2015-08-17 07:00:00','audio');
insert  into `geturl`(`id`,`ano`,`bno`,`url`,`Status`,`ProvisionEndDate`,`callingType`) values (43,'%','3105%','/vsdp_test/vsdpservices/flowmanager.php?service=callconnect3005&','Active','2015-08-17 07:00:00','audio');
insert  into `geturl`(`id`,`ano`,`bno`,`url`,`Status`,`ProvisionEndDate`,`callingType`) values (44,'%','3107%','/vsdp_test/vsdpservices/flowmanager.php?service=callconnect3007&','Active','2015-08-17 07:00:00','audio');
insert  into `geturl`(`id`,`ano`,`bno`,`url`,`Status`,`ProvisionEndDate`,`callingType`) values (45,'%','3109%','/vsdp_test/vsdpservices/flowmanager.php?service=callconnect3009&','Active','2015-08-17 07:00:00','audio');
insert  into `geturl`(`id`,`ano`,`bno`,`url`,`Status`,`ProvisionEndDate`,`callingType`) values (46,'%','3111%','/vsdp_test/vsdpservices/flowmanager.php?service=callconnect3011&','Active','2015-08-17 07:00:00','audio');
insert  into `geturl`(`id`,`ano`,`bno`,`url`,`Status`,`ProvisionEndDate`,`callingType`) values (47,'%','3113%','/vsdp_test/vsdpservices/flowmanager.php?service=callconnect3013&','Active','2015-08-17 07:00:00','audio');
insert  into `geturl`(`id`,`ano`,`bno`,`url`,`Status`,`ProvisionEndDate`,`callingType`) values (48,'%','3115%','/vsdp_test/vsdpservices/flowmanager.php?service=callconnect3015&','Active','2015-08-17 07:00:00','audio');
insert  into `geturl`(`id`,`ano`,`bno`,`url`,`Status`,`ProvisionEndDate`,`callingType`) values (49,'%','3117%','/vsdp_test/vsdpservices/flowmanager.php?service=callconnect3017&','Active','2015-08-17 07:00:00','audio');
insert  into `geturl`(`id`,`ano`,`bno`,`url`,`Status`,`ProvisionEndDate`,`callingType`) values (50,'%','3119%','/vsdp_test/vsdpservices/flowmanager.php?service=callconnect3019&','Active','2015-08-17 07:00:00','audio');
insert  into `geturl`(`id`,`ano`,`bno`,`url`,`Status`,`ProvisionEndDate`,`callingType`) values (59,'%','4101%','/vsdp_test/vsdpservices/flowmanager.php?service=callconnect4001&','Active','2015-08-17 07:00:00','audio');
insert  into `geturl`(`id`,`ano`,`bno`,`url`,`Status`,`ProvisionEndDate`,`callingType`) values (60,'%','2008%','/vsdp_test/vsdpservices/flowmanager.php?service=bmp&','Active ','2015-11-09 14:13:00','audio');
insert  into `geturl`(`id`,`ano`,`bno`,`url`,`Status`,`ProvisionEndDate`,`callingType`) values (64,'%','987655432','/vsdp_test/vsdpservices/flowmanager.php?service=new_Edit2;','Active ','2015-12-13 19:20:00','audio');
insert  into `geturl`(`id`,`ano`,`bno`,`url`,`Status`,`ProvisionEndDate`,`callingType`) values (65,'%','2580%','/vsdp_test/vsdpservices/flowmanager.php?service=test_sdk_flow1&','Active','2015-12-13 19:20:00','audio');
insert  into `geturl`(`id`,`ano`,`bno`,`url`,`Status`,`ProvisionEndDate`,`callingType`) values (66,'%','09876096123322%','/vsdp_test/vsdpservices/flowmanager.php?service=customer_call_service_1&','Active','2015-08-17 07:00:00','audio');

/*Table structure for table `ivr_services` */

DROP TABLE IF EXISTS `ivr_services`;

CREATE TABLE `ivr_services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `service` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `page` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `type` enum('IVR','USSD','SMS') DEFAULT 'IVR',
  `user_id` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `last_updated_by` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `NewIndex1` (`service`,`page`,`type`)
) ENGINE=InnoDB AUTO_INCREMENT=346 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `ivr_services` */

insert  into `ivr_services`(`id`,`service`,`page`,`type`,`user_id`,`last_updated_by`) values (343,'customer_call_service_1','page one','IVR','1',NULL);
insert  into `ivr_services`(`id`,`service`,`page`,`type`,`user_id`,`last_updated_by`) values (344,'customer_call_service_2','page one','IVR','1',NULL);
insert  into `ivr_services`(`id`,`service`,`page`,`type`,`user_id`,`last_updated_by`) values (345,'customer_call_service_3','page one','IVR','1',NULL);

/*Table structure for table `ivrmenu` */

DROP TABLE IF EXISTS `ivrmenu`;

CREATE TABLE `ivrmenu` (
  `Service` varchar(50) NOT NULL DEFAULT '300',
  `current_state` varchar(50) NOT NULL,
  `key_press` varchar(50) NOT NULL,
  `short_code` varchar(50) DEFAULT NULL,
  `next_state` varchar(50) DEFAULT NULL,
  `NextKey` varchar(50) DEFAULT NULL,
  `Action_command` varchar(100) DEFAULT NULL,
  `URL` varchar(4000) DEFAULT NULL,
  `play_file` varchar(200) DEFAULT NULL,
  `record_file` varchar(200) DEFAULT NULL,
  `input_length` int(10) DEFAULT NULL,
  `Recordingtime` int(10) DEFAULT '300',
  `MenuStatus` int(10) DEFAULT '1',
  `NextFile` varchar(200) DEFAULT 'NA',
  `PrevFile` varchar(200) DEFAULT 'NA',
  `RepeatKey` varchar(200) DEFAULT NULL,
  `BackKey` varchar(50) DEFAULT NULL,
  `ForwardKey` varchar(50) DEFAULT NULL,
  `selectkey` varchar(50) DEFAULT NULL,
  `InstructionFile` varchar(500) DEFAULT NULL,
  `MaxRetryCount` bigint(19) DEFAULT '0',
  `ErrorName` varchar(50) DEFAULT NULL,
  `NodeName` varchar(50) DEFAULT NULL,
  `PageName` varchar(500) DEFAULT NULL,
  `ICF` int(10) DEFAULT '0',
  `IVF` int(10) DEFAULT '0',
  `SP` int(10) DEFAULT NULL,
  `ratecode` varchar(50) DEFAULT NULL,
  `FilePauseTime` int(11) DEFAULT '0',
  PRIMARY KEY (`Service`,`current_state`,`key_press`),
  UNIQUE KEY `PK_IVRMenu` (`Service`,`current_state`,`key_press`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ivrmenu` */

insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('bmp','0','0','NA','1','NA','Inputs','NA','/ismp/shared/test/Prompts/bmp/main_prompt.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','bmp',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('bmp','1','1','NA','11','NA','BrowseList','http://192.168.245.46/vsdp_test/bmp/browselist_listen.php','NA','NA',0,0,1,'NA','NA','3','2','1','4','NA',0,'0','NA','bmp',0,1,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('bmp','1','2','NA','12','NA','BrowseList','http://192.168.245.46/vsdp_test/bmp/browselist_select.php','NA','NA',0,0,1,'NA','NA','3','2','1','4','NA',0,'0','bmp','bmp',0,1,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('bmp','11','0','NA','110','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','bmp',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('bmp','12','4','NA','124','NA','Stored_Data','songid=%fileid','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','bmp',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('bmp','124','1','NA','1241','NA','External_Input','http://192.168.245.46/vsdp_test/bmp/savesong.php?songid=%songid','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','bmp',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('bmp','1241','0','NA','12410','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','bmp',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('callconnect','0','0','NA','10','NA','placecall','http://192.168.245.46/vsdp_test/conference/Call_Conference_room_obd.php','/ismp/shared/test/Prompts/News_Portal/main_prompt.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','Silent','Start',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('callconnect','10','other','NA','10','NA','Disconnectcall','NA','/ismp/shared/production/recordings/TestLink/Test6.amr','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','Start',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('callconnect','10','zz','NA','10','NA','Disconnectcall','NA','http://10.183.188.112/vsdp_test/News_BVision/Wrapper.php?cat=BVision','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','BVision','Start',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('callconnect3001','0','0','NA','10','NA','Conference','http://45.125.222.163//vsdp_test/conference/Call_Conference_room.php','/ismp/shared/test/Prompts/News_Portal/main_prompt.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','Silent','Start',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('callconnect3001','10','2','NA','10','NA','Disconnectcall','NA','http://10.183.188.112/vsdp_test/News_BVision/Wrapper.php?cat=BVision','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','BVision','Start',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('callconnect3001','10','other','NA','10','NA','Disconnectcall','NA','/ismp/shared/production/recordings/TestLink/Test6.amr','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','Start',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('callconnect3003','0','0','NA','10','NA','Conference','http://192.168.245.46/vsdp_test/conference/Call_Conference_room.php','/ismp/shared/test/Prompts/News_Portal/hindi10.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','Silent','Start',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('callconnect3003','10','2','NA','10','NA','Disconnectcall','NA','http://10.183.188.112/vsdp_test/News_BVision/Wrapper.php?cat=BVision','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','BVision','Start',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('callconnect3003','10','other','NA','10','NA','Disconnectcall','NA','/ismp/shared/production/recordings/TestLink/Test6.amr','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','Start',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('callconnect3005','0','0','NA','10','NA','Conference','http://192.168.245.46/vsdp_test/conference/Call_Conference_room.php','/ismp/shared/test/Prompts/News_Portal/hindi10.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','Silent','Start',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('callconnect3005','10','2','NA','10','NA','Disconnectcall','NA','http://10.183.188.112/vsdp_test/News_BVision/Wrapper.php?cat=BVision','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','BVision','Start',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('callconnect3005','10','other','NA','10','NA','Disconnectcall','NA','/ismp/shared/production/recordings/TestLink/Test6.amr','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','Start',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('callconnect3007','0','0','NA','10','NA','Conference','http://192.168.245.46/vsdp_test/conference/Call_Conference_room.php','/ismp/shared/test/Prompts/News_Portal/hindi10.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','Silent','Start',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('callconnect3007','10','2','NA','10','NA','Disconnectcall','NA','http://10.183.188.112/vsdp_test/News_BVision/Wrapper.php?cat=BVision','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','BVision','Start',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('callconnect3007','10','other','NA','10','NA','Disconnectcall','NA','/ismp/shared/production/recordings/TestLink/Test6.amr','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','Start',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('callconnect3009','0','0','NA','10','NA','Conference','http://192.168.245.46/vsdp_test/conference/test.php','/ismp/shared/test/Prompts/News_Portal/hindi10.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','Silent','Start',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('callconnect3009','10','2','NA','10','NA','Disconnectcall','NA','http://10.183.188.112/vsdp_test/News_BVision/Wrapper.php?cat=BVision','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','BVision','Start',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('callconnect3009','10','other','NA','10','NA','Disconnectcall','NA','/ismp/shared/production/recordings/TestLink/Test6.amr','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','Start',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('callconnect3011','0','0','NA','10','NA','Conference','http://192.168.245.46/vsdp_test/conference/Call_Conference_room.php','/ismp/shared/test/Prompts/News_Portal/hindi10.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','Silent','Start',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('callconnect3011','10','2','NA','10','NA','Disconnectcall','NA','http://10.183.188.112/vsdp_test/News_BVision/Wrapper.php?cat=BVision','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','BVision','Start',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('callconnect3011','10','other','NA','10','NA','Disconnectcall','NA','/ismp/shared/production/recordings/TestLink/Test6.amr','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','Start',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('callconnect3013','0','0','NA','10','NA','Conference','http://192.168.245.46/vsdp_test/conference/Call_Conference_room.php','/ismp/shared/test/Prompts/News_Portal/hindi10.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','Silent','Start',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('callconnect3013','10','2','NA','10','NA','Disconnectcall','NA','http://10.183.188.112/vsdp_test/News_BVision/Wrapper.php?cat=BVision','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','BVision','Start',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('callconnect3013','10','other','NA','10','NA','Disconnectcall','NA','/ismp/shared/production/recordings/TestLink/Test6.amr','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','Start',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('callconnect3015','0','0','NA','10','NA','Conference','http://192.168.245.46/vsdp_test/conference/Call_Conference_room.php','/ismp/shared/test/Prompts/News_Portal/hindi10.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','Silent','Start',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('callconnect3015','10','2','NA','10','NA','Disconnectcall','NA','http://10.183.188.112/vsdp_test/News_BVision/Wrapper.php?cat=BVision','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','BVision','Start',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('callconnect3015','10','other','NA','10','NA','Disconnectcall','NA','/ismp/shared/production/recordings/TestLink/Test6.amr','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','Start',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('callconnect3017','0','0','NA','10','NA','Conference','http://192.168.245.46/vsdp_test/conference/Call_Conference_room.php','/ismp/shared/test/Prompts/News_Portal/hindi10.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','Silent','Start',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('callconnect3017','10','2','NA','10','NA','Disconnectcall','NA','http://10.183.188.112/vsdp_test/News_BVision/Wrapper.php?cat=BVision','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','BVision','Start',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('callconnect3017','10','other','NA','10','NA','Disconnectcall','NA','/ismp/shared/production/recordings/TestLink/Test6.amr','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','Start',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('callconnect3019','0','0','NA','10','NA','Conference','http://192.168.245.46/vsdp_test/conference/Call_Conference_room.php','/ismp/shared/test/Prompts/News_Portal/hindi10.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','Silent','Start',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('callconnect3019','10','2','NA','10','NA','Disconnectcall','NA','http://10.183.188.112/vsdp_test/News_BVision/Wrapper.php?cat=BVision','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','BVision','Start',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('callconnect3019','10','other','NA','10','NA','Disconnectcall','NA','/ismp/shared/production/recordings/TestLink/Test6.amr','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','Start',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('callconnect4001','0','0','NA','10','NA','Conference_with_music','http://192.168.245.198/vsdp_test/conference/test.php','/ismp/shared/test/Prompts/News_Portal/hindi10.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','Silent','Start',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('callconnect4001','10','2','NA','10','NA','Disconnectcall','NA','http://10.183.188.112/vsdp_test/News_BVision/Wrapper.php?cat=BVision','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','BVision','Start',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('callconnect4001','10','other','NA','10','NA','Disconnectcall','NA','/ismp/shared/production/recordings/TestLink/Test6.amr','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','Start',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('callconnectpatch','0','0','NA','1','NA','PATCHCALL','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','Main',0,0,NULL,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('callconnectpatch_2','0','0','NA','1','NA','PATCHCALL','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','Main',0,0,NULL,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('customer_call_service_1','0','0','NA','1','NA','External_Input','http://127.0.0.1/vsdp_test/customer_call_service_1/calltoagent.php','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','page one',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('customer_call_service_1','1','0','NA','10','NA','Placecall','http://127.0.0.1/vsdp_test/customer_call_service_1/agent.php','/ismp/shared/test/Prompts/customer_call_service_1/main_prompt.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','page one',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('customer_call_service_1','10','0','NA','100','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','page one',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('customer_call_service_2','0','0','NA','1','NA','External_Input','http://127.0.0.1/vsdp_test/customer_call_service_2/calltoagent.php','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','page one',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('customer_call_service_2','1','0','NA','10','NA','Placecall','http://127.0.0.1/vsdp_test/customer_call_service_2/agent.php','/ismp/shared/test/Prompts/customer_call_service_2/main_prompt.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','page one',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('customer_call_service_2','10','0','NA','100','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','page one',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('customer_call_service_3','0','0','NA','1','NA','External_Input','http://127.0.0.1/vsdp_test/customer_call_service_3/calltoagent.php','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','page one',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('customer_call_service_3','1','0','NA','10','NA','Placecall','http://127.0.0.1/vsdp_test/customer_call_service_3/agent.php','/ismp/shared/test/Prompts/customer_call_service_3/main_prompt.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','page one',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('customer_call_service_3','10','0','NA','100','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','page one',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('DhakaGate','0','0','NA','1','NA','playfile','NA','/ismp/shared/test/prompts/News_Portal/hindi10.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','Page 1',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('DhakaGate','1','other','NA','2','NA','External_Input','http://localhost/vsdp_test/DhakaGateway/hiturl.php','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','Page 1',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('DhakaGate','2','other','NA','3','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','Page 1',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('Dorcor_tips','0','0','NA','1','NA','Playfile','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','Dorcor_tips',0,0,0,'0',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('Dorcor_tips','1','0','NA','10','NA','External_Input','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','Dorcor_tips',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('Dorcor_tips','1','1','NA','11','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','Dorcor_tips',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('Dorcor_tips','1','2','NA','12','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','Dorcor_tips',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('Dorcor_tips','1','other','NA','91','NA','Stored_Data','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','Dorcor_tips',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('Dorcor_tips','10','1','NA','101','NA','Playfile','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','Dorcor_tips',0,0,0,'0',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('Dorcor_tips','10','2','NA','102','NA','Playfile','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','Dorcor_tips',0,0,0,'0',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('Dorcor_tips','10','other','NA','910','NA','Stored_Data','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','Dorcor_tips',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('Dorcor_tips','101','0','NA','1010','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','Dorcor_tips',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('Dorcor_tips','102','1','NA','1021','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','Dorcor_tips',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('Dorcor_tips','91','1','NA','911','NA','Placecall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','Dorcor_tips',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('Dorcor_tips','910','1','NA','9101','NA','Playfile','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','Dorcor_tips',0,0,0,'0',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('Dorcor_tips','9101','1','NA','91011','NA','Placecall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','Dorcor_tips',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('full_test','0','0','NA','1','NA','Inputs','NA','/ismp/shared/test/prompts/News_Portal/full_test/arc.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','full_test',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('full_test','1','1','NA','11','NA','Resume_Node','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','full_test',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('full_test','1','2','NA','12','NA','Pause_File','NA','/ismp/shared/test/prompts/News_Portal/full_test/welcome.wav','NA',0,0,1,'/ismp/shared/test/prompts/News_Portal/full_test/welcomePrompt.wav','NA','NA','NA','NA','NA','NA',0,'0','NA','full_test',0,0,0,'30',5);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('full_test','1','3','NA','13','NA','Inputs','NA','/ismp/shared/test/prompts/News_Portal/full_test/interview_direction.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','full_test',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('full_test','12','0','NA','120','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','full_test',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('full_test','13','1','NA','131','NA','Placecall','http://192.168.245.198/vsdp_test/full_test/testCall.php','/ismp/shared/test/prompts/News_Portal/full_test/main_prompt.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','full_test',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('full_test','13','2','NA','132','NA','BrowseList','http://192.168.245.198/vsdp_test/full_test/browselist.php?cat=%cat','NA','NA',0,0,1,'NA','NA','3','2','1','NA','NA',0,'0','','full_test',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('full_test','13','3','NA','133','NA','Playfile','NA','/ismp/shared/test/prompts/News_Portal/full_test/hindi10.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','full_test',0,0,0,'0',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('full_test','13','4','NA','134','NA','Recordfile','NA','/ismp/shared/test/prompts/News_Portal/full_test/record_voice.wav','/ismp/shared/test/recordings/full_test/record_full_test',0,10,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','full_test',0,0,0,'0',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('full_test','13','5','NA','135','NA','External_Input','http://192.168.245.198/vsdp_test/full_test/externalhit.php','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','full_test',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('full_test','131','0','NA','1310','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','full_test',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('full_test','132','0','NA','1320','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','full_test',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('full_test','133','0','NA','1330','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','full_test',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('full_test','134','0','NA','1340','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','full_test',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('full_test','135','0','NA','1350','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','full_test',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('full_test_2','0','0','NA','1','NA','Inputs','NA','/ismp/shared/test/prompts/full_test_2/welcome.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','full_test_2',0,0,0,'ISP',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('full_test_2','1','1','NA','11','NA','Resume_Node','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','full_test_2',0,0,0,'ISP',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('full_test_2','1','2','NA','12','NA','Pause_File','NA','/ismp/shared/test/prompts/full_test_2/welcome.wav','NA',0,0,1,'/ismp/shared/test/prompts/full_test_2/welcomePrompt.wav','NA','NA','NA','NA','NA','NA',0,'0','NA','full_test_2',0,0,0,'ISP',5);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('full_test_2','1','3','NA','13','NA','Inputs','NA','/ismp/shared/test/prompts/full_test_2/interview_direction.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','full_test_2',0,0,0,'ISP',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('full_test_2','12','0','NA','120','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','full_test_2',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('full_test_2','13','1','NA','131','NA','Placecall','http://192.168.244.207/vsdp_test/full_test_2/testCall.php','/ismp/shared/test/prompts/full_test_2/main_prompt.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','full_test_2',0,0,0,'ISP',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('full_test_2','13','2','NA','132','NA','BrowseList','http://192.168.244.207/vsdp_test/full_test_2/browselist.php?cat=%cat','NA','NA',0,0,1,'NA','NA','3','2','1','NA','NA',0,'0','NA','full_test_2',0,1,0,'ISP',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('full_test_2','13','3','NA','133','NA','Playfile','NA','/ismp/shared/test/prompts/full_test_2/hindi10.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','full_test_2',0,0,0,'ISP',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('full_test_2','13','4','NA','134','NA','Recordfile','NA','/ismp/shared/test/prompts/full_test_2/record_voice.wav','/ismp/shared/test/recordings/full_test_2/record_full_test',0,10,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','full_test_2',0,0,0,'ISP',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('full_test_2','13','5','NA','135','NA','External_Input','http://192.168.244.207/vsdp_test/full_test_2/externalhit.php?cat=%cat','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','full_test_2',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('full_test_2','131','0','NA','1310','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','full_test_2',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('full_test_2','132','0','NA','1320','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','full_test_2',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('full_test_2','133','0','NA','1330','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','full_test_2',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('full_test_2','134','0','NA','1340','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','full_test_2',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('full_test_2','135','0','NA','1350','NA','Playfile','NA','/ismp/shared/test/prompts/full_test_2/hindi10.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','full_test_2',0,0,0,'ISP',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('full_test_2','1350','0','NA','13500','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','full_test_2',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('map_panel','0','0','NA','1','NA','Playfile','NA','/ismp/shared/test/Prompts/map_panel/1.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',4,'0','NA','Start',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('map_panel','1','0','NA','1','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','',0,'0','NA','Start',0,0,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('OBD_Test','0','0','NA','1 ','NA','Playfile','NA','/ismp/shared/test/Prompts/News_Portal/main_prompt.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','OBD_Test',0,0,0,'0',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('OBD_Test','1','other','NA','2','other','Disconnectcall',NULL,NULL,NULL,NULL,300,1,'NA','NA',NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,0,0,NULL,NULL,0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('record_2','0','0','NA','1','NA','Recordfile','NA','/ismp/shared/test/prompts/test_record_file/record.wav','/ismp/shared/test/recordings/test_record_file/recording_test',0,5,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','record_2',0,0,0,'0',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('record_2','1','0','NA','10','NA','playfile','NA','/ismp/shared/test/prompts/test_record_file/record.wav','NA',0,0,1,'http://192.168.244.207/vsdp_test/vsdpservices/record.php?file=%RECORDFILE','NA',NULL,NULL,NULL,NULL,NULL,0,NULL,'NA','record_2',0,0,NULL,'0',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('record_conference','0','0','NA','1','NA','RECORD_CONFERENCE','NA','/ismp/shared/test/Prompts/record_conference/record_voice.wav','/ismp/shared/test/recordings/record_conference/conference_',0,30,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','record_conference',0,0,0,'0',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('record_conference','1','0','NA','10','NA','External_Input','http://192.168.245.46/vsdp_test/bmp/RecordConference.php?recordfile=%RECORD_CONFERENCE','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','record_conference',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('record_conference','10','1','NA','101','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','record_conference',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('record_listen','0','0','NA','1','NA','playfile','NA','/ismp/shared/test/recordings/test_record_file/recording_test_180815112639pm2000207001.wav','NA',0,0,1,'NA','NA','NA',NULL,NULL,NULL,NULL,0,NULL,NULL,'record_listen',0,0,NULL,'0',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('record_play_test','0','0','NA','1','NA','Inputs','NA','/ismp/shared/test/prompts/record_play_test/arc.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','record_play_test',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('record_play_test','1','1','NA','11','NA','Recordfile','NA','/ismp/shared/test/prompts/record_play_test/record_voice.wav','/ismp/shared/test/recordings/record_play_test/record_play_test',0,5,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','record_play_test',0,0,0,'0',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('record_play_test','1','2','NA','12','NA','Playfile','NA','http://192.168.245.198/vsdp_test/record_play_test/play_file.php','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','record_play_test',0,0,0,'0',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('record_play_test','11','0','NA','110','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','record_play_test',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('record_play_test','12','0','NA','120','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','record_play_test',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('store_data','0','0','NA','1','NA','Stored_Data','dsfjkljdklfj/fjkjfdgkj','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','store_data',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('store_data','1','1','NA','11','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','store_data',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test2_patch','0','0','NA','1','NA','PATCHCALL','NA','/ismp/shared/test/prompts/test2_patch/hindi.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','test2_patch',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test2_patch','1','0','NA','10','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','test2_patch',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_browselist','0','0','NA','1','NA','BrowseList','http://192.168.245.198/vsdp_test/conference_browselist/browselist.php','NA','NA',0,0,1,'NA','NA','3','2','1','NA','NA',0,'0','NA','test_browselist',0,1,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_browselist','1','0','NA','10','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','test_browselist',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_input','0','0','NA','1','NA','Inputs','NA','/ismp/shared/test/prompts/test_input/interview_direction.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','test_input',0,0,0,'0',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_input','1','1','NA','11','NA','Playfile','NA','/ismp/shared/test/prompts/test_input/welcome.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','test_input',0,0,0,'0',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_input','1','2','NA','12','NA','BrowseList','http://192.168.244.207/vsdp_test/test_input/browselist.php?cat=%cat','NA','NA',0,0,1,'NA','NA','3','2','1','NA','NA',0,'0','NA','test_input',0,1,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_input','1','3','NA','13','NA','Recordfile','NA','/ismp/shared/test/prompts/test_input/record_voice.wav','NA',0,30,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','test_input',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_input','11','0','NA','110','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','test_input',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_input','12','0','NA','120','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','test_input',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_input','13','0','NA','130','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','test_input',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_patch_call','0','0','NA','1','NA','PATCHCALL','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','test_patchcall',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_pause','0','0','NA','1','NA','Pause_File','NA','/ismp/shared/test/prompts/test_pause/welcome.wav','NA',0,0,1,'/ismp/shared/test/prompts/test_pause/hindi10.wav','NA','NA','NA','NA','NA','NA',0,'0','NA','test_pause',0,0,0,'0',5);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_pause','1','0','NA','10','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','test_pause',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_place_call','0','0','NA','1','NA','Placecall','http://192.168.245.198/vsdp_test/musiconhold/Audio_Streaming.php','/ismp/shared/test/Prompts/News_Portal/hindi10.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','test_place_call',0,0,0,'0',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_place_call','1','0','NA','10','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','test_place_call',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_play_file','0','0','NA','1','NA','Playfile','NA','/ismp/shared/test/Prompts/DiGi-BanglaNewsNew/playnews.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','test_play_file',0,0,0,'0',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_play_file','1','0','NA','10','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','test_play_file',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_record_file','0','0','NA','1','NA','Recordfile','NA','/ismp/shared/test/prompts/test_record_file/record.wav','/ismp/shared/test/recordings/test_record_file/recording_test',0,10,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','test_record_file',0,0,0,'0',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_record_file','1','0','NA','10','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','test_record_file',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_resume','0','0','NA','1','NA','Inputs','NA','/ismp/shared/test/prompts/test_resume/arc.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','test_resume',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_resume','1','1','NA','11','NA','Resume_Node','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','test_resume',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_resume','1','2','NA','12','NA','Pause_File','NA','/ismp/shared/test/prompts/test_resume/welcome.wav','NA',0,0,1,'/ismp/shared/test/prompts/test_resume/welcomePrompt.wav','NA','NA','NA','NA','NA','NA',0,'0','NA','test_resume',0,0,0,'30',5);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_resume','1','3','NA','13','NA','Inputs','NA','/ismp/shared/test/prompts/test_resume/interview_direction.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','test_resume',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_resume','12','0','NA','120','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','test_resume',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_resume','13','1','NA','131','NA','Placecall','http://192.168.244.207/vsdp_test/test_resume/testCall.php','/ismp/shared/test/prompts/test_resume/main_prompt.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','test_resume',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_resume','13','2','NA','132','NA','BrowseList','http://192.168.244.207/vsdp_test/test_resume/browselist.php?cat=%cat','NA','NA',0,0,1,'NA','NA','3','2','1','NA','NA',0,'0','NA','test_resume',0,1,0,'ZERO',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_resume','13','3','NA','133','NA','Playfile','NA','/ismp/shared/test/prompts/test_resume/hindi10.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','test_resume',0,0,0,'0',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_resume','13','4','NA','134','NA','Recordfile','NA','/ismp/shared/test/prompts/test_resume/record_voice.wav','/ismp/shared/test/recordings/test_resume/record_full_test',0,10,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','test_resume',0,0,0,'0',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_resume','13','5','NA','135','NA','External_Input','http://192.168.244.207/vsdp_test/test_resume/externalhit.php?cat=%cat','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','test_resume',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_resume','131','0','NA','1310','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','test_resume',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_resume','132','0','NA','1320','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','test_resume',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_resume','133','0','NA','1330','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','test_resume',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_resume','134','0','NA','1340','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','test_resume',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_resume','135','0','NA','1350','NA','Playfile','NA','/ismp/shared/test/prompts/test_resume/hindi10.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','test_resume',0,0,0,'0',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_resume','1350','0','NA','13500','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','test_resume',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_sdk_flow1','0','0','NA','1','NA','Inputs','NA','/ismp/shared/test/Prompts/test_sdk_flow1/main_prompt.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','page_one',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_sdk_flow1','1','1','NA','11','NA','Playfile','NA','/ismp/shared/test/Prompts/test_sdk_flow1/news.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','page_one',0,0,0,'0',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_sdk_flow1','1','2','NA','12','NA','Playfile','NA','/ismp/shared/test/Prompts/test_sdk_flow1/welcomePrompt2.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','page_one',0,0,0,'0',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_sdk_flow1','11','0','NA','1','NA','Inputs','NA','/ismp/shared/test/Prompts/test_sdk_flow1/main_prompt.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','page_one',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_sdk_flow1','11','1','NA','111','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','page_one',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_sdk_flow1','12','0','NA','1','NA','Inputs','NA','/ismp/shared/test/Prompts/test_sdk_flow1/main_prompt.wav','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','NA','page_one',0,0,0,'30',0);
insert  into `ivrmenu`(`Service`,`current_state`,`key_press`,`short_code`,`next_state`,`NextKey`,`Action_command`,`URL`,`play_file`,`record_file`,`input_length`,`Recordingtime`,`MenuStatus`,`NextFile`,`PrevFile`,`RepeatKey`,`BackKey`,`ForwardKey`,`selectkey`,`InstructionFile`,`MaxRetryCount`,`ErrorName`,`NodeName`,`PageName`,`ICF`,`IVF`,`SP`,`ratecode`,`FilePauseTime`) values ('test_sdk_flow1','12','1','NA','121','NA','Disconnectcall','NA','NA','NA',0,0,1,'NA','NA','NA','NA','NA','NA','NA',0,'0','0','page_one',0,0,0,'30',0);

/*Table structure for table `ivrmenu_copy` */

DROP TABLE IF EXISTS `ivrmenu_copy`;

CREATE TABLE `ivrmenu_copy` (
  `Service` varchar(50) NOT NULL DEFAULT '300',
  `current_state` varchar(50) NOT NULL,
  `key_press` varchar(50) NOT NULL,
  `short_code` varchar(50) DEFAULT NULL,
  `next_state` varchar(50) DEFAULT NULL,
  `NextKey` varchar(50) DEFAULT NULL,
  `Action_command` varchar(100) DEFAULT NULL,
  `URL` varchar(4000) DEFAULT NULL,
  `play_file` varchar(200) DEFAULT NULL,
  `record_file` varchar(200) DEFAULT NULL,
  `input_length` int(10) DEFAULT NULL,
  `Recordingtime` int(10) DEFAULT '300',
  `MenuStatus` int(10) DEFAULT '1',
  `NextFile` varchar(200) DEFAULT 'NA',
  `PrevFile` varchar(200) DEFAULT 'NA',
  `RepeatKey` varchar(200) DEFAULT NULL,
  `BackKey` varchar(50) DEFAULT NULL,
  `ForwardKey` varchar(50) DEFAULT NULL,
  `selectkey` varchar(50) DEFAULT NULL,
  `InstructionFile` varchar(500) DEFAULT NULL,
  `MaxRetryCount` bigint(19) DEFAULT '0',
  `ErrorName` varchar(50) DEFAULT NULL,
  `NodeName` varchar(50) DEFAULT NULL,
  `PageName` varchar(500) DEFAULT NULL,
  `ICF` int(10) DEFAULT '0',
  `IVF` int(10) DEFAULT '0',
  `SP` int(10) DEFAULT NULL,
  `ratecode` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Service`,`current_state`,`key_press`),
  UNIQUE KEY `PK_IVRMenu` (`Service`,`current_state`,`key_press`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ivrmenu_copy` */

/*Table structure for table `maximumsessiondurations` */

DROP TABLE IF EXISTS `maximumsessiondurations`;

CREATE TABLE `maximumsessiondurations` (
  `RateCode` varchar(50) NOT NULL,
  `Ano` varchar(50) NOT NULL,
  `Bno` varchar(50) NOT NULL,
  `MaxSessionDuration` int(10) NOT NULL,
  `StartTime` int(10) NOT NULL,
  `EndTime` int(10) NOT NULL,
  `OfferStatus` varchar(50) DEFAULT NULL,
  `ActivationDate` timestamp NULL DEFAULT NULL,
  `DeactivationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `maximumsessiondurations` */

/*Table structure for table `nodelogs` */

DROP TABLE IF EXISTS `nodelogs`;

CREATE TABLE `nodelogs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `callid` varchar(250) NOT NULL,
  `Service` varchar(50) NOT NULL,
  `current_state` varchar(50) NOT NULL,
  `key_press` varchar(50) NOT NULL,
  `next_state` varchar(50) DEFAULT NULL,
  `NodeName` varchar(50) DEFAULT NULL,
  `MachineID` bigint(20) NOT NULL,
  `Channel` int(11) DEFAULT NULL,
  `Ano` varchar(20) NOT NULL,
  `Bno` varchar(20) NOT NULL,
  `startTime` datetime NOT NULL,
  `endTime` datetime NOT NULL,
  `updated` tinyint(1) DEFAULT NULL,
  `UserID` varchar(50) DEFAULT NULL,
  `LastUpdate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`callid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `nodelogs` */

/*Table structure for table `outdialque` */

DROP TABLE IF EXISTS `outdialque`;

CREATE TABLE `outdialque` (
  `OutDialId` bigint(19) NOT NULL AUTO_INCREMENT,
  `MSISDN` varchar(50) NOT NULL,
  `DisplayAno` varchar(50) NOT NULL,
  `OriginalAno` varchar(50) DEFAULT NULL,
  `CpId` varchar(50) DEFAULT NULL,
  `ServiceId` varchar(50) NOT NULL,
  `ContentId` varchar(50) DEFAULT NULL,
  `ContentFile` varchar(500) DEFAULT NULL,
  `WelComeFile` varchar(500) DEFAULT NULL,
  `CpPriority` bigint(19) DEFAULT NULL,
  `ServicePriority` bigint(19) DEFAULT NULL,
  `OutDialStatus` varchar(50) DEFAULT NULL,
  `AllocateChannel` bigint(19) DEFAULT NULL,
  `RetTryCount` bigint(19) DEFAULT NULL,
  `OutDialTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `DeliveryTime` timestamp NULL DEFAULT NULL,
  `TrafficCase` int(10) DEFAULT NULL,
  `ServicePrviderId` int(10) DEFAULT NULL,
  `RefundStatus` char(10) DEFAULT NULL,
  `Amount` char(10) DEFAULT NULL,
  `UserId` varchar(50) DEFAULT NULL,
  `LaseUpdate` timestamp NULL DEFAULT NULL,
  `TransactionId` varchar(50) DEFAULT NULL,
  `TimeSlotID` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`OutDialId`),
  UNIQUE KEY `PK_OutDialQue` (`OutDialId`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Data for the table `outdialque` */

insert  into `outdialque`(`OutDialId`,`MSISDN`,`DisplayAno`,`OriginalAno`,`CpId`,`ServiceId`,`ContentId`,`ContentFile`,`WelComeFile`,`CpPriority`,`ServicePriority`,`OutDialStatus`,`AllocateChannel`,`RetTryCount`,`OutDialTime`,`DeliveryTime`,`TrafficCase`,`ServicePrviderId`,`RefundStatus`,`Amount`,`UserId`,`LaseUpdate`,`TransactionId`,`TimeSlotID`) values (1,'01674174924','2008','2008',NULL,'callconnect3001',NULL,NULL,NULL,NULL,NULL,'FORCED_FAILED',NULL,10,'2016-02-16 22:40:14',NULL,NULL,NULL,NULL,NULL,'543221',NULL,NULL,NULL);
insert  into `outdialque`(`OutDialId`,`MSISDN`,`DisplayAno`,`OriginalAno`,`CpId`,`ServiceId`,`ContentId`,`ContentFile`,`WelComeFile`,`CpPriority`,`ServicePriority`,`OutDialStatus`,`AllocateChannel`,`RetTryCount`,`OutDialTime`,`DeliveryTime`,`TrafficCase`,`ServicePrviderId`,`RefundStatus`,`Amount`,`UserId`,`LaseUpdate`,`TransactionId`,`TimeSlotID`) values (4,'01713404007','2008','2008',NULL,'OBD_Test',NULL,NULL,NULL,NULL,NULL,'FORCED_FAILED',NULL,2,'2016-02-17 18:41:47',NULL,NULL,NULL,NULL,NULL,'19',NULL,NULL,NULL);
insert  into `outdialque`(`OutDialId`,`MSISDN`,`DisplayAno`,`OriginalAno`,`CpId`,`ServiceId`,`ContentId`,`ContentFile`,`WelComeFile`,`CpPriority`,`ServicePriority`,`OutDialStatus`,`AllocateChannel`,`RetTryCount`,`OutDialTime`,`DeliveryTime`,`TrafficCase`,`ServicePrviderId`,`RefundStatus`,`Amount`,`UserId`,`LaseUpdate`,`TransactionId`,`TimeSlotID`) values (5,'01755693496','2008','2008',NULL,'OBD_Test',NULL,NULL,NULL,NULL,NULL,'FORCED_FAILED',NULL,2,'2016-02-17 18:43:13',NULL,NULL,NULL,NULL,NULL,'19',NULL,NULL,NULL);
insert  into `outdialque`(`OutDialId`,`MSISDN`,`DisplayAno`,`OriginalAno`,`CpId`,`ServiceId`,`ContentId`,`ContentFile`,`WelComeFile`,`CpPriority`,`ServicePriority`,`OutDialStatus`,`AllocateChannel`,`RetTryCount`,`OutDialTime`,`DeliveryTime`,`TrafficCase`,`ServicePrviderId`,`RefundStatus`,`Amount`,`UserId`,`LaseUpdate`,`TransactionId`,`TimeSlotID`) values (6,'01911890878','2008','2008',NULL,'OBD_Test',NULL,NULL,NULL,NULL,NULL,'PROCESSING',NULL,2,'2016-02-17 18:43:51',NULL,NULL,NULL,NULL,NULL,'19',NULL,NULL,NULL);
insert  into `outdialque`(`OutDialId`,`MSISDN`,`DisplayAno`,`OriginalAno`,`CpId`,`ServiceId`,`ContentId`,`ContentFile`,`WelComeFile`,`CpPriority`,`ServicePriority`,`OutDialStatus`,`AllocateChannel`,`RetTryCount`,`OutDialTime`,`DeliveryTime`,`TrafficCase`,`ServicePrviderId`,`RefundStatus`,`Amount`,`UserId`,`LaseUpdate`,`TransactionId`,`TimeSlotID`) values (7,'01713404007','','2008',NULL,'OBD_Test',NULL,NULL,NULL,NULL,NULL,'PROCESSING',NULL,2,'2016-02-17 18:43:55',NULL,NULL,NULL,NULL,NULL,'19',NULL,NULL,NULL);
insert  into `outdialque`(`OutDialId`,`MSISDN`,`DisplayAno`,`OriginalAno`,`CpId`,`ServiceId`,`ContentId`,`ContentFile`,`WelComeFile`,`CpPriority`,`ServicePriority`,`OutDialStatus`,`AllocateChannel`,`RetTryCount`,`OutDialTime`,`DeliveryTime`,`TrafficCase`,`ServicePrviderId`,`RefundStatus`,`Amount`,`UserId`,`LaseUpdate`,`TransactionId`,`TimeSlotID`) values (8,'01755693496','','2008',NULL,'OBD_Test',NULL,NULL,NULL,NULL,NULL,'PROCESSING',NULL,2,'2016-02-17 18:43:55',NULL,NULL,NULL,NULL,NULL,'19',NULL,NULL,NULL);
insert  into `outdialque`(`OutDialId`,`MSISDN`,`DisplayAno`,`OriginalAno`,`CpId`,`ServiceId`,`ContentId`,`ContentFile`,`WelComeFile`,`CpPriority`,`ServicePriority`,`OutDialStatus`,`AllocateChannel`,`RetTryCount`,`OutDialTime`,`DeliveryTime`,`TrafficCase`,`ServicePrviderId`,`RefundStatus`,`Amount`,`UserId`,`LaseUpdate`,`TransactionId`,`TimeSlotID`) values (9,'01911890878','','2008',NULL,'OBD_Test',NULL,NULL,NULL,NULL,NULL,'PROCESSING',NULL,2,'2016-02-17 18:43:55',NULL,NULL,NULL,NULL,NULL,'19',NULL,NULL,NULL);
insert  into `outdialque`(`OutDialId`,`MSISDN`,`DisplayAno`,`OriginalAno`,`CpId`,`ServiceId`,`ContentId`,`ContentFile`,`WelComeFile`,`CpPriority`,`ServicePriority`,`OutDialStatus`,`AllocateChannel`,`RetTryCount`,`OutDialTime`,`DeliveryTime`,`TrafficCase`,`ServicePrviderId`,`RefundStatus`,`Amount`,`UserId`,`LaseUpdate`,`TransactionId`,`TimeSlotID`) values (10,'01713404007','','2008',NULL,'OBD_Test',NULL,NULL,NULL,NULL,NULL,'PROCESSING',NULL,2,'2016-02-17 18:47:44',NULL,NULL,NULL,NULL,NULL,'19',NULL,NULL,NULL);
insert  into `outdialque`(`OutDialId`,`MSISDN`,`DisplayAno`,`OriginalAno`,`CpId`,`ServiceId`,`ContentId`,`ContentFile`,`WelComeFile`,`CpPriority`,`ServicePriority`,`OutDialStatus`,`AllocateChannel`,`RetTryCount`,`OutDialTime`,`DeliveryTime`,`TrafficCase`,`ServicePrviderId`,`RefundStatus`,`Amount`,`UserId`,`LaseUpdate`,`TransactionId`,`TimeSlotID`) values (11,'01755693496','','2008',NULL,'OBD_Test',NULL,NULL,NULL,NULL,NULL,'PROCESSING',NULL,2,'2016-02-17 18:47:44',NULL,NULL,NULL,NULL,NULL,'19',NULL,NULL,NULL);

/*Table structure for table `releaseurl` */

DROP TABLE IF EXISTS `releaseurl`;

CREATE TABLE `releaseurl` (
  `ano` varchar(50) NOT NULL,
  `bno` varchar(50) NOT NULL,
  `url` varchar(500) NOT NULL,
  `Status` varchar(50) DEFAULT 'Provision',
  `ProvisionEndDate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ano`,`bno`),
  UNIQUE KEY `PK_ReleaseUrl` (`ano`,`bno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `releaseurl` */

/*Table structure for table `servicedef` */

DROP TABLE IF EXISTS `servicedef`;

CREATE TABLE `servicedef` (
  `ServiceId` varchar(50) NOT NULL,
  `ServiceName` varchar(50) DEFAULT NULL,
  `IsOutDialBaseCharge` varchar(50) DEFAULT NULL,
  `WelcomeFile` varchar(500) DEFAULT NULL,
  `Priority` bigint(19) DEFAULT NULL,
  `AllocateChannel` bigint(19) DEFAULT NULL,
  `Active` int(10) DEFAULT NULL,
  `CreateDate` timestamp NULL DEFAULT NULL,
  `Userid` varchar(50) DEFAULT NULL,
  `LastUpdate` timestamp NULL DEFAULT NULL,
  `MaxRetryCount` int(10) DEFAULT NULL,
  `RetryDelayMinute` int(10) DEFAULT NULL,
  `RetryMechanism` varchar(50) DEFAULT NULL,
  `PromotionOutdial` tinyint(4) DEFAULT '0',
  `callingType` varchar(20) DEFAULT 'audio',
  PRIMARY KEY (`ServiceId`),
  UNIQUE KEY `PK_ServiceDef_1` (`ServiceId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `servicedef` */

insert  into `servicedef`(`ServiceId`,`ServiceName`,`IsOutDialBaseCharge`,`WelcomeFile`,`Priority`,`AllocateChannel`,`Active`,`CreateDate`,`Userid`,`LastUpdate`,`MaxRetryCount`,`RetryDelayMinute`,`RetryMechanism`,`PromotionOutdial`,`callingType`) values ('callconnect','callconnect','YES',NULL,1,400,1,'2015-03-02 05:46:17','ssd-tech',NULL,2,1,'Absolute',0,'audio');
insert  into `servicedef`(`ServiceId`,`ServiceName`,`IsOutDialBaseCharge`,`WelcomeFile`,`Priority`,`AllocateChannel`,`Active`,`CreateDate`,`Userid`,`LastUpdate`,`MaxRetryCount`,`RetryDelayMinute`,`RetryMechanism`,`PromotionOutdial`,`callingType`) values ('callconnect3001','callconnect3001','callconnect3001',NULL,1,400,1,'2015-03-02 05:46:17','ssd-tech',NULL,2,1,'Absolute',0,'audio');
insert  into `servicedef`(`ServiceId`,`ServiceName`,`IsOutDialBaseCharge`,`WelcomeFile`,`Priority`,`AllocateChannel`,`Active`,`CreateDate`,`Userid`,`LastUpdate`,`MaxRetryCount`,`RetryDelayMinute`,`RetryMechanism`,`PromotionOutdial`,`callingType`) values ('map_panel','map_panel','YES',NULL,1,400,1,NULL,'ssd-tech',NULL,4,1,'Absolute',0,'audio');
insert  into `servicedef`(`ServiceId`,`ServiceName`,`IsOutDialBaseCharge`,`WelcomeFile`,`Priority`,`AllocateChannel`,`Active`,`CreateDate`,`Userid`,`LastUpdate`,`MaxRetryCount`,`RetryDelayMinute`,`RetryMechanism`,`PromotionOutdial`,`callingType`) values ('OBD_Test','OBD_Test','YES','',1,400,1,'2015-03-02 05:46:17','ssd-tech',NULL,2,1,'Absolute',0,'audio');
insert  into `servicedef`(`ServiceId`,`ServiceName`,`IsOutDialBaseCharge`,`WelcomeFile`,`Priority`,`AllocateChannel`,`Active`,`CreateDate`,`Userid`,`LastUpdate`,`MaxRetryCount`,`RetryDelayMinute`,`RetryMechanism`,`PromotionOutdial`,`callingType`) values ('record_conference','record_conference','YES',NULL,1,400,1,'2015-03-02 05:46:17','ssd-tech',NULL,2,1,'Absolute',0,'audio');
insert  into `servicedef`(`ServiceId`,`ServiceName`,`IsOutDialBaseCharge`,`WelcomeFile`,`Priority`,`AllocateChannel`,`Active`,`CreateDate`,`Userid`,`LastUpdate`,`MaxRetryCount`,`RetryDelayMinute`,`RetryMechanism`,`PromotionOutdial`,`callingType`) values ('test_play_file','test_play_file','YES',NULL,1,400,1,'2015-03-02 05:46:17','ssd-tech',NULL,2,1,'Absolute',0,'audio');

/*Table structure for table `serviceurl` */

DROP TABLE IF EXISTS `serviceurl`;

CREATE TABLE `serviceurl` (
  `ServiceName` varchar(100) NOT NULL,
  `url` varchar(500) NOT NULL,
  `callingType` varchar(20) DEFAULT 'audio',
  PRIMARY KEY (`ServiceName`),
  UNIQUE KEY `PK_ServiceUrl` (`ServiceName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `serviceurl` */

insert  into `serviceurl`(`ServiceName`,`url`,`callingType`) values ('callconnect','/vsdp_test/vsdpservices/flowmanager.php?service=callconnect&','audio');
insert  into `serviceurl`(`ServiceName`,`url`,`callingType`) values ('callconnect3001','/vsdp_test/vsdpservices/flowmanager.php?service=callconnect3001&','audio');
insert  into `serviceurl`(`ServiceName`,`url`,`callingType`) values ('map_panel','/vsdp/vsdpservices/flowmanager.php?service=map_panel&','audio');
insert  into `serviceurl`(`ServiceName`,`url`,`callingType`) values ('OBD_Test','/vsdp_test/vsdpservices/flowmanager.php?service=OBD_Test&','audio');
insert  into `serviceurl`(`ServiceName`,`url`,`callingType`) values ('record_conference','/vsdp_test/vsdpservices/flowmanager.php?service=record_conference&','audio');
insert  into `serviceurl`(`ServiceName`,`url`,`callingType`) values ('test_play_file','/vsdp_test/vsdpservices/flowmanager.php?service=test_play_file&','audio');

/*Table structure for table `session` */

DROP TABLE IF EXISTS `session`;

CREATE TABLE `session` (
  `msisdn` varchar(20) NOT NULL,
  `serviceID` varchar(100) NOT NULL,
  `currentState` varchar(20) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`msisdn`,`serviceID`,`currentState`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

/*Data for the table `session` */

insert  into `session`(`msisdn`,`serviceID`,`currentState`,`id`) values ('01552426754','index','11',31);

/*Table structure for table `sms_service` */

DROP TABLE IF EXISTS `sms_service`;

CREATE TABLE `sms_service` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `service` varchar(100) DEFAULT NULL,
  `page` varchar(150) DEFAULT NULL,
  `type` enum('SMS','USSD') DEFAULT 'SMS',
  `user_id` varchar(50) DEFAULT NULL,
  `last_updated_by` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `NewIndex1` (`service`,`page`,`type`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `sms_service` */

insert  into `sms_service`(`id`,`service`,`page`,`type`,`user_id`,`last_updated_by`) values (9,'test','test','SMS','1',NULL);
insert  into `sms_service`(`id`,`service`,`page`,`type`,`user_id`,`last_updated_by`) values (11,'test2','test2','SMS','1',NULL);

/*Table structure for table `smsmenu` */

DROP TABLE IF EXISTS `smsmenu`;

CREATE TABLE `smsmenu` (
  `ServiceID` varchar(50) NOT NULL DEFAULT '',
  `current_state` varchar(50) NOT NULL,
  `key_press` varchar(20) NOT NULL,
  `short_code` varchar(10) DEFAULT NULL,
  `next_state` varchar(50) DEFAULT NULL,
  `Action_command` varchar(100) DEFAULT NULL,
  `External_Input` varchar(200) DEFAULT NULL,
  `show_text` varchar(200) DEFAULT NULL,
  `PageName` varchar(100) NOT NULL,
  PRIMARY KEY (`ServiceID`,`current_state`,`key_press`),
  UNIQUE KEY `PK_SMSMenu` (`ServiceID`,`current_state`,`key_press`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `smsmenu` */

insert  into `smsmenu`(`ServiceID`,`current_state`,`key_press`,`short_code`,`next_state`,`Action_command`,`External_Input`,`show_text`,`PageName`) values ('index','0','0','2580','1','show_text','NA','1 AGRI 2 NAMAZ','index');
insert  into `smsmenu`(`ServiceID`,`current_state`,`key_press`,`short_code`,`next_state`,`Action_command`,`External_Input`,`show_text`,`PageName`) values ('index','1','1','2580','11','show_text','NA','1 START 2 STOP','index');
insert  into `smsmenu`(`ServiceID`,`current_state`,`key_press`,`short_code`,`next_state`,`Action_command`,`External_Input`,`show_text`,`PageName`) values ('index','1','2','2580','12','show_text',NULL,'1 START 2 STOP','index');
insert  into `smsmenu`(`ServiceID`,`current_state`,`key_press`,`short_code`,`next_state`,`Action_command`,`External_Input`,`show_text`,`PageName`) values ('index','11','1','2580','111','show_text',NULL,'1 DAILY 2 MONTHLY','index');
insert  into `smsmenu`(`ServiceID`,`current_state`,`key_press`,`short_code`,`next_state`,`Action_command`,`External_Input`,`show_text`,`PageName`) values ('index','11','2','2580','112','External_Input','core/service.php?mn=%mn&msg=STOP AGRI&op=%op&sc=%sc','','index');
insert  into `smsmenu`(`ServiceID`,`current_state`,`key_press`,`short_code`,`next_state`,`Action_command`,`External_Input`,`show_text`,`PageName`) values ('index','111','1','2580','1111','External_Input','core/service.php?mn=%mn&msg=START%20AGRI&op=BL&sc=2580&AOC=1',NULL,'index');
insert  into `smsmenu`(`ServiceID`,`current_state`,`key_press`,`short_code`,`next_state`,`Action_command`,`External_Input`,`show_text`,`PageName`) values ('index','111','2','2580','1112','External_Input','core/service.php?mn=%mn&msg=START%20AGRI&op=%op&sc=%sc&AOC=1',NULL,'index');
insert  into `smsmenu`(`ServiceID`,`current_state`,`key_press`,`short_code`,`next_state`,`Action_command`,`External_Input`,`show_text`,`PageName`) values ('index','1111','1','2580','11111','External_Input','core/aoc.php?mn=%mn&k1=%k1&k2=%k2&k3=%k3',NULL,'index');
insert  into `smsmenu`(`ServiceID`,`current_state`,`key_press`,`short_code`,`next_state`,`Action_command`,`External_Input`,`show_text`,`PageName`) values ('index','1111','2','2580 ','11112','Disconnectcall','core/service.php?mn=%mn&msg=STOP%20AGRI&op=%op&sc=%sc',NULL,'index');
insert  into `smsmenu`(`ServiceID`,`current_state`,`key_press`,`short_code`,`next_state`,`Action_command`,`External_Input`,`show_text`,`PageName`) values ('index','12','1','2580','121','show_text',NULL,NULL,'index');
insert  into `smsmenu`(`ServiceID`,`current_state`,`key_press`,`short_code`,`next_state`,`Action_command`,`External_Input`,`show_text`,`PageName`) values ('index','12','2','2580','122','Disconnectcall','Deregister',NULL,'index');
insert  into `smsmenu`(`ServiceID`,`current_state`,`key_press`,`short_code`,`next_state`,`Action_command`,`External_Input`,`show_text`,`PageName`) values ('index','121','1','2580','1211','External_Input','aoc',NULL,'index');
insert  into `smsmenu`(`ServiceID`,`current_state`,`key_press`,`short_code`,`next_state`,`Action_command`,`External_Input`,`show_text`,`PageName`) values ('index','121','2','2580','1212','External_Input','aoc',NULL,'index');
insert  into `smsmenu`(`ServiceID`,`current_state`,`key_press`,`short_code`,`next_state`,`Action_command`,`External_Input`,`show_text`,`PageName`) values ('index','1211','1','2580','12111','External_Input','service.php',NULL,'index');
insert  into `smsmenu`(`ServiceID`,`current_state`,`key_press`,`short_code`,`next_state`,`Action_command`,`External_Input`,`show_text`,`PageName`) values ('index','1211','2','2580','12112','Disconnectcall','deregister',NULL,'index');
insert  into `smsmenu`(`ServiceID`,`current_state`,`key_press`,`short_code`,`next_state`,`Action_command`,`External_Input`,`show_text`,`PageName`) values ('menutest','0','0','NA','1','show_text','NA','1 agri 2 namaz','menutest');
insert  into `smsmenu`(`ServiceID`,`current_state`,`key_press`,`short_code`,`next_state`,`Action_command`,`External_Input`,`show_text`,`PageName`) values ('menutest2','0','0','NA','1','show_text','NA','1 Student 2 Service Holder','menutest2');
insert  into `smsmenu`(`ServiceID`,`current_state`,`key_press`,`short_code`,`next_state`,`Action_command`,`External_Input`,`show_text`,`PageName`) values ('menutest2','1','1','NA','11','show_text','NA','1 Start  2 Stop','menutest2');
insert  into `smsmenu`(`ServiceID`,`current_state`,`key_press`,`short_code`,`next_state`,`Action_command`,`External_Input`,`show_text`,`PageName`) values ('menutest2','1','2','NA','12','show_text','NA','1 Start  2 Stop','menutest2');
insert  into `smsmenu`(`ServiceID`,`current_state`,`key_press`,`short_code`,`next_state`,`Action_command`,`External_Input`,`show_text`,`PageName`) values ('menutest2','11','1','NA','111','NA','NAmenutest2/core/service.php?mn=%mn','NA','menutest2');
insert  into `smsmenu`(`ServiceID`,`current_state`,`key_press`,`short_code`,`next_state`,`Action_command`,`External_Input`,`show_text`,`PageName`) values ('service_207','0','0','NA','1','External_Input','NA','NA','service_207');
insert  into `smsmenu`(`ServiceID`,`current_state`,`key_press`,`short_code`,`next_state`,`Action_command`,`External_Input`,`show_text`,`PageName`) values ('service_207','1','0','NA','10','show_text','NA','NA','service_207');
insert  into `smsmenu`(`ServiceID`,`current_state`,`key_press`,`short_code`,`next_state`,`Action_command`,`External_Input`,`show_text`,`PageName`) values ('test','0','0','NA','1','Inputs','NA','http://localhost/vsdp_test/test/test.php','test');
insert  into `smsmenu`(`ServiceID`,`current_state`,`key_press`,`short_code`,`next_state`,`Action_command`,`External_Input`,`show_text`,`PageName`) values ('test','1','1','NA','11','show_text','NA','http://localhost/vsdp_test/test/test.php','test');
insert  into `smsmenu`(`ServiceID`,`current_state`,`key_press`,`short_code`,`next_state`,`Action_command`,`External_Input`,`show_text`,`PageName`) values ('test','1','2','NA','12','show_text','NA','Hello SMS Service','test');
insert  into `smsmenu`(`ServiceID`,`current_state`,`key_press`,`short_code`,`next_state`,`Action_command`,`External_Input`,`show_text`,`PageName`) values ('test_service_207','0','0','NA','1','show_text','NA','NA','test_service_207');
insert  into `smsmenu`(`ServiceID`,`current_state`,`key_press`,`short_code`,`next_state`,`Action_command`,`External_Input`,`show_text`,`PageName`) values ('test_service_207','1','0','NA','10','Inputs','NA','NA','test_service_207');
insert  into `smsmenu`(`ServiceID`,`current_state`,`key_press`,`short_code`,`next_state`,`Action_command`,`External_Input`,`show_text`,`PageName`) values ('test_service_207','1','1','NA','11','Disconnectcall','NA','NA','test_service_207');
insert  into `smsmenu`(`ServiceID`,`current_state`,`key_press`,`short_code`,`next_state`,`Action_command`,`External_Input`,`show_text`,`PageName`) values ('test_service_207','10','1','NA','101','Disconnectcall','NA','NA','test_service_207');

/*Table structure for table `storedata` */

DROP TABLE IF EXISTS `storedata`;

CREATE TABLE `storedata` (
  `machineid` varchar(50) DEFAULT NULL,
  `channel` varchar(50) DEFAULT NULL,
  `propertyname` varchar(50) DEFAULT NULL,
  `propertyvalue` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `storedata` */

insert  into `storedata`(`machineid`,`channel`,`propertyname`,`propertyvalue`) values ('198','61','RECORD_CONFERENCE','/ismp/shared/test/recordings/record_conference/conference__22111535547pm2003198061.wav');
insert  into `storedata`(`machineid`,`channel`,`propertyname`,`propertyvalue`) values ('198','63','RECORD_CONFERENCE','/ismp/shared/test/recordings/record_conference/conference__22111544038pm2003198063.wav');
insert  into `storedata`(`machineid`,`channel`,`propertyname`,`propertyvalue`) values ('46','60','RECORD_CONFERENCE','/ismp/shared/test/recordings/record_conference/conference__27121573838pm2003046060.wav');

/*Table structure for table `stream` */

DROP TABLE IF EXISTS `stream`;

CREATE TABLE `stream` (
  `ano` varchar(10) DEFAULT NULL,
  `bno` varchar(10) DEFAULT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `id` int(5) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `stream` */

insert  into `stream`(`ano`,`bno`,`Name`,`id`) values ('2000','2300','Music-1',1);
insert  into `stream`(`ano`,`bno`,`Name`,`id`) values ('2000','2200','Music-2',2);

/*!50106 set global event_scheduler = 1*/;

/* Event structure for event `conf_delete` */

/*!50106 DROP EVENT IF EXISTS `conf_delete`*/;

DELIMITER $$

/*!50106 CREATE DEFINER=`root`@`%` EVENT `conf_delete` ON SCHEDULE EVERY 1 MINUTE STARTS '2015-07-15 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
	   
	   call `conference_delete`();	    
	END */$$
DELIMITER ;

/* Function  structure for function  `is_blocked_time` */

/*!50003 DROP FUNCTION IF EXISTS `is_blocked_time` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` FUNCTION `is_blocked_time`(present_time DATETIME) RETURNS varchar(10) CHARSET latin1
BEGIN
	DECLARE present_day INT;
	DECLARE present_minute INT;
	DECLARE row_num INT ;
	
	SET present_day := DAY(present_time);
	SET present_minute := HOUR(present_time)*60 + MINUTE (present_time);
	SELECT COUNT(*) INTO row_num FROM blocktime WHERE (present_day BETWEEN startday AND endday) AND (present_minute BETWEEN starttime AND endtime) AND (present_time BETWEEN activestart AND activeend);
	IF(row_num != 0) THEN
		RETURN 'YES';
	ELSE
		RETURN 'NO';
	END IF;
	
END */$$
DELIMITER ;

/* Function  structure for function  `is_timeslot_blocked` */

/*!50003 DROP FUNCTION IF EXISTS `is_timeslot_blocked` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` FUNCTION `is_timeslot_blocked`(var_timeslotid VARCHAR(500)) RETURNS varchar(4000) CHARSET latin1
BEGIN
	DECLARE present_day INT;
	DECLARE present_minute INT;
	DECLARE row_num INT ;
	DECLARE present_time DATETIME;
	
	
	
	SET present_time = NOW();
	SET present_day := WEEKDAY(present_time);
	IF(present_day = 6) THEN
	   SET present_day := 1;
	ELSE
		SET present_day = present_day+2;
	END IF;
	SET present_minute := HOUR(present_time)*60 + MINUTE (present_time);
	SELECT COUNT(*) INTO row_num FROM allowedtime WHERE timeslotid = var_timeslotid AND 
	(present_day BETWEEN startday AND endday) AND (present_minute BETWEEN starttime AND endtime) 
	AND (present_time BETWEEN activestart AND activeend);
	IF(row_num != 0) THEN
		RETURN 'NO';
	ELSE
		RETURN 'YES';
	END IF;
	
END */$$
DELIMITER ;

/* Procedure structure for procedure `conference_delete` */

/*!50003 DROP PROCEDURE IF EXISTS  `conference_delete` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `conference_delete`()
BEGIN    	  
	    DELETE FROM conference_obd WHERE bno IN (SELECT room_id FROM conference_room cr WHERE room_status='BUSY' AND TIMESTAMPDIFF(MINUTE,cr.last_update,NOW())>=30);
	    DELETE FROM conference WHERE bno IN (SELECT room_id FROM conference_room cr WHERE room_status='BUSY' and TIMESTAMPDIFF(MINUTE,cr.last_update,NOW())>=30);
	    UPDATE conference_room SET room_status = 'FREE' WHERE room_status='BUSY' AND TIMESTAMPDIFF(MINUTE,last_update,NOW())>=30;
	    
    END */$$
DELIMITER ;

/* Procedure structure for procedure `outdial` */

/*!50003 DROP PROCEDURE IF EXISTS  `outdial` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%.%.%.%` PROCEDURE `outdial`()
BEGIN
DECLARE i INT UNSIGNED DEFAULT 0;
WHILE i < 50000 DO 
     
     INSERT INTO `outdialque`(`OutDialId`,`MSISDN`,`DisplayAno`,`OriginalAno`,`CpId`,`ServiceId`,`ContentId`,`ContentFile`,`WelComeFile`,`CpPriority`,`ServicePriority`,`OutDialStatus`,`AllocateChannel`,`RetTryCount`,`OutDialTime`,`DeliveryTime`,`TrafficCase`,`ServicePrviderId`,`RefundStatus`,`Amount`,`UserId`,`LaseUpdate`,`TransactionId`,`TimeSlotID`) 
     VALUES ( 'i','2580','2008','2008',NULL,'OBD_Test',NULL,NULL,NULL,'3','3','DELIVERED','400','1','0000-00-00 00:00:00',NULL,'20','30','1','2','ssd-tech','2014-11-19 02:51:20',NULL,NULL);
     
     SET i = i + 1;
     
END WHILE;
COMMIT;
 
END */$$
DELIMITER ;

/* Procedure structure for procedure `Sampletest` */

/*!50003 DROP PROCEDURE IF EXISTS  `Sampletest` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%.%.%.%` PROCEDURE `Sampletest`()
BEGIN
DECLARE i INT ;
DECLARE j INT;
SET i = 0;
SET j=0;
WHILE i < 100000 DO 
     
     INSERT INTO `test`(`ano`,`bno`,`CallStartTime`,`CallEndTime`,`CallID`,`traversedFileList`,`lastePlayedFile`,`sentBytes`,`releasecause`,`serviceName`,`currentState`,`lastPressedKey`)
     VALUES ( '2005'+i,'2580'+j,'2015-02-09 14:37:26','2015-02-09 14:37:50','207001040520151516'+i,'hindi10.wav','/ismp/shared/test/Prompts/2008_MobileDrama_7_4/hindi10.wav','6560'+i,NULL,'2580_Banowat_6','1','0');
     
     SET i = i + 1;
     
    IF (i%10000 = 0)THEN
	SET j:=j+1;
	END IF;
     
END WHILE;
END */$$
DELIMITER ;

/* Procedure structure for procedure `test` */

/*!50003 DROP PROCEDURE IF EXISTS  `test` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%.%.%.%` PROCEDURE `test`()
BEGIN
DECLARE i INT UNSIGNED DEFAULT 0;
WHILE i < 1000 DO 
     
     INSERT INTO `outdialque`(`OutDialId`,`MSISDN`,`DisplayAno`,`OriginalAno`,`CpId`,`ServiceId`,`ContentId`,`ContentFile`,`WelComeFile`,`CpPriority`,`ServicePriority`,`OutDialStatus`,`AllocateChannel`,`RetTryCount`,`OutDialTime`,`DeliveryTime`,`TrafficCase`,`ServicePrviderId`,`RefundStatus`,`Amount`,`UserId`,`LaseUpdate`,`TransactionId`,`TimeSlotID`) VALUES ( i,'2000'+i,'2580','2580',NULL,'PromotionOutDialAudio',NULL,NULL,NULL,'3','3','QUE','400','26','2015-02-09 14:37:26',NULL,'20','30','1','2','ssd-tech','2014-11-19 02:51:20',NULL,NULL);
     
     SET i = i + 1;
     
END WHILE;
COMMIT;
 
END */$$
DELIMITER ;

/*Table structure for table `vwoutdialserviceque` */

DROP TABLE IF EXISTS `vwoutdialserviceque`;

/*!50001 DROP VIEW IF EXISTS `vwoutdialserviceque` */;
/*!50001 DROP TABLE IF EXISTS `vwoutdialserviceque` */;

/*!50001 CREATE TABLE  `vwoutdialserviceque`(
 `OutDialId` bigint(19) NOT NULL  default '0' ,
 `ano` varchar(50) NOT NULL ,
 `bno` varchar(50) NOT NULL ,
 `ServiceName` varchar(50) NULL ,
 `OutDialTime` timestamp NOT NULL  default '0000-00-00 00:00:00' ,
 `callingType` varchar(20) NULL  default 'audio' 
)*/;

/*Table structure for table `vwoutdialserviceretry` */

DROP TABLE IF EXISTS `vwoutdialserviceretry`;

/*!50001 DROP VIEW IF EXISTS `vwoutdialserviceretry` */;
/*!50001 DROP TABLE IF EXISTS `vwoutdialserviceretry` */;

/*!50001 CREATE TABLE  `vwoutdialserviceretry`(
 `OutDialId` bigint(19) NOT NULL  default '0' ,
 `MaxRetryCount` int(10) NULL ,
 `RetryDelayMinute` int(10) NULL ,
 `RetryMechanism` varchar(50) NULL 
)*/;

/*View structure for view vwoutdialserviceque */

/*!50001 DROP TABLE IF EXISTS `vwoutdialserviceque` */;
/*!50001 DROP VIEW IF EXISTS `vwoutdialserviceque` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`192.168.%.%` SQL SECURITY DEFINER VIEW `vwoutdialserviceque` AS select `outdialque`.`OutDialId` AS `OutDialId`,`outdialque`.`DisplayAno` AS `ano`,`outdialque`.`MSISDN` AS `bno`,`servicedef`.`ServiceName` AS `ServiceName`,`outdialque`.`OutDialTime` AS `OutDialTime`,`servicedef`.`callingType` AS `callingType` from (`outdialque` join `servicedef` on((`outdialque`.`ServiceId` = `servicedef`.`ServiceId`))) where (((`outdialque`.`OutDialStatus` = 'QUE') or (`outdialque`.`OutDialStatus` = 'DELAYED')) and (`servicedef`.`PromotionOutdial` <> 1) and ((`outdialque`.`TimeSlotID` = '') or isnull(`outdialque`.`TimeSlotID`) or (`is_timeslot_blocked`(`outdialque`.`TimeSlotID`) = 'NO'))) order by `servicedef`.`Priority` */;

/*View structure for view vwoutdialserviceretry */

/*!50001 DROP TABLE IF EXISTS `vwoutdialserviceretry` */;
/*!50001 DROP VIEW IF EXISTS `vwoutdialserviceretry` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`192.168.%.%` SQL SECURITY DEFINER VIEW `vwoutdialserviceretry` AS select `outdialque`.`OutDialId` AS `OutDialId`,`servicedef`.`MaxRetryCount` AS `MaxRetryCount`,`servicedef`.`RetryDelayMinute` AS `RetryDelayMinute`,`servicedef`.`RetryMechanism` AS `RetryMechanism` from (`outdialque` join `servicedef` on((`outdialque`.`ServiceId` = `servicedef`.`ServiceId`))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
