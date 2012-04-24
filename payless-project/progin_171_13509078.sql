-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 25, 2012 at 02:06 AM
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
(1, 'HelloWorld~~', 'hello_world.png', 'Selamat!!! Anda telah melakukan post pertama Anda.. Keep up the good post!'),
(2, 'quality or quantity??', 'quality_or_quantity.png', 'Wawww!! Anda sudah ngepost 10 konten... Kualitas atau kuantitas??'),
(3, 'Spik!!', 'spik.png', 'Selamat!! Anda pertama kali berkomentar.. Anda bisa belajar spik sekarang..'),
(4, 'il comentatore', 'il_comentatore.png', 'Anda sudah berkomentar sebanyak 20 buah. Anda seorang Il Comentatore sejati!!!'),
(5, 'ser querido', 'ser_querido.png', '100 orang menyukai post Anda!!! Your post is ser querido :D'),
(6, 'Bata lovers?', 'bata_lover.png', '100 orang tdak menyukai post Anda!! Anda pecinta bata?'),
(7, 'Junked???', 'junked.png', 'Konten Anda sudah pernah dikomentari sebanyak 50 kali.. Nyampahkah?? Tapi, Selamat!!!'),
(8, 'Achievement Hunter!!', 'achievement_hunter.png', '3 Achievement sudah ditaklukan!! Tapi, perjalan masih panjang. Semangat!'),
(9, 'Ultimate Achievement', 'ultimate_achievement.png', 'Luar Biasa! Anda berhasil mengumpulkan semua Achievement! Anda berhak mendapatkan Ultimate Achievement ini.'),
(10, 'al4y', 'alay.png', 'Anda menggabungkan angka dan huruf dalam Username. Anda seorang 4l@y?? Btw, s3lama7!!!!'),
(11, 'narcism...', 'narcism.png', '3 kali ganti profil picture, narsis sekaliii :D'),
(12, 'I''ve moved on', 'i_ve_moved_on.png', 'Selamat, anda telah melanjutkan hidup Anda. Selamat berbahagia dengan pasangan yang baru!!!');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`ID_KONTEN`, `ISI`, `WAKTU`, `ID_USER`, `ID_KOMENTAR`) VALUES
(64, 'ascdasd', '2012-03-30 22:23:47', 1, 64),
(2, 'sadf', '2012-03-30 23:59:17', 1, 65),
(2, 'sadf', '2012-03-30 23:59:19', 1, 66);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=82 ;

--
-- Dumping data for table `konten`
--

