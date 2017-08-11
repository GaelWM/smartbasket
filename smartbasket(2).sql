-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2017 at 05:17 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smartbasket`
--

-- --------------------------------------------------------

--
-- Table structure for table `sysfaq`
--

CREATE TABLE `sysfaq` (
  `FAQID` int(11) NOT NULL,
  `lstTopic` varchar(100) NOT NULL,
  `strTitle` varchar(100) NOT NULL,
  `strTags` varchar(100) NOT NULL,
  `txtFAQ` text NOT NULL,
  `intOrder` int(11) NOT NULL DEFAULT '0',
  `blnActive` tinyint(1) NOT NULL DEFAULT '1',
  `strLastUser` varchar(100) NOT NULL DEFAULT 'SYSTEM',
  `dtLastEdit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `syslog`
--

CREATE TABLE `syslog` (
  `LogID` int(11) NOT NULL,
  `dtLog` date NOT NULL,
  `strResult` varchar(255) NOT NULL,
  `txtArgs` text,
  `srlArgs` text,
  `srlSession` text,
  `strLastUser` varchar(50) NOT NULL DEFAULT 'System',
  `strLastEdit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `syslogin`
--

CREATE TABLE `syslogin` (
  `LoginID` int(11) NOT NULL,
  `strType` varchar(100) NOT NULL DEFAULT 'iAdmin',
  `strIP` varchar(20) NOT NULL,
  `strResult` varchar(100) NOT NULL DEFAULT '',
  `strUsername` varchar(100) NOT NULL,
  `strPassword` varchar(100) DEFAULT NULL,
  `strDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `syslogin`
--

INSERT INTO `syslogin` (`LoginID`, `strType`, `strIP`, `strResult`, `strUsername`, `strPassword`, `strDateTime`) VALUES
(1, '', '::1', 'Login successful', 'gael@overdrive.co.za', 'test', '2017-08-10 18:47:53'),
(2, '', '::1', 'Login successful', 'gael@overdrive.co.za', 'test', '2017-08-10 21:58:50'),
(3, '', '::1', 'Login successful', 'gael@overdrive.co.za', 'test', '2017-08-11 08:16:14');

-- --------------------------------------------------------

--
-- Table structure for table `sysmenulevel1`
--

CREATE TABLE `sysmenulevel1` (
  `MenuLevel1ID` int(11) NOT NULL,
  `strMenuLevel1` varchar(50) NOT NULL DEFAULT '- New -',
  `EN_strMenuLevel1` varchar(50) NOT NULL DEFAULT '- New -' COMMENT 'EN',
  `AF_strMenuLevel1` varchar(50) NOT NULL DEFAULT '- Nuut -' COMMENT 'AF',
  `FR_strMenuLevel1` varchar(50) NOT NULL,
  `strIconClass` varchar(50) NOT NULL,
  `strUrl` varchar(100) NOT NULL DEFAULT '#',
  `intOrder` int(11) NOT NULL DEFAULT '0',
  `blnActive` tinyint(1) NOT NULL DEFAULT '1',
  `strLastUser` varchar(100) NOT NULL DEFAULT 'System',
  `dtLastEdit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sysmenulevel1`
--

INSERT INTO `sysmenulevel1` (`MenuLevel1ID`, `strMenuLevel1`, `EN_strMenuLevel1`, `AF_strMenuLevel1`, `FR_strMenuLevel1`, `strIconClass`, `strUrl`, `intOrder`, `blnActive`, `strLastUser`, `dtLastEdit`) VALUES
(1, 'Home', 'Home', 'Tuis', 'Acceuil', 'fa fa-home', '#', 0, 1, 'System', '2017-08-10 21:58:23'),
(2, 'System Settings', 'System', 'Systeem', 'Huis', 'fa fa-gear', '#', 5, 1, 'System', '2017-08-10 19:28:23'),
(13, 'My Profile', 'My Profile', 'My Profiel', 'Mon Profile', 'fa fa-clone', 'my.profile.php', 6, 1, 'System', '2017-08-10 19:28:34'),
(14, 'Admininstration', 'Admininstration', 'Af: Admininstration', 'Admininstration', 'fa fa-user', '#', 2, 1, 'System', '2017-08-10 19:21:09'),
(15, 'Menu', 'Menu', 'AF: Menu', 'Menu', 'fa fa-bars', '#', 3, 1, 'System', '2017-08-10 19:21:09'),
(16, 'Report', 'Report', 'AF: Report', 'Rapport', 'fa fa-file-text', '#', 4, 1, 'System', '2017-08-11 10:19:55');

-- --------------------------------------------------------

--
-- Table structure for table `sysmenulevel2`
--

CREATE TABLE `sysmenulevel2` (
  `MenuLevel2ID` int(11) NOT NULL,
  `MenuLevel1ID` int(11) NOT NULL DEFAULT '0',
  `strMenuLevel2` varchar(50) NOT NULL,
  `EN_strMenuLevel2` varchar(50) NOT NULL COMMENT 'EN',
  `AF_strMenuLevel2` varchar(50) NOT NULL COMMENT 'AF',
  `FR_strMenuLevel2` varchar(50) NOT NULL,
  `strEntity` varchar(50) DEFAULT NULL,
  `EN_strEntity` varchar(50) NOT NULL COMMENT 'EN',
  `AF_strEntity` varchar(50) NOT NULL COMMENT 'AF',
  `FR_strEntity` varchar(50) NOT NULL,
  `strUrl` varchar(100) NOT NULL DEFAULT '#',
  `strNotes` varchar(100) NOT NULL,
  `intOrder` double NOT NULL DEFAULT '0',
  `blnMenuItem` tinyint(1) NOT NULL DEFAULT '1',
  `blnDivider` tinyint(1) NOT NULL DEFAULT '0',
  `blnActive` tinyint(1) NOT NULL DEFAULT '1',
  `strLastUser` varchar(100) NOT NULL DEFAULT 'System',
  `dtLastEdit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sysmenulevel2`
--

INSERT INTO `sysmenulevel2` (`MenuLevel2ID`, `MenuLevel1ID`, `strMenuLevel2`, `EN_strMenuLevel2`, `AF_strMenuLevel2`, `FR_strMenuLevel2`, `strEntity`, `EN_strEntity`, `AF_strEntity`, `FR_strEntity`, `strUrl`, `strNotes`, `intOrder`, `blnMenuItem`, `blnDivider`, `blnActive`, `strLastUser`, `dtLastEdit`) VALUES
(-4, 1, 'AjaxFunctions', 'AjaxFunctions', 'AjaxFunctions', '', '', '', '', '', 'ajaxfunctions.php', 'accessable to all', 0, 0, 0, 1, 'System', '0000-00-00 00:00:00'),
(-2, 1, 'Message', 'Message', 'Boodskap', '', 'Message', 'Message', 'Boodskap', '', 'message.php', 'accessable to all', 0, 0, 0, 1, 'System', '0000-00-00 00:00:00'),
(-1, 1, 'Home', 'Home', 'Tuis', '', 'Home', 'Home', 'Tuis', '', 'index.php', 'accessable to all', 0, 0, 0, 1, 'System', '0000-00-00 00:00:00'),
(2, 2, 'Security Groups', 'Security Groups', 'Sekureteids Groepe', '', 'Security Group', 'Security Group', 'Sekureteids Groep', '', 'security.group.php', '', 50, 1, 0, 1, 'System', '2017-03-09 10:27:01'),
(3, 2, 'User List', 'User List', 'Verbruiker Lys', '', 'User', 'User', 'Verbruiker', '', 'user.php', '', 60, 1, 0, 1, 'System', '2017-03-09 10:27:01'),
(4, 2, 'Advanced Settings', 'Advanced Settings', 'Gevorderde Stellings', '', 'Advanced Setting', 'Advanced Setting', 'Gevorderde Stelling', '', 'settings.php', '', 10, 1, 1, 1, 'System', '0000-00-00 00:00:00'),
(61, 2, 'Email Templates', 'Email Templates', 'Email Template', '', 'Email Template', 'Email Template', 'Email Templaat', '', 'email.template.php', '', 30, 1, 0, 1, 'System', '2017-03-09 10:27:01'),
(67, 2, 'FAQ', 'FAQ', 'FAQ', '', 'FAQ', 'FAQ', 'FAQ', '', 'faq.php', '', 40, 1, 0, 1, 'System', '2017-03-09 10:38:04'),
(70, 13, 'My Profile', 'My Profile', 'My Profile', '', 'My Profile', 'My Profile', 'My Profile', '', 'my.profile.php', '', 0, 1, 0, 1, 'System', '2017-08-10 19:09:55'),
(72, 2, 'Audit Logs', 'Audit Logs', 'Oudit Logs', '', 'Audit Log', 'Audit Log', 'Oudit Log', '', 'audit.log.php', '', 20, 1, 1, 1, 'System', '0000-00-00 00:00:00'),
(73, 1, 'Usage Log', 'Usage Log', 'AF: Login', 'Entrees', 'Usage Log', 'Usage Log', 'AF: Login', 'Entrees', 'usage.log.php', 'admin only', 20, 1, 0, 1, 'System', '2017-08-10 22:26:17'),
(74, 1, 'Dashboard', 'Dashboard', 'AF: Dashboard', 'Plateforme', 'Dashboard', 'Dashboard', 'AF Dashboard', 'Plateforme', 'dashboard.php', '', 10, 1, 0, 1, 'System', '2017-08-10 22:26:13'),
(75, 14, 'Product', 'Product', 'AF: Product', 'Produit', 'Product', 'Product', 'AF Product', 'Produit', 'product.php', '', 5, 1, 0, 1, 'System', '2017-08-10 22:05:16'),
(76, 14, 'Store', 'Store', 'AF: Store', 'Entrepot', 'Store', 'Store', 'AF: Store', 'Entrepot', 'store.php', '', 10, 1, 0, 1, 'System', '2017-08-10 22:40:16'),
(77, 14, 'Shopping List', 'Shopping List', 'AF: Shopping List', 'Liste de Shopping', 'Shopping List', 'Shopping List', 'AF: Shopping List', 'Liste de Shopping', 'shopping.list.php', '', 15, 1, 0, 1, 'System', '2017-08-10 22:40:16'),
(78, 14, 'Product Category', 'Product Category', 'AF: Product Category', 'Categorie De Produits', 'Product Category', 'Product Category', 'AF: Product Category', 'Categorie De Produits', 'product.category.php', '', 20, 1, 0, 1, 'System', '2017-08-10 22:40:16'),
(79, 14, 'Product Location', 'Product Location', 'AF:Product Location', 'Location du Produit', 'Product Location', 'Product Location', 'AF: Product Location', 'Location du Produit', 'product.location.php', '', 25, 1, 0, 1, 'System', '2017-08-10 22:40:16'),
(80, 15, 'Shopper', 'Shopper', 'AF: Shopper', 'Acheteur', 'Shopper', 'Shopper', 'AF: Shopper', 'Acheteur', 'shopper.php', '', 10, 1, 0, 1, 'System', '2017-08-10 22:40:16'),
(81, 15, 'Picture', 'Picture', 'AF: Picture', 'Image', 'Picture', 'Picture', 'AF: Picture', 'Image', 'picture.php', '', 20, 1, 0, 1, 'System', '2017-08-10 22:40:16'),
(82, 15, 'Title', 'Title', 'Title', 'Title', 'Title', 'Title', 'Title', 'Title', 'title.php', '', 30, 1, 0, 1, 'System', '2017-08-10 22:40:16'),
(83, 15, 'Feedback', 'Feedback', 'AF: Feedback', 'Retour Information', 'Feedback', 'Feedback', 'AF: Feedback', 'Retour Information', 'feedback.php', '', 40, 1, 0, 1, 'System', '2017-08-10 22:40:16'),
(84, 16, 'Reports', 'Reports', 'AF: Reports', 'Inventaire', 'Reports', 'Reports', 'AF: Reports', 'Inventaire', 'report.php', '', 10, 1, 0, 1, 'System', '2017-08-11 10:18:54');

-- --------------------------------------------------------

--
-- Table structure for table `sysmenusidebar`
--

CREATE TABLE `sysmenusidebar` (
  `MenuSidebarID` int(11) NOT NULL,
  `strMenuSidebar` varchar(50) NOT NULL,
  `EN_strMenuSidebar` varchar(50) NOT NULL,
  `AF_strMenuSidebar` varchar(50) NOT NULL,
  `strUrl` varchar(100) NOT NULL,
  `strNotes` varchar(100) NOT NULL,
  `strFunctionName` varchar(100) NOT NULL,
  `arrFunctionArgs` varchar(50) NOT NULL,
  `intOrder` int(11) NOT NULL,
  `blnActive` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sysmenusidebar`
--

INSERT INTO `sysmenusidebar` (`MenuSidebarID`, `strMenuSidebar`, `EN_strMenuSidebar`, `AF_strMenuSidebar`, `strUrl`, `strNotes`, `strFunctionName`, `arrFunctionArgs`, `intOrder`, `blnActive`) VALUES
(1, 'My Tickets', 'My Tickets', 'My Tickets', 'tikect,php', '', 'getNewTickets', '', 1, 1),
(2, 'Emails', 'Emails', 'Emails', 'emails.php', '', 'getNewEmails', '', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `syssecurity`
--

CREATE TABLE `syssecurity` (
  `refSecurityGroupID` int(11) NOT NULL DEFAULT '0',
  `refMenulevel2ID` int(11) NOT NULL DEFAULT '0',
  `blnView` tinyint(1) NOT NULL DEFAULT '1',
  `blnDelete` tinyint(1) NOT NULL DEFAULT '0',
  `blnSave` tinyint(1) NOT NULL DEFAULT '0',
  `blnNew` tinyint(1) NOT NULL DEFAULT '1',
  `blnSpecial` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `syssecurity`
--

INSERT INTO `syssecurity` (`refSecurityGroupID`, `refMenulevel2ID`, `blnView`, `blnDelete`, `blnSave`, `blnNew`, `blnSpecial`) VALUES
(1, -4, 1, 0, 0, 0, 0),
(1, -2, 1, 0, 0, 0, 0),
(1, -1, 1, 0, 0, 0, 0),
(1, 2, 1, 1, 1, 1, 0),
(1, 3, 1, 1, 1, 1, 0),
(1, 4, 1, 1, 1, 1, 0),
(1, 61, 1, 1, 1, 1, 0),
(1, 67, 1, 1, 1, 1, 0),
(1, 70, 1, 1, 1, 1, 0),
(1, 72, 1, 1, 1, 1, 0),
(1, 73, 1, 1, 1, 1, 0),
(1, 74, 1, 1, 1, 1, 0),
(1, 75, 1, 1, 1, 1, 0),
(1, 76, 1, 1, 1, 1, 0),
(1, 77, 1, 1, 1, 1, 0),
(1, 78, 1, 1, 1, 1, 0),
(1, 79, 1, 1, 1, 1, 0),
(1, 80, 1, 1, 1, 1, 0),
(1, 81, 1, 1, 1, 1, 0),
(1, 82, 1, 1, 1, 1, 0),
(1, 83, 1, 1, 1, 1, 0),
(1, 84, 1, 1, 1, 1, 0),
(2, -4, 1, 0, 0, 0, 0),
(2, -2, 1, 0, 0, 0, 0),
(2, -1, 1, 0, 0, 0, 0),
(2, 2, 1, 1, 1, 1, 0),
(2, 3, 1, 1, 1, 1, 0),
(2, 4, 1, 0, 1, 0, 0),
(2, 56, 1, 0, 0, 0, 0),
(2, 57, 1, 0, 1, 0, 0),
(2, 60, 1, 0, 0, 0, 0),
(2, 61, 1, 0, 0, 0, 0),
(2, 67, 1, 1, 1, 1, 0),
(3, -4, 1, 0, 0, 0, 0),
(3, -2, 1, 0, 0, 0, 0),
(3, -1, 1, 0, 0, 0, 0),
(3, 2, 0, 0, 0, 0, 0),
(3, 3, 0, 0, 0, 0, 0),
(3, 4, 0, 0, 0, 0, 0),
(3, 56, 0, 0, 0, 0, 0),
(3, 57, 1, 0, 1, 1, 0),
(3, 60, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `syssecuritygroup`
--

CREATE TABLE `syssecuritygroup` (
  `SecurityGroupID` int(11) NOT NULL,
  `strSecurityGroup` varchar(100) NOT NULL,
  `blnActive` tinyint(1) NOT NULL DEFAULT '1',
  `strLastUser` varchar(20) NOT NULL DEFAULT 'SYSTEM',
  `dtLastEdit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `syssecuritygroup`
--

INSERT INTO `syssecuritygroup` (`SecurityGroupID`, `strSecurityGroup`, `blnActive`, `strLastUser`, `dtLastEdit`) VALUES
(1, 'Admin Dev', 1, 'Gael Wamba', '2017-08-11 10:19:10'),
(2, 'Admin', 1, 'Gael', '2016-10-13 07:48:30');

-- --------------------------------------------------------

--
-- Table structure for table `syssettings`
--

CREATE TABLE `syssettings` (
  `SettingID` int(11) NOT NULL,
  `strSetting` varchar(100) NOT NULL DEFAULT '',
  `strValue` text NOT NULL,
  `strComment` varchar(255) DEFAULT NULL,
  `strLastUser` varchar(20) NOT NULL DEFAULT 'SYSTEM',
  `dtLastEdit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `syssettings`
--

INSERT INTO `syssettings` (`SettingID`, `strSetting`, `strValue`, `strComment`, `strLastUser`, `dtLastEdit`) VALUES
(1, 'Session Timeout', '31', '', 'SYSTEM', '0000-00-00 00:00:00'),
(2, 'Title', 'Smart Basket', '', 'wamba', '2017-08-10 18:44:13'),
(3, 'System Version', 'v1 2017', '', 'PJ', '2017-08-10 18:44:22'),
(4, 'PageSize', '100', '', 'Stephen', '2011-10-10 11:08:14'),
(5, 'SMTP Send As', 'Gael <gaelmusi0@gmail.com>', '', 'PJ', '2017-08-10 18:44:42'),
(6, 'SMTP BCC', 'gaelmusi0@gmail.com', 'BCC', 'Gael', '2017-08-10 18:44:56'),
(7, 'NumericChars', '0123456789-+/*#$=.', '', 'PJ', '2011-09-19 11:57:27'),
(8, 'Enable PDFEncryption', '2', '', 'PJ', '2010-12-09 15:09:27'),
(11, 'LogoutRedirect', 'message.php?MID=s44', '', 'PJ', '2010-12-08 08:00:21'),
(12, 'SessionExRedirect', 'message.php?MID=s13', '', 'SYSTEM', '0000-00-00 00:00:00'),
(13, 'LastVisited', '5', '', 'Stephen', '2010-12-08 09:32:43'),
(14, 'imgRequired', '<b style=''font-size: 20px;'' class=''textColour''>*</b>', '', 'SYSTEM', '0000-00-00 00:00:00'),
(15, 'Brand', 'Smart Basket', 'MOVED To _nemo.translations.inc.php', 'Gael', '2017-08-10 18:50:39'),
(18, 'PublicKey', '', 'google recatcha', 'SYSTEM', '2014-09-18 15:00:51'),
(19, 'PrivateKey', '', 'google recatcha', 'SYSTEM', '2014-09-18 15:00:51'),
(20, 'EmailReadReceiptURL', 'http://???/email.read.receipt.php', NULL, 'SYSTEM', '2014-09-18 15:00:51'),
(21, 'VAT', '0.14', NULL, 'SYSTEM', '2011-11-16 10:02:45'),
(29, 'EmailReadOnlineURL', 'http://www.livesiteurl.co.za/email.read.online.php', NULL, 'SYSTEM', '2015-03-24 08:53:28'),
(30, 'AllowIndividualEmails', '1', NULL, 'SYSTEM', '2012-02-02 14:37:20'),
(37, 'Google Analytics', '<script type=''text/javascript''> var _gaq = _gaq || []; _gaq.push([''_setAccount'', ''???'']); _gaq.push([''_trackPageview'']); (function() { var ga = document.createElement(''script''); ga.type = ''text/javascript''; ga.async = true; ga.src = (''https:'' == document.location.protocol ? ''https://ssl'' : ''http://www'') + ''.google-analytics.com/ga.js''; var s = document.getElementsByTagName(''script'')[0]; s.parentNode.insertBefore(ga, s); })(); </script> ', NULL, 'pj', '2014-09-18 15:01:29'),
(43, 'LiveURL', 'http://www.???.co.za', NULL, 'SYSTEM', '2014-09-18 15:01:29'),
(48, 'ProfileImageDirAdmin', './profilepictures/', NULL, 'SYSTEM', '2014-12-12 08:44:01'),
(49, 'CompanyImagesDir', './companyimages/', NULL, 'SYSTEM', '2015-01-23 09:41:24'),
(50, 'SiteColorMain', '#FFFFFF', 'Main Site Color', 'Gael', '2016-04-08 11:21:37'),
(51, 'SiteColorLight', '#d75345', 'Lighter version of main color', 'SYSTEM', '2015-02-05 12:53:01'),
(52, 'SiteColorDark', '#a21e10', 'Darker version of main color', 'SYSTEM', '2015-02-05 12:53:01'),
(53, 'SiteColorAlt', '#9E8851', 'Alternative color 1', 'SYSTEM', '2015-02-09 10:26:09'),
(54, 'SiteColorAlt2', '#7e6d41', 'Alternative color 2', 'SYSTEM', '2015-02-09 10:33:21'),
(55, 'SiteColorAlt3', '#FFFFFF', 'Alternative color 3', 'SYSTEM', '2015-02-05 12:53:01'),
(56, 'LoginBG', '2.jpg', 'Background to be displayd on login page', 'SYSTEM', '2015-02-09 11:16:01'),
(61, 'EN_Brand', 'Smart Basket Inc.', '', 'Gael', '2017-08-10 18:45:28'),
(62, 'AF_Brand', 'Maatskappy Naam', NULL, 'SYSTEM', '2015-03-24 08:59:16'),
(63, 'EN_Title', 'Smart Basket', '', 'wamba', '2017-08-10 18:46:25'),
(64, 'AF_Title', 'Smart Basket', '', 'Gael', '2017-08-10 18:45:41'),
(65, 'vieEmailContacts ', 'CREATE OR REPLACE VIEW vieEmailContacts AS\r\nSELECT DISTINCT strTo as ViewID, strTo as strView, '''' as DisplayName\r\nFROM tblEmail \r\nWHERE strTo NOT LIKE (''%;%'') AND strTo <> '''' \r\nORDER BY ViewID, strView', NULL, 'SYSTEM', '2015-10-27 09:34:06'),
(66, 'blnMultiLanguage', '0', '1 = On , 0 = Off', 'SYSTEM', '2016-01-12 12:57:54'),
(67, 'MadeBy', 'Made by Gael Musikingala', 'Footer made by text', 'SYSTEM', '2016-09-27 10:48:16'),
(68, 'Copyright', 'All Rights Reserved | Zori Corporation | Privacy and Terms', 'Copyright Text', 'SYSTEM', '2017-08-10 18:58:35'),
(69, 'CopyrightSymbolYear', '&copy 2016', 'Copyright Symbol and display Year', 'SYSTEM', '2016-09-27 10:47:27'),
(70, 'ProjectName', 'Smart Basket', 'Name of the project', 'SYSTEM', '2017-08-10 18:46:46'),
(71, 'ProjectLogoPic', 'images/smartbasket.png', NULL, 'SYSTEM', '2017-08-10 19:01:27'),
(72, 'PicturesLink', 'Pictures/', NULL, 'SYSTEM', '2017-08-11 11:41:53');

-- --------------------------------------------------------

--
-- Table structure for table `sysuser`
--

CREATE TABLE `sysuser` (
  `UserID` int(11) NOT NULL,
  `refSecurityGroupID` int(11) NOT NULL DEFAULT '0',
  `refTitleID` int(11) NOT NULL,
  `strUser` varchar(100) NOT NULL,
  `strEmail` varchar(100) NOT NULL,
  `strPasswordMD5` varchar(32) NOT NULL DEFAULT '',
  `strTel` varchar(100) DEFAULT NULL,
  `Profile:PicturePath` varchar(100) DEFAULT 'blank.jpg',
  `strSetting:Language` enum('English') NOT NULL DEFAULT 'English',
  `strFirstUser` varchar(255) DEFAULT NULL,
  `dtFirstEdit` datetime NOT NULL,
  `blnActive` tinyint(1) NOT NULL DEFAULT '1',
  `strLastUser` varchar(100) NOT NULL DEFAULT 'SYSTEM',
  `dtLastEdit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sysuser`
--

INSERT INTO `sysuser` (`UserID`, `refSecurityGroupID`, `refTitleID`, `strUser`, `strEmail`, `strPasswordMD5`, `strTel`, `Profile:PicturePath`, `strSetting:Language`, `strFirstUser`, `dtFirstEdit`, `blnActive`, `strLastUser`, `dtLastEdit`) VALUES
(1, 1, 7, 'Gael Wamba', 'gael@overdrive.co.za', '098f6bcd4621d373cade4e832627b4f6', '0797134913', '00001_Liverpool_FC_logo.png', 'English', 'Gael', '2016-03-31 09:35:12', 1, 'Gael', '2017-08-10 22:58:37');

-- --------------------------------------------------------

--
-- Table structure for table `tblemail`
--

CREATE TABLE `tblemail` (
  `EmailID` int(11) NOT NULL,
  `UniqueID` varchar(12) CHARACTER SET latin1 NOT NULL COMMENT 'system assigned - used to access read-online',
  `refEmailTemplateID` int(11) DEFAULT NULL,
  `strFrom` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `strTo` varchar(100) CHARACTER SET latin1 NOT NULL,
  `strCC` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `strSubject` varchar(100) CHARACTER SET latin1 NOT NULL,
  `strStatus` enum('Sending','Sent','Read','Error') CHARACTER SET latin1 NOT NULL DEFAULT 'Sending',
  `txtHeaders` text CHARACTER SET latin1 NOT NULL,
  `txtBody` text CHARACTER SET latin1 NOT NULL,
  `arrAttachments` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `dtEmail` datetime NOT NULL,
  `txtNotes` text CHARACTER SET latin1 COMMENT 'Internal use only',
  `strLastUser` varchar(100) CHARACTER SET latin1 NOT NULL DEFAULT 'SYSTEM',
  `dtLastEdit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblemail`
--

INSERT INTO `tblemail` (`EmailID`, `UniqueID`, `refEmailTemplateID`, `strFrom`, `strTo`, `strCC`, `strSubject`, `strStatus`, `txtHeaders`, `txtBody`, `arrAttachments`, `dtEmail`, `txtNotes`, `strLastUser`, `dtLastEdit`) VALUES
(1, '2NGN6F', 0, 'Jacques <jacques@overdrive.co.za>', 'gael@overdrive.co.za', '', 'GMW News Security Warning', 'Sent', 'From: =?UTF-8?Q?Jacques?= <jacques@overdrive.co.za>\nBCC:jacques@overdrive.co.za\nMIME-Version: 1.0\nDate: Mon, 11 Apr 2016 14:05:21 +0200\nContent-Type: multipart/mixed;\n boundary=|==Multipart_Boundary_x2769a442df6bc9d001720cf936b6db55x|', '--==Multipart_Boundary_x2769a442df6bc9d001720cf936b6db55x\nContent-Type:text/html; charset=''iso-8859-1''\nContent-Transfer-Encoding: 7bit\n\n<font style=''font-size:11.0pt; font-family:Calibri,sans-serif,Arial;''><br />Attention Gael<br /><br />Your login account has been suspended due to repeated failed login attempts.<br /><br />Please contact your site administrator to verify your details and restore your account.<br /><br />Regards<br />GMW News\r\n<table cellpadding=''2'' cellspacing=''1'' border=''0'' style=''border: 1px solid #343434;'' bgcolor=''#D5D5D5'' >\r\n<caption colspan=''100%''><b>Last 5 Login Results</b></caption>\r\n<tr bgcolor=''#E6E6E6''>\r\n<th>LoginID</th><th>IP</th><th>Result</th><th>Username</th><th>Password</th><th>DT</th>\r\n</tr>\r\n<tr bgcolor=''white''><td>37</td><td>192.168.100.63</td><td>Login failed: Incorrect\n password</td><td>gael@overdrive.co.za</td><td>test</td><td>2016-04-11 14:05:21</td></tr><tr bgcolor=''white''><td>36</td><td>192.168.100.63</td><td>Login failed: Incorrect password</td><td>gael@overdrive.co.za</td><td>test</td><td>2016-04-11 14:04:41</td></tr><tr bgcolor=''white''><td>35</td><td>192.168.100.63</td><td>Login failed: Incorrect password</td><td>gael@overdrive.co.za</td><td>G@el3228#!</td><td>2016-04-11 14:03:42</td></tr><tr bgcolor=''white''><td>34</td><td>192.168.100.63</td><td>Login failed: Incorrect password</td><td>gael@overdrive.co.za</td><td>G@el3228#!</td><td>2016-04-11 14:03:16</td></tr><tr bgcolor=''white''><td>33</td><td>192.168.100.63</td><td>Login failed: Incorrect password</td><td>gael@overdrive.co.za</td><td>G@ssword01</td><td>2016-04-11 14:02:59</td></tr>\r\n</table>\r\n</font>', '', '2016-04-11 14:05:22', '', '', '2016-04-11 12:05:22'),
(2, '7C60GK', 0, 'Jacques <jacques@overdrive.co.za>', 'gael@overdrive.co.za', '', 'Open Layers Security Warning', 'Sent', 'From: =?UTF-8?Q?Jacques?= <jacques@overdrive.co.za>\nBCC:jacques@overdrive.co.za\nMIME-Version: 1.0\nDate: Tue, 19 Apr 2016 12:14:44 +0200\nContent-Type: multipart/mixed;\n boundary=|==Multipart_Boundary_xd66d40b6a25d4b130d5c7288f0f24d80x|', '--==Multipart_Boundary_xd66d40b6a25d4b130d5c7288f0f24d80x\nContent-Type:text/html; charset=''iso-8859-1''\nContent-Transfer-Encoding: 7bit\n\n<font style=''font-size:11.0pt; font-family:Calibri,sans-serif,Arial;''><br />Attention Gael<br /><br />Your login account has been suspended due to repeated failed login attempts.<br /><br />Please contact your site administrator to verify your details and restore your account.<br /><br />Regards<br />Open layers\r\n<table cellpadding=''2'' cellspacing=''1'' border=''0'' style=''border: 1px solid #343434;'' bgcolor=''#D5D5D5'' >\r\n<caption colspan=''100%''><b>Last 5 Login Results</b></caption>\r\n<tr bgcolor=''#E6E6E6''>\r\n<th>LoginID</th><th>IP</th><th>Result</th><th>Username</th><th>Password</th><th>DT</th>\r\n</tr>\r\n<tr bgcolor=''white''><td>42</td><td>192.168.100.63</td><td>Login failed: Incorrect\n password</td><td>gael@overdrive.co.za</td><td>test</td><td>2016-04-19 12:14:44</td></tr><tr bgcolor=''white''><td>37</td><td>192.168.100.63</td><td>Login failed: Incorrect password</td><td>gael@overdrive.co.za</td><td>test</td><td>2016-04-11 14:05:21</td></tr><tr bgcolor=''white''><td>36</td><td>192.168.100.63</td><td>Login failed: Incorrect password</td><td>gael@overdrive.co.za</td><td>test</td><td>2016-04-11 14:04:41</td></tr><tr bgcolor=''white''><td>35</td><td>192.168.100.63</td><td>Login failed: Incorrect password</td><td>gael@overdrive.co.za</td><td>G@el3228#!</td><td>2016-04-11 14:03:42</td></tr><tr bgcolor=''white''><td>34</td><td>192.168.100.63</td><td>Login failed: Incorrect password</td><td>gael@overdrive.co.za</td><td>G@el3228#!</td><td>2016-04-11 14:03:16</td></tr>\r\n</table>\r\n</font>', '', '2016-04-19 12:14:45', '', '', '2016-04-19 10:14:45'),
(3, '2FCCAE', 0, 'Jacques <jacques@overdrive.co.za>', 'gael@overdrive.co.za', '', 'Nemo V2 Security Warning', 'Sent', 'From: =?UTF-8?Q?Jacques?= <jacques@overdrive.co.za>\nBCC:jacques@overdrive.co.za\nMIME-Version: 1.0\nDate: Tue, 03 May 2016 10:43:31 +0200\nContent-Type: multipart/mixed;\n boundary=|==Multipart_Boundary_x58c53a1299f132619babb7c54b538076x|', '--==Multipart_Boundary_x58c53a1299f132619babb7c54b538076x\nContent-Type:text/html; charset=''iso-8859-1''\nContent-Transfer-Encoding: 7bit\n\n<font style=''font-size:11.0pt; font-family:Calibri,sans-serif,Arial;''><br />Attention Gael<br /><br />Your login account has been suspended due to repeated failed login attempts.<br /><br />Please contact your site administrator to verify your details and restore your account.<br /><br />Regards<br />Company Name\r\n<table cellpadding=''2'' cellspacing=''1'' border=''0'' style=''border: 1px solid #343434;'' bgcolor=''#D5D5D5'' >\r\n<caption colspan=''100%''><b>Last 5 Login Results</b></caption>\r\n<tr bgcolor=''#E6E6E6''>\r\n<th>LoginID</th><th>IP</th><th>Result</th><th>Username</th><th>Password</th><th>DT</th>\r\n</tr>\r\n<tr bgcolor=''white''><td>51</td><td>192.168.100.69</td><td>Login failed: Incorrect\n password</td><td>gael@overdrive.co.za</td><td>test</td><td>2016-05-03 10:43:30</td></tr><tr bgcolor=''white''><td>42</td><td>192.168.100.63</td><td>Login failed: Incorrect password</td><td>gael@overdrive.co.za</td><td>test</td><td>2016-04-19 12:14:44</td></tr><tr bgcolor=''white''><td>37</td><td>192.168.100.63</td><td>Login failed: Incorrect password</td><td>gael@overdrive.co.za</td><td>test</td><td>2016-04-11 14:05:21</td></tr><tr bgcolor=''white''><td>36</td><td>192.168.100.63</td><td>Login failed: Incorrect password</td><td>gael@overdrive.co.za</td><td>test</td><td>2016-04-11 14:04:41</td></tr><tr bgcolor=''white''><td>35</td><td>192.168.100.63</td><td>Login failed: Incorrect password</td><td>gael@overdrive.co.za</td><td>G@el3228#!</td><td>2016-04-11 14:03:42</td></tr>\r\n</table>\r\n</font>', '', '2016-05-03 10:43:32', '', '', '2016-05-03 08:43:32'),
(4, 'A2BFAK', 0, 'Jacques <jacques@overdrive.co.za>', 'gael@overdrive.co.za', '', 'Nemo V2 Security Warning', 'Sent', 'From: =?UTF-8?Q?Jacques?= <jacques@overdrive.co.za>\nBCC:jacques@overdrive.co.za\nMIME-Version: 1.0\nDate: Tue, 03 May 2016 10:44:46 +0200\nContent-Type: multipart/mixed;\n boundary=|==Multipart_Boundary_x4d6a3db818aa6b4cb9a920e80751dfb8x|', '--==Multipart_Boundary_x4d6a3db818aa6b4cb9a920e80751dfb8x\nContent-Type:text/html; charset=''iso-8859-1''\nContent-Transfer-Encoding: 7bit\n\n<font style=''font-size:11.0pt; font-family:Calibri,sans-serif,Arial;''><br />Attention Gael<br /><br />Your login account has been suspended due to repeated failed login attempts.<br /><br />Please contact your site administrator to verify your details and restore your account.<br /><br />Regards<br />Company Name\r\n<table cellpadding=''2'' cellspacing=''1'' border=''0'' style=''border: 1px solid #343434;'' bgcolor=''#D5D5D5'' >\r\n<caption colspan=''100%''><b>Last 5 Login Results</b></caption>\r\n<tr bgcolor=''#E6E6E6''>\r\n<th>LoginID</th><th>IP</th><th>Result</th><th>Username</th><th>Password</th><th>DT</th>\r\n</tr>\r\n<tr bgcolor=''white''><td>52</td><td>192.168.100.69</td><td>Login failed: Incorrect\n password</td><td>gael@overdrive.co.za</td><td>test</td><td>2016-05-03 10:44:46</td></tr><tr bgcolor=''white''><td>51</td><td>192.168.100.69</td><td>Login failed: Incorrect password</td><td>gael@overdrive.co.za</td><td>test</td><td>2016-05-03 10:43:30</td></tr><tr bgcolor=''white''><td>42</td><td>192.168.100.63</td><td>Login failed: Incorrect password</td><td>gael@overdrive.co.za</td><td>test</td><td>2016-04-19 12:14:44</td></tr><tr bgcolor=''white''><td>37</td><td>192.168.100.63</td><td>Login failed: Incorrect password</td><td>gael@overdrive.co.za</td><td>test</td><td>2016-04-11 14:05:21</td></tr><tr bgcolor=''white''><td>36</td><td>192.168.100.63</td><td>Login failed: Incorrect password</td><td>gael@overdrive.co.za</td><td>test</td><td>2016-04-11 14:04:41</td></tr>\r\n</table>\r\n</font>', '', '2016-05-03 10:44:47', '', '', '2016-05-03 08:44:47'),
(5, '197089', 0, 'Jacques <jacques@overdrive.co.za>', 'gael@overdrive.co.za', '', 'Nemo V2 Security Warning', 'Sent', 'From: =?UTF-8?Q?Jacques?= <jacques@overdrive.co.za>\nBCC:jacques@overdrive.co.za\nMIME-Version: 1.0\nDate: Tue, 03 May 2016 10:45:10 +0200\nContent-Type: multipart/mixed;\n boundary=|==Multipart_Boundary_xeea77f111778a4b73d2a29f7f9ecbdbdx|', '--==Multipart_Boundary_xeea77f111778a4b73d2a29f7f9ecbdbdx\nContent-Type:text/html; charset=''iso-8859-1''\nContent-Transfer-Encoding: 7bit\n\n<font style=''font-size:11.0pt; font-family:Calibri,sans-serif,Arial;''><br />Attention Gael<br /><br />Your login account has been suspended due to repeated failed login attempts.<br /><br />Please contact your site administrator to verify your details and restore your account.<br /><br />Regards<br />Company Name\r\n<table cellpadding=''2'' cellspacing=''1'' border=''0'' style=''border: 1px solid #343434;'' bgcolor=''#D5D5D5'' >\r\n<caption colspan=''100%''><b>Last 5 Login Results</b></caption>\r\n<tr bgcolor=''#E6E6E6''>\r\n<th>LoginID</th><th>IP</th><th>Result</th><th>Username</th><th>Password</th><th>DT</th>\r\n</tr>\r\n<tr bgcolor=''white''><td>53</td><td>192.168.100.69</td><td>Login failed: Incorrect\n password</td><td>gael@overdrive.co.za</td><td>G@el3228#!</td><td>2016-05-03 10:45:10</td></tr><tr bgcolor=''white''><td>52</td><td>192.168.100.69</td><td>Login failed: Incorrect password</td><td>gael@overdrive.co.za</td><td>test</td><td>2016-05-03 10:44:46</td></tr><tr bgcolor=''white''><td>51</td><td>192.168.100.69</td><td>Login failed: Incorrect password</td><td>gael@overdrive.co.za</td><td>test</td><td>2016-05-03 10:43:30</td></tr><tr bgcolor=''white''><td>42</td><td>192.168.100.63</td><td>Login failed: Incorrect password</td><td>gael@overdrive.co.za</td><td>test</td><td>2016-04-19 12:14:44</td></tr><tr bgcolor=''white''><td>37</td><td>192.168.100.63</td><td>Login failed: Incorrect password</td><td>gael@overdrive.co.za</td><td>test</td><td>2016-04-11 14:05:21</td></tr>\r\n</table>\r\n</font>', '', '2016-05-03 10:45:11', '', '', '2016-05-03 08:45:11');

-- --------------------------------------------------------

--
-- Table structure for table `tblemailtemplate`
--

CREATE TABLE `tblemailtemplate` (
  `EmailTemplateID` int(11) NOT NULL,
  `strEmailTemplate` varchar(100) NOT NULL COMMENT 'read-only',
  `strSubject` varchar(100) NOT NULL,
  `txtBody` text NOT NULL,
  `arrAttachments` varchar(255) DEFAULT NULL,
  `arrSubstitutions` varchar(255) DEFAULT NULL,
  `txtNotes` text COMMENT 'Internal use only',
  `blnActive` tinyint(1) NOT NULL DEFAULT '1',
  `strLastUser` varchar(100) NOT NULL DEFAULT 'SYSTEM',
  `dtLastEdit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblemailtemplate`
--

INSERT INTO `tblemailtemplate` (`EmailTemplateID`, `strEmailTemplate`, `strSubject`, `txtBody`, `arrAttachments`, `arrSubstitutions`, `txtNotes`, `blnActive`, `strLastUser`, `dtLastEdit`) VALUES
(-2, 'Login PIN', 'SAWIS Online: New Login PIN', 'Hi [DisplayName]<br><div align=''justify''>A new Login PIN was generated:\r\nNew PIN: [LoginPIN]\r\n\r\n<br><br>Regards\r\nSAWIS Online\r\n\r\n[Logo]\r\n\r\n<br><br>To view this email online go to [ReadOnline]\r\n[ReadReceipt]</div>', '', 'DisplayName,LoginPIN', 'not in use sawis', 0, 'Gael', '2017-07-19 12:25:16'),
(-1, 'Reset Password', 'SAWIS Online: Reset password procedure', 'Hi [DisplayName]\r\n<br><br>Please follow the following link to reset your password:\r\n[Link] \r\n\r\n<br><br>Regards \r\nSAWIS Online\r\n<br>\r\n[Logo]<br>&nbsp;To view this email online go to <br>[ReadOnline]\r\n[ReadReceipt]', '', 'DisplayName,Link', '', 1, 'Gael', '2017-07-19 12:44:07');

-- --------------------------------------------------------

--
-- Table structure for table `tblpicture`
--

CREATE TABLE `tblpicture` (
  `PictureID` int(11) NOT NULL,
  `intEntityID` int(11) NOT NULL COMMENT 'Can hold (ProductID,StoreID)',
  `strPicture` varchar(100) NOT NULL,
  `strPictureLink` varchar(250) NOT NULL,
  `strCategory` enum('Product','Store') NOT NULL,
  `dtDateUploaded` date NOT NULL,
  `strLastUser` varchar(100) NOT NULL,
  `dtLastEdit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpicture`
--

INSERT INTO `tblpicture` (`PictureID`, `intEntityID`, `strPicture`, `strPictureLink`, `strCategory`, `dtDateUploaded`, `strLastUser`, `dtLastEdit`) VALUES
(2, 1, 'Barcelona 2013', 'download_Product_1.jpg', 'Product', '2017-08-11', 'SYSTEM', '2017-08-11 11:51:24'),
(4, 2, 'Gael Pic', '4_17-08-11_DSC_0061.jpg', 'Store', '2017-08-11', 'Gael Wamba', '2017-08-11 14:58:52'),
(5, 6, 'Abee', '', 'Product', '2017-08-11', 'Gael Wamba', '2017-08-11 15:13:28');

-- --------------------------------------------------------

--
-- Table structure for table `tblproduct`
--

CREATE TABLE `tblproduct` (
  `ProductID` int(11) NOT NULL,
  `refStoreID` int(11) NOT NULL,
  `refProductCategoryID` int(11) NOT NULL,
  `refShoppingListID` int(11) DEFAULT NULL,
  `refProductLocationID` int(11) DEFAULT NULL,
  `strProductCode` varchar(250) NOT NULL,
  `strProduct` varchar(100) NOT NULL,
  `strStatus` enum('In Stock','Out Stock') NOT NULL,
  `dblCost` double NOT NULL,
  `dtExpiredDate` date NOT NULL,
  `intWarranty` int(5) NOT NULL,
  `txtDescription` text NOT NULL,
  `txtNotes` text,
  `blnActive` tinyint(1) NOT NULL DEFAULT '1',
  `strLastUser` varchar(100) NOT NULL,
  `dtLastEdit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblproduct`
--

INSERT INTO `tblproduct` (`ProductID`, `refStoreID`, `refProductCategoryID`, `refShoppingListID`, `refProductLocationID`, `strProductCode`, `strProduct`, `strStatus`, `dblCost`, `dtExpiredDate`, `intWarranty`, `txtDescription`, `txtNotes`, `blnActive`, `strLastUser`, `dtLastEdit`) VALUES
(1, 1, 2, 0, 0, '1245###HHH', 'Creamy Burger', 'In Stock', 150, '2018-02-14', 0, 'Nice Burger', '', 1, 'Gael Wamba', '2017-08-11 09:50:55');

-- --------------------------------------------------------

--
-- Table structure for table `tblproductcategory`
--

CREATE TABLE `tblproductcategory` (
  `ProductCategoryID` int(11) NOT NULL,
  `strProductCategory` varchar(100) NOT NULL,
  `blnActive` tinyint(1) NOT NULL,
  `strLastUser` varchar(100) NOT NULL,
  `dtLastEdit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblproductcategory`
--

INSERT INTO `tblproductcategory` (`ProductCategoryID`, `strProductCategory`, `blnActive`, `strLastUser`, `dtLastEdit`) VALUES
(1, 'Clothing', 1, 'Gael Wamba', '2017-08-11 09:19:50'),
(2, 'Food', 1, 'Gael Wamba', '2017-08-11 09:19:17'),
(3, 'Electronics', 1, 'Gael Wamba', '2017-08-11 09:19:30');

-- --------------------------------------------------------

--
-- Table structure for table `tblproductlocation`
--

CREATE TABLE `tblproductlocation` (
  `ProductLocationID` int(11) NOT NULL,
  `strProductLocation` varchar(100) NOT NULL,
  `strRow` varchar(20) NOT NULL,
  `strCol` varchar(20) NOT NULL,
  `blnAvailable` tinyint(1) NOT NULL,
  `blnActive` tinyint(1) NOT NULL,
  `strLastUser` varchar(100) NOT NULL,
  `dtLastEdit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblshopper`
--

CREATE TABLE `tblshopper` (
  `ShopperID` int(11) NOT NULL,
  `refTitleID` int(11) NOT NULL,
  `refShoppingListID` int(11) DEFAULT NULL,
  `strShopper` varchar(100) NOT NULL,
  `strName` varchar(100) NOT NULL,
  `strSurname` varchar(100) NOT NULL,
  `strEmail` varchar(100) NOT NULL,
  `dtDateRegistered` date NOT NULL,
  `strTel` varchar(50) NOT NULL,
  `strCell` varchar(50) DEFAULT NULL,
  `Profile:Picture` varchar(100) DEFAULT NULL,
  `strPassword` varchar(50) NOT NULL,
  `txtAddress` text,
  `txtNotes` text,
  `blnActive` tinyint(1) DEFAULT NULL,
  `strLastUser` varchar(100) NOT NULL DEFAULT 'SYSTEM',
  `dtLastEdit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblshopper`
--

INSERT INTO `tblshopper` (`ShopperID`, `refTitleID`, `refShoppingListID`, `strShopper`, `strName`, `strSurname`, `strEmail`, `dtDateRegistered`, `strTel`, `strCell`, `Profile:Picture`, `strPassword`, `txtAddress`, `txtNotes`, `blnActive`, `strLastUser`, `dtLastEdit`) VALUES
(1, 5, 0, 'Sylvia Musi', 'Sylvia', 'Musi', 'sylvia@gmail.com', '2017-08-11', '021 5923356', '', '', 'ec6a6536ca304edf844d1d248a4f08dc', '5 Hares Avenue\r\nSalt River\r\n7925\r\nCape Town\r\nSouth Africa', '', 1, 'Gael Wamba', '2017-08-11 08:43:55');

-- --------------------------------------------------------

--
-- Table structure for table `tblshoppinglist`
--

CREATE TABLE `tblshoppinglist` (
  `ShoppingListID` int(11) NOT NULL,
  `strShoppingList` varchar(100) NOT NULL,
  `dtDateCreated` date NOT NULL,
  `intNumItems` int(11) NOT NULL,
  `dblTotalCost` double NOT NULL,
  `blnPurchased` tinyint(1) NOT NULL DEFAULT '0',
  `blnActive` tinyint(1) NOT NULL DEFAULT '1',
  `txtDescription` text,
  `strLastUser` varchar(100) NOT NULL DEFAULT 'SYSTEM',
  `dtLastEdit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblshoppinglist`
--

INSERT INTO `tblshoppinglist` (`ShoppingListID`, `strShoppingList`, `dtDateCreated`, `intNumItems`, `dblTotalCost`, `blnPurchased`, `blnActive`, `txtDescription`, `strLastUser`, `dtLastEdit`) VALUES
(1, 'Gael Shopping List', '2017-08-11', 3, 250, 0, 1, '', 'Gael Wamba', '2017-08-11 10:11:33');

-- --------------------------------------------------------

--
-- Table structure for table `tblstore`
--

CREATE TABLE `tblstore` (
  `StoreID` int(11) NOT NULL,
  `strStore` varchar(100) NOT NULL,
  `strEmail` varchar(50) NOT NULL,
  `strStatus` enum('Opened','Closed','In Maintenance') NOT NULL,
  `strCountry` varchar(100) NOT NULL,
  `strCity` varchar(100) NOT NULL,
  `txtAddress` text,
  `txtDescription` text,
  `strGeoCoordinates` varchar(250) DEFAULT NULL,
  `dblColumnDistance` double DEFAULT NULL,
  `intNumRow` int(11) DEFAULT NULL,
  `intNumCol` int(11) DEFAULT NULL,
  `blnActive` tinyint(1) DEFAULT NULL,
  `strLastUser` varchar(100) NOT NULL DEFAULT 'SYSTEM',
  `dtLastEdit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblstore`
--

INSERT INTO `tblstore` (`StoreID`, `strStore`, `strEmail`, `strStatus`, `strCountry`, `strCity`, `txtAddress`, `txtDescription`, `strGeoCoordinates`, `dblColumnDistance`, `intNumRow`, `intNumCol`, `blnActive`, `strLastUser`, `dtLastEdit`) VALUES
(1, 'Pick n Pay', 'picknpay@gmail.com', 'Opened', 'South Africa', 'Cape Town', 'Observatory', 'Nice Store', '', 0, 0, 0, 1, 'Gael Wamba', '2017-08-11 09:09:31');

-- --------------------------------------------------------

--
-- Table structure for table `tbltitle`
--

CREATE TABLE `tbltitle` (
  `TitleID` int(11) NOT NULL,
  `strTitle` varchar(50) NOT NULL,
  `strLanguage` varchar(50) NOT NULL,
  `blnActive` tinyint(1) NOT NULL,
  `strLastUser` varchar(100) NOT NULL,
  `dtLastEdit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltitle`
--

INSERT INTO `tbltitle` (`TitleID`, `strTitle`, `strLanguage`, `blnActive`, `strLastUser`, `dtLastEdit`) VALUES
(2, 'Dr', 'English', 1, 'FINAL 20160412', '2017-04-12 12:38:39'),
(3, 'Mej', 'Afrikaans', 1, 'FINAL 20160412', '2017-04-12 12:38:41'),
(4, 'Mev', 'Afrikaans', 1, 'FINAL 20160412', '2017-04-12 12:38:42'),
(5, 'Miss', 'English', 1, 'Gael', '2017-08-10 22:59:10'),
(6, 'Mnr', 'Afrikaans', 1, 'FINAL 20160412', '2017-04-12 12:38:45'),
(7, 'Mr', 'English', 1, 'FINAL 20160412', '2017-04-12 12:38:46'),
(8, 'Mrs', 'English', 1, 'FINAL 20160412', '2017-04-12 12:38:47'),
(10, 'Mme', 'Francais', 1, 'Gael', '2017-08-10 22:54:47');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vieemailcontacts`
--
CREATE TABLE `vieemailcontacts` (
`ViewID` varchar(100)
,`strView` varchar(100)
,`DisplayName` char(0)
);

-- --------------------------------------------------------

--
-- Structure for view `vieemailcontacts`
--
DROP TABLE IF EXISTS `vieemailcontacts`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vieemailcontacts`  AS  select distinct `tblemail`.`strTo` AS `ViewID`,`tblemail`.`strTo` AS `strView`,'' AS `DisplayName` from `tblemail` where ((not((`tblemail`.`strTo` like '%;%'))) and (`tblemail`.`strTo` <> '')) order by `tblemail`.`strTo`,`tblemail`.`strTo` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sysfaq`
--
ALTER TABLE `sysfaq`
  ADD PRIMARY KEY (`FAQID`);

--
-- Indexes for table `syslog`
--
ALTER TABLE `syslog`
  ADD PRIMARY KEY (`LogID`),
  ADD KEY `dtLog` (`dtLog`);

--
-- Indexes for table `syslogin`
--
ALTER TABLE `syslogin`
  ADD PRIMARY KEY (`LoginID`);

--
-- Indexes for table `sysmenulevel1`
--
ALTER TABLE `sysmenulevel1`
  ADD PRIMARY KEY (`MenuLevel1ID`),
  ADD KEY `strMenuLevel1` (`strMenuLevel1`);

--
-- Indexes for table `sysmenulevel2`
--
ALTER TABLE `sysmenulevel2`
  ADD PRIMARY KEY (`MenuLevel2ID`),
  ADD KEY `MenuLevel1ID` (`MenuLevel1ID`);

--
-- Indexes for table `sysmenusidebar`
--
ALTER TABLE `sysmenusidebar`
  ADD PRIMARY KEY (`MenuSidebarID`);

--
-- Indexes for table `syssecurity`
--
ALTER TABLE `syssecurity`
  ADD PRIMARY KEY (`refSecurityGroupID`,`refMenulevel2ID`);

--
-- Indexes for table `syssecuritygroup`
--
ALTER TABLE `syssecuritygroup`
  ADD PRIMARY KEY (`SecurityGroupID`);

--
-- Indexes for table `syssettings`
--
ALTER TABLE `syssettings`
  ADD PRIMARY KEY (`SettingID`);

--
-- Indexes for table `sysuser`
--
ALTER TABLE `sysuser`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `strUser` (`strUser`),
  ADD UNIQUE KEY `strEmail` (`strEmail`),
  ADD KEY `refSecurityGroupID` (`refSecurityGroupID`);

--
-- Indexes for table `tblemail`
--
ALTER TABLE `tblemail`
  ADD PRIMARY KEY (`EmailID`),
  ADD KEY `UniqueID` (`UniqueID`),
  ADD KEY `strTo` (`strTo`),
  ADD KEY `refEmailTemplateID` (`refEmailTemplateID`);

--
-- Indexes for table `tblemailtemplate`
--
ALTER TABLE `tblemailtemplate`
  ADD PRIMARY KEY (`EmailTemplateID`);

--
-- Indexes for table `tblpicture`
--
ALTER TABLE `tblpicture`
  ADD PRIMARY KEY (`PictureID`);

--
-- Indexes for table `tblproduct`
--
ALTER TABLE `tblproduct`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `tblProduct.strProductCategory` (`refProductCategoryID`),
  ADD KEY `tblProduct.strStore` (`refStoreID`);

--
-- Indexes for table `tblproductcategory`
--
ALTER TABLE `tblproductcategory`
  ADD PRIMARY KEY (`ProductCategoryID`);

--
-- Indexes for table `tblproductlocation`
--
ALTER TABLE `tblproductlocation`
  ADD PRIMARY KEY (`ProductLocationID`);

--
-- Indexes for table `tblshopper`
--
ALTER TABLE `tblshopper`
  ADD PRIMARY KEY (`ShopperID`),
  ADD KEY `tblShopper.strTitle` (`refTitleID`);

--
-- Indexes for table `tblshoppinglist`
--
ALTER TABLE `tblshoppinglist`
  ADD PRIMARY KEY (`ShoppingListID`);

--
-- Indexes for table `tblstore`
--
ALTER TABLE `tblstore`
  ADD PRIMARY KEY (`StoreID`);

--
-- Indexes for table `tbltitle`
--
ALTER TABLE `tbltitle`
  ADD PRIMARY KEY (`TitleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sysfaq`
--
ALTER TABLE `sysfaq`
  MODIFY `FAQID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `syslog`
--
ALTER TABLE `syslog`
  MODIFY `LogID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `syslogin`
--
ALTER TABLE `syslogin`
  MODIFY `LoginID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sysmenulevel1`
--
ALTER TABLE `sysmenulevel1`
  MODIFY `MenuLevel1ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `sysmenulevel2`
--
ALTER TABLE `sysmenulevel2`
  MODIFY `MenuLevel2ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT for table `sysmenusidebar`
--
ALTER TABLE `sysmenusidebar`
  MODIFY `MenuSidebarID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `syssecuritygroup`
--
ALTER TABLE `syssecuritygroup`
  MODIFY `SecurityGroupID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `syssettings`
--
ALTER TABLE `syssettings`
  MODIFY `SettingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `sysuser`
--
ALTER TABLE `sysuser`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tblemail`
--
ALTER TABLE `tblemail`
  MODIFY `EmailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tblemailtemplate`
--
ALTER TABLE `tblemailtemplate`
  MODIFY `EmailTemplateID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblpicture`
--
ALTER TABLE `tblpicture`
  MODIFY `PictureID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tblproduct`
--
ALTER TABLE `tblproduct`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblproductcategory`
--
ALTER TABLE `tblproductcategory`
  MODIFY `ProductCategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tblproductlocation`
--
ALTER TABLE `tblproductlocation`
  MODIFY `ProductLocationID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblshopper`
--
ALTER TABLE `tblshopper`
  MODIFY `ShopperID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblshoppinglist`
--
ALTER TABLE `tblshoppinglist`
  MODIFY `ShoppingListID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblstore`
--
ALTER TABLE `tblstore`
  MODIFY `StoreID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbltitle`
--
ALTER TABLE `tbltitle`
  MODIFY `TitleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `sysmenulevel2`
--
ALTER TABLE `sysmenulevel2`
  ADD CONSTRAINT `sysMenuLevel2_ibfk_1` FOREIGN KEY (`MenuLevel1ID`) REFERENCES `sysmenulevel1` (`MenuLevel1ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sysMenuLevel2_ibfk_2` FOREIGN KEY (`MenuLevel1ID`) REFERENCES `sysmenulevel1` (`MenuLevel1ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sysuser`
--
ALTER TABLE `sysuser`
  ADD CONSTRAINT `sysUser.strSecurityGroup` FOREIGN KEY (`refSecurityGroupID`) REFERENCES `syssecuritygroup` (`SecurityGroupID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblproduct`
--
ALTER TABLE `tblproduct`
  ADD CONSTRAINT `tblProduct.strProductCategory` FOREIGN KEY (`refProductCategoryID`) REFERENCES `tblproductcategory` (`ProductCategoryID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblProduct.strStore` FOREIGN KEY (`refStoreID`) REFERENCES `tblstore` (`StoreID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblshopper`
--
ALTER TABLE `tblshopper`
  ADD CONSTRAINT `tblShopper.strTitle` FOREIGN KEY (`refTitleID`) REFERENCES `tbltitle` (`TitleID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
