-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2019 at 10:28 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grand_feedback_sys`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `account_no` varchar(45) DEFAULT NULL,
  `is_company` int(11) DEFAULT '1',
  `password` varchar(360) DEFAULT '$2a$10$OQ3xEhwgXdtO8/ucDNUTpeAwvtuMHQ6v/.qIRX0vxUt0odFXhIrrC',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `suspended` int(11) DEFAULT '0',
  `deleted` int(11) DEFAULT '0',
  `api_key` varchar(180) DEFAULT NULL,
  `fcm_key` varchar(180) DEFAULT NULL,
  `fcm_updated_at` datetime DEFAULT NULL,
  `address` varchar(60) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `account_no`, `is_company`, `password`, `created_at`, `suspended`, `deleted`, `api_key`, `fcm_key`, `fcm_updated_at`, `address`, `phone`, `email`) VALUES
(1, 'GRAND', '10001', 1, '$2a$10$OQ3xEhwgXdtO8/ucDNUTpeAwvtuMHQ6v/.qIRX0vxUt0odFXhIrrC', '2019-09-09 11:56:36', 0, 0, '$2a$10$OQ3xEhwgXdtO8/ucDNUTpeAwvtuMHQ6v/.qIRX0vxUt0odFXhIrrC', NULL, NULL, 'Mbezi Beach', '+255788449030', 'deograciousngereza@gmail.com'),
(2, 'POA', '100002', 1, 'password', '2019-09-09 11:56:36', 0, 0, '$2a$10$OQ3xEhwgXdtO8/ucDNUTpeAwvtuMHQ6v/.qIRX0vxUt0odFXhIrrC', NULL, NULL, 'Mwenge ITV,DSM Tanzania', '+255688059688', 'grand123grand1@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `apps`
--

CREATE TABLE `apps` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `app_id` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(60) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `address` varchar(120) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `suspended` int(11) DEFAULT '0',
  `visible` int(11) DEFAULT '0',
  `img_url` varchar(180) DEFAULT NULL,
  `image_name` varchar(45) DEFAULT 'default.jpg',
  `img_src` varchar(45) DEFAULT 'LOCAL'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apps`
--

INSERT INTO `apps` (`id`, `account_id`, `app_id`, `name`, `email`, `phone`, `address`, `deleted`, `suspended`, `visible`, `img_url`, `image_name`, `img_src`) VALUES
(3, 2, 'POA001', 'ITV', 'poa-mwenge@poa.co.tz', '+255', 'ITV', 0, 0, 0, NULL, 'default.jpg', 'LOCAL'),
(4, 2, 'POA002', 'POA-MBEZI', 'MBEZI', '+255', 'MBEZI', 0, 0, 0, NULL, 'default.jpg', 'LOCAL');

-- --------------------------------------------------------

--
-- Table structure for table `apps_comments`
--

CREATE TABLE `apps_comments` (
  `id` int(11) NOT NULL,
  `comment_cat_id` int(11) DEFAULT '-1',
  `account_id` int(11) DEFAULT '-1',
  `app_id` int(11) DEFAULT '-1',
  `created_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_time` varchar(45) DEFAULT NULL,
  `star_value` int(11) DEFAULT '0',
  `share` int(11) NOT NULL DEFAULT '0',
  `phone` varchar(45) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `username` varchar(60) DEFAULT NULL,
  `comment` text,
  `ref_code` varchar(45) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apps_comments`
--

INSERT INTO `apps_comments` (`id`, `comment_cat_id`, `account_id`, `app_id`, `created_date`, `created_at`, `created_time`, `star_value`, `share`, `phone`, `email`, `username`, `comment`, `ref_code`, `deleted`, `deleted_at`) VALUES
(1, -1, 2, 3, '2019-09-09', '2019-09-09 15:24:25', '18:24:25', 0, 1, '+255', 'grand123grand1@gmail.com', 'Grand', 'Awesome service', 'gmtech', 0, NULL),
(2, -1, 2, 3, '2019-09-09', '2019-09-09 15:25:10', '18:25:10', 5, 1, '+25571182839', 'makinde@gmail.com', 'Makinde', 'Just in love with this app', 'gmtech', 0, NULL),
(3, -1, 2, 3, '2019-09-09', '2019-09-09 16:03:39', '19:03:39', 0, 1, '+255', 'grand123grand1@gmail.com', 'Grand', 'Awesome service', 'gmtech', 0, NULL),
(4, -1, 2, 3, '2019-09-09', '2019-09-09 16:34:34', '19:34:34', 4, 1, '+255', 'grand123grand1@gmail.com', 'Grand', 'Awesome service', 'gmtech', 0, NULL),
(5, -1, 2, 3, '2019-09-09', '2019-09-09 16:34:57', '19:34:57', 0, 1, '+255', 'grand123grand1@gmail.com', 'Grand', 'Awesome service', 'gmtech', 0, NULL),
(6, -1, 2, 3, '2019-09-09', '2019-09-09 16:35:41', '19:35:41', 0, 1, '+255', 'grand123grand1@gmail.com', 'Grand', 'Awesome service', 'gmtech', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `apps_comments_categories`
--

CREATE TABLE `apps_comments_categories` (
  `id` int(11) NOT NULL,
  `app_id` int(11) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account_no` (`account_no`);

--
-- Indexes for table `apps`
--
ALTER TABLE `apps`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_id` (`app_id`);

--
-- Indexes for table `apps_comments`
--
ALTER TABLE `apps_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apps_comments_categories`
--
ALTER TABLE `apps_comments_categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `apps`
--
ALTER TABLE `apps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `apps_comments`
--
ALTER TABLE `apps_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
