# --------------------------------------------------------
# Host:                         localhost
# Server version:               5.0.95
# Server OS:                    redhat-linux-gnu
# HeidiSQL version:             6.0.0.3603
# Date/time:                    2013-11-13 11:24:12
# --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

# Dumping database structure for wivet
CREATE DATABASE IF NOT EXISTS `wivet` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `wivet`;


# Dumping structure for table wivet.pageVisits
CREATE TABLE IF NOT EXISTS `pageVisits` (
  `record` varchar(50) NOT NULL,
  `testcase` varchar(100) NOT NULL,
  `secreturi` varchar(100) NOT NULL,
  `noofaccess` int(50) NOT NULL default '1',
  `timefirstaccess` bigint(50) NOT NULL,
  `timelastaccess` bigint(50) NOT NULL,
  `useragent` varchar(200) NOT NULL,
  `ipaddress` varchar(25) NOT NULL,
  PRIMARY KEY  (`record`,`testcase`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

# Data exporting was unselected.


# Dumping structure for table wivet.scans
CREATE TABLE IF NOT EXISTS `scans` (
  `record` varchar(50) NOT NULL,
  `ipaddress` bigint(50) NOT NULL,
  `starttime` bigint(50) NOT NULL,
  PRIMARY KEY  (`record`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

# Data exporting was unselected.
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
