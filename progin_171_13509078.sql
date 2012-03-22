SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `progin_171_13509078` ;
CREATE SCHEMA IF NOT EXISTS `progin_171_13509078` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `progin_171_13509078` ;

-- -----------------------------------------------------
-- Table `progin_171_13509078`.`USER`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `progin_171_13509078`.`USER` (
  `ID_USER` INT NOT NULL ,
  `USERNAME` VARCHAR(45) NULL ,
  `PASSWORD` VARCHAR(45) NULL ,
  `NAMA` VARCHAR(45) NULL ,
  `TGL_LAHIR` DATE NULL ,
  `EMAIL` TEXT NULL ,
  `AVATAR` TEXT NULL ,
  `GENDER` ENUM('LAKI','PEREMPUAN') NULL ,
  `ABOUT_ME` TEXT NULL ,
  PRIMARY KEY (`ID_USER`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `progin_171_13509078`.`KONTEN`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `progin_171_13509078`.`KONTEN` (
  `ID_KONTEN` INT NOT NULL ,
  `ID_USER` INT NULL ,
  `ID_TYPE` INT NULL ,
  `TANGGAL` DATE NULL ,
  `JAM` TIME NULL ,
  `JUDUL` VARCHAR(45) NULL ,
  `LINK` TEXT NULL ,
  `DESKRIPSI` TEXT NULL ,
  PRIMARY KEY (`ID_KONTEN`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `progin_171_13509078`.`TAG`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `progin_171_13509078`.`TAG` (
  `ID_TAG` INT NOT NULL ,
  `NAMA_TAG` VARCHAR(45) NULL ,
  PRIMARY KEY (`ID_TAG`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `progin_171_13509078`.`LIKE_DISLIKE`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `progin_171_13509078`.`LIKE_DISLIKE` (
  `ID_KONTEN` INT NOT NULL ,
  `ID_USER` INT NOT NULL ,
  `STATUS` ENUM('LIKE','DISLIKE') NULL ,
  PRIMARY KEY (`ID_KONTEN`, `ID_USER`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `progin_171_13509078`.`TYPE`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `progin_171_13509078`.`TYPE` (
  `ID_TYPE` INT NOT NULL ,
  `NAMA_TYPE` VARCHAR(45) NULL ,
  PRIMARY KEY (`ID_TYPE`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `progin_171_13509078`.`KOMENTAR`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `progin_171_13509078`.`KOMENTAR` (
  `ID_KONTEN` INT NULL ,
  `ISI` TEXT NULL ,
  `TANGGAL` DATE NULL ,
  `JAM` TIME NULL ,
  `ID_USER` INT NULL ,
  `ID_KOMENTAR` INT NOT NULL ,
  PRIMARY KEY (`ID_KOMENTAR`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `progin_171_13509078`.`USER_ACHIEVEMENT`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `progin_171_13509078`.`USER_ACHIEVEMENT` (
  `ID_USER` INT NOT NULL ,
  `ID_ACHIEVEMENT` INT NOT NULL ,
  PRIMARY KEY (`ID_USER`, `ID_ACHIEVEMENT`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `progin_171_13509078`.`ACHIEVEMENT`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `progin_171_13509078`.`ACHIEVEMENT` (
  `ID_ACHIEVEMENT` INT NOT NULL ,
  `NAMA` VARCHAR(45) NULL ,
  `GAMBAR` TEXT NULL ,
  PRIMARY KEY (`ID_ACHIEVEMENT`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `progin_171_13509078`.`KONTEN_TAG`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `progin_171_13509078`.`KONTEN_TAG` (
  `ID_KONTEN` INT NOT NULL ,
  `ID_TAG` INT NOT NULL ,
  PRIMARY KEY (`ID_KONTEN`, `ID_TAG`) )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `progin_171_13509078`.`USER`
-- -----------------------------------------------------
START TRANSACTION;
USE `progin_171_13509078`;
INSERT INTO `progin_171_13509078`.`USER` (`ID_USER`, `USERNAME`, `PASSWORD`, `NAMA`, `TGL_LAHIR`, `EMAIL`, `AVATAR`, `GENDER`, `ABOUT_ME`) VALUES (1, 'doni', 'doni', 'Doni Ramadhan', '2012-03-16', 'doni@mail.com', NULL, 'LAKI', 'saya adalah doni, perkenalkan');
INSERT INTO `progin_171_13509078`.`USER` (`ID_USER`, `USERNAME`, `PASSWORD`, `NAMA`, `TGL_LAHIR`, `EMAIL`, `AVATAR`, `GENDER`, `ABOUT_ME`) VALUES (2, 'rina', 'rina', 'Rina Herawati', '2012-01-30', 'rina@hera.com', NULL, 'PEREMPUAN', 'saya adalah rina, kenalin');

COMMIT;

-- -----------------------------------------------------
-- Data for table `progin_171_13509078`.`KONTEN`
-- -----------------------------------------------------
START TRANSACTION;
USE `progin_171_13509078`;
INSERT INTO `progin_171_13509078`.`KONTEN` (`ID_KONTEN`, `ID_USER`, `ID_TYPE`, `TANGGAL`, `JAM`, `JUDUL`, `LINK`, `DESKRIPSI`) VALUES (1, 1, 1, '2012-04-14', '08:00', 'ARTIKELPERTAMA', 'http://facebook.com', 'ini adalah situs facebook');
INSERT INTO `progin_171_13509078`.`KONTEN` (`ID_KONTEN`, `ID_USER`, `ID_TYPE`, `TANGGAL`, `JAM`, `JUDUL`, `LINK`, `DESKRIPSI`) VALUES (2, 2, 1, '2012-04-12', '09:00', 'Artikel Kedua', 'http://gmail.com', 'ini email loh');

COMMIT;

-- -----------------------------------------------------
-- Data for table `progin_171_13509078`.`TAG`
-- -----------------------------------------------------
START TRANSACTION;
USE `progin_171_13509078`;
INSERT INTO `progin_171_13509078`.`TAG` (`ID_TAG`, `NAMA_TAG`) VALUES (1, 'Application');
INSERT INTO `progin_171_13509078`.`TAG` (`ID_TAG`, `NAMA_TAG`) VALUES (2, 'Desktop');

COMMIT;

-- -----------------------------------------------------
-- Data for table `progin_171_13509078`.`LIKE_DISLIKE`
-- -----------------------------------------------------
START TRANSACTION;
USE `progin_171_13509078`;
INSERT INTO `progin_171_13509078`.`LIKE_DISLIKE` (`ID_KONTEN`, `ID_USER`, `STATUS`) VALUES (2, 1, 'LIKE');
INSERT INTO `progin_171_13509078`.`LIKE_DISLIKE` (`ID_KONTEN`, `ID_USER`, `STATUS`) VALUES (2, 2, 'LIKE');
INSERT INTO `progin_171_13509078`.`LIKE_DISLIKE` (`ID_KONTEN`, `ID_USER`, `STATUS`) VALUES (1, 2, 'DISLIKE');

COMMIT;

-- -----------------------------------------------------
-- Data for table `progin_171_13509078`.`TYPE`
-- -----------------------------------------------------
START TRANSACTION;
USE `progin_171_13509078`;
INSERT INTO `progin_171_13509078`.`TYPE` (`ID_TYPE`, `NAMA_TYPE`) VALUES (1, 'LINK');
INSERT INTO `progin_171_13509078`.`TYPE` (`ID_TYPE`, `NAMA_TYPE`) VALUES (2, 'IMAGE');
INSERT INTO `progin_171_13509078`.`TYPE` (`ID_TYPE`, `NAMA_TYPE`) VALUES (3, 'VIDEO');

COMMIT;

-- -----------------------------------------------------
-- Data for table `progin_171_13509078`.`KOMENTAR`
-- -----------------------------------------------------
START TRANSACTION;
USE `progin_171_13509078`;
INSERT INTO `progin_171_13509078`.`KOMENTAR` (`ID_KONTEN`, `ISI`, `TANGGAL`, `JAM`, `ID_USER`, `ID_KOMENTAR`) VALUES (1, 'Artikelnya kurang bagus nih', '2012-02-09', '08:09', 2, 1);
INSERT INTO `progin_171_13509078`.`KOMENTAR` (`ID_KONTEN`, `ISI`, `TANGGAL`, `JAM`, `ID_USER`, `ID_KOMENTAR`) VALUES (2, 'Ini artikelnya lumayan', '2012-04-03', '08:29', 1, 2);

COMMIT;

-- -----------------------------------------------------
-- Data for table `progin_171_13509078`.`USER_ACHIEVEMENT`
-- -----------------------------------------------------
START TRANSACTION;
USE `progin_171_13509078`;
INSERT INTO `progin_171_13509078`.`USER_ACHIEVEMENT` (`ID_USER`, `ID_ACHIEVEMENT`) VALUES (1, 1);
INSERT INTO `progin_171_13509078`.`USER_ACHIEVEMENT` (`ID_USER`, `ID_ACHIEVEMENT`) VALUES (1, 2);

COMMIT;

-- -----------------------------------------------------
-- Data for table `progin_171_13509078`.`ACHIEVEMENT`
-- -----------------------------------------------------
START TRANSACTION;
USE `progin_171_13509078`;
INSERT INTO `progin_171_13509078`.`ACHIEVEMENT` (`ID_ACHIEVEMENT`, `NAMA`, `GAMBAR`) VALUES (1, 'Newbie', NULL);
INSERT INTO `progin_171_13509078`.`ACHIEVEMENT` (`ID_ACHIEVEMENT`, `NAMA`, `GAMBAR`) VALUES (2, 'Hercules', NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `progin_171_13509078`.`KONTEN_TAG`
-- -----------------------------------------------------
START TRANSACTION;
USE `progin_171_13509078`;
INSERT INTO `progin_171_13509078`.`KONTEN_TAG` (`ID_KONTEN`, `ID_TAG`) VALUES (1, 1);
INSERT INTO `progin_171_13509078`.`KONTEN_TAG` (`ID_KONTEN`, `ID_TAG`) VALUES (1, 2);
INSERT INTO `progin_171_13509078`.`KONTEN_TAG` (`ID_KONTEN`, `ID_TAG`) VALUES (2, 2);

COMMIT;
