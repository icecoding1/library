-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2023 at 08:57 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_book`
--

CREATE TABLE `tb_book` (
  `id` int(11) NOT NULL,
  `code_book` text NOT NULL,
  `b_name` text NOT NULL,
  `b_writer` text DEFAULT NULL,
  `b_category` text NOT NULL,
  `b_price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_book`
--

INSERT INTO `tb_book` (`id`, `code_book`, `b_name`, `b_writer`, `b_category`, `b_price`) VALUES
(1, 'B00001', 'คู่มือการสอยรับราชการ', 'สมศักดิ์ ตั้วใจ', 'คู่มือเตรียมสอบ', 299),
(2, 'B00002', 'เเฮรี่ พอตเตอร์', '่J.K Rowling', 'นวนิยาย', 359),
(3, 'B00003', 'เย็บปักถักร้อย', 'สะอาด อิ่มสุข', 'วิชาชีพ', 249),
(4, 'B00004', 'เจ้าชายน้อย', 'อ็องตวน เดอ เเซ็ง', 'วรรณกรรม', 355),
(5, 'B00005', 'การเขียนโปรเเกรม คอมพิวเตอร์', 'กิ่งเเก้ว กลิ่นหอม', 'เทคโนโลยี', 329);

-- --------------------------------------------------------

--
-- Table structure for table `tb_borrow_book`
--

CREATE TABLE `tb_borrow_book` (
  `id` int(11) NOT NULL,
  `br_date_br` date NOT NULL DEFAULT current_timestamp(),
  `br_date_tr` date NOT NULL,
  `b_code` text NOT NULL,
  `m_user` text NOT NULL,
  `br_fine` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_borrow_book`
--

INSERT INTO `tb_borrow_book` (`id`, `br_date_br`, `br_date_tr`, `b_code`, `m_user`, `br_fine`, `status`) VALUES
(2, '2023-02-08', '2023-02-08', 'B00001', 'สมหญิง จริงใจ', 25, 1),
(3, '2023-02-08', '0000-00-00', 'B00003', 'สมหญิง จริงใจ', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_member`
--

CREATE TABLE `tb_member` (
  `id` int(11) NOT NULL,
  `m_user` text NOT NULL,
  `m_pass` text NOT NULL,
  `m_name` text NOT NULL,
  `m_phone` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_member`
--

INSERT INTO `tb_member` (`id`, `m_user`, `m_pass`, `m_name`, `m_phone`) VALUES
(1, 'member01', 'abc1111', 'สมหญิง จริงใจ', '0801111111'),
(2, 'member02', 'abc2222', 'สมชาย มั่นคง', '0802222222'),
(3, 'member03', 'abc3333', 'สมเกียรติ เก่งกล้า', '0803333333'),
(4, 'member04', 'abc4444', 'สมสมร อิ่มเอม', '0804444444'),
(5, 'member05', 'abc5555', 'สมรักษ์ สะอาด', '0805555555');

-- --------------------------------------------------------

--
-- Table structure for table `tb_officers`
--

CREATE TABLE `tb_officers` (
  `id` int(11) NOT NULL,
  `f_name` text NOT NULL,
  `f_user` text NOT NULL,
  `f_pass` text NOT NULL,
  `f_phone` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_officers`
--

INSERT INTO `tb_officers` (`id`, `f_name`, `f_user`, `f_pass`, `f_phone`) VALUES
(1, 'บรรณรักษ์', 'admin', '714d16fd3366d3ea56d2e81a3d7ea39f', '0612528280');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_book`
--
ALTER TABLE `tb_book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_borrow_book`
--
ALTER TABLE `tb_borrow_book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_member`
--
ALTER TABLE `tb_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_officers`
--
ALTER TABLE `tb_officers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_book`
--
ALTER TABLE `tb_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_borrow_book`
--
ALTER TABLE `tb_borrow_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_member`
--
ALTER TABLE `tb_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_officers`
--
ALTER TABLE `tb_officers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
