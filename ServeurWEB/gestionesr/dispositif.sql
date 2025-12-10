-- MySQL dump 10.13  Distrib 5.7.23, for Linux (x86_64)
--
-- Host: localhost    Database: easydose
-- ------------------------------------------------------
-- Server version	5.7.23-0ubuntu0.16.04.1

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
-- Table structure for table `dispositif`
--

DROP TABLE IF EXISTS `dispositif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dispositif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `denomination` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `num_salle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `num_serie` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `datemiseenservice` datetime DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `marque` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dispositif`
--

LOCK TABLES `dispositif` WRITE;
/*!40000 ALTER TABLE `dispositif` DISABLE KEYS */;
INSERT INTO `dispositif` VALUES (1,'Ingenuity CT','Salle 01','NOCTN193','0000-00-00 00:00:00','assets/images/NOCTN193.png','PHILLIPS'),(2,'CXDI Controller RF','Salle 02','CANON','0000-00-00 00:00:00','assets/images/CANON.jpg','CANON'),(3,'Selenia Dimensions','Salle 03','Selenia Dimensions 6000','0000-00-00 00:00:00','assets/images/hologic_selenia_dimension_8000.jpg','HOLOGIC'),(4,'Lorad Selenia','salle 04','Lorad','0000-00-00 00:00:00','assets/images/holoraddimension.jpeg','HOLOGIC'),(5,'Optima CT660','Salle 05','CT660',NULL,'assets/images/ge-optima-ct660-ct-scanner.jpg','GE Medical Systems'),(6,'DL','Salle 06','INCONNU',NULL,'assets/images/ge-optima-ct660-ct-scanner.jpg','INCONNU'),(7,'Optima CT540','Salle 06','CT540',NULL,'assets/images/CT540.JPG','GE Medical Systems');
/*!40000 ALTER TABLE `dispositif` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-20 18:47:09
