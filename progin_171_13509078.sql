-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 21, 2012 at 04:25 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `progin_171_13509078`
--

-- --------------------------------------------------------

--
-- Table structure for table `achievement`
--

CREATE TABLE IF NOT EXISTS `achievement` (
  `ID_ACHIEVEMENT` int(11) NOT NULL,
  `NAMA` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID_ACHIEVEMENT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `achievement`
--

INSERT INTO `achievement` (`ID_ACHIEVEMENT`, `NAMA`) VALUES
(1, 'Newbie'),
(2, 'Hercules');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE IF NOT EXISTS `komentar` (
  `ID_KONTEN` int(11) DEFAULT NULL,
  `ISI` text,
  `TANGGAL` date DEFAULT NULL,
  `JAM` time DEFAULT NULL,
  `ID_USER` int(11) DEFAULT NULL,
  `ID_KOMENTAR` int(11) NOT NULL,
  PRIMARY KEY (`ID_KOMENTAR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`ID_KONTEN`, `ISI`, `TANGGAL`, `JAM`, `ID_USER`, `ID_KOMENTAR`) VALUES
(1, 'Artikelnya kurang bagus nih', '2012-02-09', '08:09:00', 2, 1),
(2, 'Ini artikelnya lumayan', '2012-04-03', '08:29:00', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `konten`
--

CREATE TABLE IF NOT EXISTS `konten` (
  `ID_KONTEN` int(11) NOT NULL,
  `ID_USER` int(11) DEFAULT NULL,
  `ID_TYPE` int(11) DEFAULT NULL,
  `TANGGAL` date DEFAULT NULL,
  `JAM` time DEFAULT NULL,
  `JUDUL` varchar(45) DEFAULT NULL,
  `LINK` text,
  `DESKRIPSI` text,
  PRIMARY KEY (`ID_KONTEN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konten`
--

INSERT INTO `konten` (`ID_KONTEN`, `ID_USER`, `ID_TYPE`, `TANGGAL`, `JAM`, `JUDUL`, `LINK`, `DESKRIPSI`) VALUES
(1, 1, 1, '2012-04-14', '08:00:00', 'ARTIKELPERTAMA', 'http://facebook.com', 'ini adalah situs facebook'),
(2, 2, 1, '2012-04-12', '09:00:00', 'Artikel Kedua', 'http://gmail.com', 'ini email loh');

-- --------------------------------------------------------

--
-- Table structure for table `konten_tag`
--

CREATE TABLE IF NOT EXISTS `konten_tag` (
  `ID_KONTEN` int(11) NOT NULL,
  `ID_TAG` int(11) NOT NULL,
  PRIMARY KEY (`ID_KONTEN`,`ID_TAG`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konten_tag`
--

INSERT INTO `konten_tag` (`ID_KONTEN`, `ID_TAG`) VALUES
(1, 1),
(1, 2),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `like_dislike`
--

CREATE TABLE IF NOT EXISTS `like_dislike` (
  `ID_KONTEN` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `LIKE` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID_KONTEN`,`ID_USER`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `like_dislike`
--

INSERT INTO `like_dislike` (`ID_KONTEN`, `ID_USER`, `LIKE`) VALUES
(1, 2, 0),
(2, 1, 1),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `ID_TAG` int(11) NOT NULL,
  `NAMA_TAG` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID_TAG`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`ID_TAG`, `NAMA_TAG`) VALUES
(1, 'Application'),
(2, 'Desktop');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `ID_TYPE` int(11) NOT NULL,
  `NAMA_TYPE` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID_TYPE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`ID_TYPE`, `NAMA_TYPE`) VALUES
(1, 'LINK'),
(2, 'IMAGE'),
(3, 'VIDEO');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID_USER` int(11) NOT NULL,
  `USERNAME` varchar(45) DEFAULT NULL,
  `PASSWORD` varchar(45) DEFAULT NULL,
  `NAMA` varchar(45) DEFAULT NULL,
  `TGL_LAHIR` date DEFAULT NULL,
  `EMAIL` text,
  `AVATAR` text,
  `GENDER` enum('LAKI','PEREMPUAN') DEFAULT NULL,
  `ABOUT_ME` text,
  PRIMARY KEY (`ID_USER`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID_USER`, `USERNAME`, `PASSWORD`, `NAMA`, `TGL_LAHIR`, `EMAIL`, `AVATAR`, `GENDER`, `ABOUT_ME`) VALUES
(1, 'doni', 'doni', 'Doni Ramadhan', '2012-03-16', 'doni@mail.com', NULL, 'LAKI', 'saya adalah doni, perkenalkan'),
(2, 'rina', 'rina', 'Rina Herawati', '2012-01-30', 'rina@hera.com', NULL, 'PEREMPUAN', 'saya adalah rina, kenalin');

-- --------------------------------------------------------

--
-- Table structure for table `user_achievement`
--

CREATE TABLE IF NOT EXISTS `user_achievement` (
  `ID_USER` int(11) NOT NULL,
  `ID_ACHIEVEMENT` int(11) NOT NULL,
  PRIMARY KEY (`ID_USER`,`ID_ACHIEVEMENT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_achievement`
--

INSERT INTO `user_achievement` (`ID_USER`, `ID_ACHIEVEMENT`) VALUES
(1, 1),
(1, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
