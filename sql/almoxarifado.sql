-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13/10/2024 às 16:12
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
-- Banco de dados: `almoxarifado`
--
CREATE DATABASE IF NOT EXISTS `almoxarifado` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `almoxarifado`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `almoxarife`
--

CREATE TABLE `almoxarife` (
  `id` int(10) UNSIGNED NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `senha` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `epis`
--

CREATE TABLE `epis` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(45) NOT NULL,
  `CA` varchar(20) NOT NULL,
  `unidade` varchar(20) NOT NULL,
  `estoque` int(10) UNSIGNED NOT NULL,
  `minimo` int(10) UNSIGNED NOT NULL,
  `validade` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionarios_retira_epis`
--

CREATE TABLE `funcionarios_retira_epis` (
  `id` int(10) UNSIGNED NOT NULL,
  `epis_id` int(10) UNSIGNED NOT NULL,
  `almoxarife_id` int(10) UNSIGNED NOT NULL,
  `data_retirada` date NOT NULL,
  `quantidade` int(10) UNSIGNED NOT NULL,
  `nome_funcionario` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `almoxarife`
--
ALTER TABLE `almoxarife`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `epis`
--
ALTER TABLE `epis`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `funcionarios_retira_epis`
--
ALTER TABLE `funcionarios_retira_epis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `funcionarios_has_EPIs_FKIndex2` (`epis_id`),
  ADD KEY `funcionarios_retira_EPIs_FKIndex3` (`almoxarife_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `almoxarife`
--
ALTER TABLE `almoxarife`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `epis`
--
ALTER TABLE `epis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `funcionarios_retira_epis`
--
ALTER TABLE `funcionarios_retira_epis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `funcionarios_retira_epis`
--
ALTER TABLE `funcionarios_retira_epis`
  ADD CONSTRAINT `funcionarios_retira_epis_ibfk_1` FOREIGN KEY (`epis_id`) REFERENCES `epis` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `funcionarios_retira_epis_ibfk_2` FOREIGN KEY (`almoxarife_id`) REFERENCES `almoxarife` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
