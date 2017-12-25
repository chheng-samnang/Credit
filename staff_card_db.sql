/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.7.11 : Database - staff_card_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`staff_card_db` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `staff_card_db`;

/*Table structure for table `tbl_category` */

DROP TABLE IF EXISTS `tbl_category`;

CREATE TABLE `tbl_category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `cat_name` varchar(150) DEFAULT NULL,
  `cat_name_kh` varchar(150) DEFAULT NULL,
  `cat_name_ch` varchar(150) DEFAULT NULL,
  `cat_desc` text,
  `user_crea` varchar(50) DEFAULT NULL,
  `date_crea` date DEFAULT NULL,
  `user_updt` varchar(50) DEFAULT NULL,
  `date_updt` date DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_category` */

LOCK TABLES `tbl_category` WRITE;

insert  into `tbl_category`(`cat_id`,`parent_id`,`cat_name`,`cat_name_kh`,`cat_name_ch`,`cat_desc`,`user_crea`,`date_crea`,`user_updt`,`date_updt`) values (6,0,'Construction Materials ','សំភារៈសំណង់','建築材料','<p>ccccccccccccccccccccc</p>','admin','2017-07-21',NULL,NULL),(5,0,'Agricultural Equipment','សំភារៈសិកម្ម','農業設備','<p>សដថសដដថដសថ</p>','Admin','2017-03-30',NULL,NULL),(7,0,' Household devices','ឧបករណ៍ប្រើប្រាស់ក្នុងផ្ទះ','家用設備','<p>ដថសថសថសដថសថសដថ</p>','Admin','2017-03-30',NULL,NULL),(8,0,'Classify','សំភារៈផ្សេងៗ','分類','<p>សាដសាថាសាសដាស​ដសថដ</p>','Admin','2017-03-30',NULL,NULL);

UNLOCK TABLES;

/*Table structure for table `tbl_department` */

DROP TABLE IF EXISTS `tbl_department`;

