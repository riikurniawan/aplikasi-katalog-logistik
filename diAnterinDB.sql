-- MySQL dump 10.13  Distrib 8.0.32, for Linux (x86_64)
--
-- Host: localhost    Database: diAnterinDB
-- ------------------------------------------------------
-- Server version	8.0.32-0ubuntu0.20.04.2

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
-- Table structure for table `Admin`
--

DROP TABLE IF EXISTS `Admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `Admin` (
  `Name` varchar(100) NOT NULL,
  `Username` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(255) NOT NULL,
  PRIMARY KEY (`Username`),
  UNIQUE KEY `Username` (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Admin`
--

LOCK TABLES `Admin` WRITE;
/*!40000 ALTER TABLE `Admin` DISABLE KEYS */;
INSERT INTO `Admin` VALUES ('Ari Kurniawan','ari','12345');
/*!40000 ALTER TABLE `Admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Category`
--

DROP TABLE IF EXISTS `Category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `Category` (
  `Category_ID` char(5) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `Created_By` varchar(50) NOT NULL,
  PRIMARY KEY (`Category_ID`),
  KEY `Created_By` (`Created_By`),
  CONSTRAINT `Category_ibfk_1` FOREIGN KEY (`Created_By`) REFERENCES `Admin` (`Username`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Category`
--

LOCK TABLES `Category` WRITE;
/*!40000 ALTER TABLE `Category` DISABLE KEYS */;
/*!40000 ALTER TABLE `Category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Contact`
--

DROP TABLE IF EXISTS `Contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `Contact` (
  `Contact_ID` char(10) NOT NULL,
  `Visitor_ID` char(10) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Phone_Number` varchar(13) NOT NULL,
  `Message` text NOT NULL,
  `Created_At` datetime NOT NULL,
  PRIMARY KEY (`Contact_ID`),
  KEY `Visitor_ID` (`Visitor_ID`),
  CONSTRAINT `Contact_ibfk_1` FOREIGN KEY (`Visitor_ID`) REFERENCES `Visitor` (`Visitor_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Contact`
--

LOCK TABLES `Contact` WRITE;
/*!40000 ALTER TABLE `Contact` DISABLE KEYS */;
/*!40000 ALTER TABLE `Contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Download_Product`
--

DROP TABLE IF EXISTS `Download_Product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `Download_Product` (
  `Visitor_ID` char(10) NOT NULL,
  `Product_ID` char(5) NOT NULL,
  `Product_Name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  KEY `Visitor_ID` (`Visitor_ID`),
  KEY `Product_ID` (`Product_ID`),
  KEY `Download_Product_ibfk_3` (`Product_Name`,`Product_ID`),
  CONSTRAINT `Download_Product_ibfk_2` FOREIGN KEY (`Visitor_ID`) REFERENCES `Visitor` (`Visitor_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `Download_Product_ibfk_3` FOREIGN KEY (`Product_Name`, `Product_ID`) REFERENCES `Product` (`Name`, `Product_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Download_Product`
--

LOCK TABLES `Download_Product` WRITE;
/*!40000 ALTER TABLE `Download_Product` DISABLE KEYS */;
/*!40000 ALTER TABLE `Download_Product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Product`
--

DROP TABLE IF EXISTS `Product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `Product` (
  `Product_ID` char(5) NOT NULL,
  `Name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Description` text NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Is_Published` tinyint(1) NOT NULL,
  `Created_By` varchar(50) NOT NULL,
  PRIMARY KEY (`Product_ID`),
  UNIQUE KEY `Name` (`Name`),
  KEY `Created_By` (`Created_By`),
  CONSTRAINT `Product_ibfk_1` FOREIGN KEY (`Created_By`) REFERENCES `Admin` (`Username`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Product`
--

LOCK TABLES `Product` WRITE;
/*!40000 ALTER TABLE `Product` DISABLE KEYS */;
/*!40000 ALTER TABLE `Product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Product_Detail`
--

DROP TABLE IF EXISTS `Product_Detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `Product_Detail` (
  `Detail_ID` char(5) NOT NULL,
  `Category_ID` char(5) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Weight` varchar(10) NOT NULL,
  `Delivery_Area` varchar(100) NOT NULL,
  PRIMARY KEY (`Detail_ID`),
  KEY `Category_ID` (`Category_ID`),
  CONSTRAINT `Product_Detail_ibfk_1` FOREIGN KEY (`Detail_ID`) REFERENCES `Product` (`Product_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `Product_Detail_ibfk_2` FOREIGN KEY (`Category_ID`) REFERENCES `Category` (`Category_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Product_Detail`
--

LOCK TABLES `Product_Detail` WRITE;
/*!40000 ALTER TABLE `Product_Detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `Product_Detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Subscribe`
--

DROP TABLE IF EXISTS `Subscribe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `Subscribe` (
  `Email` varchar(100) NOT NULL,
  `Visitor_ID` char(10) NOT NULL,
  `Subscribe_At` datetime NOT NULL,
  PRIMARY KEY (`Email`),
  UNIQUE KEY `Email` (`Email`),
  KEY `Visitor_ID` (`Visitor_ID`),
  CONSTRAINT `Subscribe_ibfk_1` FOREIGN KEY (`Visitor_ID`) REFERENCES `Visitor` (`Visitor_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Subscribe`
--

LOCK TABLES `Subscribe` WRITE;
/*!40000 ALTER TABLE `Subscribe` DISABLE KEYS */;
/*!40000 ALTER TABLE `Subscribe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Visitor`
--

DROP TABLE IF EXISTS `Visitor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `Visitor` (
  `Visitor_ID` char(10) NOT NULL,
  `IP_Address` char(15) NOT NULL,
  `Request_At` datetime NOT NULL,
  PRIMARY KEY (`Visitor_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Visitor`
--

LOCK TABLES `Visitor` WRITE;
/*!40000 ALTER TABLE `Visitor` DISABLE KEYS */;
/*!40000 ALTER TABLE `Visitor` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-04-07  3:44:12
