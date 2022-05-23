-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2022 at 01:27 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cicas`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `secret_key` varchar(500) DEFAULT NULL,
  `publishable_key` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `secret_key`, `publishable_key`, `created_at`, `updated_at`) VALUES
(3, 'admin', NULL, NULL, '2021-07-03 02:38:00', '2021-07-03 02:38:00');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `is_requested` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `date`, `time`, `is_requested`, `patient_id`, `doctor_id`, `created_at`, `updated_at`, `status`) VALUES
(30, '07/29/2021', '19:40', 0, 25, 48, '2021-07-05 02:37:13', '2021-07-05 02:37:13', 1),
(31, '01/01/1970', '19:41', 0, 25, 47, '2021-07-05 02:39:19', '2021-07-05 02:39:19', 1),
(32, '17/09/2021', '21:47', 0, 27, 47, '2021-09-16 14:44:52', '2021-09-16 14:44:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `beds`
--

CREATE TABLE `beds` (
  `bed_number` int(11) NOT NULL,
  `bed_type` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `beds`
--

INSERT INTO `beds` (`bed_number`, `bed_type`, `created_at`, `updated_at`, `status`) VALUES
(5, 'ICU', '2021-07-03 03:38:45', '2021-07-03 03:38:45', 1),
(6, 'Operation Ward', '2021-07-03 03:38:45', '2021-07-03 03:38:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bed_allotments`
--

CREATE TABLE `bed_allotments` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL DEFAULT 0,
  `nurse_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `bed_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `allotment_time` varchar(255) NOT NULL,
  `discharge_time` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `send_by` varchar(255) NOT NULL,
  `recieved_by` varchar(255) NOT NULL,
  `msg` longtext NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `patient_id`, `doctor_id`, `send_by`, `recieved_by`, `msg`, `status`, `created_at`, `updated_at`) VALUES
