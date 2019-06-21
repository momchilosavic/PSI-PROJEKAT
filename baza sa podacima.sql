-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 21, 2019 at 04:48 PM
-- Server version: 5.7.24
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trebamiigrac`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
CREATE TABLE IF NOT EXISTS `korisnik` (
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `grupa` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `zbir_ocena` int(11) DEFAULT '0',
  `broj_ocena` int(11) DEFAULT '0',
  `datum_registracije` datetime NOT NULL,
  `datum_poslednje_prijave` datetime DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`username`, `password`, `email`, `grupa`, `zbir_ocena`, `broj_ocena`, `datum_registracije`, `datum_poslednje_prijave`) VALUES
('vip', '$2y$10$IosX/v3TwIJ1pwfcIyTEpuP7aWT.j.lJ0ueXrvo1isUKaZGk8b1Me', 'v@v', 'V', 0, 0, '2019-06-21 15:22:32', '2019-06-21 16:35:04'),
('korisnik2', '$2y$10$SDwI2sCFuRUgafDZTzHAqe9GzLCJCPB1fvta5rOrRFsrdBTQOzaya', 'k@k2', 'R', 0, 0, '2019-06-21 15:20:36', '2019-06-21 15:20:36'),
('korisnik', '$2y$10$5WXgeSfA/rsxRUYMCqfC1up1R/Zc6Ri2hvM.0p1T08Z1nBp3Sm5AK', 'k@k', 'R', 0, 0, '2019-06-21 15:19:03', '2019-06-21 15:26:55'),
('test', '$2y$10$wVrpOb9kGHjSrkZeaGcDRu6vmqMX20DuS16dFYFTM7GZctjbtAxAW', 't@t.t', 'R', 0, 0, '2019-06-21 15:12:47', '2019-06-21 16:01:58'),
('momchilo', '$2y$10$EwELWlt/pkkUshvUfbSlgeUxWQ6Wtl2e1HlLU7bt4NDzkBWXHCrqa', 'momcilo.savic@hotmail.com', 'A', 0, 0, '2019-05-30 16:52:05', '2019-06-21 16:37:12'),
('banujme', '$2y$10$382YyBidt9oli3XW65M4xeCIsD9EeXiLXWZzHUBkEPw2FjSp.Fm4q', 'b@b', 'B', 0, 0, '2019-06-21 16:36:41', '2019-06-21 16:36:41');

-- --------------------------------------------------------

--
-- Table structure for table `ocena`
--

DROP TABLE IF EXISTS `ocena`;
CREATE TABLE IF NOT EXISTS `ocena` (
  `IDTermin` int(11) NOT NULL,
  `username_ocenjeni` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `username_ocenjivac` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ocena` int(11) NOT NULL,
  `razlog` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `datum_ocenjivanja` datetime NOT NULL,
  PRIMARY KEY (`IDTermin`,`username_ocenjeni`,`username_ocenjivac`),
  KEY `R_5` (`username_ocenjeni`),
  KEY `R_6` (`username_ocenjivac`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sportski_objekat`
--

DROP TABLE IF EXISTS `sportski_objekat`;
CREATE TABLE IF NOT EXISTS `sportski_objekat` (
  `IDObjekat` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `adresa` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `veb_sajt` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slika` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `datum_reklamiranja` datetime NOT NULL,
  PRIMARY KEY (`IDObjekat`),
  KEY `R_7` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sportski_objekat`
--

INSERT INTO `sportski_objekat` (`IDObjekat`, `naziv`, `adresa`, `veb_sajt`, `slika`, `username`, `datum_reklamiranja`) VALUES
(12, 'a', 'a', 'a', 'indoor-basketball.jpg', 'momchilo', '2019-06-07 18:17:56'),
(13, 'reklama2', 'adresa2', 'sajt2', 'indoor-football.jpg', 'vip', '2019-06-21 15:45:56');

-- --------------------------------------------------------

--
-- Table structure for table `termin`
--

DROP TABLE IF EXISTS `termin`;
CREATE TABLE IF NOT EXISTS `termin` (
  `IDTermin` int(11) NOT NULL AUTO_INCREMENT,
  `naslov` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `sport` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `adresa` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `datum` datetime NOT NULL,
  `cena` int(11) NOT NULL,
  `broj_potrebnih_igraca` int(11) NOT NULL,
  `broj_prijavljenih_igraca` int(11) NOT NULL DEFAULT '0',
  `opis` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ocena` float DEFAULT NULL,
  `datum_kreiranja` datetime NOT NULL,
  PRIMARY KEY (`IDTermin`),
  KEY `R_1` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `termin`
--

INSERT INTO `termin` (`IDTermin`, `naslov`, `sport`, `adresa`, `datum`, `cena`, `broj_potrebnih_igraca`, `broj_prijavljenih_igraca`, `opis`, `username`, `ocena`, `datum_kreiranja`) VALUES
(21, 'fali 1', 'fudbal', 'asdra', '2019-07-01 12:59:00', 123, 1, 1, '1 fali', 'vip', 0, '2019-06-21 15:24:21'),
(20, 'Na travi', 'fudbal', 'asdasdjasnd', '2019-06-22 16:45:00', 250, 1, 0, 'opis', 'vip', 0, '2019-06-21 15:23:55'),
(17, 'Basket', 'kosarka', 'adresa test', '2019-06-29 12:59:00', 420, 3, 0, 'Fale nam 3 igraca', 'test', 0, '2019-06-21 15:16:59'),
(18, 'Mali fudbal', 'fudbal', 'adresa', '2019-07-01 16:00:00', 400, 5, 0, '2 ekipe po 5 igraca   izmene', 'test', 0, '2019-06-21 15:17:50'),
(19, 'Ozbiljan fudbal', 'fudbal', 'adrsa balona', '2019-06-21 20:59:00', 320, 3, 0, '5 na 5', 'korisnik', 0, '2019-06-21 15:20:04'),
(16, 'Basket 3x3 3 ekipe', 'kosarka', 'adresa nekog kosarkaskog objekta', '2019-06-23 20:00:00', 350, 4, 1, 'Fale nam 4 igraca... dobar basket...', 'test', 0, '2019-06-21 15:15:46');

-- --------------------------------------------------------

--
-- Table structure for table `zahtev`
--

DROP TABLE IF EXISTS `zahtev`;
CREATE TABLE IF NOT EXISTS `zahtev` (
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `IDTermin` int(11) NOT NULL,
  `odgovor` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `datum_zahteva` datetime NOT NULL,
  `datum_odgovora` datetime DEFAULT NULL,
  PRIMARY KEY (`username`,`IDTermin`),
  KEY `R_3` (`IDTermin`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `zahtev`
--

INSERT INTO `zahtev` (`username`, `IDTermin`, `odgovor`, `datum_zahteva`, `datum_odgovora`) VALUES
('korisnik2', 19, NULL, '2019-06-21 15:20:43', NULL),
('korisnik2', 16, 'P', '2019-06-21 15:20:50', '2019-06-21 15:22:00'),
('test', 19, NULL, '2019-06-21 15:21:48', NULL),
('vip', 19, NULL, '2019-06-21 15:22:44', NULL),
('vip', 16, NULL, '2019-06-21 15:22:49', NULL),
('momchilo', 21, 'P', '2019-06-21 15:44:33', '2019-06-21 16:30:05'),
('test', 21, 'O', '2019-06-21 15:26:15', '2019-06-21 16:30:05');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
