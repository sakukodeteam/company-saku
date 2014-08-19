-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 19, 2014 at 02:16 
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sakukodedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_articles`
--

CREATE TABLE IF NOT EXISTS `blog_articles` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_title` varchar(100) NOT NULL,
  `article_url` varchar(100) NOT NULL,
  `keyword` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `author_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('publish','draft') NOT NULL DEFAULT 'publish',
  `category_id` int(11) NOT NULL,
  `picture` varchar(50) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`article_id`),
  UNIQUE KEY `article_url` (`article_url`),
  KEY `author_id` (`author_id`),
  KEY `status` (`status`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `blog_articles`
--

INSERT INTO `blog_articles` (`article_id`, `article_title`, `article_url`, `keyword`, `content`, `author_id`, `date`, `status`, `category_id`, `picture`, `deleted`) VALUES
(1, 'Pemrograman Web', 'pemrograman-web', 'php,mysql', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.\n\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word', 3, '2014-08-19 06:38:40', 'publish', 1, 'pemrograman-web.jpg', 0),
(2, 'Desain Web', 'desain-web', 'html,css,jquery', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.\n\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word', 3, '2014-08-19 08:21:55', 'publish', 1, 'desain-web.jpg', 0),
(3, 'Cara membangun toko online', 'cara-membangun-toko-online', 'ecommerce,internet', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.\r\n\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word', 4, '2014-08-19 11:39:01', 'draft', 3, 'toko-online.jpg', 0),
(4, 'Contoh artikel pengetahuan umum', 'contoh-artikel-pengetahuan-umum', 'pengetahuan,umum,lingkungan', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.\r\n\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word', 4, '2014-08-11 05:08:43', 'publish', 2, 'pengetahuan-umum.jpg', 0),
(5, 'Uji Coba Timnas U-19', 'uji-coba-timnas-u-19', 'sepakbola, timnas', '&lt;p&gt;Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &amp;quot;de Finibus Bonorum et Malorum&amp;quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &amp;quot;Lorem ipsum dolor sit amet..&amp;quot;, comes from a line in section 1.10.32. Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word&lt;/p&gt;', 3, '2014-08-19 07:07:17', 'publish', 4, 'garuda-jaya.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE IF NOT EXISTS `blog_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  `category_url` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`category_id`, `category_name`, `category_url`, `description`, `deleted`) VALUES
(1, 'Komputer', 'komputer', 'semua artikel tentang komputer', 0),
(2, 'Pengetahuan Umum', 'pengetahuan-umum', 'semua artikel yang mencakup semua bidang secara umum', 0),
(3, 'Bisnis', 'bisnis', 'semua artikel tentang bisnis', 0),
(4, 'Olahraga', 'olahraga', 'Artikel Seputar dunia olahraga dalam negeri dan luar negeri', 0);

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

