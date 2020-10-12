-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2020 at 05:10 PM
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
-- Database: `amart`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `ADD_ID` int(11) NOT NULL,
  `ADD_LOGIN_ID` varchar(50) DEFAULT NULL,
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

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AD_ID`, `AD_EMAIL_ID`, `AD_PASSWORD`, `AD_FIRSTNAME`, `AD_LASTNAME`, `AD_PHNO`) VALUES
('100001', 's@s', '6b51d431df5d7f141cbececcf79edf3dd861c3b4069f0b11661a3eefacbba918', 'S', 'S', 123456789),
('4', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `CRT_LOGIN_ID` varchar(50) DEFAULT NULL,
  `CRT_PRD_ID` varchar(50) DEFAULT NULL,
  `CRT_QUANTITY` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`CRT_LOGIN_ID`, `CRT_PRD_ID`, `CRT_QUANTITY`) VALUES
('9ab81b41c023b9cdacb228111bb88fba', '1001', 1),
('9ab81b41c023b9cdacb228111bb88fba', '1002', 3);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CAT_ID` int(11) NOT NULL,
  `CAT_NAME` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CAT_ID`, `CAT_NAME`) VALUES
(2001, 'Electronics'),
(2002, 'Furniture'),
(2003, 'Kitchen'),
(2004, 'Bathroom');

-- --------------------------------------------------------

--
-- Table structure for table `cookie`
--

CREATE TABLE `cookie` (
  `CK_ID` bigint(11) NOT NULL,
  `CK_LOGIN_ID` varchar(50) DEFAULT NULL,
  `CK_VALUE` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cookie`
--

INSERT INTO `cookie` (`CK_ID`, `CK_LOGIN_ID`, `CK_VALUE`) VALUES
(1, '9ab81b41c023b9cdacb228111bb88fba', '3T10Z8d3334965d0ffa935af70b31d7475ff4ozMiOPOUKsEy8xLA0A5SumftkHNycXGDgCoOdtugJdAHP6HwZ4u7rhvbygJ91xh3w5QvtpnYR1ZhipjQvQzr7FeZ7gNP5tmMoN4MWjYF0sj8rNB3Vp5lRhLsk1yMMkk1O2B7bQ5HVMCG9Peaf77fKmLMvQSygwR3msId599jg5Um3eGneJFPKOdZX5xGtXadGbVxQeuQUZlqQ5NaJkYTAxSBeHDH9QB8nmjCEAQKPv6');

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

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`LOGIN_ID`, `EMAIL_ID`, `USER_PASSWORD`, `USER_FNAME`, `USER_PHNO`) VALUES
('9ab81b41c023b9cdacb228111bb88fba', 'manojavarur@gmail.com', 'f4bf9f7fcbedaba0392f108c59d8f4a38b3838efb64877380171b54475c2ade8', 'Manoj A M', 123456789);

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
  `IMG_PRD_ID` varchar(50) DEFAULT NULL,
  `IMG_PATH` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prd_image`
--

INSERT INTO `prd_image` (`IMG_PRD_ID`, `IMG_PATH`) VALUES
('1001', 'Products/Images/Bean bag-94523176969.png'),
('1002', 'Products/Images/Laddle-94523177104.png'),
('1003', 'Products/Images/Shower-94523177289.png'),
('1004', 'Products/Images/Hair Dryer-94523179033.png');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `PRD_CAT_ID` int(11) DEFAULT NULL,
  `PRD_ID` varchar(50) NOT NULL,
  `PRD_NAME` varchar(100) DEFAULT NULL,
  `PRD_DETAILS` varchar(255) DEFAULT NULL,
  `PRD_OFFERS` varchar(255) DEFAULT NULL,
  `PRD_PRICE` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`PRD_CAT_ID`, `PRD_ID`, `PRD_NAME`, `PRD_DETAILS`, `PRD_OFFERS`, `PRD_PRICE`) VALUES
(2002, '1001', 'Bean bag', 'Extra comfortable', '10% off', 500),
(2003, '1002', 'Laddle', 'Strong ', 'Buy one get one free', 200),
(2004, '1003', 'Shower', 'Shiny', '25% off', 5000),
(2001, '1004', 'Hair Dryer', 'Light weight', '15% off', 570);

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
  ADD PRIMARY KEY (`ADD_ID`),
  ADD KEY `ADD_LOGIN_ID` (`ADD_LOGIN_ID`);

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
  ADD KEY `CK_LOGIN_ID` (`CK_LOGIN_ID`);

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
  ADD KEY `IMG_PRD_ID` (`IMG_PRD_ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`PRD_ID`),
  ADD KEY `PRD_CAT_ID` (`PRD_CAT_ID`);

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
  MODIFY `ADD_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CAT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2005;

--
-- AUTO_INCREMENT for table `cookie`
--
ALTER TABLE `cookie`
  MODIFY `CK_ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ORD_ID` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`ADD_LOGIN_ID`) REFERENCES `login` (`LOGIN_ID`);

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
-- Constraints for table `prd_image`
--
ALTER TABLE `prd_image`
  ADD CONSTRAINT `prd_image_ibfk_1` FOREIGN KEY (`IMG_PRD_ID`) REFERENCES `product` (`PRD_ID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`PRD_CAT_ID`) REFERENCES `category` (`CAT_ID`);

--
-- Constraints for table `total_amt`
--
ALTER TABLE `total_amt`
  ADD CONSTRAINT `total_amt_ibfk_1` FOREIGN KEY (`TA_ORDER_ID`) REFERENCES `orders` (`ORD_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