CREATE TABLE `tbl_department` (
  `dep_id` int(11) NOT NULL AUTO_INCREMENT,
  `dep_code` varchar(20) DEFAULT NULL,
  `dep_name` varchar(100) DEFAULT NULL,
  `dep_name_kh` varchar(100) DEFAULT NULL,
  `dep_desc` varchar(200) DEFAULT NULL,
  `user_crea` varchar(50) DEFAULT NULL,
  `date_crea` date DEFAULT NULL,
  `user_updt` varchar(50) DEFAULT NULL,
  `date_updt` date DEFAULT NULL,
  PRIMARY KEY (`dep_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_department` */

LOCK TABLES `tbl_department` WRITE;

insert  into `tbl_department`(`dep_id`,`dep_code`,`dep_name`,`dep_name_kh`,`dep_desc`,`user_crea`,`date_crea`,`user_updt`,`date_updt`) values (1,'D001','Information Technology',NULL,'this is a sample description','admin','2017-12-21',NULL,NULL),(3,'D003','Accounting',NULL,'','admin','2017-12-25',NULL,NULL),(4,'D004','Finance',NULL,'','admin','2017-12-25',NULL,NULL),(5,'D004','Human Resource',NULL,'','admin','2017-12-25','admin','2017-12-25');

UNLOCK TABLES;

/*Table structure for table `tbl_permission` */

DROP TABLE IF EXISTS `tbl_permission`;

CREATE TABLE `tbl_permission` (
  `per_id` int(11) NOT NULL AUTO_INCREMENT,
  `mem_id` int(11) DEFAULT NULL,
  `page` varchar(100) DEFAULT NULL,
  `add` int(11) DEFAULT '0',
  `edit` int(11) DEFAULT '0',
  `delete` int(11) DEFAULT '0',
  `chg_pwd` int(11) DEFAULT '0',
  `user_crea` varchar(50) DEFAULT NULL,
  `date_crea` date DEFAULT NULL,
  `user_updt` varchar(50) DEFAULT NULL,
  `date_updt` date DEFAULT NULL,
  PRIMARY KEY (`per_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `tbl_permission` */

LOCK TABLES `tbl_permission` WRITE;

UNLOCK TABLES;

/*Table structure for table `tbl_position` */

DROP TABLE IF EXISTS `tbl_position`;

CREATE TABLE `tbl_position` (
  `pos_id` int(11) NOT NULL AUTO_INCREMENT,
  `pos_code` varchar(20) DEFAULT NULL,
  `pos_name` varchar(100) DEFAULT NULL,
  `pos_name_kh` varchar(100) DEFAULT NULL,
  `pos_desc` varchar(200) DEFAULT NULL,
  `user_crea` varchar(50) DEFAULT NULL,
  `date_crea` date DEFAULT NULL,
  `user_updt` varchar(50) DEFAULT NULL,
  `date_updt` date DEFAULT NULL,
  PRIMARY KEY (`pos_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_position` */

LOCK TABLES `tbl_position` WRITE;

insert  into `tbl_position`(`pos_id`,`pos_code`,`pos_name`,`pos_name_kh`,`pos_desc`,`user_crea`,`date_crea`,`user_updt`,`date_updt`) values (2,'pos001','General Manager',NULL,'','admin','2017-12-21',NULL,NULL),(3,'pos002','Accountant',NULL,'','admin','2017-12-25',NULL,NULL),(4,'pos003','Web Developer',NULL,'','admin','2017-12-25',NULL,NULL),(5,'pos004','Web Designer',NULL,'','admin','2017-12-25',NULL,NULL);

UNLOCK TABLES;

/*Table structure for table `tbl_staf` */

DROP TABLE IF EXISTS `tbl_staf`;

CREATE TABLE `tbl_staf` (
  `st_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pos_id` int(11) DEFAULT NULL,
  `dep_id` int(11) DEFAULT NULL,
  `st_code` char(50) NOT NULL,
  `st_name` varchar(100) DEFAULT NULL,
  `st_status` int(11) NOT NULL,
  `img` varchar(250) DEFAULT NULL,
  `desc` text NOT NULL,
  `user_crea` char(30) NOT NULL,
  `date_crea` date NOT NULL,
  `user_updt` char(30) NOT NULL,
  `date_updt` date NOT NULL,
  `st_hired_date` date DEFAULT NULL,
  `st_validity` date DEFAULT NULL,
  PRIMARY KEY (`st_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_staf` */

LOCK TABLES `tbl_staf` WRITE;

insert  into `tbl_staf`(`st_id`,`pos_id`,`dep_id`,`st_code`,`st_name`,`st_status`,`img`,`desc`,`user_crea`,`date_crea`,`user_updt`,`date_updt`,`st_hired_date`,`st_validity`) values (6,2,1,'ID0001','Chheng Samnang',1,'mypicture.PNG','This is a sample description.','admin','2017-12-22','admin','2017-12-25','2017-12-25','2017-12-26'),(7,3,3,'ID0002','Heng Chanda',1,'mypicture.PNG','This is a sample description.','admin','2017-12-25','admin','2017-12-25','2017-12-25','2017-12-26'),(8,4,4,'ID0003','But Choumeng',1,'mypicture.PNG','This is a sample description.','admin','2017-12-25','admin','2017-12-25','2017-12-25','2017-12-25'),(9,5,5,'ID0004','Bo Sophea',1,'mypicture.PNG','','admin','2017-12-25','admin','2017-12-25','2017-12-25','2017-12-26'),(10,5,1,'ID0005','Nhar Boy',1,'mypicture.PNG','','admin','2017-12-25','','0000-00-00','2017-12-25','2018-01-01'),(11,4,1,'ID0006','Heang Chhiv',1,'mypicture.PNG','','admin','2017-12-25','','0000-00-00','2017-12-25','2017-12-25');

UNLOCK TABLES;

/*Table structure for table `tbl_sysdata` */

DROP TABLE IF EXISTS `tbl_sysdata`;

CREATE TABLE `tbl_sysdata` (
  `key_id` int(11) NOT NULL AUTO_INCREMENT,
  `key_type` varchar(100) DEFAULT NULL,
  `key_code` varchar(100) DEFAULT NULL,
  `key_data` varchar(100) DEFAULT NULL,
  `key_data1` varchar(100) DEFAULT NULL,
  `key_data2` varchar(100) DEFAULT NULL,
  `user_crea` varchar(50) DEFAULT NULL,
  `date_crea` date DEFAULT NULL,
  `user_updt` varchar(50) DEFAULT NULL,
  `date_updt` date DEFAULT NULL,
  PRIMARY KEY (`key_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_sysdata` */

LOCK TABLES `tbl_sysdata` WRITE;

UNLOCK TABLES;

/*Table structure for table `tbl_user` */

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_code` varchar(50) DEFAULT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `user_pass` varchar(100) DEFAULT NULL,
  `user_desc` varchar(250) DEFAULT NULL,
  `user_type` varchar(50) DEFAULT NULL,
  `user_status` int(1) DEFAULT NULL,
  `user_crea` varchar(50) DEFAULT NULL,
  `date_crea` date DEFAULT NULL,
  `user_updt` varchar(50) DEFAULT NULL,
  `date_updt` date DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_user` */

LOCK TABLES `tbl_user` WRITE;

insert  into `tbl_user`(`user_id`,`user_code`,`user_name`,`user_pass`,`user_desc`,`user_type`,`user_status`,`user_crea`,`date_crea`,`user_updt`,`date_updt`) values (3,'admin','administrator','40bd001563085fc35165329ea1ff5c5ecbdbbeef','','admin',1,'N/A','2017-02-10',NULL,NULL);

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
