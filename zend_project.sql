-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 02, 2016 at 08:49 PM
-- Server version: 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `zend_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `car_rental`
--

CREATE TABLE IF NOT EXISTS `car_rental` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pick_up_location` varchar(100) NOT NULL,
  `time_from` varchar(30) NOT NULL,
  `time_to` varchar(30) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `rate` int(11) NOT NULL,
  `imag_path` varchar(100) NOT NULL,
  `description` varchar(300) NOT NULL,
  `latitude` int(11) NOT NULL,
  `longitude` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `name`, `rate`, `imag_path`, `description`, `latitude`, `longitude`, `country_id`) VALUES
(2, 'alex', 3, '/images/cites/3alm_zballa.jpg', '', 0, 0, 0),
(3, 'cario', 3, '/images/cites/1394145_10202594432887918_1290572530_n.jpg', '', 0, 0, 0),
(4, 'matroh', 3, '/images/cites/10362936_653248861444837_3117754319988566084_n.jpg', '', 0, 0, 0),
(5, 'rashed', 3, '/images/cites/10402779_905879442757477_1952813609272726984_n.jpg', '', 0, 0, 0),
(6, 'tanta', 3, '/images/cites/10513295_674002879387611_6924943875922809767_n.jpg', '', 0, 0, 0),
(7, 'miami', 4, '/images/cites/1394145_10202594432887918_1290572530_n.jpg', '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `user_posts_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `rate` int(11) NOT NULL,
  `image_path` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`, `rate`, `image_path`) VALUES
(1, 'Egypt', 3, '/images/countries/30-Death-Defying-Photos-That-Will-Make-Your-Heart-Skip-A-Beat-photofal-22.jpg'),
(2, 'Qater', 3, '/images/countries/30-Death-Defying-Photos-That-Will-Make-Your-Heart-Skip-A-Beat-photofal-22.jpg'),
(3, 'Koria', 3, '/images/countries/16091_374168822734375_3819432414317513178_n.jpg'),
(4, 'lebia', 3, '/images/countries/181011_596602857036177_393388616_n.jpg'),
(5, 'london', 3, '/images/countries/181011_596602857036177_393388616_n.jpg'),
(6, 'jaban', 3, '/images/countries/12687919_10154494417029186_4307678751489344476_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE IF NOT EXISTS `hotels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `city_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_reservation`
--

CREATE TABLE IF NOT EXISTS `hotel_reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `time_from` varchar(30) DEFAULT NULL,
  `time_to` varchar(30) NOT NULL DEFAULT '0000-00-00 00:00:00',
  `number_of_adults` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `imag_path` varchar(100) NOT NULL,
  `city_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `imag_path` varchar(100) NOT NULL DEFAULT '/images/users/default.jpeg',
  `is_active` int(11) NOT NULL DEFAULT '1',
  `is_admin` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_posts`
--

CREATE TABLE IF NOT EXISTS `user_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `image_path` varchar(100) NOT NULL,
  `city_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
