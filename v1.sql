-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2019 at 11:53 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `v1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `hashed_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `videogame_id` varchar(255) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `purchase_type` varchar(255) NOT NULL,
  `trading_for` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `videogame_id`, `customer_id`, `quantity`, `purchase_type`, `trading_for`) VALUES
(40, '2', '4', '1', 'Trade for: Borderlands 2', '0710425471025'),
(41, '1', '4', '1', 'buy', '');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `hashed_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `first_name`, `last_name`, `address`, `email_address`, `hashed_password`) VALUES
(4, 'XX', 'Name', 'Address', 's@seo.com', '$2y$10$Lx2N0DW6lTaTr2uzRIM4KeTM9woFfZVnr6qkS96jpuaJUbu7oS9my'),
(6, 'Name', 'Surname', 'suradr', 'seo@s.com', '$2y$10$sVOK0AAiV3toGTIoaRKAQu0TYm1uVPHUKRFbieB0TUKeOT6tMppUu');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `transaction_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `order_status` varchar(100) NOT NULL,
  `order_type` varchar(100) NOT NULL,
  `order_date` varchar(100) NOT NULL,
  `invoice_number` varchar(50) NOT NULL,
  `payment_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`transaction_id`, `customer_id`, `total_price`, `order_status`, `order_type`, `order_date`, `invoice_number`, `payment_type`) VALUES
(1, 4, 30, 'completed', '', '2019-06-30', '1052902472', 'Online Payment'),
(2, 4, 30, 'completed', '', '2019-06-30', '948790272', 'Collect in store'),
(3, 4, 30, 'completed', '', '2019-06-30', '528964476', 'Online Payment');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `videogame_id` int(11) NOT NULL,
  `barcode` varchar(200) NOT NULL,
  `order_type` varchar(100) NOT NULL,
  `price_paid` varchar(100) NOT NULL,
  `price_sold` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_detail_id`, `order_id`, `videogame_id`, `barcode`, `order_type`, `price_paid`, `price_sold`, `quantity`) VALUES
(1, 1, 1, '', 'buy', '30', '', 1),
(2, 2, 1, '', 'buy', '30', '', 1),
(3, 3, 1, '0710425471025', 'buy', '30', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `platform`
--

CREATE TABLE `platform` (
  `platform_id` int(11) NOT NULL,
  `platform_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `platform`
--

INSERT INTO `platform` (`platform_id`, `platform_name`) VALUES
(1, 'PS3');

-- --------------------------------------------------------

--
-- Table structure for table `videogame`
--

CREATE TABLE `videogame` (
  `videogame_id` int(11) NOT NULL,
  `image` varchar(500) NOT NULL,
  `title` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `platform_id` varchar(255) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `developer` varchar(255) NOT NULL,
  `release_date` varchar(255) NOT NULL,
  `retail_price_new` varchar(255) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `used_price` varchar(255) NOT NULL,
  `stock_quantity` varchar(255) NOT NULL,
  `is_listed` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `videogame`
--

INSERT INTO `videogame` (`videogame_id`, `image`, `title`, `genre`, `platform_id`, `publisher`, `developer`, `release_date`, `retail_price_new`, `barcode`, `used_price`, `stock_quantity`, `is_listed`) VALUES
(1, '201142_front.jpg', 'Borderlands 2', 'Action', '1', '2K Games', 'Gearbox Software', 'September 18, 2012', '60', '0710425471025', '30', '5', 'yes'),
(2, '164424_front.jpg', 'Dark Souls', 'Role-Playing', '1', 'Namco Bandai Games', 'From Software', 'October 4, 2011', '60', '0722674110471', '30', '5', 'yes'),
(3, '111671_front.jpg', 'Fallout', 'Action Adventure', '1', 'Namco Bandai Games', 'Game Freak', 'October 4, 2011', '40', '0722674110475', '30', '4', 'no');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_detail_id`);

--
-- Indexes for table `platform`
--
ALTER TABLE `platform`
  ADD PRIMARY KEY (`platform_id`);

--
-- Indexes for table `videogame`
--
ALTER TABLE `videogame`
  ADD PRIMARY KEY (`videogame_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `platform`
--
ALTER TABLE `platform`
  MODIFY `platform_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `videogame`
--
ALTER TABLE `videogame`
  MODIFY `videogame_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