INSERT INTO `konten` (`ID_KONTEN`, `ID_USER`, `ID_TYPE`, `WAKTU`, `JUDUL`, `LINK`, `DESKRIPSI`) VALUES
(41, 1, 1, '2012-03-25 14:27:04', 'asd', 'http://www.video.com', 'asd'),
(42, 1, 1, '2012-03-25 14:27:26', 'asd', 'http://www.video.com', 'asd'),
(43, 1, 1, '2012-03-25 14:27:33', 'asd', 'http://www.video.com', 'asd'),
(44, 1, 1, '2012-03-25 14:27:38', 'asd', 'http://www.video.com', 'asd'),
(45, 1, 1, '2012-03-25 14:28:04', 'asd', 'http://www.video.com', 'asd'),
(46, 1, 1, '2012-03-25 14:28:39', 'asd', 'http://www.video.com', 'asd'),
(47, 1, 1, '2012-03-25 14:28:49', 'asd', 'http://www.video.com', 'asd'),
(48, 1, 1, '2012-03-25 14:29:36', 'ini', 'http://www.senggang.com', 'asd'),
(49, 1, 1, '2012-03-25 14:29:44', 'contoh', 'http://www.senggang.com', 'asd'),
(50, 1, 1, '2012-03-25 14:46:19', 'judul', 'http://www.video.com', 'asd'),
(51, 1, 1, '2012-03-25 14:49:01', 'judul', 'http://www.video.com', 'asd'),
(52, 1, 1, '2012-03-25 14:50:29', 'asd', 'http://www.video.com', 'asd'),
(53, 1, 1, '2012-03-25 14:50:51', 'asd', 'http://www.senggang.com', 'asd'),
(54, 1, 1, '2012-03-26 21:57:42', 'asdf', 'http://www.youtube.com/watch?', 'asd'),
(55, 1, 1, '2012-03-27 01:03:45', 'asd', 'http://www.youtube.com/watch?', 'sad'),
(56, 1, 1, '2012-03-27 01:04:24', 'dsad', 'http://www.youtube.com/watch?', 'sda'),
(57, 1, 1, '2012-03-27 18:27:28', 'dsad', 'http://www.youtube.com/watch?', 'sda'),
(58, 1, 1, '2012-03-28 02:29:02', '12asd', 'http://www.youtube.com/watch?', 'asd'),
(59, 1, 1, '2012-03-28 02:29:10', '12asd', 'http://www.youtube.com/watch?', 'asd'),
(60, 1, 1, '2012-03-28 02:29:46', '12wd', 'http://www.youtube.com/watch?', 'asd'),
(61, 1, 1, '2012-03-28 02:30:26', 'asd', 'http://www.youtube.com/watch?', 'asd'),
(62, 1, 1, '2012-03-28 02:49:47', 'asd', 'http://www.youtube.com/watch?', 'asd'),
(63, 1, 3, '2012-03-29 10:42:07', 'asd', 'http://www.youtube.com/embed/VDjOzwFf1Mg', ''),
(64, 1, 1, '2012-03-30 18:55:53', 'asdasd', 'http://www.senggang.com', 'asd'),
(65, 1, 2, '2012-03-30 19:34:14', 'asdsad', 'bg_header.jpg', ''),
(66, 1, 1, '2012-03-30 19:36:33', 'asdasd', '', 'asdad'),
(67, 1, 1, '2012-03-30 19:36:40', 'asdasd', 'http://www.asdasd.com', 'asdad'),
(68, 1, 3, '2012-03-30 19:37:17', 'assd', 'http://www.youtube.com/embed/ZzDm2vMHabE', ''),
(69, 14, 1, '2012-03-30 21:41:12', 'asdas', 'http://www.asdasd.com', 'asd'),
(70, 14, 1, '2012-03-30 21:42:58', 'asdasd', 'http://www.asdasd.com', 'asd'),
(71, 14, 1, '2012-03-30 21:43:48', 'asda', 'http://www.asdasd.com', 'asd'),
(72, 14, 1, '2012-03-30 21:43:59', 'asdas', 'http://www.asdasd.com', 'asd'),
(73, 14, 1, '2012-03-30 21:44:21', 'asd', 'http://www.asdasd.com', 'asd'),
(74, 17, 1, '2012-03-31 01:04:53', 'asd', 'http://www.asdasd.com', 'asdasd'),
(75, 17, 1, '2012-03-31 01:09:06', 'asd', 'http://www.asdasd.com', 'asd'),
(76, 1, 1, '2012-03-31 01:10:24', 'asd', 'http://www.asdasd.com', 'asda'),
(77, 1, 1, '2012-03-31 01:22:41', 'INI BARU', 'http://www.asdasd.com', 'asdasd'),
(78, 1, 1, '2012-03-31 01:27:17', 'ljhblkj', 'http://www.sesuatu.com', 'j,hg'),
(79, 1, 1, '2012-03-31 01:28:38', 'HAHAHAH', 'http://www.asdasd.com', 'sadads'),
(80, 12, 3, '2012-04-03 09:00:42', 'Contoh', 'http://www.youtube.com/embed/VDjOzwFf1Mg', ''),
(81, 12, 2, '2012-04-03 12:21:17', 'asd', 'bg_header.jpg', '');

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
(59, 5),
(60, 5),
(61, 5),
(62, 5),
(63, 5),
(64, 5),
(65, 5),
(66, 5),
(67, 5),
(68, 5),
(69, 5),
(70, 5),
(71, 5),
(72, 5),
(73, 5),
(74, 5),
(75, 5),
(76, 5),
(77, 5),
(78, 5),
(79, 5),
(80, 5),
(81, 5);

