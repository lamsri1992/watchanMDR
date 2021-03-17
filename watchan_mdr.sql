-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2021 at 04:46 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `watchan_mdr`
--

-- --------------------------------------------------------

--
-- Table structure for table `order_drug`
--

CREATE TABLE `order_drug` (
  `drug_id` int(5) NOT NULL,
  `drug_hn` varchar(50) DEFAULT NULL,
  `drug_vn` varchar(50) DEFAULT NULL,
  `drug_patient` varchar(255) DEFAULT NULL,
  `drug_bed` varchar(50) DEFAULT NULL,
  `drug_doctor` varchar(255) DEFAULT NULL,
  `drug_status` varchar(50) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_drug_comment`
--

CREATE TABLE `order_drug_comment` (
  `dm_id` int(11) NOT NULL,
  `dm_note` text DEFAULT NULL,
  `dm_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `dm_comment` varchar(255) DEFAULT NULL,
  `drug_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tracking_list`
--

CREATE TABLE `tracking_list` (
  `list_id` int(5) NOT NULL,
  `list_vn` varchar(255) DEFAULT NULL,
  `list_hn` varchar(255) DEFAULT NULL,
  `list_discharge` text DEFAULT NULL,
  `list_doctor` varchar(255) DEFAULT NULL,
  `list_start` datetime DEFAULT NULL,
  `list_end` datetime DEFAULT NULL,
  `list_status` varchar(255) DEFAULT '1',
  `list_path` text DEFAULT NULL,
  `track_id` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tracking_order`
--

CREATE TABLE `tracking_order` (
  `track_id` int(5) NOT NULL,
  `track_case` varchar(255) DEFAULT NULL,
  `track_point` varchar(5) DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `track_editor` varchar(255) DEFAULT NULL,
  `track_status` varchar(5) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tracking_point`
--

CREATE TABLE `tracking_point` (
  `point_id` int(5) NOT NULL,
  `point_name` text DEFAULT NULL,
  `point_detail` text DEFAULT NULL,
  `point_operator` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tracking_point`
--

INSERT INTO `tracking_point` (`point_id`, `point_name`, `point_detail`, `point_operator`) VALUES
(1, 'หอผู้ป่วยใน (IPD)', 'ดำเนินการ Discharge คนไข้หอผู้ป่วยใน (IPD)', NULL),
(2, 'ห้องเภสัชกรรม', 'ตรวจสอบและพิมพ์ใบ 16 รายการ', NULL),
(3, 'กลุ่มการแพทย์', 'แพทย์เจ้าของเคสทำการตรวจสอบเวชระเบียน', NULL),
(4, 'งานเวชระเบียน', 'ตรวจสอบขั้นตอนสุดท้าย', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `track_status`
--

CREATE TABLE `track_status` (
  `t_stat_id` int(5) NOT NULL,
  `t_stat_text` text DEFAULT NULL,
  `t_stat_color` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `track_status`
--

INSERT INTO `track_status` (`t_stat_id`, `t_stat_text`, `t_stat_color`) VALUES
(1, '<i class=\"fa fa-spinner fa-spin\"></i> กำลังดำเนินการ', 'text-danger'),
(2, '<i class=\"fa fa-check-circle\"></i> เสร็จสิ้น', 'text-success');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permission` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permission_id` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `permission`, `permission_id`, `created_at`, `updated_at`) VALUES
(1, 'Admin Watchan', 'admin', 'admin@watchan', NULL, '$2y$10$L3/gV95qr3wg1YkvVB1Klenr9Uk/amrTBtkf9ad0x/f9uzjHZ/j6m', NULL, 'ผู้ดูแลระบบ', '1', '2021-03-11 08:36:41', '2021-03-12 10:36:59'),
(2, 'ห้องยา วัดจันทร์', 'pharmacy', 'phar@watchan', NULL, '$2y$10$6graNDbkjIM9F96pkkauGuh81CVM0AtgWiKW5GvEo6FhB537pjGlG', NULL, 'งานเภสัชกรรม', '2', NULL, '2021-03-16 02:33:40'),
(3, 'ผู้ป่วยใน วัดจันทร์', 'ipd', 'ipd@watchan', NULL, '$2y$10$6graNDbkjIM9F96pkkauGuh81CVM0AtgWiKW5GvEo6FhB537pjGlG', NULL, 'งานผู้ป่วยใน', '5', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order_drug`
--
ALTER TABLE `order_drug`
  ADD PRIMARY KEY (`drug_id`);

--
-- Indexes for table `order_drug_comment`
--
ALTER TABLE `order_drug_comment`
  ADD PRIMARY KEY (`dm_id`);

--
-- Indexes for table `tracking_list`
--
ALTER TABLE `tracking_list`
  ADD PRIMARY KEY (`list_id`);

--
-- Indexes for table `tracking_order`
--
ALTER TABLE `tracking_order`
  ADD PRIMARY KEY (`track_id`);

--
-- Indexes for table `tracking_point`
--
ALTER TABLE `tracking_point`
  ADD PRIMARY KEY (`point_id`);

--
-- Indexes for table `track_status`
--
ALTER TABLE `track_status`
  ADD PRIMARY KEY (`t_stat_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order_drug`
--
ALTER TABLE `order_drug`
  MODIFY `drug_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_drug_comment`
--
ALTER TABLE `order_drug_comment`
  MODIFY `dm_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tracking_list`
--
ALTER TABLE `tracking_list`
  MODIFY `list_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tracking_order`
--
ALTER TABLE `tracking_order`
  MODIFY `track_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tracking_point`
--
ALTER TABLE `tracking_point`
  MODIFY `point_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `track_status`
--
ALTER TABLE `track_status`
  MODIFY `t_stat_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
