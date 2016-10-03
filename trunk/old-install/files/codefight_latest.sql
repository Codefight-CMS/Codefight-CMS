-- MySQL dump 10.13  Distrib 5.6.30, for Win32 (AMD64)
--
-- Host: localhost    Database: codefight_live
-- ------------------------------------------------------
-- Server version	5.6.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cf_banner`
--

DROP TABLE IF EXISTS `cf_banner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cf_banner` (
  `banner_id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_title` varchar(64) NOT NULL DEFAULT '',
  `banner_url` varchar(255) NOT NULL DEFAULT '',
  `banner_image` varchar(64) NOT NULL DEFAULT '',
  `banner_group` varchar(255) NOT NULL DEFAULT '',
  `banner_html_text` text,
  `expire_impressions` int(7) DEFAULT '0',
  `expire_clicks` int(7) DEFAULT '0',
  `expire_date` datetime DEFAULT NULL,
  `date_scheduled` datetime DEFAULT NULL,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_status_change` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`banner_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cf_banner`
--

LOCK TABLES `cf_banner` WRITE;
/*!40000 ALTER TABLE `cf_banner` DISABLE KEYS */;
INSERT INTO `cf_banner` VALUES (1,'','','','','',0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,1);
/*!40000 ALTER TABLE `cf_banner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cf_banner_history`
--

DROP TABLE IF EXISTS `cf_banner_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cf_banner_history` (
  `banner_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_id` int(11) NOT NULL DEFAULT '0',
  `banner_shown` int(5) NOT NULL DEFAULT '0',
  `banner_clicked` int(5) NOT NULL DEFAULT '0',
  `banner_history_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`banner_history_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cf_banner_history`
--

LOCK TABLES `cf_banner_history` WRITE;
/*!40000 ALTER TABLE `cf_banner_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `cf_banner_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cf_file`
--

DROP TABLE IF EXISTS `cf_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cf_file` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_title` varchar(255) DEFAULT NULL,
  `file_description` text,
  `folder_id` int(11) NOT NULL DEFAULT '0',
  `file_name` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `file_ext` varchar(255) DEFAULT NULL,
  `file_size` decimal(8,2) DEFAULT '0.00',
  `is_image` int(1) DEFAULT '0',
  `image_width` int(11) DEFAULT '0',
  `image_height` int(11) DEFAULT '0',
  `file_access` varchar(255) DEFAULT NULL,
  `file_access_members` varchar(255) DEFAULT NULL,
  `file_status` int(1) NOT NULL DEFAULT '0',
  `file_publish_date` datetime DEFAULT '0000-00-00 00:00:00',
  `file_expire_date` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`file_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cf_file`
--

LOCK TABLES `cf_file` WRITE;
/*!40000 ALTER TABLE `cf_file` DISABLE KEYS */;
INSERT INTO `cf_file` VALUES (11,'Software Box','Codefight software package box',2,'Codefight-CMS-A-Codeigniter-CMS.jpg','media/gallery/','image/jpeg','.jpg',191.14,1,716,762,'public',NULL,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(10,'Screenshot','This is a screenshot image file.',2,'codefight-1.2_.0_.png','media/gallery/','image/png','.png',13.76,1,720,285,'public',NULL,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(12,'Codefight CMS 2.0 Youtube video','Codefight cms preview',1,'codefight-cms-2-0-preview.png','media/','image/png','.png',59.80,1,500,296,'public',NULL,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(13,'Penguins','Penguins sample image',1,'Penguins.jpg','media/','image/jpeg','.jpg',759.60,1,1024,768,'all',NULL,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(14,'new codefight cms','dsfsdf',1,'codefight.png','media/','image/png','.png',55.59,1,1312,926,'public',NULL,1,'0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `cf_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cf_folder`
--

DROP TABLE IF EXISTS `cf_folder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cf_folder` (
  `folder_id` int(11) NOT NULL AUTO_INCREMENT,
  `folder_parent_id` int(11) NOT NULL DEFAULT '0',
  `folder_path` varchar(255) DEFAULT NULL,
  `folder_name` varchar(255) DEFAULT NULL,
  `folder_status` int(1) DEFAULT '0',
  `folder_thumb` varchar(255) DEFAULT NULL,
  `folder_access` varchar(255) DEFAULT NULL,
  `folder_access_members` varchar(255) DEFAULT NULL,
  `folder_sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`folder_id`),
  KEY `folder_sort` (`folder_sort`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cf_folder`
--

LOCK TABLES `cf_folder` WRITE;
/*!40000 ALTER TABLE `cf_folder` DISABLE KEYS */;
INSERT INTO `cf_folder` VALUES (1,0,'/','Home',1,NULL,'all',NULL,1),(2,1,'/gallery/','gallery',1,'codefight-1.2_.0-2_.png','public',NULL,3),(3,1,'/banners/','banners',1,'','public',NULL,2);
/*!40000 ALTER TABLE `cf_folder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cf_form_data_int`
--

DROP TABLE IF EXISTS `cf_form_data_int`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cf_form_data_int` (
  `form_submitted_id` int(11) NOT NULL,
  `form_item_id` int(11) NOT NULL,
  `form_item_data` int(11) NOT NULL,
  KEY `form_submitted_id` (`form_submitted_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cf_form_data_int`
--

LOCK TABLES `cf_form_data_int` WRITE;
/*!40000 ALTER TABLE `cf_form_data_int` DISABLE KEYS */;
/*!40000 ALTER TABLE `cf_form_data_int` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cf_form_data_text`
--

DROP TABLE IF EXISTS `cf_form_data_text`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cf_form_data_text` (
  `form_submitted_id` int(11) NOT NULL,
  `form_item_id` int(11) NOT NULL,
  `form_item_data` text,
  KEY `form_submitted_id` (`form_submitted_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cf_form_data_text`
--

LOCK TABLES `cf_form_data_text` WRITE;
/*!40000 ALTER TABLE `cf_form_data_text` DISABLE KEYS */;
INSERT INTO `cf_form_data_text` VALUES (8,16,'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\nWhy do we use it?\n\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\n \nWhere does it come from?\n\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\n\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.\nWhere can I get some?\n\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.'),(2,16,'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\nWhy do we use it?\n\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\n \nWhere does it come from?\n\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\n\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.\nWhere can I get some?\n\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.'),(21,16,'Hi,\nThanks for downloading and trying codefight cms.\nHopefully you will like it.\nAny feedback from you will be highly appreciated as it will help to make it more better and better.\nThanks.\n\nRegards,\nDamu');
/*!40000 ALTER TABLE `cf_form_data_text` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cf_form_data_varchar`
--

DROP TABLE IF EXISTS `cf_form_data_varchar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cf_form_data_varchar` (
  `form_submitted_id` int(11) NOT NULL,
  `form_item_id` int(11) NOT NULL,
  `form_item_data` varchar(255) DEFAULT NULL,
  KEY `form_submitted_id` (`form_submitted_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cf_form_data_varchar`
--

LOCK TABLES `cf_form_data_varchar` WRITE;
/*!40000 ALTER TABLE `cf_form_data_varchar` DISABLE KEYS */;
INSERT INTO `cf_form_data_varchar` VALUES (8,14,'dbashyal@xyz.com'),(8,13,'Damodar Bashyal'),(2,13,'Damodar Bashyal'),(2,14,'dbashyal@xyz.com'),(8,18,'hydrogen,oxygen,'),(8,17,'Male'),(21,13,'Damodar Bashyal'),(21,22,'0400000000'),(21,14,'dbashyal@gmail.com'),(21,21,'Admin');
/*!40000 ALTER TABLE `cf_form_data_varchar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cf_form_group`
--

DROP TABLE IF EXISTS `cf_form_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cf_form_group` (
  `form_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `form_group_name` varchar(25) DEFAULT NULL,
  `form_group_identifier` varchar(35) DEFAULT NULL,
  `form_group_send_to` text,
  PRIMARY KEY (`form_group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cf_form_group`
--

LOCK TABLES `cf_form_group` WRITE;
/*!40000 ALTER TABLE `cf_form_group` DISABLE KEYS */;
INSERT INTO `cf_form_group` VALUES (4,'Contact Us','contact_us','noreply@codefightcms.com');
/*!40000 ALTER TABLE `cf_form_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cf_form_item`
--

DROP TABLE IF EXISTS `cf_form_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cf_form_item` (
  `form_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `form_item_name` varchar(50) NOT NULL,
  `form_item_label` varchar(50) NOT NULL,
  `form_item_input_type` varchar(15) NOT NULL,
  `form_item_validations` varchar(200) NOT NULL,
  `form_item_default_value` varchar(200) NOT NULL,
  `form_item_parameters` varchar(200) NOT NULL,
  `form_item_data_type` varchar(7) NOT NULL DEFAULT 'varchar',
  `form_item_grid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`form_item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cf_form_item`
--

LOCK TABLES `cf_form_item` WRITE;
/*!40000 ALTER TABLE `cf_form_item` DISABLE KEYS */;
INSERT INTO `cf_form_item` VALUES (13,'name','Your Name','textbox','trim|xss_clean','','class=\"txtFld\"','varchar',1),(14,'contact_email','Contact Email','textbox','trim|required|valid_email','','class=\"txtFld\"','varchar',1),(15,'submit','Submit','submit','','',' class=\"btn btn-primary\"','varchar',0),(16,'message','Your Message','textarea','trim|required','','class=\"txtFld\"','text',0),(17,'gender','Gender','radio','','m=Male|f=Female','','varchar',1),(18,'newsletters_options[]','Select newsletters you would like to subscribe','checkbox','','1=maths|2=computer|3=science','','varchar',0),(20,'file','file','file','trim|required','','class=&quot;txtFld&quot;','text',0),(21,'receive_by','Who do you want to receive this submission?','select','trim|required','Admin=Admin|Sales=Sales|Support=Support','class=&quot;txtFld&quot;','varchar',0),(22,'contact_number','Contact Number','textbox','trim','','class=\"txtFld\"','varchar',1);
/*!40000 ALTER TABLE `cf_form_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cf_form_item_to_group`
--

DROP TABLE IF EXISTS `cf_form_item_to_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cf_form_item_to_group` (
  `form_group_id` int(11) NOT NULL,
  `form_item_id` int(11) NOT NULL,
  `form_item_sort` int(11) NOT NULL,
  `form_item_grid` int(11) NOT NULL DEFAULT '0',
  KEY `form_groups_id` (`form_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cf_form_item_to_group`
--

LOCK TABLES `cf_form_item_to_group` WRITE;
/*!40000 ALTER TABLE `cf_form_item_to_group` DISABLE KEYS */;
INSERT INTO `cf_form_item_to_group` VALUES (4,14,3,1),(4,13,1,1),(4,15,8,0),(4,16,6,0),(4,21,7,0),(4,22,2,1);
/*!40000 ALTER TABLE `cf_form_item_to_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cf_form_submitted`
--

DROP TABLE IF EXISTS `cf_form_submitted`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cf_form_submitted` (
  `form_submitted_id` int(11) NOT NULL AUTO_INCREMENT,
  `form_group_id` int(11) NOT NULL,
  `form_status` int(11) NOT NULL,
  PRIMARY KEY (`form_submitted_id`),
  KEY `form_groups_id` (`form_group_id`,`form_status`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cf_form_submitted`
--

LOCK TABLES `cf_form_submitted` WRITE;
/*!40000 ALTER TABLE `cf_form_submitted` DISABLE KEYS */;
INSERT INTO `cf_form_submitted` VALUES (8,4,0),(2,4,1),(21,4,0);
/*!40000 ALTER TABLE `cf_form_submitted` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cf_group`
--

DROP TABLE IF EXISTS `cf_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cf_group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_title` varchar(255) NOT NULL,
  `group_description` text NOT NULL,
  `group_sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`group_id`),
  UNIQUE KEY `groups_title` (`group_title`),
  KEY `groups_sort` (`group_sort`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cf_group`
--

LOCK TABLES `cf_group` WRITE;
/*!40000 ALTER TABLE `cf_group` DISABLE KEYS */;
INSERT INTO `cf_group` VALUES (1,'Administrator','Users who have admin access rights go to this group.',1),(2,'Public','General users go to this group.',4),(3,'Registered User','Registered User Group.',3),(4,'Authors','Give access to only certain areas for authors like article/cms sections.',2);
/*!40000 ALTER TABLE `cf_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cf_group_permission`
--

DROP TABLE IF EXISTS `cf_group_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cf_group_permission` (
  `group_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cf_group_permission`
--

LOCK TABLES `cf_group_permission` WRITE;
/*!40000 ALTER TABLE `cf_group_permission` DISABLE KEYS */;
INSERT INTO `cf_group_permission` VALUES (4,1),(4,12),(4,5),(4,25),(4,26),(4,27),(1,0),(1,1),(1,11),(1,12),(1,2),(1,13),(1,14),(1,15),(1,16),(1,17),(1,18),(1,53),(1,3),(1,45),(1,20),(1,21),(1,4),(1,22),(1,23),(1,52),(1,5),(1,25),(1,26),(1,27),(1,6),(1,28),(1,29),(1,7),(1,30),(1,31),(1,32),(1,49),(1,33),(1,34),(1,35),(1,50),(1,51),(1,8),(1,46),(1,47),(1,48),(1,9),(1,36),(1,37),(1,38),(1,39),(1,40),(1,54),(1,10),(1,42),(1,43),(1,44);
/*!40000 ALTER TABLE `cf_group_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cf_installs`
--

DROP TABLE IF EXISTS `cf_installs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cf_installs` (
  `installs_id` int(11) NOT NULL AUTO_INCREMENT,
  `website` varchar(255) DEFAULT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`installs_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cf_installs`
--

LOCK TABLES `cf_installs` WRITE;
/*!40000 ALTER TABLE `cf_installs` DISABLE KEYS */;
INSERT INTO `cf_installs` VALUES (1,'tools/version',1,'2012-03-28 04:59:40');
/*!40000 ALTER TABLE `cf_installs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cf_menu`
--

DROP TABLE IF EXISTS `cf_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cf_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_active` int(1) NOT NULL DEFAULT '0',
  `menu_parent_id` int(11) DEFAULT '0',
  `menu_link` varchar(255) DEFAULT NULL,
  `menu_params` varchar(255) DEFAULT NULL,
  `menu_title` varchar(255) NOT NULL,
  `menu_type` varchar(255) NOT NULL DEFAULT 'pages',
  `menu_meta_title` varchar(70) DEFAULT NULL,
  `menu_meta_keywords` varchar(200) DEFAULT NULL,
  `menu_meta_description` varchar(150) DEFAULT NULL,
  `menu_sort` int(11) NOT NULL DEFAULT '0',
  `websites_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=MyISAM AUTO_INCREMENT=122 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cf_menu`
--

LOCK TABLES `cf_menu` WRITE;
/*!40000 ALTER TABLE `cf_menu` DISABLE KEYS */;
INSERT INTO `cf_menu` VALUES (72,1,0,'codefight-cms-preview-built-with-codeigniter-2.0-framework-demo-code',NULL,'Preview / Demo','page','','','',4,',1,'),(86,1,0,'releases','','Releases','blog','','','',10,',1,3,'),(71,1,0,'privacy-policy',NULL,'Privacy Policy','page','','','',8,',3,4,'),(40,1,0,'http://twitter.com/dbashyal',NULL,'Twitter','favourite-links','','','',1,',1,2,3,'),(41,1,0,'http://www.linkedin.com/in/dbashyal',NULL,'Linked In','favourite-links','','','',2,',1,2,3,'),(75,1,0,'home',NULL,'Home','page','','','',0,',1,2,3,4,'),(88,1,0,'jobs','','JOBS','blog','','','',20,',4,'),(69,1,0,'http://zoosper.com',NULL,'zoosper','sponsored-links','','','',0,',1,2,3,'),(70,1,0,'http://codefight.org/','','Codefight CMS','blog-roll','','','',0,',1,'),(80,1,0,'blog',NULL,'Blog','page','','','',1,',1,2,3,4,'),(81,1,0,'download-latest-codefight-cms','','Downloads','page','','','',2,',1,3,'),(82,1,0,'about-us',NULL,'About Us','page','','','',5,',2,3,4,'),(83,1,0,'contact-us',NULL,'Contact Us','page','','','',6,',1,2,3,4,'),(84,1,0,'http://www.tenthweb.com/forums/viewforum.php?title=codefight.org&f=49','','Forum','page','','','',3,',3,'),(109,1,0,'advertising',NULL,'Advertising','blog','','','',1,',2,'),(85,1,0,'search',NULL,'Search','page','','','',9,',2,3,4,'),(89,1,0,'web-resources','','Web Resources','blog','','','',11,',4,'),(90,1,0,'codeigniter','','Codeigniter','blog','','','',13,',1,'),(91,1,0,'zend','','Zend','blog','','','',12,',4,'),(92,1,0,'magento','','Magento','blog','','','',14,',4,'),(93,1,0,'diary','','Diary','blog','','','',15,',1,4,'),(94,1,0,'nepal','','Nepal','blog','','','',16,',1,'),(95,1,0,'australia','','Australia','blog','','','',17,',4,'),(96,1,0,'guest-articles','','Guest Articles','blog','','','',18,',4,'),(97,1,0,'tips','','Tips','blog','','','',19,',4,'),(98,1,0,'http://learntipsandtricks.com/blog','','Tips & Tricks','blog-roll','','','',1,',1,'),(106,1,0,'http://www.facebook.com/codefight',NULL,'Facebook','favourite-links','','','',0,',1,'),(108,1,0,'codefight-cms','','CodeFight CMS','blog','','','',5,',1,'),(110,1,0,'affiliate-marketing',NULL,'Affiliate Marketing','blog','','','',2,',2,'),(111,1,0,'google-page-rank',NULL,'Google Page Rank','blog','','','',6,',2,'),(112,1,0,'search-engine-optimization',NULL,'Search Engine Optimization','blog','','','',7,',2,'),(114,1,0,'alexa',NULL,'Alexa','blog','','','',3,',2,'),(115,1,0,'social-media',NULL,'Social Media','blog','','','',8,',2,'),(116,1,0,'facebook',NULL,'Facebook','blog','','','',4,',2,'),(117,1,0,'twitter',NULL,'Twitter','blog','','','',9,',2,'),(118,1,0,'adsense',NULL,'Adsense','blog','','','',0,',2,'),(119,1,0,'javascript:void(0)','onclick=\"language_selection();\"','Select Language','page','','','',7,',3,'),(120,1,0,'login|logout','','[Login|Logout]','page','','','',10,',1,'),(121,1,0,'http://goo.gl/kRWrif',' target=\"_blank\"','Can you get all these for $1?','teaser','','','',0,',1,');
/*!40000 ALTER TABLE `cf_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cf_module`
--

DROP TABLE IF EXISTS `cf_module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cf_module` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL DEFAULT '1',
  `url` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `void` int(11) NOT NULL DEFAULT '0',
  `menu` text NOT NULL,
  `child` text NOT NULL,
  `is_menu` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cf_module`
--

LOCK TABLES `cf_module` WRITE;
/*!40000 ALTER TABLE `cf_module` DISABLE KEYS */;
INSERT INTO `cf_module` VALUES (1,'top',1,1,'cp','Admin',1,'a:5:{s:7:\"is_menu\";i:1;s:4:\"void\";i:1;s:3:\"url\";s:2:\"cp\";s:5:\"title\";s:5:\"Admin\";s:5:\"child\";a:2:{s:5:\"cp/cp\";a:4:{s:7:\"is_menu\";i:1;s:4:\"void\";i:0;s:3:\"url\";s:5:\"cp/cp\";s:5:\"title\";s:4:\"Home\";}s:9:\"cp/update\";a:4:{s:7:\"is_menu\";i:1;s:4:\"void\";i:0;s:3:\"url\";s:9:\"cp/update\";s:5:\"title\";s:17:\"Codefight Updates\";}}}','a:2:{i:0;s:5:\"cp/cp\";i:1;s:9:\"cp/update\";}',1),(2,'top',1,4,'menu','Menu',1,'a:5:{s:7:\"is_menu\";i:1;s:4:\"void\";i:1;s:3:\"url\";s:4:\"menu\";s:5:\"title\";s:4:\"Menu\";s:5:\"child\";a:7:{s:9:\"menu/page\";a:4:{s:7:\"is_menu\";i:1;s:4:\"void\";i:0;s:3:\"url\";s:9:\"menu/page\";s:5:\"title\";s:10:\"Page Links\";}s:9:\"menu/blog\";a:4:{s:7:\"is_menu\";i:1;s:4:\"void\";i:0;s:3:\"url\";s:9:\"menu/blog\";s:5:\"title\";s:15:\"Blog Categories\";}s:14:\"menu/blog-roll\";a:4:{s:7:\"is_menu\";i:1;s:4:\"void\";i:0;s:3:\"url\";s:14:\"menu/blog-roll\";s:5:\"title\";s:9:\"Blog Roll\";}s:16:\"menu/classifieds\";a:4:{s:7:\"is_menu\";i:1;s:4:\"void\";i:0;s:3:\"url\";s:16:\"menu/classifieds\";s:5:\"title\";s:21:\"Classified Categories\";}s:20:\"menu/favourite-links\";a:4:{s:7:\"is_menu\";i:1;s:4:\"void\";i:0;s:3:\"url\";s:20:\"menu/favourite-links\";s:5:\"title\";s:15:\"Favourite Links\";}s:20:\"menu/sponsored-links\";a:4:{s:7:\"is_menu\";i:1;s:4:\"void\";i:0;s:3:\"url\";s:20:\"menu/sponsored-links\";s:5:\"title\";s:15:\"Sponsored Links\";}s:11:\"menu/teaser\";a:4:{s:7:\"is_menu\";i:1;s:4:\"void\";i:0;s:3:\"url\";s:11:\"menu/teaser\";s:5:\"title\";s:11:\"Teaser Link\";}}}','a:7:{i:0;s:9:\"menu/page\";i:1;s:9:\"menu/blog\";i:2;s:14:\"menu/blog-roll\";i:3;s:16:\"menu/classifieds\";i:4;s:20:\"menu/favourite-links\";i:5;s:20:\"menu/sponsored-links\";i:6;s:11:\"menu/teaser\";}',1),(3,'top',1,12,'user','User',1,'a:5:{s:7:\"is_menu\";i:1;s:4:\"void\";i:1;s:3:\"url\";s:4:\"user\";s:5:\"title\";s:4:\"User\";s:5:\"child\";a:3:{s:10:\"user/index\";a:4:{s:7:\"is_menu\";i:1;s:4:\"void\";i:0;s:3:\"url\";s:10:\"user/index\";s:5:\"title\";s:5:\"Users\";}s:5:\"group\";a:4:{s:7:\"is_menu\";i:1;s:4:\"void\";i:0;s:3:\"url\";s:5:\"group\";s:5:\"title\";s:6:\"Groups\";}s:17:\"group/permissions\";a:4:{s:7:\"is_menu\";i:1;s:4:\"void\";i:0;s:3:\"url\";s:17:\"group/permissions\";s:5:\"title\";s:17:\"Group Permissions\";}}}','a:3:{i:0;s:10:\"user/index\";i:1;s:5:\"group\";i:2;s:17:\"group/permissions\";}',1),(4,'top',1,16,'form','Form',1,'a:5:{s:7:\"is_menu\";i:1;s:4:\"void\";i:1;s:3:\"url\";s:4:\"form\";s:5:\"title\";s:4:\"Form\";s:5:\"child\";a:3:{s:9:\"form/item\";a:4:{s:7:\"is_menu\";i:1;s:4:\"void\";i:0;s:3:\"url\";s:9:\"form/item\";s:5:\"title\";s:5:\"Items\";}s:10:\"form/group\";a:4:{s:7:\"is_menu\";i:1;s:4:\"void\";i:0;s:3:\"url\";s:10:\"form/group\";s:5:\"title\";s:5:\"Group\";}s:14:\"form/submitted\";a:4:{s:7:\"is_menu\";i:1;s:4:\"void\";i:0;s:3:\"url\";s:14:\"form/submitted\";s:5:\"title\";s:9:\"Submitted\";}}}','a:3:{i:0;s:9:\"form/item\";i:1;s:10:\"form/group\";i:2;s:14:\"form/submitted\";}',1),(5,'top',1,20,'page','CMS',1,'a:5:{s:7:\"is_menu\";i:1;s:4:\"void\";i:1;s:3:\"url\";s:4:\"page\";s:5:\"title\";s:3:\"CMS\";s:5:\"child\";a:3:{s:9:\"page/page\";a:4:{s:7:\"is_menu\";i:1;s:4:\"void\";i:0;s:3:\"url\";s:9:\"page/page\";s:5:\"title\";s:11:\"Static Page\";}s:9:\"page/blog\";a:4:{s:7:\"is_menu\";i:1;s:4:\"void\";i:0;s:3:\"url\";s:9:\"page/blog\";s:5:\"title\";s:12:\"Blog Article\";}s:10:\"page/block\";a:4:{s:7:\"is_menu\";i:0;s:4:\"void\";i:1;s:3:\"url\";s:10:\"page/block\";s:5:\"title\";s:13:\"Static Blocks\";}}}','a:3:{i:0;s:9:\"page/page\";i:1;s:9:\"page/blog\";i:2;s:10:\"page/block\";}',1),(6,'top',1,24,'comment','Comments',1,'a:5:{s:7:\"is_menu\";i:1;s:4:\"void\";i:1;s:3:\"url\";s:7:\"comment\";s:5:\"title\";s:8:\"Comments\";s:5:\"child\";a:2:{s:23:\"comment/pending-comment\";a:4:{s:7:\"is_menu\";i:1;s:4:\"void\";i:0;s:3:\"url\";s:23:\"comment/pending-comment\";s:5:\"title\";s:16:\"Pending Comments\";}s:24:\"comment/approved-comment\";a:4:{s:7:\"is_menu\";i:1;s:4:\"void\";i:0;s:3:\"url\";s:24:\"comment/approved-comment\";s:5:\"title\";s:17:\"Approved Comments\";}}}','a:2:{i:0;s:23:\"comment/pending-comment\";i:1;s:24:\"comment/approved-comment\";}',1),(7,'top',1,27,'media','Media',1,'a:5:{s:7:\"is_menu\";i:1;s:4:\"void\";i:1;s:3:\"url\";s:5:\"media\";s:5:\"title\";s:5:\"Media\";s:5:\"child\";a:2:{s:4:\"file\";a:5:{s:7:\"is_menu\";i:1;s:4:\"void\";i:1;s:3:\"url\";s:4:\"file\";s:5:\"title\";s:12:\"File Manager\";s:5:\"child\";a:3:{s:16:\"file/manage-file\";a:4:{s:7:\"is_menu\";i:1;s:4:\"void\";i:0;s:3:\"url\";s:16:\"file/manage-file\";s:5:\"title\";s:12:\"Manage Files\";}s:16:\"file/upload-file\";a:4:{s:7:\"is_menu\";i:1;s:4:\"void\";i:0;s:3:\"url\";s:16:\"file/upload-file\";s:5:\"title\";s:11:\"Upload File\";}s:16:\"file/file-status\";a:4:{s:7:\"is_menu\";i:0;s:4:\"void\";i:0;s:3:\"url\";s:16:\"file/file-status\";s:5:\"title\";s:18:\"Change File Status\";}}}s:6:\"folder\";a:5:{s:7:\"is_menu\";i:1;s:4:\"void\";i:1;s:3:\"url\";s:6:\"folder\";s:5:\"title\";s:14:\"Folder Manager\";s:5:\"child\";a:4:{s:20:\"folder/manage-folder\";a:4:{s:7:\"is_menu\";i:1;s:4:\"void\";i:0;s:3:\"url\";s:20:\"folder/manage-folder\";s:5:\"title\";s:14:\"Manage Folders\";}s:20:\"folder/create-folder\";a:4:{s:7:\"is_menu\";i:1;s:4:\"void\";i:0;s:3:\"url\";s:20:\"folder/create-folder\";s:5:\"title\";s:13:\"Create Folder\";}s:20:\"folder/folder-status\";a:4:{s:7:\"is_menu\";i:0;s:4:\"void\";i:0;s:3:\"url\";s:20:\"folder/folder-status\";s:5:\"title\";s:20:\"Change folder Status\";}s:18:\"folder/search-file\";a:4:{s:7:\"is_menu\";i:0;s:4:\"void\";i:0;s:3:\"url\";s:18:\"folder/search-file\";s:5:\"title\";s:25:\"Search Files under folder\";}}}}}','a:2:{i:0;s:4:\"file\";i:1;s:6:\"folder\";}',1),(8,'top',1,37,'banner','Banner',1,'a:5:{s:7:\"is_menu\";i:0;s:4:\"void\";i:1;s:3:\"url\";s:6:\"banner\";s:5:\"title\";s:6:\"Banner\";s:5:\"child\";a:3:{s:13:\"banner/manage\";a:4:{s:7:\"is_menu\";i:1;s:4:\"void\";i:0;s:3:\"url\";s:13:\"banner/manage\";s:5:\"title\";s:6:\"Manage\";}s:13:\"banner/create\";a:4:{s:7:\"is_menu\";i:1;s:4:\"void\";i:0;s:3:\"url\";s:13:\"banner/create\";s:5:\"title\";s:17:\"Create New Banner\";}s:13:\"banner/status\";a:4:{s:7:\"is_menu\";i:0;s:4:\"void\";i:0;s:3:\"url\";s:13:\"banner/status\";s:5:\"title\";s:20:\"Change Banner Status\";}}}','a:3:{i:0;s:13:\"banner/manage\";i:1;s:13:\"banner/create\";i:2;s:13:\"banner/status\";}',0),(9,'top',1,41,'tools','Tools',1,'a:5:{s:7:\"is_menu\";i:1;s:4:\"void\";i:1;s:3:\"url\";s:5:\"tools\";s:5:\"title\";s:5:\"Tools\";s:5:\"child\";a:4:{s:13:\"modulecreator\";a:5:{s:7:\"is_menu\";i:1;s:4:\"void\";i:1;s:3:\"url\";s:13:\"modulecreator\";s:5:\"title\";s:6:\"Module\";s:5:\"child\";a:2:{s:20:\"modulecreator/create\";a:4:{s:7:\"is_menu\";i:1;s:4:\"void\";i:0;s:3:\"url\";s:20:\"modulecreator/create\";s:5:\"title\";s:6:\"Create\";}s:15:\"moduleinstaller\";a:4:{s:7:\"is_menu\";i:1;s:4:\"void\";i:0;s:3:\"url\";s:15:\"moduleinstaller\";s:5:\"title\";s:7:\"Install\";}}}s:13:\"setting/cache\";a:4:{s:7:\"is_menu\";i:1;s:4:\"void\";i:0;s:3:\"url\";s:13:\"setting/cache\";s:5:\"title\";s:11:\"Clear Cache\";}s:15:\"setting/sitemap\";a:4:{s:7:\"is_menu\";i:1;s:4:\"void\";i:0;s:3:\"url\";s:15:\"setting/sitemap\";s:5:\"title\";s:16:\"Generate Sitemap\";}s:9:\"trim/trim\";a:4:{s:7:\"is_menu\";i:1;s:4:\"void\";i:0;s:3:\"url\";s:9:\"trim/trim\";s:5:\"title\";s:11:\"Shorten URL\";}}}','a:4:{i:0;s:13:\"modulecreator\";i:1;s:13:\"setting/cache\";i:2;s:15:\"setting/sitemap\";i:3;s:9:\"trim/trim\";}',1),(10,'top',1,48,'setting','Settings',1,'a:5:{s:7:\"is_menu\";i:1;s:4:\"void\";i:1;s:3:\"url\";s:7:\"setting\";s:5:\"title\";s:8:\"Settings\";s:5:\"child\";a:3:{s:12:\"setting/site\";a:4:{s:7:\"is_menu\";i:1;s:4:\"void\";i:0;s:3:\"url\";s:12:\"setting/site\";s:5:\"title\";s:8:\"Defaults\";}s:16:\"setting/websites\";a:4:{s:7:\"is_menu\";i:1;s:4:\"void\";i:0;s:3:\"url\";s:16:\"setting/websites\";s:5:\"title\";s:8:\"Websites\";}s:12:\"setting/keys\";a:4:{s:7:\"is_menu\";i:1;s:4:\"void\";i:0;s:3:\"url\";s:12:\"setting/keys\";s:5:\"title\";s:4:\"Keys\";}}}','a:3:{i:0;s:12:\"setting/site\";i:1;s:16:\"setting/websites\";i:2;s:12:\"setting/keys\";}',1),(11,'cp',1,2,'cp/cp','Home',0,'','',1),(12,'cp',1,3,'cp/update','Codefight Updates',0,'','',1),(13,'menu',1,5,'menu/page','Page Links',0,'','',1),(14,'menu',1,6,'menu/blog','Blog Categories',0,'','',1),(15,'menu',1,7,'menu/blog-roll','Blog Roll',0,'','',1),(16,'menu',1,8,'menu/classifieds','Classified Categories',0,'','',1),(17,'menu',1,9,'menu/favourite-links','Favourite Links',0,'','',1),(18,'menu',1,10,'menu/sponsored-links','Sponsored Links',0,'','',1),(19,'user',1,12,'user/user','Users',0,'','',1),(20,'user',1,14,'group','Groups',0,'','',1),(21,'user',1,15,'group/permissions','Group Permissions',0,'','',1),(22,'form',1,17,'form/item','Items',0,'','',1),(23,'form',1,18,'form/group','Group',0,'','',1),(24,'form',1,18,'menu/submitted','Submitted',0,'','',1),(25,'page',1,21,'page/page','Static Page',0,'','',1),(26,'page',1,22,'page/blog','Blog Article',0,'','',1),(27,'page',1,23,'page/block','Static Blocks',1,'','',0),(28,'comment',1,25,'comment/pending-comment','Pending Comments',0,'','',1),(29,'comment',1,26,'comment/approved-comment','Approved Comments',0,'','',1),(30,'media',1,28,'file','File Manager',1,'','a:3:{i:0;s:16:\"file/manage-file\";i:1;s:16:\"file/upload-file\";i:2;s:16:\"file/file-status\";}',1),(31,'file',1,29,'file/manage-file','Manage Files',0,'','',1),(32,'file',1,30,'file/upload-file','Upload File',0,'','',1),(33,'media',1,32,'folder','Folder Manager',1,'','a:4:{i:0;s:20:\"folder/manage-folder\";i:1;s:20:\"folder/create-folder\";i:2;s:20:\"folder/folder-status\";i:3;s:18:\"folder/search-file\";}',1),(34,'folder',1,33,'folder/manage-folder','Manage Folders',0,'','',1),(35,'folder',1,34,'folder/create-folder','Create Folder',0,'','',1),(36,'tools',1,42,'modulecreator','Module',1,'','a:2:{i:0;s:20:\"modulecreator/create\";i:1;s:15:\"moduleinstaller\";}',1),(37,'modulecreator',1,43,'modulecreator/create','Create',0,'','',1),(38,'modulecreator',1,44,'moduleinstaller','Install',0,'','',1),(39,'tools',1,45,'setting/cache','Clear Cache',0,'','',1),(40,'tools',1,46,'setting/sitemap','Generate Sitemap',0,'','',1),(41,'tools',1,46,'trim','Shorten URL',0,'','',1),(42,'setting',1,49,'setting/site','Defaults',0,'','',1),(43,'setting',1,50,'setting/websites','Websites',0,'','',1),(44,'setting',1,51,'setting/keys','Keys',0,'','',1),(45,'user',1,13,'user/index','Users',0,'','',1),(46,'banner',1,38,'banner/manage','Manage',0,'','',1),(47,'banner',1,39,'banner/create','Create New Banner',0,'','',1),(48,'banner',1,40,'banner/status','Change Banner Status',0,'','',0),(49,'file',1,31,'file/file-status','Change File Status',0,'','',0),(50,'folder',1,35,'folder/folder-status','Change folder Status',0,'','',0),(51,'folder',1,36,'folder/search-file','Search Files under folder',0,'','',0),(52,'form',1,19,'form/submitted','Submitted',0,'','',1),(53,'menu',1,11,'menu/teaser','Teaser Link',0,'','',1),(54,'tools',1,47,'trim/trim','Shorten URL',0,'','',1);
/*!40000 ALTER TABLE `cf_module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cf_page`
--

DROP TABLE IF EXISTS `cf_page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cf_page` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_active` int(1) NOT NULL DEFAULT '0',
  `page_code` varchar(255) DEFAULT NULL,
  `page_title` varchar(255) DEFAULT NULL,
  `page_blurb` text,
  `page_blurb_length` int(4) NOT NULL DEFAULT '0',
  `page_body` text,
  `page_image` varchar(255) DEFAULT NULL,
  `menu_id` varchar(255) NOT NULL DEFAULT '0',
  `websites_id` varchar(255) NOT NULL DEFAULT '0',
  `page_author` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `show_author` int(1) NOT NULL DEFAULT '0',
  `page_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `page_date_modified` datetime DEFAULT NULL,
  `show_date` int(1) NOT NULL DEFAULT '0',
  `page_tag` varchar(255) DEFAULT NULL,
  `allow_comment` int(1) NOT NULL DEFAULT '0',
  `page_type` varchar(255) NOT NULL DEFAULT 'pages',
  `page_view` int(11) DEFAULT '0',
  `page_meta_title` varchar(255) DEFAULT NULL,
  `page_meta_keywords` varchar(255) DEFAULT NULL,
  `page_meta_description` varchar(255) DEFAULT NULL,
  `page_sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`page_id`),
  KEY `page_code` (`page_code`),
  KEY `menu_id` (`menu_id`),
  KEY `websites_id` (`websites_id`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cf_page`
--

LOCK TABLES `cf_page` WRITE;
/*!40000 ALTER TABLE `cf_page` DISABLE KEYS */;
INSERT INTO `cf_page` VALUES (19,1,NULL,'How much it costs to call directly to heaven from Nepal?','<p>An American   decided to write a book about famous churches around the World. So he bought   a plane ticket and took a trip to China   . On his first day he was inside a church taking photographs when   he Noticed a golden telephone mounted on the wall with a sign that   read \"$10,000 per call\". The American, being intrigued, asked a priest who   was strolling by what?The telephone was used for. The priest replied   that it was a direct line to heaven and that for $10,000 you could talk to   God.</p>\r\n<p>The American thanked the priest and went along his way.?</p>\r\n<p>Next   stop was in Japan .   There, at a very large cathedral, he saw the Same golden telephone with the same   sign under it.</p>\r\n<p>',0,'<p>An American   decided to write a book about famous churches around the World. So he bought   a plane ticket and took a trip to China   . On his first day he was inside a church taking photographs when   he Noticed a golden telephone mounted on the wall with a sign that   read \"$10,000 per call\". The American, being intrigued, asked a priest who   was strolling by what?The telephone was used for. The priest replied   that it was a direct line to heaven and that for $10,000 you could talk to   God.</p>\r\n<p>The American thanked the priest and went along his way.?</p>\r\n<p>Next   stop was in Japan .   There, at a very large cathedral, he saw the Same golden telephone with the same   sign under it.</p>\r\n<p><!-- pagebreak --></p>\r\n<p>He wondered if this was the same kind of telephone he saw   in China   and He asked a nearby nun what its purpose was.</p>\r\n<p>She told him that it was   a direct line to heaven and that for $10,000 He Could talk to   God.?</p>\r\n<p>\"O.K., thank you,\" said the American.?He then traveled to   Pakistan ,   Srilanka ,   Russia ,   Germany   and France.</p>\r\n<p>In every church he saw the same golden telephone with the same   \"$10,000 Per call\" sign under it.?The American, upon leaving   Vermont   decided to travel to up to?Nepal   to See if?Nepalese had the same phone.</p>\r\n<p>He?arrived in?Nepal ,   and again, in the first church he entered, there Was the same golden   telephone, but this s time the sign under it read \"One Rupee per   call.\"</p>\r\n<p>The American was surprised so he asked the priest about the   sign. \"Father, I\'ve traveled all over World and I\'ve seen this same   golden Telephone in many churches. I\'m told that it is a direct line   to?Heaven, But in rest of the world price was $10,000 per call.</p>\r\n<p>Why   is it so cheap here?\"</p>\r\n<p>Readers, it is your turn........ Think ....before   you scroll down...</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>.....................</p>\r\n<p>The priest smiled and answered, \"You\'re   in?Nepal   now, Son -?it\'s a Local Call?\". This is the only heaven on the   Earth.?</p>\r\n<p>KEEP SMILING</p>\r\n<p>If you are proud to be ?Nepalese, pass this   on!!!</p>',NULL,',93,94,',',1,2,4,','Got this in email as forward from Aneeta Gurung',11,1,'2009-04-12 09:16:58',NULL,1,'Nepal,Nepali,test',1,'blog',935,'How much it costs to call directly to heaven from Nepal?','Nepal,Nepali,Proud to be nepalese,email forward','',0),(37,1,NULL,'Kushal\'s First Youtube Video','<p>{{banner 2}}</p>\r\n<p>Hey! Its me Kushal Bashyal. I am 5months and 3weeks old today. I am very happy today and trying to jump. Wanna watch me jump.</p>\r\n<p>{{parse-video [<br />src=\"https://www.youtube.com/watch?v=eJA-LeXnqgc\"<br />id=\"kushal-jumping\"<br />]}}</p>\r\n<p>So, what you think? My grand mom is trying to hold me but she is very tired but i am enjoying a lot and jumping and jumping and making everyone happy. Hope you like it.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Bonus Video: My little brother laughing</strong></p>\r\n<p>{{parse-video [<br />key1=\"value 1\"<br />key2=\"value 2\"<br />]}}</p>\r\n<p>&nbsp;</p>\r\n<p>{{banner 2}}</p>\r\n<div style=\"margin: 0pt auto; width: 480px; height: 385px; display: block;\">&nbsp;</div>\r\n<p>&nbsp;</p>\r\n<p>{{banner 2}}</p>',0,'<p>{{banner 2}}</p>\r\n<p>Hey! Its me Kushal Bashyal. I am 5months and 3weeks old today. I am very happy today and trying to jump. Wanna watch me jump.</p>\r\n<p>{{parse-video [<br />src=\"https://www.youtube.com/watch?v=eJA-LeXnqgc\"<br />id=\"kushal-jumping\"<br />]}}</p>\r\n<p>So, what you think? My grand mom is trying to hold me but she is very tired but i am enjoying a lot and jumping and jumping and making everyone happy. Hope you like it.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Bonus Video: My little brother laughing</strong></p>\r\n<p>{{parse-video [<br />key1=\"value 1\"<br />key2=\"value 2\"<br />]}}</p>\r\n<p>&nbsp;</p>\r\n<p>{{banner 2}}</p>\r\n<div style=\"margin: 0pt auto; width: 480px; height: 385px; display: block;\">&nbsp;</div>\r\n<p>&nbsp;</p>\r\n<p>{{banner 2}}</p>',NULL,',93,',',1,2,4,','Damodar Bashyal',11,1,'2009-06-05 19:45:32',NULL,1,'Kushal Bashyal,test',1,'blog',1091,'Cute Little Happy Baby Jumping - codefight.org','Kushal Bashyal, Baby, Baby Jumping,Happy Baby','This is kushal 5months, happy and jumping with the help of grandmom',0),(54,1,NULL,'Canonical Page For All Pages That Have No Content','<p>Blank.</p>\r\n<p>This is parked page for seo stuff. Inplace of meta nofollow probably i\'ll use this page as canonical page.</p>',0,'<p>Blank.</p>\r\n<p>This is parked page for seo stuff. Inplace of meta nofollow probably i\'ll use this page as canonical page.</p>',NULL,',0,',',0,','Damodar Bashyal',0,1,'2010-04-16 12:32:00',NULL,1,'',1,'page',2684,'Replacement page for meta noindex, nofollow | codefight .org','meta,noindex,nofollow,search,engine,page,rank','Remove your less value pages from search index to give more priority to main pages.',0),(67,1,NULL,'Contact Us','<p>Please fill the form below to contact us.</p>\r\n<p>{{form contact_us}}</p>',0,'<p>Please fill the form below to contact us.</p>\r\n<p>{{form contact_us}}</p>',NULL,',83,',',1,2,3,','',0,0,'2010-10-31 13:00:00',NULL,0,'',0,'page',4,'Contact Us','contact us,codefight cms,text link ads review,zoosper','Contact us for any enquiry regarding our websites.',0),(68,1,NULL,'Privacy Policy','<p>We don\'t sell your details. We don\'t use your data to spam or for any other reason.</p>',0,'<p>We don\'t sell your details. We don\'t use your data to spam or for any other reason.</p>',NULL,',71,',',2,3,','',0,0,'2010-01-19 13:00:00',NULL,0,'',0,'page',0,'Privacy Policy - codefight.org','privacy, policy, codefight, cms, open, source, content, management, system','we don\'t sell your details. Codefight is a free content management system.',0),(69,1,NULL,'Google made it easy to search our sites.','<p>Please enter the word you are looking for</p>\r\n<div class=\"google_custom_search_engine\">\r\n<div id=\"cse\" style=\"width: 100%;\">Loading</div>\r\n</div>',0,'<p>Please enter the word you are looking for</p>\r\n<div class=\"google_custom_search_engine\">\r\n<div id=\"cse\" style=\"width: 100%;\">Loading</div>\r\n</div>',NULL,',85,',',1,2,3,','',0,0,'2010-11-14 13:00:00',NULL,0,'',0,'page',9,'Google made it easy to search our sites - codefight.org','google,search,made,easy,with,site search,codefight,tenthweb','Please enter the word you are looking for in our sites codefight and tenthweb.',0),(70,1,NULL,'Codefight CMS','<h1>{{parse-tag url=\'http://codefight.org/\' rel=\'external,nofollow\' title=\'Codefight CMS\'}} - A light weight Codeigniter php framework cms.</h1>\r\n<div style=\"display: block; float: right; margin: 0 0 15px;\"><a title=\"Codefight - simple php cms using codeigniter\" href=\"http://cmsigniter.com/download-codefight-cms\" target=\"_blank\" rel=\"nofollow external\"><img src=\"http://skin.zoosper.com/media/upload/Codefight-CMS-Sfotware-md.png\" alt=\"Download Latest SEO Friendly Codefight BLOG CMS\" border=\"0\" /></a></div>\r\n<p>Codefight CMS is based on CodeIgniter - Open source PHP web application framework, which is very easy to learn.</p>\r\n<p>The latest version will have a multiple website manager. The new version is almost ready and is in staging for testing purpose before its official release.</p>\r\n<p>If you would like to get informed about the latest releases and news please do subscribe to our feed.</p>\r\n<p>Since Codefight CMS is available for use free of charge, I would appreciate and welcome any feedback, contributions to the code and help translating language files into your language.&nbsp;&nbsp;&nbsp;</p>\r\n<p>You can use this CMS in any way you want: You can modify it as you like and use commercially for free.</p>\r\n<p>I hope one day it will be one of the top {{parse-tag title=\'Codeigniter CMS\'}}</p>\r\n<p>&nbsp;</p>\r\n<p><a class=\"download-button\" title=\"Download Codefight CMS\" href=\"http://codefight.org/download-latest-codefight-cms/\"><span title=\"download codefight cms 2.0\"><span title=\"Download multiple website cms manager 2.0\">Download</span></span></a></p>\r\n<p>&nbsp;</p>\r\n<p><a title=\"Watch video on codefight cms\" href=\"http://www.youtube.com/watch?v=Z0cBtJvFov4&amp;feature=youtu.be&amp;ref=codefight.org\" target=\"_blank\"><img title=\"codefight CMS preview video on youtube.\" src=\"http://skin.zoosper.com/media/codefight-cms-2-0-preview.png\" alt=\"Codefight CMS 2.0 preview\" /></a></p>\r\n<h6>Codefight CMS 2.0, a multiple website management software, based on codeigniter 2.0 php framework.</h6>',0,'<h1>{{parse-tag url=\'http://codefight.org/\' rel=\'external,nofollow\' title=\'Codefight CMS\'}} - A light weight Codeigniter php framework cms.</h1>\r\n<div style=\"display: block; float: right; margin: 0 0 15px;\"><a title=\"Codefight - simple php cms using codeigniter\" href=\"http://cmsigniter.com/download-codefight-cms\" target=\"_blank\" rel=\"nofollow external\"><img src=\"http://skin.zoosper.com/media/upload/Codefight-CMS-Sfotware-md.png\" alt=\"Download Latest SEO Friendly Codefight BLOG CMS\" border=\"0\" /></a></div>\r\n<p>Codefight CMS is based on CodeIgniter - Open source PHP web application framework, which is very easy to learn.</p>\r\n<p>The latest version will have a multiple website manager. The new version is almost ready and is in staging for testing purpose before its official release.</p>\r\n<p>If you would like to get informed about the latest releases and news please do subscribe to our feed.</p>\r\n<p>Since Codefight CMS is available for use free of charge, I would appreciate and welcome any feedback, contributions to the code and help translating language files into your language.&nbsp;&nbsp;&nbsp;</p>\r\n<p>You can use this CMS in any way you want: You can modify it as you like and use commercially for free.</p>\r\n<p>I hope one day it will be one of the top {{parse-tag title=\'Codeigniter CMS\'}}</p>\r\n<p>&nbsp;</p>\r\n<p><a class=\"download-button\" title=\"Download Codefight CMS\" href=\"http://codefight.org/download-latest-codefight-cms/\"><span title=\"download codefight cms 2.0\"><span title=\"Download multiple website cms manager 2.0\">Download</span></span></a></p>\r\n<p>&nbsp;</p>\r\n<p><a title=\"Watch video on codefight cms\" href=\"http://www.youtube.com/watch?v=Z0cBtJvFov4&amp;feature=youtu.be&amp;ref=codefight.org\" target=\"_blank\"><img title=\"codefight CMS preview video on youtube.\" src=\"http://skin.zoosper.com/media/codefight-cms-2-0-preview.png\" alt=\"Codefight CMS 2.0 preview\" /></a></p>\r\n<h6>Codefight CMS 2.0, a multiple website management software, based on codeigniter 2.0 php framework.</h6>',NULL,',75,',',1,','',0,0,'2010-12-19 13:00:00',NULL,0,'',0,'page',4,'Codefight CMS - Codeigniter Multiple Website Manager','Codeigniter,cms,codefight,website,manager,php,multiple,website','Codefight CMS is based on CodeIgniter - Open source PHP web application framework, which is very easy to learn.',0),(71,1,NULL,'Codefight PHP Content Management System (CMS)','<p>&nbsp;</p>\r\n<h1>Codefight PHP Content Management System (CMS)</h1>\r\n<div class=\"banner\"><span class=\"download_link\"><a href=\"http://code.google.com/p/cmsdamu/downloads/list\">Download Pre-release Code</a> </span><a title=\"Make money online from sponsored tweets. Its that easy to make money online working from home.\" href=\"http://bit.ly/3qzpDq\" target=\"_blank\">Today\'s Preview Brought To You By Sponsored Tweets.</a></div>\r\n<p>This is only screenshot Preview of Codefight Content Management System (CMS) which is built with the help of <a title=\"CodeIgniter - Open source PHP web application framework\" href=\"http://codeigniter.com\">codeigniter</a> php framework</p>\r\n<p>This is still under development. So far the below items from screen shot are completed. If you want to give suggestions and feedbacks, you can do so at our forum <a title=\"Tenthweb is a place to express your opinions and ask questions on our very own forum.\" href=\"http://tenthweb.com/forums/viewforum.php?f=49\">tenthweb.com</a></p>\r\n<p>For backend demo visit:<a title=\"content management system built with php framework codeigniter - demo (codefight)\" href=\"http://codefight.org/demo/admin.html\" target=\"_blank\">http://codefight.org/demo/admin.html</a> <br /> For frontend demo visit: <a href=\"http://codefight.org/demo/home.html\" target=\"_blank\">http://codefight.org/demo/home.html</a> <br /> To download code visit: <a href=\"http://code.google.com/p/cmsdamu/downloads/list\" target=\"_blank\">http://code.google.com/p/cmsdamu/downloads/list</a> <br /> <br /> [please leave a comment in our forum.]</p>\r\n<p class=\"notice\"><strong>Update: 13.03.2009</strong><br /> Codefight homepage is now powered by codefight cms</p>\r\n<p><em><strong>This screenshot is outdated. Demo is newer than screenshot. Download can be newer than demo.</strong></em></p>\r\n<table style=\"width: 780px;\" border=\"0\" cellspacing=\"10\" cellpadding=\"4\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td align=\"left\" valign=\"top\" width=\"260\"><a title=\"Login Form\" href=\"../../media/upload/screenshots/login.jpg\" rel=\"lightbox[codefight]\"><img src=\"../../media/upload/screenshots/login_thumb.jpg\" alt=\"login thumb\" width=\"250\" height=\"108\" /></a></td>\r\n<td align=\"left\" valign=\"top\" width=\"260\"><a title=\"Welcome Page After Login\" href=\"../../media/upload/screenshots/welcome.jpg\" rel=\"lightbox[codefight]\"><img src=\"../../media/upload/screenshots/welcome_thumb.jpg\" alt=\"welcome thumb\" width=\"250\" height=\"88\" /></a></td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\" valign=\"top\" width=\"260\"><a title=\"Groups View Page\" href=\"../../media/upload/screenshots/groups_view.jpg\" rel=\"lightbox[codefight]\"><img src=\"../../media/upload/screenshots/groups_view_thumb.jpg\" alt=\"groups view thumb\" width=\"250\" height=\"155\" /></a></td>\r\n<td align=\"left\" valign=\"top\"><a title=\"Groups Edit Page\" href=\"../../media/upload/screenshots/group_edit.jpg\" rel=\"lightbox[codefight]\"><img src=\"../../media/upload/screenshots/group_edit_thumb.jpg\" alt=\"group edit thumb\" width=\"250\" height=\"175\" /></a></td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\" valign=\"top\"><a title=\"Groups Create\" href=\"../../media/upload/screenshots/group_create.jpg\" rel=\"lightbox[codefight]\"><img src=\"../../media/upload/screenshots/group_create_thumb.jpg\" alt=\"group create thumb\" width=\"250\" height=\"107\" /></a></td>\r\n<td align=\"left\" valign=\"top\"><a title=\"Users View Page\" href=\"../../media/upload/screenshots/users.jpg\" rel=\"lightbox[codefight]\"><img src=\"../../media/upload/screenshots/users_thumb.jpg\" alt=\"users thumb\" width=\"250\" height=\"74\" /></a></td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\" valign=\"top\"><a title=\"Users Edit Page\" href=\"../../media/upload/screenshots/users_edit.jpg\" rel=\"lightbox[codefight]\"><img src=\"../../media/upload/screenshots/users_edit_thumb.jpg\" alt=\"users edit thumb\" width=\"250\" height=\"163\" /></a></td>\r\n<td align=\"left\" valign=\"top\"><a title=\"Menu View Page\" href=\"../../media/upload/screenshots/menus.jpg\" rel=\"lightbox[codefight]\"><img src=\"../../media/upload/screenshots/menus_thumb.jpg\" alt=\"menus thumb\" width=\"250\" height=\"191\" /></a></td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\" valign=\"top\"><a title=\"Menu Edit Page\" href=\"../../media/upload/screenshots/menus_edit.jpg\" rel=\"lightbox[codefight]\"><img src=\"../../media/upload/screenshots/menus_edit_thumb.jpg\" alt=\"menus edit thumb\" width=\"250\" height=\"180\" /></a></td>\r\n<td align=\"left\" valign=\"top\"><a title=\"Pages View Page\" href=\"../../media/upload/screenshots/pages.jpg\" rel=\"lightbox[codefight]\"><img src=\"../../media/upload/screenshots/pages_thumb.jpg\" alt=\"pages thumb\" width=\"250\" height=\"158\" /></a></td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\" valign=\"top\"><a title=\"Pages Edit Page\" href=\"../../media/upload/screenshots/pages_edit.jpg\" rel=\"lightbox[codefight]\"><img src=\"../../media/upload/screenshots/pages_edit_thumb.jpg\" alt=\"pages edit thumb\" width=\"250\" height=\"204\" /></a></td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>',0,'<p>&nbsp;</p>\r\n<h1>Codefight PHP Content Management System (CMS)</h1>\r\n<div class=\"banner\"><span class=\"download_link\"><a href=\"http://code.google.com/p/cmsdamu/downloads/list\">Download Pre-release Code</a> </span><a title=\"Make money online from sponsored tweets. Its that easy to make money online working from home.\" href=\"http://bit.ly/3qzpDq\" target=\"_blank\">Today\'s Preview Brought To You By Sponsored Tweets.</a></div>\r\n<p>This is only screenshot Preview of Codefight Content Management System (CMS) which is built with the help of <a title=\"CodeIgniter - Open source PHP web application framework\" href=\"http://codeigniter.com\">codeigniter</a> php framework</p>\r\n<p>This is still under development. So far the below items from screen shot are completed. If you want to give suggestions and feedbacks, you can do so at our forum <a title=\"Tenthweb is a place to express your opinions and ask questions on our very own forum.\" href=\"http://tenthweb.com/forums/viewforum.php?f=49\">tenthweb.com</a></p>\r\n<p>For backend demo visit:<a title=\"content management system built with php framework codeigniter - demo (codefight)\" href=\"http://codefight.org/demo/admin.html\" target=\"_blank\">http://codefight.org/demo/admin.html</a> <br /> For frontend demo visit: <a href=\"http://codefight.org/demo/home.html\" target=\"_blank\">http://codefight.org/demo/home.html</a> <br /> To download code visit: <a href=\"http://code.google.com/p/cmsdamu/downloads/list\" target=\"_blank\">http://code.google.com/p/cmsdamu/downloads/list</a> <br /> <br /> [please leave a comment in our forum.]</p>\r\n<p class=\"notice\"><strong>Update: 13.03.2009</strong><br /> Codefight homepage is now powered by codefight cms</p>\r\n<p><em><strong>This screenshot is outdated. Demo is newer than screenshot. Download can be newer than demo.</strong></em></p>\r\n<table style=\"width: 780px;\" border=\"0\" cellspacing=\"10\" cellpadding=\"4\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td align=\"left\" valign=\"top\" width=\"260\"><a title=\"Login Form\" href=\"../../media/upload/screenshots/login.jpg\" rel=\"lightbox[codefight]\"><img src=\"../../media/upload/screenshots/login_thumb.jpg\" alt=\"login thumb\" width=\"250\" height=\"108\" /></a></td>\r\n<td align=\"left\" valign=\"top\" width=\"260\"><a title=\"Welcome Page After Login\" href=\"../../media/upload/screenshots/welcome.jpg\" rel=\"lightbox[codefight]\"><img src=\"../../media/upload/screenshots/welcome_thumb.jpg\" alt=\"welcome thumb\" width=\"250\" height=\"88\" /></a></td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\" valign=\"top\" width=\"260\"><a title=\"Groups View Page\" href=\"../../media/upload/screenshots/groups_view.jpg\" rel=\"lightbox[codefight]\"><img src=\"../../media/upload/screenshots/groups_view_thumb.jpg\" alt=\"groups view thumb\" width=\"250\" height=\"155\" /></a></td>\r\n<td align=\"left\" valign=\"top\"><a title=\"Groups Edit Page\" href=\"../../media/upload/screenshots/group_edit.jpg\" rel=\"lightbox[codefight]\"><img src=\"../../media/upload/screenshots/group_edit_thumb.jpg\" alt=\"group edit thumb\" width=\"250\" height=\"175\" /></a></td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\" valign=\"top\"><a title=\"Groups Create\" href=\"../../media/upload/screenshots/group_create.jpg\" rel=\"lightbox[codefight]\"><img src=\"../../media/upload/screenshots/group_create_thumb.jpg\" alt=\"group create thumb\" width=\"250\" height=\"107\" /></a></td>\r\n<td align=\"left\" valign=\"top\"><a title=\"Users View Page\" href=\"../../media/upload/screenshots/users.jpg\" rel=\"lightbox[codefight]\"><img src=\"../../media/upload/screenshots/users_thumb.jpg\" alt=\"users thumb\" width=\"250\" height=\"74\" /></a></td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\" valign=\"top\"><a title=\"Users Edit Page\" href=\"../../media/upload/screenshots/users_edit.jpg\" rel=\"lightbox[codefight]\"><img src=\"../../media/upload/screenshots/users_edit_thumb.jpg\" alt=\"users edit thumb\" width=\"250\" height=\"163\" /></a></td>\r\n<td align=\"left\" valign=\"top\"><a title=\"Menu View Page\" href=\"../../media/upload/screenshots/menus.jpg\" rel=\"lightbox[codefight]\"><img src=\"../../media/upload/screenshots/menus_thumb.jpg\" alt=\"menus thumb\" width=\"250\" height=\"191\" /></a></td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\" valign=\"top\"><a title=\"Menu Edit Page\" href=\"../../media/upload/screenshots/menus_edit.jpg\" rel=\"lightbox[codefight]\"><img src=\"../../media/upload/screenshots/menus_edit_thumb.jpg\" alt=\"menus edit thumb\" width=\"250\" height=\"180\" /></a></td>\r\n<td align=\"left\" valign=\"top\"><a title=\"Pages View Page\" href=\"../../media/upload/screenshots/pages.jpg\" rel=\"lightbox[codefight]\"><img src=\"../../media/upload/screenshots/pages_thumb.jpg\" alt=\"pages thumb\" width=\"250\" height=\"158\" /></a></td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\" valign=\"top\"><a title=\"Pages Edit Page\" href=\"../../media/upload/screenshots/pages_edit.jpg\" rel=\"lightbox[codefight]\"><img src=\"../../media/upload/screenshots/pages_edit_thumb.jpg\" alt=\"pages edit thumb\" width=\"250\" height=\"204\" /></a></td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>',NULL,',72,',',1,','',0,0,'2010-12-31 13:00:00',NULL,0,'',0,'page',104,'Codefight PHP Content Management System &#40;CMS&#41; Preview','codefight,cms,demo,preview,codeigniter,2.0,multiple,website,manager','This is only screenshot Preview of Codefight Content Management System &#40;CMS&#41; which is built with the help of codeigniter php framework',0),(72,1,NULL,'About Us','<p>We are a collection of professionals focused on the benefits of text link ads.&nbsp; Our goal is to build a long-standing, comprehensive review website of internet marketers and affiliate marketers. Differing from most websites, we aim to develop relationships, observe the internet atmosphere, and report our observations and experiences to you, the consumer.&nbsp; We want you to benefit from our observations, reports, and informational blogs for years to come, so we will work hard to cement our professional review site in the industry.</p>\r\n<p>Yes, we love to hear constructive feedbacks from our visitors, guests and members.</p>\r\n<p>Yes, we read every comment.&nbsp; We enjoy reading and manually approving each comment -- you are heard and don\'t go unnoticed.</p>\r\n<p>We will try to scrub all the details before publishing, and we would love to hear if we miss any spots.</p>\r\n<p>Thank you for your assistance and continued membership.</p>\r\n<p>Kind regards,</p>\r\n<p>zoosper.com</p>',0,'<p>We are a collection of professionals focused on the benefits of text link ads.&nbsp; Our goal is to build a long-standing, comprehensive review website of internet marketers and affiliate marketers. Differing from most websites, we aim to develop relationships, observe the internet atmosphere, and report our observations and experiences to you, the consumer.&nbsp; We want you to benefit from our observations, reports, and informational blogs for years to come, so we will work hard to cement our professional review site in the industry.</p>\r\n<p>Yes, we love to hear constructive feedbacks from our visitors, guests and members.</p>\r\n<p>Yes, we read every comment.&nbsp; We enjoy reading and manually approving each comment -- you are heard and don\'t go unnoticed.</p>\r\n<p>We will try to scrub all the details before publishing, and we would love to hear if we miss any spots.</p>\r\n<p>Thank you for your assistance and continued membership.</p>\r\n<p>Kind regards,</p>\r\n<p>zoosper.com</p>',NULL,',82,',',1,2,','',0,0,'2010-01-19 13:00:00',NULL,0,'',0,'page',1,'About Us - Text Link Ads Review','about us, text link ads review,about text link ads review, about TLAr','Our goal is to build a long-standing, comprehensive review website of internet marketers and affiliate marketers.',0),(100,1,NULL,'My Experience with CodeIgniter','<p style=\"text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; color: #000000; font-family: Arial,Helvetica,sans; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque justo sem, elementum a ullamcorper auctor, aliquam non ligula. Cras adipiscing hendrerit quam, vel volutpat nisi luctus eu. Praesent congue magna non urna egestas aliquet. In hac habitasse platea dictumst. Donec risus nisi, fermentum vel aliquet ac, vulputate sed purus. Fusce ornare fringilla ipsum vel porta. Proin sed nibh dolor, vitae ullamcorper lorem.</p>\r\n<p style=\"text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; color: #000000; font-family: Arial,Helvetica,sans; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px;\">',0,'<p style=\"text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; color: #000000; font-family: Arial,Helvetica,sans; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque justo sem, elementum a ullamcorper auctor, aliquam non ligula. Cras adipiscing hendrerit quam, vel volutpat nisi luctus eu. Praesent congue magna non urna egestas aliquet. In hac habitasse platea dictumst. Donec risus nisi, fermentum vel aliquet ac, vulputate sed purus. Fusce ornare fringilla ipsum vel porta. Proin sed nibh dolor, vitae ullamcorper lorem.</p>\r\n<p style=\"text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; color: #000000; font-family: Arial,Helvetica,sans; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px;\"><!-- pagebreak --></p>\r\n<p style=\"text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; color: #000000; font-family: Arial,Helvetica,sans; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px;\">In vehicula arcu eu nibh tincidunt pharetra. Vestibulum non laoreet turpis. Vestibulum egestas, nibh quis tempor cursus, risus quam ornare nulla, quis ultricies augue dolor eget sapien. Sed quis leo nisi, sed porttitor ante. Quisque eget nisl quam, in rutrum quam. Quisque ullamcorper porttitor nibh sit amet imperdiet. In vehicula vulputate sem, vitae tempor nulla auctor tristique. Cras eget varius odio. Cras vel dolor arcu, at malesuada justo. Donec cursus mi a enim mattis et convallis risus malesuada. Mauris elementum nunc in nisi egestas nec dapibus urna condimentum. In odio metus, rutrum pulvinar sagittis at, euismod nec dolor. Maecenas quis nulla id ipsum sagittis aliquam. Etiam aliquet augue a eros eleifend vitae auctor nulla rutrum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>\r\n<p style=\"text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; color: #000000; font-family: Arial,Helvetica,sans; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px;\">Aenean at risus in sem consectetur aliquet sed eu mi. Morbi dignissim malesuada purus vitae condimentum. Suspendisse sit amet urna urna. Fusce vitae tortor nisl, nec cursus diam. Nam cursus consequat ipsum ac volutpat. In eu eleifend ipsum. Maecenas venenatis augue vitae eros viverra ultricies. Donec sit amet consectetur libero. Vivamus aliquam sollicitudin eros in sodales. Cras dapibus, neque eget accumsan molestie, purus dui tincidunt ligula, id ultrices massa lacus mollis eros. Vivamus velit massa, accumsan ut imperdiet sed, egestas eu mi. Nam ut ligula tempus neque pharetra feugiat. Curabitur varius imperdiet lectus non suscipit. Aliquam erat volutpat. Morbi laoreet libero ut sapien convallis faucibus placerat velit egestas. Fusce non lorem lacus, non consectetur tellus.</p>\r\n<p style=\"text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; color: #000000; font-family: Arial,Helvetica,sans; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px;\">Sed lacus ligula, commodo at molestie in, pharetra in risus. Etiam tristique dapibus ipsum, eu dignissim nisl rutrum in. Nulla facilisi. Duis sed purus eu nulla eleifend aliquet. Fusce vulputate, nunc ac egestas convallis, est quam lacinia eros, sit amet tincidunt odio ante a lectus. Donec molestie condimentum sapien non pulvinar. Mauris mi lacus, tristique vel vestibulum pretium, pulvinar nec est. Ut lacinia nisl at dolor consequat vitae semper sapien vulputate. Maecenas mattis, ipsum tincidunt pellentesque lobortis, elit augue suscipit tortor, et faucibus urna lacus eget risus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vivamus volutpat lacinia felis, dictum adipiscing lorem cursus et. Donec gravida aliquet velit, vel ultrices quam hendrerit nec. Morbi non nibh neque, id faucibus quam. Suspendisse eget erat orci.</p>\r\n<p style=\"text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; color: #000000; font-family: Arial,Helvetica,sans; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px;\">Proin gravida purus id lacus adipiscing pretium. Proin volutpat, augue ut molestie adipiscing, urna mauris porttitor felis, a ultricies elit tellus id turpis. Cras a placerat lectus. Curabitur mattis venenatis arcu eu facilisis. Nulla at justo et mi ultrices lacinia. In eu lacus vitae purus iaculis mollis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nunc tincidunt dui in felis pharetra cursus nec posuere mi. Maecenas at viverra urna. Etiam ullamcorper luctus eros, at dignissim tellus malesuada vel. Duis sit amet mauris nisi.</p>',NULL,',86,93,96,',',1,','Seth Bryant',11,1,'2011-04-14 15:41:40',NULL,1,'codeigniter,test',1,'blog',859,'My Experience with CodeIgniter','codeigniter,codefight','With CodeIgniter, you can easily organize the different sections of the PHP application including configuration files, controllers, models, scripts and views.',0),(102,1,NULL,'Advertising in Applications','<p style=\"text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; color: #000000; font-family: Arial,Helvetica,sans; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque justo sem, elementum a ullamcorper auctor, aliquam non ligula. Cras adipiscing hendrerit quam, vel volutpat nisi luctus eu. Praesent congue magna non urna egestas aliquet. In hac habitasse platea dictumst. Donec risus nisi, fermentum vel aliquet ac, vulputate sed purus. Fusce ornare fringilla ipsum vel porta. Proin sed nibh dolor, vitae ullamcorper lorem.</p>\r\n<p style=\"text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; color: #000000; font-family: Arial,Helvetica,sans; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px;\">',0,'<p style=\"text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; color: #000000; font-family: Arial,Helvetica,sans; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque justo sem, elementum a ullamcorper auctor, aliquam non ligula. Cras adipiscing hendrerit quam, vel volutpat nisi luctus eu. Praesent congue magna non urna egestas aliquet. In hac habitasse platea dictumst. Donec risus nisi, fermentum vel aliquet ac, vulputate sed purus. Fusce ornare fringilla ipsum vel porta. Proin sed nibh dolor, vitae ullamcorper lorem.</p>\r\n<p style=\"text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; color: #000000; font-family: Arial,Helvetica,sans; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px;\"><!-- pagebreak --></p>\r\n<p style=\"text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; color: #000000; font-family: Arial,Helvetica,sans; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px;\">In vehicula arcu eu nibh tincidunt pharetra. Vestibulum non laoreet turpis. Vestibulum egestas, nibh quis tempor cursus, risus quam ornare nulla, quis ultricies augue dolor eget sapien. Sed quis leo nisi, sed porttitor ante. Quisque eget nisl quam, in rutrum quam. Quisque ullamcorper porttitor nibh sit amet imperdiet. In vehicula vulputate sem, vitae tempor nulla auctor tristique. Cras eget varius odio. Cras vel dolor arcu, at malesuada justo. Donec cursus mi a enim mattis et convallis risus malesuada. Mauris elementum nunc in nisi egestas nec dapibus urna condimentum. In odio metus, rutrum pulvinar sagittis at, euismod nec dolor. Maecenas quis nulla id ipsum sagittis aliquam. Etiam aliquet augue a eros eleifend vitae auctor nulla rutrum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>\r\n<p style=\"text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; color: #000000; font-family: Arial,Helvetica,sans; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px;\">Aenean at risus in sem consectetur aliquet sed eu mi. Morbi dignissim malesuada purus vitae condimentum. Suspendisse sit amet urna urna. Fusce vitae tortor nisl, nec cursus diam. Nam cursus consequat ipsum ac volutpat. In eu eleifend ipsum. Maecenas venenatis augue vitae eros viverra ultricies. Donec sit amet consectetur libero. Vivamus aliquam sollicitudin eros in sodales. Cras dapibus, neque eget accumsan molestie, purus dui tincidunt ligula, id ultrices massa lacus mollis eros. Vivamus velit massa, accumsan ut imperdiet sed, egestas eu mi. Nam ut ligula tempus neque pharetra feugiat. Curabitur varius imperdiet lectus non suscipit. Aliquam erat volutpat. Morbi laoreet libero ut sapien convallis faucibus placerat velit egestas. Fusce non lorem lacus, non consectetur tellus.</p>\r\n<p style=\"text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; color: #000000; font-family: Arial,Helvetica,sans; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px;\">Sed lacus ligula, commodo at molestie in, pharetra in risus. Etiam tristique dapibus ipsum, eu dignissim nisl rutrum in. Nulla facilisi. Duis sed purus eu nulla eleifend aliquet. Fusce vulputate, nunc ac egestas convallis, est quam lacinia eros, sit amet tincidunt odio ante a lectus. Donec molestie condimentum sapien non pulvinar. Mauris mi lacus, tristique vel vestibulum pretium, pulvinar nec est. Ut lacinia nisl at dolor consequat vitae semper sapien vulputate. Maecenas mattis, ipsum tincidunt pellentesque lobortis, elit augue suscipit tortor, et faucibus urna lacus eget risus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vivamus volutpat lacinia felis, dictum adipiscing lorem cursus et. Donec gravida aliquet velit, vel ultrices quam hendrerit nec. Morbi non nibh neque, id faucibus quam. Suspendisse eget erat orci.</p>\r\n<p style=\"text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; color: #000000; font-family: Arial,Helvetica,sans; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px;\">Proin gravida purus id lacus adipiscing pretium. Proin volutpat, augue ut molestie adipiscing, urna mauris porttitor felis, a ultricies elit tellus id turpis. Cras a placerat lectus. Curabitur mattis venenatis arcu eu facilisis. Nulla at justo et mi ultrices lacinia. In eu lacus vitae purus iaculis mollis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nunc tincidunt dui in felis pharetra cursus nec posuere mi. Maecenas at viverra urna. Etiam ullamcorper luctus eros, at dignissim tellus malesuada vel. Duis sit amet mauris nisi.</p>',NULL,',109,93,',',1,2,','',11,1,'2011-04-30 09:52:22',NULL,1,'advertising,test',1,'blog',359,'Advertising in Applications - TLAr','advertising,angry birds,application,advertiser,advertise,traditional advertising','One example of this is in ',0),(103,1,NULL,'Download Latest Codefight CMS','<p><a title=\"Download Codefight CMS\" href=\"http://codefight.org/\" target=\"_blank\"><img title=\"Codefight CMS\" src=\"http://skin.zoosper.com//media/codefight-cms-2-0-preview.png\" alt=\"Download Codefight CMS\" width=\"500\" height=\"296\" /></a></p>',0,'<p><a title=\"Download Codefight CMS\" href=\"http://codefight.org/\" target=\"_blank\"><img title=\"Codefight CMS\" src=\"http://skin.zoosper.com//media/codefight-cms-2-0-preview.png\" alt=\"Download Codefight CMS\" width=\"500\" height=\"296\" /></a></p>',NULL,',81,',',1,','',0,0,'2011-12-27 12:10:28',NULL,0,'',0,'page',0,'Download Latest Codeigniter cms - Codefight CMS','codefight,codeigniter,cms,download,free,multi-site manager,wysiwyg cms,simple and easy cms','Download open source softwares',0);
/*!40000 ALTER TABLE `cf_page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cf_page_access`
--

DROP TABLE IF EXISTS `cf_page_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cf_page_access` (
  `page_id` int(11) NOT NULL,
  `group_id` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`page_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cf_page_access`
--

LOCK TABLES `cf_page_access` WRITE;
/*!40000 ALTER TABLE `cf_page_access` DISABLE KEYS */;
INSERT INTO `cf_page_access` VALUES (2,'1_3_2'),(4,'1_3_2'),(5,'1_3_2'),(7,'1_3_2'),(8,'1_3_2'),(9,'1_3_2'),(10,'1_3_2'),(11,'1_3_2'),(12,'1_3_2'),(13,'1_3_2'),(14,'1_3_2'),(15,'1_3_2'),(16,'1_3_2'),(17,'1_3_2'),(18,'1_3_2'),(19,'1_3_2'),(20,'1_3_2'),(21,'1_3_2'),(22,'1_3_2'),(23,'1_3_2'),(24,'1_3_2'),(25,'1_3_2'),(26,'1_3_2'),(27,'1_3_2'),(29,'1_3_2'),(30,'1_3_2'),(31,'1_3_2'),(32,'1_3_2'),(33,'1_3_2'),(36,'1_3_2'),(37,'1_3_2'),(38,'1_3_2'),(39,'1_3_2'),(40,'1_3_2'),(41,'1_3_2'),(42,'1_3_2'),(43,'1_3_2'),(44,'1_3_2'),(47,'1_3_2'),(48,'1_3_2'),(49,'1_3_2'),(50,'1_3_2'),(51,'1_3_2'),(52,'1_3_2'),(53,'1_3_2'),(54,'1_2'),(55,'1_3_2'),(56,'1_3_2'),(57,'1_3_2'),(58,'1_3_2'),(59,'1_3_2'),(60,'1_3_2'),(61,'1_2'),(62,'1_3_2'),(63,'1_3_2'),(64,'1_3_2'),(65,'1_3_2'),(66,'1_3_2'),(67,'1_3_2'),(68,'1_3_2'),(69,'1_3_2'),(70,'1_3_2'),(71,'1_3_2'),(72,'1_3_2'),(73,'1_3_2'),(74,'1_3_2'),(75,'1_3_2'),(76,'1_3_2'),(77,'1_3_2'),(78,'1_3_2'),(79,'1_3_2'),(80,'1_3_2'),(81,'1_3_2'),(82,'1_3_2'),(83,'1_3_2'),(84,'1_3_2'),(85,'1_3_2'),(86,'1_3_2'),(87,'1_3_2'),(88,'1_2'),(89,'1_2'),(90,'1_2'),(91,'1_2'),(92,'1_2'),(93,'1_2'),(94,'1_2'),(95,'1_2'),(96,'1_2'),(97,'1_2'),(98,'1_2'),(99,'1_2'),(100,'1_2'),(101,'1_2'),(102,'1_2'),(103,'1_2');
/*!40000 ALTER TABLE `cf_page_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cf_page_comment`
--

DROP TABLE IF EXISTS `cf_page_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cf_page_comment` (
  `page_comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `url` varchar(255) NOT NULL,
  `page_id` int(11) NOT NULL,
  `page_url` varchar(300) DEFAULT NULL,
  `page_comment_status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`page_comment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=131 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cf_page_comment`
--

LOCK TABLES `cf_page_comment` WRITE;
/*!40000 ALTER TABLE `cf_page_comment` DISABLE KEYS */;
INSERT INTO `cf_page_comment` VALUES (5,'pending comment','pending@comment.com','This is pending comment example. Written for feed, incase there are not any.','2009-03-13 16:48:52','http://www.codefight.org/',7,NULL,0),(4,'Test Test','dbashyal@gmail.com','Test only 1st ever comment','2009-03-12 19:33:30','http://www.codefight.org/',7,NULL,1);
/*!40000 ALTER TABLE `cf_page_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cf_page_tag`
--

DROP TABLE IF EXISTS `cf_page_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cf_page_tag` (
  `page_id` int(11) NOT NULL,
  `tag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cf_page_tag`
--

LOCK TABLES `cf_page_tag` WRITE;
/*!40000 ALTER TABLE `cf_page_tag` DISABLE KEYS */;
INSERT INTO `cf_page_tag` VALUES (19,'Nepal'),(19,'Nepali'),(19,'test'),(102,'advertising'),(102,'test'),(100,'codeigniter'),(100,'test'),(103,''),(72,''),(71,''),(70,''),(69,''),(68,''),(67,''),(54,''),(37,'Kushal-Bashyal'),(37,'test');
/*!40000 ALTER TABLE `cf_page_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cf_sessions`
--

DROP TABLE IF EXISTS `cf_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cf_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cf_sessions`
--

LOCK TABLES `cf_sessions` WRITE;
/*!40000 ALTER TABLE `cf_sessions` DISABLE KEYS */;
INSERT INTO `cf_sessions` VALUES ('f945daf78d581652bbfa34b40b7383edc9b7010e','127.0.0.1',1468202761,'__ci_last_regenerate|i:1468202713;template|a:1:{i:1;s:5:\"white\";}backUrl|s:41:\"blog/diary/37/Kushals-First-Youtube-Video\";isLogin|i:1;'),('7fc832d291906637d148ae54f0c6bb3fe8681f00','127.0.0.1',1468203100,'__ci_last_regenerate|i:1468203082;template|a:1:{i:1;s:5:\"white\";}backUrl|s:13:\"tools/captcha\";isLogin|i:1;'),('f577ecc46e9749a4fefec1f45b43741b994c5fd1','127.0.0.1',1468204142,'__ci_last_regenerate|i:1468203932;template|a:1:{i:1;s:5:\"white\";}backUrl|s:13:\"tools/captcha\";isLogin|i:1;captcha|i:12;'),('fd18a143e1c491fa068323df9be4bbe635d38d19','127.0.0.1',1468204450,'__ci_last_regenerate|i:1468204449;template|a:1:{i:1;s:5:\"white\";}backUrl|s:13:\"tools/captcha\";isLogin|i:1;captcha|i:11;'),('027d6d35a68a15fe85a36528efedde8747cdf840','127.0.0.1',1468205028,'__ci_last_regenerate|i:1468205000;template|a:1:{i:1;s:5:\"white\";}backUrl|s:5:\"admin\";captcha|i:11;logged_in|s:1:\"1\";loggedData|a:16:{s:7:\"user_id\";s:2:\"11\";s:6:\"active\";s:1:\"1\";s:5:\"email\";s:13:\"test@test.com\";s:8:\"username\";N;s:8:\"password\";s:32:\"098f6bcd4621d373cade4e832627b4f6\";s:9:\"firstname\";s:7:\"Damodar\";s:8:\"lastname\";s:7:\"Bashyal\";s:8:\"group_id\";s:1:\"1\";s:8:\"is_admin\";s:1:\"1\";s:9:\"is_author\";s:1:\"1\";s:12:\"profile_link\";s:45:\"https://plus.google.com/103583381097797606705\";s:7:\"profile\";s:86:\"<p>Damodar is a open source web developer who likes to provide web tools for FREE.</p>\";s:11:\"photo_small\";N;s:11:\"photo_large\";N;s:5:\"intro\";N;s:11:\"group_title\";s:13:\"Administrator\";}redirect|s:1:\"1\";'),('2b4f938694a0eb7ad6a71d6f86e44aa1a0107d31','127.0.0.1',1470727043,'__ci_last_regenerate|i:1470726777;template|a:1:{i:1;s:10:\"responsive\";}backUrl|s:10:\"contact-us\";logged_in|s:1:\"1\";loggedData|a:16:{s:7:\"user_id\";s:2:\"11\";s:6:\"active\";s:1:\"1\";s:5:\"email\";s:13:\"test@test.com\";s:8:\"username\";N;s:8:\"password\";s:32:\"098f6bcd4621d373cade4e832627b4f6\";s:9:\"firstname\";s:7:\"Damodar\";s:8:\"lastname\";s:7:\"Bashyal\";s:8:\"group_id\";s:1:\"1\";s:8:\"is_admin\";s:1:\"1\";s:9:\"is_author\";s:1:\"1\";s:12:\"profile_link\";s:45:\"https://plus.google.com/103583381097797606705\";s:7:\"profile\";s:86:\"<p>Damodar is a open source web developer who likes to provide web tools for FREE.</p>\";s:11:\"photo_small\";N;s:11:\"photo_large\";N;s:5:\"intro\";N;s:11:\"group_title\";s:13:\"Administrator\";}redirect|s:1:\"1\";websites_id|s:1:\"1\";'),('095d24474f36d3c18cb7bc0c5e91c8483b33c54e','127.0.0.1',1470727160,'__ci_last_regenerate|i:1470727096;template|a:1:{i:1;s:10:\"responsive\";}backUrl|s:10:\"contact-us\";logged_in|s:1:\"1\";loggedData|a:16:{s:7:\"user_id\";s:2:\"11\";s:6:\"active\";s:1:\"1\";s:5:\"email\";s:13:\"test@test.com\";s:8:\"username\";N;s:8:\"password\";s:32:\"098f6bcd4621d373cade4e832627b4f6\";s:9:\"firstname\";s:7:\"Damodar\";s:8:\"lastname\";s:7:\"Bashyal\";s:8:\"group_id\";s:1:\"1\";s:8:\"is_admin\";s:1:\"1\";s:9:\"is_author\";s:1:\"1\";s:12:\"profile_link\";s:45:\"https://plus.google.com/103583381097797606705\";s:7:\"profile\";s:86:\"<p>Damodar is a open source web developer who likes to provide web tools for FREE.</p>\";s:11:\"photo_small\";N;s:11:\"photo_large\";N;s:5:\"intro\";N;s:11:\"group_title\";s:13:\"Administrator\";}redirect|s:1:\"1\";websites_id|s:1:\"1\";captcha|i:14;'),('2401e7dcf45a3c812a690e27d6254d6c8b1c3193','127.0.0.1',1470728205,'__ci_last_regenerate|i:1470728070;template|a:1:{i:1;s:10:\"responsive\";}backUrl|s:22:\"admin/setting/websites\";logged_in|s:1:\"1\";loggedData|a:16:{s:7:\"user_id\";s:2:\"11\";s:6:\"active\";s:1:\"1\";s:5:\"email\";s:13:\"test@test.com\";s:8:\"username\";N;s:8:\"password\";s:32:\"098f6bcd4621d373cade4e832627b4f6\";s:9:\"firstname\";s:7:\"Damodar\";s:8:\"lastname\";s:7:\"Bashyal\";s:8:\"group_id\";s:1:\"1\";s:8:\"is_admin\";s:1:\"1\";s:9:\"is_author\";s:1:\"1\";s:12:\"profile_link\";s:45:\"https://plus.google.com/103583381097797606705\";s:7:\"profile\";s:86:\"<p>Damodar is a open source web developer who likes to provide web tools for FREE.</p>\";s:11:\"photo_small\";N;s:11:\"photo_large\";N;s:5:\"intro\";N;s:11:\"group_title\";s:13:\"Administrator\";}redirect|s:1:\"1\";websites_id|s:1:\"1\";captcha|i:14;'),('b512d1d935680857b3c1c72af40ceb4e4228928f','127.0.0.1',1470728662,'__ci_last_regenerate|i:1470728375;template|a:1:{i:1;s:10:\"responsive\";}backUrl|s:22:\"admin/setting/websites\";logged_in|s:1:\"1\";loggedData|a:16:{s:7:\"user_id\";s:2:\"11\";s:6:\"active\";s:1:\"1\";s:5:\"email\";s:13:\"test@test.com\";s:8:\"username\";N;s:8:\"password\";s:32:\"098f6bcd4621d373cade4e832627b4f6\";s:9:\"firstname\";s:7:\"Damodar\";s:8:\"lastname\";s:7:\"Bashyal\";s:8:\"group_id\";s:1:\"1\";s:8:\"is_admin\";s:1:\"1\";s:9:\"is_author\";s:1:\"1\";s:12:\"profile_link\";s:45:\"https://plus.google.com/103583381097797606705\";s:7:\"profile\";s:86:\"<p>Damodar is a open source web developer who likes to provide web tools for FREE.</p>\";s:11:\"photo_small\";N;s:11:\"photo_large\";N;s:5:\"intro\";N;s:11:\"group_title\";s:13:\"Administrator\";}redirect|s:1:\"1\";websites_id|s:1:\"1\";captcha|i:14;'),('23624eba27df89d023f8aedf49b678c4a75a0833','127.0.0.1',1470728980,'__ci_last_regenerate|i:1470728856;template|a:1:{i:1;s:10:\"responsive\";}backUrl|s:22:\"admin/setting/websites\";logged_in|s:1:\"1\";loggedData|a:16:{s:7:\"user_id\";s:2:\"11\";s:6:\"active\";s:1:\"1\";s:5:\"email\";s:13:\"test@test.com\";s:8:\"username\";N;s:8:\"password\";s:32:\"098f6bcd4621d373cade4e832627b4f6\";s:9:\"firstname\";s:7:\"Damodar\";s:8:\"lastname\";s:7:\"Bashyal\";s:8:\"group_id\";s:1:\"1\";s:8:\"is_admin\";s:1:\"1\";s:9:\"is_author\";s:1:\"1\";s:12:\"profile_link\";s:45:\"https://plus.google.com/103583381097797606705\";s:7:\"profile\";s:86:\"<p>Damodar is a open source web developer who likes to provide web tools for FREE.</p>\";s:11:\"photo_small\";N;s:11:\"photo_large\";N;s:5:\"intro\";N;s:11:\"group_title\";s:13:\"Administrator\";}redirect|s:1:\"1\";websites_id|s:1:\"1\";captcha|i:14;'),('f9e458d5efae0a0f99b7c482252465869fa9c9d9','127.0.0.1',1472626043,'__ci_last_regenerate|i:1472625875;backUrl|s:15:\"admin/page/blog\";template|a:1:{i:1;s:10:\"responsive\";}logged_in|s:1:\"1\";loggedData|a:16:{s:7:\"user_id\";s:2:\"11\";s:6:\"active\";s:1:\"1\";s:5:\"email\";s:13:\"test@test.com\";s:8:\"username\";N;s:8:\"password\";s:32:\"098f6bcd4621d373cade4e832627b4f6\";s:9:\"firstname\";s:7:\"Damodar\";s:8:\"lastname\";s:7:\"Bashyal\";s:8:\"group_id\";s:1:\"1\";s:8:\"is_admin\";s:1:\"1\";s:9:\"is_author\";s:1:\"1\";s:12:\"profile_link\";s:45:\"https://plus.google.com/103583381097797606705\";s:7:\"profile\";s:86:\"<p>Damodar is a open source web developer who likes to provide web tools for FREE.</p>\";s:11:\"photo_small\";N;s:11:\"photo_large\";N;s:5:\"intro\";N;s:11:\"group_title\";s:13:\"Administrator\";}redirect|s:1:\"1\";'),('a56c8b39316e9816f7462e0118fed169a8f5bb61','127.0.0.1',1472626506,'__ci_last_regenerate|i:1472626280;backUrl|s:15:\"admin/page/blog\";template|a:1:{i:1;s:10:\"responsive\";}logged_in|s:1:\"1\";loggedData|a:16:{s:7:\"user_id\";s:2:\"11\";s:6:\"active\";s:1:\"1\";s:5:\"email\";s:13:\"test@test.com\";s:8:\"username\";N;s:8:\"password\";s:32:\"098f6bcd4621d373cade4e832627b4f6\";s:9:\"firstname\";s:7:\"Damodar\";s:8:\"lastname\";s:7:\"Bashyal\";s:8:\"group_id\";s:1:\"1\";s:8:\"is_admin\";s:1:\"1\";s:9:\"is_author\";s:1:\"1\";s:12:\"profile_link\";s:45:\"https://plus.google.com/103583381097797606705\";s:7:\"profile\";s:86:\"<p>Damodar is a open source web developer who likes to provide web tools for FREE.</p>\";s:11:\"photo_small\";N;s:11:\"photo_large\";N;s:5:\"intro\";N;s:11:\"group_title\";s:13:\"Administrator\";}redirect|s:1:\"1\";'),('19c2a196d4ad64e7d3f8d4f0953b1b27ce6ab5d1','127.0.0.1',1472627232,'__ci_last_regenerate|i:1472626938;backUrl|s:15:\"admin/page/blog\";template|a:1:{i:1;s:10:\"responsive\";}logged_in|s:1:\"1\";loggedData|a:16:{s:7:\"user_id\";s:2:\"11\";s:6:\"active\";s:1:\"1\";s:5:\"email\";s:13:\"test@test.com\";s:8:\"username\";N;s:8:\"password\";s:32:\"098f6bcd4621d373cade4e832627b4f6\";s:9:\"firstname\";s:7:\"Damodar\";s:8:\"lastname\";s:7:\"Bashyal\";s:8:\"group_id\";s:1:\"1\";s:8:\"is_admin\";s:1:\"1\";s:9:\"is_author\";s:1:\"1\";s:12:\"profile_link\";s:45:\"https://plus.google.com/103583381097797606705\";s:7:\"profile\";s:86:\"<p>Damodar is a open source web developer who likes to provide web tools for FREE.</p>\";s:11:\"photo_small\";N;s:11:\"photo_large\";N;s:5:\"intro\";N;s:11:\"group_title\";s:13:\"Administrator\";}redirect|s:1:\"1\";'),('2d8c884d43d15722ec704eb60bf8ed6cc5b4dcaa','127.0.0.1',1472627507,'__ci_last_regenerate|i:1472627315;backUrl|s:15:\"admin/page/blog\";template|a:1:{i:1;s:10:\"responsive\";}logged_in|s:1:\"1\";loggedData|a:16:{s:7:\"user_id\";s:2:\"11\";s:6:\"active\";s:1:\"1\";s:5:\"email\";s:13:\"test@test.com\";s:8:\"username\";N;s:8:\"password\";s:32:\"098f6bcd4621d373cade4e832627b4f6\";s:9:\"firstname\";s:7:\"Damodar\";s:8:\"lastname\";s:7:\"Bashyal\";s:8:\"group_id\";s:1:\"1\";s:8:\"is_admin\";s:1:\"1\";s:9:\"is_author\";s:1:\"1\";s:12:\"profile_link\";s:45:\"https://plus.google.com/103583381097797606705\";s:7:\"profile\";s:86:\"<p>Damodar is a open source web developer who likes to provide web tools for FREE.</p>\";s:11:\"photo_small\";N;s:11:\"photo_large\";N;s:5:\"intro\";N;s:11:\"group_title\";s:13:\"Administrator\";}redirect|s:1:\"1\";'),('6235228d0c5989af1e4af901e9f2ca9fdf2bfc4f','127.0.0.1',1472686714,'__ci_last_regenerate|i:1472686711;backUrl|s:15:\"admin/page/blog\";isLogin|i:1;template|a:1:{i:1;s:10:\"responsive\";}'),('c0a339b14c78500549c54b0c7b82671eb2f05705','127.0.0.1',1472688138,'__ci_last_regenerate|i:1472687868;backUrl|s:5:\"admin\";isLogin|i:1;template|a:1:{i:1;s:10:\"responsive\";}'),('d96a70a21a53ed662408e7649d6b760d410455ff','127.0.0.1',1472688210,'__ci_last_regenerate|i:1472688210;backUrl|s:5:\"admin\";isLogin|i:1;template|a:1:{i:1;s:10:\"responsive\";}'),('7e419547c69d7ea48bd515d86bd5c10731adb508','127.0.0.1',1472702052,'__ci_last_regenerate|i:1472701779;backUrl|s:17:\"admin/menu/teaser\";logged_in|s:1:\"1\";loggedData|a:16:{s:7:\"user_id\";s:2:\"11\";s:6:\"active\";s:1:\"1\";s:5:\"email\";s:13:\"test@test.com\";s:8:\"username\";N;s:8:\"password\";s:32:\"098f6bcd4621d373cade4e832627b4f6\";s:9:\"firstname\";s:7:\"Damodar\";s:8:\"lastname\";s:7:\"Bashyal\";s:8:\"group_id\";s:1:\"1\";s:8:\"is_admin\";s:1:\"1\";s:9:\"is_author\";s:1:\"1\";s:12:\"profile_link\";s:45:\"https://plus.google.com/103583381097797606705\";s:7:\"profile\";s:86:\"<p>Damodar is a open source web developer who likes to provide web tools for FREE.</p>\";s:11:\"photo_small\";N;s:11:\"photo_large\";N;s:5:\"intro\";N;s:11:\"group_title\";s:13:\"Administrator\";}redirect|s:1:\"1\";template|a:1:{i:1;s:10:\"responsive\";}'),('93287a209d7b5b3cc0d6456fe7bfa3ef0cdf4f65','127.0.0.1',1472702387,'__ci_last_regenerate|i:1472702104;backUrl|s:17:\"admin/menu/teaser\";logged_in|s:1:\"1\";loggedData|a:16:{s:7:\"user_id\";s:2:\"11\";s:6:\"active\";s:1:\"1\";s:5:\"email\";s:13:\"test@test.com\";s:8:\"username\";N;s:8:\"password\";s:32:\"098f6bcd4621d373cade4e832627b4f6\";s:9:\"firstname\";s:7:\"Damodar\";s:8:\"lastname\";s:7:\"Bashyal\";s:8:\"group_id\";s:1:\"1\";s:8:\"is_admin\";s:1:\"1\";s:9:\"is_author\";s:1:\"1\";s:12:\"profile_link\";s:45:\"https://plus.google.com/103583381097797606705\";s:7:\"profile\";s:86:\"<p>Damodar is a open source web developer who likes to provide web tools for FREE.</p>\";s:11:\"photo_small\";N;s:11:\"photo_large\";N;s:5:\"intro\";N;s:11:\"group_title\";s:13:\"Administrator\";}redirect|s:1:\"1\";template|a:1:{i:1;s:10:\"responsive\";}'),('e383f29ba6f852c907910164c9f0ccb75c670347','127.0.0.1',1472702765,'__ci_last_regenerate|i:1472702546;backUrl|s:28:\"admin/group/permissions/id/1\";logged_in|s:1:\"1\";loggedData|a:16:{s:7:\"user_id\";s:2:\"11\";s:6:\"active\";s:1:\"1\";s:5:\"email\";s:13:\"test@test.com\";s:8:\"username\";N;s:8:\"password\";s:32:\"098f6bcd4621d373cade4e832627b4f6\";s:9:\"firstname\";s:7:\"Damodar\";s:8:\"lastname\";s:7:\"Bashyal\";s:8:\"group_id\";s:1:\"1\";s:8:\"is_admin\";s:1:\"1\";s:9:\"is_author\";s:1:\"1\";s:12:\"profile_link\";s:45:\"https://plus.google.com/103583381097797606705\";s:7:\"profile\";s:86:\"<p>Damodar is a open source web developer who likes to provide web tools for FREE.</p>\";s:11:\"photo_small\";N;s:11:\"photo_large\";N;s:5:\"intro\";N;s:11:\"group_title\";s:13:\"Administrator\";}redirect|s:1:\"1\";template|a:1:{i:1;s:10:\"responsive\";}'),('912f7a1f93b3d3c5f4799fc9aaf5a6c736c538ab','127.0.0.1',1472703551,'__ci_last_regenerate|i:1472703270;backUrl|s:21:\"admin/banner/create/1\";logged_in|s:1:\"1\";loggedData|a:16:{s:7:\"user_id\";s:2:\"11\";s:6:\"active\";s:1:\"1\";s:5:\"email\";s:13:\"test@test.com\";s:8:\"username\";N;s:8:\"password\";s:32:\"098f6bcd4621d373cade4e832627b4f6\";s:9:\"firstname\";s:7:\"Damodar\";s:8:\"lastname\";s:7:\"Bashyal\";s:8:\"group_id\";s:1:\"1\";s:8:\"is_admin\";s:1:\"1\";s:9:\"is_author\";s:1:\"1\";s:12:\"profile_link\";s:45:\"https://plus.google.com/103583381097797606705\";s:7:\"profile\";s:86:\"<p>Damodar is a open source web developer who likes to provide web tools for FREE.</p>\";s:11:\"photo_small\";N;s:11:\"photo_large\";N;s:5:\"intro\";N;s:11:\"group_title\";s:13:\"Administrator\";}redirect|s:1:\"1\";template|a:1:{i:1;s:10:\"responsive\";}'),('c553a156801cb1d5d7774ce8568af496892de5ab','127.0.0.1',1473379952,'__ci_last_regenerate|i:1473379950;template|a:1:{i:1;s:10:\"responsive\";}'),('295b342014ec156c8b4fcfdb63f8d083c43a8d02','127.0.0.1',1473380660,'__ci_last_regenerate|i:1473380553;template|a:1:{i:1;s:10:\"responsive\";}backUrl|s:4:\"blog\";'),('c036aa28d4203cb86adc42f136927f0e80d0bb1a','127.0.0.1',1475136173,'__ci_last_regenerate|i:1475135939;template|a:1:{i:1;s:10:\"responsive\";}backUrl|s:15:\"admin/page/blog\";logged_in|s:1:\"1\";loggedData|a:16:{s:7:\"user_id\";s:2:\"11\";s:6:\"active\";s:1:\"1\";s:5:\"email\";s:13:\"test@test.com\";s:8:\"username\";N;s:8:\"password\";s:32:\"098f6bcd4621d373cade4e832627b4f6\";s:9:\"firstname\";s:7:\"Damodar\";s:8:\"lastname\";s:7:\"Bashyal\";s:8:\"group_id\";s:1:\"1\";s:8:\"is_admin\";s:1:\"1\";s:9:\"is_author\";s:1:\"1\";s:12:\"profile_link\";s:45:\"https://plus.google.com/103583381097797606705\";s:7:\"profile\";s:86:\"<p>Damodar is a open source web developer who likes to provide web tools for FREE.</p>\";s:11:\"photo_small\";N;s:11:\"photo_large\";N;s:5:\"intro\";N;s:11:\"group_title\";s:13:\"Administrator\";}redirect|s:1:\"1\";'),('061fadd18d2d5af91716b7f4ccf1341a38a68e0e','127.0.0.1',1475136565,'__ci_last_regenerate|i:1475136428;template|a:1:{i:1;s:10:\"responsive\";}backUrl|s:15:\"admin/page/blog\";logged_in|s:1:\"1\";loggedData|a:16:{s:7:\"user_id\";s:2:\"11\";s:6:\"active\";s:1:\"1\";s:5:\"email\";s:13:\"test@test.com\";s:8:\"username\";N;s:8:\"password\";s:32:\"098f6bcd4621d373cade4e832627b4f6\";s:9:\"firstname\";s:7:\"Damodar\";s:8:\"lastname\";s:7:\"Bashyal\";s:8:\"group_id\";s:1:\"1\";s:8:\"is_admin\";s:1:\"1\";s:9:\"is_author\";s:1:\"1\";s:12:\"profile_link\";s:45:\"https://plus.google.com/103583381097797606705\";s:7:\"profile\";s:86:\"<p>Damodar is a open source web developer who likes to provide web tools for FREE.</p>\";s:11:\"photo_small\";N;s:11:\"photo_large\";N;s:5:\"intro\";N;s:11:\"group_title\";s:13:\"Administrator\";}redirect|s:1:\"1\";'),('54ad30d77854fc81e65e5ec21120836b555499f5','127.0.0.1',1475137164,'__ci_last_regenerate|i:1475136889;template|a:1:{i:1;s:10:\"responsive\";}backUrl|s:15:\"admin/page/blog\";logged_in|s:1:\"1\";loggedData|a:16:{s:7:\"user_id\";s:2:\"11\";s:6:\"active\";s:1:\"1\";s:5:\"email\";s:13:\"test@test.com\";s:8:\"username\";N;s:8:\"password\";s:32:\"098f6bcd4621d373cade4e832627b4f6\";s:9:\"firstname\";s:7:\"Damodar\";s:8:\"lastname\";s:7:\"Bashyal\";s:8:\"group_id\";s:1:\"1\";s:8:\"is_admin\";s:1:\"1\";s:9:\"is_author\";s:1:\"1\";s:12:\"profile_link\";s:45:\"https://plus.google.com/103583381097797606705\";s:7:\"profile\";s:86:\"<p>Damodar is a open source web developer who likes to provide web tools for FREE.</p>\";s:11:\"photo_small\";N;s:11:\"photo_large\";N;s:5:\"intro\";N;s:11:\"group_title\";s:13:\"Administrator\";}redirect|s:1:\"1\";'),('64ab9768a5b9971c0d704261c55b512605aeb03d','127.0.0.1',1475137407,'__ci_last_regenerate|i:1475137374;template|a:1:{i:1;s:10:\"responsive\";}backUrl|s:26:\"admin/page/css/content.css\";logged_in|s:1:\"1\";loggedData|a:16:{s:7:\"user_id\";s:2:\"11\";s:6:\"active\";s:1:\"1\";s:5:\"email\";s:13:\"test@test.com\";s:8:\"username\";N;s:8:\"password\";s:32:\"098f6bcd4621d373cade4e832627b4f6\";s:9:\"firstname\";s:7:\"Damodar\";s:8:\"lastname\";s:7:\"Bashyal\";s:8:\"group_id\";s:1:\"1\";s:8:\"is_admin\";s:1:\"1\";s:9:\"is_author\";s:1:\"1\";s:12:\"profile_link\";s:45:\"https://plus.google.com/103583381097797606705\";s:7:\"profile\";s:86:\"<p>Damodar is a open source web developer who likes to provide web tools for FREE.</p>\";s:11:\"photo_small\";N;s:11:\"photo_large\";N;s:5:\"intro\";N;s:11:\"group_title\";s:13:\"Administrator\";}redirect|s:1:\"1\";'),('a6540b09d72312ac00dd2959c294e82b0624d066','127.0.0.1',1475137686,'__ci_last_regenerate|i:1475137686;template|a:1:{i:1;s:10:\"responsive\";}backUrl|s:15:\"admin/page/blog\";logged_in|s:1:\"1\";loggedData|a:16:{s:7:\"user_id\";s:2:\"11\";s:6:\"active\";s:1:\"1\";s:5:\"email\";s:13:\"test@test.com\";s:8:\"username\";N;s:8:\"password\";s:32:\"098f6bcd4621d373cade4e832627b4f6\";s:9:\"firstname\";s:7:\"Damodar\";s:8:\"lastname\";s:7:\"Bashyal\";s:8:\"group_id\";s:1:\"1\";s:8:\"is_admin\";s:1:\"1\";s:9:\"is_author\";s:1:\"1\";s:12:\"profile_link\";s:45:\"https://plus.google.com/103583381097797606705\";s:7:\"profile\";s:86:\"<p>Damodar is a open source web developer who likes to provide web tools for FREE.</p>\";s:11:\"photo_small\";N;s:11:\"photo_large\";N;s:5:\"intro\";N;s:11:\"group_title\";s:13:\"Administrator\";}redirect|s:1:\"1\";'),('b87578dc72126c9664989bfbe5de0e6e83d80b50','127.0.0.1',1475143426,'__ci_last_regenerate|i:1475143375;template|a:1:{i:1;s:10:\"responsive\";}backUrl|s:15:\"admin/page/blog\";logged_in|s:1:\"1\";loggedData|a:16:{s:7:\"user_id\";s:2:\"11\";s:6:\"active\";s:1:\"1\";s:5:\"email\";s:13:\"test@test.com\";s:8:\"username\";N;s:8:\"password\";s:32:\"098f6bcd4621d373cade4e832627b4f6\";s:9:\"firstname\";s:7:\"Damodar\";s:8:\"lastname\";s:7:\"Bashyal\";s:8:\"group_id\";s:1:\"1\";s:8:\"is_admin\";s:1:\"1\";s:9:\"is_author\";s:1:\"1\";s:12:\"profile_link\";s:45:\"https://plus.google.com/103583381097797606705\";s:7:\"profile\";s:86:\"<p>Damodar is a open source web developer who likes to provide web tools for FREE.</p>\";s:11:\"photo_small\";N;s:11:\"photo_large\";N;s:5:\"intro\";N;s:11:\"group_title\";s:13:\"Administrator\";}redirect|s:1:\"1\";'),('1f7b6dcbb3103ac57ff12867befe7b637fe9d8be','127.0.0.1',1475191008,'__ci_last_regenerate|i:1475190828;backUrl|s:15:\"admin/page/blog\";template|a:1:{i:1;s:10:\"responsive\";}logged_in|s:1:\"1\";loggedData|a:16:{s:7:\"user_id\";s:2:\"11\";s:6:\"active\";s:1:\"1\";s:5:\"email\";s:13:\"test@test.com\";s:8:\"username\";N;s:8:\"password\";s:32:\"098f6bcd4621d373cade4e832627b4f6\";s:9:\"firstname\";s:7:\"Damodar\";s:8:\"lastname\";s:7:\"Bashyal\";s:8:\"group_id\";s:1:\"1\";s:8:\"is_admin\";s:1:\"1\";s:9:\"is_author\";s:1:\"1\";s:12:\"profile_link\";s:45:\"https://plus.google.com/103583381097797606705\";s:7:\"profile\";s:86:\"<p>Damodar is a open source web developer who likes to provide web tools for FREE.</p>\";s:11:\"photo_small\";N;s:11:\"photo_large\";N;s:5:\"intro\";N;s:11:\"group_title\";s:13:\"Administrator\";}redirect|s:1:\"1\";'),('67cf4511ba3a8dde7136d13ccbd8b4c2c1eabe1a','127.0.0.1',1475195642,'__ci_last_regenerate|i:1475195356;backUrl|s:15:\"admin/page/blog\";template|a:1:{i:1;s:10:\"responsive\";}logged_in|s:1:\"1\";loggedData|a:16:{s:7:\"user_id\";s:2:\"11\";s:6:\"active\";s:1:\"1\";s:5:\"email\";s:13:\"test@test.com\";s:8:\"username\";N;s:8:\"password\";s:32:\"098f6bcd4621d373cade4e832627b4f6\";s:9:\"firstname\";s:7:\"Damodar\";s:8:\"lastname\";s:7:\"Bashyal\";s:8:\"group_id\";s:1:\"1\";s:8:\"is_admin\";s:1:\"1\";s:9:\"is_author\";s:1:\"1\";s:12:\"profile_link\";s:45:\"https://plus.google.com/103583381097797606705\";s:7:\"profile\";s:86:\"<p>Damodar is a open source web developer who likes to provide web tools for FREE.</p>\";s:11:\"photo_small\";N;s:11:\"photo_large\";N;s:5:\"intro\";N;s:11:\"group_title\";s:13:\"Administrator\";}redirect|s:1:\"1\";'),('08ce3f98cccc8994f81598c13938412ff0137971','127.0.0.1',1475199089,'__ci_last_regenerate|i:1475198833;backUrl|s:41:\"blog/diary/37/Kushals-First-Youtube-Video\";template|a:1:{i:1;s:10:\"responsive\";}logged_in|s:1:\"1\";loggedData|a:16:{s:7:\"user_id\";s:2:\"11\";s:6:\"active\";s:1:\"1\";s:5:\"email\";s:13:\"test@test.com\";s:8:\"username\";N;s:8:\"password\";s:32:\"098f6bcd4621d373cade4e832627b4f6\";s:9:\"firstname\";s:7:\"Damodar\";s:8:\"lastname\";s:7:\"Bashyal\";s:8:\"group_id\";s:1:\"1\";s:8:\"is_admin\";s:1:\"1\";s:9:\"is_author\";s:1:\"1\";s:12:\"profile_link\";s:45:\"https://plus.google.com/103583381097797606705\";s:7:\"profile\";s:86:\"<p>Damodar is a open source web developer who likes to provide web tools for FREE.</p>\";s:11:\"photo_small\";N;s:11:\"photo_large\";N;s:5:\"intro\";N;s:11:\"group_title\";s:13:\"Administrator\";}redirect|s:1:\"1\";'),('7d5a9cf18aab56684d299464546a397435751fa1','127.0.0.1',1475199414,'__ci_last_regenerate|i:1475199170;backUrl|s:41:\"blog/diary/37/Kushals-First-Youtube-Video\";template|a:1:{i:1;s:10:\"responsive\";}logged_in|s:1:\"1\";loggedData|a:16:{s:7:\"user_id\";s:2:\"11\";s:6:\"active\";s:1:\"1\";s:5:\"email\";s:13:\"test@test.com\";s:8:\"username\";N;s:8:\"password\";s:32:\"098f6bcd4621d373cade4e832627b4f6\";s:9:\"firstname\";s:7:\"Damodar\";s:8:\"lastname\";s:7:\"Bashyal\";s:8:\"group_id\";s:1:\"1\";s:8:\"is_admin\";s:1:\"1\";s:9:\"is_author\";s:1:\"1\";s:12:\"profile_link\";s:45:\"https://plus.google.com/103583381097797606705\";s:7:\"profile\";s:86:\"<p>Damodar is a open source web developer who likes to provide web tools for FREE.</p>\";s:11:\"photo_small\";N;s:11:\"photo_large\";N;s:5:\"intro\";N;s:11:\"group_title\";s:13:\"Administrator\";}redirect|s:1:\"1\";'),('60fd4e7b5bfd8c2078dbf0aeda2d493c64a72094','127.0.0.1',1475200159,'__ci_last_regenerate|i:1475200158;backUrl|s:15:\"admin/page/blog\";template|a:1:{i:1;s:10:\"responsive\";}logged_in|s:1:\"1\";loggedData|a:16:{s:7:\"user_id\";s:2:\"11\";s:6:\"active\";s:1:\"1\";s:5:\"email\";s:13:\"test@test.com\";s:8:\"username\";N;s:8:\"password\";s:32:\"098f6bcd4621d373cade4e832627b4f6\";s:9:\"firstname\";s:7:\"Damodar\";s:8:\"lastname\";s:7:\"Bashyal\";s:8:\"group_id\";s:1:\"1\";s:8:\"is_admin\";s:1:\"1\";s:9:\"is_author\";s:1:\"1\";s:12:\"profile_link\";s:45:\"https://plus.google.com/103583381097797606705\";s:7:\"profile\";s:86:\"<p>Damodar is a open source web developer who likes to provide web tools for FREE.</p>\";s:11:\"photo_small\";N;s:11:\"photo_large\";N;s:5:\"intro\";N;s:11:\"group_title\";s:13:\"Administrator\";}redirect|s:1:\"1\";'),('dbe10b6dde439e9eb2e6c67003a4dff858ab34fb','127.0.0.1',1475211516,'__ci_last_regenerate|i:1475211255;backUrl|s:41:\"blog/diary/37/Kushals-First-Youtube-Video\";template|a:1:{i:1;s:10:\"responsive\";}'),('4c36f5a7ca4ccf41d8592a1c59af6eaac854afc8','127.0.0.1',1475211686,'__ci_last_regenerate|i:1475211686;backUrl|s:41:\"blog/diary/37/Kushals-First-Youtube-Video\";template|a:1:{i:1;s:10:\"responsive\";}'),('0a642b0d533097c1d1d28e3498f1c46155d10369','127.0.0.1',1475213178,'__ci_last_regenerate|i:1475212954;backUrl|s:21:\"really-cool-video.mp4\";template|a:1:{i:1;s:10:\"responsive\";}captcha|i:8;'),('e0816861f455707d6933a9d9445b418e825ef8ba','127.0.0.1',1475322034,'__ci_last_regenerate|i:1475321799;backUrl|s:41:\"blog/diary/37/Kushals-First-Youtube-Video\";template|a:1:{i:1;s:10:\"responsive\";}captcha|i:7;logged_in|s:1:\"1\";loggedData|a:16:{s:7:\"user_id\";s:2:\"11\";s:6:\"active\";s:1:\"1\";s:5:\"email\";s:13:\"test@test.com\";s:8:\"username\";N;s:8:\"password\";s:32:\"098f6bcd4621d373cade4e832627b4f6\";s:9:\"firstname\";s:7:\"Damodar\";s:8:\"lastname\";s:7:\"Bashyal\";s:8:\"group_id\";s:1:\"1\";s:8:\"is_admin\";s:1:\"1\";s:9:\"is_author\";s:1:\"1\";s:12:\"profile_link\";s:45:\"https://plus.google.com/103583381097797606705\";s:7:\"profile\";s:86:\"<p>Damodar is a open source web developer who likes to provide web tools for FREE.</p>\";s:11:\"photo_small\";N;s:11:\"photo_large\";N;s:5:\"intro\";N;s:11:\"group_title\";s:13:\"Administrator\";}redirect|s:1:\"1\";'),('b5fbac0cde76ae939d4dd14a535b1efe3ee7749e','127.0.0.1',1475322203,'__ci_last_regenerate|i:1475322113;backUrl|s:13:\"tools/captcha\";template|a:1:{i:1;s:10:\"responsive\";}captcha|i:7;logged_in|s:1:\"1\";loggedData|a:16:{s:7:\"user_id\";s:2:\"11\";s:6:\"active\";s:1:\"1\";s:5:\"email\";s:13:\"test@test.com\";s:8:\"username\";N;s:8:\"password\";s:32:\"098f6bcd4621d373cade4e832627b4f6\";s:9:\"firstname\";s:7:\"Damodar\";s:8:\"lastname\";s:7:\"Bashyal\";s:8:\"group_id\";s:1:\"1\";s:8:\"is_admin\";s:1:\"1\";s:9:\"is_author\";s:1:\"1\";s:12:\"profile_link\";s:45:\"https://plus.google.com/103583381097797606705\";s:7:\"profile\";s:86:\"<p>Damodar is a open source web developer who likes to provide web tools for FREE.</p>\";s:11:\"photo_small\";N;s:11:\"photo_large\";N;s:5:\"intro\";N;s:11:\"group_title\";s:13:\"Administrator\";}redirect|s:1:\"1\";'),('7dac5aff12f535ae1fb90fa7a891ab44df137aaa','127.0.0.1',1475322424,'__ci_last_regenerate|i:1475322423;backUrl|s:13:\"tools/captcha\";template|a:1:{i:1;s:10:\"responsive\";}captcha|i:4;logged_in|s:1:\"1\";loggedData|a:16:{s:7:\"user_id\";s:2:\"11\";s:6:\"active\";s:1:\"1\";s:5:\"email\";s:13:\"test@test.com\";s:8:\"username\";N;s:8:\"password\";s:32:\"098f6bcd4621d373cade4e832627b4f6\";s:9:\"firstname\";s:7:\"Damodar\";s:8:\"lastname\";s:7:\"Bashyal\";s:8:\"group_id\";s:1:\"1\";s:8:\"is_admin\";s:1:\"1\";s:9:\"is_author\";s:1:\"1\";s:12:\"profile_link\";s:45:\"https://plus.google.com/103583381097797606705\";s:7:\"profile\";s:86:\"<p>Damodar is a open source web developer who likes to provide web tools for FREE.</p>\";s:11:\"photo_small\";N;s:11:\"photo_large\";N;s:5:\"intro\";N;s:11:\"group_title\";s:13:\"Administrator\";}redirect|s:1:\"1\";'),('019d215e2a4892d7c6d8fcb266833c8b13762f87','127.0.0.1',1475323697,'__ci_last_regenerate|i:1475323624;backUrl|s:13:\"tools/captcha\";template|a:1:{i:1;s:10:\"responsive\";}captcha|i:6;logged_in|s:1:\"1\";loggedData|a:16:{s:7:\"user_id\";s:2:\"11\";s:6:\"active\";s:1:\"1\";s:5:\"email\";s:13:\"test@test.com\";s:8:\"username\";N;s:8:\"password\";s:32:\"098f6bcd4621d373cade4e832627b4f6\";s:9:\"firstname\";s:7:\"Damodar\";s:8:\"lastname\";s:7:\"Bashyal\";s:8:\"group_id\";s:1:\"1\";s:8:\"is_admin\";s:1:\"1\";s:9:\"is_author\";s:1:\"1\";s:12:\"profile_link\";s:45:\"https://plus.google.com/103583381097797606705\";s:7:\"profile\";s:86:\"<p>Damodar is a open source web developer who likes to provide web tools for FREE.</p>\";s:11:\"photo_small\";N;s:11:\"photo_large\";N;s:5:\"intro\";N;s:11:\"group_title\";s:13:\"Administrator\";}redirect|s:1:\"1\";'),('eed71309e3ec403c85d0c535379ece11eae2035e','127.0.0.1',1475493779,'__ci_last_regenerate|i:1475493481;backUrl|s:20:\"admin/menu/blog-roll\";template|a:1:{i:1;s:10:\"responsive\";}logged_in|s:1:\"1\";loggedData|a:16:{s:7:\"user_id\";s:2:\"11\";s:6:\"active\";s:1:\"1\";s:5:\"email\";s:13:\"test@test.com\";s:8:\"username\";N;s:8:\"password\";s:32:\"098f6bcd4621d373cade4e832627b4f6\";s:9:\"firstname\";s:7:\"Damodar\";s:8:\"lastname\";s:7:\"Bashyal\";s:8:\"group_id\";s:1:\"1\";s:8:\"is_admin\";s:1:\"1\";s:9:\"is_author\";s:1:\"1\";s:12:\"profile_link\";s:45:\"https://plus.google.com/103583381097797606705\";s:7:\"profile\";s:86:\"<p>Damodar is a open source web developer who likes to provide web tools for FREE.</p>\";s:11:\"photo_small\";N;s:11:\"photo_large\";N;s:5:\"intro\";N;s:11:\"group_title\";s:13:\"Administrator\";}redirect|s:1:\"1\";websites_id|i:1;'),('10e019a2b677ae4abb6e41345d0b97c0a6e868da','127.0.0.1',1475494002,'__ci_last_regenerate|i:1475493783;backUrl|s:15:\"admin/page/page\";template|a:1:{i:1;s:10:\"responsive\";}logged_in|s:1:\"1\";loggedData|a:16:{s:7:\"user_id\";s:2:\"11\";s:6:\"active\";s:1:\"1\";s:5:\"email\";s:13:\"test@test.com\";s:8:\"username\";N;s:8:\"password\";s:32:\"098f6bcd4621d373cade4e832627b4f6\";s:9:\"firstname\";s:7:\"Damodar\";s:8:\"lastname\";s:7:\"Bashyal\";s:8:\"group_id\";s:1:\"1\";s:8:\"is_admin\";s:1:\"1\";s:9:\"is_author\";s:1:\"1\";s:12:\"profile_link\";s:45:\"https://plus.google.com/103583381097797606705\";s:7:\"profile\";s:86:\"<p>Damodar is a open source web developer who likes to provide web tools for FREE.</p>\";s:11:\"photo_small\";N;s:11:\"photo_large\";N;s:5:\"intro\";N;s:11:\"group_title\";s:13:\"Administrator\";}redirect|s:1:\"1\";websites_id|i:1;'),('be9b3f8c939377b221001348a3371aa781671fe3','127.0.0.1',1475494292,'__ci_last_regenerate|i:1475494087;backUrl|s:15:\"admin/page/blog\";logged_in|s:1:\"1\";loggedData|a:16:{s:7:\"user_id\";s:2:\"11\";s:6:\"active\";s:1:\"1\";s:5:\"email\";s:13:\"test@test.com\";s:8:\"username\";N;s:8:\"password\";s:32:\"098f6bcd4621d373cade4e832627b4f6\";s:9:\"firstname\";s:7:\"Damodar\";s:8:\"lastname\";s:7:\"Bashyal\";s:8:\"group_id\";s:1:\"1\";s:8:\"is_admin\";s:1:\"1\";s:9:\"is_author\";s:1:\"1\";s:12:\"profile_link\";s:45:\"https://plus.google.com/103583381097797606705\";s:7:\"profile\";s:86:\"<p>Damodar is a open source web developer who likes to provide web tools for FREE.</p>\";s:11:\"photo_small\";N;s:11:\"photo_large\";N;s:5:\"intro\";N;s:11:\"group_title\";s:13:\"Administrator\";}redirect|s:1:\"1\";websites_id|i:1;template|a:1:{i:1;s:10:\"responsive\";}captcha|i:6;'),('fccca7d1a2f59aeeb48b82f56c148b5012277969','127.0.0.1',1475494701,'__ci_last_regenerate|i:1475494470;backUrl|s:41:\"blog/diary/37/Kushals-First-Youtube-Video\";logged_in|s:1:\"1\";loggedData|a:16:{s:7:\"user_id\";s:2:\"11\";s:6:\"active\";s:1:\"1\";s:5:\"email\";s:13:\"test@test.com\";s:8:\"username\";N;s:8:\"password\";s:32:\"098f6bcd4621d373cade4e832627b4f6\";s:9:\"firstname\";s:7:\"Damodar\";s:8:\"lastname\";s:7:\"Bashyal\";s:8:\"group_id\";s:1:\"1\";s:8:\"is_admin\";s:1:\"1\";s:9:\"is_author\";s:1:\"1\";s:12:\"profile_link\";s:45:\"https://plus.google.com/103583381097797606705\";s:7:\"profile\";s:86:\"<p>Damodar is a open source web developer who likes to provide web tools for FREE.</p>\";s:11:\"photo_small\";N;s:11:\"photo_large\";N;s:5:\"intro\";N;s:11:\"group_title\";s:13:\"Administrator\";}redirect|s:1:\"1\";websites_id|i:1;template|a:1:{i:1;s:10:\"responsive\";}captcha|i:7;'),('323a1fa2f788673114963b7cac5cc530df0521e0','127.0.0.1',1475495019,'__ci_last_regenerate|i:1475494810;backUrl|s:13:\"tools/captcha\";logged_in|s:1:\"1\";loggedData|a:16:{s:7:\"user_id\";s:2:\"11\";s:6:\"active\";s:1:\"1\";s:5:\"email\";s:13:\"test@test.com\";s:8:\"username\";N;s:8:\"password\";s:32:\"098f6bcd4621d373cade4e832627b4f6\";s:9:\"firstname\";s:7:\"Damodar\";s:8:\"lastname\";s:7:\"Bashyal\";s:8:\"group_id\";s:1:\"1\";s:8:\"is_admin\";s:1:\"1\";s:9:\"is_author\";s:1:\"1\";s:12:\"profile_link\";s:45:\"https://plus.google.com/103583381097797606705\";s:7:\"profile\";s:86:\"<p>Damodar is a open source web developer who likes to provide web tools for FREE.</p>\";s:11:\"photo_small\";N;s:11:\"photo_large\";N;s:5:\"intro\";N;s:11:\"group_title\";s:13:\"Administrator\";}redirect|s:1:\"1\";websites_id|i:1;template|a:1:{i:1;s:10:\"responsive\";}captcha|i:6;'),('46ec371b902417bd825017b16ab8837657f188d0','127.0.0.1',1475495227,'__ci_last_regenerate|i:1475495128;backUrl|s:10:\"contact-us\";logged_in|s:1:\"1\";loggedData|a:16:{s:7:\"user_id\";s:2:\"11\";s:6:\"active\";s:1:\"1\";s:5:\"email\";s:13:\"test@test.com\";s:8:\"username\";N;s:8:\"password\";s:32:\"098f6bcd4621d373cade4e832627b4f6\";s:9:\"firstname\";s:7:\"Damodar\";s:8:\"lastname\";s:7:\"Bashyal\";s:8:\"group_id\";s:1:\"1\";s:8:\"is_admin\";s:1:\"1\";s:9:\"is_author\";s:1:\"1\";s:12:\"profile_link\";s:45:\"https://plus.google.com/103583381097797606705\";s:7:\"profile\";s:86:\"<p>Damodar is a open source web developer who likes to provide web tools for FREE.</p>\";s:11:\"photo_small\";N;s:11:\"photo_large\";N;s:5:\"intro\";N;s:11:\"group_title\";s:13:\"Administrator\";}redirect|s:1:\"1\";websites_id|i:1;template|a:1:{i:1;s:10:\"responsive\";}captcha|i:5;');
/*!40000 ALTER TABLE `cf_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cf_setting`
--

DROP TABLE IF EXISTS `cf_setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cf_setting` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(50) NOT NULL,
  `setting_value` varchar(300) NOT NULL,
  `setting_info` varchar(100) NOT NULL,
  `setting_form` varchar(25) NOT NULL,
  `setting_option` varchar(250) NOT NULL,
  `websites_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`setting_id`),
  KEY `setting_id` (`setting_id`),
  KEY `setting_key` (`setting_key`)
) ENGINE=MyISAM AUTO_INCREMENT=103 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cf_setting`
--

LOCK TABLES `cf_setting` WRITE;
/*!40000 ALTER TABLE `cf_setting` DISABLE KEYS */;
INSERT INTO `cf_setting` VALUES (2,'site_enabled','1','Site Enabled','radio','1=YES|0=NO',1),(3,'site_comment','0','Registration required to post comments','radio','1=YES|0=NO',1),(4,'meta_title','Codefight CMS 1','Default Meta Title','textbox','codefight.org',1),(5,'meta_keyword','codefight, code fight, content, management, system, free, php, download','Default Meta Keywords','textbox','codefight, code fight, content, management, system, free, php, download',1),(6,'meta_description','download free content management system built with codeigniter free php framework.','Default Meta Description','textarea','download free content management system built with codeigniter free php framework.',1),(7,'default_template','responsive','Default Template','select','',1),(8,'email_sender','noreply@codefightcms.com','From Email Address','textbox','noreply@codefight.org',1),(9,'site_name','Codefight CMS 1','Website Name','textbox','CodeFight',1),(10,'combine_css','0','Combine CSS Files','radio','1=YES|0=NO',1),(11,'minify_css','0','Minify CSS','radio','1=YES|0=NO',1),(12,'minify_html','0','Minify html source code','radio','1=YES|0=NO',1),(13,'pagination_page_links','5','Display Total Pagination Page Links','textbox','2',1),(14,'pagination_per_page','3','Display Total Articles Per Page','textbox','5',1),(15,'google_analytics_id','UA-852764-5','Google Analytics Web Property ID','textbox','UA-852764-5',1),(16,'display_view_path','0','Do you want to display template path?','radio','0=NO|1=YES',1),(1,'websites_id','1','Load settings for website:','select','-',1),(71,'default_template','white','Default Template','select','',3),(70,'meta_description','This website hosts just skin files for our websites.','Default Meta Description','textarea','download free content management system built with codeigniter free php framework.',3),(68,'meta_title','Codefight CMS 3','Default Meta Title','textbox','codefight.org',3),(69,'meta_keyword','codefight,cms,skin','Default Meta Keywords','textbox','codefight, code fight, content, management, system, free, php, download',3),(67,'site_comment','0','Registration required to post comments','radio','1=YES|0=NO',3),(66,'site_enabled','1','Site Enabled','radio','1=YES|0=NO',3),(65,'websites_id','3','Load settings for website:','select','-',3),(64,'display_view_path','0','Do you want to display template path?','radio','0=NO|1=YES',2),(63,'google_analytics_id','UA-852764-15','Google Analytics Web Property ID','textbox','UA-852764-5',2),(62,'pagination_per_page','2','Display Total Articles Per Page','textbox','5',2),(61,'pagination_page_links','2','Display Total Pagination Page Links','textbox','2',2),(60,'minify_html','0','Minify html source code','radio','1=YES|0=NO',2),(59,'minify_css','0','Minify CSS','radio','1=YES|0=NO',2),(58,'combine_css','0','Combine CSS Files','radio','1=YES|0=NO',2),(56,'email_sender','noreply@codefightcms.com','From Email Address','textbox','noreply@codefight.org',2),(57,'site_name','Codefight CMS 2','Website Name','textbox','CodeFight',2),(55,'default_template','white','Default Template','select','',2),(54,'meta_description','We review different advertising platforms that will help advertiser and publisher both to choose the better media partner.','Default Meta Description','textarea','download free content management system built with codeigniter free php framework.',2),(53,'meta_keyword','Text Link Ads Review, Text Link Reviews, Advertising Reviews, Page Rank Reviews','Default Meta Keywords','textbox','codefight, code fight, content, management, system, free, php, download',2),(52,'meta_title','Codefight CMS 2','Default Meta Title','textbox','codefight.org',2),(51,'site_comment','0','Registration required to post comments','radio','1=YES|0=NO',2),(50,'site_enabled','1','Site Enabled','radio','1=YES|0=NO',2),(49,'websites_id','2','Load settings for website:','select','-',2),(72,'email_sender','noreply@codefightcms.com','From Email Address','textbox','noreply@codefight.org',3),(73,'site_name','Codefight CMS 3','Website Name','textbox','CodeFight',3),(74,'combine_css','0','Combine CSS Files','radio','1=YES|0=NO',3),(75,'minify_css','0','Minify CSS','radio','1=YES|0=NO',3),(76,'minify_html','0','Minify html source code','radio','1=YES|0=NO',3),(77,'pagination_page_links','2','Display Total Pagination Page Links','textbox','2',3),(78,'pagination_per_page','3','Display Total Articles Per Page','textbox','5',3),(79,'google_analytics_id','UA-852764-5','Google Analytics Web Property ID','textbox','UA-852764-5',3),(80,'display_view_path','0','Do you want to display template path?','radio','0=NO|1=YES',3),(82,'default_recipients','noreply@codefightcms.com','Default Store Email Recipient','textbox','test@example.com',1),(83,'default_recipients','noreply@codefightcms.com','Default Store Email Recipient','textbox','test@example.com',2),(84,'default_recipients','noreply@codefightcms.com','Default Store Email Recipient','textbox','test@example.com',3),(85,'websites_id','4','Load settings for website:','select','-',4),(86,'site_enabled','1','Site Enabled','radio','1=YES|0=NO',4),(87,'site_comment','0','Registration required to post comments','radio','1=YES|0=NO',4),(88,'meta_title','Codefight CMS 4','Default Meta Title','textbox','codefight.org',4),(89,'meta_keyword','damodar,bashyal,butwal,nepal','Default Meta Keywords','textbox','codefight, code fight, content, management, system, free, php, download',4),(90,'meta_description','Personal website of damodar bashyal.','Default Meta Description','textarea','download free content management system built with codeigniter free php framework.',4),(91,'default_template','white','Default Template','select','',4),(92,'email_sender','noreply@codefightcms.com','From Email Address','textbox','noreply@codefight.org',4),(93,'site_name','Codefight CMS 4','Website Name','textbox','CodeFight',4),(94,'combine_css','0','Combine CSS Files','radio','1=YES|0=NO',4),(95,'minify_css','0','Minify CSS','radio','1=YES|0=NO',4),(96,'minify_html','0','Minify html source code','radio','1=YES|0=NO',4),(97,'pagination_page_links','2','Display Total Pagination Page Links','textbox','2',4),(98,'pagination_per_page','3','Display Total Articles Per Page','textbox','5',4),(99,'google_analytics_id','UA-852764-5','Google Analytics Web Property ID','textbox','UA-852764-5',4),(100,'display_view_path','0','Do you want to display template path?','radio','0=NO|1=YES',4),(101,'default_recipients','noreply@codefightcms.com','Default Store Email Recipient','textbox','test@example.com',4),(102,'google_plus','103583381097797606705','Google Plus Publisher ID','textbox','103583381097797606705',1);
/*!40000 ALTER TABLE `cf_setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cf_setting_keys`
--

DROP TABLE IF EXISTS `cf_setting_keys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cf_setting_keys` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(50) NOT NULL,
  `setting_value` varchar(300) NOT NULL,
  `setting_info` varchar(100) NOT NULL,
  `setting_form` varchar(25) NOT NULL,
  `setting_option` varchar(250) NOT NULL,
  PRIMARY KEY (`setting_id`),
  KEY `setting_id` (`setting_id`),
  KEY `setting_key` (`setting_key`)
) ENGINE=MyISAM AUTO_INCREMENT=83 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cf_setting_keys`
--

LOCK TABLES `cf_setting_keys` WRITE;
/*!40000 ALTER TABLE `cf_setting_keys` DISABLE KEYS */;
INSERT INTO `cf_setting_keys` VALUES (2,'site_enabled','1','Site Enabled','radio','1=YES|0=NO'),(3,'site_comment','0','Registration required to post comments','radio','1=YES|0=NO'),(4,'meta_title','codefight.org','Default Meta Title','textbox','codefight.org'),(5,'meta_keyword','codefight, code fight, content, management, system, free, php, download','Default Meta Keywords','textbox','codefight, code fight, content, management, system, free, php, download'),(6,'meta_description','download free content management system built with codeigniter free php framework.','Default Meta Description','textarea','download free content management system built with codeigniter free php framework.'),(7,'default_template','default','Default Template','select',''),(8,'email_sender','noreply@codefight.org','From Email Address','textbox','noreply@codefight.org'),(9,'site_name','CodeFight','Website Name','textbox','CodeFight'),(10,'combine_css','0','Combine CSS Files','radio','1=YES|0=NO'),(11,'minify_css','0','Minify CSS','radio','1=YES|0=NO'),(12,'minify_html','0','Minify html source code','radio','1=YES|0=NO'),(13,'pagination_page_links','2','Display Total Pagination Page Links','textbox','2'),(14,'pagination_per_page','3','Display Total Articles Per Page','textbox','5'),(15,'google_analytics_id','UA-852764-5','Google Analytics Web Property ID','textbox','UA-852764-5'),(16,'display_view_path','0','Do you want to display template path?','radio','0=NO|1=YES'),(1,'websites_id','1','Load settings for website:','select','-'),(81,'default_recipients','','Default Store Email Recipient','textbox','test@example.com'),(82,'google_plus','','Google Plus Publisher ID','textbox','103583381097797606705');
/*!40000 ALTER TABLE `cf_setting_keys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cf_tag_cloud`
--

DROP TABLE IF EXISTS `cf_tag_cloud`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cf_tag_cloud` (
  `tag` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '1',
  `type` varchar(15) NOT NULL DEFAULT 'page',
  `websites_id` int(11) NOT NULL DEFAULT '0',
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  `content` text,
  KEY `count` (`count`),
  KEY `websites_id` (`websites_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cf_tag_cloud`
--

LOCK TABLES `cf_tag_cloud` WRITE;
/*!40000 ALTER TABLE `cf_tag_cloud` DISABLE KEYS */;
INSERT INTO `cf_tag_cloud` VALUES ('Baby-Jumping',' Baby Jumping',0,'blog',4,NULL,NULL,NULL,NULL),('Baby-Jumping',' Baby Jumping',0,'blog',2,NULL,NULL,NULL,NULL),('Baby-Jumping',' Baby Jumping',0,'blog',1,NULL,NULL,NULL,NULL),('Baby',' Baby',0,'blog',4,NULL,NULL,NULL,NULL),('Baby',' Baby',0,'blog',2,NULL,NULL,NULL,NULL),('Baby',' Baby',0,'blog',1,NULL,NULL,NULL,NULL),('Kushal-Bashyal','Kushal Bashyal',1,'blog',4,NULL,NULL,NULL,NULL),('Kushal-Bashyal','Kushal Bashyal',1,'blog',2,NULL,NULL,NULL,NULL),('Kushal-Bashyal','Kushal Bashyal',1,'blog',1,NULL,NULL,NULL,NULL),('Happy-Baby','Happy Baby',0,'blog',1,NULL,NULL,NULL,NULL),('Happy-Baby','Happy Baby',0,'blog',2,NULL,NULL,NULL,NULL),('Happy-Baby','Happy Baby',0,'blog',4,NULL,NULL,NULL,NULL),('advertising','advertising',1,'blog',1,NULL,NULL,NULL,NULL),('advertising','advertising',1,'blog',2,NULL,NULL,NULL,NULL),('codeigniter','codeigniter',1,'blog',1,NULL,NULL,NULL,NULL),('codeigniter','codeigniter',0,'blog',2,NULL,NULL,NULL,NULL),('Nepal','Nepal',1,'blog',1,NULL,NULL,NULL,NULL),('Nepal','Nepal',1,'blog',2,NULL,NULL,NULL,NULL),('Nepal','Nepal',1,'blog',4,NULL,NULL,NULL,NULL),('Nepali','Nepali',1,'blog',1,NULL,NULL,NULL,NULL),('Nepali','Nepali',1,'blog',2,NULL,NULL,NULL,NULL),('Nepali','Nepali',1,'blog',4,NULL,NULL,NULL,NULL),('Proud-to-be-nepalese','Proud to be nepalese',0,'blog',1,NULL,NULL,NULL,NULL),('Proud-to-be-nepalese','Proud to be nepalese',0,'blog',2,NULL,NULL,NULL,NULL),('Proud-to-be-nepalese','Proud to be nepalese',0,'blog',4,NULL,NULL,NULL,NULL),('email-forward','email forward',0,'blog',1,NULL,NULL,NULL,NULL),('email-forward','email forward',0,'blog',2,NULL,NULL,NULL,NULL),('email-forward','email forward',0,'blog',4,NULL,NULL,NULL,NULL),('test','test',4,'blog',1,NULL,NULL,NULL,NULL),('test','test',3,'blog',2,NULL,NULL,NULL,NULL),('test','test',2,'blog',4,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `cf_tag_cloud` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cf_trim`
--

DROP TABLE IF EXISTS `cf_trim`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cf_trim` (
  `trim_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `long_url` varchar(255) NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `creator` char(15) NOT NULL,
  `referrals` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`trim_id`),
  UNIQUE KEY `long` (`long_url`),
  KEY `referrals` (`referrals`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cf_trim`
--

LOCK TABLES `cf_trim` WRITE;
/*!40000 ALTER TABLE `cf_trim` DISABLE KEYS */;
INSERT INTO `cf_trim` VALUES (1,'http://codefight.org/',1281169085,'127.0.0.1',7),(2,'http://www.localhost.com/phpmyadmin',1286608782,'127.0.0.1',1),(3,'http://skin.zoosper.com/admin/trim',1293918570,'220.244.123.85',1),(4,'http://zoosper.com/q/Codefight-CMS',1295045500,'60.241.160.134',1),(5,'http://www.kqzyfj.com/click-4006920-10854117?sid=ltat',1352892850,'127.0.0.1',0);
/*!40000 ALTER TABLE `cf_trim` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cf_user`
--

DROP TABLE IF EXISTS `cf_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cf_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `active` char(1) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(34) NOT NULL DEFAULT '',
  `firstname` varchar(100) NOT NULL DEFAULT '',
  `lastname` varchar(100) NOT NULL DEFAULT '',
  `group_id` int(11) NOT NULL DEFAULT '0',
  `is_admin` int(11) NOT NULL DEFAULT '0',
  `is_author` int(1) NOT NULL DEFAULT '0',
  `profile_link` varchar(255) DEFAULT NULL,
  `profile` text,
  `photo_small` varchar(255) DEFAULT NULL,
  `photo_large` varchar(255) DEFAULT NULL,
  `intro` text,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cf_user`
--

LOCK TABLES `cf_user` WRITE;
/*!40000 ALTER TABLE `cf_user` DISABLE KEYS */;
INSERT INTO `cf_user` VALUES (11,'1','test@test.com',NULL,'098f6bcd4621d373cade4e832627b4f6','Damodar','Bashyal',1,1,1,'https://plus.google.com/103583381097797606705','<p>Damodar is a open source web developer who likes to provide web tools for FREE.</p>',NULL,NULL,NULL),(46,'1','author@test.com',NULL,'098f6bcd4621d373cade4e832627b4f6','Author','Author',4,1,1,NULL,NULL,NULL,NULL,NULL),(47,'1','notauthor@test.com',NULL,'test','Not','Author',0,0,0,NULL,NULL,NULL,NULL,NULL),(48,'2','cancelleduser@test.com',NULL,'098f6bcd4621d373cade4e832627b4f6','Cancelled','User',2,0,0,'','<p>This is cancelled user\'s profile :)</p>',NULL,NULL,NULL);
/*!40000 ALTER TABLE `cf_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cf_websites`
--

DROP TABLE IF EXISTS `cf_websites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cf_websites` (
  `websites_id` int(11) NOT NULL AUTO_INCREMENT,
  `websites_name` varchar(255) DEFAULT NULL,
  `websites_url` varchar(255) NOT NULL,
  `websites_status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`websites_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cf_websites`
--

LOCK TABLES `cf_websites` WRITE;
/*!40000 ALTER TABLE `cf_websites` DISABLE KEYS */;
INSERT INTO `cf_websites` VALUES (1,'Codefight CMS','http://local.codefight.org/',1),(2,'Tips-Tricks','http://local.learntipsandtricks.com/',1),(3,'Zoosper','http://local.zoosper.com/',1),(4,'Coupon Gift Deals','http://local.coupongiftdeals.com/',1);
/*!40000 ALTER TABLE `cf_websites` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-10-03 22:48:28
