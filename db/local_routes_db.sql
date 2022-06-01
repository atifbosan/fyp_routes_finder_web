-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2021 at 12:32 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `local_routes_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_announcement`
--

CREATE TABLE `tbl_announcement` (
  `announcement_id` int(11) NOT NULL,
  `announcement_title` varchar(255) DEFAULT NULL,
  `announcement_description` text DEFAULT NULL,
  `announcement_for` enum('D','U','BDU') NOT NULL DEFAULT 'BDU',
  `announcement_status` enum('A','B') NOT NULL DEFAULT 'A',
  `createdBy` int(11) DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_announcement`
--

INSERT INTO `tbl_announcement` (`announcement_id`, `announcement_title`, `announcement_description`, `announcement_for`, `announcement_status`, `createdBy`, `createdDate`, `updatedBy`, `updatedDate`) VALUES
(3, 'Announcement for Driver', 'This is testing data', 'D', 'A', 1, '2021-04-27 09:38:57', NULL, NULL),
(4, 'Announcement for User', 'This is again testing data', 'U', 'A', 1, '2021-04-27 09:40:15', NULL, NULL),
(6, 'New Announcement', 'This is dummy data 1', 'BDU', 'A', 1, '2021-04-28 09:23:13', 1, '2021-05-16 07:43:59'),
(7, 'Mandi Moor Blockd', 'today mandi moore is blocked due to strike', 'BDU', 'A', 1, '2021-06-03 08:35:46', NULL, NULL),
(8, 'today is holiday', 'holyday', 'BDU', 'A', 1, '2021-06-04 11:14:28', NULL, NULL),
(9, 'kajkcvklfccvkl', 'jsdfjfjdjddjfcjfcj', 'BDU', 'A', 1, '2021-06-04 11:15:04', NULL, NULL),
(10, 'mahad shah', 'strike', 'BDU', 'A', 1, '2021-06-12 01:27:54', NULL, NULL),
(11, 'zmcm', 'mxzmx', 'BDU', 'A', 1, '2021-06-12 01:29:43', NULL, NULL),
(12, 'zmcm', 'mxzmx', 'BDU', 'A', 1, '2021-06-12 01:37:03', NULL, NULL),
(13, 'mahad', 'mahad', 'BDU', 'A', 1, '2021-06-12 01:37:41', NULL, NULL),
(14, 'mahad', 'mahad\r\n', 'BDU', 'A', 1, '2021-06-12 01:37:58', NULL, NULL),
(15, 'nisd', 'nn', 'BDU', 'A', 1, '2021-06-12 01:41:23', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cities`
--

CREATE TABLE `tbl_cities` (
  `id` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `city_ascii` varchar(255) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `country` varchar(55) NOT NULL,
  `iso2` varchar(255) NOT NULL,
  `iso3` varchar(255) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `capital` varchar(255) NOT NULL,
  `population` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cities`
--

INSERT INTO `tbl_cities` (`id`, `city`, `city_ascii`, `lat`, `lng`, `country`, `iso2`, `iso3`, `admin_name`, `capital`, `population`) VALUES
(2, 'Karachi', 'Karachi', '24.87', '66.99', 'Pakistan', 'PK', 'PAK', 'Sindh', 'admin', '12130000'),
(3, 'Gilgit', 'Gilgit', '35.9171', '74.3', 'Pakistan', 'PK', 'PAK', 'Gilgit-Baltistan', 'minor', '216760'),
(4, 'Chaman', 'Chaman', '30.925', '66.4463', 'Pakistan', 'PK', 'PAK', 'Balochist?n', '', '88568'),
(5, 'Turbat', 'Turbat', '25.9918', '63.0718', 'Pakistan', 'PK', 'PAK', 'Balochist?n', '', '147791'),
(6, 'Islamabad', 'Islamabad', '33.7', '73.1666', 'Pakistan', 'PK', 'PAK', 'Isl?m?b?d', 'primary', '780000'),
(7, 'Zhob', 'Zhob', '31.349', '69.4386', 'Pakistan', 'PK', 'PAK', 'Balochist?n', 'minor', '88356'),
(8, 'Quetta', 'Quetta', '30.22', '67.025', 'Pakistan', 'PK', 'PAK', 'Balochist?n', 'admin', '768000'),
(9, 'Hyderabad', 'Hyderabad', '25.38', '68.375', 'Pakistan', 'PK', 'PAK', 'Sindh', '', '1459000'),
(10, 'Mardan', 'Mardan', '34.2', '72.04', 'Pakistan', 'PK', 'PAK', 'Khyber Pakhtunkhwa', 'minor', '300424'),
(11, 'Saidu', 'Saidu', '34.75', '72.35', 'Pakistan', 'PK', 'PAK', 'Khyber Pakhtunkhwa', 'minor', '1860310'),
(12, 'Jhang', 'Jhang', '31.2804', '72.325', 'Pakistan', 'PK', 'PAK', 'Punjab', 'minor', '341210'),
(13, 'Kasur', 'Kasur', '31.1254', '74.455', 'Pakistan', 'PK', 'PAK', 'Punjab', 'minor', '290643'),
(14, 'Lahore', 'Lahore', '31.56', '74.35', 'Pakistan', 'PK', 'PAK', 'Punjab', 'admin', '6577000'),
(15, 'Nawabshah', 'Nawabshah', '26.2454', '68.4', 'Pakistan', 'PK', 'PAK', 'Sindh', 'minor', '229504'),
(16, 'Chiniot', 'Chiniot', '31.72', '72.98', 'Pakistan', 'PK', 'PAK', 'Punjab', 'minor', '201781'),
(17, 'Bannu', 'Bannu', '32.989', '70.5986', 'Pakistan', 'PK', 'PAK', 'Khyber Pakhtunkhwa', 'minor', '622419'),
(18, 'Sadiqabad', 'Sadiqabad', '28.3006', '70.1302', 'Pakistan', 'PK', 'PAK', 'Punjab', '', '189876'),
(19, 'Sukkur', 'Sukkur', '27.7136', '68.8486', 'Pakistan', 'PK', 'PAK', 'Sindh', 'minor', '417767'),
(20, 'Peshawar', 'Peshawar', '34.005', '71.535', 'Pakistan', 'PK', 'PAK', 'Khyber Pakhtunkhwa', 'admin', '1303000'),
(21, 'Bahawalpur', 'Bahawalpur', '29.39', '71.675', 'Pakistan', 'PK', 'PAK', 'Punjab', 'minor', '552607'),
(22, 'Sargodha', 'Sargodha', '32.0854', '72.675', 'Pakistan', 'PK', 'PAK', 'Punjab', 'minor', '542603'),
(23, 'Dera Ismail Khan', 'Dera Ismail Khan', '31.829', '70.8986', 'Pakistan', 'PK', 'PAK', 'Khyber Pakhtunkhwa', 'minor', '101616'),
(24, 'Kundian', 'Kundian', '32.4522', '71.4718', 'Pakistan', 'PK', 'PAK', 'Punjab', '', '35406'),
(25, 'Gwadar', 'Gwadar', '25.139', '62.3286', 'Pakistan', 'PK', 'PAK', 'Balochist?n', 'minor', '51901'),
(26, 'Parachinar', 'Parachinar', '33.8992', '70.1008', 'Pakistan', 'PK', 'PAK', 'Federally Administered Tribal Areas', '', '55685'),
(27, 'Larkana', 'Larkana', '27.5618', '68.2068', 'Pakistan', 'PK', 'PAK', 'Sindh', 'minor', '364033'),
(28, 'Kohat', 'Kohat', '33.6027', '71.4327', 'Pakistan', 'PK', 'PAK', 'Khyber Pakhtunkhwa', 'minor', '343027'),
(29, 'Rahim Yar Khan', 'Rahim Yar Khan', '28.4202', '70.2952', 'Pakistan', 'PK', 'PAK', 'Punjab', '', '353203'),
(30, 'Mirput Khas', 'Mirput Khas', '25.5318', '69.0118', 'Pakistan', 'PK', 'PAK', 'Sindh', 'minor', '356435'),
(31, 'Dera Ghazi Khan', 'Dera Ghazi Khan', '30.0604', '70.6351', 'Pakistan', 'PK', 'PAK', 'Punjab', 'minor', '236093'),
(32, 'Gujranwala', 'Gujranwala', '32.1604', '74.185', 'Pakistan', 'PK', 'PAK', 'Punjab', 'minor', '1513000'),
(33, 'Rawalpindi', 'Rawalpindi', '33.6', '73.04', 'Pakistan', 'PK', 'PAK', 'Punjab', 'minor', '1858000'),
(34, 'Gujrat', 'Gujrat', '32.58', '74.08', 'Pakistan', 'PK', 'PAK', 'Punjab', 'minor', '301506'),
(35, 'Sialkote', 'Sialkote', '32.52', '74.56', 'Pakistan', 'PK', 'PAK', 'Punjab', 'minor', '477396'),
(36, 'Mansehra', 'Mansehra', '34.3418', '73.1968', 'Pakistan', 'PK', 'PAK', 'Khyber Pakhtunkhwa', 'minor', '66486'),
(37, 'Abbottabad', 'Abbottabad', '34.1495', '73.1995', 'Pakistan', 'PK', 'PAK', 'Khyber Pakhtunkhwa', 'minor', '1183647'),
(38, 'Multan', 'Multan', '30.2', '71.455', 'Pakistan', 'PK', 'PAK', 'Punjab', 'minor', '1522000'),
(39, 'Sheikhu Pura', 'Sheikhu Pura', '31.72', '73.99', 'Pakistan', 'PK', 'PAK', 'Punjab', 'minor', '361303'),
(40, 'Sahiwal', 'Sahiwal', '30.6717', '73.1118', 'Pakistan', 'PK', 'PAK', 'Punjab', 'minor', '235695'),
(41, 'Okara', 'Okara', '30.8104', '73.45', 'Pakistan', 'PK', 'PAK', 'Punjab', 'minor', '223648'),
(42, 'Faisalabad', 'Faisalabad', '31.41', '73.11', 'Pakistan', 'PK', 'PAK', 'Punjab', 'minor', '2617000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_emergency_numbers`
--

CREATE TABLE `tbl_emergency_numbers` (
  `en_id` int(11) NOT NULL,
  `en_name` varchar(50) DEFAULT NULL,
  `en_number` varchar(30) DEFAULT NULL,
  `fk_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_emergency_numbers`
--

INSERT INTO `tbl_emergency_numbers` (`en_id`, `en_name`, `en_number`, `fk_user_id`) VALUES
(1, 'atif', '03335678876', 6),
(2, 'khan', '03026444343', 25),
(3, 'k', '03026444343', 25),
(4, 'Atif', '03026444343', 41),
(5, 'Hamza', '03215068152', 24);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notifications`
--

CREATE TABLE `tbl_notifications` (
  `noti_id` int(11) NOT NULL,
  `noti_title` varchar(255) DEFAULT NULL,
  `noti_type` enum('DP','UP','A') DEFAULT NULL,
  `noti_for` enum('D','U','A') DEFAULT NULL,
  `noti_fk_id` int(11) DEFAULT NULL,
  `noti_forUserID` int(11) DEFAULT NULL,
  `noti_status` enum('0','1') DEFAULT '0',
  `createdBy` int(11) DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_notifications`
--

INSERT INTO `tbl_notifications` (`noti_id`, `noti_title`, `noti_type`, `noti_for`, `noti_fk_id`, `noti_forUserID`, `noti_status`, `createdBy`, `createdDate`, `updatedBy`, `updatedDate`) VALUES
(4, 'New Announcement', 'A', 'D', 6, 2, '0', 1, '2021-04-28 09:23:13', NULL, NULL),
(5, 'New Announcement', 'A', 'U', 6, 3, '0', 1, '2021-04-28 09:23:13', NULL, NULL),
(6, 'New Announcement', 'A', 'U', 6, 4, '0', 1, '2021-04-28 09:23:13', NULL, NULL),
(7, 'New Announcement', 'A', 'D', 6, 2, '0', 1, '2021-05-16 07:43:59', NULL, NULL),
(8, 'New Announcement', 'A', 'U', 6, 3, '0', 1, '2021-05-16 07:43:59', NULL, NULL),
(9, 'atifbosan63@gmail.com request for registration', 'DP', 'A', 5, NULL, '1', NULL, '2021-06-02 14:29:23', NULL, NULL),
(10, 'mahad@gmail.com request for registration', 'UP', 'A', 6, NULL, '1', NULL, '2021-06-02 14:41:39', NULL, NULL),
(11, 'insha@gmail.com request for registration', 'DP', 'A', 7, NULL, '1', NULL, '2021-06-02 14:53:53', NULL, NULL),
(12, 'insha1@gmail.com request for registration', 'DP', 'A', 8, NULL, '1', NULL, '2021-06-02 14:55:25', NULL, NULL),
(13, 'mudasir@gmail.cim request for registration', 'DP', 'A', 9, NULL, '1', NULL, '2021-06-02 15:16:22', NULL, NULL),
(14, 'mudasir1@gmail.cim request for registration', 'DP', 'A', 10, NULL, '1', NULL, '2021-06-02 15:18:53', NULL, NULL),
(15, 'ak@gmail.com request for registration', 'DP', 'A', 11, NULL, '1', NULL, '2021-06-02 15:20:12', NULL, NULL),
(16, 'akhan@gmail.com request for registration', 'DP', 'A', 12, NULL, '1', NULL, '2021-06-02 15:24:51', NULL, NULL),
(17, 'ali223@gmail.com request for registration', 'DP', 'A', 15, NULL, '1', NULL, '2021-06-02 15:50:58', NULL, NULL),
(18, 'ali2213@gmail.com request for registration', 'DP', 'A', 16, NULL, '1', NULL, '2021-06-02 15:52:28', NULL, NULL),
(19, 'ali22131@gmail.com request for registration', 'DP', 'A', 17, NULL, '1', NULL, '2021-06-02 15:52:56', NULL, NULL),
(20, 'junaid@gmail.com request for registration', 'DP', 'A', 18, NULL, '1', NULL, '2021-06-02 15:56:21', NULL, NULL),
(21, 'ammar@gmail.com request for registration', 'UP', 'A', 19, NULL, '1', NULL, '2021-06-02 15:59:53', NULL, NULL),
(22, 'shahid@gmil.com request for registration', 'UP', 'A', 20, NULL, '1', NULL, '2021-06-02 16:02:23', NULL, NULL),
(23, 'ali222131@gmail.com request for registration', 'UP', 'A', 22, NULL, '1', NULL, '2021-06-02 16:13:27', NULL, NULL),
(24, 'ammaryasir@gmail.com request for registration', 'UP', 'A', 23, NULL, '1', NULL, '2021-06-02 16:17:34', NULL, NULL),
(25, 'shahmahad477@gmail.com request for registration', 'DP', 'A', 24, NULL, '1', NULL, '2021-06-02 23:47:10', NULL, NULL),
(26, 'atif@gmail.com request for registration', 'UP', 'A', 25, NULL, '1', NULL, '2021-06-02 23:57:01', NULL, NULL),
(27, 'Mandi Moor Blockd', 'A', 'D', 7, 24, '1', 1, '2021-06-03 08:35:46', NULL, NULL),
(28, 'Mandi Moor Blockd', 'A', 'U', 7, 25, '1', 1, '2021-06-03 08:35:46', NULL, NULL),
(29, 'ali222131@gmail.com request for registration', 'UP', 'A', 26, NULL, '1', NULL, '2021-06-04 14:27:41', NULL, NULL),
(30, 'al21234@gmail.com request for registration', 'UP', 'A', 27, NULL, '1', NULL, '2021-06-04 14:33:41', NULL, NULL),
(31, 'kham@gmail.com request for registration', 'DP', 'A', 28, NULL, '1', NULL, '2021-06-04 16:11:42', NULL, NULL),
(32, 'today is holiday', 'A', 'D', 8, 24, '1', 1, '2021-06-04 11:14:28', NULL, NULL),
(33, 'today is holiday', 'A', 'D', 8, 28, '1', 1, '2021-06-04 11:14:28', NULL, NULL),
(34, 'today is holiday', 'A', 'U', 8, 25, '1', 1, '2021-06-04 11:14:28', NULL, NULL),
(35, 'today is holiday', 'A', 'U', 8, 26, '0', 1, '2021-06-04 11:14:28', NULL, NULL),
(36, 'today is holiday', 'A', 'U', 8, 27, '0', 1, '2021-06-04 11:14:28', NULL, NULL),
(37, 'kajkcvklfccvkl', 'A', 'D', 9, 24, '1', 1, '2021-06-04 11:15:04', NULL, NULL),
(38, 'kajkcvklfccvkl', 'A', 'D', 9, 28, '1', 1, '2021-06-04 11:15:04', NULL, NULL),
(39, 'kajkcvklfccvkl', 'A', 'U', 9, 25, '1', 1, '2021-06-04 11:15:04', NULL, NULL),
(40, 'kajkcvklfccvkl', 'A', 'U', 9, 26, '0', 1, '2021-06-04 11:15:04', NULL, NULL),
(41, 'kajkcvklfccvkl', 'A', 'U', 9, 27, '0', 1, '2021-06-04 11:15:04', NULL, NULL),
(42, 'emanshah123@gmail.c9m request for registration', 'UP', 'A', 29, NULL, '1', NULL, '2021-06-04 16:17:01', NULL, NULL),
(43, 'yasir234@gmail.com request for registration', 'UP', 'A', 30, NULL, '1', NULL, '2021-06-04 16:17:11', NULL, NULL),
(44, 'insha1@gmail.com request for registration', 'UP', 'A', 31, NULL, '1', NULL, '2021-06-04 16:17:39', NULL, NULL),
(45, 'immad@gmail.com request for registration', 'DP', 'A', 32, NULL, '1', NULL, '2021-06-04 16:56:34', NULL, NULL),
(46, 'mudasir@gmail.com request for registration', 'UP', 'A', 33, NULL, '1', NULL, '2021-06-04 17:09:22', NULL, NULL),
(47, 'shahjee123@gmail.com request for registration', 'UP', 'A', 34, NULL, '1', NULL, '2021-06-04 17:12:30', NULL, NULL),
(48, 'ammar@gmail.com request for registration', 'DP', 'A', 35, NULL, '1', NULL, '2021-06-04 17:15:23', NULL, NULL),
(49, 'arslanshah12@gmail.com request for registration', 'DP', 'A', 36, NULL, '1', NULL, '2021-06-04 17:21:11', NULL, NULL),
(50, 'mazammilshah12@gmail.com request for registration', 'DP', 'A', 37, NULL, '1', NULL, '2021-06-12 18:26:14', NULL, NULL),
(51, 'mahad shah', 'A', 'D', 10, 24, '1', 1, '2021-06-12 01:27:54', NULL, NULL),
(52, 'mahad shah', 'A', 'D', 10, 28, '0', 1, '2021-06-12 01:27:54', NULL, NULL),
(53, 'mahad shah', 'A', 'D', 10, 36, '0', 1, '2021-06-12 01:27:54', NULL, NULL),
(54, 'mahad shah', 'A', 'D', 10, 37, '0', 1, '2021-06-12 01:27:54', NULL, NULL),
(55, 'mahad shah', 'A', 'U', 10, 25, '1', 1, '2021-06-12 01:27:54', NULL, NULL),
(56, 'mahad shah', 'A', 'U', 10, 26, '0', 1, '2021-06-12 01:27:54', NULL, NULL),
(57, 'mahad shah', 'A', 'U', 10, 27, '0', 1, '2021-06-12 01:27:54', NULL, NULL),
(58, 'mahad shah', 'A', 'U', 10, 29, '0', 1, '2021-06-12 01:27:54', NULL, NULL),
(59, 'mahad shah', 'A', 'U', 10, 30, '0', 1, '2021-06-12 01:27:54', NULL, NULL),
(60, 'mahad shah', 'A', 'U', 10, 31, '0', 1, '2021-06-12 01:27:54', NULL, NULL),
(61, 'mahad shah', 'A', 'U', 10, 33, '0', 1, '2021-06-12 01:27:54', NULL, NULL),
(62, 'mahad shah', 'A', 'U', 10, 34, '0', 1, '2021-06-12 01:27:54', NULL, NULL),
(63, 'noorinsha246@gmail.com request for registration', 'DP', 'A', 38, NULL, '1', NULL, '2021-06-12 18:28:15', NULL, NULL),
(64, 'zmcm', 'A', 'D', 11, 24, '1', 1, '2021-06-12 01:29:43', NULL, NULL),
(65, 'zmcm', 'A', 'D', 11, 28, '0', 1, '2021-06-12 01:29:43', NULL, NULL),
(66, 'zmcm', 'A', 'D', 11, 36, '0', 1, '2021-06-12 01:29:43', NULL, NULL),
(67, 'zmcm', 'A', 'D', 11, 37, '0', 1, '2021-06-12 01:29:43', NULL, NULL),
(68, 'zmcm', 'A', 'D', 11, 38, '1', 1, '2021-06-12 01:29:43', NULL, NULL),
(69, 'zmcm', 'A', 'U', 11, 25, '1', 1, '2021-06-12 01:29:43', NULL, NULL),
(70, 'zmcm', 'A', 'U', 11, 26, '0', 1, '2021-06-12 01:29:43', NULL, NULL),
(71, 'zmcm', 'A', 'U', 11, 27, '0', 1, '2021-06-12 01:29:43', NULL, NULL),
(72, 'zmcm', 'A', 'U', 11, 29, '0', 1, '2021-06-12 01:29:43', NULL, NULL),
(73, 'zmcm', 'A', 'U', 11, 30, '0', 1, '2021-06-12 01:29:43', NULL, NULL),
(74, 'zmcm', 'A', 'U', 11, 31, '0', 1, '2021-06-12 01:29:43', NULL, NULL),
(75, 'zmcm', 'A', 'U', 11, 33, '0', 1, '2021-06-12 01:29:43', NULL, NULL),
(76, 'zmcm', 'A', 'U', 11, 34, '0', 1, '2021-06-12 01:29:43', NULL, NULL),
(77, 'zmcm', 'A', 'D', 12, 24, '1', 1, '2021-06-12 01:37:03', NULL, NULL),
(78, 'zmcm', 'A', 'D', 12, 28, '0', 1, '2021-06-12 01:37:03', NULL, NULL),
(79, 'zmcm', 'A', 'D', 12, 36, '0', 1, '2021-06-12 01:37:03', NULL, NULL),
(80, 'zmcm', 'A', 'D', 12, 37, '0', 1, '2021-06-12 01:37:03', NULL, NULL),
(81, 'zmcm', 'A', 'D', 12, 38, '1', 1, '2021-06-12 01:37:03', NULL, NULL),
(82, 'zmcm', 'A', 'U', 12, 25, '1', 1, '2021-06-12 01:37:03', NULL, NULL),
(83, 'zmcm', 'A', 'U', 12, 26, '0', 1, '2021-06-12 01:37:03', NULL, NULL),
(84, 'zmcm', 'A', 'U', 12, 27, '0', 1, '2021-06-12 01:37:03', NULL, NULL),
(85, 'zmcm', 'A', 'U', 12, 29, '0', 1, '2021-06-12 01:37:03', NULL, NULL),
(86, 'zmcm', 'A', 'U', 12, 30, '0', 1, '2021-06-12 01:37:03', NULL, NULL),
(87, 'zmcm', 'A', 'U', 12, 31, '0', 1, '2021-06-12 01:37:03', NULL, NULL),
(88, 'zmcm', 'A', 'U', 12, 33, '0', 1, '2021-06-12 01:37:03', NULL, NULL),
(89, 'zmcm', 'A', 'U', 12, 34, '0', 1, '2021-06-12 01:37:03', NULL, NULL),
(90, 'mahad', 'A', 'D', 13, 24, '1', 1, '2021-06-12 01:37:41', NULL, NULL),
(91, 'mahad', 'A', 'D', 13, 28, '0', 1, '2021-06-12 01:37:41', NULL, NULL),
(92, 'mahad', 'A', 'D', 13, 36, '0', 1, '2021-06-12 01:37:41', NULL, NULL),
(93, 'mahad', 'A', 'D', 13, 37, '0', 1, '2021-06-12 01:37:41', NULL, NULL),
(94, 'mahad', 'A', 'D', 13, 38, '0', 1, '2021-06-12 01:37:41', NULL, NULL),
(95, 'mahad', 'A', 'U', 13, 25, '1', 1, '2021-06-12 01:37:41', NULL, NULL),
(96, 'mahad', 'A', 'U', 13, 26, '0', 1, '2021-06-12 01:37:41', NULL, NULL),
(97, 'mahad', 'A', 'U', 13, 27, '0', 1, '2021-06-12 01:37:41', NULL, NULL),
(98, 'mahad', 'A', 'U', 13, 29, '0', 1, '2021-06-12 01:37:41', NULL, NULL),
(99, 'mahad', 'A', 'U', 13, 30, '0', 1, '2021-06-12 01:37:41', NULL, NULL),
(100, 'mahad', 'A', 'U', 13, 31, '0', 1, '2021-06-12 01:37:41', NULL, NULL),
(101, 'mahad', 'A', 'U', 13, 33, '0', 1, '2021-06-12 01:37:41', NULL, NULL),
(102, 'mahad', 'A', 'U', 13, 34, '0', 1, '2021-06-12 01:37:41', NULL, NULL),
(103, 'mahad', 'A', 'D', 14, 24, '1', 1, '2021-06-12 01:37:58', NULL, NULL),
(104, 'mahad', 'A', 'D', 14, 28, '0', 1, '2021-06-12 01:37:58', NULL, NULL),
(105, 'mahad', 'A', 'D', 14, 36, '0', 1, '2021-06-12 01:37:58', NULL, NULL),
(106, 'mahad', 'A', 'D', 14, 37, '0', 1, '2021-06-12 01:37:58', NULL, NULL),
(107, 'mahad', 'A', 'D', 14, 38, '0', 1, '2021-06-12 01:37:58', NULL, NULL),
(108, 'mahad', 'A', 'U', 14, 25, '1', 1, '2021-06-12 01:37:58', NULL, NULL),
(109, 'mahad', 'A', 'U', 14, 26, '0', 1, '2021-06-12 01:37:58', NULL, NULL),
(110, 'mahad', 'A', 'U', 14, 27, '0', 1, '2021-06-12 01:37:58', NULL, NULL),
(111, 'mahad', 'A', 'U', 14, 29, '0', 1, '2021-06-12 01:37:58', NULL, NULL),
(112, 'mahad', 'A', 'U', 14, 30, '0', 1, '2021-06-12 01:37:58', NULL, NULL),
(113, 'mahad', 'A', 'U', 14, 31, '0', 1, '2021-06-12 01:37:58', NULL, NULL),
(114, 'mahad', 'A', 'U', 14, 33, '0', 1, '2021-06-12 01:37:58', NULL, NULL),
(115, 'mahad', 'A', 'U', 14, 34, '0', 1, '2021-06-12 01:37:58', NULL, NULL),
(116, 'nisd', 'A', 'D', 15, 24, '1', 1, '2021-06-12 01:41:23', NULL, NULL),
(117, 'nisd', 'A', 'D', 15, 28, '0', 1, '2021-06-12 01:41:23', NULL, NULL),
(118, 'nisd', 'A', 'D', 15, 36, '0', 1, '2021-06-12 01:41:23', NULL, NULL),
(119, 'nisd', 'A', 'D', 15, 37, '0', 1, '2021-06-12 01:41:23', NULL, NULL),
(120, 'nisd', 'A', 'D', 15, 38, '0', 1, '2021-06-12 01:41:23', NULL, NULL),
(121, 'nisd', 'A', 'U', 15, 25, '1', 1, '2021-06-12 01:41:23', NULL, NULL),
(122, 'nisd', 'A', 'U', 15, 26, '0', 1, '2021-06-12 01:41:23', NULL, NULL),
(123, 'nisd', 'A', 'U', 15, 27, '0', 1, '2021-06-12 01:41:23', NULL, NULL),
(124, 'nisd', 'A', 'U', 15, 29, '0', 1, '2021-06-12 01:41:23', NULL, NULL),
(125, 'nisd', 'A', 'U', 15, 30, '0', 1, '2021-06-12 01:41:23', NULL, NULL),
(126, 'nisd', 'A', 'U', 15, 31, '0', 1, '2021-06-12 01:41:23', NULL, NULL),
(127, 'nisd', 'A', 'U', 15, 33, '0', 1, '2021-06-12 01:41:23', NULL, NULL),
(128, 'nisd', 'A', 'U', 15, 34, '0', 1, '2021-06-12 01:41:23', NULL, NULL),
(129, 'alishahkhan998@gmail.com request for registration', 'DP', 'A', 39, NULL, '1', NULL, '2021-06-15 23:38:23', NULL, NULL),
(130, 'khan@gmail.com request for registration', 'UP', 'A', 40, NULL, '1', NULL, '2021-06-16 12:43:18', NULL, NULL),
(131, 'insha@gmail.com request for registration', 'DP', 'A', 41, NULL, '1', NULL, '2021-06-16 14:03:08', NULL, NULL),
(132, 'hamzabhati007@gmail.com request for registration', 'DP', 'A', 42, NULL, '1', NULL, '2021-06-17 14:22:16', NULL, NULL),
(133, 'immad@gmail.com request for registration', 'DP', 'A', 43, NULL, '1', NULL, '2021-06-18 15:03:02', NULL, NULL),
(134, 'junaid@gmail.com request for registration', 'UP', 'A', 44, NULL, '1', NULL, '2021-06-18 15:07:42', NULL, NULL),
(135, 'arslanali007@gmail.com request for registration', 'UP', 'A', 45, NULL, '1', NULL, '2021-06-18 15:20:49', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_routes`
--

CREATE TABLE `tbl_routes` (
  `route_id` int(11) NOT NULL,
  `route_title` varchar(255) DEFAULT NULL,
  `route_status` enum('A','B') NOT NULL DEFAULT 'A',
  `createdBy` int(11) DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_routes`
--

INSERT INTO `tbl_routes` (`route_id`, `route_title`, `route_status`, `createdBy`, `createdDate`, `updatedBy`, `updatedDate`) VALUES
(1, 'Saddar to Faizabad', 'A', 1, '2021-04-23 11:00:59', 1, '2021-04-23 11:06:04'),
(3, 'Mandi Moor to Faizabad', 'A', 1, '2021-05-08 11:25:58', 1, '2021-06-03 08:31:32'),
(4, 'Faizabad To Khana Pul', 'A', 1, '2021-06-04 08:07:02', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tracking`
--

CREATE TABLE `tbl_tracking` (
  `tracking_id` int(11) NOT NULL,
  `tracking_lat` double(16,7) DEFAULT NULL,
  `tracking_lng` double(16,7) DEFAULT NULL,
  `tracking_fk_user_id` int(11) DEFAULT NULL,
  `tracking_status` enum('ON','OFF') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_tracking`
--

INSERT INTO `tbl_tracking` (`tracking_id`, `tracking_lat`, `tracking_lng`, `tracking_fk_user_id`, `tracking_status`) VALUES
(3, 33.6030579, 73.0500644, 24, 'ON'),
(4, 33.6235278, 73.0674267, 39, 'ON'),
(5, 33.6337573, 73.0669690, 41, 'ON'),
(6, 33.5989885, 73.0068184, 42, 'ON');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `user_fullName` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_cnic` varchar(13) DEFAULT NULL,
  `user_contactNo` varchar(100) DEFAULT NULL,
  `user_address` text DEFAULT NULL,
  `user_cityID` int(11) DEFAULT NULL,
  `user_lat` decimal(16,6) DEFAULT NULL,
  `user_lng` decimal(16,6) DEFAULT NULL,
  `user_end_lat` double(16,7) DEFAULT NULL,
  `user_end_lng` double(16,7) DEFAULT NULL,
  `user_isOnline` enum('0','1') NOT NULL DEFAULT '1',
  `user_gender` enum('M','F') NOT NULL DEFAULT 'M',
  `user_type` enum('SA','D','U') NOT NULL DEFAULT 'U',
  `user_status` enum('P','R','A','B') NOT NULL DEFAULT 'P',
  `user_profileImage` varchar(255) DEFAULT NULL,
  `user_routeID` int(11) DEFAULT NULL,
  `user_vehicleID` int(11) DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_fullName`, `user_email`, `user_password`, `user_cnic`, `user_contactNo`, `user_address`, `user_cityID`, `user_lat`, `user_lng`, `user_end_lat`, `user_end_lng`, `user_isOnline`, `user_gender`, `user_type`, `user_status`, `user_profileImage`, `user_routeID`, `user_vehicleID`, `createdBy`, `createdDate`, `updatedBy`, `updatedDate`) VALUES
(1, 'Super Admin', 'admin@admin.com', 'c3284d0f94606de1fd2af172aba15bf3', '3740518315667', '0332-0569001', 'Rawalpindi', 33, NULL, NULL, NULL, NULL, '1', 'M', 'SA', 'A', NULL, NULL, NULL, 0, '2021-04-21 00:53:58', NULL, NULL),
(24, 'Mahad Shah', 'shahmahad477@gmail.com', '1f6606349fad7fa083fe1efcff917490', '3740575059771', '03125482003', '4, Saddar, Rawalpindi, Punjab 46000, Pakistan', 6, '33.596879', '73.052841', 0.0000000, 0.0000000, '1', 'M', 'D', 'A', 'uploads/297982-IMG-20210409-WA0082.jpg', 1, 1, NULL, '2021-06-02 23:47:10', 1, '2021-06-04 10:27:23'),
(25, 'Atif Bosan', 'atif@gmail.com', '190e19415e1a33f252686566c2b88083', '3240392698129', '03026444343', 'Islamabad', 6, '33.642278', '73.089648', NULL, NULL, '1', 'M', 'U', 'A', 'uploads/39906-IMG_20210602_164301.jpg', NULL, NULL, NULL, '2021-06-02 23:57:01', 1, '2021-06-03 08:44:32'),
(26, 'ali', 'ali222131@gmail.com', '9fc58423aa0341dd75c031e1b2fabe0a', 'asasa', 'asasas', 'asas', 1, '5151.000000', '12102.000000', NULL, NULL, '1', 'M', 'U', 'P', 'uploads/202918-WhatsApp Image 2021-05-31 at 9.10.58 PM.jpeg', NULL, NULL, NULL, '2021-06-04 14:27:41', NULL, NULL),
(29, 'Mahad Shah', 'emanshah123@gmail.c9m', 'c7b8ccb1c7626e2f63a89a5b730dd197', '3740575059771', '03125482003', 'Zhob', 7, '33.642246', '73.089579', NULL, NULL, '1', 'F', 'U', 'A', 'uploads/497823-images (1).jpeg', NULL, NULL, NULL, '2021-06-04 16:17:00', 1, '2021-06-04 11:17:38'),
(33, 'mudasir', 'mudasir@gmail.com', '20fcc5bea0730cec3454258bdff37e5c', '3240392698129', '03026444343', 'Islamabad', 6, '33.642247', '73.089580', NULL, NULL, '1', 'M', 'U', 'A', 'uploads/103503-IMG-20190430-WA0022.jpg', NULL, NULL, NULL, '2021-06-04 17:09:22', 1, '2021-06-04 12:09:42'),
(34, 'shahjee', 'shahjee123@gmail.com', 'a3af7fcbcb6888d7743e587bb264a0d3', '3740575059771', '03125482003', 'Islamabad', 6, '33.642249', '73.089564', NULL, NULL, '1', 'M', 'U', 'B', 'uploads/637466-Screenshot_20210603-201059.jpg', NULL, NULL, NULL, '2021-06-04 17:12:30', 1, '2021-06-04 12:17:11'),
(36, 'arslan', 'arslanshah12@gmail.com', 'd9d262cf7abff0cc3a09dc12bcdcdbc3', '3740575059771', '03125482003', '4, Saddar, Rawalpindi, Punjab 46000, Pakistan', 6, '33.596879', '73.052841', 33.6600115, 73.0833225, '1', 'M', 'D', 'A', 'uploads/257612-1622798738093.jpg', 1, 1, NULL, '2021-06-04 17:21:11', 1, '2021-06-13 06:31:55'),
(39, 'yasir', 'alishahkhan998@gmail.com', '29c11c6b5af0960af7b73467964d5335', '3740596325808', '03335232252', '917 Murree Rd, Faizabad, Rawalpindi, Islamabad, Punjab, Pakistan', 6, '33.660014', '73.083322', 33.6291354, 73.1135553, '1', 'M', 'D', 'A', 'uploads/776854-waqar.jpg', 1, 4, NULL, '2021-06-15 23:38:23', 1, '2021-06-15 06:40:10'),
(40, 'khan', 'khan@gmail.com', '29c11c6b5af0960af7b73467964d5335', '3740597064578', '03331234561', 'Quetta', 8, '33.633758', '73.066973', NULL, NULL, '1', 'M', 'U', 'A', 'uploads/65624-imae.jpg', NULL, NULL, NULL, '2021-06-16 12:43:18', 1, '2021-06-16 07:47:09'),
(41, 'insha', 'insha@gmail.com', '3b8cae0004c6d1c2c2a3d26acef753ec', '3240392698129', '03026444343', '4, Saddar, Rawalpindi, Punjab 46000, Pakistan', 6, '33.596882', '73.052841', 33.6600143, 73.0833225, '1', 'F', 'D', 'A', 'uploads/436761-IMG_20210610_121106.jpg', 1, 1, NULL, '2021-06-16 14:03:08', 1, '2021-06-16 09:03:29'),
(42, 'hamza bhati', 'hamzabhati007@gmail.com', '28936322a5eb164c9ced5a0166f93f15', '3740575059775', '03125482003', '4, Saddar, Rawalpindi, Punjab 46000, Pakistan', 33, '33.596879', '73.052841', 33.6600115, 73.0833225, '1', 'M', 'D', 'A', 'uploads/454790-IMG_20210617_124710.jpg', 1, 4, NULL, '2021-06-17 14:22:16', 1, '2021-06-17 09:23:33'),
(43, 'immad', 'immad@gmail.com', '8f46468e3d62d94cb84b55b3905293ef', '3240392698129', '03056444343', '4, Saddar, Rawalpindi, Punjab 46000, Pakistan', 2, '33.596882', '73.052841', 33.6600143, 73.0833225, '1', 'M', 'D', 'A', 'uploads/16098-IMG_20210617_112120.jpg', 1, 1, NULL, '2021-06-18 15:03:02', 1, '2021-06-18 10:03:13'),
(44, 'junaid', 'junaid@gmail.com', '03146b03117ed02216dbebdd35fb1f27', '3240392698129', '03026444343', 'Karachi', 2, '33.640098', '73.086593', NULL, NULL, '1', 'M', 'U', 'A', 'uploads/144042-IMG_20210617_112120.jpg', NULL, NULL, NULL, '2021-06-18 15:07:42', NULL, NULL),
(45, 'arslan ali', 'arslanali007@gmail.com', 'd9d262cf7abff0cc3a09dc12bcdcdbc3', '3740575059771', '03125482003', 'Islamabad', 6, '33.598988', '73.006818', NULL, NULL, '1', 'M', 'U', 'A', 'uploads/19718-IMG_20210617_202158.jpg', NULL, NULL, NULL, '2021-06-18 15:20:49', 1, '2021-06-18 12:30:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicles`
--

CREATE TABLE `tbl_vehicles` (
  `vehicle_id` int(11) NOT NULL,
  `vehicle_title` varchar(255) DEFAULT NULL,
  `vehicle_status` enum('A','B') NOT NULL DEFAULT 'A',
  `createdBy` int(11) DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_vehicles`
--

INSERT INTO `tbl_vehicles` (`vehicle_id`, `vehicle_title`, `vehicle_status`, `createdBy`, `createdDate`, `updatedBy`, `updatedDate`) VALUES
(1, 'Honda', 'A', 1, '2021-04-25 08:18:37', NULL, NULL),
(3, 'Rikhshaw', 'A', 1, '2021-04-25 08:42:06', NULL, NULL),
(4, 'Motorbike', 'A', 1, '2021-04-25 08:57:03', 1, '2021-04-25 08:59:27'),
(9, 'Suzuki', 'A', 1, '2021-06-03 08:31:57', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_announcement`
--
ALTER TABLE `tbl_announcement`
  ADD PRIMARY KEY (`announcement_id`);

--
-- Indexes for table `tbl_cities`
--
ALTER TABLE `tbl_cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_emergency_numbers`
--
ALTER TABLE `tbl_emergency_numbers`
  ADD PRIMARY KEY (`en_id`);

--
-- Indexes for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  ADD PRIMARY KEY (`noti_id`);

--
-- Indexes for table `tbl_routes`
--
ALTER TABLE `tbl_routes`
  ADD PRIMARY KEY (`route_id`);

--
-- Indexes for table `tbl_tracking`
--
ALTER TABLE `tbl_tracking`
  ADD PRIMARY KEY (`tracking_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_vehicles`
--
ALTER TABLE `tbl_vehicles`
  ADD PRIMARY KEY (`vehicle_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_announcement`
--
ALTER TABLE `tbl_announcement`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_cities`
--
ALTER TABLE `tbl_cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_emergency_numbers`
--
ALTER TABLE `tbl_emergency_numbers`
  MODIFY `en_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  MODIFY `noti_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `tbl_routes`
--
ALTER TABLE `tbl_routes`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_tracking`
--
ALTER TABLE `tbl_tracking`
  MODIFY `tracking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tbl_vehicles`
--
ALTER TABLE `tbl_vehicles`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
