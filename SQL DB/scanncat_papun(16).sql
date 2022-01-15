-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2021 at 01:48 PM
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
-- Table structure for table `datapoints`
--

CREATE TABLE `datapoints` (
  `x` int(11) NOT NULL,
  `y` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `datapoints`
--

INSERT INTO `datapoints` (`x`, `y`) VALUES
(10, 71),
(20, 55),
(30, 50),
(40, 65),
(50, 95),
(60, 68),
(70, 28),
(80, 34),
(90, 50),
(100, 65),
(110, 45),
(120, 30),
(130, 45),
(140, 85),
(150, 14);

-- --------------------------------------------------------

--
-- Table structure for table `employee_attendance`
--

CREATE TABLE `employee_attendance` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `in_time` varchar(255) DEFAULT NULL,
  `out_time` varchar(255) DEFAULT NULL,
  `created` date NOT NULL,
  `remark` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_attendance`
--

INSERT INTO `employee_attendance` (`id`, `date`, `employee_id`, `in_time`, `out_time`, `created`, `remark`) VALUES
(4, '2021-02-25', 3, '11:00', '16:15', '2021-02-25', ''),
(5, '2021-02-25', 1, '10:00', '17:00', '2021-02-25', ''),
(6, '2021-02-26', 1, '10:00', '17:00', '2021-02-25', '');

-- --------------------------------------------------------

--
-- Table structure for table `employee_data`
--

CREATE TABLE `employee_data` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `city_or_vill` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `additional_contact_number` varchar(255) DEFAULT NULL,
  `current_address` varchar(255) DEFAULT NULL,
  `current_pin` varchar(255) DEFAULT NULL,
  `local_guardian_name` varchar(255) DEFAULT NULL,
  `local_guardian_contact_number` varchar(255) DEFAULT NULL,
  `home_contact_number` varchar(255) DEFAULT NULL,
  `home_additional_contact_number` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `monthly_salary` float(16,2) DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_data`
--

INSERT INTO `employee_data` (`id`, `name`, `address`, `city_or_vill`, `pincode`, `contact_number`, `additional_contact_number`, `current_address`, `current_pin`, `local_guardian_name`, `local_guardian_contact_number`, `home_contact_number`, `home_additional_contact_number`, `img`, `monthly_salary`, `joining_date`, `created`) VALUES
(1, 'Latifah Holcomb', 'Nesciunt iusto nobi', 'Fugiat minim dolore', 'Quia excepturi aute ', '418', '178', 'Nostrum eum placeat', 'Occaecat omnis offic', 'Sacha Reid', '562', '686', '805', '1.jpg', 11.00, '1992-05-05', '2021-02-22'),
(2, 'Kasimir Kent', 'Voluptatem omnis am', 'Quis qui reprehender', 'Eiusmod id pariatur', '371', '238', 'Quia consequat Offi', 'Incididunt sit neces', 'Ronan Bond', '382', '412', '659', '2.jpg', 8.00, '1973-08-28', '2021-02-22'),
(3, 'Kiona Guy', 'Et sequi consequatur', 'Et quidem iure sint', 'Et ullamco dignissim', '107', '294', 'Ratione aliquip prov', 'Molestias veritatis ', 'Darius Watts', '67890999', '7898676', '89009098776', '3.jpg', 10000.00, '2016-09-16', '2021-02-22');

-- --------------------------------------------------------

--
-- Table structure for table `employee_salary`
--

CREATE TABLE `employee_salary` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `month` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `amount` float(255,2) DEFAULT NULL,
  `created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `food_admin_push_notification`
--

CREATE TABLE `food_admin_push_notification` (
  `id` int(11) NOT NULL,
  `token` longtext DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `food_category`
--

CREATE TABLE `food_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_category`
--

INSERT INTO `food_category` (`id`, `name`, `status`) VALUES
(1, 'Rolls & Starters', 1),
(2, 'Combos & Thalis', 1),
(3, 'South Indian', 1),
(4, 'Indian', 1),
(5, 'Chinese', 1),
(6, 'Continental', 1),
(7, 'Beverages hot & cold', 1),
(8, 'Desserts & Sundaes', 1),
(9, 'Ice Creams & Swirls', 1),
(10, 'Online - Quick Bites', 1),
(11, 'Combos & Thalis Online', 1),
(12, 'Online - Chinese Combo', 1),
(13, 'Online - North Indian', 1),
(14, 'Online- Continental', 1),
(15, 'Online - Chinese', 1),
(16, 'Online - South Indian', 1),
(17, 'Online - Beverages', 1),
(18, 'Online- Desserts & Sundaes', 1),
(19, 'Online - Breakfast Special', 1);

-- --------------------------------------------------------

--
-- Table structure for table `food_customers`
--

CREATE TABLE `food_customers` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `firebase_token` longtext DEFAULT NULL,
  `remark` longtext DEFAULT NULL,
  `created` date DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_customers`
--

INSERT INTO `food_customers` (`id`, `order_id`, `ip`, `name`, `contact`, `email`, `firebase_token`, `remark`, `created`, `status`) VALUES
(1, 10, NULL, 'New Customer', '8001691299', 'daspapun21@gmail.com', NULL, 'ok gtht', NULL, 1),
(2, 15, NULL, 'dsghsdf', '464536', NULL, NULL, NULL, NULL, 1),
(3, 9, NULL, 'esdfgsd', NULL, NULL, NULL, NULL, NULL, 1),
(4, 16, NULL, 'hfgh', '457547', 'gfhfg', NULL, 'dhdfh', NULL, 1),
(5, 18, NULL, 'dfhdfhd', '45745745', 'admin@gmail.com', NULL, 'dfhdfh', NULL, 1),
(6, 20, NULL, 'Yoshio Carrillo', '3656', 'admin@gmail.com', NULL, 'Ea lorem similique v', NULL, 1),
(7, 23, NULL, 'dfhfd', '443643', 'fdhdfh@gg.ll', NULL, '3534534', NULL, 1),
(8, 24, NULL, 'dfhdfh', NULL, NULL, NULL, NULL, NULL, 1),
(9, 25, NULL, NULL, '80001691299', NULL, NULL, NULL, NULL, 1),
(10, 27, NULL, '36346', '', 'gfdg2@dfhdf.ll', NULL, NULL, NULL, 1),
(13, 30, NULL, 'Biswanath Das', '8001691299', 'dummy@site.com', NULL, NULL, '2021-02-19', 1),
(12, 29, NULL, 'dhdfhdh', '3656456', 'dfhgd@ggg.lll', NULL, 'dfhfdhdf', '2021-02-19', 1),
(14, 31, NULL, 'Biswanath Das', '8001691299', 'daspapun22@gmail.com', NULL, NULL, '2021-02-21', 1),
(15, 32, NULL, 'John Dow', '8001691299', 'admin@gmail.com', NULL, NULL, '2021-02-21', 1),
(16, 34, NULL, 'Yoshio Carrillo', '8888888', 'admin@gmail.com', NULL, NULL, '2021-02-26', 1),
(17, 38, NULL, NULL, '', NULL, NULL, NULL, '2021-03-02', 1),
(18, 47, NULL, 'gum gum', '324324', '23432', NULL, NULL, '2021-03-06', 1),
(19, 48, NULL, 'Papun DAs', '8001691299', 'sdss@hhmh.com', NULL, NULL, '2021-03-10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `food_demo`
--

CREATE TABLE `food_demo` (
  `id` int(11) NOT NULL,
  `title` varchar(2999) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `price` float(6,2) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `img` varchar(2888) DEFAULT NULL,
  `description` varchar(29999) DEFAULT NULL,
  `veg_or_nonveg` int(11) DEFAULT 1 COMMENT '1= non veg , 0=veg',
  `menu_type` int(11) NOT NULL DEFAULT 1 COMMENT '1=> offline , 2=>online, ...'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_demo`
--

INSERT INTO `food_demo` (`id`, `title`, `category`, `price`, `status`, `img`, `description`, `veg_or_nonveg`, `menu_type`) VALUES
(1, ' VEG ROLL', 1, 50.00, 1, '1_1611671510.jpg', 'ROLLS VEG ROLL', 0, 1),
(2, 'PANEER ROLL', 1, 60.00, 1, '2_1611671538.jpg', 'PANEER ROLL', 0, 1),
(3, 'EGG ROLL', 1, 60.00, 1, '3_1611671586.jpg', '', 1, 1),
(4, 'CHICKEN KEBAB ROLL', 1, 65.00, 1, '4_1611671611.jpg', 'CHICKEN KEBAB ROLL', 1, 1),
(5, 'CHICKEN CHEESE KEBAB ROL', 1, 75.00, 1, '5_1611671624.jpg', '', 1, 1),
(6, 'EGG CHICKEN KEBAB ROLL', 1, 75.00, 1, '6_1611671669.jpg', 'EGG CHICKEN KEBAB ROLL', 1, 1),
(7, 'EGG CHEESE, CHICKEN KEBAB ROLL', 1, 85.00, 1, '7_1611671683.jpg', 'EGG CHEESE, CHICKEN KEBAB ROLL', 1, 1),
(12, 'VEG PANKO MOMO', 1, 140.00, 1, '12_1611671806.jpg', 'VEG PANKO MOMO', 1, 1),
(9, 'VEG MOMO STRAMED', 1, 105.00, 1, '9_1611671765.jpg', 'VEG MOMO ( STEAMED/FRIED)', 1, 1),
(13, 'CHICKEN PANKO MOMO', 1, 150.00, 1, '13_1611671819.jpg', 'CHICKEN PANKO MOMO', 1, 1),
(11, 'CHICKEN MOMO STAMED', 1, 120.00, 1, '11_1611671779.jpg', 'CHICKEN MOMO', 1, 1),
(14, 'VEG WRAP', 1, 115.00, 1, '14_1611671875.jpg', 'VEG WRAP', 1, 1),
(15, 'GRILLED PANEER WRAP', 1, 125.00, 1, '15_1611671887.jpg', 'GRILLED PANEER WRAP', 1, 1),
(16, 'EGG MUSHROOM WRAP', 1, 140.00, 1, '16_1611671900.jpg', 'EGG MUSHROOM WRAP', 1, 1),
(17, 'GRILLED CHICKEN WRAP', 1, 140.00, 1, '17_1611671916.jpg', 'GRILLED CHICKEN WRAP', 1, 1),
(18, 'FRENCH FRIES', 1, 80.00, 1, '18_1611671986.jpg', 'FRENCH FRIES', 0, 1),
(19, 'PANEER PAKODA', 1, 140.00, 1, '19_1611672006.jpg', 'PANEER PAKODA', 0, 1),
(20, 'CHEESE CORN NUGGETS', 1, 120.00, 1, '20_1611672018.jpg', 'CHEESE CORN NUGGETS', 0, 1),
(21, 'CHILLI GARLIC POTATO SHOTS', 1, 120.00, 1, '21_1611672029.jpg', 'CHILLI GARLIC POTATO SHOTS', 0, 1),
(22, 'VEG CUTLE', 1, 120.00, 1, '22_1611672048.jpg', 'VEG CUTLE', 0, 1),
(23, 'VEG FALAFEL KABAB ', 1, 120.00, 1, '23_1611672061.jpg', 'VEG FALAFEL KABAB ', 0, 1),
(24, 'VADA PAV 2PC   ', 1, 120.00, 1, '24_1611672075.jpg', 'VADA PAV 2PC   ', 0, 1),
(25, 'CRISPY CHILLI BABY CORN (DRY)', 1, 175.00, 1, '25_1611670392.jpg', 'CRISPY CHILLI BABY CORN (DRY)', 0, 1),
(26, 'CRISPY CHILLI POTATO', 1, 160.00, 1, '26.jpg', 'CRISPY CHILLI POTATO', 0, 1),
(27, 'CHILLI BUTTER MUSHROOM GOLDEN FRY', 1, 170.00, 1, '27.jpg', 'CHILLI BUTTER MUSHROOM GOLDEN FRY', 0, 1),
(28, 'CHOLA BHATURA', 1, 150.00, 1, '28.jpg', 'CHOLA BHATURA', 0, 1),
(29, 'PAV BHAJI   ', 1, 120.00, 1, '29.jpg', 'PAV BHAJI   ', 0, 1),
(30, 'CHICKEN FRIES', 1, 130.00, 1, '30.jpg', 'CHICKEN FRIES', 1, 1),
(31, 'CHICKEN PAKODA', 1, 160.00, 1, '31.jpg', 'CHICKEN PAKODA', 1, 1),
(32, 'CHICKEN POPCORN ', 1, 130.00, 1, '32.jpg', 'CHICKEN POPCORN ', 1, 1),
(33, 'CHICKEN CUTLE', 1, 160.00, 1, '33.jpg', 'CHICKEN CUTLE', 1, 1),
(34, 'CHICKEN NUGGETS', 1, 130.00, 1, '34.jpg', 'CHICKEN NUGGETS', 1, 1),
(35, 'CHICKEN SAUSAGES', 1, 140.00, 1, '35.jpg', 'CHICKEN SAUSAGES', 1, 1),
(36, 'CHICKEN WINGS  ', 1, 150.00, 1, '36.jpg', 'CHICKEN WINGS  ', 1, 1),
(37, 'FRIED CHICKEN STRIPS WITH FRIES', 1, 190.00, 1, '37.jpg', 'FRIED CHICKEN STRIPS WITH FRIES', 1, 1),
(38, 'PAN FRIED CHICKEN (GARLIC/SCHEZWAN)', 1, 199.00, 1, '38.jpg', 'PAN FRIED CHICKEN (GARLIC/SCHEZWAN)', 1, 1),
(39, 'PEPPER GARLIC CHICKEN', 1, 180.00, 1, '39.jpg', 'PEPPER GARLIC CHICKEN', 1, 1),
(40, 'CRISPY FRIED CHICKEN', 1, 175.00, 1, '40.jpg', 'CRISPY FRIED CHICKEN', 1, 1),
(41, 'CHICKEN RESHMI KEBAB ', 1, 190.00, 1, '41.jpg', 'CHICKEN RESHMI KEBAB ', 1, 1),
(42, 'CHICKEN TIKKA KEBAB', 1, 190.00, 1, '42.jpg', 'CHICKEN TIKKA KEBAB', 1, 1),
(43, 'FISH FINGER WITH FRIES (6 PC.)  ', 1, 200.00, 1, '43.jpg', 'FISH FINGER WITH FRIES (6 PC.)  ', 1, 1),
(44, 'FISH AND CHIPS WITH FRIES AND TARTAR SAUCE ', 1, 200.00, 1, '44.jpg', 'FISH AND CHIPS WITH FRIES AND TARTAR SAUCE ', 1, 1),
(45, 'PAN FRIED FISH (GARLIC/SCHEZWAN)  ', 1, 220.00, 1, '45.jpg', 'PAN FRIED FISH (GARLIC/SCHEZWAN)  ', 1, 1),
(46, 'VEG NOODLE COMBO', 2, 175.00, 1, '46.jpg', 'VEG HAKKA NOODLE & CHILLI PANEER/VEG MANCHURIAN\r\n', 0, 1),
(47, 'VEG RICE COMBO', 2, 185.00, 1, '47.jpg', '(VEG FRIED RICE & CHILLI PANEER/VEG MANCHURIAN)', 0, 1),
(48, 'CHICKEN NOODLE COMBO ', 2, 185.00, 1, '48.jpg', 'CHICKEN HAKKA NOODLE & CHILLI CHICKEN/CHICKEN MANCHURIA', 1, 1),
(49, 'CHICKEN RICE COMBO', 2, 195.00, 1, '49.jpg', '(CHICKEN FRIED RICE & CHILLI CHICKEN/CHICKEN MANCHURIAN)', 1, 1),
(50, 'CHINESE SIZZLER VEG', 2, 250.00, 1, '50.jpg', 'CHINESE SIZZLER VEG/NON- VEG ', 1, 1),
(51, 'CHINESE SIZZLER NON-VEG', 2, 290.00, 1, '51.jpg', 'CHINESE SIZZLER NON-VEG', 1, 1),
(52, 'VEG MOMO FRIED', 1, 115.00, 1, '52.jpg', 'VEG MOMO FRIED', 1, 1),
(53, 'CHICKEN MOMO (FRIED)', 1, 130.00, 1, '53.jpg', 'CHICKEN MOMO (FRIED)', 1, 1),
(54, 'VEG NAVRATAN THALI', 2, 185.00, 1, '54.jpg', '(2 PC.LACCHA PARAATHA OR RICE, DAL MAKHANI/DAL FRY, NAVRATAN KORMA GRAVY)', 0, 1),
(55, 'PANEER TIKKA THALI', 2, 190.00, 1, '55.jpg', '2 PC.LACCH APARAATHA OR RICE, DAL MAKHANI/DAL FRY, PANEER TIKKA MASALA', 1, 1),
(56, 'SCOOP SPECIAL VEG THALI ', 2, 230.00, 1, '56.jpg', '2 PC.TAWA ROTI, RICE, 2 TYPES OF SABJI, DAL MAKHANI/DAL FRY, SALAD, RAITA, PAPAD', 1, 1),
(57, 'CHICKEN TIKKA THAL', 2, 195.00, 1, '57.jpg', '2 PC.LACCHA PARAATHA OR RICE, DAL MAKHANI/DAL FRY, CHICKENTIKKA MASALA', 1, 1),
(58, 'CHICKEN BUTTER MASALA THALI', 2, 195.00, 1, '58.jpg', '2 PC.LACCHA PARAATHA OR RI', 1, 1),
(59, 'CHICKEN RESHMI MASALA THAL', 2, 195.00, 1, '59.jpg', '2 PC.LACCHA PARAATHA OR RICE, DAL MAKHANI/DAL FRY, CHICKENRESHMI MASALA', 1, 1),
(60, 'SCOOP SPECIAL NON VEG THALI ', 2, 250.00, 1, '60.jpg', '2 PC.TAWAROTI, RICE, 2 TYPES OF CHICKEN,DAL MAKHANI/DAL FRY, SALAD, RAITA, PAPAD', 1, 1),
(61, 'PLAIN IDLY', 3, 80.00, 1, '61.jpg', 'PLAIN IDLY', 1, 1),
(62, 'Butter Idly', 3, 90.00, 1, '62.jpg', 'Butter Idly', 1, 1),
(63, 'FRIED IDLY ', 3, 95.00, 1, '63.jpg', 'FRIED IDLY ', 1, 1),
(64, 'PLAIN VADA', 3, 80.00, 1, '64.jpg', 'PLAIN VADA', 1, 1),
(65, 'SAMBAR VADA', 3, 80.00, 1, '65.jpg', 'SAMBAR VADA', 1, 1),
(66, 'PLAIN UTTAPAM ', 3, 115.00, 1, '66.jpg', 'PLAIN UTTAPAM ', 1, 1),
(67, 'MASALA UTTAPAM', 3, 120.00, 1, '67.jpg', 'MASALA UTTAPAM', 1, 1),
(68, 'ONION/TOMATO/MIXED UTTAPAM ', 3, 125.00, 1, '68.jpg', 'ONION/TOMATO/MIXED UTTAPAM ', 1, 1),
(69, 'PANEER/CHEESE/SCHEZWAN UTTAPAM', 3, 130.00, 1, '69.jpg', 'PANEER/CHEESE/SCHEZWAN UTTAPAM', 1, 1),
(70, 'PLAIN DOSA   - NORMAL', 3, 105.00, 1, '70.jpg', 'PLAIN DOSA   - NORMAL', 1, 1),
(71, 'PLAIN DOSA   - PAPER', 3, 130.00, 1, '71.jpg', 'PLAIN DOSA   - PAPER', 1, 1),
(72, 'BUTTER PLAIN DOSA   -NORMAL', 3, 115.00, 1, '72.jpg', 'BUTTER PLAIN DOSA   -NORMAL', 1, 1),
(73, 'BUTTER PLAIN DOSA   -PAPER', 3, 140.00, 1, '73.jpg', 'BUTTER PLAIN DOSA   -PAPER', 1, 1),
(74, 'CHEESE PLAIN DOSA', 3, 125.00, 1, '74.jpg', 'CHEESE PLAIN DOSA', 1, 1),
(75, 'ONION PLAIN DOSA ', 3, 125.00, 1, '75.jpg', 'ONION PLAIN DOSA ', 1, 1),
(76, 'BUTTER CHEESE PLAIN DOSA  - NORMAL', 3, 130.00, 1, '76.jpg', 'BUTTER CHEESE PLAIN DOSA  - NORMAL', 1, 1),
(77, 'BUTTER CHEESE PLAIN DOSA  - PAPER', 3, 140.00, 1, '77.jpg', 'BUTTER CHEESE PLAIN DOSA  - PAPER', 1, 1),
(78, 'BUTTER ONION PLAIN DOSA -NORMAL', 3, 130.00, 1, '78.jpg', 'BUTTER ONION PLAIN DOSA ', 1, 1),
(79, 'BUTTER ONION PLAIN DOSA -PAPER', 3, 140.00, 1, '79.jpg', 'BUTTER ONION PLAIN DOSA ', 1, 1),
(80, 'SCHEZWAN PLAIN DOSA - PAPER', 3, 140.00, 1, '80.jpg', 'SCHEZWAN PLAIN DOSA', 1, 1),
(81, 'MASALA DOSA - NORMAL', 3, 115.00, 1, '81.jpg', 'MASALA DOSA ', 1, 1),
(82, 'MASALA DOSA - PAPER', 3, 130.00, 1, '82.jpg', 'MASALA DOSA ', 1, 1),
(83, 'BUTTER MASALA DOSA  -NORMAL', 3, 125.00, 1, '83.jpg', 'BUTTER MASALA DOSA ', 1, 1),
(84, 'BUTTER MASALA DOSA  - PAPER', 3, 140.00, 1, '84.jpg', 'BUTTER MASALA DOSA ', 1, 1),
(85, 'CHEESE  MASALA DOSA', 3, 135.00, 1, '85.jpg', 'CHEESE  MASALA DOSA', 1, 1),
(86, 'CHEESE  MASALA DOSA -PAPER', 3, 140.00, 1, '86.jpg', 'CHEESE  MASALA DOSA', 1, 1),
(87, 'ONION MASALA DOSA -NORMAL', 3, 135.00, 1, '87.jpg', 'ONION MASALA DOSA', 1, 1),
(88, 'ONION MASALA DOSA - PAPER', 3, 140.00, 1, '88.jpg', 'ONION MASALA DOSA', 1, 1),
(89, 'BUTTER CHEESE MASALA DOSA - NORMAL', 3, 145.00, 1, '89.jpg', 'BUTTER CHEESE MASALA DOSA', 1, 1),
(90, 'BUTTER CHEESE MASALA DOSA - PAPER', 3, 150.00, 1, '90.jpg', 'BUTTER CHEESE MASALA DOSA', 1, 1),
(91, 'BUTTER ONION MASALA DOSA - NORMAL', 3, 140.00, 1, '91.jpg', 'BUTTER ONION MASALA DOSA', 1, 1),
(92, 'BUTTER ONION MASALA DOSA -PAPER', 3, 150.00, 1, '92.jpg', 'BUTTER ONION MASALA DOSA', 1, 1),
(93, 'SCHEZWAN MASALA DOSA  -NORMAL', 3, 135.00, 1, '93.jpg', 'SCHEZWAN MASALA DOSA ', 1, 1),
(94, 'SCHEZWAN MASALA DOSA  - PAPER', 3, 135.00, 1, '94.jpg', 'SCHEZWAN MASALA DOSA ', 1, 1),
(95, 'SCHEZWAN MASALA DOSA - PAPER', 3, 140.00, 1, '95.jpg', 'SCHEZWAN MASALA DOSA ', 1, 1),
(96, 'CHICKEN MASALA DOSA (OUR SPECIALITY) ', 3, 160.00, 1, '96.jpg', 'CHICKEN MASALA DOSA (OUR SPECIALITY) ', 1, 1),
(97, 'CHICKEN MASALA DOSA (OUR SPECIALITY) - PAPER', 3, 170.00, 1, '97.jpg', 'CHICKEN MASALA DOSA (OUR SPECIALITY) ', 1, 1),
(98, 'DAL FRY', 4, 140.00, 1, '98.jpg', 'DAL FRY', 1, 1),
(99, 'DAL MAKHANI', 4, 140.00, 1, '99.jpg', 'DAL MAKHANI', 1, 1),
(100, 'CHANA MASALA ', 4, 155.00, 1, '100.jpg', 'CHANA MASALA ', 1, 1),
(101, 'ALOO DUM ', 4, 140.00, 1, '101.jpg', 'ALOO DUM ', 1, 1),
(102, 'SHAHI PANEER', 4, 180.00, 1, '102.jpg', 'SHAHI PANEER', 1, 1),
(103, 'NAVRATAN KORMA', 4, 185.00, 1, '103.jpg', 'NAVRATAN KORMA', 1, 1),
(104, 'PANEER BUTTER MASALA', 4, 180.00, 1, '104.jpg', 'PANEER BUTTER MASALA', 1, 1),
(105, 'MATAR PANEER', 4, 180.00, 1, '105.jpg', 'MATAR PANEER', 1, 1),
(106, 'MALAI KOFTA', 4, 190.00, 1, '106.jpg', 'MALAI KOFTA', 1, 1),
(107, 'LOHRI MALAI KOFTA ', 4, 200.00, 1, '107.jpg', 'LOHRI MALAI KOFTA ', 1, 1),
(108, 'VEG JALFREZI', 4, 180.00, 1, '108.jpg', 'VEG JALFREZI', 1, 1),
(109, 'CHICKEN BHARTA', 4, 190.00, 1, '109.jpg', 'CHICKEN BHARTA', 1, 1),
(110, 'CHICKEN DO PIAZA', 4, 190.00, 1, '110.jpg', 'CHICKEN DO PIAZA', 1, 1),
(111, 'CHICKEN BUTTER MASALA', 4, 200.00, 1, '111.jpg', 'CHICKEN BUTTER MASALA', 1, 1),
(112, 'CHICKEN TIKKA MASALA', 4, 200.00, 1, '112.jpg', 'CHICKEN TIKKA MASALA', 1, 1),
(113, 'CHICKEN RESHMI BUTTER MASALA', 4, 210.00, 1, '113.jpg', 'CHICKEN RESHMI BUTTER MASALA', 1, 1),
(114, 'STEAMED RICE', 4, 90.00, 1, '114.jpg', 'STEAMED RICE', 1, 1),
(115, 'JEERA RICE ', 4, 120.00, 1, '115.jpg', 'JEERA RICE ', 1, 1),
(116, 'PEAS PULAO', 4, 130.00, 1, '116.jpg', 'PEAS PULAO', 1, 1),
(117, 'VEG PULAO ', 4, 135.00, 1, '117.jpg', 'VEG PULAO ', 1, 1),
(118, 'TAWA ROTI  ', 4, 10.00, 1, '118.jpg', 'TAWA ROTI ', 1, 1),
(119, 'TAWA ROTI - GHEE', 4, 12.00, 1, '119.jpg', 'TAWA ROTI ', 1, 1),
(120, 'LACHHA PARATHA', 4, 45.00, 1, '120.jpg', 'LACHHA PARATHA', 1, 1),
(121, 'PLAIN NAAN', 4, 40.00, 1, '121.jpg', 'NAAN', 1, 1),
(122, 'BUTTER NAAN', 4, 45.00, 1, '122.jpg', 'NAAN', 1, 1),
(123, 'GARLIC NAAN', 4, 45.00, 1, '123.jpg', 'NAAN', 1, 1),
(124, 'TAWA MASALA KULCHA ', 4, 50.00, 1, '124.jpg', 'TAWA MASALA KULCHA ', 1, 1),
(125, 'PARATHA(ALOO/ONION/GOBI/MOOLI', 4, 125.00, 1, '125.jpg', 'PARATHA(ALOO/ONION/GOBI/MOOLI', 1, 1),
(126, 'MIXED VEG PARTATHA', 4, 130.00, 1, '126.jpg', 'MIXED VEG PARTATHA', 1, 1),
(127, 'PANEER STUFFED PARATHA ', 4, 135.00, 1, '127.jpg', 'PANEER STUFFED PARATHA ', 1, 1),
(128, 'CHICKEN KEEMA PARATHA    ', 4, 150.00, 1, '128.jpg', 'CHICKEN KEEMA PARATHA    ', 1, 1),
(129, 'CHILLI POTATO', 5, 160.00, 1, '129.jpg', 'CHILLI POTATO', 1, 1),
(130, 'CHILLI PANEER', 5, 175.00, 1, '130.jpg', 'CHILLI PANEER', 1, 1),
(131, 'CHILLI BABYCORN', 5, 175.00, 1, '131.jpg', 'CHILLI BABYCORN', 1, 1),
(132, 'CHILLI MUSHROOM', 5, 175.00, 1, '132.jpg', 'CHILLI MUSHROOM', 1, 1),
(133, 'VEG SWEET N SOUR ', 5, 165.00, 1, '133.jpg', 'VEG SWEET N SOUR ', 1, 1),
(134, 'VEG MANCHURIAN  ', 5, 165.00, 1, '134.jpg', 'VEG MANCHURIAN  ', 1, 1),
(135, 'PANEER MANCHURIA', 5, 175.00, 1, '135.jpg', 'PANEER MANCHURIA', 1, 1),
(136, 'CHICKEN MUNCHURIA', 5, 180.00, 1, '136.jpg', 'CHICKEN MUNCHURIA', 1, 1),
(137, 'GARLIC CHICKEN', 5, 190.00, 1, '137.jpg', 'GARLIC CHICKEN', 1, 1),
(138, 'GINGER CHICKEN', 5, 180.00, 1, '138.jpg', 'GINGER CHICKEN', 1, 1),
(139, 'SWEET N SOUR CHICKEN  ', 5, 180.00, 1, '139.jpg', 'SWEET N SOUR CHICKEN  ', 1, 1),
(140, 'SZECHUAN CHICKEN', 5, 185.00, 1, '140.jpg', 'SZECHUAN CHICKEN', 1, 1),
(141, 'CHICKEN WITH VEG MUSHROOM ', 5, 185.00, 1, '141.jpg', 'CHICKEN WITH VEG MUSHROOM ', 1, 1),
(142, 'CHILLI FISH', 5, 190.00, 1, '142.jpg', 'CHILLI FISH', 1, 1),
(143, 'FISH MUNCHURIA', 5, 190.00, 1, '143.jpg', 'FISH MUNCHURIA', 1, 1),
(144, 'GARLIC FISH', 5, 195.00, 1, '144.jpg', 'GARLIC FISH', 1, 1),
(145, 'SZECHUAN FISH', 5, 195.00, 1, '145.jpg', 'SZECHUAN FISH', 1, 1),
(146, 'CHILLI PRAWN', 5, 210.00, 1, '146.jpg', 'CHILLI PRAWN', 1, 1),
(147, 'GARLIC PRAWN ', 5, 210.00, 1, '147.jpg', 'GARLIC PRAWN ', 1, 1),
(148, 'PRAWN MUNCHURIAN     ', 5, 210.00, 1, '148.jpg', 'PRAWN MUNCHURIAN     ', 1, 1),
(149, 'VEG CLEAR SOUP', 5, 140.00, 1, '149.jpg', 'SOUPSVEG CLEAR SOUP', 1, 1),
(150, 'CHICKEN CLEAR SOUP', 5, 145.00, 1, '150.jpg', 'CHICKEN CLEAR SOUP', 1, 1),
(151, 'VEG HOT N SOUR SOUP  ', 5, 150.00, 1, '151.jpg', 'VEG HOT N SOUR SOUP  ', 1, 1),
(152, 'CHICKEN HOT N SOUR SOUP  ', 5, 160.00, 1, '152.jpg', 'CHICKEN HOT N SOUR SOUP  ', 1, 1),
(153, 'VEG MUSHROOM SOUP', 5, 150.00, 1, '153.jpg', 'VEG MUSHROOM SOUP', 1, 1),
(154, 'CHICKEN EGG MUSHROOM ', 5, 160.00, 1, '154.jpg', 'CHICKEN EGG MUSHROOM ', 1, 1),
(155, 'VEG SWEET CORN', 5, 150.00, 1, '155.jpg', 'VEG SWEET CORN', 1, 1),
(156, 'CHICKEN SWEET CORN SOUP', 5, 160.00, 1, '156.jpg', 'CHICKEN SWEET CORN SOUP', 1, 1),
(157, 'SCOOP SPECIAL VEG', 5, 160.00, 1, '157.jpg', 'SCOOP SPECIAL VEG', 1, 1),
(158, 'NON-VEG SOUP', 5, 170.00, 1, '158.jpg', 'NON-VEG SOUP', 1, 1),
(159, 'VEG FRIED RICE', 5, 150.00, 1, '159.jpg', 'VEG FRIED RICE', 1, 1),
(160, 'VEG GINGER CAPSICUM FRIED RIC', 5, 160.00, 1, '160.jpg', 'VEG GINGER CAPSICUM FRIED RIC', 1, 1),
(161, 'VEG SZECHUAN FRIED RICE', 5, 160.00, 1, '161.jpg', 'VEG SZECHUAN FRIED RICE', 1, 1),
(162, 'CHILLI GARLIC FRIED RIC', 5, 160.00, 1, '162.jpg', 'CHILLI GARLIC FRIED RIC', 1, 1),
(163, 'STEAMED RICE WITH VEG  ', 5, 165.00, 1, '163.jpg', 'STEAMED RICE WITH VEG  ', 1, 1),
(164, 'EGG FRIED RICE', 5, 160.00, 1, '164_1611717406.jpg', 'EGG FRIED RICE', 1, 1),
(165, 'CHICKEN FRIED RIC', 5, 165.00, 1, '165.jpg', 'CHICKEN FRIED RIC', 1, 1),
(166, 'MIXED FRIED RIC', 5, 175.00, 1, '166.jpg', 'MIXED FRIED RIC', 1, 1),
(167, 'SZECHUAN MIXED FRIED RIC', 5, 180.00, 1, '167.jpg', 'SZECHUAN MIXED FRIED RIC', 1, 1),
(168, 'STEAMED RICE WITH CHICKEN N VEG ', 5, 185.00, 1, '168.jpg', 'STEAMED RICE WITH CHICKEN N VEG ', 1, 1),
(169, 'VEG NOODLES - HAKKA', 5, 150.00, 1, '169.jpg', 'VEG NOODLES - HAKKA', 1, 1),
(170, 'VEG NOODLES - GRAVY', 5, 160.00, 1, '170.jpg', 'VEG NOODLES - GRAVY', 1, 1),
(171, 'CHILLI GARLIC HAKKA NOODLES', 5, 160.00, 1, '171.jpg', 'CHILLI GARLIC HAKKA NOODLES', 1, 1),
(172, 'SZECHUAN VEG NOODLES', 5, 160.00, 1, '172.jpg', 'SZECHUAN VEG NOODLES', 1, 1),
(173, 'VEG CANTON NOODLES WITH GRAVY ', 5, 165.00, 1, '173.jpg', 'VEG CANTON NOODLES WITH GRAVY ', 1, 1),
(174, 'EGG NOODLES - HAKKA', 5, 150.00, 1, '174.jpg', 'EGG NOODLES - HAKKA', 1, 1),
(175, 'EGG NOODLES - GRAVY', 5, 160.00, 1, '175.jpg', 'EGG NOODLES - GRAVY', 1, 1),
(176, 'CHICKEN NOODLES - HAKKA', 5, 160.00, 1, '176.jpg', 'CHICKEN NOODLES - HAKKA', 1, 1),
(177, 'CHICKEN NOODLES- GRAVY', 5, 170.00, 1, '177.jpg', 'CHICKEN NOODLES- GRAVY', 1, 1),
(178, 'MIXED NOODLES - HAKKA', 5, 170.00, 1, '178.jpg', 'MIXED NOODLES - HAKKA', 1, 1),
(179, 'MIXED NOODLES - GRAVY', 5, 180.00, 1, '179.jpg', 'MIXED NOODLES - GRAVY', 1, 1),
(180, 'SZECHUAN CHICKEN NOODLES', 5, 170.00, 1, '180.jpg', 'SZECHUAN CHICKEN NOODLES', 1, 1),
(181, 'CHILLI GARLIC/SZECHUAN MIXED NOODLES ', 5, 170.00, 1, '181.jpg', 'CHILLI GARLIC/SZECHUAN MIXED NOODLES ', 1, 1),
(182, 'CHILLI CHEESE TOAST', 6, 130.00, 1, '182.jpg', 'CHILLI CHEESE TOAST', 1, 1),
(183, 'CHEESE GARLIC BREAD', 6, 130.00, 1, '183.jpg', 'CHEESE GARLIC BREAD', 1, 1),
(184, 'GRILLED VEGGIE FARMHOUSE SANDWICH', 6, 140.00, 1, '184.jpg', 'GRILLED VEGGIE FARMHOUSE SANDWICH', 1, 1),
(185, 'CHEESE CORN SANDWICH', 6, 140.00, 1, '185.jpg', 'CHEESE CORN SANDWICH', 1, 1),
(186, 'PANEER TIKKA SANDWICH', 6, 145.00, 1, '186.jpg', 'PANEER TIKKA SANDWICH', 1, 1),
(187, 'BOMBAY GRILLED SANDWICH', 6, 160.00, 1, '187.jpg', 'BOMBAY GRILLED SANDWICH', 1, 1),
(188, 'VEGGIE CLUB SANDWICH', 6, 170.00, 1, '188.jpg', 'VEGGIE CLUB SANDWICH', 1, 1),
(189, 'CHICKEN MAYO SANDWICH (PLAIN', 6, 120.00, 1, '189.jpg', 'CHICKEN MAYO SANDWICH (PLAIN', 1, 1),
(190, 'CHICKEN GRILLED SANDWICH', 6, 140.00, 1, '190.jpg', 'CHICKEN GRILLED SANDWICH', 1, 1),
(191, 'CHICKEN AND CORN GRILLED SANDWICH', 6, 145.00, 1, '191.jpg', 'CHICKEN AND CORN GRILLED SANDWICH', 1, 1),
(192, 'CHICKEN AND MUSHROOM GRILLED SANDWICH ', 6, 145.00, 1, '192_1611799950.jpg', 'CHICKEN AND MUSHROOM GRILLED SANDWICH ', 1, 1),
(193, 'CHICKEN AND EGG GRILLED SANDWICH', 6, 145.00, 1, '193.jpg', 'CHICKEN AND EGG GRILLED SANDWICH', 1, 1),
(194, 'CHICKEN TIKKA GRILLED SANDWICH', 6, 145.00, 1, '194.jpg', 'CHICKEN TIKKA GRILLED SANDWICH', 1, 1),
(195, 'CHICKEN CLUB SANDWICH', 6, 180.00, 1, '195.jpg', 'CHICKEN CLUB SANDWICH', 1, 1),
(196, 'CHICKEN BURGER', 6, 140.00, 1, '196.jpg', 'CHICKEN BURGER', 1, 1),
(197, 'VEG BURGER', 6, 130.00, 1, '197.jpg', 'VEG BURGER', 1, 1),
(198, 'MARGARITA PIZZA(CHEESE) (8 INCHES)', 6, 180.00, 1, '198.jpg', 'MARGARITA PIZZA(CHEESE) (8 INCHES)', 1, 1),
(199, 'CHEESE ONION CAPSICUM PIZZA', 6, 200.00, 1, '199.jpg', 'CHEESE ONION CAPSICUM PIZZA', 1, 1),
(200, 'PANEER TIKKA PIZZA ', 6, 210.00, 1, '200.jpg', 'PANEER TIKKA PIZZA ', 1, 1),
(201, 'CHICKEN TIKKA PIZZA ', 6, 230.00, 1, '201.jpg', 'CHICKEN TIKKA PIZZA ', 1, 1),
(202, 'CHICKEN PIZZA', 6, 220.00, 1, '202.jpg', 'CHICKEN PIZZA', 1, 1),
(203, 'SCOOP SPECIAL VEG PIZZA', 6, 230.00, 1, '203.jpg', 'SCOOP SPECIAL VEG PIZZA', 1, 1),
(204, 'SCOOP SPECIAL NON VEG PIZZA ', 6, 250.00, 1, '204.jpg', 'SCOOP SPECIAL NON VEG PIZZA ', 1, 1),
(205, 'PENNE/MACARONI PASTA VEG SAUCE OF YOUR CHOICE', 6, 175.00, 1, '205.jpg', 'PENNE/MACARONI PASTA VEG SAUCE OF YOUR CHOICE', 1, 1),
(206, 'PENNE/MACARONI PASTA NON - VEG SAUCE OF YOUR CHOICE', 6, 185.00, 1, '206.jpg', 'PENNE/MACARONI PASTA NON - VEG SAUCE OF YOUR CHOICE', 1, 1),
(207, 'SCOOP SPECIAL PASTA VEG SAUCE OF YOUR TYPE', 6, 190.00, 1, '207.jpg', 'SCOOP SPECIAL PASTA VEG SAUCE OF YOUR TYPE', 1, 1),
(208, 'SCOOP SPECIAL PASTA NON-VEG SAUCE OF YOUR TYPE', 6, 200.00, 1, '208.jpg', 'SCOOP SPECIAL PASTA NON-VEG SAUCE OF YOUR TYPE', 1, 1),
(209, 'CHELLO KEBAB VEG', 6, 250.00, 1, '209.jpg', 'BUTTER RICE SERVED WITH PANEER TIKKA, FRENCH FRY, CUTLET AND SALAD', 1, 1),
(210, 'PANEER STEAK', 6, 250.00, 1, '210.jpg', 'GRILLED CREAMY PANEER IN STEAK SAUCE, SERVED WITH HERB RICE &ASSORTED VEGGIES', 1, 1),
(211, 'VEG SIZZLER', 6, 250.00, 1, '211.jpg', 'VEG SIZZLER', 1, 1),
(212, 'VEG AU GRATIN', 6, 250.00, 1, '212.jpg', 'VEG AU GRATIN', 1, 1),
(213, 'VEG SUPREME BAKED', 6, 275.00, 1, '213.jpg', 'VEG SUPREME BAKED', 1, 1),
(214, 'VEG ENCHILADAS', 6, 275.00, 1, '214.jpg', 'CREAMY VEG STUFFED IN THIN CRAPES,TOPPED WITH TOMATO CONCASSE SERVED WITH GARLIC BREAD', 1, 1),
(215, 'CHELLO KEBAB NON VEG', 6, 280.00, 1, '215_1611722351.jpg', 'BUTTER RICE SERVED WITH KEBABS,FRIED FISH,POACHED EGG AND SALAD', 1, 1),
(216, 'CHICKEN SIZZLE', 6, 285.00, 1, '216.jpg', 'CHICKEN SIZZLE', 1, 1),
(217, 'CHICKEN STEAK ', 6, 285.00, 1, '217.jpg', 'SERVED WITH SAUTED VEG &HERB RICE/GARLIC BREAD', 1, 1),
(218, 'GRILLED CHICKE', 6, 260.00, 1, '218.jpg', 'SERVED WITH FRIES AND CRISPY FRIED ASSORTED VEGGIES IN HONEY MUSTARD SAUC', 1, 1),
(219, 'CHICKEN STROGANOFF', 6, 260.00, 1, '219.jpg', 'BUTTERED CHICKEN WITH MUSHROOM &BELL PEPPER TOSSED IN BROWN SAUCE, SERVED WITH RICE', 1, 1),
(220, 'CHICKEN SUPREME BAKED', 6, 280.00, 1, '220.jpg', 'BAKED CHICKEN IN WHITE CREAMY SAUCE, SERVED WITH GARLIC BREAD', 1, 1),
(221, 'CHICKEN ENCHILADAS', 6, 295.00, 1, '221_1611722939.jpg', 'CREAMY CHICKEN STUFFED IN THIN CRAPES,TOPPED WITH TOMATO CONCASSE SERVED WITH GARLIC BREAD', 1, 1),
(222, 'BARBEQUE JERK CHICKEN', 6, 100.00, 1, '222.jpg', 'ROASTED CHICKEN IN BARBEQUE JERK SAUCE, SERVED WITH GARLIC BREAD', 1, 1),
(223, 'FRENCH GRILLED FISH ', 6, 295.00, 1, '223.jpg', 'GRILLED FISH IN LEMON BUTTER SAUCE, SERVED WITH HERB RICE & ASSORTED VEGGIES', 1, 1),
(224, 'FISH SUPREME BAKED ', 6, 295.00, 1, '224.jpg', 'BAKED FISH IN WHITE CREAMY SAUCE, SERVED WITH GARLIC BREAD', 1, 1),
(225, 'MOON MAGIC ', 8, 210.00, 1, '225_1611799914.jpg', '( TWO SCOOPS OF CHOCOLATE ICE CREAM &\r\n1 SCOOP OF BUTTERSCOTCH ICE CREAM,\r\nTOPPED WITH CHOCOLATE SAUCE,\r\nCASHEW NUTS & ALMONDS)', 0, 1),
(226, 'PINK AFFAIR', 8, 210.00, 1, '226_1611799926.jpg', '( TWO SCOOPS OF STRAWBERRY ICE CREAM &\r\n1 SCOOP OF VANILLA ICE CREAM,\r\nTOPPED WITH STRAWBERRY SAUCE)\r\n', 0, 1),
(227, 'ESPRESSO', 7, 75.00, 1, '227.jpg', 'ESPRESSO', 1, 1),
(228, 'CAFE LATTE', 7, 90.00, 1, '228.jpg', 'CAFE LATTE', 1, 1),
(229, 'CAPPUCINO', 7, 90.00, 1, '229.jpg', 'CAPPUCINO', 1, 1),
(230, 'CHOCO COOKIE/IRISH/HAZEL-NUT LATTE ', 7, 100.00, 1, '230.jpg', 'CHOCO COOKIE/IRISH/HAZEL-NUT LATTE ', 1, 1),
(231, 'HOT CHOCOLATE', 7, 95.00, 1, '231.jpg', 'HOT CHOCOLATE', 1, 1),
(232, 'PLAIN/MASALA/GREEN/ASSAM/ DARJEELING/ LEMON TEA 	', 7, 50.00, 1, '232.jpg', 'PLAIN/MASALA/GREEN/ASSAM/\r\nDARJEELING/ LEMON TEA 	', 1, 1),
(233, 'LASSI(SWEET/SALT) ', 8, 120.00, 1, '233.jpg', 'LASSI(SWEET/SALT) ', 1, 1),
(234, 'ROSE/MANGO/STRAWBERRY/KIWI/PINAPPLE/ GREEN APPLE', 7, 130.00, 1, '234.jpg', 'ROSE/MANGO/STRAWBERRY/KIWI/PINAPPLE/\r\nGREEN APPLE', 1, 1),
(235, 'ICED CAPPUCCINO ', 7, 140.00, 1, '235.jpg', 'ICED CAPPUCCINO ', 1, 1),
(236, 'CHILLI POTATO', 5, 160.00, 1, '236.jpg', 'CHILLI POTATO', 1, 1),
(237, 'CHILLI PANEER', 5, 175.00, 1, '237.jpg', 'CHILLI PANEER', 1, 1),
(238, 'CHILLI BABYCORN', 5, 175.00, 1, '238_1612234854.jpg', 'CHILLI BABYCORN', 1, 1),
(239, 'CHILLI MUSHROOM ', 5, 175.00, 1, '239.jpg', 'CHILLI MUSHROOM ', 1, 1),
(240, 'VEG SWEET N SOUR', 5, 165.00, 1, '240.jpg', 'VEG SWEET N SOUR', 1, 1),
(241, 'VEG MANCHURIAN', 5, 165.00, 1, '241.jpg', 'VEG MANCHURIAN', 1, 1),
(242, 'PANEER MANCHURIAN', 5, 175.00, 1, '242.jpg', 'PANEER MANCHURIAN', 1, 1),
(243, 'CHILLI CHICKEN ', 5, 180.00, 1, '243.jpg', 'CHILLI CHICKEN ', 1, 1),
(244, 'CHICKEN MUNCHURIAN ', 5, 180.00, 1, '244.jpg', 'CHICKEN MUNCHURIAN ', 1, 1),
(245, 'GARLIC CHICKEN', 5, 190.00, 1, '245.jpg', 'GARLIC CHICKEN', 1, 1),
(246, 'GINGER CHICKEN', 5, 180.00, 1, '246.jpg', 'GINGER CHICKEN', 1, 1),
(247, 'SWEET N SOUR CHICKEN', 5, 180.00, 1, '247.jpg', 'SWEET N SOUR CHICKEN', 1, 1),
(248, 'SZECHUAN CHICKEN ', 5, 180.00, 1, '248.jpg', 'SZECHUAN CHICKEN ', 1, 1),
(249, 'CHICKEN WITH VEG MUSHROOM ', 5, 185.00, 1, '249.jpg', 'CHICKEN WITH VEG MUSHROOM ', 1, 1),
(250, 'CHILLI FISH', 5, 190.00, 1, '250.jpg', 'CHILLI FISH', 1, 1),
(251, 'FISH MUNCHURIAN ', 5, 190.00, 1, '251.jpg', 'FISH MUNCHURIAN ', 1, 1),
(252, 'GARLIC FISH', 5, 195.00, 1, '252.jpg', 'GARLIC FISH', 1, 1),
(253, 'SZECHUAN FISH ', 5, 195.00, 1, '253.jpg', 'SZECHUAN FISH ', 1, 1),
(254, 'CHILLI PRAWN ', 5, 210.00, 1, '254.jpg', 'CHILLI PRAWN ', 1, 1),
(255, 'GARLIC PRAWN ', 5, 210.00, 1, '255.jpg', 'GARLIC PRAWN ', 1, 1),
(256, 'PRAWN MUNCHURIAN ', 5, 210.00, 1, '256.jpg', 'PRAWN MUNCHURIAN ', 1, 1),
(257, 'THUNDERSTORM', 9, 190.00, 1, '257.jpg', ' SOFTY VANILLA ICE CREAM WITH CHOCOLATE\r\nCHIPS, BROWNIE, CASHEW NUTS & ALMONDS\r\nTOPPED WITH RICH CHOCOLATE SAUCE ', 1, 1),
(258, 'FRESH FRUITS', 9, 190.00, 1, '258.jpg', 'FRESH FRUITS', 1, 1),
(259, 'DRY FRUITS', 9, 190.00, 1, '259.jpg', ' SOFTY VANILLA ICE CREAM WITH CASHEW NUTS\r\nALMONDS & RESINS TOPPED WITH HONEY ', 1, 1),
(260, 'AS YOU LIKE IT', 8, 210.00, 1, '260.jpg', ' THREE SCOOPS OF ICE CREAM OF YOUR\r\nCHOICE TOPPED WITH A SAUCE OF\r\nYOUR CHOICE)', 1, 1),
(261, 'TUTTY FRUITY', 8, 210.00, 1, '261_1612236487.jpg', '( TWO SCOOPS OF TUTTY FRUITY ICE CREAM &\r\n1 SCOOP OF VANILLA ICE CREAM, SERVED\r\nWITH FRESH FRUITS', 1, 1),
(262, 'DARK DESIRE', 8, 210.00, 1, '262.jpg', ' THREE SCOOPS OF CHOCOLATE ICE CREAM,\r\nTOPPED WITH CHOCOLATE CHIPS, BROWNIE &\r\nCHOCOLATE SAUCE', 1, 1),
(263, 'PINEAPPLE MANIA', 8, 210.00, 1, '263.jpg', 'TWO SCOOPS OF VANILLA ICE CREAM &\r\n1 SCOOP OF PINEAPPLE ICE CREAM, TOPPED\r\nWITH PINEAPPLE SAUCE & FRUITS', 1, 1),
(264, 'BROWNIE WITH ICE-CREAM', 8, 210.00, 1, '264.jpg', '( TOPPED WITH RICH CHOCOLATE SAUCE)', 1, 1),
(265, 'ICED BLACK FOREST ', 7, 140.00, 1, '265.jpg', 'ICED BLACK FOREST ', 1, 1),
(266, 'ICED CHOCOLATE ', 7, 130.00, 1, '266.jpg', 'ICED CHOCOLATE ', 1, 1),
(267, 'MINT/GREEN APPLE/PEACH ICED TEA ', 7, 130.00, 1, '267.jpg', 'MINT/GREEN APPLE/PEACH ICED TEA ', 1, 1),
(268, 'FRESH LIME SODA', 7, 90.00, 1, '268.jpg', 'FRESH LIME SODA', 1, 1),
(269, 'GREEN APPLE/PEACH/STRAWBERRY/ 125.00 LEMON GINGER/KIWI/BLUE OCEAN SPARKLE', 7, 125.00, 1, '269.jpg', 'GREEN APPLE/PEACH/STRAWBERRY/ 125.00\r\nLEMON GINGER/KIWI/BLUE OCEAN SPARKLE\r\n', 1, 1),
(270, 'LAIN MOJITO', 9, 125.00, 1, '270.jpg', 'LAIN MOJITO', 1, 1),
(271, 'PASSION FRUIT/PEACH/GREEN APPLE MOJITO ', 7, 130.00, 1, '271.jpg', 'PASSION FRUIT/PEACH/GREEN APPLE MOJITO ', 1, 1),
(272, 'CHOCO COOKIE/OREO/CHOCO COOKIE OREO/BANANA 140.00 CARAMEL/STRAWBERRY/KIWI/GREEN APPLE SHAKE', 9, 140.00, 1, '272.jpg', 'CHOCO COOKIE/OREO/CHOCO COOKIE OREO/BANANA 140.00\r\nCARAMEL/STRAWBERRY/KIWI/GREEN APPLE SHAKE', 1, 1),
(274, 'Egg ,cheese ,chicken Kebab Roll', 10, 90.00, 1, '274.jpg', 'Egg ,cheese ,chicken Kebab Roll', 1, 2),
(275, 'Egg Chicken Kebab Roll', 10, 80.00, 1, '275.jpg', 'Egg Chicken Kebab Roll', 1, 2),
(276, 'Chicken Cheese Kebab Roll', 10, 80.00, 1, '276.jpg', 'Chicken Cheese Kebab Roll', 1, 2),
(277, 'Chicken Kabab Roll', 10, 70.00, 1, '277.jpg', 'Chicken Kabab Roll', 1, 2),
(278, 'Veg Roll', 10, 55.00, 1, '278.jpg', 'Veg Roll', 1, 2),
(279, 'Paneer Roll', 10, 60.00, 1, '279.jpg', 'Paneer Roll', 1, 2),
(280, 'Egg Roll', 10, 60.00, 1, '280.jpg', 'Egg Roll', 1, 2),
(281, 'Veg Wrap', 10, 115.00, 1, '281.jpg', 'Veg Wrap', 1, 2),
(282, 'Grilled Paneer Wrap', 10, 130.00, 1, '282.jpg', 'Grilled Paneer Wrap', 1, 2),
(283, 'Egg Mushroom Wrap', 10, 130.00, 1, '283.jpg', 'Egg Mushroom Wrap', 1, 2),
(284, 'Grilled Chicken Wrap', 10, 150.00, 1, '284.jpg', 'Grilled Chicken Wrap', 1, 2),
(285, 'Crispy Chilli Potato', 10, 160.00, 1, '285.jpg', 'Crispy Chilli Potato', 1, 2),
(286, 'Veg Falafel Kabab', 10, 120.00, 1, '286.jpg', 'Veg Falafel Kabab', 1, 2),
(287, 'Veg Cutlet', 10, 120.00, 1, '287.jpg', 'Veg Cutlet', 1, 2),
(288, 'French Fries', 10, 80.00, 1, '288.jpg', 'French Fries', 1, 2),
(289, 'Paneer Pakoda (6 Pcs)', 10, 150.00, 1, '289.jpg', 'Paneer Pakoda (6 Pcs)', 1, 2),
(290, 'Cheese Corn Nuggets (6 Pcs)', 10, 140.00, 1, '290.jpg', 'Cheese Corn Nuggets (6 Pcs)', 1, 2),
(291, 'Crispy Chilli Babycorn (dry)', 10, 170.00, 1, '291.jpg', 'Crispy Chilli Babycorn (dry)', 1, 2),
(292, 'Chilli Garlic Potato Shots', 10, 120.00, 1, '292.jpg', 'Chilli Garlic Potato Shots', 1, 2),
(293, 'Chilli Mushroom Golden Fried', 10, 180.00, 1, '293.jpg', 'Chilli Mushroom Golden Fried', 1, 2),
(294, 'Chola Bhatura', 10, 150.00, 1, '294.jpg', 'Chola Bhatura', 1, 2),
(295, 'Pav Bhaji', 10, 120.00, 1, '295.jpg', 'Pav Bhaji', 1, 2),
(296, 'Vada Pav (2 Pcs)', 10, 90.00, 1, '296.jpg', 'Vada Pav (2 Pcs)', 1, 2),
(297, 'Chicken Reshmi Kebab', 10, 190.00, 1, '297.jpg', 'Chicken Reshmi Kebab', 1, 2),
(298, 'Chicken Wings', 10, 150.00, 1, '298.jpg', 'Chicken Wings', 1, 2),
(299, 'Chicken Fries', 10, 150.00, 1, '299.jpg', 'Chicken Fries', 1, 2),
(300, 'Chicken Pakoda', 10, 160.00, 1, '300.jpg', 'Chicken Pakoda', 1, 2),
(301, 'Chicken Popcorn', 10, 130.00, 1, '301.jpg', 'Chicken Popcorn', 1, 2),
(302, 'Chicken Cutlet', 10, 160.00, 1, '302.jpg', 'Chicken Cutlet', 1, 2),
(303, 'Chicken Nuggets', 10, 150.00, 1, '303.jpg', 'Chicken Nuggets', 1, 2),
(304, 'Chicken Sausages', 10, 150.00, 1, '304.jpg', 'Chicken Sausages', 1, 2),
(305, 'Fried Chicken Strips With Fries', 10, 190.00, 1, '305.jpg', 'Fried Chicken Strips With Fries', 1, 2),
(306, 'Pan Fried Chicken', 10, 180.00, 1, '306.jpg', 'Pan Fried Chicken', 1, 2),
(307, 'Pepper Garlic Chicken', 10, 180.00, 1, '307.jpg', 'Pepper Garlic Chicken', 1, 2),
(308, 'Crispy Fried Chicken', 10, 180.00, 1, '308.jpg', 'Crispy Fried Chicken', 1, 2),
(309, 'Chicken Tikka Kebab', 10, 200.00, 1, '309.jpg', 'Chicken Tikka Kebab', 1, 2),
(310, 'Fish Fingers With Fries (6 Pcs)', 10, 200.00, 1, '310.jpg', 'Fish Fingers With Fries (6 Pcs)', 1, 2),
(311, 'Fish And Chips With Fries And Tarted Sauce', 10, 200.00, 1, '311.jpg', 'Fish And Chips With Fries And Tarted Sauce', 1, 2),
(312, 'Pan Fried Fish', 10, 230.00, 1, '312.jpg', 'Pan Fried Fish', 1, 2),
(313, 'Chicken Panco Momo', 10, 150.00, 1, '313.jpg', 'Chicken Panco Momo', 1, 2),
(314, 'Veg Panco Momo', 10, 140.00, 1, '314.jpg', 'Veg Panco Momo', 1, 2),
(315, 'Chicken Momo', 10, 120.00, 1, '315.jpg', 'Chicken Momo', 1, 2),
(316, 'Veg Momo', 10, 105.00, 1, '316.jpg', 'Veg Momo', 1, 2),
(317, 'Veg Navratna Thali', 10, 185.00, 1, '317.jpg', 'Veg Navratna Thali', 1, 2),
(318, 'Paneer Tikka Thali', 11, 185.00, 1, '318.jpg', 'Paneer Tikka Thali', 1, 2),
(319, 'Scoop Special Veg Thali', 11, 230.00, 1, '319.jpg', 'Scoop Special Veg Thali', 1, 2),
(320, 'Chicken Tikka Thali', 11, 195.00, 1, '320.jpg', 'Chicken Tikka Thali', 1, 2),
(321, 'Chicken Reshmi Butter Masala Thali', 11, 195.00, 1, '321.jpg', 'Chicken Reshmi Butter Masala Thali', 1, 2),
(322, 'Chicken Butter Masala Thali', 11, 195.00, 1, '322.jpg', 'Chicken Butter Masala Thali', 1, 2),
(323, 'Scoop Special Non Veg Thali', 11, 250.00, 1, '323.jpg', 'Scoop Special Non Veg Thali', 1, 2),
(324, 'Veg Noodles Combo', 11, 165.00, 1, '324.jpg', 'Veg Noodles Combo', 1, 2),
(325, 'Veg Fried Rice Combo', 12, 175.00, 1, '325.jpg', 'Veg Fried Rice Combo', 1, 2),
(326, 'Veg Chinese Sizzler', 12, 250.00, 1, '326.jpg', 'Veg Chinese Sizzler', 1, 2),
(327, 'Chicken Noodles Combo', 12, 175.00, 1, '327.jpg', 'Chicken Noodles Combo', 1, 2),
(328, 'Chicken Rice Combo', 12, 185.00, 1, '328.jpg', 'Chicken Rice Combo', 1, 2),
(329, 'Non Veg Chinese Sizzler', 12, 290.00, 1, '329.jpg', 'Non Veg Chinese Sizzler', 1, 2),
(330, 'Veg Jalfrezi', 12, 100.00, 1, '330.jpg', 'Veg Jalfrezi', 1, 2),
(331, 'Malai Kofta - Half', 13, 100.00, 1, '331.jpg', 'Malai Kofta', 1, 2),
(332, 'Paneer Butter Masala- Half', 13, 100.00, 1, '332.jpg', 'Paneer Butter Masala', 1, 2),
(333, 'Navratan Korma- Half', 13, 110.00, 1, '333.jpg', 'Navratan Korma', 1, 2),
(334, 'Sahi Paneer- Half', 13, 110.00, 1, '334.jpg', 'Sahi Paneer', 1, 2),
(335, 'Aloo Dum- Half', 13, 90.00, 1, '335.jpg', 'Aloo Dum', 1, 2),
(336, 'Channa Masala- Half', 13, 95.00, 1, '336.jpg', 'Channa Masala', 1, 2),
(337, 'Dal Makhani - Half', 13, 90.00, 1, '337.jpg', 'Dal Makhani ', 1, 2),
(338, 'Yellow Dal Fry- Half', 13, 90.00, 1, '338.jpg', 'Yellow Dal Fry', 1, 2),
(339, 'Chicken Reshmi Butter Masala- Half', 13, 120.00, 1, '339.jpg', 'Chicken Reshmi Butter Masala', 1, 2),
(340, 'Chicken Tikka Masala- Half', 13, 120.00, 1, '340.jpg', 'Chicken Tikka Masala', 1, 2),
(341, 'Chicken Butter Masala- Half', 13, 120.00, 1, '341.jpg', 'Chicken Butter Masala', 1, 2),
(342, 'Chicken-do-pyaza- Half', 13, 120.00, 1, '342.jpg', 'Chicken-do-pyaza', 1, 2),
(343, 'Chicken Bharta- Half', 13, 120.00, 1, '343.jpg', 'Chicken Bharta', 1, 2),
(344, 'Veg Pulao- Half', 13, 85.00, 1, '344.jpg', 'Veg Pulao', 1, 2),
(345, 'Peas Pulao- Half', 13, 80.00, 1, '345.jpg', 'Peas Pulao', 1, 2),
(346, 'Malai Kofta - FULL', 13, 180.00, 1, '331.jpg', 'Malai Kofta- FULL', 1, 2),
(347, 'Paneer Butter Masala - FULL', 13, 180.00, 1, '332.jpg', 'Paneer Butter Masala- FULL', 1, 2),
(348, 'Navratan Korma- FULL', 13, 185.00, 1, '333.jpg', 'Navratan Korma- FULL', 1, 2),
(349, 'Sahi Paneer- FULL', 13, 180.00, 1, '334.jpg', 'Sahi Paneer- FULL', 1, 2),
(350, 'Aloo Dum- FULL', 13, 140.00, 1, '335.jpg', 'Aloo Dum- FULL', 1, 2),
(351, 'Channa Masala- FULL', 13, 155.00, 1, '336.jpg', 'Channa Masala- FULL', 1, 2),
(352, 'Dal Makhani - FULL', 13, 140.00, 1, '337.jpg', 'Dal Makhani - FULL', 1, 2),
(353, 'Yellow Dal Fry - FULL', 13, 140.00, 1, '338.jpg', 'Yellow Dal Fry- FULL', 1, 2),
(354, 'Chicken Reshmi Butter Masala- FULL', 13, 210.00, 1, '339.jpg', 'Chicken Reshmi Butter Masala- FULL', 1, 2),
(355, 'Chicken Tikka Masala- FULL', 13, 200.00, 1, '340.jpg', 'Chicken Tikka Masala- FULL', 1, 2),
(356, 'Chicken Butter Masala- FULL', 13, 200.00, 1, '341.jpg', 'Chicken Butter Masala- FULL', 1, 2),
(357, 'Chicken-do-pyaza - FULL', 13, 190.00, 1, '342.jpg', 'Chicken-do-pyaza- FULL', 1, 2),
(358, 'Chicken Bharta', 13, 210.00, 1, '343.jpg', 'Chicken Bharta- FULL', 1, 2),
(359, 'Veg Pulao- FULL', 13, 135.00, 1, '344.jpg', 'Veg Pulao- FULL', 1, 2),
(360, 'Peas Pulao- FULL', 13, 120.00, 1, '345.jpg', 'Peas Pulao- FULL', 1, 2),
(361, 'Veg Jalfrezi - HAlf', 13, 100.00, 1, '361.jpg', 'Veg Jalfrezi - HAlf', 1, 2),
(362, 'Veg Jalfrezi - FULL', 13, 180.00, 1, '362.jpg', 'Veg Jalfrezi - FULL', 1, 2),
(363, 'Jeera Rice - Half', 13, 75.00, 1, '363.jpg', 'Jeera Rice - Half', 1, 2),
(364, 'Jeera Rice - FULL', 13, 120.00, 1, '364.jpg', 'Jeera Rice - FULL', 1, 2),
(365, 'Steamed Rice -HALF', 13, 90.00, 1, '365.jpg', 'Steamed Rice -HALF', 1, 2),
(366, 'Chicken Keema Paratha', 13, 150.00, 1, '366.jpg', 'Chicken Keema Paratha', 1, 2),
(367, 'Veg Paratha', 13, 125.00, 1, '367.jpg', 'Veg Paratha', 1, 2),
(368, 'Veg Paratha - Paneer ', 13, 135.00, 1, '368.jpg', 'Veg Paratha - Paneer ', 1, 2),
(369, 'Veg Paratha - Mixed ', 13, 130.00, 1, '369.jpg', 'Veg Paratha - Mixed ', 1, 2),
(370, 'Tawa Masala Kulcha', 13, 50.00, 1, '370.jpg', 'Tawa Masala Kulcha', 1, 2),
(371, 'Naan - Plain', 13, 40.00, 1, '371.jpg', 'Naan - Plain', 1, 2),
(372, 'Naan - Butter', 13, 45.00, 1, '372.jpg', 'Naan - Butter', 1, 2),
(373, 'Naan - Garlic ', 13, 45.00, 1, '373.jpg', 'Naan - Garlic ', 1, 2),
(374, 'Lacha Paratha', 13, 45.00, 1, '374.jpg', 'Lacha Paratha', 1, 2),
(375, 'Chilli Cheese Toast', 14, 130.00, 1, '375.jpg', 'Chilli Cheese Toast', 1, 2),
(376, 'Cheese Garlic Bread', 14, 130.00, 1, '376.jpg', 'Cheese Garlic Bread', 1, 2),
(377, 'Grilled Veggie Farmhouse Sandwich', 14, 140.00, 1, '377.jpg', 'Grilled Veggie Farmhouse Sandwich', 1, 2),
(378, 'Veg Grilled Coleshaw Sandwich', 14, 140.00, 1, '378.jpg', 'Veg Grilled Coleshaw Sandwich', 1, 2),
(379, 'Cheese Corn Sandwich', 14, 140.00, 1, '379.jpg', 'Cheese Corn Sandwich', 1, 2),
(380, 'Paneer Tikka Sandwich', 14, 145.00, 1, '380.jpg', 'Paneer Tikka Sandwich', 1, 2),
(381, 'Bombay Grilled Sandwich', 14, 160.00, 1, '381.jpg', 'Bombay Grilled Sandwich', 1, 2),
(382, 'Veggie Club Sandwich', 14, 170.00, 1, '382.jpg', 'Veggie Club Sandwich', 1, 2),
(383, 'Chicken Mayo Sandwich', 14, 120.00, 1, '383.jpg', 'Chicken Mayo Sandwich', 1, 2),
(384, 'Chicken Grilled Sandwich', 14, 140.00, 1, '384.jpg', 'Chicken Grilled Sandwich', 1, 2),
(385, 'Chicken Corn Grilled Sandwich', 14, 145.00, 1, '385.jpg', 'Chicken Corn Grilled Sandwich', 1, 2),
(386, 'Chicken Mushroon Grilled Sandwich', 14, 145.00, 1, '386.jpg', 'Chicken Mushroon Grilled Sandwich', 1, 2),
(387, 'Chicken Egg Grilled Sandwich', 14, 145.00, 1, '386.jpg', 'Chicken Egg Grilled Sandwich', 1, 2),
(388, 'Chicken Tikka Grilled Sandwich', 14, 145.00, 1, '386.jpg', 'Chicken Tikka Grilled Sandwich', 1, 2),
(389, 'Chicken Club Sandwich', 14, 180.00, 1, '386.jpg', 'Chicken Club Sandwich', 1, 2),
(390, 'Veg Burger', 14, 130.00, 1, '386.jpg', 'Veg Burger', 1, 2),
(391, 'Chicken Burger', 14, 140.00, 1, '386.jpg', 'Chicken Burger', 1, 2),
(392, 'Cheese Onion Capsicum Pizza', 14, 200.00, 1, '386.jpg', 'Cheese Onion Capsicum Pizza', 1, 2),
(393, 'Margarita Pizza', 14, 180.00, 1, '386.jpg', 'Margarita Pizza', 1, 2),
(394, 'Paneer Tikka Pizza', 14, 210.00, 1, '386.jpg', 'Paneer Tikka Pizza', 1, 2),
(395, 'Scoop Special Veg Pizza', 14, 230.00, 1, '386.jpg', 'Scoop Special Veg Pizza', 1, 2),
(396, 'Chicken Tikka Pizza', 14, 230.00, 1, '386.jpg', 'Chicken Tikka Pizza', 1, 2),
(397, 'Chicken Pizza', 14, 220.00, 1, '386.jpg', 'Chicken Pizza', 1, 2),
(398, 'Scoop Special Non Veg Pizza', 14, 250.00, 1, '386.jpg', 'Scoop Special Non Veg Pizza', 1, 2),
(399, 'Penne Pasta', 14, 175.00, 1, '386.jpg', 'Penne Pasta', 1, 2),
(400, 'Macaroni Pasta -VEG', 14, 175.00, 1, '386.jpg', 'Macaroni Pasta -VEG', 1, 2),
(401, 'Macaroni Pasta - NON VEG', 14, 185.00, 1, '386.jpg', 'Macaroni Pasta - NON VEG', 1, 2),
(402, 'Penne Pasta NON-VEG', 14, 185.00, 1, '386.jpg', 'Penne Pasta', 1, 2),
(403, 'Scoop Special Pasta - VEG', 14, 190.00, 1, '386.jpg', 'Scoop Special Pasta - VEG', 1, 2),
(404, 'Scoop Special Pasta - NON VEG', 14, 200.00, 1, '386.jpg', 'Scoop Special Pasta - NON VEG', 1, 2),
(405, 'Chelo Kebab', 14, 250.00, 1, '386.jpg', 'Chelo Kebab', 1, 2),
(406, 'Veg Sizzlers', 14, 250.00, 1, '386.jpg', 'Veg Sizzlers', 1, 2),
(407, 'Paneer Steak', 14, 250.00, 1, '386.jpg', 'Paneer Steak', 1, 2),
(408, 'Veggie Au Gratin', 14, 250.00, 1, '386.jpg', 'Veggie Au Gratin', 1, 2),
(409, 'Veg Supreme Baked', 14, 250.00, 1, '386.jpg', 'Veg Supreme Baked', 1, 2),
(410, 'Veg Enchilada', 14, 275.00, 1, '386.jpg', 'Veg Enchilada', 1, 2),
(411, 'Veg Enchiladas', 14, 275.00, 1, '386.jpg', 'Veg Enchiladas', 1, 2),
(412, 'Chicken Sizzler', 14, 295.00, 1, '386.jpg', 'Chicken Sizzler', 1, 2),
(413, 'Chicken Steak', 14, 295.00, 1, '386.jpg', 'Chicken Steak', 1, 2),
(414, 'Grilled Chicken', 14, 285.00, 1, '386.jpg', 'Grilled Chicken', 1, 2),
(415, 'Chicken Stroganoff', 14, 280.00, 1, '386.jpg', 'Chicken Stroganoff', 1, 2),
(416, 'Chicken Supreme Baked', 14, 280.00, 1, '386.jpg', 'Chicken Supreme Baked', 1, 2),
(417, 'Barbeque Jerk Chicken', 14, 100.00, 1, '386.jpg', 'Barbeque Jerk Chicken', 1, 2),
(418, 'Fish Supreme Baked', 14, 295.00, 1, '386.jpg', 'Fish Supreme Baked', 1, 2),
(419, 'Scoop Special Soup - Veg', 15, 160.00, 1, '386.jpg', 'Scoop Special Soup veg', 1, 2),
(420, 'Scoop Special Soup - Non Veg', 15, 170.00, 1, '386.jpg', 'Scoop Special Soup - Non Veg', 1, 2),
(421, 'Sweet Corn Soup - VEG', 15, 150.00, 1, '386.jpg', 'Sweet Corn Soup', 1, 2),
(422, 'Sweet Corn Soup - Chicken ', 15, 160.00, 1, '386.jpg', 'Sweet Corn Soup', 1, 2),
(423, 'Mushroom Soup - VEG', 15, 150.00, 1, '386.jpg', 'Mushroom Soup', 1, 2),
(424, 'Mushroom Soup - Chicken N Egg', 15, 160.00, 1, '386.jpg', 'Chicken N Egg', 1, 2),
(425, 'Hot N Sour Soup - VEG', 15, 150.00, 1, '386.jpg', 'Hot N Sour Soup', 1, 2),
(426, 'Hot N Sour Soup - Chicken ', 15, 160.00, 1, '386.jpg', 'Hot N Sour Soup', 1, 2),
(427, 'Clear Soup - VEG', 15, 140.00, 1, '386.jpg', 'Clear Soup', 1, 2),
(428, 'Clear Soup - Chicken ', 15, 145.00, 1, '386.jpg', 'Clear Soup', 1, 2),
(429, 'Steamed Rice With Veggies ', 15, 165.00, 1, '386.jpg', 'Steamed Rice With Veggies', 1, 2),
(430, 'Chilli Garlic Fried Rice - HALF', 15, 100.00, 1, '386.jpg', 'Chilli Garlic Fried Rice', 1, 2),
(431, 'Chilli Garlic Fried Rice - FULL', 15, 160.00, 1, '386.jpg', 'Chilli Garlic Fried Rice', 1, 2),
(432, 'Schezwan Veg Fried Rice -HALF', 15, 100.00, 1, '386.jpg', 'Schezwan Veg Fried Rice', 1, 2),
(433, 'Schezwan Veg Fried Rice -FULL', 15, 160.00, 1, '386.jpg', 'Schezwan Veg Fried Rice', 1, 2),
(434, 'Veg Ginger Capsicum Fried Rice - HALF', 15, 100.00, 1, '386.jpg', 'Veg Ginger Capsicum Fried Rice', 1, 2),
(435, 'Veg Ginger Capsicum Fried Rice - FULL', 15, 160.00, 1, '386.jpg', 'Veg Ginger Capsicum Fried Rice', 1, 2),
(436, 'Veg Fried Rice - HALF', 15, 100.00, 1, '386.jpg', 'Veg Fried Rice', 1, 2),
(437, 'Veg Fried Rice - FULL', 15, 150.00, 1, '386.jpg', 'Veg Fried Rice', 1, 2),
(438, 'Steamed Rice With Chicken N Veg', 15, 185.00, 1, '386.jpg', 'Steamed Rice With Chicken N Veg', 1, 2),
(439, 'Mixed Fried Rice - Regular -HALF  ', 15, 110.00, 1, '386.jpg', 'Mixed Fried Rice - Regular -HALF  ', 1, 2),
(440, 'Mixed Fried Rice - Schezwan - HALF  ', 15, 115.00, 1, '386.jpg', 'Mixed Fried Rice - Schezwan - HALF  ', 1, 2),
(441, 'Mixed Fried Rice - Chilli Garlic- HALF  ', 15, 115.00, 1, '386.jpg', 'Mixed Fried Rice - Chilli Garlic- HALF  ', 1, 2),
(442, 'Mixed Fried Rice - Regular - FULL  ', 15, 175.00, 1, '386.jpg', 'Mixed Fried Rice - Regular - FULL  ', 1, 2),
(443, 'Mixed Fried Rice - Schezwan - FULL  ', 15, 180.00, 1, '386.jpg', 'Mixed Fried Rice - Schezwan - FULL  ', 1, 2),
(444, 'Mixed Fried Rice - Chilli Garlic- FULL  ', 15, 180.00, 1, '386.jpg', 'Mixed Fried Rice - Chilli Garlic- FULL  ', 1, 2),
(445, 'Chicken Fried Rice - HALF', 15, 110.00, 1, '386.jpg', 'Chicken Fried Rice - HALF', 1, 2),
(446, 'Chicken Fried Rice - FULL', 15, 165.00, 1, '386.jpg', 'Chicken Fried Rice - FULL', 1, 2),
(447, 'Egg Fried Rice - FULL', 15, 160.00, 1, '386.jpg', 'Egg Fried Rice - FULL', 1, 2),
(448, 'Egg Fried Rice - HALF', 15, 100.00, 1, '386.jpg', 'Egg Fried Rice - HALF', 1, 2),
(449, 'Veg Canton Noodles With Gravy', 15, 165.00, 1, '386.jpg', 'Veg Canton Noodles With Gravy', 1, 2),
(450, 'Veg Hakka Noodle - HALF', 15, 100.00, 1, '386.jpg', 'Veg Hakka Noodle', 1, 2),
(451, 'Veg Hakka Noodle - FULL', 15, 160.00, 1, '386.jpg', 'Veg Hakka Noodle', 1, 2),
(452, 'Veg Noodle - Hakka - Half', 15, 100.00, 1, '386.jpg', 'Veg Noodle', 1, 2),
(453, 'Veg Noodle - Gravy - Half', 15, 110.00, 1, '386.jpg', 'Veg Noodle', 1, 2),
(454, 'Veg Noodle - Hakka- FULL', 15, 150.00, 1, '386.jpg', 'Veg Noodle', 1, 2),
(455, 'Veg Noodle - Gravy - FULL', 15, 160.00, 1, '386.jpg', 'Veg Noodle', 1, 2),
(456, 'Schezwan Chicken Noodles HALF', 15, 110.00, 1, '386.jpg', 'Schezwan Chicken Noodles', 1, 2),
(457, 'Schezwan Chicken Noodles - FULL', 15, 170.00, 1, '386.jpg', 'Schezwan Chicken Noodles', 1, 2),
(458, 'Mixed Noodle - Hakka - HALF', 15, 110.00, 1, '386.jpg', 'Mixed Noodle', 1, 2),
(459, 'Mixed Noodle - Gravy - HALF', 15, 120.00, 1, '386.jpg', 'Mixed Noodle', 1, 2),
(460, 'Mixed Noodle - Hakka - FULL', 15, 170.00, 1, '386.jpg', 'Mixed Noodle', 1, 2),
(461, 'Mixed Noodle - Gravy - FULL', 15, 180.00, 1, '386.jpg', 'Mixed Noodle', 1, 2),
(462, 'Chicken Noodles - Hakka - HALF', 15, 100.00, 1, '386.jpg', 'Chicken Noodles ', 1, 2),
(463, 'Chicken Noodles - Gravy - HALF', 15, 110.00, 1, '386.jpg', 'Chicken Noodles ', 1, 2),
(464, 'Chicken Noodles - Hakka - FULL', 15, 160.00, 1, '386.jpg', 'Chicken Noodles ', 1, 2),
(465, 'Chicken Noodles - Gravy - FULL', 15, 170.00, 1, '386.jpg', 'Chicken Noodles ', 1, 2),
(466, 'Chicken Noodles - Gravy - FULL', 15, 170.00, 1, '386.jpg', 'Chicken Noodles ', 1, 2),
(467, 'Egg Noodles - Hakka - HALF', 15, 100.00, 1, '386.jpg', 'Egg Noodles', 1, 2),
(468, 'Egg Noodles - Gravy - HALF', 15, 110.00, 1, '386.jpg', 'Egg Noodles', 1, 2),
(469, 'Egg Noodles - Hakka - FULL', 15, 160.00, 1, '386.jpg', 'Egg Noodles', 1, 2),
(470, 'Egg Noodles - Gravy - FULL', 15, 170.00, 1, '386.jpg', 'Egg Noodles', 1, 2),
(471, 'Paneer Munchurian -HALF', 15, 110.00, 1, '386.jpg', 'Paneer Munchurian', 1, 2),
(472, 'Paneer Munchurian -FULL', 15, 175.00, 1, '386.jpg', 'Paneer Munchurian', 1, 2),
(473, 'Veg Munchurian -HALF', 15, 110.00, 1, '386.jpg', 'Veg Munchurian', 1, 2),
(474, 'Veg Munchurian -FULL', 15, 165.00, 1, '386.jpg', 'Veg Munchurian', 1, 2),
(475, 'Veg Sweet N Sour -FULL', 15, 165.00, 1, '386.jpg', 'Veg Sweet N Sour', 1, 2),
(476, 'Veg Sweet N Sour -HALF', 15, 110.00, 1, '386.jpg', 'Veg Sweet N Sour', 1, 2),
(477, 'Chilli Mushroom -HALF', 15, 110.00, 1, '386.jpg', 'Chilli Mushroom', 1, 2),
(478, 'Chilli Mushroom -FULL', 15, 175.00, 1, '386.jpg', 'Chilli Mushroom', 1, 2),
(479, 'Chilli Babycorn Gravy -HALF', 15, 110.00, 1, '386.jpg', 'Chilli Babycorn Gravy', 1, 2),
(480, 'Chilli Babycorn Gravy -FULL', 15, 175.00, 1, '386.jpg', 'Chilli Babycorn Gravy', 1, 2),
(481, 'Chilli Paneer -HALF', 15, 110.00, 1, '386.jpg', 'Chilli Paneer', 1, 2),
(482, 'Chilli Paneer -FULL', 15, 175.00, 1, '386.jpg', 'Chilli Paneer', 1, 2),
(483, 'Chilli Potato -HALF', 15, 110.00, 1, '386.jpg', 'Chilli Potato', 1, 2),
(484, 'Chilli Potato -FULL', 15, 160.00, 1, '386.jpg', 'Chilli Potato', 1, 2),
(485, 'Prawn Munchurian -HALF', 15, 160.00, 1, '386.jpg', 'Prawn Munchurian', 1, 2),
(486, 'Prawn Munchurian -FULL', 15, 210.00, 1, '386.jpg', 'Prawn Munchurian', 1, 2),
(487, 'Garlic Prawn -HALF', 15, 160.00, 1, '386.jpg', 'Garlic Prawn', 1, 2),
(488, 'Garlic Prawn -FULL', 15, 210.00, 1, '386.jpg', 'Garlic Prawn', 1, 2),
(489, 'Chilli Prawn -HALF', 15, 160.00, 1, '386.jpg', 'Chilli Prawn', 1, 2),
(490, 'Chilli Prawn -FULL', 15, 210.00, 1, '386.jpg', 'Chilli Prawn', 1, 2),
(491, 'Schezwan Fish -HALF', 15, 135.00, 1, '386.jpg', 'Schezwan Fish', 1, 2),
(492, 'Schezwan Fish -FULL', 15, 195.00, 1, '386.jpg', 'Schezwan Fish', 1, 2),
(493, 'Garlic Fish -HALF', 15, 135.00, 1, '386.jpg', 'Garlic Fish', 1, 2),
(494, 'Garlic Fish -FULL', 15, 195.00, 1, '386.jpg', 'Garlic Fish', 1, 2),
(495, 'Fish Munchurian -HALF', 15, 130.00, 1, '386.jpg', 'Fish Munchurian', 1, 2),
(496, 'Fish Munchurian -FULL', 15, 190.00, 1, '386.jpg', 'Fish Munchurian', 1, 2),
(497, 'Chilli Fish -HALF', 15, 130.00, 1, '386.jpg', 'Chilli Fish', 1, 2),
(498, 'Chilli Fish -FULL', 15, 190.00, 1, '386.jpg', 'Chilli Fish', 1, 2),
(499, 'Chicken With Veg Mushroom -HALF', 15, 125.00, 1, '386.jpg', 'Chicken With Veg Mushroom', 1, 2),
(500, 'Chicken With Veg Mushroom -FULL', 15, 185.00, 1, '386.jpg', 'Chicken With Veg Mushroom', 1, 2),
(501, 'Schezwan Chicken -HALF', 15, 125.00, 1, '386.jpg', 'Schezwan Chicken', 1, 2),
(502, 'Schezwan Chicken -FULL', 15, 185.00, 1, '386.jpg', 'Schezwan Chicken', 1, 2),
(503, 'Sweet N Sour Chicken -HALF', 15, 120.00, 1, '386.jpg', 'Sweet N Sour Chicken', 1, 2),
(504, 'Sweet N Sour Chicken -FULL', 15, 180.00, 1, '386.jpg', 'Sweet N Sour Chicken', 1, 2),
(505, 'Ginger Chicken -HALF', 15, 120.00, 1, '386.jpg', 'Ginger Chicken', 1, 2),
(506, 'Ginger Chicken -FULL', 15, 180.00, 1, '386.jpg', 'Ginger Chicken', 1, 2),
(507, 'Garlic Chicken -HALF', 15, 120.00, 1, '386.jpg', 'Garlic Chicken', 1, 2),
(508, 'Garlic Chicken -FULL', 15, 190.00, 1, '386.jpg', 'Garlic Chicken', 1, 2),
(509, 'Chicken Munchurian -HALF', 15, 110.00, 1, '386.jpg', 'Chicken Munchurian', 1, 2),
(510, 'Chicken Munchurian -FULL', 15, 180.00, 1, '386.jpg', 'Chicken Munchurian', 1, 2),
(511, 'Chilli Chicken -HALF', 15, 110.00, 1, '386.jpg', 'Chilli Chicken', 1, 2),
(512, 'Chilli Chicken - FULL', 15, 180.00, 1, '386.jpg', 'Chilli Chicken', 1, 2),
(513, 'Sambar Vada', 16, 85.00, 1, '386.jpg', 'Sambar Vada', 1, 2),
(514, 'Plain Vada', 16, 80.00, 1, '386.jpg', 'Plain Vada', 1, 2),
(515, 'Fried Idly', 16, 95.00, 1, '386.jpg', 'Fried Idly', 1, 2),
(516, 'Plain Idly - Plain', 16, 80.00, 1, '386.jpg', 'Plain Idly', 1, 2),
(517, 'Plain Idly - Butter', 16, 90.00, 1, '386.jpg', 'Plain Idly', 1, 2),
(518, 'Mixed Uttapam - Mixed ', 16, 140.00, 1, '386.jpg', 'Mixed Uttapam ', 1, 2),
(519, 'Mixed Uttapam - Tomato', 16, 125.00, 1, '386.jpg', 'Mixed Uttapam ', 1, 2),
(520, 'Mixed Uttapam - Onion', 16, 125.00, 1, '386.jpg', 'Mixed Uttapam ', 1, 2),
(521, 'Mixed Uttapam - Paneer', 16, 135.00, 1, '386.jpg', 'Mixed Uttapam ', 1, 2),
(522, 'Mixed Uttapam - Cheese', 16, 135.00, 1, '386.jpg', 'Mixed Uttapam ', 1, 2),
(523, 'Mixed Uttapam - Schezwan ', 16, 135.00, 1, '386.jpg', 'Mixed Uttapam ', 1, 2),
(524, 'Plain Uttapam - Plain', 16, 115.00, 1, '386.jpg', 'Plain Uttapam', 1, 2),
(525, 'Plain Uttapam - Masala', 16, 120.00, 1, '386.jpg', 'Plain Uttapam', 1, 2),
(526, 'Chicken Masala Dosa - Plain', 16, 160.00, 1, '386.jpg', 'Chicken Masala Dosa ', 1, 2),
(527, 'Chicken Masala Dosa - Paper ', 16, 170.00, 1, '386.jpg', 'Chicken Masala Dosa ', 1, 2),
(528, 'Paper Masala Dosa ', 16, 130.00, 1, '386.jpg', 'Paper Masala Dosa', 1, 2),
(529, 'Paper Masala Dosa - Butter', 16, 140.00, 1, '386.jpg', 'Paper Masala Dosa', 1, 2),
(530, 'Paper Masala Dosa - Cheese ', 16, 140.00, 1, '386.jpg', 'Paper Masala Dosa', 1, 2),
(531, 'Paper Masala Dosa - Onion ', 16, 140.00, 1, '386.jpg', 'Paper Masala Dosa', 1, 2),
(532, 'Paper Masala Dosa - Butter N Cheese', 16, 150.00, 1, '386.jpg', 'Paper Masala Dosa', 1, 2),
(533, 'Paper Masala Dosa - Butter Onion', 16, 150.00, 1, '386.jpg', 'Paper Masala Dosa', 1, 2),
(534, 'Paper Masala Dosa - Schezwan ', 16, 140.00, 1, '386.jpg', 'Paper Masala Dosa', 1, 2),
(535, 'Masala Dosa -Butter ', 16, 125.00, 1, '386.jpg', 'Masala Dosa', 1, 2),
(536, 'Masala Dosa - Cheese', 16, 135.00, 1, '386.jpg', 'Masala Dosa', 1, 2),
(537, 'Masala Dosa - Onion ', 16, 135.00, 1, '386.jpg', 'Masala Dosa', 1, 2),
(538, 'Masala Dosa - Butter N Cheese', 16, 145.00, 1, '386.jpg', 'Masala Dosa', 1, 2),
(539, 'Masala Dosa - Butter Onion', 16, 140.00, 1, '386.jpg', 'Masala Dosa', 1, 2),
(540, 'Masala Dosa - Schezwan', 16, 135.00, 1, '386.jpg', 'Masala Dosa', 1, 2),
(541, 'Paper Plain Dosa - Plain', 16, 130.00, 1, '386.jpg', 'Paper Plain Dosa', 1, 2),
(542, 'Paper Plain Dosa - Butter ', 16, 140.00, 1, '386.jpg', 'Paper Plain Dosa', 1, 2),
(543, 'Paper Plain Dosa - Cheese ', 16, 140.00, 1, '386.jpg', 'Paper Plain Dosa', 1, 2),
(544, 'Paper Plain Dosa - Onion ', 16, 140.00, 1, '386.jpg', 'Paper Plain Dosa', 1, 2),
(545, 'Paper Plain Dosa - Butter N Cheese', 16, 140.00, 1, '386.jpg', 'Paper Plain Dosa', 1, 2),
(546, 'Paper Plain Dosa - Butter Onion', 16, 140.00, 1, '386.jpg', 'Paper Plain Dosa', 1, 2),
(547, 'Paper Plain Dosa - Schezwan', 16, 140.00, 1, '386.jpg', 'Paper Plain Dosa', 1, 2),
(548, 'Plain Dosa - Plain', 16, 105.00, 1, '386.jpg', 'Plain Dosa', 1, 2),
(549, 'Plain Dosa - Butter ', 16, 110.00, 1, '386.jpg', 'Plain Dosa', 1, 2),
(550, 'Plain Dosa - Cheese ', 16, 125.00, 1, '386.jpg', 'Plain Dosa', 1, 2),
(551, 'Plain Dosa - Onion', 16, 125.00, 1, '386.jpg', 'Plain Dosa', 1, 2),
(552, 'Plain Dosa - Butter N Cheese', 16, 130.00, 1, '386.jpg', 'Plain Dosa', 1, 2),
(553, 'Plain Dosa - Schezwan', 16, 120.00, 1, '386.jpg', 'Plain Dosa', 1, 2),
(554, 'Plain Dosa - Butter Onion', 16, 130.00, 1, '386.jpg', 'Plain Dosa', 1, 2),
(555, 'Lassi', 17, 120.00, 1, '386.jpg', 'Lassi', 1, 2),
(556, 'Flavoured Lassi', 17, 130.00, 1, '386.jpg', 'Flavoured Lassi', 1, 2),
(557, 'Iced Cappuccino', 17, 140.00, 1, '386.jpg', 'Iced Cappuccino', 1, 2),
(558, 'Iced Black Forest', 17, 150.00, 1, '386.jpg', 'Iced Black Forest', 1, 2),
(559, 'Iced Chocolate', 17, 130.00, 1, '386.jpg', 'Iced Chocolate', 1, 2),
(560, 'Iced Tea', 17, 130.00, 1, '386.jpg', 'Iced Tea', 1, 2),
(561, 'Shakes', 17, 140.00, 1, '386.jpg', 'Shakes', 1, 2),
(562, 'Moon Magic', 18, 200.00, 1, '386.jpg', 'Moon Magic', 1, 2),
(563, 'Pink Affair', 18, 200.00, 1, '386.jpg', 'Pink Affair', 1, 2),
(564, 'Dark Desire', 18, 200.00, 1, '386.jpg', 'Dark Desire', 1, 2),
(565, 'Tutty Fruity', 18, 200.00, 1, '386.jpg', 'Tutty Fruity', 1, 2),
(566, 'Brownie With Ice-cream', 18, 200.00, 1, '386.jpg', 'Brownie With Ice-cream', 1, 2),
(567, 'Thunder Storm', 18, 190.00, 1, '386.jpg', 'Thunder Storm', 1, 2),
(568, 'Fresh Fuit', 18, 190.00, 1, '386.jpg', 'Fresh Fuit', 1, 2),
(569, 'Dry Fruit', 18, 190.00, 1, '386.jpg', 'Dry Fruit', 1, 2),
(570, 'Egg Bhurji Toast ', 19, 95.00, 1, '386.jpg', 'Egg Bhurji Toast ', 1, 2),
(571, 'Chilli Cheese Bread Toast', 19, 95.00, 1, '386.jpg', 'Chilli Cheese Bread Toast', 1, 2),
(572, 'Baked Beans On Toast ', 19, 95.00, 1, '386.jpg', 'Baked Beans On Toast ', 1, 2),
(573, 'French Toast ', 19, 80.00, 1, '386.jpg', 'French Toast ', 1, 2),
(574, 'Cheese Bread ', 19, 75.00, 1, '386.jpg', 'Cheese Bread ', 1, 2),
(575, 'Peanut Butter Toast', 19, 65.00, 1, '386.jpg', 'Peanut Butter Toast', 1, 2),
(576, 'Bread Jam Toast', 19, 65.00, 1, '386.jpg', 'Bread Jam Toast', 1, 2);
INSERT INTO `food_demo` (`id`, `title`, `category`, `price`, `status`, `img`, `description`, `veg_or_nonveg`, `menu_type`) VALUES
(577, 'Bread Butter Toast', 19, 65.00, 1, '386.jpg', 'Bread Butter Toast', 1, 2),
(578, 'Grilled Chicken Sandwich', 19, 140.00, 1, '386.jpg', 'Grilled Chicken Sandwich', 1, 2),
(579, 'Non Veg Chicken Burger', 19, 140.00, 1, '386.jpg', 'Non Veg Chicken Burger', 1, 2),
(580, 'Chicken Mayo Sandwich (Plain)', 19, 110.00, 1, '386.jpg', 'Chicken Mayo Sandwich (Plain)', 1, 2),
(581, 'Veg Sandwich Grilled', 19, 135.00, 1, '386.jpg', 'Veg Sandwich Grilled', 1, 2),
(582, 'Veggie Burger', 19, 120.00, 1, '386.jpg', 'Veggie Burger', 1, 2),
(583, 'Veg Cole Slaw Sandwich ', 19, 90.00, 1, '386.jpg', 'Veg Cole Slaw Sandwich ', 1, 2),
(584, 'Chicken Sausage ', 19, 130.00, 1, '386.jpg', 'Chicken Sausage ', 1, 2),
(585, 'Fried Egg ', 19, 65.00, 1, '386.jpg', 'Fried Egg ', 1, 2),
(586, 'Masala Omelette ', 19, 65.00, 1, '386.jpg', 'Masala Omelette ', 1, 2),
(587, 'Sunny Side-Up ', 19, 65.00, 1, '386.jpg', 'Sunny Side-Up ', 1, 2),
(588, 'Scrambled Egg ', 19, 65.00, 1, '386.jpg', 'Scrambled Egg ', 1, 2),
(589, 'Plain Omelette ', 19, 65.00, 1, '386.jpg', 'Plain Omelette ', 1, 2),
(590, 'Poach', 19, 65.00, 1, '386.jpg', 'Poach', 1, 2),
(591, 'Boiled Egg', 19, 60.00, 1, '386.jpg', 'Boiled Egg', 1, 2),
(592, 'Honey Pan Cake', 19, 99.00, 1, '386.jpg', 'Honey Pan Cake', 1, 2),
(593, 'Strawberry Pan Cake ', 19, 99.00, 1, '386.jpg', 'Strawberry Pan Cake ', 1, 2),
(594, 'Chocolate Pan Cake ', 19, 99.00, 1, '386.jpg', 'Chocolate Pan Cake ', 1, 2),
(595, 'Plain Pan Cake ', 19, 80.00, 1, '386.jpg', 'Plain Pan Cake ', 1, 2),
(596, 'Mix Veg Paratha ', 19, 130.00, 1, '386.jpg', 'Mix Veg Paratha ', 1, 2),
(597, 'Onion Paratha ', 19, 120.00, 1, '386.jpg', 'Onion Paratha ', 1, 2),
(598, 'Mooli Paratha ', 19, 120.00, 1, '386.jpg', 'Mooli Paratha ', 1, 2),
(599, 'Gobi Paratha ', 19, 120.00, 1, '386.jpg', 'Gobi Paratha ', 1, 2),
(600, 'Aloo Paratha', 19, 120.00, 1, '386.jpg', 'Aloo Paratha', 1, 2),
(601, 'Egg Dosa', 19, 130.00, 1, '386.jpg', 'Egg Dosa', 1, 2),
(602, 'Onion Masal Dosa', 19, 120.00, 1, '386.jpg', 'Onion Masal Dosa', 1, 2),
(603, 'Cheese Masala Dosa', 19, 130.00, 1, '386.jpg', 'Cheese Masala Dosa', 1, 2),
(604, 'Butter Masala Dosa', 19, 120.00, 1, '386.jpg', 'Butter Masala Dosa', 1, 2),
(605, 'Masala Dosa Breakfast', 19, 110.00, 1, '386.jpg', 'Masala Dosa Breakfast', 1, 2),
(606, 'Cheese Plain Dosa', 19, 120.00, 1, '386.jpg', 'Cheese Plain Dosa', 1, 2),
(607, 'Butter Plain Dosa', 19, 110.00, 1, '386.jpg', 'Butter Plain Dosa', 1, 2),
(608, 'Onion Plain Dosa', 19, 110.00, 1, '386.jpg', 'Onion Plain Dosa', 1, 2),
(609, 'Plain Dosa Breakfast', 19, 90.00, 1, '386.jpg', 'Plain Dosa Breakfast', 1, 2),
(610, 'Poha', 19, 90.00, 1, '386.jpg', 'Poha', 1, 2),
(611, 'Vada', 19, 80.00, 1, '386.jpg', 'Vada', 1, 2),
(612, 'Idly', 19, 80.00, 1, '612_1612496330.jpg', 'Idly', 1, 2),
(628, 'Water Bottol', 7, 12.00, 1, '628.jpg', 'Water Bottol', 0, 1),
(627, 'Combo - water, coke', 2, 123.00, 1, '627.jpg', 'Combo - water, coke', 0, 1),
(629, 'Coke', 7, 30.00, 1, '629.jpg', 'Coke', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `food_email_notification`
--

CREATE TABLE `food_email_notification` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_no` varchar(255) DEFAULT NULL,
  `event` varchar(255) DEFAULT 'New Order'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_email_notification`
--

INSERT INTO `food_email_notification` (`id`, `name`, `email`, `phone_no`, `event`) VALUES
(1, 'New order collector', 'sdfds@dfgdf.ll', '8001691299', 'New Order'),
(2, 'Modified Order Informer', 'daspapun21@gmail.com', '8001691299', 'Order Modification'),
(4, 'Online Payment Collection', 'daspapun22@gmail.com', '8001691299', 'Online Paid'),
(5, 'Table Cleaner', 'daspapun22@gmail.com', '8001691299', 'Table Clean Request'),
(6, 'Biswnath Das', 'daspapun22@gmail.com', '8001691299', 'Ask for Cash Pay');

-- --------------------------------------------------------

--
-- Table structure for table `food_feedback`
--

CREATE TABLE `food_feedback` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `created` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_feedback`
--

INSERT INTO `food_feedback` (`id`, `order_id`, `rating`, `created`) VALUES
(1, 2, 4, '2020-10-29'),
(2, 3, 3, '2020-10-29'),
(3, 4, 3, '2020-10-29'),
(4, 9, 2, '2020-11-02'),
(5, 6, 0, '2020-11-02'),
(6, 10, 3, '2020-11-02'),
(7, 11, 3, '2020-11-02'),
(8, 13, 1, '2020-11-02'),
(9, 14, 3, '2020-11-05'),
(10, 15, 2, '2020-11-05'),
(11, 17, 0, '2020-11-14'),
(12, 18, 0, '2020-11-14'),
(13, 19, 0, '2020-11-15'),
(14, 8, 0, '2020-11-16'),
(15, 10, 0, '2020-11-16'),
(16, 16, 0, '2020-11-24'),
(17, 17, 5, '2020-11-25'),
(18, 1, 5, '2020-11-25'),
(19, 2, 0, '2020-11-25'),
(20, 4, 0, '2020-11-25'),
(21, 1, 0, '2020-11-25'),
(22, 1, 0, '2020-11-26'),
(23, 2, 3, '2020-11-26'),
(24, 3, 3, '2020-11-26'),
(25, 4, 0, '2020-11-26'),
(26, 5, 0, '2020-11-26'),
(27, 6, 0, '2020-11-26'),
(28, 7, 4, '2020-11-26'),
(29, 7, 0, '2020-11-26'),
(30, 9, 4, '2020-11-27'),
(31, 10, 3, '2020-11-27'),
(32, 0, 0, '2020-11-27'),
(33, 0, 0, '2020-11-27'),
(34, 11, 3, '2020-11-27'),
(35, 11, 3, '2020-11-27'),
(36, 11, 3, '2020-11-27'),
(37, 0, 0, '2020-11-27'),
(38, 11, 3, '2020-11-27'),
(39, 12, 3, '2020-11-27'),
(40, 12, 3, '2020-11-27'),
(41, 11, 0, '2020-11-27'),
(42, 13, 0, '2020-11-28'),
(43, 14, 4, '2020-11-28'),
(44, 14, 3, '2020-11-28'),
(45, 18, 0, '2020-12-01'),
(46, 23, 0, '2020-12-05'),
(47, 24, 0, '2020-12-05'),
(48, 25, 3, '2020-12-05'),
(49, 5, 5, '2020-12-09'),
(50, 1, 0, '2020-12-27'),
(51, 2, 4, '2020-12-27'),
(52, 0, 0, '2020-12-27'),
(53, 0, 0, '2020-12-27'),
(54, 3, 3, '2020-12-27');

-- --------------------------------------------------------

--
-- Table structure for table `food_inventory_add`
--

CREATE TABLE `food_inventory_add` (
  `id` int(11) NOT NULL,
  `item` int(11) DEFAULT NULL,
  `qty` float(10,2) DEFAULT NULL,
  `amount` float(9,2) DEFAULT NULL,
  `created` date DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_inventory_add`
--

INSERT INTO `food_inventory_add` (`id`, `item`, `qty`, `amount`, `created`, `status`) VALUES
(1, 1, 90.00, 9000.00, '2021-02-28', 1),
(2, 1, 20.00, 2000.00, '2021-03-01', 1),
(3, 1, 10.00, 1000.00, '2021-03-02', 1),
(4, 1, 5.00, 500.00, '2021-03-13', 1),
(8, 2, 33.00, 1000.00, '2021-03-13', 1),
(7, 2, 23.00, 1000.00, '2021-03-13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `food_inventory_items`
--

CREATE TABLE `food_inventory_items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `avarage_price` float(9,4) DEFAULT NULL,
  `ready_to_serve` int(11) NOT NULL DEFAULT 0,
  `status` int(11) DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_inventory_items`
--

INSERT INTO `food_inventory_items` (`id`, `name`, `unit`, `avarage_price`, `ready_to_serve`, `status`) VALUES
(1, 'Chicken', '1', 100.0000, 0, 1),
(2, 'Motton', '1', 35.7143, 0, 1),
(3, 'Fish', '1', 7.8400, 0, 1),
(4, 'new 1', '1', 9.2500, 0, 1),
(5, 'new 2', '1', 185.3300, 0, 1),
(6, 'new 3', '1', 10.2000, 0, 1),
(7, 'new 4', '1', 9.3300, 0, 1),
(8, 'new 5', '1', 0.3700, 0, 1),
(9, 'new 6', '1', 0.0000, 0, 1),
(10, 'gth', '1', 0.0000, 1, 1),
(11, 'nhy8', '1', 0.2800, 1, 1),
(12, 'Water Bottol', '6', 10.0000, 1, 1),
(13, 'Coke', '2', 0.0000, 1, 1),
(14, 'test 1', '1', 14.4800, 0, 1),
(15, 'chicken nugget', '1', 38.0300, 0, 1),
(16, 'chicken XZE', '1', 288.0000, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `food_inventory_remove`
--

CREATE TABLE `food_inventory_remove` (
  `id` int(11) NOT NULL,
  `item` int(11) DEFAULT NULL,
  `qty` float(10,2) DEFAULT NULL,
  `remark` longtext DEFAULT NULL,
  `created` date DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_inventory_remove`
--

INSERT INTO `food_inventory_remove` (`id`, `item`, `qty`, `remark`, `created`, `status`) VALUES
(1, 1, 10.00, 'dsfds', '2021-03-01', 1),
(2, 1, 5.00, '', '2021-03-02', 1),
(3, 1, 5.00, '', '2021-03-08', 1),
(4, 2, 2.00, '1111', '2021-03-13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `food_invoice_info`
--

CREATE TABLE `food_invoice_info` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `pin` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `contact_no` varchar(255) DEFAULT NULL,
  `GST` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_invoice_info`
--

INSERT INTO `food_invoice_info` (`id`, `name`, `address`, `city`, `state`, `pin`, `country`, `contact_no`, `GST`, `status`) VALUES
(1, 'Scoop', 'AD lane', 'Kokata', 'West Bengal', '700003', 'India', '8001691299', '1AF775858HJA9000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `food_menu_item_addones`
--

CREATE TABLE `food_menu_item_addones` (
  `id` int(11) NOT NULL,
  `food_item_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `amount` float(6,2) NOT NULL DEFAULT 0.00
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_menu_item_addones`
--

INSERT INTO `food_menu_item_addones` (`id`, `food_item_id`, `name`, `amount`) VALUES
(1, 8, 'gss', 5665.00),
(2, 8, 'sfgs', 636.00),
(3, 8, 'sdgsd', 525.00),
(30, 74, 'dsgsd', 77.00),
(28, 74, 'green tea', 5.00),
(29, 74, 'ghdgf', 66.00),
(38, 197, 'CHEESE', 10.00),
(37, 196, 'EXTRA CHEESE', 10.00);

-- --------------------------------------------------------

--
-- Table structure for table `food_menu_type`
--

CREATE TABLE `food_menu_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_menu_type`
--

INSERT INTO `food_menu_type` (`id`, `name`) VALUES
(1, 'OFFLINE'),
(2, 'ONLINE');

-- --------------------------------------------------------

--
-- Table structure for table `food_order`
--

CREATE TABLE `food_order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `process_session` longtext DEFAULT NULL,
  `bypass_session` int(11) DEFAULT 0,
  `table_no` varchar(255) DEFAULT NULL,
  `cooking_instruction` longtext DEFAULT NULL,
  `sub_total` float(9,3) DEFAULT NULL,
  `total_charges` float(9,3) DEFAULT NULL,
  `indivisual_discount` float(9,3) NOT NULL DEFAULT 0.000,
  `indivisual_discount_percent` float(9,3) DEFAULT 0.000,
  `packing_charges` float(9,3) DEFAULT 0.000,
  `total` float(9,3) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `done` int(11) DEFAULT 0,
  `payment_status` int(11) DEFAULT 0,
  `payment_method` int(11) DEFAULT NULL,
  `txn_id` varchar(255) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `process` varchar(255) DEFAULT 'Order Received',
  `order_data` longtext DEFAULT NULL,
  `token` longtext DEFAULT NULL,
  `order_type` int(11) DEFAULT 1,
  `orddr_note` varchar(255) DEFAULT NULL,
  `is_bill_printed` int(11) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_order`
--

INSERT INTO `food_order` (`id`, `user_id`, `process_session`, `bypass_session`, `table_no`, `cooking_instruction`, `sub_total`, `total_charges`, `indivisual_discount`, `indivisual_discount_percent`, `packing_charges`, `total`, `date`, `time`, `done`, `payment_status`, `payment_method`, `txn_id`, `rating`, `process`, `order_data`, `token`, `order_type`, `orddr_note`, `is_bill_printed`) VALUES
(3, 0, '', 0, '', '', 220.000, 11.000, 0.000, NULL, 0.000, 231.000, '2021-02-09', '10:15:33', 1, 0, 1, '', 0, 'Order Received', '', '', 2, '', 0),
(4, 0, '', 0, 'Parcel-4', '', 220.000, 11.000, 0.000, NULL, 0.000, 231.000, '2021-02-10', '10:17:11', 1, 0, 1, '', 0, 'Order Received', '', '', 1, '', 0),
(9, 0, '', 0, '5', '', 150.000, 14.520, 4.800, 3.200, 0.000, 159.720, '2021-02-10', '14:44:05', 1, 0, 1, '', 0, 'Order Received', '', '', 1, '', 0),
(8, 0, '', 0, '16', '', 1575.000, 78.750, 0.000, NULL, 0.000, 1653.750, '2021-02-11', '00:04:10', 1, 0, 3, '', 0, 'Order Received', '', '', 1, '', 0),
(10, 0, '', 0, '16', '', 400.000, 36.000, 40.000, 10.000, 0.000, 396.000, '2021-02-11', '14:47:26', 1, 0, 3, '', 0, 'Order Received', '', '', 1, 'sweegy - 123', 0),
(12, NULL, NULL, 0, '', NULL, 700.000, 35.000, 0.000, NULL, 0.000, 735.000, '2021-02-13', '14:22:32', 1, 0, 6, NULL, NULL, 'Order Received', NULL, NULL, 2, 'swiggy 1356', 0),
(14, NULL, NULL, 0, '', NULL, 205.000, 18.450, 20.500, 10.000, 0.000, 202.950, '2021-02-08', '15:31:15', 1, 0, 7, NULL, NULL, 'Order Received', NULL, NULL, 2, NULL, 0),
(15, NULL, NULL, 0, '14', NULL, 400.000, 0.000, 400.000, 100.000, 10.000, 10.000, '2021-02-14', '16:46:01', 1, 0, 1, NULL, NULL, 'Order Received', NULL, NULL, 1, 'asdgasdg', 0),
(16, NULL, NULL, 0, '', NULL, 1200.000, 120.000, 0.000, 0.000, 0.000, 1320.000, '2021-02-14', '18:43:42', 1, 0, 3, NULL, NULL, 'Order Received', NULL, NULL, 2, NULL, 0),
(18, NULL, NULL, 0, 'Parcel-21', NULL, 875.000, 87.500, 0.000, 0.000, 0.000, 962.500, '2021-02-14', '18:49:37', 1, 0, 1, NULL, NULL, 'Order Received', NULL, NULL, 1, 'dfhdfh', 0),
(27, NULL, NULL, 0, '', NULL, 2300.000, 230.000, 0.000, 0.000, 0.000, 2530.000, '2021-02-16', '21:09:13', 1, 0, 1, NULL, NULL, 'Order Received', NULL, NULL, 2, 'fdhdfh', 0),
(23, NULL, NULL, 0, '', NULL, 100.000, 10.000, 0.000, 0.000, 0.000, 110.000, '2021-02-15', '23:25:18', 1, 0, 3, NULL, NULL, 'Order Received', NULL, NULL, 2, 'dfhdf', 0),
(24, NULL, NULL, 0, '', NULL, 1880.000, 188.000, 0.000, 0.000, 0.000, 2068.000, '2021-02-15', '23:25:40', 1, 0, 1, NULL, NULL, 'Order Received', NULL, NULL, 2, NULL, 0),
(28, NULL, NULL, 0, '', NULL, 1040.000, 104.000, 0.000, 0.000, 0.000, 1144.000, '2021-02-17', '12:08:56', 1, 0, 1, NULL, NULL, 'Order Received', NULL, NULL, 2, NULL, 0),
(38, NULL, NULL, 0, '15', NULL, 450.000, 20.250, 45.000, 10.000, 10.000, 435.000, '2021-03-02', '08:10:47', 1, 0, 6, NULL, NULL, 'Order Received', NULL, NULL, 1, '', 0),
(29, NULL, NULL, 0, '1', NULL, 200.000, 18.000, 19.980, 9.990, 0.000, 198.020, '2021-02-19', '11:28:50', 1, 0, 7, NULL, NULL, 'Order Received', NULL, NULL, 1, NULL, 0),
(30, NULL, NULL, 0, '5', NULL, 520.000, 41.600, 104.000, 20.000, 12.000, 469.600, '2021-02-19', '15:56:40', 1, 0, 1, NULL, NULL, 'Order Received', NULL, NULL, 1, 'Zoma-4556kkk', 0),
(31, NULL, NULL, 0, '2', NULL, 310.000, 27.900, 31.000, 10.000, 10.000, 316.900, '2021-02-21', '10:18:46', 1, 0, 2, NULL, NULL, 'Order Received', NULL, NULL, 1, 'Zoma-3456', 0),
(32, NULL, NULL, 0, '3', NULL, 245.000, 22.050, 24.500, 10.000, 10.000, 252.550, '2021-02-21', '10:25:01', 1, 0, 2, NULL, NULL, 'Order Received', NULL, NULL, 1, 'sweeg-9876', 0),
(33, NULL, NULL, 0, '3', NULL, 140.000, 6.300, 14.000, 10.000, 0.000, 132.300, '2021-02-26', '16:01:19', 1, 0, 1, NULL, NULL, 'Order Received', NULL, NULL, 1, 'swee', 0),
(34, NULL, NULL, 0, '9', NULL, 440.000, 19.360, 52.800, 12.000, 0.000, 406.560, '2021-02-26', '20:47:33', 1, 0, 1, NULL, NULL, 'Order Received', NULL, NULL, 1, 'nhhhh-99990', 0),
(35, NULL, NULL, 0, '10', NULL, 480.000, 48.000, 0.000, 0.000, 0.000, 528.000, '2021-02-27', '12:26:26', 1, 0, 3, NULL, NULL, 'Order Received', NULL, NULL, 1, NULL, 0),
(37, NULL, NULL, 0, '', NULL, 190.000, 6.650, 57.000, 30.000, 10.000, 149.650, '2021-02-27', '15:10:04', 1, 0, 1, NULL, NULL, 'Order Received', NULL, NULL, 2, NULL, 0),
(39, NULL, NULL, 0, '3', NULL, 505.000, 22.730, 50.500, 10.000, 0.000, 477.000, '2021-03-02', '23:57:18', 1, 0, 1, NULL, NULL, 'Order Received', NULL, NULL, 1, NULL, 0),
(43, NULL, NULL, 0, '2', NULL, 246.000, 12.300, 0.000, 0.000, 0.000, 258.000, '2021-03-06', '12:01:10', 1, 0, 1, NULL, NULL, 'Order Received', NULL, NULL, 1, NULL, 0),
(41, NULL, NULL, 0, '', NULL, 100.000, 5.000, 0.000, 0.000, 0.000, 105.000, '2021-03-06', '09:44:44', 0, 0, NULL, NULL, NULL, 'Order Received', NULL, NULL, 2, NULL, 1),
(42, NULL, NULL, 0, '1', NULL, 189.000, 9.450, 0.000, 0.000, 0.000, 198.000, '2021-03-06', '11:49:13', 1, 0, 1, NULL, NULL, 'Order Received', NULL, NULL, 1, NULL, 0),
(44, NULL, NULL, 0, '8', NULL, 12.000, 0.600, 0.000, 0.000, 0.000, 13.000, '2021-03-06', '14:22:56', 1, 0, 1, NULL, NULL, 'Order Received', NULL, NULL, 1, NULL, 0),
(45, NULL, NULL, 0, '1', NULL, 12.000, 0.600, 0.000, 0.000, 0.000, 13.000, '2021-03-06', '15:28:28', 1, 0, 1, NULL, NULL, 'Order Received', NULL, NULL, 1, NULL, 0),
(46, NULL, NULL, 0, '4', NULL, 12.000, 0.600, 0.000, 0.000, 0.000, 13.000, '2021-03-06', '15:29:29', 1, 0, 1, NULL, NULL, 'Order Received', NULL, NULL, 1, NULL, 0),
(47, NULL, NULL, 0, '11', NULL, 100.000, 4.400, 12.000, 12.000, 0.000, 92.000, '2021-03-06', '18:25:10', 0, 0, NULL, NULL, NULL, 'Order Received', NULL, NULL, 1, NULL, 0),
(48, NULL, NULL, 0, '5', NULL, 390.000, 19.500, 0.000, 0.000, 0.000, 410.000, '2021-03-10', '08:05:15', 1, 0, 1, NULL, NULL, 'Order Received', NULL, NULL, 1, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `food_order_charges`
--

CREATE TABLE `food_order_charges` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `amount` float(6,2) DEFAULT NULL,
  `charge_or_discount` int(11) DEFAULT NULL COMMENT '0= add, 1=discount',
  `created` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_order_charges`
--

INSERT INTO `food_order_charges` (`id`, `order_id`, `name`, `amount`, `charge_or_discount`, `created`) VALUES
(1, 4, 'SGST', 5.50, 0, '2021-02-10'),
(2, 4, 'CGST', 5.50, 0, '2021-02-10'),
(3, 3, 'SGST', 5.50, 0, '2021-02-10'),
(4, 3, 'CGST', 5.50, 0, '2021-02-10'),
(5, 8, 'SGST', 39.38, 0, '2021-02-11'),
(6, 8, 'CGST', 39.38, 0, '2021-02-11'),
(7, 12, 'SGST', 17.50, 0, '2021-02-13'),
(8, 12, 'CGST', 17.50, 0, '2021-02-13'),
(9, 14, 'CGST', 18.45, 0, '2021-02-14'),
(10, 16, 'CGST', 120.00, 0, '2021-02-14'),
(11, 10, 'CGST', 36.00, 0, '2021-02-14'),
(12, 15, 'CGST', 0.00, 0, '2021-02-14'),
(13, 18, 'CGST', 87.50, 0, '2021-02-14'),
(14, 23, 'CGST', 10.00, 0, '2021-02-15'),
(15, 24, 'CGST', 188.00, 0, '2021-02-15'),
(16, 27, 'CGST', 230.00, 0, '2021-02-16'),
(17, 28, 'CGST', 104.00, 0, '2021-02-17'),
(18, 29, 'CGST', 18.00, 0, '2021-02-19'),
(19, 9, 'CGST', 14.52, 0, '2021-02-19'),
(20, 31, 'CGST', 27.90, 0, '2021-02-21'),
(21, 30, 'CGST', 41.60, 0, '2021-02-21'),
(22, 32, 'CGST', 22.05, 0, '2021-02-21'),
(23, 35, 'CGST', 48.00, 0, '2021-02-27'),
(24, 37, 'CGST', 6.65, 0, '2021-03-02'),
(25, 33, 'CGST', 6.30, 0, '2021-03-02'),
(26, 34, 'CGST', 19.36, 0, '2021-03-02'),
(27, 38, 'CGST', 20.25, 0, '2021-03-02'),
(28, 39, 'CGST', 22.73, 0, '2021-03-06'),
(29, 40, 'CGST', 27.50, 0, '2021-03-06'),
(30, 42, 'CGST', 9.45, 0, '2021-03-06'),
(31, 43, 'CGST', 12.30, 0, '2021-03-06'),
(32, 44, 'CGST', 0.60, 0, '2021-03-06'),
(33, 45, 'CGST', 0.60, 0, '2021-03-06'),
(34, 46, 'CGST', 0.60, 0, '2021-03-06'),
(35, 48, 'CGST', 19.50, 0, '2021-03-10');

-- --------------------------------------------------------

--
-- Table structure for table `food_order_item`
--

CREATE TABLE `food_order_item` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `item_category_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `qnt` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `table_no` int(11) DEFAULT NULL,
  `addOnesAmout` float(6,2) DEFAULT NULL,
  `totalItemPrice` float(6,2) DEFAULT NULL,
  `cooking_instruction` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_order_item`
--

INSERT INTO `food_order_item` (`id`, `order_id`, `item_category_id`, `item_id`, `qnt`, `date`, `time`, `table_no`, `addOnesAmout`, `totalItemPrice`, `cooking_instruction`) VALUES
(32, 18, 6, 222, 3, '2021-02-14', '02:19:53', 0, 0.00, 100.00, NULL),
(30, 9, 1, 1, 3, '2021-02-14', '01:36:39', 0, 0.00, 50.00, NULL),
(33, 18, 3, 81, 5, '2021-02-14', '02:20:03', 0, 0.00, 115.00, NULL),
(4, 3, 15, 511, 2, '2021-02-10', '05:45:46', 0, 0.00, 110.00, NULL),
(5, 4, 1, 4, 2, '2021-02-10', '05:47:18', 0, 0.00, 65.00, NULL),
(6, 4, 4, 114, 1, '2021-02-10', '05:47:27', 0, 0.00, 90.00, NULL),
(31, 16, 14, 417, 12, '2021-02-14', '02:13:57', 0, 0.00, 100.00, NULL),
(61, 38, 1, 24, 1, '2021-03-02', '03:40:58', 0, 0.00, 120.00, 'no onnoin, no cheese'),
(11, 8, 1, 25, 9, '2021-02-10', '07:36:02', 0, 0.00, 175.00, NULL),
(12, 10, 6, 222, 4, '2021-02-11', '12:15:55', 0, 0.00, 285.00, NULL),
(60, 38, 6, 222, 2, '2021-03-02', '03:40:54', 0, 0.00, 100.00, 'tht gthth'),
(15, 12, 16, 528, 1, '2021-02-13', '09:54:36', 0, 0.00, 130.00, NULL),
(16, 12, 14, 417, 2, '2021-02-13', '09:55:21', 0, 0.00, 285.00, NULL),
(24, 14, 14, 417, 1, '2021-02-14', '11:02:06', 0, 0.00, 100.00, NULL),
(25, 14, 10, 316, 1, '2021-02-14', '12:09:28', 0, 0.00, 105.00, NULL),
(28, 15, 6, 222, 4, '2021-02-14', '12:25:21', 0, 0.00, 100.00, NULL),
(40, 27, 14, 417, 23, '2021-02-16', '04:39:26', 0, 0.00, 100.00, NULL),
(35, 23, 14, 417, 1, '2021-02-15', '06:55:34', 0, 0.00, 100.00, NULL),
(36, 24, 10, 313, 6, '2021-02-15', '06:55:48', 0, 0.00, 150.00, NULL),
(37, 24, 10, 290, 7, '2021-02-15', '06:55:53', 0, 0.00, 140.00, NULL),
(42, 28, 16, 526, 4, '2021-02-17', '07:39:05', 0, 0.00, 160.00, NULL),
(41, 28, 14, 417, 4, '2021-02-17', '07:39:01', 0, 0.00, 100.00, NULL),
(43, 29, 6, 222, 2, '2021-02-19', '06:59:06', 0, 0.00, 100.00, NULL),
(44, 30, 6, 222, 1, '2021-02-19', '11:26:51', 0, 0.00, 100.00, NULL),
(45, 30, 1, 12, 3, '2021-02-20', '06:11:43', 0, 0.00, 140.00, NULL),
(46, 31, 1, 9, 2, '2021-02-21', '05:49:29', 0, 0.00, 105.00, NULL),
(49, 32, 1, 9, 1, '2021-02-21', '05:55:32', 0, 0.00, 105.00, NULL),
(48, 31, 6, 222, 1, '2021-02-21', '05:49:45', 0, 0.00, 100.00, NULL),
(50, 32, 6, 196, 1, '2021-02-21', '05:55:40', 0, 0.00, 140.00, NULL),
(52, 33, 9, 272, 1, '2021-02-26', '12:01:15', 0, 0.00, 140.00, NULL),
(53, 34, 6, 222, 2, '2021-02-26', '04:17:39', 0, 0.00, 100.00, NULL),
(56, 34, 6, 222, 1, '2021-02-26', '05:40:04', 0, 0.00, 100.00, NULL),
(55, 34, 6, 196, 1, '2021-02-26', '05:24:01', 0, 0.00, 140.00, NULL),
(57, 35, 6, 222, 2, '2021-02-27', '07:56:54', 0, 0.00, 100.00, NULL),
(58, 35, 3, 88, 2, '2021-02-27', '07:57:39', 0, 0.00, 140.00, NULL),
(59, 37, 14, 403, 1, '2021-02-27', '10:40:14', 0, 0.00, 190.00, NULL),
(62, 38, 1, 4, 2, '2021-03-02', '06:38:02', 0, 0.00, 65.00, 'eter fdhdfh'),
(76, 43, 2, 627, 2, '2021-03-06', '07:31:42', 0, 0.00, 123.00, NULL),
(65, 39, 6, 222, 1, '2021-03-03', '11:37:18', 0, 0.00, 100.00, 'no onnion'),
(66, 39, 1, 12, 2, '2021-03-03', '11:37:23', 0, 0.00, 140.00, 'dfhdfh'),
(67, 39, 7, 269, 1, '2021-03-04', '07:25:26', 0, 0.00, 125.00, 'fghfghfghfg'),
(69, 41, 14, 417, 1, '2021-03-06', '05:15:26', 0, 0.00, 100.00, NULL),
(75, 42, 7, 628, 3, '2021-03-06', '07:19:34', 0, 0.00, 12.00, NULL),
(74, 42, 7, 629, 1, '2021-03-06', '07:19:29', 0, 0.00, 30.00, NULL),
(73, 42, 2, 627, 1, '2021-03-06', '07:19:21', 0, 0.00, 123.00, NULL),
(77, 44, 7, 628, 1, '2021-03-06', '09:53:05', 0, 0.00, 12.00, NULL),
(78, 45, 7, 628, 1, '2021-03-06', '10:58:34', 0, 0.00, 12.00, NULL),
(79, 46, 7, 628, 1, '2021-03-06', '10:59:39', 0, 0.00, 12.00, NULL),
(80, 47, 6, 222, 1, '2021-03-09', '06:03:47', 0, 0.00, 100.00, NULL),
(81, 48, 6, 222, 1, '2021-03-10', '03:35:35', 0, 0.00, 100.00, NULL),
(82, 48, 1, 14, 1, '2021-03-10', '03:35:40', 0, 0.00, 115.00, NULL),
(83, 48, 1, 25, 1, '2021-03-10', '03:35:44', 0, 0.00, 175.00, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `food_order_item_addones`
--

CREATE TABLE `food_order_item_addones` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `order_item_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `add_ones_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `food_scan_report`
--

CREATE TABLE `food_scan_report` (
  `id` int(11) NOT NULL,
  `table_no` varchar(255) NOT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `token` longtext DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_scan_report`
--

INSERT INTO `food_scan_report` (`id`, `table_no`, `ip`, `date`, `time`, `token`, `status`) VALUES
(2, '15', '45.250.244.179', 'December 26, 2020, 6:35 pm', '1508987919', '', 0),
(3, '15', '45.250.244.179', 'December 26, 2020, 6:39 pm', '1508988156', '', 0),
(4, '17', '45.250.244.179', 'December 27, 2020, 8:33 am', '1509038215', '', 0),
(5, '20', '45.250.244.179', 'December 27, 2020, 8:33 am', '1509938215', '', 0),
(6, '20', '45.250.244.179', 'December 27, 2020, 4:33 pm', '1609066990', '', 0),
(7, '15', '45.250.244.179', 'December 26, 2020, 6:35 pm', '1507987901', '', 0),
(8, '15', '45.250.244.179', 'December 26, 2020, 6:35 pm', '1508987919', '', 0),
(9, '15', '45.250.244.179', 'December 26, 2020, 6:39 pm', '1508988156', '', 0),
(10, '17', '45.250.244.179', 'December 27, 2020, 8:33 am', '1509038215', '', 0),
(11, '15', '45.250.244.179', 'December 26, 2020, 6:39 pm', '1508988156', '', 0),
(12, '17', '45.250.244.179', 'December 27, 2020, 8:33 am', '1509038215', '', 0),
(13, '15', '45.250.244.179', 'December 26, 2020, 6:39 pm', '1508988156', '', 0),
(14, '17', '45.250.244.179', 'December 27, 2020, 8:33 am', '1509038215', '', 0),
(15, '15', '45.250.244.179', 'December 26, 2020, 6:39 pm', '1508988156', '', 0),
(16, '17', '45.250.244.179', 'December 27, 2020, 8:33 am', '1509038215', '', 0),
(17, '20', '45.250.244.179', 'December 27, 2020, 8:33 am', '1509938215', '', 0),
(18, '20', '45.250.244.179', 'December 27, 2020, 4:33 pm', '1609066990', '', 0),
(19, '20', '45.250.244.179', 'December 27, 2020, 8:33 am', '1509938215', '', 0),
(20, '20', '45.250.244.179', 'December 27, 2020, 4:33 pm', '1609066990', '', 0),
(21, '20', '45.250.244.179', 'December 27, 2020, 8:33 am', '1509938215', '', 0),
(22, '20', '45.250.244.179', 'December 27, 2020, 4:33 pm', '1609066990', '', 0),
(23, '20', '45.250.244.179', 'December 27, 2020, 8:33 am', '1509938215', '', 0),
(24, '20', '45.250.244.179', 'December 27, 2020, 4:33 pm', '1609066990', '', 0),
(25, '20', '45.250.244.179', 'December 27, 2020, 8:33 am', '1509938215', '', 0),
(26, '20', '45.250.244.179', 'December 27, 2020, 8:33 am', '1509938215', '', 0),
(27, '20', '45.250.244.179', 'December 27, 2020, 8:33 am', '1509938215', '', 0),
(28, '20', '45.250.244.179', 'December 27, 2020, 8:33 am', '1509938215', '', 0),
(29, '20', '45.250.244.179', 'December 27, 2020, 4:33 pm', '1609066990', '', 0),
(30, '20', '45.250.244.179', 'December 27, 2020, 8:33 am', '1509938215', '', 0),
(31, '20', '45.250.244.179', 'December 27, 2020, 4:33 pm', '1609066990', '', 0),
(32, '20', '45.250.244.179', 'December 27, 2020, 4:33 pm', '1609066990', '', 0),
(33, '20', '45.250.244.179', 'December 27, 2020, 4:33 pm', '1609066990', '', 0),
(34, '20', '45.250.244.179', 'December 27, 2020, 8:33 am', '1509938215', '', 0),
(35, '20', '45.250.244.179', 'December 27, 2020, 4:33 pm', '1609066990', '', 0),
(36, '20', '45.250.244.179', 'December 27, 2020, 4:33 pm', '1609066990', '', 0),
(37, '20', '45.250.244.179', 'December 27, 2020, 4:33 pm', '1609066990', '', 0),
(38, '20', '45.250.244.179', 'December 27, 2020, 4:33 pm', '1609066990', '', 0),
(39, '20', '45.250.244.179', 'December 27, 2020, 4:33 pm', '1609066990', '', 0),
(40, '20', '45.250.244.179', 'December 27, 2020, 4:33 pm', '1609066990', '', 0),
(41, '20', '45.250.244.179', 'December 27, 2020, 4:33 pm', '1609066990', '', 0),
(42, '20', '45.250.244.179', 'December 27, 2020, 4:33 pm', '1609066990', '', 0),
(43, '20', '45.250.244.179', 'December 27, 2020, 4:33 pm', '1609066990', '', 0),
(44, '20', '45.250.244.179', 'December 27, 2020, 4:33 pm', '1609066990', '', 0),
(45, '20', '45.250.244.179', 'December 27, 2020, 4:33 pm', '1609066990', '', 0),
(46, '20', '45.250.244.179', 'December 27, 2020, 4:33 pm', '1609066990', '', 0),
(47, '20', '45.250.244.179', 'December 27, 2020, 4:33 pm', '1609066990', '', 0),
(48, '20', '45.250.244.179', 'December 27, 2020, 4:33 pm', '1609066990', '', 0),
(49, '20', '45.250.244.179', 'December 27, 2020, 4:33 pm', '1609066990', '', 0),
(50, '20', '45.250.244.179', 'December 27, 2020, 4:33 pm', '1609066990', '', 0),
(51, '20', '45.250.244.179', 'December 27, 2020, 4:33 pm', '1609066990', '', 0),
(52, '20', '45.250.244.179', 'December 27, 2020, 4:33 pm', '1609066990', '', 0),
(53, '20', '45.250.244.179', 'December 27, 2020, 5:02 pm', '1609068749', '', 0),
(54, '20', '45.250.244.179', 'December 27, 2020, 5:02 pm', '1609068765', '', 0),
(55, '2', '45.250.244.179', 'December 27, 2020, 5:37 pm', '1609070871', '', 0),
(56, '1', '45.250.244.179', 'December 27, 2020, 5:46 pm', '1609071390', '', 0),
(57, '1', '45.250.244.179', 'December 27, 2020, 6:05 pm', '1609072553', '', 0),
(58, '2', '45.250.244.179', 'December 27, 2020, 6:12 pm', '1609072951', '', 0),
(59, '1', '45.250.244.179', 'December 27, 2020, 6:15 pm', '1609073129', '', 0),
(60, '14', '45.250.244.179', 'December 27, 2020, 8:01 pm', '1609079477', '', 0),
(61, '15', '45.250.244.179', 'December 27, 2020, 8:01 pm', '1609079487', '', 0),
(62, '2', '45.250.244.179', 'December 27, 2020, 8:26 pm', '1609080976', '', 0),
(63, '15', '45.250.244.179', 'December 27, 2020, 8:43 pm', '1609082015', '', 0),
(64, '14', '45.250.244.179', 'December 27, 2020, 9:07 pm', '1609083439', '', 0),
(65, '15', '45.250.244.179', 'December 27, 2020, 9:15 pm', '1609083956', '', 0),
(66, '2', '45.250.244.179', 'December 27, 2020, 9:16 pm', '1609084007', '', 0),
(67, '5', '45.250.244.179', 'December 27, 2020, 9:20 pm', '1609084230', '', 0),
(68, '2', '45.250.244.179', 'December 27, 2020, 9:22 pm', '1609084345', '', 0),
(69, '2', '45.250.244.179', 'December 27, 2020, 9:23 pm', '1609084381', '', 0),
(70, '2', '45.250.244.179', 'December 27, 2020, 9:23 pm', '1609084390', '', 0),
(71, '3', '45.250.244.179', 'December 27, 2020, 9:24 pm', '1609084481', '', 0),
(72, '9', '45.250.244.179', 'December 27, 2020, 9:25 pm', '1609084507', '', 0),
(73, '20', '45.250.244.179', 'December 27, 2020, 9:31 pm', '1609084876', '', 0),
(74, '15', '45.250.244.179', 'December 27, 2020, 9:31 pm', '1609084899', '', 0),
(75, '15', '45.250.244.179', 'December 27, 2020, 9:34 pm', '1609085080', '', 0),
(76, '15', '45.250.244.179', 'December 27, 2020, 9:46 pm', '1609085789', '', 0),
(77, '2', '45.250.244.179', 'December 27, 2020, 10:06 pm', '1609087000', '', 0),
(78, '8', '45.250.244.179', 'December 27, 2020, 10:23 pm', '1609088034', '', 0),
(79, '2', '45.250.244.179', 'December 27, 2020, 11:06 pm', '1609090593', '', 0),
(80, '2', '45.250.244.179', 'December 27, 2020, 11:07 pm', '1609090656', '', 0),
(81, '21', '45.250.244.179', 'December 28, 2020, 8:38 am', '1609124895', '', 0),
(82, '9', '45.250.244.179', 'December 28, 2020, 9:40 am', '1609128615', '', 0),
(83, '16', '45.250.244.179', 'December 28, 2020, 4:38 pm', '1609153703', '', 0),
(84, '10', '45.250.244.179', 'December 28, 2020, 5:16 pm', '1609155964', '', 0),
(85, '17', '45.250.244.179', 'December 28, 2020, 5:17 pm', '1609156028', '', 0),
(86, '10', '157.43.199.28', 'December 28, 2020, 8:33 pm', '1609167795', '', 0),
(87, '10', '45.250.244.179', 'December 28, 2020, 8:41 pm', '1609168280', '', 0),
(88, '15', '45.250.244.179', 'December 28, 2020, 8:46 pm', '1609168599', 'b3273ad22c153e455b57715d76ec72b1', 0),
(89, '22', '45.250.244.179', 'December 28, 2020, 9:04 pm', '1609169674', '4aead58c176141ee8b18b15ddb87818e', 0),
(90, '10', '45.250.244.179', 'January 3, 2021, 8:46 am', '1609643777', 'c6ef2d40e8afe36d3dac1df77fb15abc', 0),
(91, '13', '45.250.244.179', 'January 3, 2021, 9:27 am', '1609646245', '72ba76bc9f8ce03cb3eb1698aa9952c9', 0),
(92, '2', '45.250.244.179', 'January 3, 2021, 9:34 am', '1609646652', '', 0),
(93, '3', '45.250.244.179', 'January 3, 2021, 9:40 am', '1609647013', '', 0),
(94, '16', '45.250.244.194', 'January 3, 2021, 3:49 pm', '1609669180', 'ade28c3159b45aa707e29c3b8e564619', 0),
(95, '23', '45.250.244.194', 'January 3, 2021, 3:50 pm', '1609669224', '946c8d94990128645339a96afea25189', 0),
(96, '23', '45.250.244.194', 'January 3, 2021, 3:51 pm', '1609669267', '0a16f4cb0bbfa5d1bdd63eba6a06719e', 0),
(97, '23', '45.250.244.194', 'January 3, 2021, 4:00 pm', '1609669802', '', 0),
(98, '19', '45.250.244.194', 'January 3, 2021, 5:53 pm', '1609676636', '', 0),
(132, '18', '45.250.244.194', 'January 7, 2021, 8:35 am', '1609988723', '', 0),
(100, '8', '45.250.244.194', 'January 3, 2021, 8:02 pm', '1609684362', '', 0),
(101, '17', '45.250.244.194', 'January 3, 2021, 8:04 pm', '1609684492', '', 0),
(102, '22', '45.250.244.194', 'January 3, 2021, 8:07 pm', '1609684643', '', 0),
(103, '15', '45.250.244.194', 'January 4, 2021, 7:53 am', '1609727016', '', 0),
(116, 'Parcel-16', '45.250.244.194', 'January 4, 2021, 9:45 pm', '1609776916', '', 0),
(120, '19', '45.250.244.194', 'January 6, 2021, 8:37 am', '1609902453', '', 0),
(129, '7', '45.250.244.194', 'January 6, 2021, 11:00 pm', '1609954220', '', 0),
(106, 'Parcel-10', '45.250.244.194', 'January 4, 2021, 8:13 am', '1609728222', '', 0),
(149, '10', '45.250.244.179', 'January 20, 2021, 6:04 pm', '1611146084', '', 0),
(134, '16', '45.250.244.194', 'January 8, 2021, 8:56 am', '1610076403', '', 0),
(121, '22', '45.250.244.194', 'January 6, 2021, 8:46 am', '1609903015', '', 0),
(133, '21', '45.250.244.194', 'January 8, 2021, 8:44 am', '1610075660', '', 0),
(165, '1', '45.250.244.64', 'January 27, 2021, 11:06 pm', '1611769015', '', 0),
(148, '21', '45.250.244.154', 'January 13, 2021, 4:43 pm', '1610536388', '', 0),
(185, '7', '115.96.114.86', 'January 28, 2021, 11:03 pm', '1611855198', '', 0),
(144, '21', '45.250.244.86', 'January 10, 2021, 10:44 am', '1610255659', '', 0),
(180, '22', '115.96.114.86', 'January 28, 2021, 6:45 pm', '1611839721', '', 0),
(176, '8', '115.96.114.86', 'January 28, 2021, 6:11 pm', '1611837715', '', 0),
(192, '14', '::1', 'February 6, 2021, 5:19 pm', '1612612153', '', 0),
(166, '16', '45.250.244.64', 'January 27, 2021, 11:27 pm', '1611770244', '', 0),
(182, '1', '115.96.114.86', 'January 28, 2021, 7:05 pm', '1611840954', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `food_settings`
--

CREATE TABLE `food_settings` (
  `id` int(11) NOT NULL,
  `send_sms_notifications` int(11) NOT NULL DEFAULT 1,
  `send_email_notifications` int(11) NOT NULL DEFAULT 1,
  `connect_ip` longtext DEFAULT NULL,
  `order_type` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_settings`
--

INSERT INTO `food_settings` (`id`, `send_sms_notifications`, `send_email_notifications`, `connect_ip`, `order_type`) VALUES
(1, 0, 1, 'http://192.168.0.108:3100/OflineResturent', 'Online');

-- --------------------------------------------------------

--
-- Table structure for table `food_table`
--

CREATE TABLE `food_table` (
  `id` int(11) NOT NULL,
  `total_no_of_table` int(11) DEFAULT NULL,
  `total_working_no_of_table` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_table`
--

INSERT INTO `food_table` (`id`, `total_no_of_table`, `total_working_no_of_table`) VALUES
(1, 30, 30);

-- --------------------------------------------------------

--
-- Table structure for table `food_tax_charges`
--

CREATE TABLE `food_tax_charges` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `amount` float(6,2) DEFAULT NULL,
  `type` int(11) DEFAULT 0 COMMENT '0= %, 1= fixed',
  `charge_or_discount` int(11) DEFAULT 0 COMMENT '0= add, 1= discount',
  `status` int(11) DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_tax_charges`
--

INSERT INTO `food_tax_charges` (`id`, `name`, `amount`, `type`, `charge_or_discount`, `status`) VALUES
(35, 'CGST', 5.00, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `miscellaneous_expance`
--

CREATE TABLE `miscellaneous_expance` (
  `id` int(11) NOT NULL,
  `amount` float(10,2) DEFAULT NULL,
  `Remark` varchar(255) DEFAULT NULL,
  `created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `miscellaneous_expance`
--

INSERT INTO `miscellaneous_expance` (`id`, `amount`, `Remark`, `created`) VALUES
(1, 100.00, 'fdhfd', '2021-03-06');

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `status`) VALUES
(1, 'Debit Card', 1),
(2, 'Cash Payment', 1),
(3, 'Credit Card', 1),
(6, 'swiggy', 1),
(7, 'phpnepe', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ready_to_serve_item`
--

CREATE TABLE `ready_to_serve_item` (
  `id` int(11) NOT NULL,
  `food_inventory_item_id` int(11) DEFAULT NULL,
  `food_demo_id` int(11) DEFAULT NULL,
  `qty_issue_per_order` bigint(20) NOT NULL,
  `created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ready_to_serve_item`
--

INSERT INTO `ready_to_serve_item` (`id`, `food_inventory_item_id`, `food_demo_id`, `qty_issue_per_order`, `created`) VALUES
(1, 12, 628, 2, '2021-03-06');

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
(23, 15, 'Miscellaneous Expance', 'miscellaneous_expance', '<span class=\"glyphicon glyphicon-usd\" style=\"color:#00F260 !important;\"></span>', '1,2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `slider_settings`
--

CREATE TABLE `slider_settings` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `body` longtext DEFAULT NULL,
  `img` longtext DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider_settings`
--

INSERT INTO `slider_settings` (`id`, `title`, `body`, `img`, `status`) VALUES
(1, 'Morning Collection', 'Start your morning with best food', '1.jpg', 1),
(2, 'Decoration You Love', 'Make dinner-date, Candle- light  dinner with your love ones', '2.jpg', 1),
(3, 'Best Food - Best Life', 'We deliver best food in the town', '3.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `test` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `test`) VALUES
(1, 'ffgsdfg'),
(2, 'ffgsdfg');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `unit_name` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `unit_name`, `remark`) VALUES
(1, 'Kg', ''),
(2, 'Gm', ''),
(3, 'Litter', ''),
(5, 'Bottle', ''),
(6, 'tin', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `number` varchar(100) DEFAULT NULL,
  `name` varchar(10000) DEFAULT NULL,
  `admin` varchar(100) DEFAULT '0',
  `access_code` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `number`, `name`, `admin`, `access_code`) VALUES
(1, 'superadmin', 'a4f0a041c1fc548034f5892e8cbc90ac', '35346', 'superadmin', '1', 1234),
(2, 'accountant', '1674243c685acb385af47bf75b75ea26', '634634', 'accountant', '0', NULL),
(3, 'customer', 'e75e4ee5e20fce5eaca8e8b2cce22795', '5645645', 'dfg', '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `view_notification`
--

CREATE TABLE `view_notification` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `notification` longtext DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee_attendance`
--
ALTER TABLE `employee_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_data`
--
ALTER TABLE `employee_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_salary`
--
ALTER TABLE `employee_salary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_admin_push_notification`
--
ALTER TABLE `food_admin_push_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_category`
--
ALTER TABLE `food_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_customers`
--
ALTER TABLE `food_customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_id` (`order_id`);

--
-- Indexes for table `food_demo`
--
ALTER TABLE `food_demo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_email_notification`
--
ALTER TABLE `food_email_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_feedback`
--
ALTER TABLE `food_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_inventory_add`
--
ALTER TABLE `food_inventory_add`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_inventory_items`
--
ALTER TABLE `food_inventory_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `food_inventory_remove`
--
ALTER TABLE `food_inventory_remove`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_invoice_info`
--
ALTER TABLE `food_invoice_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_menu_item_addones`
--
ALTER TABLE `food_menu_item_addones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_menu_type`
--
ALTER TABLE `food_menu_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_order`
--
ALTER TABLE `food_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_order_charges`
--
ALTER TABLE `food_order_charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_order_item`
--
ALTER TABLE `food_order_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_order_item_addones`
--
ALTER TABLE `food_order_item_addones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_scan_report`
--
ALTER TABLE `food_scan_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_settings`
--
ALTER TABLE `food_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_table`
--
ALTER TABLE `food_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_tax_charges`
--
ALTER TABLE `food_tax_charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `miscellaneous_expance`
--
ALTER TABLE `miscellaneous_expance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ready_to_serve_item`
--
ALTER TABLE `ready_to_serve_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sidebar_menu`
--
ALTER TABLE `sidebar_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider_settings`
--
ALTER TABLE `slider_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `view_notification`
--
ALTER TABLE `view_notification`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee_attendance`
--
ALTER TABLE `employee_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employee_data`
--
ALTER TABLE `employee_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee_salary`
--
ALTER TABLE `employee_salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food_admin_push_notification`
--
ALTER TABLE `food_admin_push_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food_category`
--
ALTER TABLE `food_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `food_customers`
--
ALTER TABLE `food_customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `food_demo`
--
ALTER TABLE `food_demo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=630;

--
-- AUTO_INCREMENT for table `food_email_notification`
--
ALTER TABLE `food_email_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `food_feedback`
--
ALTER TABLE `food_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `food_inventory_add`
--
ALTER TABLE `food_inventory_add`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `food_inventory_items`
--
ALTER TABLE `food_inventory_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `food_inventory_remove`
--
ALTER TABLE `food_inventory_remove`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `food_invoice_info`
--
ALTER TABLE `food_invoice_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `food_menu_item_addones`
--
ALTER TABLE `food_menu_item_addones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `food_menu_type`
--
ALTER TABLE `food_menu_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `food_order`
--
ALTER TABLE `food_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `food_order_charges`
--
ALTER TABLE `food_order_charges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `food_order_item`
--
ALTER TABLE `food_order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `food_order_item_addones`
--
ALTER TABLE `food_order_item_addones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food_scan_report`
--
ALTER TABLE `food_scan_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT for table `food_settings`
--
ALTER TABLE `food_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `food_table`
--
ALTER TABLE `food_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `food_tax_charges`
--
ALTER TABLE `food_tax_charges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `miscellaneous_expance`
--
ALTER TABLE `miscellaneous_expance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ready_to_serve_item`
--
ALTER TABLE `ready_to_serve_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sidebar_menu`
--
ALTER TABLE `sidebar_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `slider_settings`
--
ALTER TABLE `slider_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `view_notification`
--
ALTER TABLE `view_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
