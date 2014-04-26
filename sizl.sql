-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 25, 2014 at 12:36 PM
-- Server version: 5.5.32-cll-lve
-- PHP Version: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sizl`
--

-- --------------------------------------------------------

--
-- Table structure for table `cms_users`
--

CREATE TABLE IF NOT EXISTS `cms_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cms_users`
--

INSERT INTO `cms_users` (`user_id`, `username`, `password`, `email`) VALUES
(1, 'terry', 'mypass', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mem_session`
--

CREATE TABLE IF NOT EXISTS `mem_session` (
  `user_id` int(11) NOT NULL,
  `login_time` datetime NOT NULL,
  `user_login_email` varchar(255) NOT NULL,
  `ses_id` varchar(26) NOT NULL,
  UNIQUE KEY `ses_id` (`ses_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mem_session`
--

INSERT INTO `mem_session` (`user_id`, `login_time`, `user_login_email`, `ses_id`) VALUES
(123, '2014-04-02 08:34:18', 'sally@msn.com', '79ba365e75a4f9cee074d25a60'),
(456, '2014-04-02 04:09:17', 'fred@hotmail.com', 'bfc7747c4cf67a4aacc71d7a40');

-- --------------------------------------------------------

--
-- Table structure for table `mem_sessions`
--

CREATE TABLE IF NOT EXISTS `mem_sessions` (
  `session_id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL,
  `user_data` text NOT NULL,
  `reg_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mem_sessions`
--

INSERT INTO `mem_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`, `reg_time`) VALUES
('84d68af2664b9435bf06063185ce5316', '75.115.141.206', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.116 Safari/537.36', 1398445279, 'a:7:{s:9:"user_data";s:0:"";s:7:"user_id";s:2:"17";s:9:"firstname";s:6:"angelo";s:8:"lastname";s:10:"8139567640";s:7:"country";s:24:"United States of America";s:5:"email";s:19:"armotek5421@msn.com";s:9:"logged_in";i:0;}', '2014-04-25 17:01:19'),
('a333e22f7f33970e3e57abef9549a34f', '75.115.141.206', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.116 Safari/537.36', 1398448139, 'a:7:{s:9:"user_data";s:0:"";s:7:"user_id";s:2:"20";s:9:"firstname";s:6:"angelo";s:8:"lastname";s:10:"8139567640";s:5:"email";s:27:"info@affableitsolutions.com";s:7:"country";s:24:"United States of America";s:9:"logged_in";i:0;}', '2014-04-25 17:48:59');

-- --------------------------------------------------------

--
-- Table structure for table `mem_users`
--

CREATE TABLE IF NOT EXISTS `mem_users` (
  `user_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `passwordhash` binary(32) NOT NULL,
  `subscription_id` varchar(32) NOT NULL,
  `buyer_first_name` varchar(255) NOT NULL,
  `buyer_last_name` varchar(255) NOT NULL,
  `buyer_address` varchar(255) NOT NULL,
  `buyer_city` varchar(255) NOT NULL,
  `buyer_state` varchar(255) NOT NULL,
  `buyer_country` varchar(255) NOT NULL,
  `buyer_zip` varchar(255) NOT NULL,
  `buyer_phone` varchar(255) NOT NULL,
  `buyer_email` varchar(255) NOT NULL,
  `reg_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE IF NOT EXISTS `movies` (
  `movie_id` int(8) NOT NULL AUTO_INCREMENT,
  `movie_path` varchar(255) NOT NULL,
  `is_in_queue` tinyint(1) NOT NULL DEFAULT '0',
  `queue_position` smallint(5) DEFAULT NULL,
  `last_play_date` date DEFAULT NULL,
  PRIMARY KEY (`movie_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `movie_path`, `is_in_queue`, `queue_position`, `last_play_date`) VALUES
(2, 'lib/data/vids/trailer.mp4', 1, 2, NULL),
(3, 'lib/data/vids/oceans.mp4', 1, 1, NULL),
(5, 'lib/data/vids/bearmovie1.mp4', 1, 3, NULL),
(6, 'lib/data/vids/bigrabbit2.mp4', 0, 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `new_users`
--

CREATE TABLE IF NOT EXISTS `new_users` (
  `user_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `passwordhash` binary(32) NOT NULL,
  `subscription_id` varchar(32) NOT NULL,
  `buyer_first_name` varchar(255) NOT NULL,
  `buyer_last_name` varchar(255) NOT NULL,
  `buyer_address` varchar(255) NOT NULL,
  `buyer_city` varchar(255) NOT NULL,
  `buyer_state` varchar(255) NOT NULL,
  `buyer_country` varchar(255) NOT NULL,
  `buyer_zip` varchar(255) NOT NULL,
  `buyer_phone` varchar(255) NOT NULL,
  `buyer_email` varchar(255) NOT NULL,
  `reg_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE IF NOT EXISTS `subscriptions` (
  `subscription_id` binary(32) NOT NULL,
  `paid_at` date NOT NULL,
  `created_at` date NOT NULL,
  `good_until` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` smallint(5) NOT NULL,
  `cc_num` bigint(16) NOT NULL,
  `exp_date` date NOT NULL,
  `ccv` smallint(4) NOT NULL,
  `card_company` varchar(12) DEFAULT 'UNKNOWN',
  PRIMARY KEY (`subscription_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