-- --------------------------------------------------------

--
-- Table structure for table `konten_view`
--

CREATE TABLE IF NOT EXISTS `konten_view` (
  `ID_KONTEN` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  PRIMARY KEY (`ID_KONTEN`,`ID_USER`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konten_view`
--

INSERT INTO `konten_view` (`ID_KONTEN`, `ID_USER`) VALUES
(80, 12),
(81, 12);

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
(79, 12, 'LIKE');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`ID_FROM`, `ID_TO`, `ISI`, `WAKTU`, `ID_MESSAGE`) VALUES
(1, 2, 'HAHAHAHA', '2012-03-22 21:55:10', 1),
(2, 1, 'asdasdas', '2012-03-22 22:11:53', 2),
(3, 1, 'HJMMMMM', '2012-03-23 22:26:41', 3),
(1, 3, 'HJMMMMM', '2012-03-23 22:26:41', 4),
(1, 2, 'asd', '1111-11-11 08:00:00', 5),
(1, 2, 'asfsdafsdfacvx', '2012-03-30 23:51:31', 6),
(12, 1, 'WOOOOOOOOOOOOIIIIIIIIIIIIIIIIIIIIIII', '2012-03-30 23:52:07', 7),
(12, 1, 'hoi', '2012-04-03 09:01:38', 8);

-- --------------------------------------------------------

--
-- Table structure for table `narcism`
--

CREATE TABLE IF NOT EXISTS `narcism` (
  `ID_USER` int(11) NOT NULL,
  `CHANGE_PICTURE` int(11) NOT NULL,
  PRIMARY KEY (`ID_USER`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `narcism`
--

INSERT INTO `narcism` (`ID_USER`, `CHANGE_PICTURE`) VALUES
(1, 3),
(14, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `ID_TAG` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_TAG` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID_TAG`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`ID_TAG`, `NAMA_TAG`) VALUES
(1, 'Application'),
(2, 'Desktop'),
(3, 'Entertainment'),
(4, 'Life'),
(5, 'uncategorized'),
(6, 'menarik'),
(7, 'cerdas'),
(8, 'sehat'),
(9, 'bermanfaat'),
(10, 'keren'),
(11, 'pokonya bagus'),
(12, 'asik'),
(13, 'haha'),
(14, 'belajar'),
(15, 'belajar'),
(16, 'rajin');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID_USER`, `USERNAME`, `PASSWORD`, `NAMA`, `TGL_LAHIR`, `EMAIL`, `AVATAR`, `GENDER`, `ABOUT_ME`, `STATUS`) VALUES
(1, 'doni', '2da9cd653f63c010b6d6c5a5ad73fe32', 'Doni Ramadhan', '2012-03-16', 'doni@mail.coma', 'bg_header.jpg', 'LAKI', 'saya adalah doni, perkenalkan', 'IN RELATIONSHIP'),
(2, 'rina', 'rina', 'Rina Herawati', '2012-01-30', 'rina@hera.com', NULL, 'PEREMPUAN', 'saya adalah rina, kenalin', 'SINGLE'),
(3, 'rido.ramadan', 'ramadanrido', 'Rido Ramadan', '1991-03-20', 'rido.ramadan.ipa1@gmail.com', 'AvatarRido', 'LAKI', 'Nobody is Perfect\r\nI am Nobody\r\nI am Perfect.....?', 'SINGLE'),
(4, 'aphie3_uciha', 'uchihasasuke', 'Alfian Ramadan', '1993-03-16', 'aphie3_uciha@yahoo.co.id', 'Avatar Alfian', 'LAKI', 'Desktop, Web, Mobile Programmer. http://www.masphei.ungu.com/', 'SINGLE'),
(5, 'marchy_gab3', '08031992', 'Marchy Tio Pandapotan', '1992-03-08', 'marchy_gab3@yahoo.com', 'Avatar Marchy', 'LAKI', 'automotive-enthusiast, adventurer, humorist, and healthy man :D.\r\n', 'SINGLE'),
(6, 'timo55', 'safeitimotius', 'Timotius Triputra S.', '1990-12-02', 'timo55@yahoo.com', 'Avatar timo', 'LAKI', 'never do today what u can do tomorrow [T_m_5]', 'SINGLE'),
(7, 'aribowo93', 'bowbowlaksono', 'Trilaksono Aribowo', '1993-12-19', 'aribowo93@gmail.com', 'Avatar Ari', 'LAKI', 'jago main gitar klasik, suka ikut kepanitiaan, Ketua Departemen Eksternal Sosial HMIF 2012/2013', 'SINGLE'),
(8, 'sundaripurnamasari', 'megamegamega', 'Sundari Mega Purnamasari', '1991-05-10', 'mega1991@gmail.com', 'avatar sume', 'PEREMPUAN', 'saman dance lover and teacher', 'SINGLE'),
(9, 'asdas', 'bff149a0b87f5b0e00d9dd364e9ddaa0', 'a a', '1111-11-11', 'asd@asda.co', 'bg_header.jpg', 'LAKI', 'asd', 'SINGLE'),
(10, 'kjhjh', 'bff149a0b87f5b0e00d9dd364e9ddaa0', 'j j', '1111-11-11', 'aaphie3_uciha@yahoo.co.id', 'bg_header.jpg', 'LAKI', 'asdf', 'SINGLE'),
(11, 'asdasdas', 'a3dcb4d229de6fde0db5686dee47145d', 'aa a', '1111-11-30', 'aphie3_uciha@yahoo.co.idaasadasd', 'bg_header.jpg', 'PEREMPUAN', 'jhgk,h', 'SINGLE'),
(12, 'masphei', 'bff149a0b87f5b0e00d9dd364e9ddaa0', 'asd asd', '1111-11-11', 'aphie3_uciha@yahoo.co.ida', 'bg_header.jpg', 'LAKI', 'hahaha', 'IN RELATIONSHIP'),
(13, 'maspheia', 'bff149a0b87f5b0e00d9dd364e9ddaa0', 'asd asd', '1111-11-11', 'aphie3_uciha@yahoo.co.idw', 'bg_header.jpg', 'LAKI', '', ''),
(14, 'maphie13341', 'bff149a0b87f5b0e00d9dd364e9ddaa0', 'asd asd', '1111-11-11', 'asd@asd.co', 'bg_header.jpg', 'LAKI', '', 'IN RELATIONSHIP'),
(15, 'maspheifunny', 'bff149a0b87f5b0e00d9dd364e9ddaa0', 'asd asd', '1111-11-11', 'asd@asd.coa', 'bg_header.jpg', 'LAKI', '', 'SINGLE'),
(16, 'sdfalkfj', 'bff149a0b87f5b0e00d9dd364e9ddaa0', 'asd asd', '1111-11-11', 'aphie3_uciha@yahoo.o.ida', 'bg_header.jpg', 'LAKI', 'asd', 'IN RELATIONSHIP'),
(17, 'asdasd', 'bff149a0b87f5b0e00d9dd364e9ddaa0', 'a a', '1111-11-11', 'asd@asd.coq', 'bg_header.jpg', 'LAKI', '', 'IN RELATIONSHIP');

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
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 8),
(1, 11),
(1, 12),
(12, 1),
(12, 3),
(12, 8),
(12, 12),
(14, 1),
(14, 3),
(14, 8),
(14, 10),
(14, 11),
(14, 12),
(16, 3),
(16, 12),
(17, 1),
(17, 12);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
