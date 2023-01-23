-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema e2195598
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema e2195598
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `e2195598` DEFAULT CHARACTER SET utf8 ;
USE `e2195598` ;

-- -----------------------------------------------------
-- Table `e2195598`.`vino__role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `e2195598`.`vino__role` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `e2195598`.`vino__utilisateur`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `e2195598`.`vino__utilisateur` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(200) NOT NULL,
  `prenom` VARCHAR(200) NOT NULL,
  `courriel` VARCHAR(200) NOT NULL,
  `mot_de_passe` VARCHAR(255) NOT NULL,
  `date_inscription` DATETIME NOT NULL,
  `confirmation` VARCHAR(27) NULL,
  `vino__role_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`, `vino__role_id`),
  INDEX `fk_vino__utilisateur_vino__role1_idx` (`vino__role_id` ASC),
  CONSTRAINT `fk_vino__utilisateur_vino__role1`
    FOREIGN KEY (`vino__role_id`)
    REFERENCES `e2195598`.`vino__role` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `e2195598`.`vino__cellier`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `e2195598`.`vino__cellier` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(200) NOT NULL,
  `vino__utilisateur_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`, `vino__utilisateur_id`),
  INDEX `fk_vino__cellier_vino__utilisateur1_idx` (`vino__utilisateur_id` ASC),
  CONSTRAINT `fk_vino__cellier_vino__utilisateur1`
    FOREIGN KEY (`vino__utilisateur_id`)
    REFERENCES `e2195598`.`vino__utilisateur` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `e2195598`.`vino__type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `e2195598`.`vino__type` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `e2195598`.`vino__catalogue`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `e2195598`.`vino__catalogue` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `e2195598`.`vino__bouteille`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `e2195598`.`vino__bouteille` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(200) NOT NULL,
  `image` VARCHAR(200) NULL,
  `code_saq` VARCHAR(50) NULL,
  `pays` VARCHAR(50) NOT NULL,
  `description` VARCHAR(200) NULL,
  `prix_saq` FLOAT NULL,
  `url_saq` VARCHAR(200) NULL,
  `url_img` VARCHAR(200) NULL,
  `format` VARCHAR(20) NULL,
  `vino__type_id` INT UNSIGNED NOT NULL,
  `vino__catalogue_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`, `vino__type_id`, `vino__catalogue_id`),
  INDEX `fk_vino__bouteille_vino__type1_idx` (`vino__type_id` ASC),
  INDEX `fk_vino__bouteille_vino__catalogue1_idx` (`vino__catalogue_id` ASC),
  CONSTRAINT `fk_vino__bouteille_vino__type1`
    FOREIGN KEY (`vino__type_id`)
    REFERENCES `e2195598`.`vino__type` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vino__bouteille_vino__catalogue1`
    FOREIGN KEY (`vino__catalogue_id`)
    REFERENCES `e2195598`.`vino__catalogue` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `e2195598`.`vino__cellier_contient`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `e2195598`.`vino__cellier_contient` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `vino__cellier_id` INT UNSIGNED NOT NULL,
  `vino__bouteille_id` INT UNSIGNED NOT NULL,
  `vino__type_id` INT UNSIGNED NOT NULL,
  `nom` VARCHAR(200) NOT NULL,
  `pays` VARCHAR(50) NULL,
  `description` VARCHAR(200) NULL,
  `date_ajout` DATETIME NOT NULL,
  `garde_jusqua` VARCHAR(200) NULL,
  `notes` VARCHAR(200) NULL,
  `prix` FLOAT NULL,
  `format` VARCHAR(20) NULL,
  `quantite` INT UNSIGNED NOT NULL,
  `millesime` INT NULL,
  PRIMARY KEY (`id`, `vino__cellier_id`, `vino__bouteille_id`, `vino__type_id`),
  INDEX `fk_vino__cellier_has_vino__bouteille_vino__bouteille1_idx` (`vino__bouteille_id` ASC),
  INDEX `fk_vino__cellier_has_vino__bouteille_vino__cellier_idx` (`vino__cellier_id` ASC),
  INDEX `fk_vino__cellier_contient_vino__type1_idx` (`vino__type_id` ASC),
  CONSTRAINT `fk_vino__cellier_has_vino__bouteille_vino__cellier`
    FOREIGN KEY (`vino__cellier_id`)
    REFERENCES `e2195598`.`vino__cellier` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vino__cellier_has_vino__bouteille_vino__bouteille1`
    FOREIGN KEY (`vino__bouteille_id`)
    REFERENCES `e2195598`.`vino__bouteille` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vino__cellier_contient_vino__type1`
    FOREIGN KEY (`vino__type_id`)
    REFERENCES `e2195598`.`vino__type` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `e2195598`.`vino__utilisateur_recherche`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `e2195598`.`vino__utilisateur_recherche` (
  `vino__utilisateur_id` INT UNSIGNED NOT NULL,
  `vino__utilisateur_vino__role_id` INT UNSIGNED NOT NULL,
  `vino__bouteille_id` INT UNSIGNED NOT NULL,
  `vino__bouteille_vino__type_id` INT UNSIGNED NOT NULL,
  `vino__bouteille_vino__catalogue_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`vino__utilisateur_id`, `vino__utilisateur_vino__role_id`, `vino__bouteille_id`, `vino__bouteille_vino__type_id`, `vino__bouteille_vino__catalogue_id`),
  INDEX `fk_vino__utilisateur_has_vino__bouteille_vino__bouteille1_idx` (`vino__bouteille_id` ASC, `vino__bouteille_vino__type_id` ASC, `vino__bouteille_vino__catalogue_id` ASC),
  INDEX `fk_vino__utilisateur_has_vino__bouteille_vino__utilisateur1_idx` (`vino__utilisateur_id` ASC, `vino__utilisateur_vino__role_id` ASC),
  CONSTRAINT `fk_vino__utilisateur_has_vino__bouteille_vino__utilisateur1`
    FOREIGN KEY (`vino__utilisateur_id` , `vino__utilisateur_vino__role_id`)
    REFERENCES `e2195598`.`vino__utilisateur` (`id` , `vino__role_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vino__utilisateur_has_vino__bouteille_vino__bouteille1`
    FOREIGN KEY (`vino__bouteille_id` , `vino__bouteille_vino__type_id` , `vino__bouteille_vino__catalogue_id`)
    REFERENCES `e2195598`.`vino__bouteille` (`id` , `vino__type_id` , `vino__catalogue_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
