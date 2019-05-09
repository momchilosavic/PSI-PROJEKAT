-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 08, 2019 at 03:55 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

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
  `zbir_ocena` int(11) DEFAULT 0,
  `broj_ocena` int(11) DEFAULT 0,
  `datum_registracije` datetime NOT NULL,
  `datum_poslednje_prijave` datetime DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


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

--
-- Dumping data for table `ocena`
--

INSERT INTO `ocena` (`IDTermin`, `username_ocenjeni`, `username_ocenjivac`, `ocena`, `razlog`, `datum_ocenjivanja`) VALUES
(4, 'testtest', 'momcilo', 4, 'asd', '2019-05-08 14:28:03');

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



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

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
