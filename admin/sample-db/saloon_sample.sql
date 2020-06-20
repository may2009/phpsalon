-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 15, 2015 at 11:34 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `saloon_sample`
--
CREATE DATABASE IF NOT EXISTS `saloon_sample` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `saloon_sample`;

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(750) NOT NULL,
  `password` varchar(750) NOT NULL,
  `email_id` varchar(750) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `email_id`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE IF NOT EXISTS `booking_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `booking_id` (`booking_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `booking_details`
--

INSERT INTO `booking_details` (`id`, `booking_id`, `service_id`, `price`) VALUES
(1, 1, 1, 100),
(2, 1, 2, 50);

-- --------------------------------------------------------

--
-- Table structure for table `booking_history`
--

CREATE TABLE IF NOT EXISTS `booking_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `booking_date` date NOT NULL,
  `booking_time` varchar(10) NOT NULL,
  `total` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `booked_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`shop_id`),
  KEY `shop_id` (`shop_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `booking_history`
--

INSERT INTO `booking_history` (`id`, `user_id`, `shop_id`, `booking_date`, `booking_time`, `total`, `status`, `booked_date`) VALUES
(1, 1, 1, '2015-10-15', '10:00 AM', 150, 'Booked', '2015-10-15 14:26:15');

-- --------------------------------------------------------

--
-- Table structure for table `fav_shops`
--

CREATE TABLE IF NOT EXISTS `fav_shops` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`shop_id`),
  KEY `shop_id` (`shop_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `fav_shops`
--

INSERT INTO `fav_shops` (`id`, `user_id`, `shop_id`, `date`) VALUES
(1, 1, 1, '2015-10-15 14:20:22'),
(2, 2, 3, '2015-10-15 14:20:22');

-- --------------------------------------------------------

--
-- Table structure for table `main_services`
--

CREATE TABLE IF NOT EXISTS `main_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(750) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `main_services`
--

INSERT INTO `main_services` (`id`, `service_name`) VALUES
(1, 'Hair Cutting'),
(2, 'Spa');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `rating` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`shop_id`),
  KEY `shop_id` (`shop_id`),
  KEY `user_id_2` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id`, `user_id`, `shop_id`, `rating`) VALUES
(1, 1, 1, '4'),
(2, 1, 3, '3'),
(3, 2, 1, '5'),
(4, 1, 1, '2');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `comments` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`shop_id`),
  KEY `shop_id` (`shop_id`),
  KEY `user_id_2` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `user_id`, `shop_id`, `comments`) VALUES
(1, 1, 1, 'Good'),
(2, 2, 3, 'Okay'),
(3, 1, 3, 'Test Review'),
(4, 1, 3, 'Another Review');

-- --------------------------------------------------------

--
-- Table structure for table `saloon_users`
--

CREATE TABLE IF NOT EXISTS `saloon_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `email_id` varchar(250) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `profile_pic` varchar(750) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `saloon_users`
--

INSERT INTO `saloon_users` (`id`, `username`, `password`, `firstname`, `lastname`, `phone_no`, `email_id`, `birthdate`, `gender`, `city`, `country`, `profile_pic`, `created_date`) VALUES
(1, 'test', 'test', 'Test', 'User', '123456789', 'test@gmail.com', '2015-01-06', 'Male', 'cochin', 'india', 'assets/uploads/profile_pic/default_avatar.png', '2015-10-12 17:02:46'),
(2, 'test2', 'test2', 'Another', 'User', '32145687', 'testuser@gmail.com', '2015-10-07', 'Female', 'Cochin', 'India', 'assets/uploads/profile_pic/default_avatar_female.jpg', '2015-10-15 13:55:38');

-- --------------------------------------------------------

--
-- Table structure for table `shop_details`
--

CREATE TABLE IF NOT EXISTS `shop_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_user` int(11) NOT NULL,
  `shop_name` varchar(100) NOT NULL,
  `description` longtext NOT NULL,
  `working_time` longtext NOT NULL,
  `location` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `created_user` (`created_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `shop_details`
--

