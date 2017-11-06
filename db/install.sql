-- -----------------------------------------------------
-- Schema millhouse
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema millhouse
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `millhouse` DEFAULT CHARACTER SET utf8 ;
USE `millhouse` ;

-- -----------------------------------------------------
-- Table `millhouse`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `millhouse`.`user` (
  `userid` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `password` VARCHAR(200) NOT NULL,
  `email` VARCHAR(200) NOT NULL,
  `registertime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` VARCHAR(20) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`userid`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `millhouse`.`category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `millhouse`.`category` (
  `categoryid` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`categoryid`))
ENGINE = InnoDB;

-- Inserting categories --
INSERT INTO `category` (`name`) VALUES ('Solglasögon');
INSERT INTO `category` (`name`) VALUES ('Klockor');
INSERT INTO `category` (`name`) VALUES ('Inredningsartiklar');
INSERT INTO `category` (`name`) VALUES ('Övrigt');

-- -----------------------------------------------------
-- Table `millhouse`.`post`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `millhouse`.`post` (
  `postid` INT NOT NULL AUTO_INCREMENT,
  `userid` INT NOT NULL,
  `title` VARCHAR(100) NOT NULL,
  `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `text` TEXT NOT NULL,
  `thumbnail` VARCHAR(250) NULL,
  `categoryid` INT NOT NULL,
  PRIMARY KEY (`postid`),
  INDEX `userid_idx` (`userid` ASC),
  INDEX `fpost_categoryid_idx` (`categoryid` ASC),
  CONSTRAINT `fpost_userid`
    FOREIGN KEY (`userid`)
    REFERENCES `millhouse`.`user` (`userid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fpost_categoryid`
    FOREIGN KEY (`categoryid`)
    REFERENCES `millhouse`.`category` (`categoryid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `millhouse`.`comment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `millhouse`.`comment` (
  `commentid` INT NOT NULL AUTO_INCREMENT,
  `userid` INT NOT NULL,
  `postid` INT NOT NULL,
  `comment` VARCHAR(500) NOT NULL,
  `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`commentid`),
  INDEX `f_userid_idx` (`userid` ASC),
  INDEX `f_postid_idx` (`postid` ASC),
  CONSTRAINT `fcomment_userid`
    FOREIGN KEY (`userid`)
    REFERENCES `millhouse`.`user` (`userid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fcomment_postid`
    FOREIGN KEY (`postid`)
    REFERENCES `millhouse`.`post` (`postid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `millhouse`.`page`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `millhouse`.`page` (
  `pageid` INT NOT NULL AUTO_INCREMENT,
  `userid` INT NOT NULL,
  `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` VARCHAR(45) NOT NULL,
  `content` TEXT NOT NULL,
  PRIMARY KEY (`pageid`),
  INDEX `f_userid_idx` (`userid` ASC),
  CONSTRAINT `fpage_userid`
    FOREIGN KEY (`userid`)
    REFERENCES `millhouse`.`user` (`userid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `millhouse`.`profile`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `millhouse`.`profile` (
  `profileid` INT NOT NULL AUTO_INCREMENT,
  `userid` INT NOT NULL,
  `photo` VARCHAR(255) NULL,
  `name` VARCHAR(60) NULL,
  `about` VARCHAR(200) NULL,
  PRIMARY KEY (`profileid`),
  INDEX `f_userid_idx` (`userid` ASC),
  CONSTRAINT `fprofile_userid`
    FOREIGN KEY (`userid`)
    REFERENCES `millhouse`.`user` (`userid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;