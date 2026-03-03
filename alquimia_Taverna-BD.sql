-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02/03/2026 às 22:00
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `mydb`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `autorizados`
--

CREATE TABLE `autorizados` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `funcao` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `autorizados`
--

INSERT INTO `autorizados` (`id_usuario`, `nome`, `email`, `funcao`) VALUES
(4, '', '', 'administrador'),
(5, '', '', 'funcionario'),
(6, '', '', 'inativo'),
(7, '', '', 'funcionário'),
(8, '', '', 'funcionario'),
(9, '', '', 'administrador'),
(10, '', '', 'administrador'),
(11, '', '', 'funcionario'),
(12, '', '', 'funcionário'),
(13, '', '', 'inativo'),
(14, '', '', 'funcionário'),
(15, '', '', 'administrador'),
(16, '', '', 'funcionário');

-- --------------------------------------------------------

--
-- Estrutura para tabela `bebidas_produto`
--

CREATE TABLE `bebidas_produto` (
  `id_bebida` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `uva` varchar(255) DEFAULT NULL,
  `safra` varchar(100) DEFAULT NULL,
  `peso_L` decimal(10,2) NOT NULL,
  `nacionalidade` varchar(100) DEFAULT NULL,
  `ft_produto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `comidas_produtos`
--

CREATE TABLE `comidas_produtos` (
  `id_prato` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `porcao` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `estoque`
--

CREATE TABLE `estoque` (
  `id_estoque` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `id_fornecedor` int(11) NOT NULL,
  `cpf_cnpj` varchar(45) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` int(11) NOT NULL,
  `ft_rg` varchar(255) NOT NULL,
  `ft_perfil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `margem`
--

CREATE TABLE `margem` (
  `id_margem` int(11) NOT NULL,
  `date` date NOT NULL,
  `valor` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `id_produto` int(11) NOT NULL,
  `id_fornecedor` int(11) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `descrição` varchar(100) DEFAULT NULL,
  `classificacao` varchar(100) DEFAULT NULL,
  `valor_custo` decimal(10,0) DEFAULT NULL,
  `valor_produto` decimal(10,0) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `cpf` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `ft_perfil` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `cpf`, `nome`, `sobrenome`, `email`, `senha`, `ft_perfil`) VALUES
(4, 2147483647, 'Matheus', 'da Fontoura', 'mathp.f02@gmail.com', '$2y$10$5gNcPnmuAa2CTPLr6aClUOFJV2jFcaxY4t81pPFwh6iZiVTC3y.GG', NULL),
(5, 2147483647, 'Vitor', 'da Fontoura', 'vitor@gmail.com', '$2y$10$Uw7Cu./CO7cEznOkNwPwC.eQek.ngmwr2svhZFLmgUcpDJ6yAdlC6', NULL),
(6, 2147483647, 'Rafael', 'Nogueira', 'rafa@gmail.com', '$2y$10$LqONxNfLSuqC5n.b69oUcu9NqC4i1BOg6iTjoxc3el80rxJ82BZoK', NULL),
(7, 2147483647, 'Rafael', 'Nogueira', 'rafa@gmail.com', '$2y$10$g4/MAk.vyxBZXObwPtgfmeeDCdCuR6yElZmtQnR2qPT6whQYVjf2q', NULL),
(8, 2147483647, 'Fernando ', 'Brongar', 'fernando@gmail.com', '$2y$10$yjkw/J16IcbkGP6nDKZhUeSBl8eAMrDQveDDiZyA2Pc7avr8OCtn.', NULL),
(9, 0, 'Camila', 'Pessamiglio', 'camila@gmail.com', '$2y$10$dvz9zTIWDxzIO5uAkT4H5uBAM4zDEhtqCmmfZL8FiBIud0RjX4UWa', NULL),
(10, 0, 'Dastan', 'da Fontoura', 'dastan@gmail.com', '$2y$10$55Bv9Ns3o3S9jHKvh3ptiub7QioC/svmkBanAkibkGyd7g0aZdJeS', NULL),
(11, 320130321, 'teste1', 'testado', 'teste1@gmail.com', '$2y$10$prRihOZvI8t2fDqkz81i9u4DuqIbCdyZ5.CJvxZZqHTfYln3a3.jm', NULL),
(12, 3213213, 'teste2', '2', 'matheusfontoura3.aluno2@unipampa.edu.br', '$2y$10$yVVBqIHzghZBsMdGm3SXTONncl//jC/R3hWxlZppCZnYCpqv28f3m', NULL),
(13, 421312313, 'Matheus', 'da Fontoura', 'matheusfontoura.aluno@unipampa.edu.br', '$2y$10$iPIfX5dlCjGM3hfG7TW9eeu/aLp4StnsiPstUORAmyFUsOp6VvzPS', NULL),
(14, 412321, 'Matheus', 'da Fontoura', 'matheusfontoura.aluno@unipampa.edu.br', '$2y$10$sC/cDTUMw/D/lYOmEi945eAcw5TdoqPskAA0N9ZiqmFlIlyuyTl2G', NULL),
(15, 123, 'Matheus', 'da Fontoura', 'matheusfontoura.aluno@unipampa.edu.br', '$2y$10$y/0LTy6Y.BeQI7nxjxjvN.qsZSTXGhT9QTVWuBsaOlqm0yF8kuHoW', NULL),
(16, 1, 'Thaís ', 'Oliveira', 'thais@gmail.com', '$2y$10$ZFgHvsNKHmjit1rMOXewk.9lNFGqk09RNa3gykgKB27p3OtxqVd8e', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `autorizados`
--
ALTER TABLE `autorizados`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Índices de tabela `bebidas_produto`
--
ALTER TABLE `bebidas_produto`
  ADD PRIMARY KEY (`id_bebida`),
  ADD KEY `idx_bebidas_id_produto` (`id_produto`);

--
-- Índices de tabela `comidas_produtos`
--
ALTER TABLE `comidas_produtos`
  ADD PRIMARY KEY (`id_prato`);

--
-- Índices de tabela `estoque`
--
ALTER TABLE `estoque`
  ADD PRIMARY KEY (`id_estoque`),
  ADD KEY `idx_estoque_id_produto` (`id_produto`);

--
-- Índices de tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`id_fornecedor`);

--
-- Índices de tabela `margem`
--
ALTER TABLE `margem`
  ADD PRIMARY KEY (`id_margem`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id_produto`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `bebidas_produto`
--
ALTER TABLE `bebidas_produto`
  MODIFY `id_bebida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `comidas_produtos`
--
ALTER TABLE `comidas_produtos`
  MODIFY `id_prato` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `estoque`
--
ALTER TABLE `estoque`
  MODIFY `id_estoque` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `bebidas_produto`
--
ALTER TABLE `bebidas_produto`
  ADD CONSTRAINT `fk_bebidas_produto` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id_produto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `comidas_produtos`
--
ALTER TABLE `comidas_produtos`
  ADD CONSTRAINT `id_produto` FOREIGN KEY (`id_prato`) REFERENCES `produto` (`id_produto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `estoque`
--
ALTER TABLE `estoque`
  ADD CONSTRAINT `fk_estoque_produto` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id_produto`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
