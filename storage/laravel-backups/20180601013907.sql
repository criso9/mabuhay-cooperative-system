-- MySQL dump 10.16  Distrib 10.1.13-MariaDB, for Win32 (AMD64)
--
-- Host: 127.0.0.1    Database: mabuhay_db
-- ------------------------------------------------------
-- Server version	10.1.13-MariaDB

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
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from` datetime NOT NULL,
  `to` datetime NOT NULL,
  `added_by` bigint(20) unsigned NOT NULL,
  `removed_by` bigint(20) unsigned NOT NULL,
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,8,'active','2014-05-21 17:23:17','2018-04-21 17:23:17',1,0,NULL,'2018-04-21 09:23:17','2018-04-21 09:23:17'),(2,5,'active','2014-05-21 17:23:33','2018-04-21 17:23:33',1,0,NULL,'2018-04-21 09:23:33','2018-04-21 09:23:33');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `announcements`
--

DROP TABLE IF EXISTS `announcements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `announcements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_date` datetime NOT NULL,
  `details` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcements`
--

LOCK TABLES `announcements` WRITE;
/*!40000 ALTER TABLE `announcements` DISABLE KEYS */;
INSERT INTO `announcements` VALUES (1,'2018-05-26 00:00:00','checking if working',7,7,'2018-05-25 15:42:00','2018-05-26 15:58:33'),(3,'2018-06-07 00:00:00','fsdfds',8,7,'2018-05-26 07:41:26','2018-05-26 09:34:17');
/*!40000 ALTER TABLE `announcements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `business_incomes`
--

DROP TABLE IF EXISTS `business_incomes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `business_incomes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `business_id` bigint(20) unsigned NOT NULL,
  `amount` double(8,2) NOT NULL,
  `profit` double(8,2) NOT NULL DEFAULT '0.00',
  `date_paid` datetime NOT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `business_incomes`
--

