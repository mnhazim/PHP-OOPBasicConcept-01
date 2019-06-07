-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2019 at 10:03 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ebundle`
--

-- --------------------------------------------------------

--
-- Table structure for table `eb_admin`
--

CREATE TABLE `eb_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(200) NOT NULL,
  `admin_notel` varchar(100) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_pass` varchar(100) NOT NULL,
  `admin_datecreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eb_admin`
--

INSERT INTO `eb_admin` (`admin_id`, `admin_name`, `admin_notel`, `admin_email`, `admin_pass`, `admin_datecreated`) VALUES
(1, 'admin', '012343123', 'test@gmail.com', '202cb962ac59075b964b07152d234b70', '2019-03-13');

-- --------------------------------------------------------

--
-- Table structure for table `eb_book`
--

CREATE TABLE `eb_book` (
  `book_id` int(11) NOT NULL,
  `book_name` varchar(200) NOT NULL,
  `book_status` varchar(100) NOT NULL,
  `book_price` float NOT NULL,
  `book_desc` text NOT NULL,
  `book_department` varchar(100) NOT NULL,
  `book_quantity` int(11) NOT NULL,
  `book_publish` int(11) NOT NULL,
  `book_level` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `admin_info` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eb_book`
--

INSERT INTO `eb_book` (`book_id`, `book_name`, `book_status`, `book_price`, `book_desc`, `book_department`, `book_quantity`, `book_publish`, `book_level`, `user_id`, `admin_info`) VALUES
(5, 'try', 'accept', 10, 'try', 'JP', 1, 1, '0', 2, ''),
(6, 'try 2', 'accept', 40, 'try 2', 'JP', 9, 1, '0', 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `eb_cart`
--

CREATE TABLE `eb_cart` (
  `cart_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cart_quantity` int(11) NOT NULL,
  `cart_price` varchar(100) NOT NULL,
  `cart_checkout` varchar(100) NOT NULL,
  `cart_status` int(11) NOT NULL,
  `cart_datecreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eb_record`
--

CREATE TABLE `eb_record` (
  `record_id` int(11) NOT NULL,
  `cart_checkout` varchar(100) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `record_price` varchar(100) NOT NULL,
  `record_status` varchar(100) NOT NULL,
  `record_info` varchar(100) NOT NULL,
  `record_receipt` varchar(200) NOT NULL,
  `record_datecreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eb_user`
--

CREATE TABLE `eb_user` (
  `user_id` int(11) NOT NULL,
  `user_fullname` varchar(200) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `user_pass` varchar(100) NOT NULL,
  `user_department` varchar(100) NOT NULL,
  `user_notel` varchar(100) NOT NULL,
  `user_matric` varchar(100) NOT NULL,
  `user_datecreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eb_user`
--

INSERT INTO `eb_user` (`user_id`, `user_fullname`, `user_email`, `user_pass`, `user_department`, `user_notel`, `user_matric`, `user_datecreated`) VALUES
(2, 'hazim', 'hazim.sap1@gmail.com', '202cb962ac59075b964b07152d234b70', 'JKE', '0123456789', '25DSK1234', '2019-03-09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eb_admin`
--
ALTER TABLE `eb_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `eb_book`
--
ALTER TABLE `eb_book`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `eb_cart`
--
ALTER TABLE `eb_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `eb_record`
--
ALTER TABLE `eb_record`
  ADD PRIMARY KEY (`record_id`);

--
-- Indexes for table `eb_user`
--
ALTER TABLE `eb_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eb_admin`
--
ALTER TABLE `eb_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `eb_book`
--
ALTER TABLE `eb_book`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `eb_cart`
--
ALTER TABLE `eb_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `eb_record`
--
ALTER TABLE `eb_record`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eb_user`
--
ALTER TABLE `eb_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
