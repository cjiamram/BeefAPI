/*
SQLyog Ultimate v8.82 
MySQL - 5.5.5-10.4.24-MariaDB : Database - dbbeefjudge
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`dbbeefjudge` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `dbbeefjudge`;

/*Table structure for table `t_beef` */

DROP TABLE IF EXISTS `t_beef`;

CREATE TABLE `t_beef` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `beefFolder` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `beefCode` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `classifyJudge` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `t_beef` */

LOCK TABLES `t_beef` WRITE;

insert  into `t_beef`(`id`,`beefFolder`,`beefCode`,`status`,`classifyJudge`,`createDate`) values (1,'N001','N001',0,'0','2022-08-13 00:00:00'),(2,'N002','N002',0,'0','2022-08-14 00:00:00');

UNLOCK TABLES;

/*Table structure for table `t_beefjudge` */

DROP TABLE IF EXISTS `t_beefjudge`;

CREATE TABLE `t_beefjudge` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `judgeCode` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `beefCode` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `beeGrade` decimal(18,2) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `t_beefjudge` */

LOCK TABLES `t_beefjudge` WRITE;

UNLOCK TABLES;

/*Table structure for table `t_judge` */

DROP TABLE IF EXISTS `t_judge`;

CREATE TABLE `t_judge` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `beefFolder` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `beefCode` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `classifyJudge` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `t_judge` */

LOCK TABLES `t_judge` WRITE;

UNLOCK TABLES;

/*Table structure for table `t_judgement` */

DROP TABLE IF EXISTS `t_judgement`;

CREATE TABLE `t_judgement` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `judgeName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `t_judgement` */

LOCK TABLES `t_judgement` WRITE;

UNLOCK TABLES;

/*Table structure for table `t_label` */

DROP TABLE IF EXISTS `t_label`;

CREATE TABLE `t_label` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tableName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fieldName` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thLabel` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enLabel` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flag` smallint(6) DEFAULT NULL,
  `moduleTH` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `t_label` */

LOCK TABLES `t_label` WRITE;

insert  into `t_label`(`id`,`tableName`,`fieldName`,`thLabel`,`enLabel`,`flag`,`moduleTH`) values (1,'t_beef','BeefInfomation','ข้อมูลการแสกนเนื้อ','Beef Classification',0,NULL);

UNLOCK TABLES;

/*Table structure for table `t_menu` */

DROP TABLE IF EXISTS `t_menu`;

CREATE TABLE `t_menu` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `MenuId` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MenuName` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Link` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Parent` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `OrderNo` int(11) DEFAULT NULL,
  `LevelNo` int(11) DEFAULT NULL,
  `Topic` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PrettyLink` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enableDefault` int(11) DEFAULT NULL,
  `icon` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `t_menu` */

LOCK TABLES `t_menu` WRITE;

insert  into `t_menu`(`id`,`MenuId`,`MenuName`,`Link`,`Parent`,`OrderNo`,`LevelNo`,`Topic`,`PrettyLink`,`enableDefault`,`icon`) values (16,'MN01','Build App','','',5,0,'','1',2,'fa fa-cubes'),(17,'MN01-1','Build Model','buildModel/buildModelConsole.php','MN01',1,1,NULL,NULL,2,''),(18,'MN01-2','Build Controller','buildModel/buildControllerConsole.php','MN01',2,1,NULL,NULL,2,''),(19,'MN01-3','Build Index List','buildModel/buildViewIndexConsole.php','MN01',3,1,NULL,NULL,2,''),(20,'MN01-4','Build Input Page','buildModel/buildInputConsole.php','MN01',4,1,NULL,NULL,2,''),(23,'MN01-5','Build View Display Data','buildModel/buildViewDisplayData.php','MN01',5,1,NULL,NULL,2,''),(45,'MN01-6','Labels','buildModel/buildLabelConsole.php','MN01',5,1,NULL,NULL,2,''),(85,'MN02','Beef','tbeef/displayBeefInfo.php','',1,0,NULL,NULL,2,'fa fa-pie-chart'),(86,'MN02-1','Classification','tbeef/displayBeefInfo.php','MN02',1,1,NULL,NULL,2,NULL);

UNLOCK TABLES;

/*Table structure for table `t_privillage` */

DROP TABLE IF EXISTS `t_privillage`;

CREATE TABLE `t_privillage` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `UserId` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MenuId` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2748 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `t_privillage` */

LOCK TABLES `t_privillage` WRITE;

insert  into `t_privillage`(`id`,`UserId`,`MenuId`) values (27,'Admin','MN01'),(28,'Admin','MN01-1'),(29,'Admin','MN01-2'),(30,'Admin','MN01-3'),(31,'Admin','MN01-4'),(34,'Admin','MN01-5'),(265,'Admin','MN01-6'),(2746,'admin','MN02'),(2747,'admin','MN02-1');

UNLOCK TABLES;

/*Table structure for table `t_user` */

DROP TABLE IF EXISTS `t_user`;

CREATE TABLE `t_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Password` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FullName` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Picture` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserCode` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DepartmentId` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telNo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lineNo` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `t_user` */

LOCK TABLES `t_user` WRITE;

insert  into `t_user`(`id`,`UserName`,`Password`,`FullName`,`Picture`,`UserCode`,`DepartmentId`,`position`,`telNo`,`email`,`lineNo`,`facebook`) values (1,'Admin','81dc9bdb52d04dc20036dbd8313ed055','Chatchai Jiamram','http://localhost/LocalWisdom/uploads/Admin/Chatchai.jpg',NULL,'ALL','Admin','083-2302608',NULL,'cjiamram@gmail.com','cjiamram@gmail.com'),(24,'cjiamram','d41d8cd98f00b204e9800998ecf8427e','ฉัตรชัย เจียมรัมย์','http://localhost/LocalWisdom/uploads/cjiamram/Chatchai.jpg',NULL,'640800001','นักวิชาการคอมพิวเตอร์','083-2302608','cjiamram@gmail.com','cjiamram@gmail.com','cjiamram@gmail.com');

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
