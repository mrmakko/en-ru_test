-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2016 at 10:47 
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sample`
--

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

DROP TABLE IF EXISTS `results`;
CREATE TABLE IF NOT EXISTS `results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `result` int(11) NOT NULL,
  `result_e` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `name`, `result`, `result_e`) VALUES
(2, 'Name', 1, 0),
(3, 'asdasd', 0, 3),
(4, 'Albert Hoffman', 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `words`
--

DROP TABLE IF EXISTS `words`;
CREATE TABLE IF NOT EXISTS `words` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `word_ru` text NOT NULL,
  `word_en` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `words`
--

INSERT INTO `words` (`id`, `word_ru`, `word_en`) VALUES
(1, 'яблоко', 'apple'),
(2, 'персик', 'pear'),
(3, 'апельсин', 'orange'),
(4, 'виноград', 'grape'),
(5, 'лимон', 'lemon'),
(6, 'ананас', 'pineapple'),
(7, 'арбуз', 'watermelon'),
(8, 'кокос', 'coconut'),
(9, 'гранат', 'pomegranate'),
(10, 'вишня', 'cherry'),
(11, 'банан', 'banana'),
(12, 'помело', 'pomelo'),
(13, 'клубника', 'strawberry'),
(14, 'малина', 'raspberry'),
(15, 'дыня', 'melon'),
(16, 'абрикос', 'apricot'),
(17, 'манго', 'mango');

-- --------------------------------------------------------

--
-- Table structure for table `wrong_answers`
--

DROP TABLE IF EXISTS `wrong_answers`;
CREATE TABLE IF NOT EXISTS `wrong_answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `word_ru` text NOT NULL,
  `word_en` text NOT NULL,
  `count` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wrong_answers`
--

INSERT INTO `wrong_answers` (`id`, `word_ru`, `word_en`, `count`) VALUES
(1, 'апельсин', 'grape', 5),
(2, 'персик', 'grape', 1),
(3, 'яблоко', 'grape', 2),
(4, 'виноград', 'apple', 2),
(5, 'персик', 'orange', 4),
(6, 'апельсин', 'pineapple', 1),
(7, 'яблоко', 'cherry', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