(48, 25, 47, 'patient', 'doctor', 'Hi', 1, '2021-07-05 02:04:35', '2021-07-05 02:04:35'),
(49, 25, 47, 'patient', 'doctor', 'How are you?', 1, '2021-07-05 02:05:21', '2021-07-05 02:05:21'),
(50, 25, 47, 'doctor', 'patient', 'I am fine', 1, '2021-07-05 02:05:43', '2021-07-05 02:05:43'),
(51, 25, 47, 'doctor', 'patient', 'What about my reports?', 1, '2021-07-05 02:05:57', '2021-07-05 02:05:57'),
(52, 25, 47, 'patient', 'doctor', 'Hi', 1, '2021-07-06 02:43:23', '2021-07-06 02:43:23'),
(53, 25, 47, 'patient', 'doctor', 'How are you?', 1, '2021-07-06 02:43:35', '2021-07-06 02:43:35'),
(54, 25, 47, 'doctor', 'patient', 'I am fine', 1, '2021-07-06 02:44:08', '2021-07-06 02:44:08'),
(55, 25, 47, 'patient', 'doctor', 'What about my diagnosis??', 1, '2021-07-06 02:45:27', '2021-07-06 02:45:27'),
(56, 30, 47, 'doctor', 'patient', 'Hi\n', 1, '2021-10-11 05:50:19', '2021-10-11 05:50:19'),
(57, 30, 47, 'patient', 'doctor', 'Hello', 1, '2021-10-11 05:52:03', '2021-10-11 05:52:03'),
(58, 25, 48, 'doctor', 'patient', 'Hi', 1, '2021-10-13 06:34:12', '2021-10-13 06:34:12'),
(59, 29, 47, 'patient', 'doctor', 'Hi', 1, '2021-10-13 09:18:32', '2021-10-13 09:18:32'),
(60, 29, 47, 'doctor', 'patient', 'How are you??', 1, '2021-10-13 09:19:37', '2021-10-13 09:19:37'),
(61, 29, 47, 'patient', 'doctor', 'I am fine', 1, '2021-10-13 09:19:49', '2021-10-13 09:19:49'),
(62, 29, 47, 'doctor', 'patient', 'Wow', 1, '2022-01-06 07:02:42', '2022-01-06 07:02:42'),
(63, 25, 48, 'patient', 'doctor', 'Hi\n', 1, '2022-01-06 07:13:33', '2022-01-06 07:13:33'),
(64, 25, 48, 'patient', 'doctor', 'I am...', 1, '2022-01-06 07:14:01', '2022-01-06 07:14:01'),
(65, 25, 48, 'doctor', 'patient', 'JJJ', 1, '2022-01-06 07:14:18', '2022-01-06 07:14:18'),
(66, 25, 48, 'doctor', 'patient', 'HHH', 1, '2022-01-06 07:14:30', '2022-01-06 07:14:30'),
(67, 25, 48, 'doctor', 'patient', 'What is your name', 1, '2022-01-06 07:14:45', '2022-01-06 07:14:45'),
(68, 25, 47, 'doctor', 'patient', 'How are You?\n', 1, '2022-02-24 05:51:09', '2022-02-24 05:51:09'),
(69, 25, 47, 'doctor', 'patient', 'Where are you from?', 1, '2022-04-28 07:32:17', '2022-04-28 07:32:17'),
(70, 25, 47, 'patient', 'doctor', 'I am from Punjab Province Punjab', 1, '2022-04-28 07:34:13', '2022-04-28 07:34:13'),
(71, 25, 47, 'patient', 'doctor', 'And where are you from?', 1, '2022-04-28 07:34:24', '2022-04-28 07:34:24'),
(72, 25, 47, 'patient', 'doctor', 'dhajhsgdsjhgdj', 1, '2022-04-28 07:34:31', '2022-04-28 07:34:31'),
(73, 25, 47, 'doctor', 'patient', 'WHat??', 1, '2022-04-28 07:34:54', '2022-04-28 07:34:54'),
(74, 25, 47, 'patient', 'doctor', 'Sorry', 1, '2022-04-28 07:35:01', '2022-04-28 07:35:01'),
(75, 25, 47, 'patient', 'doctor', 'dgsjhdfgj', 1, '2022-04-28 07:35:23', '2022-04-28 07:35:23');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `icon`, `description`, `created_at`, `updated_at`, `status`) VALUES
(14, 'Cardiology Department', 'http://localhost/Clinic-Automation-system/assets/uploads/departments/brain1.png', 'Cardiology Department Description', '2021-07-03 03:36:05', '2021-07-03 03:36:05', 1),
(15, 'Heart Department', 'http://localhost/Clinic-Automation-system/assets/uploads/departments/cardialogy.png', 'Heart Department', '2021-07-07 03:19:56', '2021-07-07 03:19:56', 1),
(16, 'Dept 4', 'http://localhost/Clinic-Automation-system/assets/uploads/departments/cart2.png', 'Dept', '2021-09-16 14:40:02', '2021-09-16 14:40:02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `department_facilities`
--

CREATE TABLE `department_facilities` (
  `id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department_facilities`
--

INSERT INTO `department_facilities` (`id`, `department_id`, `title`, `description`, `status`, `created_at`, `updated_at`) VALUES
(26, 15, 'Heart Faciltiy 1', 'Heart Faciltiy 1 Description', 1, '2021-07-07 03:20:23', '2021-07-07 03:20:23'),
(27, 15, 'Heart Faciltiy 2', 'Heart Faciltiy 2 Description', 1, '2021-07-07 03:20:35', '2021-07-07 03:20:35'),
(28, 16, 'Wifi ', 'wifi', 1, '2021-09-16 14:40:42', '2021-09-16 14:40:42');

-- --------------------------------------------------------

--
-- Table structure for table `diagnosis_reports`
--

CREATE TABLE `diagnosis_reports` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL DEFAULT 0,
  `laboratorist_id` int(11) NOT NULL DEFAULT 0,
  `patient_id` int(11) NOT NULL,
  `time` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `report_type` varchar(255) NOT NULL,
  `report_file` varchar(255) NOT NULL,
  `report_file_type` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `diagnosis_reports`
--

INSERT INTO `diagnosis_reports` (`id`, `doctor_id`, `laboratorist_id`, `patient_id`, `time`, `date`, `report_type`, `report_file`, `report_file_type`, `description`, `status`, `created_at`, `updated_at`) VALUES
(32, 0, 7, 25, '21:49', '21/07/2021', 'xray', 'http://localhost/Clinic-Automation-system/assets/uploads/diagnosisreports/brain3.png', 'image', '<p><em><strong>kkkk</strong></em></p>', 1, '2021-07-03 04:48:16', '2021-07-03 04:48:16'),
(33, -1, 0, 25, '21:52', '07/21/2021', 'blood_test', 'http://localhost/Clinic-Automation-system/assets/uploads/diagnosisreports/stomach.png', 'image', '<p>djfhsdfhdjksfhskdfh</p>', 1, '2021-07-03 04:49:40', '2021-07-03 04:49:40');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `unhash_password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `department_id` int(11) NOT NULL,
  `profile` longtext NOT NULL,
  `fb_link` varchar(255) DEFAULT NULL,
  `twitter_link` varchar(255) DEFAULT NULL,
  `googleplus_link` varchar(255) DEFAULT NULL,
  `Linkedin_link` varchar(255) DEFAULT NULL,
  `icon` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `unhash_password`, `address`, `phone`, `department_id`, `profile`, `fb_link`, `twitter_link`, `googleplus_link`, `Linkedin_link`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(47, 'Michel Pawd', 'michel', 'khushab street no 3', '032521212', 14, '\r\n                        \r\n                        dfjdhsfhskd\r\n                    \r\n                    ', '', '', '', '', 'http://localhost/Clinic-Automation-system/assets/uploads/doctors/IMG_20210222_103048_534.jpg', 1, '2021-07-03 05:09:26', '2021-07-03 05:09:26'),
(48, 'Waheed', 'waheed', 'khushab street no 3', '03124543742', 14, 'kjgfhjdkghdfjkhgkdj', '', '', '', '', 'http://localhost/Clinic-Automation-system/assets/uploads/doctors/a21.jpg', 1, '2021-07-05 01:56:38', '2021-07-05 01:56:38'),
(49, 'ali', 'aliali', 'khushab street no 3', '032463764', 15, '\r\n                        Ali Doctor Profile\r\n                    ', '', '', '', '', 'http://localhost/Clinic-Automation-system/assets/uploads/doctors/young-doctor-160888253.jpg', 1, '2021-07-07 03:22:42', '2021-07-07 03:22:42'),
(50, 'Awais', 'awais', 'Peshawar', '03125678384', 15, 'Awais Doctor Profile', '', '', '', '', 'http://localhost/Clinic-Automation-system/assets/uploads/doctors/download_(4).jpg', 1, '2021-07-07 04:49:33', '2021-07-07 04:49:33'),
(51, 'Iqbal Hussain', 'iqbal', 'Sargodha', '0312454537', 14, 'Iqbal Doctor Profile', '', '', '', '', 'http://localhost/Clinic-Automation-system/assets/uploads/doctors/download1.jpg', 1, '2021-07-07 04:50:48', '2021-07-07 04:50:48');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `title` varchar(255) NOT NULL,
  `start` varchar(255) NOT NULL,
  `end` varchar(255) DEFAULT NULL,
  `backgroundColor` varchar(255) NOT NULL DEFAULT '#28a745',
  `borderColor` varchar(255) DEFAULT NULL,
  `allDay` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `laboratorists`
--

CREATE TABLE `laboratorists` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `unhash_password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laboratorists`
--

INSERT INTO `laboratorists` (`id`, `name`, `unhash_password`, `address`, `phone`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(7, 'Aslam', 'aslam', 'khushab street no 3', '023153523', 'http://localhost/Clinic-Automation-system/assets/uploads/laboratorists/depositphotos_33044395-stock-photo-doctor-smiling.jpg', 1, '2021-07-03 04:47:32', '2021-07-03 04:47:32');

-- --------------------------------------------------------

--
-- Table structure for table `lab_blood_donors`
--

CREATE TABLE `lab_blood_donors` (
  `id` int(11) NOT NULL,
  `donor_name` varchar(255) NOT NULL,
  `donor_email` varchar(255) NOT NULL,
  `donor_address` varchar(255) NOT NULL,
  `donor_phone` varchar(22) NOT NULL,
  `donor_age` int(11) NOT NULL,
  `donor_gender` varchar(255) NOT NULL,
  `donor_blood_group` varchar(255) NOT NULL,
  `last_donation_date` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lab_blood_donors`
--

INSERT INTO `lab_blood_donors` (`id`, `donor_name`, `donor_email`, `donor_address`, `donor_phone`, `donor_age`, `donor_gender`, `donor_blood_group`, `last_donation_date`, `created_at`, `updated_at`) VALUES
(11, 'ALi', 'ali@gmail.com', 'lahore', '03122784386', 22, 'male', 'B-', '2021-07-21', '2021-07-04 03:53:29', '2021-07-04 03:53:29'),
(12, 'Aliza', 'aliza@gmail.com', 'Sgd', '02342732434', 12, 'female', 'O+', '2021-07-22', '2021-07-04 03:55:06', '2021-07-04 03:55:06');

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `price` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `sold_qty` int(11) NOT NULL DEFAULT 0,
  `company` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`id`, `name`, `category_id`, `description`, `price`, `qty`, `sold_qty`, `company`, `status`, `created_at`, `updated_at`) VALUES
(6, 'Gastrick', 14, 'Gastrick Sirup', '200', 5, 5, 'Masood Pharmacy', 1, '2021-07-07 00:50:23', '2021-07-07 00:50:23'),
(7, 'Damina', 14, 'Damina', '250', 2, 3, 'Dr Reckweg', 1, '2021-07-07 00:51:15', '2021-07-07 00:51:15'),
(8, 'Acefyl', 13, 'Acefyl', '100', 20, 0, 'Acefyl', 1, '2021-07-07 05:02:55', '2021-07-07 05:02:55'),
(9, 'Stoma', 13, 'Stoma Description', '170', 9, 1, 'Stommo', 1, '2021-07-07 05:03:32', '2021-07-07 05:03:32'),
(10, 'Disprin', 13, 'Disprin', '500', 10, 0, 'Disprin', 1, '2021-07-07 05:04:01', '2021-07-07 05:04:01'),
(11, 'Agnus Castus Q', 14, 'Agnus Catus', '160', 7, 0, 'Masood Pharmacy', 1, '2021-07-07 05:09:39', '2021-07-07 05:09:39');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_category`
--

CREATE TABLE `medicine_category` (
  `id` int(11) NOT NULL,
  `medicine_category_name` varchar(255) NOT NULL,
  `medicine_category_description` tinytext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicine_category`
--

INSERT INTO `medicine_category` (`id`, `medicine_category_name`, `medicine_category_description`, `created_at`, `updated_at`, `status`) VALUES
(13, 'Stomach', 'Stoamach Category Medicine', '2021-07-07 00:49:21', '2021-07-07 00:49:21', 1),
(14, 'Health', 'Health Description', '2021-07-07 05:08:50', '2021-07-07 05:08:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nurses`
--

CREATE TABLE `nurses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `unhash_password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nurses`
--

INSERT INTO `nurses` (`id`, `name`, `unhash_password`, `address`, `phone`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(13, 'shenaz', 'shenaz', 'khushab street no 3', '0314215251', 'http://localhost/Clinic-Automation-system/assets/uploads/nurses/images2.jpg', 1, '2021-07-03 05:07:07', '2021-07-03 05:07:07');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_detail_id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_detail_id`, `medicine_id`, `qty`, `created_at`, `updated_at`) VALUES
(41, 23, 6, 2, '2021-07-07 00:53:12', '2021-07-07 00:53:12'),
(42, 23, 7, 3, '2021-07-07 00:53:12', '2021-07-07 00:53:12'),
(43, 24, 6, 1, '2021-07-07 01:23:09', '2021-07-07 01:23:09'),
(45, 26, 9, 2, '2022-01-10 06:03:10', '2022-01-10 06:03:10'),
(46, 27, 9, 1, '2022-04-28 07:37:42', '2022-04-28 07:37:42');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `shipping_address` varchar(500) NOT NULL,
  `company` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` int(10) NOT NULL,
  `payment_method` varchar(255) NOT NULL DEFAULT 'stripe',
  `payment_status` int(11) NOT NULL DEFAULT 0,
  `delivery_status` int(11) NOT NULL DEFAULT 0,
  `patient_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `cash_on_delivery` int(11) NOT NULL DEFAULT 0,
  `pay_with_card` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `phone`, `name`, `email`, `shipping_address`, `company`, `city`, `state`, `zip`, `payment_method`, `payment_status`, `delivery_status`, `patient_id`, `status`, `cash_on_delivery`, `pay_with_card`, `created_at`, `updated_at`) VALUES
