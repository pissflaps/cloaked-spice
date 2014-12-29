-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 15, 2011 at 12:55 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbase`
--
CREATE DATABASE `dbase` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dbase`;

-- --------------------------------------------------------

--
-- Table structure for table `backup`
--

CREATE TABLE IF NOT EXISTS `backup` (
  `Ticket` int(7) NOT NULL,
  `Date` text NOT NULL,
  `STime` time NOT NULL,
  `ETA` time NOT NULL,
  `Priority` smallint(2) NOT NULL,
  `Site` text NOT NULL,
  `Comments` longtext,
  `Deleted` text,
  `Removed_Datetime` text NOT NULL,
  PRIMARY KEY (`Ticket`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `backup`
--

INSERT INTO `backup` (`Ticket`, `Date`, `STime`, `ETA`, `Priority`, `Site`, `Comments`, `Deleted`, `Removed_Datetime`) VALUES
(373986, '7/6/2011', '09:32:03', '11:32:03', 9, 'JOHNSON DIVERSEY     ', 'System not processing any data', 'X', '2011-07-06 09:32:03'),
(374007, '6/28/2011', '15:59:14', '17:59:14', 9, 'CDR MANAGED SERVICES', 'SERVER 2', 'X', '2011-06-30 10:26:37'),
(374023, '6/30/2011', '07:51:21', '09:51:21', 4, 'HMA-WUESTHOFF ROCKLEDGE MED CT', 'IP ADDRESS CHANGE', 'X', '0000-00-00'),
(374028, '6/30/2011', '07:51:56', '09:51:56', 2, 'WORK FORCE OF CENTRAL FLORIDA ', 'Abandoned Calls Report', 'X', '0000-00-00'),
(374034, '6/30/2011', '07:52:18', '09:52:18', 4, 'MCKINSEY & COMPANY', 'Tandem Call Matching', 'X', '0000-00-00'),
(374039, '6/30/2011', '10:44:52', '12:44:52', 4, 'B A E SYSTEMS', 'LD Calls showing as Local Calls\r\n', 'X', '2011-06-30 10:44:52'),
(374049, '7/1/2011', '12:45:47', '14:45:47', 4, 'BOAT US ALEXANDRIA', '', 'X', '2011-07-01 12:45:47'),
(374055, '7/1/2011', '11:40:10', '13:40:10', 4, 'Badger State Univ', 'Reporting Questions', 'X', '2011-07-01 11:40:10'),
(374088, '7/1/2011', '13:05:06', '15:05:06', 4, 'CHAROLETTE COUNTY IT', '', 'X', '2011-07-01 13:05:06'),
(374114, '7/5/2011', '07:00:01', '09:00:01', 2, 'SALT LAKE COMMUNITY COLLEGES  ', 'Assist with setting up new user', 'X', '2011-07-05 07:00:01'),
(374115, '7/5/2011', '07:25:57', '09:25:57', 4, 'RUTGERS UNIVERSITY  ', 'Not able to access report portal', 'X', '2011-07-05 07:25:57'),
(374121, '7/5/2011', '09:44:31', '11:44:31', 4, 'AAA EAST CENTRAL     ', 'Not Collecting', 'X', '2011-07-05 09:44:31'),
(374123, '7/5/2011', '09:58:29', '11:58:29', 4, 'COMMSCOPE, INC. ', 'Activate site\r\n', 'X', '2011-07-05 09:58:29'),
(374124, '7/5/2011', '10:04:33', '12:04:33', 2, 'MORAINE VALLEY COMM COLLEGE   ', 'Down System', 'X', '2011-07-05 10:04:33'),
(374125, '7/5/2011', '10:27:11', '12:27:11', 2, 'AMERITAS LIFE INSURANCE CORP  ', 'Autoreport trouble.', 'X', '2011-07-05 10:27:11'),
(374128, '7/5/2011', '10:48:38', '12:48:38', 4, 'MEMORIAL HOSPITAL & HEALTH SYS', 'Cost to transfer  call', '', '2011-07-05 10:48:38'),
(374130, '7/5/2011', '11:18:12', '13:18:12', 4, 'TAHITI VILLAGE VACATION   ', '', 'X', '2011-07-05 11:18:12'),
(374133, '7/5/2011', '12:12:59', '14:12:59', 4, 'CA NATIONAL GUARD SACRAMENTO  ', 'Auth Codes', '', '2011-07-05 12:12:59'),
(374136, '7/5/2011', '13:20:47', '15:20:47', 9, 'PALOS COMMUNITY HOSPITAL    ', 'DOWN SYSTEM', 'X', '2011-07-05 13:20:47'),
(374139, '7/5/2011', '14:10:27', '16:10:27', 4, 'ST BARNABAS SBO     ', '', 'X', '2011-07-05 14:10:27'),
(374145, '7/5/2011', '16:38:15', '18:38:15', 4, 'EXPRESS, LLC   ', 'HDD FULL', '', '2011-07-05 16:38:15'),
(374146, '7/5/2011', '17:03:11', '19:03:11', 2, 'ALEXIAN BROTHERS MED CTR BIEST', 'Post-install Web errors', 'X', '2011-07-05 17:03:11'),
(374147, '7/5/2011', '17:53:06', '19:53:06', 4, 'GILEAD SCIENCES INC   ', 'Logs not collecting.', '', '2011-07-05 17:53:06'),
(374149, '7/6/2011', '08:37:34', '10:37:34', 9, 'ARMSTRONG WORLD INDUSTRIES ', 'Down System ', '', '2011-07-06 08:37:34'),
(374150, '7/6/2011', '08:57:56', '10:57:56', 9, 'NORTHWEST MISSISSIPPI COM CLG ', 'System not processing since 6/25/11...getting errors in isvprocess', '', '2011-07-06 08:57:56'),
(374153, '7/6/2011', '09:55:40', '11:55:40', 4, 'COVANTAGE CREDIT UNION    ', 'no cdr alarms incorrect', '', '2011-07-06 09:55:40'),
(374155, '7/6/2011', '10:37:38', '12:37:38', 2, 'SHERMAN HOSPITAL', 'AUTOREPORT SETTINGS', '', '2011-07-06 10:37:38');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE IF NOT EXISTS `tickets` (
  `Ticket` int(7) NOT NULL,
  `Date` text NOT NULL,
  `STime` time NOT NULL,
  `ETA` time NOT NULL,
  `Priority` smallint(2) NOT NULL,
  `Site` text NOT NULL,
  `Comments` longtext,
  `Deleted` text,
  `Removed_Datetime` text NOT NULL,
  PRIMARY KEY (`Ticket`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`Ticket`, `Date`, `STime`, `ETA`, `Priority`, `Site`, `Comments`, `Deleted`, `Removed_Datetime`) VALUES
(123455, '7/12/2011', '11:08:25', '13:08:25', 2, 'test', '', 'X', '2011-07-12 11:08:25'),
(372452, '7/12/2011', '08:27:11', '10:27:11', 4, 'CHILDRENS MEDICAL CENTER  ', '', 'X', '2011-07-12 08:27:11'),
(373656, '7/6/2011', '14:30:16', '16:30:16', 2, 'MN NATIONAL GUARD SAINT PAUL ', 'RateTable not getting downloaded.', 'X', '2011-07-06 14:30:16'),
(373986, '7/6/2011', '09:32:03', '11:32:03', 9, 'JOHNSON DIVERSEY     ', 'System not processing any data', 'X', '2011-07-06 09:32:03'),
(374001, '7/8/2011', '11:52:45', '13:52:45', 2, 'CAPITAL GROUP ', 'SP 4041', 'X', '2011-07-08 11:52:45'),
(374005, '7/11/2011', '15:08:14', '17:08:14', 4, 'LIZ CLAIBORNE N BERGEN     ', 'CCM Upgrade from 4.1.3 TO 7.1.3', 'X', '2011-07-11 15:08:14'),
(374007, '6/28/2011', '15:59:14', '17:59:14', 9, 'CDR MANAGED SERVICES', 'SERVER 2', 'X', '2011-06-30 10:26:37'),
(374012, '7/12/2011', '11:39:06', '13:39:06', 4, 'COUNTY OF FRESNO', 'Cell phone bill import', '', '2011-07-12 11:39:06'),
(374023, '6/30/2011', '07:51:21', '09:51:21', 4, 'HMA-WUESTHOFF ROCKLEDGE MED CT', 'IP ADDRESS CHANGE', 'X', '0000-00-00'),
(374028, '6/30/2011', '07:51:56', '09:51:56', 2, 'WORK FORCE OF CENTRAL FLORIDA ', 'Abandoned Calls Report', 'X', '0000-00-00'),
(374034, '6/30/2011', '07:52:18', '09:52:18', 4, 'MCKINSEY & COMPANY', 'Tandem Call Matching', 'X', '0000-00-00'),
(374039, '6/30/2011', '10:44:52', '12:44:52', 4, 'B A E SYSTEMS', 'LD Calls showing as Local Calls\r\n', 'X', '2011-06-30 10:44:52'),
(374049, '7/1/2011', '12:45:47', '14:45:47', 4, 'BOAT US ALEXANDRIA', '', 'X', '2011-07-01 12:45:47'),
(374055, '7/1/2011', '11:40:10', '13:40:10', 4, 'Badger State Univ', 'Reporting Questions', 'X', '2011-07-01 11:40:10'),
(374088, '7/1/2011', '13:05:06', '15:05:06', 4, 'CHAROLETTE COUNTY IT', '', 'X', '2011-07-01 13:05:06'),
(374114, '7/5/2011', '07:00:01', '09:00:01', 2, 'SALT LAKE COMMUNITY COLLEGES  ', 'Assist with setting up new user', 'X', '2011-07-05 07:00:01'),
(374115, '7/5/2011', '07:25:57', '09:25:57', 4, 'RUTGERS UNIVERSITY  ', 'Not able to access report portal', 'X', '2011-07-05 07:25:57'),
(374121, '7/5/2011', '09:44:31', '11:44:31', 4, 'AAA EAST CENTRAL     ', 'Not Collecting', 'X', '2011-07-05 09:44:31'),
(374123, '7/5/2011', '09:58:29', '11:58:29', 4, 'COMMSCOPE, INC. ', 'Activate site\r\n', 'X', '2011-07-05 09:58:29'),
(374124, '7/5/2011', '10:04:33', '12:04:33', 2, 'MORAINE VALLEY COMM COLLEGE   ', 'Down System', 'X', '2011-07-05 10:04:33'),
(374125, '7/5/2011', '10:27:11', '12:27:11', 2, 'AMERITAS LIFE INSURANCE CORP  ', 'Autoreport trouble.', 'X', '2011-07-05 10:27:11'),
(374128, '7/7/2011', '07:48:38', '09:48:38', 4, 'MEMORIAL HOSPITAL & HEALTH SYS', 'R/A FROM DES', 'X', ''),
(374130, '7/5/2011', '11:18:12', '13:18:12', 4, 'TAHITI VILLAGE VACATION   ', '', 'X', '2011-07-05 11:18:12'),
(374133, '7/5/2011', '12:12:59', '14:12:59', 4, 'CA NATIONAL GUARD SACRAMENTO  ', 'Auth Codes', 'X', '2011-07-05 12:12:59'),
(374136, '7/5/2011', '13:20:47', '15:20:47', 9, 'PALOS COMMUNITY HOSPITAL    ', 'DOWN SYSTEM', 'X', '2011-07-05 13:20:47'),
(374139, '7/5/2011', '14:10:27', '16:10:27', 4, 'ST BARNABAS SBO     ', '', 'X', '2011-07-05 14:10:27'),
(374145, '7/5/2011', '16:38:15', '18:38:15', 9, 'EXPRESS, LLC   ', 'HDD FULL', 'X', '2011-07-05 16:38:15'),
(374146, '7/5/2011', '17:03:11', '19:03:11', 2, 'ALEXIAN BROTHERS MED CTR BIEST', 'Post-install Web errors', 'X', '2011-07-05 17:03:11'),
(374147, '7/5/2011', '17:53:06', '19:53:06', 9, 'GILEAD SCIENCES INC   ', 'Logs not collecting.', 'X', '2011-07-05 17:53:06'),
(374149, '7/6/2011', '08:37:34', '10:37:34', 9, 'ARMSTRONG WORLD INDUSTRIES ', 'Down System ', 'X', '2011-07-06 08:37:34'),
(374150, '7/6/2011', '08:57:56', '10:57:56', 9, 'NORTHWEST MISSISSIPPI COM CLG ', 'System not processing since 6/25/11...getting errors in isvprocess', 'X', '2011-07-06 08:57:56'),
(374153, '7/6/2011', '09:55:40', '11:55:40', 4, 'COVANTAGE CREDIT UNION    ', 'no cdr alarms incorrect', 'X', '2011-07-06 09:55:40'),
(374155, '7/6/2011', '10:37:38', '12:37:38', 2, 'SHERMAN HOSPITAL', 'AUTOREPORT SETTINGS', 'X', '2011-07-06 10:37:38'),
(374157, '7/6/2011', '11:38:56', '13:38:56', 2, 'EISENHOWER MEDICAL CENTER     ', 'UNDEFINED GATEWAYS', 'X', '2011-07-06 11:38:56'),
(374158, '7/6/2011', '17:40:18', '19:40:18', 2, 'EISENHOWER MEDICAL CENTER   ', 'R/A FROM DES', 'X', '2011-07-06 17:40:18'),
(374159, '7/6/2011', '11:57:25', '13:57:25', 2, 'TEACHERS CREDIT UNION ', 'Autoreports & Directory Management', 'X', '2011-07-06 11:57:25'),
(374161, '7/6/2011', '12:53:40', '14:53:40', 9, 'PRESBYTERIAN INTERCOMM HOSP   ', 'DOWN SYSTEM', 'X', '2011-07-06 12:53:40'),
(374164, '7/6/2011', '13:42:39', '15:42:39', 2, 'WORK FORCE OF CENTRAL FLORIDA ', 'Call Transfer Report help', 'X', '2011-07-06 13:42:39'),
(374166, '7/6/2011', '14:38:32', '16:38:32', 4, 'TOWN OF NORTH HEMPSTEAD TOWN H', 'Add user so they can run reports of the from the web', 'X', '2011-07-06 14:38:32'),
(374168, '7/6/2011', '15:39:14', '17:39:14', 4, 'WASHINGTON STATE UNIVERSITY   ', 'Assist with runnig report for one time charge', 'X', '2011-07-06 15:39:14'),
(374171, '7/6/2011', '16:01:38', '18:01:38', 2, 'CABELAS              ', 'Call Forwarding Issues', 'X', '2011-07-06 16:01:38'),
(374175, '7/7/2011', '07:19:35', '09:19:35', 9, 'OUR LADY OF BELLEFONTE HOSP', 'MISSING DATA', 'X', '2011-07-07 07:19:35'),
(374177, '7/7/2011', '10:07:04', '12:07:04', 9, 'COLORADO COMMUNITY COLLEGE ', 'DOWN SYSTEM', 'X', '2011-07-07 10:07:04'),
(374184, '7/7/2011', '12:50:35', '14:50:35', 9, 'CITY OF ANDERSON', 'DOWN SYSTEM', 'X', '2011-07-07 12:50:35'),
(374186, '7/7/2011', '13:18:00', '15:18:00', 2, 'FORT SAM HOUSTON ISD  ', 'AUTH CODES ', 'X', '2011-07-07 13:18:00'),
(374188, '7/7/2011', '14:16:23', '16:16:23', 2, 'OHIO STATE LOTTERY      ', 'Autoreport Emailing assistance', 'X', '2011-07-07 14:16:23'),
(374191, '7/7/2011', '15:34:10', '17:34:10', 4, 'Childrens National ', 'Rate table expired error', 'X', '2011-07-07 15:34:10'),
(374195, '7/11/2011', '15:25:27', '17:25:27', 9, 'STATE OF MD-BOWIE #1 ADMIN    ', 'Down System', 'X', '2011-07-11 15:25:27'),
(374196, '7/8/2011', '08:45:44', '10:45:44', 4, 'WYNDHAM VACATION OWNERSHIP    ', '', 'X', '2011-07-08 08:45:44'),
(374207, '7/8/2011', '10:01:02', '12:01:02', 2, 'MIDLAND COUNTY  ', '', 'X', '2011-07-08 10:01:02'),
(374209, '7/8/2011', '11:13:31', '13:13:31', 2, 'COLLIN COUNTY COMMUNITY COLLEG', 'CTI Route point issue', 'X', '2011-07-08 11:13:31'),
(374215, '7/8/2011', '13:58:57', '15:58:57', 2, 'LIFE ALERT EMERGENCY RESPONSE ', 'HUNT GROUPS', 'X', '2011-07-08 13:58:57'),
(374222, '7/8/2011', '15:25:51', '17:25:51', 2, 'UCAR NCAR   ', 'Rate table questions', 'X', '2011-07-08 15:25:51'),
(374230, '7/11/2011', '08:50:50', '10:50:50', 2, 'AMERICREDIT    ', 'SFTP Questions', 'X', '2011-07-11 08:50:50'),
(374233, '7/11/2011', '09:02:11', '11:02:11', 4, 'CALAMOS INVESTMENTS ', 'DATASOURCE CONFIG', 'X', '2011-07-11 09:02:11'),
(374237, '7/11/2011', '09:58:39', '11:58:39', 2, 'HUBBELL POWER SYSTEMS      ', 'SMTP & Email changes', 'X', '2011-07-11 09:58:39'),
(374238, '7/11/2011', '10:08:39', '12:08:39', 4, 'WESTINGHOUSE CRANBERRY TWP  ', '', 'X', '2011-07-11 10:08:39'),
(374240, '7/11/2011', '10:50:18', '12:50:18', 9, 'ANDREWS & KURTH HOUSTON    ', 'All Remote collections Failing', 'X', '2011-07-11 10:50:18'),
(374242, '7/11/2011', '11:14:09', '13:14:09', 2, 'CITY OF PEORIA  ', '911 ALARMS', 'X', '2011-07-11 11:14:09'),
(374245, '7/11/2011', '13:03:57', '15:03:57', 4, 'TECK RESOURCES LIMITED   ', 'Costing all off', 'X', '2011-07-11 13:03:57'),
(374247, '7/11/2011', '18:50:28', '20:50:28', 4, 'IDAHO STATE POLICE  ', 'Error in logs', 'X', '2011-07-11 18:50:28'),
(374249, '7/12/2011', '06:54:24', '08:54:24', 9, 'Johnson Diversey', 'Unable to process reports for all sites', 'X', '2011-07-12 06:54:24'),
(374254, '7/12/2011', '09:35:47', '11:35:47', 4, 'AVX CORPORATION', '', 'X', '2011-07-12 09:35:47'),
(374259, '7/12/2011', '10:02:28', '12:02:28', 4, 'RAPPAHANNOCK ELECTRIC COOP    ', '', 'X', '2011-07-12 10:02:28'),
(374260, '7/12/2011', '10:12:15', '12:12:15', 2, 'TSA INFRASTRUCTURE ', 'Assistance with RT update', 'X', '2011-07-12 10:12:15'),
(374262, '7/12/2011', '10:56:00', '12:56:00', 4, 'BOY SCOUTS OF AMERICA   ', 'Att Importr issues', 'X', '2011-07-12 10:56:00'),
(374263, '7/12/2011', '11:02:25', '13:02:25', 2, 'CULTURAL MISSION OF THE ROYAL ', 'System crashes several times', 'X', '2011-07-12 11:02:25'),
(374264, '7/12/2011', '11:21:02', '13:21:02', 4, 'BENTLEY COLLEGE    ', 'Cant Login', 'X', '2011-07-12 11:21:02'),
(374266, '7/12/2011', '12:09:18', '14:09:18', 2, 'PUTNAM INVESTMENTS  ', '', 'X', '2011-07-12 12:09:18'),
(374275, '7/13/2011', '07:20:05', '09:20:05', 4, 'VISA - FOSTER CITY  (main)    ', 'Active Stations Count', 'X', '2011-07-13 07:20:05'),
(374277, '7/13/2011', '08:23:15', '10:23:15', 2, 'Boat US', 'Trunk Analysis Report questions', '', '2011-07-13 08:23:15'),
(374286, '7/13/2011', '11:35:59', '13:35:59', 4, 'METROPOLITAN WATER DIST. HQ   ', 'FAILED EXPORT', 'X', '2011-07-13 11:35:59'),
(374287, '7/13/2011', '12:03:01', '14:03:01', 9, 'KETTERING MEDICAL CENTER  ', 'DOWN SYSTEM', 'X', '2011-07-13 12:03:01'),
(374288, '7/13/2011', '12:12:30', '14:12:30', 2, 'CAPITAL GROUP    ', 'Directory assistance.', 'X', '2011-07-13 12:12:30'),
(374289, '7/13/2011', '12:25:22', '14:25:22', 9, 'MAMMOTH MOUNTAIN SKI RESORT ', 'MISSING INB CDR', 'X', '2011-07-13 12:25:22'),
(374290, '7/13/2011', '12:59:02', '14:59:02', 2, 'TOWN OF NORTH HEMPSTEAD TOWN H', 'Explain why they need rate tables', 'X', '2011-07-13 12:59:02'),
(374292, '7/13/2011', '13:06:52', '15:06:52', 2, 'STATE OF OR  ', 'Processing 100K calls', 'X', '2011-07-13 13:06:52'),
(374295, '7/13/2011', '13:16:09', '15:16:09', 4, 'HILTON GRAND VACATION CO', 'wants to be able to Collect zero Duration caalls', 'X', '2011-07-13 13:16:09'),
(374297, '7/14/2011', '07:51:07', '09:51:07', 4, 'RUTGERS UNIVERSITY        ', 'Costing incorrectly for a internal call', 'X', '2011-07-14 07:51:07'),
(374298, '7/14/2011', '09:31:29', '11:31:29', 2, 'ESSEX COUNTY CORRECTIONAL  ', '', 'X', '2011-07-14 09:31:29'),
(374310, '7/14/2011', '10:57:57', '12:57:57', 4, 'RE SOURCES USA', 'Help with Report', 'X', '2011-07-14 10:57:57'),
(374312, '7/14/2011', '11:56:05', '13:56:05', 2, 'STATE OF ARIZONA - ADOA      ', 'CALL COSTING', '', '2011-07-14 11:56:05'),
(374314, '7/14/2011', '12:31:32', '14:31:32', 2, 'UNION LEAGUE CLUB OF CHICAGO  ', 'Summary Report Help', 'X', '2011-07-14 12:31:32'),
(374317, '7/14/2011', '14:37:26', '16:37:26', 2, 'HAWAII NATIONAL BANK    ', 'TIME DIFFERENCE', 'X', '2011-07-14 14:37:26'),
(374320, '7/14/2011', '16:35:16', '18:35:16', 2, 'UNIVERSITY OF ARKANSAS FT SMIT', 'DIRECTORY FULL', '', '2011-07-14 16:35:16'),
(374322, '7/14/2011', '16:59:49', '18:59:49', 9, 'US DEPARTMENT OF JUSTICE ', 'DOWN SYSTEM', '', '2011-07-14 16:59:49'),
(374324, '7/14/2011', '17:27:48', '19:27:48', 2, 'EISENHOWER MEDICAL CENTER    ', 'Phone Number Search', '', '2011-07-14 17:27:48');
