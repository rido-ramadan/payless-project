-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 24, 2012 at 07:26 PM
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

--
-- Dumping data for table `achievement`
--

INSERT INTO `achievement` (`ID_ACHIEVEMENT`, `NAMA`, `GAMBAR`, `DESKRIPSI`) VALUES
(1, 'HelloWorld~~', '', 'Selamat!!! Anda telah melakukan post pertama Anda.. Keep up the good post!'),
(2, 'quality or quantity??', '', 'Wawww!! Anda sudah ngepost 10 konten... Kualitas atau kuantitas??'),
(3, 'Spik!!', '', 'Selamat!! Anda pertama kali berkomentar.. Anda bisa belajar spik sekarang..'),
(4, 'il comentatore', '', 'Anda sudah berkomentar sebanyak 20 buah. Anda seorang Il Comentatore sejati!!!'),
(5, 'ser querido', '', '100 orang menyukai post Anda!!! Your post is ser querido :D'),
(6, 'Bata lovers?', '', '100 orang tdak menyukai post Anda!! Anda pecinta bata?'),
(7, 'Junked???', '', 'Konten Anda sudah pernah dikomentari sebanyak 50 kali.. Nyampahkah?? Tapi, Selamat!!!'),
(8, 'Achievement Hunter!!', '', '3 Achievement sudah ditaklukan!! Tapi, perjalan masih panjang. Semangat!'),
(9, 'Ultimate Achievement', '', 'Luar Biasa! Anda berhasil mengumpulkan semua Achievement! Anda berhak mendapatkan Ultimate Achievement ini.'),
(10, 'al4y', '', 'Anda menggabungkan angka dan huruf dalam Username. Anda seorang 4l@y?? Btw, s3lama7!!!!'),
(11, 'narcism...', '', '3 kali ganti profil picture, narsis sekaliii :D'),
(12, 'I''ve moved on', '', 'Selamat, anda telah melanjutkan hidup Anda. Selamat berbahagia dengan pasangan yang baru!!!');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`ID_KONTEN`, `ISI`, `WAKTU`, `ID_USER`, `ID_KOMENTAR`) VALUES
(1, 'Artikelnya kurang bagus nih', '2012-02-09 00:00:00', 2, 1),
(2, 'Ini artikelnya lumayan', '2012-04-03 00:00:00', 1, 2),
(3, 'Kasep pisan maneh fi', '2012-03-22 00:00:00', 2, 3),
(4, 'Itu kenapa gak sekalian penjara seumur hidup aja ya??', '2012-03-22 00:00:00', 5, 4),
(5, 'Galau pisan maneh ci,hahaha', '2012-03-22 00:00:00', 3, 5),
(3, 'Ini waktu maneh jaman kapan fi?hahaha', '2012-03-22 00:00:00', 5, 6),
(5, 'Ini lagu waktu dia baru keluar dari penjara ya??', '2012-03-22 00:00:00', 4, 7);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `konten`
--

INSERT INTO `konten` (`ID_KONTEN`, `ID_USER`, `ID_TYPE`, `WAKTU`, `JUDUL`, `LINK`, `DESKRIPSI`) VALUES
(1, 1, 1, '2012-04-14 00:00:00', 'ARTIKELPERTAMA', 'http://facebook.com', 'ini adalah situs facebook'),
(2, 2, 1, '2012-04-12 00:00:00', 'Artikel Kedua', 'http://gmail.com', 'ini email loh'),
(3, 4, 2, '2012-03-22 00:00:00', 'My Other Self', 'http://www.facebook.com/photo.php?\r\n\r\nfbid=1027560058407&set=a.1416012209468.2059551.1507486374&t\r\n\r\nype=3', 'Profil Picture urang :DD'),
(4, 3, 1, '2012-03-22 00:00:00', 'Hukuman ''mati''', 'http://uk.news.yahoo.com/soldiers-jailed-7-600-years-\r\n\r\nover-massacre-042632517.html', 'Artikel tentang 5 prajurit yang dihukum penjara 7.600 tahun.'),
(5, 5, 3, '2012-03-22 00:00:00', 'Sedang Apa dan Dimana - Sammy Simorangkir', 'http://www.youtube.com/watch?v=g5t1rt_becM', 'Official Video Sammy Simorangkir - Sedang Apa dan Dimana');

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
(2, 2),
(3, 4),
(4, 4),
(5, 3),
(5, 4);

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

--
-- Dumping data for table `like_dislike`
--

INSERT INTO `like_dislike` (`ID_KONTEN`, `ID_USER`, `STATUS`) VALUES
(1, 2, 'DISLIKE'),
(1, 3, 'DISLIKE'),
(2, 1, 'LIKE'),
(2, 2, 'LIKE'),
(3, 3, 'DISLIKE'),
(3, 4, 'LIKE'),
(3, 5, 'LIKE'),
(5, 4, 'LIKE');

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `ID_TAG` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_TAG` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID_TAG`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`ID_TAG`, `NAMA_TAG`) VALUES
(1, 'Application'),
(2, 'Desktop'),
(3, 'Entertainment'),
(4, 'Life');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `ID_TYPE` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_TYPE` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID_TYPE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID_USER`, `USERNAME`, `PASSWORD`, `NAMA`, `TGL_LAHIR`, `EMAIL`, `AVATAR`, `GENDER`, `ABOUT_ME`, `STATUS`) VALUES
(1, 'doni', 'doni', 'Doni Ramadhan', '2012-03-16', 'doni@mail.com', NULL, 'LAKI', 'saya adalah doni, perkenalkan', 'SINGLE'),
(2, 'rina', 'rina', 'Rina Herawati', '2012-01-30', 'rina@hera.com', NULL, 'PEREMPUAN', 'saya adalah rina, kenalin', 'SINGLE'),
(3, 'rido.ramadan', 'ramadanrido', 'Rido Ramadan', '1991-03-20', 'rido.ramadan.ipa1@gmail.com', 'AvatarRido', 'LAKI', 'Nobody is Perfect\r\nI am Nobody\r\nI am Perfect.....?', 'SINGLE'),
(4, 'aphie3_uciha', 'uchihasasuke', 'Alfian Ramadan', '1993-03-16', 'aphie3_uciha@yahoo.co.id', 'Avatar Alfian', 'LAKI', 'Desktop, Web, Mobile Programmer. http://www.masphei.ungu.com/', 'SINGLE'),
(5, 'marchy_gab3', '08031992', 'Marchy Tio Pandapotan', '1992-03-08', 'marchy_gab3@yahoo.com', 'Avatar Marchy', 'LAKI', 'automotive-enthusiast, adventurer, humorist, and healthy man :D.\r\n', 'SINGLE'),
(6, 'timo55', 'safeitimotius', 'Timotius Triputra S.', '1990-12-02', 'timo55@yahoo.com', 'Avatar timo', 'LAKI', 'never do today what u can do tomorrow [T_m_5]', 'SINGLE'),
(7, 'aribowo93', 'bowbowlaksono', 'Trilaksono Aribowo', '1993-12-19', 'aribowo93@gmail.com', 'Avatar Ari', 'LAKI', 'jago main gitar klasik, suka ikut kepanitiaan, Ketua Departemen Eksternal Sosial HMIF 2012/2013', 'SINGLE'),
(8, 'sundaripurnamasari', 'megamegamega', 'Sundari Mega Purnamasari', '1991-05-10', 'mega1991@gmail.com', 'avatar sume', 'PEREMPUAN', 'saman dance lover and teacher', 'SINGLE');

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