(23, '', '', '', 'khushab street no 3', 'IT vision', 'khushab', 'khushab', 4000, 'stripe', 1, 1, 25, 1, 0, 1, '2021-07-07 00:53:12', '2021-07-07 00:53:12'),
(24, '', '', '', 'khushab street no 3', 'IT vision', 'khushab', 'khushab', 4000, '', 1, 1, 26, 1, 1, 0, '2021-07-07 01:23:09', '2021-07-07 01:23:09'),
(26, '033580917322', 'Hassan Ali Hussnain', 'freelancerahtesham@gmail.com', 'khushab street no 3', 'IT vision', 'khushab', 'khushab', 4000, 'stripe', 0, 0, 26, 1, 0, 0, '2022-01-10 06:03:10', '2022-01-10 06:03:10'),
(27, '03001100226', '', 'maestros.official@gmail.com', 'DHA Lahore', 'IT vision', 'Lahore', 'khushab', 54000, '', 0, 0, 25, 1, 1, 0, '2022-04-28 07:37:42', '2022-04-28 07:37:42');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `unhash_password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `birth_date` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `blood_group` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `name`, `unhash_password`, `address`, `phone`, `birth_date`, `age`, `gender`, `blood_group`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(25, 'Tanzila Wahab', 'tanzila', 'khushab street no 3', '023653764537', '29/11/1998', 23, 'female', 'A-', 'http://localhost/Clinic-Automation-system/assets/uploads/patients/a64.jpg', 1, '2021-07-03 04:01:21', '2021-07-03 04:01:21'),
(26, 'Samina', 'samina', 'Lahore', '0321626644', '05/06/2009', 11, 'female', 'B+', 'http://localhost/Clinic-Automation-system/assets/uploads/patients/a8.jpg', 1, '2021-07-07 01:14:10', '2021-07-07 01:14:10'),
(27, 'Qalsoom Nawaz', 'qalsoom', 'Muzaffarabad', '03358091756', '22/06/1995', 30, 'female', 'A-', 'http://localhost/Clinic-Automation-system/assets/uploads/patients/download_(6).jpg', 1, '2021-07-07 04:54:23', '2021-07-07 04:54:23'),
(28, 'Sheeren', 'sheeren', 'Lahore', '033584574758', '06/07/2014', 12, 'female', 'O+', 'http://localhost/Clinic-Automation-system/assets/uploads/patients/download_(7).jpg', 1, '2021-07-07 04:55:42', '2021-07-07 04:55:42'),
(29, 'Uzma Khalid', 'uzma', 'Faislabad', '03458377456', '24/10/2013', 10, 'female', 'AB+', 'http://localhost/Clinic-Automation-system/assets/uploads/patients/shutterstock_5091527921.jpg', 1, '2021-07-07 04:57:06', '2021-07-07 04:57:06'),
(30, 'Iftikhar Shah', 'iftikhar', 'khushab street no 3', '03123724788', '17/05/2012', 14, 'male', 'B+', 'http://localhost/Clinic-Automation-system/assets/uploads/patients/a1.jpg', 1, '2021-07-07 06:31:44', '2021-07-07 06:31:44'),
(31, 'Asad', 'asad@email.com', 'DHA Lahore', '03001100226', '05/18/2022', 14, 'male', 'AB+', 'http://localhost/Clinic-Automation-system/assets/uploads/patients/Ahtesham1.jpg', 1, '2022-05-23 11:23:00', '2022-05-23 11:23:00');

-- --------------------------------------------------------

--
-- Table structure for table `patient_nurses`
--

CREATE TABLE `patient_nurses` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `nurse_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient_nurses`
--

INSERT INTO `patient_nurses` (`id`, `doctor_id`, `created_at`, `nurse_id`, `patient_id`, `date`, `time`, `updated_at`) VALUES
(18, 47, '2021-07-05 03:05:49', 13, 25, '04/07/2021', '22:07', '2021-07-05 03:05:49'),
(19, 47, '2022-04-28 07:36:03', 13, 25, '05/04/2022', '15:36', '2022-04-28 07:36:03');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacists`
--