INSERT INTO `shop_details` (`id`, `created_user`, `shop_name`, `description`, `working_time`, `location`, `state`, `country`, `pincode`, `phone_no`, `email_id`, `website`, `created_date`) VALUES
(1, 1, 'Test Shop', 'Description', 'Test Working time ', 'Test Location', 'Test State', 'Test Country', '123456', '123456789', 'ragu@gmail.com', 'www.gmail.com', '2015-10-13 06:16:17'),
(3, 2, 'New shop', 'eww', 'wee', 'c', 'dasdsa', 'dsad', 'cxzczx', 'ewqew', 'ragu@gmail.com', 'www.gmail.com', '2015-10-14 16:38:30');

-- --------------------------------------------------------

--
-- Table structure for table `shop_gallery`
--

CREATE TABLE IF NOT EXISTS `shop_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL,
  `image_path` varchar(750) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_id` (`shop_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `shop_gallery`
--

INSERT INTO `shop_gallery` (`id`, `shop_id`, `image_path`, `user_id`) VALUES
(6, 1, 'assets/uploads/1-IMG-20150508-WA0012.jpg', 1),
(7, 1, 'assets/uploads/1-ragu1.jpg', 1),
(9, 3, 'assets/uploads/1-RB.jpg', 1),
(10, 3, 'assets/uploads/1-rock.jpg', 1),
(11, 3, 'assets/uploads/1-screenshot-7_1024.png', 1),
(12, 3, 'assets/uploads/1-songwriter.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shop_services`
--

CREATE TABLE IF NOT EXISTS `shop_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_id` (`shop_id`,`service_id`),
  KEY `shop_id_2` (`shop_id`),
  KEY `service_id` (`service_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `shop_services`
--

INSERT INTO `shop_services` (`id`, `shop_id`, `service_id`, `price`) VALUES
(1, 1, 1, 100),
(2, 1, 2, 50),
(3, 3, 2, 200);

-- --------------------------------------------------------

--
-- Table structure for table `trending`
--

CREATE TABLE IF NOT EXISTS `trending` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(750) NOT NULL,
  `description` longtext NOT NULL,
  `image` varchar(750) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `trending`
--

INSERT INTO `trending` (`id`, `user_id`, `title`, `description`, `image`, `created_date`) VALUES
(1, 1, 'Test Trending', 'Trending Description', 'assets/uploads/1-rock.jpg', '2015-10-15 14:16:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `email_id` varchar(250) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `profile_pic` varchar(750) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`, `phone_no`, `email_id`, `birthdate`, `gender`, `city`, `country`, `profile_pic`, `created_date`) VALUES
(1, 'ragu', '1234', 'Ragu', 'Nathan', '1234567789', 'ragu@gmail.com', '2015-10-13', 'Male', 'Cochin', 'Country', 'assets/uploads/profile_pic/default_avatar.png', '2015-10-15 13:57:07'),
(2, 'shilpa', '1234', 'Shilpa', 'PA', '23098656', 'shilpa@gmail.com', '2015-10-06', 'Female', 'cochin', 'india', 'assets/uploads/profile_pic/default_avatar_female.jpg', '2015-10-15 13:57:59');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD CONSTRAINT `booking_details_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking_details` (`id`);

--
-- Constraints for table `booking_history`
--
ALTER TABLE `booking_history`
  ADD CONSTRAINT `booking_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `booking_history_ibfk_2` FOREIGN KEY (`shop_id`) REFERENCES `shop_details` (`id`);

--
-- Constraints for table `fav_shops`
--
ALTER TABLE `fav_shops`
  ADD CONSTRAINT `fav_shops_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fav_shops_ibfk_2` FOREIGN KEY (`shop_id`) REFERENCES `shop_details` (`id`);

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`shop_id`) REFERENCES `shop_details` (`id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`shop_id`) REFERENCES `shop_details` (`id`);

--
-- Constraints for table `shop_details`
--
ALTER TABLE `shop_details`
  ADD CONSTRAINT `shop_details_ibfk_1` FOREIGN KEY (`created_user`) REFERENCES `saloon_users` (`id`);

--
-- Constraints for table `shop_gallery`
--
ALTER TABLE `shop_gallery`
  ADD CONSTRAINT `shop_gallery_ibfk_1` FOREIGN KEY (`shop_id`) REFERENCES `shop_details` (`id`);

--
-- Constraints for table `shop_services`
--
ALTER TABLE `shop_services`
  ADD CONSTRAINT `shop_services_ibfk_1` FOREIGN KEY (`shop_id`) REFERENCES `shop_details` (`id`),
  ADD CONSTRAINT `shop_services_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `main_services` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
