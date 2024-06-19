-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema almirweb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema almirweb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `almirweb` DEFAULT CHARACTER SET utf8mb4 ;
USE `almirweb` ;

-- -----------------------------------------------------
-- Table `almirweb`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `almirweb`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `almirweb`.`produto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `almirweb`.`produto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(85) NOT NULL,
  `valor` FLOAT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `almirweb`.`pedido_emprestado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `almirweb`.`pedido_emprestado` (
  `id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `produto_id` INT NOT NULL,
  `descricao` VARCHAR(85) NOT NULL,
  `data` DATE NOT NULL,
  `valorTotal` FLOAT NOT NULL,
  PRIMARY KEY (`id`, `produto_id`, `user_id`),
  INDEX `fk_user_has_produto_produto1_idx` (`produto_id` ASC) VISIBLE,
  INDEX `fk_user_has_produto_user_idx` (`user_id` ASC) VISIBLE,
  CONSTRAINT `fk_user_has_produto_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `almirweb`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_produto_produto1`
    FOREIGN KEY (`produto_id`)
    REFERENCES `almirweb`.`produto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
