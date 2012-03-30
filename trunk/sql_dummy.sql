-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 30, 2012 at 04:57 PM
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
  `ID_ACHIEVEMENT` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA` varchar(45) DEFAULT NULL,
  `GAMBAR` text NOT NULL,
  `DESKRIPSI` text NOT NULL,
  PRIMARY KEY (`ID_ACHIEVEMENT`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE IF NOT EXISTS `komentar` (
  `ID_KONTEN` int(11) DEFAULT NULL,
  `ISI` text,
  `WAKTU` datetime DEFAULT NULL,
  `ID_USER` int(11) DEFAULT NULL,
  `ID_KOMENTAR` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID_KOMENTAR`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

-- --------------------------------------------------------

--
-- Table structure for table `konten`
--

CREATE TABLE IF NOT EXISTS `konten` (
  `ID_KONTEN` int(11) NOT NULL AUTO_INCREMENT,
  `ID_USER` int(11) DEFAULT NULL,
  `ID_TYPE` int(11) DEFAULT NULL,
  `WAKTU` datetime DEFAULT NULL,
  `JUDUL` varchar(45) DEFAULT NULL,
  `LINK` text,
  `DESKRIPSI` text,
  PRIMARY KEY (`ID_KONTEN`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

-- --------------------------------------------------------

--
-- Table structure for table `konten_tag`
--

CREATE TABLE IF NOT EXISTS `konten_tag` (
  `ID_KONTEN` int(11) NOT NULL,
  `ID_TAG` int(11) NOT NULL,
  PRIMARY KEY (`ID_KONTEN`,`ID_TAG`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `konten_view`
--

CREATE TABLE IF NOT EXISTS `konten_view` (
  `ID_KONTEN` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  PRIMARY KEY (`ID_KONTEN`,`ID_USER`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `like_dislike`
--

CREATE TABLE IF NOT EXISTS `like_dislike` (
  `ID_KONTEN` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `STATUS` enum('LIKE','DISLIKE') DEFAULT NULL,
  PRIMARY KEY (`ID_KONTEN`,`ID_USER`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `ID_FROM` int(11) NOT NULL,
  `ID_TO` int(11) NOT NULL,
  `ISI` text NOT NULL,
  `WAKTU` datetime NOT NULL,
  `ID_MESSAGE` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID_MESSAGE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `narcism`
--

CREATE TABLE IF NOT EXISTS `narcism` (
  `ID_USER` int(11) NOT NULL,
  `CHANGE_PICTURE` int(11) NOT NULL,
  PRIMARY KEY (`ID_USER`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `ID_TAG` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_TAG` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID_TAG`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `ID_TYPE` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_TYPE` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID_TYPE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID_USER` int(11) NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(45) DEFAULT NULL,
  `PASSWORD` varchar(45) DEFAULT NULL,
  `NAMA` varchar(45) DEFAULT NULL,
  `TGL_LAHIR` date DEFAULT NULL,
  `EMAIL` text,
  `AVATAR` text,
  `GENDER` enum('LAKI','PEREMPUAN') DEFAULT NULL,
  `ABOUT_ME` text,
  `STATUS` enum('SINGLE','IN RELATIONSHIP','MARRIED') DEFAULT NULL,
  PRIMARY KEY (`ID_USER`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_achievement`
--

CREATE TABLE IF NOT EXISTS `user_achievement` (
  `ID_USER` int(11) NOT NULL,
  `ID_ACHIEVEMENT` int(11) NOT NULL,
  PRIMARY KEY (`ID_USER`,`ID_ACHIEVEMENT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