CREATE TABLE IF NOT EXISTS `blog_comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(100) NOT NULL,
  `email` varchar(70) NOT NULL,
  `url` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `parent_id` int(11) NOT NULL,
  `avatar` varchar(70) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_id`),
  KEY `article_id` (`article_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `blog_comments`
--

INSERT INTO `blog_comments` (`comment_id`, `article_id`, `date`, `name`, `email`, `url`, `content`, `parent_id`, `avatar`, `deleted`) VALUES
(1, 1, '2014-08-19 07:16:51', 'sakukode', 'sakukode@gmail.com', '', 'tes komentar 1', 0, 'visitors.jpg', 0),
(2, 1, '2014-08-19 07:16:51', 'naruto', 'naruto@gmail.com', '', 'tes komentar 1', 0, 'visitors.jpg', 0),
(3, 2, '2014-08-19 07:16:51', 'Rizqi Maulana', 'rizqimaulana88@gmail.com', '', 'tes komentar 3', 0, 'visitors.jpg', 0),
(4, 3, '2014-08-19 12:03:42', 'sakura', 'sakura@gmail.com', '', 'tes komentar 4', 0, 'visitors.jpg', 1),
(5, 1, '2014-08-19 07:16:51', 'sasuke', 'sasuke@gmail.com', '', 'tes sub komentar 1', 1, 'visitors.jpg', 0),
(6, 1, '2014-08-19 07:16:51', 'sabaku gara', 'sabaku@gmail.com', '', 'tes sub komentar 2', 1, 'visitors.jpg', 0),
(7, 1, '2014-08-19 07:16:51', 'sikamaru', 'sikamaru@gmail.com', '', 'tes sub komentar 2.1', 2, 'visitors.jpg', 0),
(8, 4, '2014-08-19 07:16:51', 'rizqi maulana', '', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua.', 0, 'visitors.jpg', 0),
(9, 4, '2014-08-19 11:53:39', 'sakukode', '', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua.', 0, 'visitors.jpg', 1),
(10, 4, '2014-08-19 07:16:52', 'sakura', '', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua.', 0, 'visitors.jpg', 0),
(11, 4, '2014-08-19 07:16:52', 'hinata', 'hinata@gmail.com', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 0, 'visitors.jpg', 0),
(12, 2, '2014-08-19 07:16:52', 'rizqi maulana', '', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 0, 'visitors.jpg', 0),
(13, 2, '2014-08-19 07:16:52', 'rizqi maulana', '', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 3, 'visitors.jpg', 0),
(14, 2, '2014-08-19 07:16:52', 'sakura', 'sakukode@gmail.com', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 12, 'visitors.jpg', 0),
(15, 3, '2014-08-19 12:03:42', 'kakashi', 'kakashi@gmail.com', '', 'hallooo semua..', 4, 'visitors.jpg', 1),
(16, 5, '2014-08-19 08:25:49', 'jhk', '', '', 'lhlll', 0, 'visitors.jpg', 0),
(17, 4, '2014-08-19 10:32:14', 'rizqi88', 'sakukode@gmail.com', 'http://sakukode.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 0, 'admin.jpg', 0),
(18, 4, '2014-08-19 10:35:02', 'rizqi88', 'sakukode@gmail.com', 'http://sakukode.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit,', 0, 'admin.jpg', 0),
(19, 4, '2014-08-19 10:42:37', 'rizqi88', 'sakukode@gmail.com', 'http://sakukode.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua', 0, 'admin.jpg', 0),
(20, 4, '2014-08-19 11:51:24', 'rizqi88', 'sakukode@gmail.com', 'http://sakukode.com', '', 8, 'admin.jpg', 1),
(21, 4, '2014-08-19 11:31:19', 'rizqi88', 'sakukode@gmail.com', 'http://sakukode.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod', 9, 'admin.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('a5b59200c70a8f108e1f6b70ae9d8cdd', '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.125 Safari/537.36', 1407732452, 'a:2:{s:22:"flash:new:captcha_word";s:8:"yxxgDzEY";s:22:"flash:new:captcha_time";d:1407732475.3141520023345947265625;}');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `company` varchar(50) NOT NULL,
  `contact_person` varchar(50) NOT NULL,
  `email` varchar(70) NOT NULL,
  `url` varchar(50) NOT NULL,
  `address_1` text NOT NULL,
  `address_2` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `hp` varchar(20) NOT NULL,
  `picture` varchar(50) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `company`, `contact_person`, `email`, `url`, `address_1`, `address_2`, `phone`, `hp`, `picture`, `deleted`) VALUES
(1, 'PT. Perusahaan A', 'client A', 'company-a@gmail.com', '', 'Pekalongan', '', '0285-411111', '085879086784', 'company-a.png', 0),
(2, 'PT. Perusahaan B', 'client B', 'company-b@gmail.com', '', 'Jakarta', '', '021-435898', '', 'company-b.png', 0),
(3, 'PT.Perusahaan C', 'budi santoso', 'company-c@gmail.com', 'http://company-a.com', 'Semarang', '', '', '089897384784', 'company-c.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(100) NOT NULL,
  `tagline` varchar(100) NOT NULL,
  `email` varchar(70) NOT NULL,
  `url` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `hp` varchar(20) NOT NULL,
  `profile` text NOT NULL,
  `date` date NOT NULL,
  `logo` varchar(50) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`company_id`, `company_name`, `tagline`, `email`, `url`, `address`, `phone`, `hp`, `profile`, `date`, `logo`, `deleted`) VALUES
(1, 'Sakukode', 'Lorem ipsum dolor sit amet', 'sakukode@gmail.com', 'http://sakukode.com', 'Jalan Panjang Baru No.9\r\nPekalongan, Jawa Tengah\r\nIndonesia', '', '085842874104', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2014-08-06', 'logo.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE IF NOT EXISTS `emails` (
  `email_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `content` text NOT NULL,
  `file` varchar(50) NOT NULL,
  `status` enum('SENT','DRAFT') NOT NULL DEFAULT 'DRAFT',
  `email_to` varchar(70) NOT NULL,
  `deleted` int(1) NOT NULL,
  PRIMARY KEY (`email_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) COLLATE utf8_bin NOT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(70) NOT NULL,
  `url` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `status` enum('READ','UNREAD') NOT NULL DEFAULT 'UNREAD',
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `name`, `email`, `url`, `message`, `status`, `deleted`) VALUES
(1, 'sakukode', 'sakukode@gmail.com', 'http://sakukode.com', 'Testing Pesan..', 'UNREAD', 0),
(2, 'rizqi maulana', 'rizqimaulana1512@gmail.com', '', 'Testing Message ''2''..', 'UNREAD', 0),
(3, 'sakukode', 'sakukode@gmail.com', '', 'Testing Message "3''''..', 'UNREAD', 0),
(4, 'naruto', 'naruto@gmail.com', '', 'hello my name is naruto', 'UNREAD', 0),
(5, 'sakukode', 'sakukode@gmail.com', '', 'Hello All..', 'UNREAD', 0);

-- --------------------------------------------------------

--
-- Table structure for table `portofolios`
--

CREATE TABLE IF NOT EXISTS `portofolios` (
  `portofolio_id` int(11) NOT NULL AUTO_INCREMENT,
  `portofolio_name` varchar(100) NOT NULL,
  `picture` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `url` varchar(50) NOT NULL,
  `client` varchar(70) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`portofolio_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `portofolios`
--

INSERT INTO `portofolios` (`portofolio_id`, `portofolio_name`, `picture`, `description`, `url`, `client`, `deleted`) VALUES
(1, 'Portofolio Pertama', 'portofolio-1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', 'http://portofolio-1.com', 'client A', 0),
(2, 'Portofolio Kedua', 'portofolio-2.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', 'http://portofolio-2.com', 'client B', 0),
(3, 'Portofolio Ketiga', 'portofolio-3.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', 'http://portofolio-3.com', 'client C', 0),
(4, 'Portofolio D', 'portofolio-4.jpg', 'ini adalah portofolio D', 'http://portofolio-d.com', 'Client D', 0),
(5, 'Portofolio E', 'portofolio-e.jpg', 'ini adalah portofolio E', 'http://portofolio-e.com', 'client E', 0);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `icon`, `description`, `deleted`) VALUES
(1, 'Wev Development', 'icon-globe', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua.', 0),
(2, 'Web Design', 'icon-pencil', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua.', 0),
(3, 'Web & Blog Content Management', 'icon-camera', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua.', 0),
(4, 'Seo & Promotion', 'icon-bullhorn', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua.', 0),
(5, 'Android Development', 'icon-phone', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 1),
(6, 'Ios Development', 'icon-ios', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 1),
(7, 'Java Development', 'icon-java', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE IF NOT EXISTS `sliders` (
  `slide_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `background` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`slide_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`slide_id`, `title`, `image`, `background`, `description`, `deleted`) VALUES
(1, 'Slider 1', 'slider-1.png', 'item1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', 0),
(2, 'Slider 2', 'slider-2.png', 'item2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', 0),
(3, 'Slider 3', 'slider-3.png', 'item3', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', 0),
(4, 'Slide 4', 'slide-4.jpg', 'item-2', 'Ini Adalah Slide 4', 1);

-- --------------------------------------------------------

--
-- Table structure for table `socmeds`
--

CREATE TABLE IF NOT EXISTS `socmeds` (
  `socmed_id` int(11) NOT NULL AUTO_INCREMENT,
  `socmed_name` varchar(100) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`socmed_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `socmeds`
--

INSERT INTO `socmeds` (`socmed_id`, `socmed_name`, `icon`, `url`, `deleted`) VALUES
(1, 'Facebook', 'icon-facebook', 'http://www.facebook.com/sakukode', 0),
(2, 'Twitter', 'icon-twitter', 'http://www.twitter.com/sakukode', 0),
(3, 'Google Plus', 'icon-google-plus', 'http://plus.google.com/sakukode', 0),
(4, 'Blogger', 'icon-blogger', 'http://sakukode.blogspot.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
  `team_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(70) NOT NULL,
  `job` varchar(150) NOT NULL,
  `fb_account` varchar(70) NOT NULL,
  `twitter_account` varchar(70) NOT NULL,
  `picture` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`team_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`team_id`, `firstname`, `lastname`, `email`, `job`, `fb_account`, `twitter_account`, `picture`, `description`, `deleted`) VALUES
(1, 'Rizqi', 'Maulana', 'rizqimaulana1512@gmail.com', 'Founder, Programmer & UI/UX Designer', 'https://www.facebook.com/sakukode', '', 'rizqi-maulana.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua.', 0),
(2, 'Rudi', 'Dharmawan', 'rudi.davincy@gmail.com', 'Founder, Marketing & Implementator', 'https://www.facebook.com/rudy.vincy', '', 'rudi-dharmawan.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua', 0),
(3, 'Riyadi', 'Murbeni', 'taiger_versus@yahoo.com', 'Designer UI/UX', 'http://www.facebook.com/riyadi.murbeni', '', 'beni.jpg', '', 0),
(4, 'Hyuga', 'Hinata', 'hinata@gmail.com', 'Operator', 'http://www.facebook.com/hyuga.hinata', '', 'hyuga-hinata.jpg', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `new_password_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `new_email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `new_email_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `activated`, `banned`, `ban_reason`, `new_password_key`, `new_password_requested`, `new_email`, `new_email_key`, `last_ip`, `last_login`, `created`, `modified`) VALUES
(3, 'sakukode', '$2a$08$jHkJ.7dNcEPKybCkmV2uVunPuuyGDML4GbTaevXWcZrh5lcqhwnve', 'sakukode@gmail.com', 1, 0, NULL, NULL, NULL, NULL, NULL, '127.0.0.1', '2014-08-19 10:32:16', '2014-08-11 10:13:19', '2014-08-19 08:32:16'),
(4, 'rizqi88', '$2a$08$noUZmntcnYKZM.sH5klmSejkm6624s1Roz59ekAJnnJtBukS1uxlm', 'rizqimaulana1512@gmail.com', 1, 0, NULL, NULL, NULL, NULL, NULL, '127.0.0.1', '2014-08-19 11:49:46', '2014-08-11 10:27:24', '2014-08-19 09:49:46');

-- --------------------------------------------------------

--
-- Table structure for table `user_autologin`
--

CREATE TABLE IF NOT EXISTS `user_autologin` (
  `key_id` char(32) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user_autologin`
--

INSERT INTO `user_autologin` (`key_id`, `user_id`, `user_agent`, `last_ip`, `last_login`) VALUES
('18b881050872d67e0cac4bc09b5cf90c', 3, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.125 Safari/537.36', '::1', '2014-08-14 02:48:22'),
('59767e03427e81a4b670e74afda2227b', 4, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/36.0.1985.125 Chrome/36.0.1985.125 Safari/537.36', '127.0.0.1', '2014-08-19 09:49:46');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE IF NOT EXISTS `user_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `country` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `country`, `website`) VALUES
(1, 3, NULL, NULL),
(2, 4, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
