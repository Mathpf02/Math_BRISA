-- phpMyAdmin SQL Dump Otimizado
-- Banco de dados: `mydb`
-- Configurações Iniciais
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "-03:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8mb4;
USE `mydb`;

-- --------------------------------------------------------
-- 1. Tabela `usuarios`
-- (Corrigido: cpf alterado para VARCHAR para não perder zeros à esquerda)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `cpf` varchar(20) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `ft_perfil` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Inserindo os usuários
INSERT INTO `usuarios` (`id_usuario`, `cpf`, `nome`, `sobrenome`, `email`, `senha`, `ft_perfil`) VALUES
(2, '05408166040', 'Matheus', 'da Fontoura', 'mathp.f02@gmail.com', '$2y$10$5gNcPnmuAa2CTPLr6aClUOFJV2jFcaxY4t81pPFwh6iZiVTC3y.GG', NULL),
(3, '66655544478', 'Vitor', NULL, 'vitor@gmail.com', '$2y$10$Uw7Cu./CO7cEznOkNwPwC.eQek.ngmwr2svhZFLmgUcpDJ6yAdlC6', NULL);


-- --------------------------------------------------------
-- 2. Tabela `autorizados` (Níveis de Acesso)
-- (Corrigido: Adicionado Chave Estrangeira ligando ao id_usuario)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `autorizados` (
  `id_autorizados` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `funcao` varchar(100) NOT NULL,
  PRIMARY KEY (`id_autorizados`),
  KEY `idx_autorizados_id_usuario` (`id_usuario`),
  CONSTRAINT `fk_autorizados_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Inserindo os níveis de acesso referenciando os IDs dos usuários
INSERT INTO `autorizados` (`id_usuario`, `funcao`) VALUES
(2, 'administrador'),
(3, 'funcionario');

-- --------------------------------------------------------
-- 3. Tabela `fornecedor`
-- (Corrigido: telefone alterado para VARCHAR)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `fornecedor` (
  `id_fornecedor` int(11) NOT NULL AUTO_INCREMENT,
  `cpf_cnpj` varchar(45) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `ft_rg` varchar(255) DEFAULT NULL,
  `ft_perfil` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_fornecedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------
-- 4. Tabela `produto`
-- (Corrigido: Adicionado Chave Estrangeira ligando ao Fornecedor)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `produto` (
  `id_produto` int(11) NOT NULL AUTO_INCREMENT,
  `id_fornecedor` int(11) DEFAULT NULL,
  `nome` varchar(100) NOT NULL,
  `descrição` varchar(255) DEFAULT NULL,
  `classificacao` varchar(100) DEFAULT NULL,
  `valor_custo` decimal(10,2) DEFAULT NULL,
  `valor_produto` decimal(10,2) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`id_produto`),
  KEY `idx_produto_fornecedor` (`id_fornecedor`),
  CONSTRAINT `fk_produto_fornecedor` FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedor` (`id_fornecedor`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------
-- 5. Tabela `bebidas_produto`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `bebidas_produto` (
  `id_bebida` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `uva` varchar(100) DEFAULT NULL,
  `safra` varchar(100) DEFAULT NULL,
  `peso_L` decimal(10,2) NOT NULL,
  `nacionalidade` varchar(100) DEFAULT NULL,
  `ft_produto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_bebida`),
  KEY `idx_bebidas_produto` (`id_produto`),
  CONSTRAINT `fk_bebidas_produto` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id_produto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------
-- 6. Tabela `comidas_produtos`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `comidas_produtos` (
  `id_prato` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto` int(11) NOT NULL,
  `porcao` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  PRIMARY KEY (`id_prato`),
  KEY `idx_comidas_produto` (`id_produto`),
  CONSTRAINT `fk_comidas_produto` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id_produto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------
-- 7. Tabela `estoque`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `estoque` (
  `id_estoque` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_estoque`),
  KEY `idx_estoque_produto` (`id_produto`),
  CONSTRAINT `fk_estoque_produto` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id_produto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------
-- 8. Tabela `margem`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `margem` (
  `id_margem` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_margem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;