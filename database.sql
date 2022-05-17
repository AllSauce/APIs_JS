-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for sysdb
CREATE DATABASE IF NOT EXISTS `sysdb` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `sysdb`;

-- Dumping structure for table sysdb.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `CommentID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `Text` text COLLATE utf8_unicode_ci NOT NULL,
  `ResponseID` int(11) DEFAULT NULL,
  PRIMARY KEY (`CommentID`),
  KEY `FK_comments_users` (`UserID`),
  KEY `FK_comments_comments` (`ResponseID`),
  CONSTRAINT `FK_comments_comments` FOREIGN KEY (`ResponseID`) REFERENCES `comments` (`CommentID`),
  CONSTRAINT `FK_comments_users` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table sysdb.comments: ~0 rows (approximately)
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- Dumping structure for table sysdb.users
CREATE TABLE IF NOT EXISTS `users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `Hash` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table sysdb.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`UserID`, `Username`, `Hash`) VALUES
	(1, 'asd', '$2y$10$EioBtIe5bbAXKnipZ91i1uiDXfMSga/utTC5PjKh8sRuN52urpSme'),
	(2, 'uer', '$2y$10$JLkT5lf.8CB/IlUqnQCB4uIuI8hn9QCGv7h0QHbjpvMfg4O18ABiO');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