LOCK TABLES `business_incomes` WRITE;
/*!40000 ALTER TABLE `business_incomes` DISABLE KEYS */;
INSERT INTO `business_incomes` VALUES (1,1,100.00,300.00,'2018-05-31 00:00:00','8','2018-05-30 18:46:48','2018-05-30 18:46:48'),(2,1,50.00,50.00,'2018-05-31 00:00:00','8','2018-05-30 18:47:58','2018-05-30 18:47:58'),(3,2,400.00,0.00,'2018-05-31 00:00:00','8','2018-05-30 18:48:38','2018-05-30 18:48:38'),(5,2,100.00,0.00,'2018-05-31 00:00:00','8','2018-05-30 18:49:41','2018-05-30 18:49:41'),(6,2,100.00,100.00,'2018-05-31 00:00:00','8','2018-05-30 18:50:01','2018-05-30 18:50:01');
/*!40000 ALTER TABLE `business_incomes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `businesses`
--

DROP TABLE IF EXISTS `businesses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `businesses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capital` double(8,2) NOT NULL,
  `income` double(8,2) DEFAULT NULL,
  `profit` double(8,2) DEFAULT NULL,
  `date_started` date NOT NULL,
  `added_by` bigint(20) unsigned NOT NULL,
  `date_ended` date DEFAULT NULL,
  `removed_by` bigint(20) unsigned DEFAULT NULL,
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `businesses`
--

LOCK TABLES `businesses` WRITE;
/*!40000 ALTER TABLE `businesses` DISABLE KEYS */;
INSERT INTO `businesses` VALUES (1,'Computer Shop','piso net','Active',1000.00,1350.00,350.00,'2018-05-31',5,NULL,NULL,NULL,'2018-05-30 17:27:39','2018-05-30 18:47:58'),(2,'Palayan','Pilapil','Active',500.00,600.00,100.00,'2018-05-31',5,NULL,NULL,NULL,'2018-05-30 17:32:16','2018-05-30 18:50:01'),(3,'Palayan','Pilapil','Active',500.00,NULL,NULL,'2018-05-31',5,NULL,NULL,NULL,'2018-05-30 17:32:16','2018-05-30 17:32:16'),(4,'test','vljv','Active',9875.00,NULL,NULL,'2018-05-31',5,NULL,NULL,NULL,'2018-05-30 17:32:31','2018-05-30 17:32:31');
/*!40000 ALTER TABLE `businesses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contributions`
--

DROP TABLE IF EXISTS `contributions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contributions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `payment_id` bigint(20) unsigned NOT NULL,
  `date` datetime NOT NULL,
  `amount` double(8,2) NOT NULL,
  `payment_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receipt_no` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_paid` datetime NOT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contributions`
--

LOCK TABLES `contributions` WRITE;
/*!40000 ALTER TABLE `contributions` DISABLE KEYS */;
INSERT INTO `contributions` VALUES (1,14,1,'2018-04-16 09:58:15',200.00,'Cash','04162018-09575617','2018-04-16 09:55:00','7','2018-04-16 01:58:15','2018-04-16 01:58:15'),(2,9,1,'2018-04-16 10:13:29',250.00,'Cash','04162018-10131832','2018-04-16 10:13:00','7','2018-04-16 02:13:29','2018-04-16 02:13:29'),(3,14,1,'2018-05-16 10:13:45',150.00,'Cash','04162018-10133749','2018-04-16 10:13:00','7','2018-04-16 02:13:45','2018-04-16 02:13:45'),(4,14,1,'2018-04-16 10:43:07',100.00,'Palawan Express','04162018-10430098','2018-04-16 10:42:00','7','2018-04-16 02:43:07','2018-04-16 02:43:07'),(5,6,1,'2018-04-16 14:54:34',100.00,'Cash','04162018-14541625','2018-04-16 14:54:00','7','2018-04-16 06:54:34','2018-04-16 06:54:34'),(6,13,1,'2018-04-16 15:06:07',300.00,'Cash','04162018-15055257','2018-04-16 15:06:00','7','2018-04-16 07:06:07','2018-04-16 07:06:07'),(7,13,1,'2018-05-16 15:06:23',250.00,'Cash','04162018-15062068','2018-04-16 15:06:00','7','2018-04-16 07:06:23','2018-04-16 07:06:23'),(8,4,1,'2018-04-16 17:05:04',300.00,'Cash','04162018-17045699','2018-04-16 17:05:00','7','2018-04-16 09:05:04','2018-04-16 09:05:04'),(9,7,1,'2018-04-16 21:28:02',200.00,'Cash','04162018-21275257','2018-04-16 21:28:00','4','2018-04-16 13:28:02','2018-04-16 13:28:02'),(10,6,1,'2018-04-16 23:27:09',300.00,'Cash','04162018-23265090','2018-04-10 23:27:00','4','2018-04-16 15:27:09','2018-04-16 15:27:09'),(11,16,1,'2018-05-04 23:11:26',300.00,'Cash','05042018-23111822','2018-05-04 23:11:00','8','2018-05-04 15:11:26','2018-05-04 15:11:26'),(12,3,1,'2017-05-04 23:32:02',300.00,'Cash','05042018-23315201','2018-05-04 23:32:00','8','2018-05-04 15:32:02','2018-05-04 15:32:02'),(13,16,1,'2018-06-05 00:28:31',200.00,'Cash','05052018-00282217','2018-05-05 00:28:00','8','2018-05-04 16:28:31','2018-05-04 16:28:31'),(21,16,2,'2018-05-05 11:48:59',500.00,'Cash','05052018-11484397','2018-05-05 11:48:00','8','2018-05-05 03:48:59','2018-05-05 03:48:59'),(22,16,3,'2018-05-05 12:54:00',500.00,'Cash','05052018-11540413','2018-05-05 12:54:00','8','2018-05-05 03:54:10','2018-05-05 03:54:10'),(23,3,1,'2018-05-06 17:30:53',300.00,'Cash','05062018-17304165','2018-05-06 17:30:00','8','2018-05-06 09:30:53','2018-05-06 09:30:53'),(24,3,2,'2018-05-06 17:39:43',500.00,'Cash','05062018-17393536','2018-05-06 17:39:00','8','2018-05-06 09:39:43','2018-05-06 09:39:43'),(25,3,3,'2018-05-06 19:15:00',400.00,'Cash','05062018-18154455','2018-05-06 19:15:00','8','2018-05-06 10:15:54','2018-05-06 10:15:54'),(26,3,1,'2018-06-06 18:35:49',200.00,'Cash','05062018-18353918','2018-05-06 18:35:00','8','2018-05-06 10:35:49','2018-05-06 10:35:49'),(27,3,1,'2018-06-06 18:35:49',200.00,'Cash','05062018-18353918','2018-05-06 18:35:00','8','2018-05-06 10:35:49','2018-05-06 10:35:49'),(29,3,3,'2018-05-30 22:14:23',180.00,'Cash','05302018-22052323','2018-05-30 22:14:23','5','2018-05-30 14:14:23','2018-05-30 14:14:23'),(30,3,3,'2018-05-30 23:04:00',30.00,'Cash','05302018-23044039','2018-05-30 23:04:00','5','2018-05-30 15:04:50','2018-05-30 15:04:50'),(33,3,3,'2018-05-30 23:10:00',30.00,'Cash','05302018-23100068','2018-05-30 23:10:00','5','2018-05-30 15:10:09','2018-05-30 15:10:09'),(34,3,3,'2018-05-30 23:13:00',36.00,'Cash','05302018-23131052','2018-05-30 23:13:00','5','2018-05-30 15:13:19','2018-05-30 15:13:19'),(35,3,3,'2018-05-30 23:13:00',36.00,'Cash','05302018-23131052','2018-05-30 23:13:00','5','2018-05-30 15:13:27','2018-05-30 15:13:27'),(36,3,3,'2018-05-30 23:13:00',36.00,'Cash','05302018-23135018','2018-05-30 23:13:00','5','2018-05-30 15:13:57','2018-05-30 15:13:57'),(37,3,3,'2018-05-30 23:18:00',36.00,'Cash','05302018-23180347','2018-05-30 23:18:00','5','2018-05-30 15:18:12','2018-05-30 15:18:12'),(38,3,3,'2018-05-30 23:18:00',36.00,'Cash','05302018-23180347','2018-05-30 23:18:00','5','2018-05-30 15:18:28','2018-05-30 15:18:28'),(39,3,3,'2018-05-30 23:18:00',36.00,'Cash','05302018-23185254','2018-05-30 23:18:00','5','2018-05-30 15:18:59','2018-05-30 15:18:59'),(40,3,3,'2018-05-30 23:19:00',36.00,'Cash','05302018-23190779','2018-05-30 23:19:00','5','2018-05-30 15:19:13','2018-05-30 15:19:13'),(41,3,3,'2018-05-30 23:19:00',36.00,'Cash','05302018-23192199','2018-05-30 23:19:00','5','2018-05-30 15:19:33','2018-05-30 15:19:33'),(42,3,3,'2018-05-30 23:19:00',36.00,'Cash','05302018-23194848','2018-05-30 23:19:00','5','2018-05-30 15:19:56','2018-05-30 15:19:56'),(43,3,3,'2018-11-14 23:25:00',0.00,'Cash','11142018-23253860','2018-11-14 23:25:00','5','2018-11-14 15:26:02','2018-11-14 15:26:02'),(44,3,3,'2018-11-14 23:25:00',0.00,'Cash','11142018-23253860','2018-11-14 23:25:00','5','2018-11-14 15:27:03','2018-11-14 15:27:03'),(45,3,3,'2018-11-14 23:31:00',0.00,'Cash','11142018-23312932','2018-11-14 23:31:00','5','2018-11-14 15:32:05','2018-11-14 15:32:05'),(46,3,3,'2018-11-14 23:31:00',0.00,'Cash','11142018-23312932','2018-11-14 23:31:00','5','2018-11-14 15:32:55','2018-11-14 15:32:55'),(47,3,3,'2018-11-14 23:31:00',0.00,'Cash','11142018-23312932','2018-11-14 23:31:00','5','2018-11-14 15:33:03','2018-11-14 15:33:03'),(48,3,3,'2018-11-14 23:31:00',0.00,'Cash','11142018-23312932','2018-11-14 23:31:00','5','2018-11-14 15:33:42','2018-11-14 15:33:42'),(49,3,3,'2018-11-14 23:31:00',0.00,'Cash','11142018-23342807','2018-11-14 23:31:00','5','2018-11-14 15:34:31','2018-11-14 15:34:31'),(50,3,3,'2018-11-14 23:31:00',0.00,'Cash','11142018-23342807','2018-11-14 23:31:00','5','2018-11-14 15:36:14','2018-11-14 15:36:14'),(51,3,3,'2018-11-14 23:37:00',0.00,'Cash','11142018-23371257','2018-11-14 23:37:00','5','2018-11-14 15:37:20','2018-11-14 15:37:20'),(52,3,3,'2018-11-14 23:38:00',0.00,'Cash','11142018-23382786','2018-11-14 23:38:00','5','2018-11-14 15:38:34','2018-11-14 15:38:34'),(53,3,3,'2018-11-14 23:39:00',0.00,'Cash','11142018-23391844','2018-11-14 23:39:00','5','2018-11-14 15:39:26','2018-11-14 15:39:26'),(54,3,3,'2018-05-31 12:12:00',30.00,'Cash','05312018-12121031','2018-05-31 12:12:00','5','2018-05-31 04:12:16','2018-05-31 04:12:16');
/*!40000 ALTER TABLE `contributions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cooperatives`
--

DROP TABLE IF EXISTS `cooperatives`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cooperatives` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `coop_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mission` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vision` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_founded` date NOT NULL,
  `mem_int` decimal(5,2) NOT NULL,
  `nonmem_int` decimal(5,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cooperatives`
--

LOCK TABLES `cooperatives` WRITE;
/*!40000 ALTER TABLE `cooperatives` DISABLE KEYS */;
INSERT INTO `cooperatives` VALUES (1,'mabuhay','logo/logo-20180421-171645.png','icon/icon-20180414-231128.ico','Test','tEST','2014-05-05',0.02,0.10,NULL,'2018-04-21 09:16:45');
/*!40000 ALTER TABLE `cooperatives` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files_type`
--

DROP TABLE IF EXISTS `files_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files_type`
--

LOCK TABLES `files_type` WRITE;
/*!40000 ALTER TABLE `files_type` DISABLE KEYS */;
INSERT INTO `files_type` VALUES (1,'policies',NULL,NULL),(2,'minutes',NULL,NULL),(3,'attendance',NULL,NULL),(4,'others',NULL,NULL);
/*!40000 ALTER TABLE `files_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files_uploaded`
--

DROP TABLE IF EXISTS `files_uploaded`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files_uploaded` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` bigint(20) unsigned NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `orig_file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `added_by` bigint(20) unsigned NOT NULL,
  `added_at` datetime NOT NULL,
  `removed_by` bigint(20) unsigned DEFAULT NULL,
  `removed_at` datetime DEFAULT NULL,
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files_uploaded`
--

LOCK TABLES `files_uploaded` WRITE;
/*!40000 ALTER TABLE `files_uploaded` DISABLE KEYS */;
INSERT INTO `files_uploaded` VALUES (1,3,'active','COP-BTIT.docx','3-20180415-181630-COP-BTIT.docx','uploads/documents/3-20180415-181630-COP-BTIT.docx',1,'2018-04-15 18:16:30',NULL,NULL,NULL,'2018-04-15 10:16:30','2018-04-15 10:16:30'),(2,3,'active','COP.docx','3-20180415-181915-COP.docx','uploads/documents/3-20180415-181915-COP.docx',1,'2018-04-15 18:19:15',NULL,NULL,NULL,'2018-04-15 10:19:15','2018-04-15 10:19:15'),(5,1,'active','PrefixAlgorithm.doc','1-20180504-225859-PrefixAlgorithm.doc','uploads/documents/1-20180504-225859-PrefixAlgorithm.doc',1,'2018-05-04 22:58:59',NULL,NULL,NULL,'2018-05-04 14:58:59','2018-05-04 14:58:59');
/*!40000 ALTER TABLE `files_uploaded` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images_type`
--

DROP TABLE IF EXISTS `images_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images_type`
--

LOCK TABLES `images_type` WRITE;
/*!40000 ALTER TABLE `images_type` DISABLE KEYS */;
INSERT INTO `images_type` VALUES (1,'carousel',NULL,NULL),(2,'about_us',NULL,NULL),(3,'services',NULL,NULL);
/*!40000 ALTER TABLE `images_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images_uploaded`
--

DROP TABLE IF EXISTS `images_uploaded`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images_uploaded` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` bigint(20) unsigned NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `added_by` bigint(20) unsigned NOT NULL,
  `added_at` datetime NOT NULL,
  `removed_by` bigint(20) unsigned DEFAULT NULL,
  `removed_at` datetime DEFAULT NULL,
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images_uploaded`
--

LOCK TABLES `images_uploaded` WRITE;
/*!40000 ALTER TABLE `images_uploaded` DISABLE KEYS */;
INSERT INTO `images_uploaded` VALUES (17,1,'inactive','uploads/carousel/carousel-20180415-151201-MBNHS.jpg','/test',1,'2018-04-15 15:12:01',1,'2018-04-15 16:13:34','hgfh','2018-04-15 07:12:01','2018-04-15 08:13:34'),(18,1,'inactive','uploads/carousel/carousel-20180415-151256-MBNHS2.jpg','/register',1,'2018-04-15 15:12:56',1,'2018-04-15 16:14:01','rtret','2018-04-15 07:12:56','2018-04-15 08:14:01'),(19,1,'inactive','uploads/carousel/carousel-20180415-151256-na.png','/register',1,'2018-04-15 15:12:56',1,'2018-04-15 15:13:13','fdgdzf','2018-04-15 07:12:56','2018-04-15 07:13:13'),(20,1,'inactive','uploads/carousel/carousel-20180415-161648-bmember2.jpg','/about',1,'2018-04-15 16:16:49',1,'2018-04-17 01:05:32','ggdf','2018-04-15 08:16:49','2018-04-16 17:05:32'),(21,1,'inactive','uploads/carousel/carousel-20180415-161712-cashcash.png','/services',1,'2018-04-15 16:17:12',1,'2018-04-17 01:05:37','fgfd','2018-04-15 08:17:12','2018-04-16 17:05:37'),(22,1,'inactive','uploads/carousel/carousel-20180415-161712-motmot.png','/services',1,'2018-04-15 16:17:12',1,'2018-04-17 01:05:47','fdgfdg','2018-04-15 08:17:12','2018-04-16 17:05:47'),(23,1,'inactive','uploads/carousel/carousel-20180416-235815-MBNHS.jpg','/login',4,'2018-04-16 23:58:15',1,'2018-04-17 01:05:42','fgfdg','2018-04-16 15:58:15','2018-04-16 17:05:42'),(24,1,'active','uploads/carousel/carousel-20180417-010834-MBNHS (1).JPG','/register',1,'2018-04-17 01:08:34',NULL,NULL,NULL,'2018-04-16 17:08:34','2018-04-16 17:08:34'),(25,1,'active','uploads/carousel/carousel-20180417-010903-cascash.JPG','/services',1,'2018-04-17 01:09:03',NULL,NULL,NULL,'2018-04-16 17:09:03','2018-04-16 17:09:03'),(26,1,'active','uploads/carousel/carousel-20180417-010903-motmot2.JPG','/services',1,'2018-04-17 01:09:03',NULL,NULL,NULL,'2018-04-16 17:09:03','2018-04-16 17:09:03');
/*!40000 ALTER TABLE `images_uploaded` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `interest`
--

DROP TABLE IF EXISTS `interest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `interest` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actual_value` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `interest`
--

LOCK TABLES `interest` WRITE;
/*!40000 ALTER TABLE `interest` DISABLE KEYS */;
INSERT INTO `interest` VALUES (1,'Member','2','0.02',NULL,NULL),(2,'Non-member','10','',NULL,NULL),(3,'Share Capital','3','0.03',NULL,NULL);
/*!40000 ALTER TABLE `interest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loan_payments`
--

DROP TABLE IF EXISTS `loan_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loan_payments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `interest_amount` double(8,2) DEFAULT NULL,
  `sharecap_amount` double(8,2) DEFAULT NULL,
  `date_paid` datetime NOT NULL,
  `payment_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receipt_no` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loan_payments`
--

LOCK TABLES `loan_payments` WRITE;
/*!40000 ALTER TABLE `loan_payments` DISABLE KEYS */;
INSERT INTO `loan_payments` VALUES (1,'20183105-01031808-3',0.00,1026.51,NULL,'2018-05-31 01:23:00','Cash','05312018-01191945','5','2018-05-30 17:23:24','2018-05-30 17:23:24'),(2,'20183105-01031808-3',0.00,997.19,NULL,'2018-04-30 02:07:00','Cash','05312018-02065566','8','2018-05-30 18:07:04','2018-05-30 18:07:04'),(3,'20183105-01031808-3',31.31,968.69,NULL,'2018-05-31 02:08:00','Cash','05312018-02081945','8','2018-05-30 18:08:26','2018-05-30 18:08:26'),(4,'20183105-01031808-3',8.98,941.02,NULL,'2018-05-31 11:29:00','Cash','05312018-11250221','8','2018-05-31 03:29:14','2018-05-31 03:29:14'),(5,'20183105-01031808-3',8.98,941.02,NULL,'2018-05-31 11:29:00','Cash','05312018-11334675','8','2018-05-31 03:39:00','2018-05-31 03:39:00'),(6,'20183105-01031808-3',8.98,941.02,NULL,'2018-05-31 11:29:00','Cash','05312018-11334675','8','2018-05-31 03:39:13','2018-05-31 03:39:13'),(7,'20183105-01031808-3',8.98,941.02,NULL,'2018-05-31 11:29:00','Cash','05312018-11334675','8','2018-05-31 03:39:20','2018-05-31 03:39:20'),(8,'20183105-01031808-3',8.98,941.02,NULL,'2018-05-31 11:29:00','Cash','05312018-11334675','8','2018-05-31 03:39:34','2018-05-31 03:39:34'),(9,'20183105-01031808-3',8.98,941.02,NULL,'2018-05-31 11:29:00','Cash','05312018-11334675','8','2018-05-31 03:39:51','2018-05-31 03:39:51'),(10,'20183105-01031808-3',8.98,941.02,NULL,'2018-05-31 11:29:00','Cash','05312018-11395460','8','2018-05-31 03:39:56','2018-05-31 03:39:56'),(11,'20183105-01031808-3',8.98,941.02,NULL,'2018-05-31 11:29:00','Cash','05312018-11395460','8','2018-05-31 03:45:20','2018-05-31 03:45:20'),(12,'20183105-01031808-3',8.98,941.02,NULL,'2018-05-31 11:29:00','Cash','05312018-11395460','8','2018-05-31 03:45:37','2018-05-31 03:45:37'),(13,'20183105-01031808-3',8.98,941.02,NULL,'2018-05-31 11:29:00','Cash','05312018-11395460','8','2018-05-31 03:45:47','2018-05-31 03:45:47'),(14,'20183105-01031808-3',8.98,941.02,NULL,'2018-05-31 11:29:00','Cash','05312018-11484146','8','2018-05-31 03:48:44','2018-05-31 03:48:44'),(15,'20183105-01031808-3',8.98,941.02,NULL,'2018-05-31 11:29:00','Cash','05312018-11512979','8','2018-05-31 03:52:17','2018-05-31 03:52:17'),(16,'20183105-01031808-3',8.98,941.02,NULL,'2018-05-31 11:29:00','Cash','05312018-11525862','8','2018-05-31 03:53:00','2018-05-31 03:53:00'),(17,'20183105-01031808-3',8.98,941.02,NULL,'2018-05-31 11:29:00','Cash','05312018-11525862','8','2018-05-31 03:53:17','2018-05-31 03:53:17'),(18,'20183105-01031808-3',8.98,941.02,NULL,'2018-05-31 11:29:00','Cash','05312018-11525862','8','2018-05-31 03:54:44','2018-05-31 03:54:44'),(19,'20183105-01031808-3',8.98,941.02,NULL,'2018-05-31 11:29:00','Cash','05312018-11525862','8','2018-05-31 03:55:24','2018-05-31 03:55:24'),(20,'20183105-01031808-3',8.98,941.02,NULL,'2018-05-31 11:29:00','Cash','05312018-11525862','8','2018-05-31 03:55:47','2018-05-31 03:55:47'),(21,'20183105-01031808-3',8.98,941.02,NULL,'2018-05-31 11:29:00','Cash','05312018-11525862','8','2018-05-31 03:57:37','2018-05-31 03:57:37'),(22,'20183105-01031808-3',8.98,941.02,NULL,'2018-05-31 11:29:00','Cash','05312018-11525862','8','2018-05-31 03:57:52','2018-05-31 03:57:52'),(23,'20183105-01031808-3',8.98,941.02,NULL,'2018-05-31 11:29:00','Cash','05312018-11525862','8','2018-05-31 03:59:24','2018-05-31 03:59:24'),(24,'20183105-01031808-3',0.82,430.18,NULL,'2018-05-31 12:05:00','Cash','05312018-12052122','8','2018-05-31 04:05:31','2018-05-31 04:05:31'),(25,'20183105-01031808-3',0.82,430.18,NULL,'2018-05-31 12:05:00','Cash','05312018-12054247','8','2018-05-31 04:06:06','2018-05-31 04:06:06'),(26,'20183105-01031808-3',94.40,405.60,NULL,'2018-05-31 12:10:00','Cash','05312018-12101421','8','2018-05-31 04:10:21','2018-05-31 04:10:21'),(27,'20183005-23524715-3',0.00,20.00,30.00,'2018-05-31 12:12:00','Cash','05312018-12121031','5','2018-05-31 04:12:16','2018-05-31 04:12:16');
/*!40000 ALTER TABLE `loan_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loans`
--

DROP TABLE IF EXISTS `loans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `transaction_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_applied` datetime NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loan_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount_loan` double(8,2) NOT NULL,
  `amount_repayable` double(8,2) NOT NULL DEFAULT '0.00',
  `amount_paid` double(8,2) NOT NULL DEFAULT '0.00',
  `interest_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `interest_amount_paid` double(8,2) NOT NULL DEFAULT '0.00',
  `scapital_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `scapital_amount_paid` double(8,2) NOT NULL DEFAULT '0.00',
  `remaining_balance` double(8,2) NOT NULL DEFAULT '0.00',
  `due_date` datetime DEFAULT NULL,
  `reviewed_by` bigint(20) unsigned DEFAULT NULL,
  `reviewed_at` datetime DEFAULT NULL,
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `loans_transaction_no_unique` (`transaction_no`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loans`
--

LOCK TABLES `loans` WRITE;
/*!40000 ALTER TABLE `loans` DISABLE KEYS */;
INSERT INTO `loans` VALUES (1,3,'20183005-23524715-3','Active','2018-05-30 23:52:55','a','Cash',1000.00,1300.00,0.00,120.00,20.00,180.00,30.00,1250.00,'2018-12-01 12:11:57',5,'2018-05-31 12:11:57',NULL,'2018-05-30 15:52:55','2018-05-31 04:12:16'),(2,3,'20183105-01031808-3','Active','2018-05-31 01:07:47','','Motor',49900.00,85828.00,297.97,35928.00,22137.73,0.00,0.00,63392.30,'2021-05-31 01:13:13',5,'2018-05-31 01:13:13',NULL,'2018-05-30 17:07:47','2018-05-31 04:10:21');
/*!40000 ALTER TABLE `loans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2018_01_24_141914_create_roles_table',1),(4,'2018_01_24_141915_create_roles_table',2),(5,'2018_27_01_000002_create_users_table',3),(10,'2018_02_04_061801_create_cooperatives_table',4),(18,'2018_27_01_000003_create_users_table',5),(19,'2018_02_19_162253_create_monthly_contribution_table',6),(20,'2018_02_19_061801_create_cooperatives_table',7),(21,'2018_02_26_162253_create_monthly_contribution_table',8),(22,'2018_02_26_162255_create_monthly_contribution_table',9),(23,'2018_02_26_162255_create_contributions_table',10),(24,'2018_03_05_225737_create_payments_table',10),(25,'2018_03_09_132841_create_interest_table',11),(26,'2018_02_26_162250_create_contributions_table',12),(27,'2018_03_10_173557_create_positions_table',13),(28,'2018_03_10_174938_create_officers_table',14),(29,'2018_27_01_000004_create_users_table',15),(30,'2018_03_10_174939_create_officers_table',16),(31,'2018_03_10_174940_create_officers_table',17),(32,'2018_03_10_174941_create_officers_table',18),(33,'2018_03_10_174942_create_officers_table',19),(34,'2018_03_10_173558_create_positions_table',20),(35,'2018_03_10_174943_create_officers_table',21),(36,'2018_03_10_174944_create_officers_table',22),(37,'2018_27_01_000005_create_users_table',23),(38,'2018_27_01_000006_create_users_table',24),(39,'2018_27_01_000007_create_users_table',25),(40,'2018_02_19_061802_create_cooperatives_table',26),(41,'2018_03_18_150659_create_users_table',27),(42,'2018_03_20_211356_create_admins_table',28),(43,'2018_03_18_150601_create_users_table',29),(44,'2018_03_28_220617_create_loans_table',30),(47,'2018_03_28_220618_create_loans_table',31),(48,'2018_04_09_182838_create_business_table',32),(49,'2018_04_11_220846_create_carousels_table',33),(50,'2018_02_19_061803_create_cooperatives_table',34),(51,'2018_04_11_220846_create_images_uploaded_table',35),(52,'2018_04_14_232824_create_images_type_table',36),(53,'2018_04_11_220847_create_images_uploaded_table',37),(54,'2018_04_11_220848_create_images_uploaded_table',38),(55,'2018_04_15_162249_create_files_uploaded_table',39),(56,'2018_04_15_162432_create_files_type_table',39),(57,'2018_04_15_162250_create_files_uploaded_table',40),(58,'2018_04_15_162251_create_files_uploaded_table',41),(59,'2018_03_28_220619_create_loans_table',42),(60,'2018_04_16_181212_create_loans_payment_table',43),(61,'2018_03_28_220620_create_loans_table',44),(62,'2018_04_16_181213_create_loans_payment_table',44),(63,'2018_05_10_203555_create_business_income_table',45),(64,'2018_04_09_182839_create_business_table',46),(65,'2017_01_23_115718_create_polls_table',47),(66,'2017_01_23_124357_create_options_table',47),(67,'2017_01_25_111721_create_votes_table',47),(68,'2018_05_25_225647_create_announcements_table',48),(69,'2018_05_25_225648_create_announcements_table',49),(70,'2018_05_25_225649_create_announcements_table',50),(71,'2018_03_28_220621_create_loans_table',51),(72,'2018_03_28_220622_create_loans_table',52),(73,'2018_03_28_220623_create_loans_table',53),(74,'2018_03_28_220624_create_loans_table',54),(75,'2018_03_28_220625_create_loans_table',55),(76,'2018_04_16_181214_create_loans_payment_table',56),(77,'2018_03_28_220626_create_loans_table',57),(78,'2018_05_10_203556_create_business_income_table',58);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `monthly_contribution`
--

DROP TABLE IF EXISTS `monthly_contribution`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `monthly_contribution` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `date` datetime NOT NULL,
  `amount` double(8,2) NOT NULL,
  `payment` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receipt_no` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `monthly_contribution`
--

LOCK TABLES `monthly_contribution` WRITE;
/*!40000 ALTER TABLE `monthly_contribution` DISABLE KEYS */;
INSERT INTO `monthly_contribution` VALUES (1,1,'2018-01-08 14:51:00',200.00,'Bank','123456','4','2018-02-26 06:52:29','2018-02-26 06:52:29'),(2,1,'2018-02-22 14:53:00',100.00,'Palawan Express','12345','4','2018-02-26 06:54:09','2018-02-26 06:54:09'),(3,2,'2018-01-09 14:55:00',200.00,'Palawan Express','745745','4','2018-02-26 06:56:02','2018-02-26 06:56:02'),(4,2,'2018-02-08 14:56:00',300.00,'Palawan Express','678678','4','2018-02-26 06:56:14','2018-02-26 06:56:14'),(5,2,'2018-03-27 18:37:00',500.00,'Bank','12345','4','2018-03-02 09:37:54','2018-03-02 09:37:54'),(6,1,'2018-03-05 23:45:00',250.00,'Bank','123','4','2018-03-05 14:45:24','2018-03-05 14:45:24'),(7,1,'2018-03-05 23:45:00',250.00,'Bank','123','4','2018-03-05 14:45:52','2018-03-05 14:45:52'),(8,2,'2018-04-19 23:47:00',200.00,'Bank','678','4','2018-03-05 14:47:42','2018-03-05 14:47:42');
/*!40000 ALTER TABLE `monthly_contribution` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `officers`
--

DROP TABLE IF EXISTS `officers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `officers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `position_id` bigint(20) unsigned NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from` datetime NOT NULL,
  `to` datetime NOT NULL,
  `added_by` bigint(20) unsigned NOT NULL,
  `removed_by` bigint(20) unsigned NOT NULL,
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `officers`
--

LOCK TABLES `officers` WRITE;
/*!40000 ALTER TABLE `officers` DISABLE KEYS */;
INSERT INTO `officers` VALUES (1,8,4,'active','2014-05-21 22:02:50','2018-04-21 22:02:50',1,0,NULL,'2018-04-21 14:02:50','2018-04-21 14:02:50'),(2,5,1,'inactive','2014-05-21 22:03:53','2018-04-21 22:04:20',1,1,'test','2018-04-21 14:03:53','2018-04-21 14:04:20'),(3,7,3,'active','2014-05-04 21:46:23','2018-05-04 21:46:23',1,0,NULL,'2018-05-04 13:46:23','2018-05-04 13:46:23'),(4,5,1,'active','2014-05-04 23:04:05','2018-05-04 23:04:05',1,0,NULL,'2018-05-04 15:04:05','2018-05-04 15:04:05');
/*!40000 ALTER TABLE `officers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `options`
--

DROP TABLE IF EXISTS `options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poll_id` int(10) unsigned NOT NULL,
  `votes` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `options_poll_id_foreign` (`poll_id`),
  CONSTRAINT `options_poll_id_foreign` FOREIGN KEY (`poll_id`) REFERENCES `polls` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `options`
--

LOCK TABLES `options` WRITE;
/*!40000 ALTER TABLE `options` DISABLE KEYS */;
INSERT INTO `options` VALUES (14,'pink',7,1,'2018-05-25 14:24:19','2018-05-25 14:43:06'),(16,'violet',7,0,'2018-05-25 14:42:10','2018-05-25 14:42:10'),(17,'good',8,0,'2018-05-25 14:46:04','2018-05-25 14:46:04'),(18,'okay',8,0,'2018-05-25 14:46:04','2018-05-25 14:46:04');
/*!40000 ALTER TABLE `options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `payment` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (1,'Monthly Contribution','2018-03-04 16:00:00','2018-03-04 16:00:00'),(2,'Damayan','2018-03-04 16:00:00','2018-03-04 16:00:00'),(3,'Share Capital','2018-03-04 16:00:00','2018-03-04 16:00:00');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `polls`
--

DROP TABLE IF EXISTS `polls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `polls` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `maxCheck` int(11) NOT NULL DEFAULT '1',
  `isClosed` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `polls`
--

LOCK TABLES `polls` WRITE;
/*!40000 ALTER TABLE `polls` DISABLE KEYS */;
INSERT INTO `polls` VALUES (7,'what is your favorite color?',1,0,'2018-05-25 14:24:19','2018-05-25 14:43:30'),(8,'how are you?',1,0,'2018-05-25 14:46:04','2018-05-25 14:46:04');
/*!40000 ALTER TABLE `polls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `positions`
--

DROP TABLE IF EXISTS `positions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `positions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `position` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `positions`
--

LOCK TABLES `positions` WRITE;
/*!40000 ALTER TABLE `positions` DISABLE KEYS */;
INSERT INTO `positions` VALUES (1,'President','individual',NULL,NULL),(2,'Vice President','individual',NULL,NULL),(3,'Secretary','individual',NULL,NULL),(4,'Treasurer','individual',NULL,NULL),(5,'Asst. Treasurer','individual',NULL,NULL),(6,'Auditor','individual',NULL,NULL),(7,'PIO','individual',NULL,NULL),(8,'Sgt./Arms','individual',NULL,NULL),(9,'Chairman of the Board','individual',NULL,NULL),(10,'Board Members','group',NULL,NULL);
/*!40000 ALTER TABLE `positions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_role_name_unique` (`role_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin',NULL,NULL),(2,'officer',NULL,NULL),(3,'member',NULL,NULL),(4,'root','2018-05-31 06:11:00','2018-05-31 06:11:00');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `f_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `l_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `m_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `b_date` date NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `civil_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `referral` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ref_relation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reviewed_by` bigint(20) unsigned DEFAULT NULL,
  `remarks_reviewed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reviewed_at` datetime DEFAULT NULL,
  `activated_at` datetime DEFAULT NULL,
  `changestat_by` bigint(20) unsigned DEFAULT NULL,
  `remarks_changestat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `changestat_at` datetime DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Carissa','Navarroza',NULL,'12345','taguig city','1995-11-15','female','single','carissa@gmail.com','$2y$10$wFlWt..sQj8XXNBJZVMUeeRtrC4xAgPK41mmGbEXo38SB0g51CxT6','marites','mother','user-female.png','active','4',NULL,NULL,NULL,'2018-03-24 01:34:36',NULL,NULL,NULL,'qSauNPrb28ojBrUhIts211IbOsrQgS9ZBSuIQhJr7y9CPEWst7it8Ul4jFPz',NULL,NULL),(2,'Claudine','Marfil',NULL,'12345','taguig city','1996-04-13','female','single','claud@gmail.com','$2y$10$NV6IEqxC0bNQhow5ggHYDu6zrhUKvTDhfxkokbsXXCv.JPQWTbnMi',NULL,NULL,'user-female.png','active','4',NULL,NULL,NULL,'2018-03-24 01:34:36',NULL,NULL,NULL,NULL,NULL,NULL),(3,'Donna','Vinculado',NULL,'0912345____','taguig city','1990-05-15','Male','Single','donna@gmail.com','$2y$10$E3nYBtYwLKMieeobZG8sQee1LWfFdkWYLSbPQTmSei.0sQyVnp/T2','marites','relative','pic-20180531-112319-13M253245a1Z-FA44.jpg','active','3',1,NULL,'2018-03-24 01:34:36','2018-03-24 01:34:36',NULL,NULL,NULL,'pz7nEnqY1SNDBJH7gaFSgweCIEtIF3E48kiDx7tVURWw0WitXAZHqPQfNZyj',NULL,'2018-05-31 03:23:19'),(4,'Mikko','Piccio',NULL,'09151178289','taguig city','1990-05-15','male','single','crisnavz.cn@gmail.com','$2y$10$LN6h3UiFswhtov55TDF0xuQEpsyHm81zP2oxFFgvu3luEjWYDoJxi',NULL,NULL,'user-male.png','active','3',1,NULL,'2018-03-24 01:34:36','2018-03-24 01:34:36',NULL,NULL,NULL,NULL,NULL,NULL),(5,'Reynaldo','Ranuco Sr.',NULL,'12345','taguig city','1990-05-15','male','single','reynaldo@gmail.com','$2y$10$NBF5gsl9LxoHWZ7fvxjmzeq587mPM86uJaz0oskQWwLSxiUEbgkni',NULL,NULL,'user-male.png','active','1',1,NULL,'2018-03-24 01:34:36','2018-03-24 01:34:36',NULL,NULL,NULL,'cy9c61HMBzeQf2emelP5JtqnJwUeZ3tLV3BZvfyNZr8nOmnLrLvwMDSfGquI',NULL,'2018-04-17 04:13:54'),(6,'Lucena','Piccio',NULL,'12345','taguig city','1990-05-15','female','single','lucena@gmail.com','$2y$10$3s1URjiwTv0z93G1vz9dgeIdoJ84BFcU.FI30oF55KyEEJxJdOYte',NULL,NULL,'user-female.png','active','3',1,NULL,'2018-03-24 01:34:36','2018-03-24 01:34:36',NULL,NULL,NULL,NULL,NULL,NULL),(7,'Maria Teresa','Navarroza',NULL,'12345','taguig city','1990-05-15','female','single','marites@gmail.com','$2y$10$QtTgG8GiXwhwS1RcCUZ.1uBX2KAPZYh8X19CycFDpyVE7pj27uAPS',NULL,NULL,'user-female.png','active','2',1,NULL,'2018-03-24 01:34:36','2018-03-24 01:34:36',NULL,NULL,NULL,'SouL2DZTjX4J7k1QC3Bfp3p0nNAOgbnCgE0ztepZUnjPjmGFH1Gt36jzCQeM',NULL,'2018-05-04 13:46:23'),(8,'Melodina','Vales',NULL,'09123456789','taguig city','1990-05-15','Female','Married','melodina@gmail.com','$2y$10$0QLmWf7HDZi7oD1ratpm1.WlKSMVpBk6YjPmsD/FMEDmtx8.18bRW',NULL,NULL,'pic-20180531-110154-3ae70bb248901a89587739992e4559d8-carpa-koi-icon-by-vexels.png','active','1',1,NULL,'2018-03-24 01:34:36','2018-03-24 01:34:36',NULL,NULL,NULL,'06qW9Tt7qtkTejwOICumpmWeNSRrB86mTv43UyJVqwxmVsIFNfdoiWBUAVxz',NULL,'2018-05-31 03:12:45'),(9,'Roserea','Vales',NULL,'12345','taguig city','1990-05-15','female','single','roserea@gmail.com','$2y$10$nLYIBchf9wXAtwCt7YvSyuXxH0lDr5oKNYgjct28jmCWxWQdZwF3K',NULL,NULL,'user-female.png','active','3',1,NULL,'2018-03-24 01:34:36','2018-03-24 01:34:36',NULL,NULL,NULL,'a9PIJfpyiwokuqDnM71vGtdcmnKS6QPwTVS6OcxwNEsDcvQKVyAluwNMcgcq',NULL,NULL),(10,'Virgenia','Lor',NULL,'12345','taguig city','1990-05-15','female','single','virgenia@gmail.com','$2y$10$pNsh9EoW7ms5fnJfvpKzcuJJ9e.PLGATmw7AwYiiEwWvQ43cMkppC',NULL,NULL,'user-female.png','active','3',1,NULL,'2018-03-24 01:34:36','2018-03-24 01:34:36',5,'test','2018-05-31 12:22:04',NULL,NULL,'2018-05-31 04:22:04'),(11,'Cindy','Navarroza',NULL,'12345','taguig city','1990-05-15','female','single','cindy@gmail.com','$2y$10$aUwZO.VJuWfHSaQTYRCz6uVnAfrcM9Tlw/aKjMOKamad/XYFvghXm',NULL,NULL,'user-female.png','active','3',1,NULL,'2018-03-24 01:34:36','2018-03-24 01:34:36',NULL,NULL,NULL,NULL,NULL,NULL),(12,'Nilo','Vales',NULL,'12345','taguig city','1990-05-15','male','single','nilo@gmail.com','$2y$10$xrceAefF6HohWzrlxE8M0.ES7OiE4p7Q2mfAR/XCdIqS.A0xKrhCq',NULL,NULL,'user-male.png','active','3',1,NULL,'2018-03-24 01:34:36','2018-03-24 01:34:36',NULL,NULL,NULL,'JBYlqVemuUetmLbF1woZGMCWXYi0TQ442KMeKVMQQGp1F2j0J0iOEeDDQmLD',NULL,NULL),(13,'Demetria','Ziganay',NULL,'12345','taguig city','1990-05-15','female','single','demetria@gmail.com','$2y$10$RO61A0VXehIyZDdV8w4D.OUgT2AorTeq.WXa3dfK8qAl./jJSJWtu',NULL,NULL,'user-female.png','active','3',1,NULL,'2018-03-24 01:34:36','2018-03-24 01:34:36',NULL,NULL,NULL,NULL,NULL,NULL),(14,'Florenciano','Zarco',NULL,'12345','taguig city','1990-05-15','male','single','florenciano@gmail.com','$2y$10$UJXAroWd9ZH6xV60SGmfkeBnEIUXI60j5DmMcCq/iEV381sh3S8o6',NULL,NULL,'user-male.png','active','3',1,NULL,'2018-03-24 01:34:36','2018-03-24 01:34:36',NULL,NULL,NULL,'1G7HvTodLIIXVLKvnlOWKmlN5owaVmFQTslDoptf1hRYN6fa8csC4vUaw00C',NULL,NULL),(15,'Rodolfo','Lamadora',NULL,'12345','taguig city','1990-05-15','male','single','rodolfo@gmail.com','$2y$10$n3Ekz.vlzuduGBRIWAuVIOinaprCP5GJK.M4D0c7SiKXY/0e4R0Ka',NULL,NULL,'user-male.png','active','3',1,NULL,'2018-03-24 01:34:36','2018-03-24 01:34:36',NULL,NULL,NULL,'w2kYdujBJVvPLhBXnXB049Tjl26dikAhTOdnjSAhYEDh5cYApEpi9br6qw6q',NULL,NULL),(16,'Miraflor','Balderama',NULL,'12345','taguig city','1990-05-15','female','single','miraflor@gmail.com','$2y$10$ee3SGoJDdelZVYzVAxm4VeL3a/Aw1DFlxMGAabzKO21XDp27CKLEi',NULL,NULL,'user-female.png','active','3',1,NULL,'2018-03-24 01:34:36','2018-03-24 01:34:36',1,'test','2018-06-01 01:26:17',NULL,NULL,'2018-05-31 17:26:17'),(17,'test','test',NULL,'9151178289','taguig','1990-05-15','Female','Single','test3@gmail.com','$2y$10$mMtCj290aTvmuKhQbNvW7u.n5Y7YIN4fTQvLs6V9hS80/wmgYzEh.','test','Family','user-female.png','pending','3',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-05-07 11:57:33','2018-05-07 11:57:33'),(18,'test4','test',NULL,'9151178289','taguig','2000-05-02','Male','Married','test2@gmail.com','$2y$10$Zig/FAnZAHnMqKhBr.ZgyOji9ry6an8wusOtnFDUS2aNLItQHwo9a','test','Family','user-male.png','pending','3',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-05-07 12:00:01','2018-05-07 12:00:01'),(20,'test400','test',NULL,'9151178289','taguig','2000-05-02','Male','Married','test123@gmail.com','$2y$10$V4UmpdMasoDeyouwbm7Xd.S/78VtQEqV8nlZvfsc1M0NJ1MXwUSuK','erew','Friends','user-male.png','pending','3',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-05-07 12:01:23','2018-05-07 12:01:23');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_02012018`
--

DROP TABLE IF EXISTS `users_02012018`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_02012018` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_02012018`
--

LOCK TABLES `users_02012018` WRITE;
/*!40000 ALTER TABLE `users_02012018` DISABLE KEYS */;
INSERT INTO `users_02012018` VALUES (1,'carissa','car@email.com','$2y$10$h9Qc9ALANJwoP8LfpAKIRePvCJlzShvB8JzsnS/3bN1O0V3EGjq4i','user-female.png','1',NULL,NULL,NULL),(2,'miko piccio','mpiccio@email.com','123','user-male.png','3',NULL,NULL,NULL),(3,'donna vinculado','dvinculado@email.com','123','user-female.png','3',NULL,NULL,NULL);
/*!40000 ALTER TABLE `users_02012018` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `votes`
--

DROP TABLE IF EXISTS `votes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `votes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `option_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `votes_option_id_foreign` (`option_id`),
  KEY `votes_user_id_foreign` (`user_id`),
  CONSTRAINT `votes_option_id_foreign` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`),
  CONSTRAINT `votes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `votes`
--

LOCK TABLES `votes` WRITE;
/*!40000 ALTER TABLE `votes` DISABLE KEYS */;
INSERT INTO `votes` VALUES (1,3,14,'2018-05-25 14:40:38','2018-05-25 14:40:38'),(2,12,14,'2018-05-25 14:44:19','2018-05-25 14:44:19'),(3,15,16,'2018-05-25 14:45:18','2018-05-25 14:45:18'),(4,8,16,'2018-05-25 14:53:35','2018-05-25 14:53:35'),(5,8,18,'2018-05-25 14:54:15','2018-05-25 14:54:15'),(6,5,16,'2018-05-30 17:35:31','2018-05-30 17:35:31'),(7,5,18,'2018-05-30 17:40:04','2018-05-30 17:40:04'),(8,3,18,'2018-05-30 17:47:35','2018-05-30 17:47:35');
/*!40000 ALTER TABLE `votes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-06-01  1:39:07
