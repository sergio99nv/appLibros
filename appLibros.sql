CREATE DATABASE  IF NOT EXISTS `appLibros` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `appLibros`;
-- MySQL dump 10.13  Distrib 5.7.25, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: appLibros
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.37-MariaDB

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
  `adminId` int(11) NOT NULL,
  `fullName` varchar(1000) NOT NULL,
  `userName` varchar(500) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `userCreateId` int(11) NOT NULL DEFAULT '0',
  `createDate` date DEFAULT NULL,
  `updateDate` date DEFAULT NULL,
  `state` int(11) NOT NULL,
  PRIMARY KEY (`adminId`),
  UNIQUE KEY `userName_UNIQUE` (`userName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'pepe loquaz','pepe','1234',0,'0000-00-00',NULL,1);
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookCategories`
--

DROP TABLE IF EXISTS `bookCategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookCategories` (
  `bookCategoryId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `userCreateId` int(11) NOT NULL,
  `dateCreate` date DEFAULT NULL,
  `dateUpdate` date DEFAULT NULL,
  `state` int(11) DEFAULT '1',
  PRIMARY KEY (`bookCategoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookCategories`
--

LOCK TABLES `bookCategories` WRITE;
/*!40000 ALTER TABLE `bookCategories` DISABLE KEYS */;
INSERT INTO `bookCategories` VALUES (1,'comedia','tra',0,NULL,NULL,1),(2,'terror','tra',0,NULL,NULL,1),(3,'ciencia ficcion','tra',0,NULL,NULL,1),(4,'drama',NULL,0,NULL,NULL,1),(27,'drama',NULL,1,NULL,NULL,1),(28,'rosperous understood middletons in conviction an uncommo am or',NULL,1,NULL,NULL,1),(29,'c',NULL,1,NULL,NULL,1),(30,'d',NULL,1,NULL,NULL,1),(31,'c',NULL,1,NULL,NULL,1);
/*!40000 ALTER TABLE `bookCategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books` (
  `bookId` int(11) NOT NULL AUTO_INCREMENT,
  `bookCategoryId` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `author` varchar(1000) NOT NULL,
  `bookYear` date NOT NULL,
  `file` text NOT NULL,
  `cover` varchar(1000) DEFAULT NULL,
  `userCreateId` int(11) DEFAULT NULL,
  `date_create` date DEFAULT NULL,
  `dateUpdate` date DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`bookId`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (1,1,'d','fsd','fsd','2019-01-01','TEMP_FILE__PEPE__3463__2019_04_23__04_30_48.pdf','TEMP_FILE__PEPE__1019__2019_04_23__04_34_54.jpeg',NULL,NULL,NULL,1),(2,1,'xxx','xxx','xxx','2019-01-01','TEMP_FILE__PEPE__25411__2019_04_20__03_31_30.pdf','TEMP_FILE__PEPE__49837__2019_04_20__03_30_37.jpeg',NULL,NULL,NULL,1),(3,2,'dracula','blaj','bran','2019-01-01','TEMP_FILE__PEPE__29025__2019_04_20__03_37_39.pdf','TEMP_FILE__PEPE__7436__2019_04_20__03_37_44.jpeg',NULL,NULL,NULL,1),(4,2,'b','b','b','2019-01-01','TEMP_FILE__PEPE__44823__2019_04_20__03_42_03.pdf','TEMP_FILE__PEPE__43301__2019_04_20__03_42_10.png',NULL,NULL,NULL,1),(5,2,'el presente','re','el presente','2019-01-01','TEMP_FILE__PEPE__36997__2019_04_20__03_45_05.pdf','TEMP_FILE__PEPE__34770__2019_04_20__03_45_21.jpeg',NULL,NULL,NULL,1),(6,2,'sin mini','dasdads','sds','2019-01-01','TEMP_FILE__PEPE__7434__2019_04_20__03_45_39.pdf',NULL,NULL,NULL,NULL,1),(7,1,'das','dsa','das','2019-01-01','TEMP_FILE__PEPE__20296__2019_04_20__21_29_17.pdf',NULL,NULL,NULL,NULL,1),(8,1,'dsa','das','d','2019-01-01','TEMP_FILE__PEPE__31466__2019_04_20__21_33_28.pdf',NULL,NULL,NULL,NULL,1),(9,1,'dsa','dsa','das','2019-01-01','TEMP_FILE__PEPE__32957__2019_04_20__21_43_16.pdf',NULL,NULL,NULL,NULL,1),(10,1,'fsd','fsd','fsd','2019-01-01','TEMP_FILE__PEPE__48065__2019_04_20__21_52_17.pdf',NULL,NULL,NULL,NULL,1),(11,1,'fsd','fds','fsd','2019-01-01','TEMP_FILE__PEPE__19130__2019_04_20__22_50_23.pdf',NULL,NULL,NULL,NULL,1),(12,1,'f','fff','f','2019-01-01','TEMP_FILE__PEPE__13983__2019_04_20__22_51_23.pdf',NULL,NULL,NULL,NULL,1),(13,1,'fsd','fds','fds','2019-01-01','TEMP_FILE__PEPE__23445__2019_04_20__23_07_39.pdf',NULL,NULL,NULL,NULL,1),(14,1,'das','ff','dd','2019-01-01','TEMP_FILE__PEPE__30890__2019_04_20__23_09_31.pdf',NULL,NULL,NULL,NULL,1),(15,1,'fds','fsd','fsd','2019-01-01','TEMP_FILE__PEPE__38036__2019_04_20__23_15_52.pdf',NULL,NULL,NULL,NULL,1),(16,1,'asda','ads','das','2019-01-01','TEMP_FILE__PEPE__1129__2019_04_20__23_37_32.pdf',NULL,NULL,NULL,NULL,1),(17,1,'dsa','fff','dsa','2019-01-01','TEMP_FILE__PEPE__42446__2019_04_21__00_10_39.pdf',NULL,NULL,NULL,NULL,1),(18,1,'fdf','ff','fd','2019-01-01','TEMP_FILE__PEPE__24934__2019_04_21__00_13_03.pdf',NULL,NULL,NULL,NULL,1),(19,1,'dsd','gggg','dsd','2019-01-01','TEMP_FILE__PEPE__18594__2019_04_21__00_21_15.pdf','TEMP_FILE__PEPE__8048__2019_04_21__00_21_15.jpeg',NULL,NULL,NULL,1),(20,1,'fsd','fs','fsd','2019-01-01','TEMP_FILE__PEPE__44323__2019_04_21__00_26_13.pdf','TEMP_FILE__PEPE__17632__2019_04_21__00_26_13.jpeg',NULL,NULL,NULL,1),(21,1,'fds','fff','fds','2019-01-01','TEMP_FILE__PEPE__18023__2019_04_21__00_27_27.pdf','TEMP_FILE__PEPE__44304__2019_04_21__00_28_05.jpeg',NULL,NULL,NULL,1),(22,1,'dasd','dsa','dads','2019-01-01','TEMP_FILE__PEPE__796__2019_04_21__00_37_23.pdf',NULL,NULL,NULL,NULL,1),(23,1,'fdff','fsd','fds','2019-01-01','TEMP_FILE__PEPE__450__2019_04_21__00_56_40.pdf','TEMP_FILE__PEPE__21763__2019_04_21__00_56_22.jpeg',NULL,NULL,NULL,1),(24,1,'fsd','fsdfdsfsfsfsfs','fsd','2019-01-01','TEMP_FILE__PEPE__48794__2019_04_21__01_27_37.pdf',NULL,NULL,NULL,NULL,1),(25,1,'xzxZ','xZX','xz','2019-01-01','TEMP_FILE__PEPE__38992__2019_04_21__01_46_25.pdf',NULL,NULL,NULL,NULL,1),(26,1,'dadsadad','dasda','dasdas','2019-01-01','TEMP_FILE__PEPE__9432__2019_04_23__04_17_33.pdf','TEMP_FILE__PEPE__39964__2019_04_23__04_17_36.png',NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commentaries`
--

DROP TABLE IF EXISTS `commentaries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commentaries` (
  `commentaryId` int(11) NOT NULL AUTO_INCREMENT,
  `bookId` int(11) NOT NULL,
  `text` varchar(1000) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`commentaryId`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commentaries`
--

LOCK TABLES `commentaries` WRITE;
/*!40000 ALTER TABLE `commentaries` DISABLE KEYS */;
INSERT INTO `commentaries` VALUES (1,7,'ddd',1),(2,7,'ss',2),(3,7,'newCommentaryEvent',2),(4,7,'ddddsadadddsa\ndsa\na\nsd\n\ndasasd',2),(5,7,'cual es',2),(6,7,'d',2),(7,7,'xxxx',2),(8,11,'dddd',1),(9,15,'dsaddsadsadasdsad',1),(10,1,'ddddddddddddd',1),(11,2,'dasdaddaddadda\ndas\nda\nda\ndasssssssssssssssssss\ndsadsadaddadsdaddassssssssssssssssssssss',1),(12,2,'sss',1),(13,2,'s',1),(14,2,'sss',1),(15,2,'Los textos o «páginas wiki» tienen títulos únicos. Si se escribe el título de una página wiki en algún sitio de la wiki entre dobles corchetes ([[Título de la página]]), esta palabra se convierte en un «enlace web» a la página correspondiente. De este modo, en una página sobre «alpinismo» puede haber una palabra como «piolet» o «brújula» que esté marcada como palabra perteneciente a un título de página wiki. La mayor parte de las implementaciones de wikis indican en el localizador de recursos uniforme (URL) de la página el propio título de la página wiki (en Wikipedia, ocurre así: <https://es.wikipedia.org/wiki/Alpinismo> es el URL de la página wiki Alpinismo), lo que facilita el uso y la aplicación general del enlace fuera del propio sitio web. Además, esto permite formar en muchas ocasiones una coherencia terminológica, y genera una ordenación natural del contenido.',1),(16,4,'sssshola',1),(17,4,'dddd',1),(18,4,'dsads',1),(19,4,'dasdad',1),(20,4,'ccc',1),(21,4,'dddsss',1),(22,1,'ccc',1);
/*!40000 ALTER TABLE `commentaries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students` (
  `studentId` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(1000) NOT NULL,
  `lastName` varchar(1000) NOT NULL,
  `phoneNumber` varchar(30) NOT NULL,
  `email` varchar(350) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `dateCreate` date DEFAULT NULL,
  `dateUpdate` date DEFAULT NULL,
  `state` int(11) DEFAULT '1',
  PRIMARY KEY (`studentId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (1,'pepe','jorge','97740212','sergio99nv@gmail.com','1234',NULL,NULL,1),(2,'s','s','s','s','sss',NULL,NULL,1),(3,'peter','peter','9806666','peter@gmail.com','1234',NULL,NULL,1),(4,'dsa','das','dsa','da','dsa',NULL,NULL,1),(5,'dd','d','d','d','d',NULL,NULL,1),(6,'dd','dd','d','d','d',NULL,NULL,1),(7,'pepe','1234','1234','pepe@gmail.com','1234',NULL,NULL,1),(8,'hola','hola','dsadsa','dsad@gmai.com','2222',NULL,NULL,1);
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `videos`
--

DROP TABLE IF EXISTS `videos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `videos` (
  `videoId` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(500) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `bookCategoryId` int(11) NOT NULL,
  `userCreateId` int(11) DEFAULT NULL,
  `date_create` date DEFAULT NULL,
  `dateUpdate` date DEFAULT NULL,
  `state` int(11) DEFAULT '1',
  PRIMARY KEY (`videoId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `videos`
--

LOCK TABLES `videos` WRITE;
/*!40000 ALTER TABLE `videos` DISABLE KEYS */;
INSERT INTO `videos` VALUES (1,'lZ-Qlk8Ax40',NULL,1,NULL,NULL,NULL,1),(2,'url',NULL,1,NULL,NULL,NULL,1),(3,'21vHyAmSq-Q',NULL,1,NULL,NULL,NULL,1),(4,'1lyu1KKwC74',NULL,1,NULL,NULL,NULL,1),(5,'lOO8FDLlrLo',NULL,1,NULL,NULL,NULL,1),(6,'Q0oIoR9mLwc',NULL,1,NULL,NULL,NULL,1),(7,'Za_5uHe9J30',NULL,2,NULL,NULL,NULL,1),(8,'7IrmATZ4dkM',NULL,28,NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `videos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-28 21:02:48
