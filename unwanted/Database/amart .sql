-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2020 at 08:52 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amart`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `AD_ID` int(11) NOT NULL,
  `AD_LOGIN_ID` varchar(50) DEFAULT NULL,
  `ADDRESS` varchar(255) DEFAULT NULL,
  `PINCODE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AD_ID` varchar(50) NOT NULL,
  `AD_EMAIL_ID` varchar(100) DEFAULT NULL,
  `AD_PASSWORD` varchar(100) DEFAULT NULL,
  `AD_FIRSTNAME` char(100) DEFAULT NULL,
  `AD_LASTNAME` char(100) DEFAULT NULL,
  `AD_PHNO` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `CRT_LOGIN_ID` varchar(50) DEFAULT NULL,
  `CRT_PRD_ID` varchar(50) DEFAULT NULL,
  `CRT_QUANTITY` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CAT_ID` int(11) NOT NULL,
  `CAT_NAME` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cookie`
--

CREATE TABLE `cookie` (
  `CK_ID` bigint(11) NOT NULL,
  `CK_LOGIN_ID` varchar(50) DEFAULT NULL,
  `CK_VALUE` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `LOGIN_ID` varchar(50) NOT NULL,
  `EMAIL_ID` varchar(100) DEFAULT NULL,
  `USER_PASSWORD` varchar(255) DEFAULT NULL,
  `USER_FNAME` varchar(100) DEFAULT NULL,
  `USER_PHNO` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ORD_ID` int(11) NOT NULL,
  `ORD_LOGIN_ID` varchar(50) DEFAULT NULL,
  `ORD_PRD_ID` varchar(50) DEFAULT NULL,
  `ORD_QUANTITY` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `prd_image`
--

CREATE TABLE `prd_image` (
  `IMG_ID` int(11) NOT NULL,
  `IMG_PATH` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `PRD_CAT_ID` int(11) DEFAULT NULL,
  `PRD_ID` varchar(50) NOT NULL,
  `PRD_NAME` varchar(100) DEFAULT NULL,
  `PRD_DETAILS` varchar(255) DEFAULT NULL,
  `PRD_PRICE` float DEFAULT NULL,
  `PRD_IMG_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `total_amt`
--

CREATE TABLE `total_amt` (
  `AMT_ID` int(11) NOT NULL,
  `TA_ORDER_ID` int(11) DEFAULT NULL,
  `TOTAL_AMT` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`AD_ID`),
  ADD KEY `AD_LOGIN_ID` (`AD_LOGIN_ID`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AD_ID`),
  ADD UNIQUE KEY `AD_EMAIL_ID` (`AD_EMAIL_ID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD KEY `CRT_LOGIN_ID` (`CRT_LOGIN_ID`),
  ADD KEY `CRT_PRD_ID` (`CRT_PRD_ID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CAT_ID`);

--
-- Indexes for table `cookie`
--
ALTER TABLE `cookie`
  ADD PRIMARY KEY (`CK_ID`),
  ADD KEY `COK_LOGIN_ID` (`CK_LOGIN_ID`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`LOGIN_ID`),
  ADD UNIQUE KEY `EMAIL_ID` (`EMAIL_ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ORD_ID`),
  ADD KEY `ORD_LOGIN_ID` (`ORD_LOGIN_ID`),
  ADD KEY `ORD_PRD_ID` (`ORD_PRD_ID`);

--
-- Indexes for table `prd_image`
--
ALTER TABLE `prd_image`
  ADD PRIMARY KEY (`IMG_ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`PRD_ID`),
  ADD KEY `PRD_CAT_ID` (`PRD_CAT_ID`),
  ADD KEY `PRD_IMG_ID` (`PRD_IMG_ID`);

--
-- Indexes for table `total_amt`
--
ALTER TABLE `total_amt`
  ADD PRIMARY KEY (`AMT_ID`),
  ADD KEY `TA_ORDER_ID` (`TA_ORDER_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `AD_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CAT_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cookie`
--
ALTER TABLE `cookie`
  MODIFY `CK_ID` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ORD_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prd_image`
--
ALTER TABLE `prd_image`
  MODIFY `IMG_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `PRD_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `total_amt`
--
ALTER TABLE `total_amt`
  MODIFY `AMT_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`AD_LOGIN_ID`) REFERENCES `login` (`LOGIN_ID`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`CRT_LOGIN_ID`) REFERENCES `login` (`LOGIN_ID`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`CRT_PRD_ID`) REFERENCES `product` (`PRD_ID`);

--
-- Constraints for table `cookie`
--
ALTER TABLE `cookie`
  ADD CONSTRAINT `cookie_ibfk_1` FOREIGN KEY (`CK_LOGIN_ID`) REFERENCES `login` (`LOGIN_ID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`ORD_LOGIN_ID`) REFERENCES `login` (`LOGIN_ID`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`ORD_PRD_ID`) REFERENCES `product` (`PRD_ID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`PRD_CAT_ID`) REFERENCES `category` (`CAT_ID`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`PRD_IMG_ID`) REFERENCES `prd_image` (`IMG_ID`);

--
-- Constraints for table `total_amt`
--
ALTER TABLE `total_amt`
  ADD CONSTRAINT `total_amt_ibfk_1` FOREIGN KEY (`TA_ORDER_ID`) REFERENCES `orders` (`ORD_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
