-- MySQL Script generated by MySQL Workbench
-- 02/01/15 14:09:00
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema calpolyiot
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema calpolyiot
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `calpolyiot` ;
USE `calpolyiot` ;

-- -----------------------------------------------------
-- Table `calpolyiot`.`User`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `calpolyiot`.`User` ;

CREATE TABLE IF NOT EXISTS `calpolyiot`.`User` (
  `id` INT(11) NOT NULL DEFAULT '0',
  `username` VARCHAR(15) NOT NULL DEFAULT '',
  `lastName` VARCHAR(30) NULL DEFAULT NULL,
  `firstName` VARCHAR(30) NULL DEFAULT NULL,
  `dateAdded` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`id`, `username`));


-- -----------------------------------------------------
-- Table `calpolyiot`.`Login`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `calpolyiot`.`Login` ;

CREATE TABLE IF NOT EXISTS `calpolyiot`.`Login` (
  `username` VARCHAR(15) NOT NULL DEFAULT '',
  `passphrase` VARCHAR(15) NULL DEFAULT NULL,
  PRIMARY KEY (`username`),
  CONSTRAINT `login_fk1`
    FOREIGN KEY (`username`)
    REFERENCES `calpolyiot`.`User` (`username`));


-- -----------------------------------------------------
-- Table `calpolyiot`.`Device`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `calpolyiot`.`Device` ;

CREATE TABLE IF NOT EXISTS `calpolyiot`.`Device` (
  `id` INT(11) NOT NULL DEFAULT '0',
  `deviceName` VARCHAR(30) NULL DEFAULT NULL,
  `dateAdded` DATE NULL DEFAULT NULL,
  `access` VARCHAR(45) NULL DEFAULT 'private',
  `ownerId` INT(11) NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  INDEX `device_fk1_idx` (`ownerId` ASC),
  CONSTRAINT `device_fk1`
    FOREIGN KEY (`ownerId`)
    REFERENCES `calpolyiot`.`User` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `calpolyiot`.`UserDevice`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `calpolyiot`.`UserDevice` ;

CREATE TABLE IF NOT EXISTS `calpolyiot`.`UserDevice` (
  `userID` INT(11) NOT NULL DEFAULT '0',
  `deviceID` INT(11) NOT NULL DEFAULT '0',
  `enabled` VARCHAR(9) NULL DEFAULT 'disabled',
  `dateAdded` DATE NULL DEFAULT NULL,
  `permission` VARCHAR(45) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`userID`, `deviceID`),
  INDEX `userDevice_fk2` (`deviceID` ASC),
  CONSTRAINT `userDevice_fk1`
    FOREIGN KEY (`userID`)
    REFERENCES `calpolyiot`.`User` (`id`),
  CONSTRAINT `userDevice_fk2`
    FOREIGN KEY (`deviceID`)
    REFERENCES `calpolyiot`.`Device` (`id`));


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