CREATE TABLE `pharmacists` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `unhash_password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pharmacists`
--

INSERT INTO `pharmacists` (`id`, `name`, `unhash_password`, `address`, `phone`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(10, 'shezad', 'shezad', 'khushab street no 3', '03457822692', 'http://localhost/Clinic-Automation-system/assets/uploads/pharmacists/download3.jpg', 1, '2021-07-05 02:51:37', '2021-07-05 02:51:37');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `case_history` longtext NOT NULL,
  `meditation` longtext NOT NULL,
  `note` longtext NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `patient_id`, `doctor_id`, `date`, `time`, `case_history`, `meditation`, `note`, `status`, `created_at`, `updated_at`) VALUES
(16, 25, -1, '07/07/2021', '21:52', 'dfkjsdjkfhsdjkhfk', 'sdjhdfjkhfdjks', 'sdjfhsdjkf', 1, '2021-07-03 04:49:15', '2021-07-03 04:49:15'),
(17, 25, 47, '23/07/2021', '22:13', '                                    djkfsdhfkjshd                                            ', '                                    dsjkfhdjkghdfjkhg                                                                                         ', '                                fhgdfjkghfkdhgk                                                                               ', 1, '2021-07-04 02:13:22', '2021-07-04 02:13:22');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `stars` double NOT NULL DEFAULT 0,
  `review` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `patient_id`, `doctor_id`, `stars`, `review`, `created_at`, `updated_at`) VALUES
