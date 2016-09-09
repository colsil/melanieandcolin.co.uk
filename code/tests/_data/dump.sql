-- MySQL dump 10.13  Distrib 5.7.12, for osx10.11 (x86_64)
--
-- Host: localhost    Database: weddingsite
-- ------------------------------------------------------
-- Server version	5.7.12

/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE = @@TIME_ZONE */;
/*!40103 SET TIME_ZONE = '+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS = @@UNIQUE_CHECKS, UNIQUE_CHECKS = 0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS = 0 */;
/*!40101 SET @OLD_SQL_MODE = @@SQL_MODE, SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES = @@SQL_NOTES, SQL_NOTES = 0 */;

--
-- Table structure for table `guest`
--

DROP TABLE IF EXISTS `guest`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guest` (
  `id`                    INT(11)                          NOT NULL AUTO_INCREMENT,
  `name`                  VARCHAR(255)
                          COLLATE utf8_unicode_ci          NOT NULL,
  `surname`               VARCHAR(255)
                          COLLATE utf8_unicode_ci          NOT NULL,
  `email`                 VARCHAR(180)
                          COLLATE utf8_unicode_ci          NOT NULL,
  `password`              VARCHAR(255)
                          COLLATE utf8_unicode_ci          NOT NULL,
  `invitedday`            TINYINT(1)                       NOT NULL,
  `invitedevening`        TINYINT(1)                       NOT NULL,
  `attendingday`          TINYINT(1)                       NOT NULL,
  `attendingevening`      TINYINT(1)                       NOT NULL,
  `username`              VARCHAR(180)
                          COLLATE utf8_unicode_ci          NOT NULL,
  `username_canonical`    VARCHAR(180)
                          COLLATE utf8_unicode_ci          NOT NULL,
  `email_canonical`       VARCHAR(180)
                          COLLATE utf8_unicode_ci          NOT NULL,
  `enabled`               TINYINT(1)                       NOT NULL,
  `salt`                  VARCHAR(255)
                          COLLATE utf8_unicode_ci          NOT NULL,
  `last_login`            DATETIME                                  DEFAULT NULL,
  `locked`                TINYINT(1)                       NOT NULL,
  `expired`               TINYINT(1)                       NOT NULL,
  `expires_at`            DATETIME                                  DEFAULT NULL,
  `confirmation_token`    VARCHAR(255)
                          COLLATE utf8_unicode_ci                   DEFAULT NULL,
  `password_requested_at` DATETIME                                  DEFAULT NULL,
  `roles`                 LONGTEXT COLLATE utf8_unicode_ci NOT NULL
  COMMENT '(DC2Type:array)',
  `credentials_expired`   TINYINT(1)                       NOT NULL,
  `credentials_expire_at` DATETIME                                  DEFAULT NULL,
  `rsvp_received`         TINYINT(1)                       NOT NULL,
  `numPlusOnes`           INT(11)                          NOT NULL,
  `masterGuestId`         INT(11)                                   DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_ACB79A3592FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_ACB79A35A0D96FBF` (`email_canonical`),
  KEY `IDX_ACB79A355F382E98` (`masterGuestId`),
  CONSTRAINT `FK_ACB79A355F382E98` FOREIGN KEY (`masterGuestId`) REFERENCES `guest` (`id`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 7
  DEFAULT CHARSET = utf8
  COLLATE = utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guest`
--

LOCK TABLES `guest` WRITE;
/*!40000 ALTER TABLE `guest`
  DISABLE KEYS */;
INSERT INTO `guest` VALUES
  (3, 'Testy', 'McTestface', 'test@example.com', '$2y$13$WzOY7I/BA3MAUeO/Z/9hauea4R7bKGIxUib0Irdqtc1kGf0QQXQT2', 1, 1,
      1, 0, 'test@example.com', 'test@example.com', 'test@example.com', 1, '6z4hy7bc7e4ogwwk08ock4048oocoko',
                                                    '2016-09-09 15:38:08', 0, 0, NULL, NULL, NULL,
                                                    'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}', 0, NULL, 1, 0, NULL),
  (4, 'Another', 'Test', 'test2@example.com', '$2y$13$okml/vvqb23CT.wxg4KKGODZKhT9mLOnSvcXDsuhpE8Zzs6Cbd3ga', 0, 1, 0,
      0, 'test2@example.com', 'test2@example.com', 'test2@example.com', 0, 'lgtfc7zq9m8ow0co0w0sw44s8goggkk', NULL, 0,
                                                   0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 0, 0, NULL),
  (5, 'Geoff', 'Geofferson', 'geoff@example.com', '$2y$13$eXtRKkQelCkOVX2W9z9.ZOP7o1XrWtLFRrKRpUUu6x9Lx/0sQrECa', 1, 1,
      0, 0, 'geoff@example.com', 'geoff@example.com', 'geoff@example.com', 0, 'hfqfi5jmbagoss4o4swgs0oos8sk8ko', NULL,
                                                      0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 0, 0, NULL),
  (6, 'Geoffery', 'Geoff', 'geoff2@example.com', '$2y$13$bMJ9VFSav7uGgkmkdevTx.M03FtN2C8ppN6nYkRPHo930WYEU2/EW', 1, 1,
      0, 0, 'geoff2@example.com', 'geoff2@example.com', 'geoff2@example.com', 0, 'g2stzlavz00s4gsc0040c48c08so00k',
                                                        NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 0, 2, NULL);
/*!40000 ALTER TABLE `guest`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration_versions` (
  `version` VARCHAR(255)
            COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration_versions`
--

LOCK TABLES `migration_versions` WRITE;
/*!40000 ALTER TABLE `migration_versions`
  DISABLE KEYS */;
INSERT INTO `migration_versions` VALUES ('20160525223854'), ('20160613200631'), ('20160901192059'), ('20160909153010');
/*!40000 ALTER TABLE `migration_versions`
  ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE = @OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE = @OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS = @OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES = @OLD_SQL_NOTES */;

-- Dump completed on 2016-09-09 14:57:54
