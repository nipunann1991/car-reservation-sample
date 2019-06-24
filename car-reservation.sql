-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 24, 2019 at 12:23 AM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car-reservation`
--

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

DROP TABLE IF EXISTS `car`;
CREATE TABLE IF NOT EXISTS `car` (
  `car_id` int(11) NOT NULL AUTO_INCREMENT,
  `plate_id` varchar(30) NOT NULL,
  `model` varchar(30) NOT NULL,
  `car_type_id` int(11) NOT NULL,
  `color` varchar(30) NOT NULL,
  `year` int(4) NOT NULL,
  `engine` int(5) NOT NULL,
  `no_of_passegers` int(11) NOT NULL,
  `fuel_type_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`car_id`),
  UNIQUE KEY `plate_id` (`plate_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`car_id`, `plate_id`, `model`, `car_type_id`, `color`, `year`, `engine`, `no_of_passegers`, `fuel_type_id`, `status`) VALUES
(1, 'CBE1056', 'Suzuki - Alto', 20, 'White', 2015, 800, 4, 1, 1),
(2, 'CBA8856', 'Suzuki - WagonR', 20, 'Red', 2018, 660, 5, 4, 1),
(3, 'CBA8851', 'Suzuki - WagonR', 20, 'White', 2017, 660, 5, 1, 0),
(4, 'KX4033', 'TATA - Nano', 21, 'Purple', 2013, 800, 5, 1, 1),
(6, 'CBE8908', 'Honda Fit', 17, 'White', 2018, 1300, 4, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `car_type`
--

DROP TABLE IF EXISTS `car_type`;
CREATE TABLE IF NOT EXISTS `car_type` (
  `car_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `car_type` varchar(50) NOT NULL,
  PRIMARY KEY (`car_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `car_type`
--

INSERT INTO `car_type` (`car_type_id`, `car_type`) VALUES
(23, 'Mini Van'),
(21, 'Nano Cab'),
(20, 'Mini Cab'),
(17, 'SUV Car');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

DROP TABLE IF EXISTS `driver`;
CREATE TABLE IF NOT EXISTS `driver` (
  `driver_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `licence_no` varchar(50) NOT NULL,
  `nic` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `car_id` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`driver_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driver_id`, `first_name`, `last_name`, `licence_no`, `nic`, `address`, `email`, `contact_no`, `status`, `car_id`) VALUES
(1, 'Amal', 'Gamage', '32789324423D', '900752839v', '112, Kaduwela Road,\nMalabe', 'amal@gmail.com', '0716378515', 1, -1),
(2, 'Saman', 'Perera', '3534512223', '758900896v', '23, Galle Road,\nKaluthara.', 'saman@gmail.com', '0745862272', 1, -1);

-- --------------------------------------------------------

--
-- Table structure for table `fuel_types`
--

DROP TABLE IF EXISTS `fuel_types`;
CREATE TABLE IF NOT EXISTS `fuel_types` (
  `fuel_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `fuel_name` varchar(50) NOT NULL,
  PRIMARY KEY (`fuel_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fuel_types`
--

INSERT INTO `fuel_types` (`fuel_type_id`, `fuel_name`) VALUES
(1, 'Petrol'),
(2, 'Diesel'),
(3, 'Electric'),
(4, 'Hybrid');

-- --------------------------------------------------------

--
-- Table structure for table `pricing`
--

DROP TABLE IF EXISTS `pricing`;
CREATE TABLE IF NOT EXISTS `pricing` (
  `pricing_id` int(11) NOT NULL AUTO_INCREMENT,
  `car_type_id` int(11) NOT NULL,
  `price_per_hour` int(11) NOT NULL,
  `price_per_day` int(11) NOT NULL,
  `price_per_km` int(11) NOT NULL,
  `update_date` date DEFAULT NULL,
  PRIMARY KEY (`pricing_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pricing`
--

INSERT INTO `pricing` (`pricing_id`, `car_type_id`, `price_per_hour`, `price_per_day`, `price_per_km`, `update_date`) VALUES
(2, 21, 5600, 800, 50, '2019-06-23'),
(3, 20, 12000, 1250, 80, '2019-06-23');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_fname` varchar(50) NOT NULL,
  `u_lname` varchar(50) NOT NULL,
  `u_email` varchar(50) NOT NULL,
  `u_password` varchar(50) NOT NULL,
  `u_role` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`u_id`),
  UNIQUE KEY `u_email` (`u_email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `u_fname`, `u_lname`, `u_email`, `u_password`, `u_role`) VALUES
(1, 'admin', '', 'admin@admin.com', '123456', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
