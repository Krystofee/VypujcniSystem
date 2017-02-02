-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Počítač: localhost
-- Vygenerováno: Pát 27. led 2017, 07:24
-- Verze serveru: 5.6.14
-- Verze PHP: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáze: `EshopSmluv`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `aktuality`
--

CREATE TABLE IF NOT EXISTS `aktuality` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `description` text COLLATE cp1250_czech_cs NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1250 COLLATE=cp1250_czech_cs AUTO_INCREMENT=3 ;

--
-- Vypisuji data pro tabulku `aktuality`
--

INSERT INTO `aktuality` (`id`, `description`, `time`) VALUES
(1, 'Dne 29.6.1998 proběhne údržba serveru. Přihlašovací servery budou nedostupné po dobu 18 let.', '2017-01-25 14:41:24'),
(2, 'Poté se narodil kristuspán ... ', '2017-01-25 14:41:37');

-- --------------------------------------------------------

--
-- Struktura tabulky `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE cp1250_czech_cs NOT NULL,
  `parent_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1250 COLLATE=cp1250_czech_cs AUTO_INCREMENT=34 ;

--
-- Vypisuji data pro tabulku `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`) VALUES
(1, 'Harddisky', 0),
(2, 'Mikrofony', 0),
(3, 'Fotoaparáty', 0),
(4, 'Zrcadlovky', 3),
(5, 'Digitály', 3),
(29, '< 1 TB', 1),
(30, '> 1 TB', 1),
(31, 'Nějaké shitky', 1),
(32, '= 1 TB :)', 29),
(33, 'Veeeelky mikrofon!', 2);

-- --------------------------------------------------------

--
-- Struktura tabulky `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE cp1250_czech_cs NOT NULL,
  `description` text COLLATE cp1250_czech_cs NOT NULL,
  `evc` varchar(30) COLLATE cp1250_czech_cs NOT NULL,
  `category_id` int(5) NOT NULL,
  `tags_id` varchar(200) COLLATE cp1250_czech_cs NOT NULL,
  `ordered` text COLLATE cp1250_czech_cs NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1250 COLLATE=cp1250_czech_cs AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `metadata`
--

CREATE TABLE IF NOT EXISTS `metadata` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_bin NOT NULL,
  `value` mediumtext COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;

--
-- Vypisuji data pro tabulku `metadata`
--

INSERT INTO `metadata` (`id`, `name`, `value`) VALUES
(1, 'project_name', 'Vypůjční systém'),
(2, 'version', '0.1'),
(5, 'motto', '... eshop alá pujč si mne (Fusselroller)'),
(6, 'author', 'Krystofee'),
(7, 'description', 'Vypůjční systém pro žáky a zaměstnance Slezské Univerzity, Filozoficko-přírodovědecké fakulty v Opavě.');

-- --------------------------------------------------------

--
-- Struktura tabulky `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `items_id` text COLLATE cp1250_czech_cs NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1250 COLLATE=cp1250_czech_cs AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE cp1250_czech_cs NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1250 COLLATE=cp1250_czech_cs AUTO_INCREMENT=5 ;

--
-- Vypisuji data pro tabulku `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(1, 'mic'),
(2, 'microphone'),
(3, 'mikrofón'),
(4, 'majkrofoun');

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET latin1 NOT NULL,
  `password` varchar(40) CHARACTER SET latin1 NOT NULL COMMENT '40 chars podle SHA1',
  `email` varchar(30) CHARACTER SET latin1 NOT NULL,
  `birth` date NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` timestamp NULL DEFAULT NULL,
  `type` varchar(10) COLLATE cp1250_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`,`email`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1250 COLLATE=cp1250_bin AUTO_INCREMENT=6 ;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `birth`, `created`, `last_login`, `type`) VALUES
(1, 'krystofee', '5ae35f9815d13f44b14fb96de9241108db126a63', 'krystofee@gmail.com', '1998-06-29', '2017-01-02 16:35:57', NULL, 'user'),
(4, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'krystofee@gmail.comf', '2001-11-18', '2017-01-02 16:45:54', NULL, 'admin'),
(5, 'testuser', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'test@mail.com', '2001-11-19', '2017-01-19 13:21:28', NULL, 'user');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