(36, 25, 47, 2.53, 'Very Good Doctor!', '2021-07-05 02:06:29', '2021-07-05 02:06:29'),
(37, 25, 48, 4, 'Amazing Doctor!', '2021-07-07 00:04:03', '2021-07-07 00:04:03'),
(38, 27, 48, 3, 'Good Doctor', '2021-07-07 04:58:27', '2021-07-07 04:58:27'),
(39, 27, 49, 3.88, 'Good Doctor\n', '2022-01-06 07:09:54', '2022-01-06 07:09:54'),
(40, 25, 50, 2.78, NULL, '2022-04-28 07:37:10', '2022-04-28 07:37:10');

-- --------------------------------------------------------

--
-- Table structure for table `receptionists`
--

CREATE TABLE `receptionists` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `unhash_password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `receptionists`
--

INSERT INTO `receptionists` (`id`, `name`, `unhash_password`, `address`, `phone`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(6, 'Riaz', 'riaz', 'khushab street no 3', '032553634378', 'http://localhost/Clinic-Automation-system/assets/uploads/receptionists/a2.jpg', 1, '2021-07-03 14:34:56', '2021-07-03 14:34:56');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `report_file_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `doctor_id`, `patient_id`, `type`, `date`, `description`, `report_file_path`, `created_at`, `updated_at`, `status`) VALUES
(11, -1, 25, 'operation_report', '22/07/2021', 'djfhdjfhsdjkhfk', 'http://localhost/Clinic-Automation-system/assets/uploads/reports/stomach.png', '2021-07-03 04:52:13', '2021-07-03 04:52:13', 1),
(12, 47, 25, 'birth_report', '04/07/2021', 'Tanzila Birth Report', 'http://localhost/Clinic-Automation-system/assets/uploads/reports/stomach1.png', '2021-07-05 01:59:08', '2021-07-05 01:59:08', 1),
(13, 48, 25, 'death_report', '04/07/2021', 'Death Report', 'http://localhost/Clinic-Automation-system/assets/uploads/reports/adapter.PNG', '2021-07-05 02:01:12', '2021-07-05 02:01:12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `system_name` varchar(255) NOT NULL,
  `system_title` varchar(255) NOT NULL,
  `system_address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `system_currency` varchar(255) NOT NULL,
  `system_email` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `standard_shipping_fee` int(11) NOT NULL DEFAULT 200,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `system_name`, `system_title`, `system_address`, `phone`, `system_currency`, `system_email`, `image_path`, `standard_shipping_fee`, `created_at`, `updated_at`) VALUES
(1, 'Clinic Automation System', 'Clinic Automation System', 'khushab street no 3 Pakistan', '03120881044', 'PKR', 'freelancerahtesham@gmail.com', 'http://localhost/Clinic-Automation-system/assets/uploads/system/MyLogo3.png', 200, '2021-07-03 02:49:29', '2021-07-03 02:49:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `online_status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `type`, `profile_id`, `online_status`, `created_at`, `updated_at`) VALUES
(56, 'admin@gmail.com', '$2y$10$N3r8l3.7gGze/3Mur719kOV8BdzSPNlC2/COBUwttC4X/T64Bxw9W', 'admin', 3, 0, '2021-07-03 02:38:00', '2021-07-03 02:38:00'),
(66, 'tanzila@gmail.com', '$2y$10$lnTKAR1zu3vBysW3f1Oxre7Nr0baUJOZPq0FsPKRm5p8lq3lldjY2', 'patient', 25, 0, '2021-07-03 04:01:21', '2021-07-03 04:01:21'),
(70, 'aslam@gmail.com', '$2y$10$hBeThKifYb.HrGzrM7dQe.Gtt1U9//0u52Mq2npD6B9z.8PnRUl..', 'laboratorist', 7, 0, '2021-07-03 04:47:33', '2021-07-03 04:47:33'),
(71, 'shenaz@gmail.com', '$2y$10$ZhF18yEY2XzGmxNeUOGRe.5nP/sw5hAUA5kRzAKoyemC04xNOvEa2', 'nurse', 13, 0, '2021-07-03 05:07:07', '2021-07-03 05:07:07'),
(72, 'michel@gmail.com', '$2y$10$G/9e8PXG02LZeiw3cQ7mieeqJT7.ClQr31WJIzX8Y1vX0Rgm1puOK', 'doctor', 47, 0, '2021-07-03 05:09:26', '2021-07-03 05:09:26'),
(73, 'riaz@gmail.com', '$2y$10$QbIPJ7qgVydwE6GIVYg3hebSdrr8Mswz1Qptn5jpOSNpK21GK70OW', 'receptionist', 6, 0, '2021-07-03 14:34:57', '2021-07-03 14:34:57'),
(74, 'waheed@gmail.com', '$2y$10$BiQVadsBkSMRy7qhIR/BWO5OJrlmHRQnTwVmK8HZ7.DbE4n1z/Jom', 'doctor', 48, 0, '2021-07-05 01:56:38', '2021-07-05 01:56:38'),
(75, 'shezad@gmail.com', '$2y$10$dMaobKyiuk6Y3YPIKNxF9erg9jkkKnSn.jOT605foNQJmesx94/jC', 'pharmacist', 10, 0, '2021-07-05 02:51:37', '2021-07-05 02:51:37'),
(76, 'samina@gmail.com', '$2y$10$666x2.cbvi4cRxIuSod82ORdm6pKkG0C2Yf7YotD8qxLjJS5GD1ya', 'patient', 26, 0, '2021-07-07 01:14:10', '2021-07-07 01:14:10'),
(77, 'ali568@gmail.com', '$2y$10$VotMNAfa1AQgoUxt9PglUulqazuFm/8mW7LGN859TkckxmswAmhs.', 'doctor', 49, 0, '2021-07-07 03:22:42', '2021-07-07 03:22:42'),
(78, 'awais@gmail.com', '$2y$10$CG7wYCwbUY/DdCljrn2iU.4Fx41e2D5vfEifDD5GhC99udzipYmw2', 'doctor', 50, 0, '2021-07-07 04:49:33', '2021-07-07 04:49:33'),
(79, 'iqbal444@gmail.com', '$2y$10$RaQYWd3U91bXy0hTDXPw6edRVsUbv77SX7qkJxFYbgEmk9ETwi1g2', 'doctor', 51, 0, '2021-07-07 04:50:49', '2021-07-07 04:50:49'),
(80, 'qalsoom23@gmail.com', '$2y$10$iNqk/lP4.f4Ks1wjPmEs0.H0Rqt5PTz2uJQxNate0BclC1aEulCZm', 'patient', 27, 0, '2021-07-07 04:54:23', '2021-07-07 04:54:23'),
(81, 'sheeren@gmail.com', '$2y$10$9zwQnVtQV8ndgN.Ko06mpOQ.FfDgu3w.gEWuu15lNqa.uLlk11kz2', 'patient', 28, 0, '2021-07-07 04:55:42', '2021-07-07 04:55:42'),
(82, 'uzma@gmail.com', '$2y$10$q0V/R3RCt1e.hIybGY3b9u4vc58rY79VsAVMVJi2Gy/x9w6UUz8Zm', 'patient', 29, 0, '2021-07-07 04:57:06', '2021-07-07 04:57:06'),
(83, 'iftikhar1212@gmail.com', '$2y$10$osYBkMP6TrtLw6oRje2NGulxUQ.dRzN8zgVSeV3sFHl/l0gxJblee', 'patient', 30, 0, '2021-07-07 06:31:44', '2021-07-07 06:31:44'),
(84, 'asad@email.com', '$2y$10$d9wgk7Dx9dO2J0kqS1SLnOsmiXYlNBAC4rTTbIJZIFvAwIwTbmOUa', 'patient', 31, 0, '2022-05-23 11:23:00', '2022-05-23 11:23:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `beds`
--
ALTER TABLE `beds`
  ADD PRIMARY KEY (`bed_number`);

--
-- Indexes for table `bed_allotments`
--
ALTER TABLE `bed_allotments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `bed_id` (`bed_id`),
  ADD KEY `nurse_id` (`nurse_id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_facilities`
--
ALTER TABLE `department_facilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `diagnosis_reports`
--
ALTER TABLE `diagnosis_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laboratorists`
--
ALTER TABLE `laboratorists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_blood_donors`
--
ALTER TABLE `lab_blood_donors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `medicine_category`
--
ALTER TABLE `medicine_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nurses`
--
ALTER TABLE `nurses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_detail_id` (`order_detail_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_nurses`
--
ALTER TABLE `patient_nurses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `patient_nurses_ibfk_3` (`nurse_id`);

--
-- Indexes for table `pharmacists`
--
ALTER TABLE `pharmacists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `receptionists`
--
ALTER TABLE `receptionists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profile_id` (`profile_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `beds`
--
ALTER TABLE `beds`
  MODIFY `bed_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bed_allotments`
--
ALTER TABLE `bed_allotments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `department_facilities`
--
ALTER TABLE `department_facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `diagnosis_reports`
--
ALTER TABLE `diagnosis_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `laboratorists`
--
ALTER TABLE `laboratorists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `lab_blood_donors`
--
ALTER TABLE `lab_blood_donors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `medicine_category`
--
ALTER TABLE `medicine_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `nurses`
--
ALTER TABLE `nurses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `patient_nurses`
--
ALTER TABLE `patient_nurses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pharmacists`
--
ALTER TABLE `pharmacists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `receptionists`
--
ALTER TABLE `receptionists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bed_allotments`
--
ALTER TABLE `bed_allotments`
  ADD CONSTRAINT `bed_allotments_ibfk_1` FOREIGN KEY (`bed_id`) REFERENCES `beds` (`bed_number`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bed_allotments_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `chats_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chats_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `department_facilities`
--
ALTER TABLE `department_facilities`
  ADD CONSTRAINT `department_facilities_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `diagnosis_reports`
--
ALTER TABLE `diagnosis_reports`
  ADD CONSTRAINT `diagnosis_reports_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `medicines`
--
ALTER TABLE `medicines`
  ADD CONSTRAINT `medicines_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `medicine_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`order_detail_id`) REFERENCES `order_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_nurses`
--
ALTER TABLE `patient_nurses`
  ADD CONSTRAINT `patient_nurses_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_nurses_ibfk_2` FOREIGN KEY (`nurse_id`) REFERENCES `nurses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescriptions_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
