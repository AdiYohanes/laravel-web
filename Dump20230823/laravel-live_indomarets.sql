-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: laravel-live
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `indomarets`
--

DROP TABLE IF EXISTS `indomarets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `indomarets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `userName` varchar(255) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `indomarets`
--

LOCK TABLES `indomarets` WRITE;
/*!40000 ALTER TABLE `indomarets` DISABLE KEYS */;
INSERT INTO `indomarets` VALUES (1,'adad','adi@gmail.com',NULL,NULL),(2,'asd','adi@rocket.com',NULL,NULL),(3,'asd','asd@asd.jk','2023-08-22 11:41:00','2023-08-22 11:41:00'),(4,'apa','apaiya@gmail.com','2023-08-22 11:41:19','2023-08-22 11:41:19'),(5,'ad','ad@ad.lol','2023-08-22 11:41:56','2023-08-22 11:41:56'),(6,'11','11@ad.lol','2023-08-22 11:42:42','2023-08-22 11:42:42'),(7,'asd','asd@wwww.lol','2023-08-22 11:46:18','2023-08-22 11:46:18'),(8,'akuaku','aku@123.com','2023-08-22 12:03:55','2023-08-22 12:03:55'),(9,'qwe','qwe@qwe.qwe','2023-08-22 12:04:22','2023-08-22 12:04:22'),(11,'111','11z3@111','2023-08-22 12:08:13','2023-08-22 12:08:13');
/*!40000 ALTER TABLE `indomarets` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-08-23 13:28:51
