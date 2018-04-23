-- MySQL dump 10.13  Distrib 5.5.55, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: phpcmsDB
-- ------------------------------------------------------
-- Server version	5.6.34

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL AUTO_INCREMENT,
  `cat_title` varchar(255) COLLATE ucs2_bin NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=ucs2 COLLATE=ucs2_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Bootstrap'),(2,'Google');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL AUTO_INCREMENT,
  `post_category_id` int(11) NOT NULL,
  `post_title` varchar(255) COLLATE ucs2_bin NOT NULL,
  `post_author` varchar(255) COLLATE ucs2_bin NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text COLLATE ucs2_bin NOT NULL,
  `post_content` text COLLATE ucs2_bin NOT NULL,
  `post_tags` varchar(255) COLLATE ucs2_bin NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(255) COLLATE ucs2_bin NOT NULL,
  `post_excerpt` text COLLATE ucs2_bin NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=ucs2 COLLATE=ucs2_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,1,'Motivation is a multi-level concept.','dgs','2018-04-14','','Motivation is a multi-level concept. Even the blinking of the brain requires motivation, not to mention the motivation to get involved in semi-annual projects. As the actions are invested in each other, so are the investments and motivations. The motivation to talk with a colleague is invested in the motivation to better understand the task that is invested in the motivation to qualitatively cope with the functional for which you are responsible, which in turn is part of the motivation in time and in due quality to release the product. Lower levels of motivation are necessary for the existence of the upper levels, but the upper levels also support the lower ones. For example, if you love the product, this gives you an extra reason to take care of the quality of the task, even if you do not like it. ','',4,'','Even the blinking of the brain requires motivation, not to mention the motivation to get involved in semi-annual projects. As the actions are invested in each other, so are the investments and motivations.'),(2,1,'Features and features of philosophy','dgs','2018-04-14','','Sociology - the science of the laws that determine the life and development of society. Sociology considers man as a member of the famous group inhabiting the same territory and unites solidarity goals and interests. But in view of the fact that the society represents the totality of the different individuals, each of whom, in turn, is very complete whole, sociology contains, as a necessary material for their conclusions, all the science of the human spirit, both individually and collective, Drawing on a wide basis of psychology, sociology, builds his house on the data history, political economy, statistics, comparative history of law, religion, institutions, and all the data that shows how people are grouped into politi RP G community how to develop views on the family, power, property, as the hostel has reached its present state.','',4,'','Drawing on a wide basis of psychology, sociology, builds his house on the data history, political economy, statistics, comparative history of law, religion, institutions, and all the data that shows how people are grouped into politi RP G community how to develop views on the family, power, property, as the hostel has reached its present state.');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(249) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `verified` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `resettable` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `roles_mask` int(10) unsigned NOT NULL DEFAULT '0',
  `registered` int(10) unsigned NOT NULL,
  `last_login` int(10) unsigned DEFAULT NULL,
  `force_logout` mediumint(7) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'root@devnull.org','$2y$10$OK7ZhnAClRUcXqDqEbnDNeN.NMFItZ2UJWEq4KIwxw1208heIcKJ.','root',0,1,1,262401,1523560920,1523721310,0),(2,'dgs@riskiii.com','$2y$10$moblc4IDaiQ0RBZZjgsrzegycL7xkNknP412X8RbOgTCdAFtQOBiG','dgs',0,1,1,262401,1523885087,NULL,0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_confirmations`
--

DROP TABLE IF EXISTS `users_confirmations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_confirmations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `email` varchar(249) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selector` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `selector` (`selector`),
  KEY `email_expires` (`email`,`expires`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_confirmations`
--

LOCK TABLES `users_confirmations` WRITE;
/*!40000 ALTER TABLE `users_confirmations` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_confirmations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_remembered`
--

DROP TABLE IF EXISTS `users_remembered`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_remembered` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(10) unsigned NOT NULL,
  `selector` varchar(24) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `selector` (`selector`),
  KEY `user` (`user`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_remembered`
--

LOCK TABLES `users_remembered` WRITE;
/*!40000 ALTER TABLE `users_remembered` DISABLE KEYS */;
INSERT INTO `users_remembered` VALUES (1,1,'5WTkkTaE7lCbHRoGHmG2Dwr5','$2y$10$svy/0yPJsFlphiimLRReheXY3Yf2K8BLWq1K8Xgtl.ZxlQvqtoxe6',1523647379),(2,1,'Zy-eemZXOlkTv_Z4UaZKjqE3','$2y$10$hLakdAGkDKO9.g2g/bzBmuCdd4CAHUFi0.eK9kaOLOJl06u2RAW6K',1523649225),(3,1,'x08A1TsK6F04vXJH1VmB-Zwn','$2y$10$cj3N72M7m99mF0Wlvyt8MOwFJ9Kb0AfcmMh7rOI2PO8cSK0DU1qCa',1523649888),(4,1,'IM8Mz3QjyQ-noWE25cULDm4b','$2y$10$HgPN.VHRxaUokceurbI5keS7.JQ5hOVSmmkWNn3zTCYwMsbBD2Aji',1523657094),(5,1,'F5OoJL-BR3c8TbnMiTSiCd7w','$2y$10$sBLhBw6lbeEooKyPx93.e.Qhsa3yzpdBh6NvXb5MBe05OdicJ4Inm',1523806047),(6,1,'gu2uWaxYvbDwcCq-Dmvh7HYh','$2y$10$tHloIep0K0FBQtcIbdM12.9y1N6a9/Cotxx8Pp/dsVqq5bAqaRKmu',1523807710);
/*!40000 ALTER TABLE `users_remembered` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_resets`
--

DROP TABLE IF EXISTS `users_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_resets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(10) unsigned NOT NULL,
  `selector` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `selector` (`selector`),
  KEY `user_expires` (`user`,`expires`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_resets`
--

LOCK TABLES `users_resets` WRITE;
/*!40000 ALTER TABLE `users_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_throttling`
--

DROP TABLE IF EXISTS `users_throttling`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_throttling` (
  `bucket` varchar(44) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `tokens` float unsigned NOT NULL,
  `replenished_at` int(10) unsigned NOT NULL,
  `expires_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`bucket`),
  KEY `expires_at` (`expires_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_throttling`
--

LOCK TABLES `users_throttling` WRITE;
/*!40000 ALTER TABLE `users_throttling` DISABLE KEYS */;
INSERT INTO `users_throttling` VALUES ('pdJwH9fiZd1WVgvQdTg5W2qMcBIZQrhvmQzxu6JzbTw',74,1523885087,1524425087),('at2zyHvMMQa8Dei0fnYHLJxECaq-qiM2E6EcDvkK8I4',4,1523885087,1524317087);
/*!40000 ALTER TABLE `users_throttling` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-16 13:34:33
