-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2021 at 03:21 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scanncat_papun`
--

-- --------------------------------------------------------

--
-- Table structure for table `sidebar_menu`
--

CREATE TABLE `sidebar_menu` (
  `id` int(11) NOT NULL,
  `order_by` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `folder_name` varchar(255) DEFAULT NULL,
  `icon` longtext DEFAULT NULL,
  `access_account` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sidebar_menu`
--

INSERT INTO `sidebar_menu` (`id`, `order_by`, `name`, `folder_name`, `icon`, `access_account`, `status`) VALUES
(1, 1, 'Dashboard', 'dashboard', '<span class=\"glyphicon glyphicon-dashboard\" style=\"color: #C60 !important;\"></span>', '1,2', 1),
(2, 2, 'Customer Details', 'marketing', '<span class=\"glyphicon glyphicon-user\" style=\"color: #00CEC4 !important;\"></span>', '1', 1),
(3, 2, 'Manage Tables', 'new_table_view', '<span class=\"glyphicon glyphicon-text-size\" style=\"color: #D92723 !important;\"></span>', '1', 1),
(4, 4, 'Pending Order', 'newOrder', '<span class=\"glyphicon glyphicon-shopping-cart\" style=\"color:  #f12711 !important;\"></span> ', '1,2', 1),
(5, 5, 'Completed Order', 'completedOrder', '<span class=\"glyphicon glyphicon-ok-sign\" style=\"color: #38ef7d !important;\"></span>', '1,2', 1),
(6, 8, 'Add Food', 'addNewFood', ' <span class=\"glyphicon glyphicon-cutlery\" style=\"color: #b21f1f !important;\"></span>', '1,2', 1),
(7, 9, 'Add Food Category', 'category', '<span class=\"glyphicon glyphicon-subtitles\" style=\"color: #fdbb2d !important;\"></span>', '1', 1),
(8, 10, 'QR setting', 'tableQr', '<span class=\"glyphicon glyphicon-qrcode\" style=\"color: white !important;\"></span>', '1', 1),
(9, 11, 'Notification Setting', 'notification', '<span class=\"glyphicon glyphicon-bell\" style=\"color: #C60 !important;\"></span>', '1', 0),
(10, 12, 'Tax and other charges', 'charges', '<span class=\"glyphicon glyphicon-th-list\" style=\"color:#45a247 !important;\"></span>', '1', 1),
(11, 13, 'Invoice Setting', 'invoice', '<span class=\"glyphicon glyphicon-file\" style=\"color: #56CCF2 !important;\"></span>', '1', 1),
(12, 14, 'Settings', 'setting', '<span class=\"glyphicon glyphicon-cog\" style=\"color: #C60 !important;\"></span>', '1', 1),
(13, 15, 'Stock Management', 'inventory', '<span class=\"glyphicon glyphicon-equalizer\" style=\"color: #ffd452 !important;\"></span>', '1,2', 1),
(14, 7, 'Food Item Report', 'food_report', '<span class=\"glyphicon glyphicon-signal\" style=\"color: #56CCF2 !important;\"></span>', '1,2', 1),
(15, 17, 'Payment Method', 'payment_method', '<span class=\"glyphicon glyphicon-usd\" style=\"color:#00F260 !important;\"></span>', '1', 1),
(16, 18, 'Slider Settings', 'slider', '<span class=\"glyphicon glyphicon-cog\" style=\"color: #C60 !important;\"></span>', '1', 0),
(17, 6, 'Report', 'daily_report', '<span class=\"glyphicon glyphicon-th-list\" style=\"color: #2F80ED !important;\"></span>', '1,2', 1),
(19, 18, 'Menu Type', 'menu_type', '<span class=\"glyphicon glyphicon-th-list\" style=\"color: #C60 !important;\"></span>', '1', 0),
(20, 19, 'Add Employee', 'employee', '<span class=\"glyphicon glyphicon-users\" style=\"color: #56CCF2 !important;\"></span>', '', 0),
(21, 20, 'Add Attendance', 'emp_attendance', '', '', 0),
(22, 6, 'Stock Report', 'stock_report', '<span class=\"glyphicon glyphicon-equalizer\" style=\"color: #ffd452 !important;\"></span>', '1,2', 1),
(23, 15, 'Miscellaneous Expance', 'miscellaneous_expance', '<span class=\"glyphicon glyphicon-usd\" style=\"color:#00F260 !important;\"></span>', '1,2', 1),
(24, 8, 'Date Wise Report', 'date_wise_report', '<span class=\"glyphicon glyphicon-th-list\" style=\"color: #C60 !important;\"></span>', '1,2', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
