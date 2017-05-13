-- MySQL dump 10.13  Distrib 5.7.18, for osx10.12 (x86_64)
--
-- Host: localhost    Database: weddingsite
-- ------------------------------------------------------
-- Server version	5.7.16

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
-- Table structure for table `guest`
--

DROP TABLE IF EXISTS `guest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `invitedday` tinyint(1) NOT NULL,
  `invitedevening` tinyint(1) NOT NULL,
  `attendingday` tinyint(1) NOT NULL,
  `attendingevening` tinyint(1) NOT NULL,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `rsvp_received` tinyint(1) NOT NULL,
  `masterGuestId` int(11) DEFAULT NULL,
  `vegetarian` tinyint(1) NOT NULL,
  `dietary_notes` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_ACB79A3592FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_ACB79A35A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_ACB79A35C05FB297` (`confirmation_token`),
  KEY `IDX_ACB79A355F382E98` (`masterGuestId`),
  CONSTRAINT `FK_ACB79A355F382E98` FOREIGN KEY (`masterGuestId`) REFERENCES `guest` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guest`
--

LOCK TABLES `guest` WRITE;
/*!40000 ALTER TABLE `guest` DISABLE KEYS */;
INSERT INTO `guest` VALUES (3,'Testy','McTestface','test@example.com','$2y$13$WzOY7I/BA3MAUeO/Z/9hauea4R7bKGIxUib0Irdqtc1kGf0QQXQT2',1,1,0,0,'test@example.com','test@example.com','test@example.com',1,'6z4hy7bc7e4ogwwk08ock4048oocoko','2017-04-27 12:27:19',NULL,NULL,'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}',1,NULL,0,'won\'t eat fishcakes'),(4,'Another','Test','test2@example.com','$2y$13$okml/vvqb23CT.wxg4KKGODZKhT9mLOnSvcXDsuhpE8Zzs6Cbd3ga',0,1,0,0,'test2@example.com','test2@example.com','test2@example.com',0,'lgtfc7zq9m8ow0co0w0sw44s8goggkk',NULL,NULL,NULL,'a:0:{}',0,NULL,0,''),(5,'Geoff','Geofferson','geoff@example.com','$2y$13$eXtRKkQelCkOVX2W9z9.ZOP7o1XrWtLFRrKRpUUu6x9Lx/0sQrECa',1,1,0,0,'geoff@example.com','geoff@example.com','geoff@example.com',0,'hfqfi5jmbagoss4o4swgs0oos8sk8ko',NULL,NULL,NULL,'a:0:{}',0,NULL,0,''),(6,'Geoffery','Geoff','geoff2@example.com','$2y$13$bMJ9VFSav7uGgkmkdevTx.M03FtN2C8ppN6nYkRPHo930WYEU2/EW',1,1,1,1,'geoff2@example.com','geoff2@example.com','geoff2@example.com',0,'g2stzlavz00s4gsc0040c48c08so00k',NULL,NULL,NULL,'a:0:{}',1,NULL,0,''),(7,'Melly','Mellyface','mellyface@example.com','$2y$13$1h.6SVfkB.ww2UcGtO3GvOl/1YoiC7pBMCsW81X0lfNtnksFmCQdq',1,1,0,0,'mellyface@example.com','mellyface@example.com','mellyface@example.com',0,'hk4h1dp7c9skk0gwgc44c040kskoww0',NULL,NULL,NULL,'a:0:{}',1,3,0,'Only eats snails'),(8,'flah','vaaca','flah@ascas.com','$2y$13$cpdjlGNSwOIz/rTkaF0kXuufeinA2maYs0mLfpz.Qn4LMB7F1Zl1.',1,0,0,0,'flah@ascas.com','flah@ascas.com','flah@ascas.com',0,NULL,NULL,NULL,NULL,'a:0:{}',0,NULL,0,'');
/*!40000 ALTER TABLE `guest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `guest_room`
--

DROP TABLE IF EXISTS `guest_room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guest_room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `guest_id` int(11) DEFAULT NULL,
  `number` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_56250CC69A4AA658` (`guest_id`),
  CONSTRAINT `FK_56250CC69A4AA658` FOREIGN KEY (`guest_id`) REFERENCES `guest` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guest_room`
--

LOCK TABLES `guest_room` WRITE;
/*!40000 ALTER TABLE `guest_room` DISABLE KEYS */;
INSERT INTO `guest_room` VALUES (8,'Single',3,1);
/*!40000 ALTER TABLE `guest_room` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration_versions`
--

LOCK TABLES `migration_versions` WRITE;
/*!40000 ALTER TABLE `migration_versions` DISABLE KEYS */;
INSERT INTO `migration_versions` VALUES ('20160525223854'),('20160613200631'),('20160901192059'),('20160909153010'),('20161023232820'),('20170112220234'),('20170402123243'),('20170404204742'),('20170421103530'),('20170427204904'),('20170428141618'),('20170513140342');
/*!40000 ALTER TABLE `migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `sess_id` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `sess_data` blob NOT NULL,
  `sess_time` int(10) unsigned NOT NULL,
  `sess_lifetime` int(11) NOT NULL,
  PRIMARY KEY (`sess_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-13 15:17:23
