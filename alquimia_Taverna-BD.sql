-- MySQL Workbench Forward Engineering (ajustado p/ MariaDB)

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8;
USE `mydb`;

-- -----------------------------------------------------
-- Table `mydb`.`USUARIOS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`USUARIOS` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `cpf` CHAR(15) NOT NULL,
  `nome` VARCHAR(255) NOT NULL,
  `sobrenome` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  `ft_perfil` VARCHAR(255) NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table `mydb`.`AUTORIZADOS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`AUTORIZADOS` (
  `id_autorizados` INT NOT NULL AUTO_INCREMENT,
  `id_usuario` INT NOT NULL,
  `funcao` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_autorizados`),
  INDEX `idx_autorizados_id_usuario` (`id_usuario`),
  CONSTRAINT `fk_autorizados_usuario`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `mydb`.`USUARIOS` (`id_usuario`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table `mydb`.`MARGEM`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`MARGEM` (
  `id_margem` INT NOT NULL AUTO_INCREMENT,
  `valor` DECIMAL(10,2) NOT NULL,
  `date` DATE NOT NULL,
  PRIMARY KEY (`id_margem`)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table `mydb`.`FORNECEDOR`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`FORNECEDOR` (
  `id_fornecedor` INT NOT NULL AUTO_INCREMENT,
  `cpf` CHAR(15) NULL,
  `cnpj` CHAR(20) NULL,
  `nome` VARCHAR(255) NOT NULL,
  `sobrenome` VARCHAR(255) NOT NULL,
  `email` VARCHAR(100) NULL,
  `telefone` VARCHAR(20) NOT NULL,
  `ft_rg` VARCHAR(255) NOT NULL,
  `ft_perfil` VARCHAR(255) NULL,
  `tp_produto` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_fornecedor`),
  UNIQUE KEY `fornecedor_email_UNIQUE` (`email`),
  UNIQUE KEY `fornecedor_cpf_UNIQUE` (`cpf`),
  UNIQUE KEY `fornecedor_cnpj_UNIQUE` (`cnpj`)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table `mydb`.`PRODUTO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`PRODUTO` (
  `id_produto` INT NOT NULL AUTO_INCREMENT,
  `id_fornecedor` INT NULL,
  `nome` VARCHAR(255) NOT NULL,
  `classificacao` VARCHAR(255) NOT NULL,
  `tipo` VARCHAR(255) NOT NULL,
  `validade` DATE NOT NULL,
  `preco` DECIMAL(10,2) NOT NULL,
  `status` TINYINT NOT NULL,
  PRIMARY KEY (`id_produto`),
  INDEX `idx_produto_id_fornecedor` (`id_fornecedor`),
  CONSTRAINT `fk_produto_fornecedor`
    FOREIGN KEY (`id_fornecedor`)
    REFERENCES `mydb`.`FORNECEDOR` (`id_fornecedor`)
    ON DELETE SET NULL
    ON UPDATE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table `mydb`.`comidas_PRODUTOS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`comidas_PRODUTOS` (
  `id_prato` INT NOT NULL AUTO_INCREMENT,
  `id_produto` INT NOT NULL,
  `porcao` VARCHAR(255) NOT NULL,
  `descricao` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_prato`),
  INDEX `idx_comidas_id_produto` (`id_produto`),
  CONSTRAINT `fk_comidas_produto`
    FOREIGN KEY (`id_produto`)
    REFERENCES `mydb`.`PRODUTO` (`id_produto`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table `mydb`.`bebidas_PRODUTO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`bebidas_PRODUTO` (
  `id_bebida` INT NOT NULL AUTO_INCREMENT,
  `id_produto` INT NOT NULL,
  `tipo` VARCHAR(255) NOT NULL,
  `uva` VARCHAR(255) NULL,
  `safra` VARCHAR(100) NULL,
  `peso_L` DECIMAL(10,2) NOT NULL,
  `nacionalidade` VARCHAR(100) NULL,
  `ft_produto` VARCHAR(255) NULL,
  PRIMARY KEY (`id_bebida`),
  INDEX `idx_bebidas_id_produto` (`id_produto`),
  CONSTRAINT `fk_bebidas_produto`
    FOREIGN KEY (`id_produto`)
    REFERENCES `mydb`.`PRODUTO` (`id_produto`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table `mydb`.`ESTOQUE`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`ESTOQUE` (
  `id_estoque` INT NOT NULL AUTO_INCREMENT,
  `id_produto` INT NOT NULL,
  `quantidade` INT NOT NULL,
  PRIMARY KEY (`id_estoque`),
  INDEX `idx_estoque_id_produto` (`id_produto`),
  CONSTRAINT `fk_estoque_produto`
    FOREIGN KEY (`id_produto`)
    REFERENCES `mydb`.`PRODUTO` (`id_produto`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE
) ENGINE=InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;