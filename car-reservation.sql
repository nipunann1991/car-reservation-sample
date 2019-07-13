-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 13, 2019 at 06:51 PM
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
) ENGINE=MyISAM AUTO_INCREMENT=1608 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`car_id`, `plate_id`, `model`, `car_type_id`, `color`, `year`, `engine`, `no_of_passegers`, `fuel_type_id`, `status`) VALUES
(1, 'CBE1056', 'Suzuki - Alto', 20, 'White', 2015, 800, 4, 1, 1),
(2, 'CBA8856', 'Suzuki - WagonR', 20, 'Red', 2018, 660, 5, 4, 1),
(3, 'CBA8851', 'Suzuki - WagonR', 20, 'White', 2017, 660, 5, 1, 0),
(4, 'KX4033', 'TATA - Nano', 21, 'Purple', 2013, 800, 5, 1, 1),
(6, 'CBE8908', 'Honda Fit', 17, 'White', 2018, 1300, 4, 1, 1),
(0, '0', '0', 0, '0', 0, 0, 0, 0, 1),
(8, 'CBF8853', 'Suzuki - WagonR', 20, 'White', 2017, 660, 4, 4, 1),
(1600, 'YX1011', 'TATA - Nano', 111, 'White', 2007, 0, 4, 92, 1),
(1601, 'AAB2233', 'Hiace', 29, 'White', 2010, 15000, 10, 1, 1),
(1602, 'XYT6655', 'Dimo Batta', 26, 'Blue', 2005, 600, 3, 1, 1),
(1603, 'PRS015', 'Hybrid', 20, 'Red', 2015, 1000, 6, 1, 1),
(1604, 'TSU8899', 'TATA - Nano', 21, 'Black', 2016, 800, 4, 1, 1),
(1605, 'HTU5566', 'Suzuki-WagonR', 20, 'White', 2017, 660, 5, 1, 1),
(1606, 'PQS8877', 'TATA - Nano', 21, 'Red', 2015, 800, 4, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `car_type`
--

DROP TABLE IF EXISTS `car_type`;
CREATE TABLE IF NOT EXISTS `car_type` (
  `car_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `car_type` varchar(50) NOT NULL,
  PRIMARY KEY (`car_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `car_type`
--

INSERT INTO `car_type` (`car_type_id`, `car_type`) VALUES
(30, 'Luxury Bus'),
(29, 'Luxury Van'),
(26, 'Lorry'),
(23, 'Mini Van'),
(21, 'Nano Cab'),
(20, 'Mini Car'),
(17, 'SUV Car');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `email_addr` varchar(50) NOT NULL,
  `address` varchar(150) NOT NULL,
  `nic` varchar(20) NOT NULL,
  `contact_no` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`customer_id`),
  UNIQUE KEY `email` (`email_addr`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `f_name`, `l_name`, `email_addr`, `address`, `nic`, `contact_no`, `password`, `status`) VALUES
(1, 'Nipuna', 'Nanayakkara', 'nipunann0710@gmail.com', '275 A Colombo Road\nGampaha', '910752839v', '0716378515', '', 1),
(3, 'Imali', 'Gunawardena', 'imali@gmail.com', '233, Welikanna, Waga.			    	\n				    ', '95221540v', '0719957212', '', 1),
(5, 'Chathumali', 'Gunawardana', 'chathumali@gmail.com', '150 Hanwella Road, Hanwella				    	\n				    ', '964756539v', '0778954456', '', 1),
(6, 'Supun', 'Silva', 'supun0091@yahoo.com', '54,School Lane, Rajagiriya				    	\n				    ', '915256852v', '0767409396', '', 1),
(7, 'Thlini', 'Wijeysekara', 'thiliniwije@gmail.com', '66/1,2nd lane, Kelaniya				    	\n				    ', '96884569v', '01127855665', '', 1),
(8, 'Shenal', 'Balachandra', 'madushanka@gmail.com', '36,pilapitiya,Kelaniya				    	\n				    ', '981212603v', '0758624541', '', 1),
(9, 'Haritha', 'Rajapaksha', 'haritha@gmail.com', '372,Galle Road, Panadura				    	\n				    ', '925418639v', '07745689741', '', 1),
(10, 'Indika', 'Nishantha', 'nishantha@gmail.com', '36,Piliyandala Road, Maharagama    	\n				    ', '80754596v', '0711258962', '', 1),
(11, 'Gayani', 'Fernando', 'gayanifernando@gmail.com', '410/1,Athurugiriya Road, Malabe				    	\n				    ', '871256987v', '0112656897', '', 1),
(17, 'Ashani', 'De Silva', 'ahani2@gmail.com', '89 Colombo Road, Matara', '910752839v', '716378515', '', 1),
(18, 'Shenali', 'Fernando', 'shenali@gmail.com', '455 Negambo Road, \nWattala', '940098929v', '076546876', '', 1),
(27, 'Thilini', 'Perera', 'thilini@gmail.com', '12 Kandy Road, Kadawatha.				    	\n				    ', '930752832v', '0776545678', '', 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driver_id`, `first_name`, `last_name`, `licence_no`, `nic`, `address`, `email`, `contact_no`, `status`, `car_id`) VALUES
(1, 'Amal', 'Gamage', '32789324423D', '900752839v', '112, Kaduwela Road,\nMalabe', 'amal@gmail.com', '0716378515', 0, -1),
(2, 'Saman', 'Perera', '3534512223', '758900896v', '23, Galle Road,\nKaluthara.', 'saman@gmail.com', '0745862272', 1, -1),
(3, 'Kalana', 'Herath', '35345144423', '9177159168v', '236,Colombo Road, Kaduwela', 'kalana@gmail,com', '7582556981', 1, -1),
(4, 'Dharshana', 'Jayathilaka', '8554515545', '9177158169v', 'Wallisara', 'dharshana@gmail.com', '0775557874', 1, -1),
(5, 'Jayantha', 'Rajapaksha', '58845122323', '925419635v', 'Kelaniya', 'Jaya@gmail.com', '0712255657', 1, -1),
(6, 'Shehan', 'Mendis', '9673515545', '895518709v', 'Maharagama', 'shhan89@gmail.com', '0715489608', 1, -1),
(7, 'Lakshitha', 'Bandara', '867541535', '828545964v', 'Gampaha', 'Lakshitha_8200@gmail.com', '0715668579', 1, -1),
(0, '', '', '', '', '', '', '', 1, -1);

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
  `price_per_day` int(11) NOT NULL,
  `price_per_hour` int(11) NOT NULL,
  `price_per_km` int(11) NOT NULL,
  `update_date` date DEFAULT NULL,
  PRIMARY KEY (`pricing_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pricing`
--

INSERT INTO `pricing` (`pricing_id`, `car_type_id`, `price_per_day`, `price_per_hour`, `price_per_km`, `update_date`) VALUES
(2, 21, 5600, 800, 50, '2019-06-23'),
(3, 20, 12000, 1250, 80, '2019-06-23'),
(4, 17, 15000, 1800, 150, '2019-06-28'),
(9, 23, 15000, 2500, 200, '2019-07-04'),
(8, 0, 0, 0, 0, '2019-06-29');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `res_id` int(11) NOT NULL AUTO_INCREMENT,
  `res_date` date NOT NULL,
  `res_end_date` date NOT NULL,
  `customer_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `car_type_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `pricing_id` int(11) NOT NULL,
  `pricing_type` int(11) NOT NULL,
  `pricing_qty` int(11) NOT NULL,
  `total_price` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`res_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`res_id`, `res_date`, `res_end_date`, `customer_id`, `car_id`, `car_type_id`, `driver_id`, `pricing_id`, `pricing_type`, `pricing_qty`, `total_price`, `status`) VALUES
(16, '2019-07-11', '2019-07-11', 3, 1, 20, 3, 3, 2, 1, 1250, 2),
(17, '2019-07-15', '2019-07-15', 1, 1, 20, 4, 3, 1, 1, 12000, 1),
(18, '2019-07-17', '2019-07-17', 1, 0, 21, 0, 2, 3, 7, 0, -1),
(19, '2019-07-04', '2019-07-04', 1, 6, 17, 3, 4, 2, 5, 9000, 2),
(20, '2019-07-20', '2019-07-20', 27, 8, 20, 6, 3, 2, 7, 8750, 0),
(21, '2019-07-14', '2019-07-14', 6, 1, 20, 2, 3, 1, 1, 12000, 1),
(22, '2019-07-14', '2019-07-15', 8, 4, 21, 7, 2, 1, 1, 5600, 1),
(23, '2019-08-15', '2019-08-16', 10, 8, 20, 4, 3, 1, 2, 24000, 1),
(24, '2019-09-13', '2019-09-13', 1, 0, 21, 0, 2, 3, 80, 4000, -1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `u_fname` varchar(50) NOT NULL,
  `u_lname` varchar(50) NOT NULL,
  `u_email` varchar(50) NOT NULL,
  `u_password` varchar(50) NOT NULL,
  `u_role` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`u_id`),
  UNIQUE KEY `u_email` (`u_email`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `customer_id`, `u_fname`, `u_lname`, `u_email`, `u_password`, `u_role`) VALUES
(1, 0, 'admin', '', 'admin@admin.com', '123456', 1),
(5, 1, 'Nipuna', 'Nanayakkara', 'nipunann0710@gmail.com', '123123', 2),
(11, 27, 'Thilini', 'Perera', 'thilini@gmail.com', '234234', 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
