-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2024 at 11:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `almoxarifado`
--
CREATE DATABASE IF NOT EXISTS `almoxarifado` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `almoxarifado`;

-- --------------------------------------------------------

--
-- Table structure for table `alerta`
--

CREATE TABLE `alerta` (
  `idalerta` int(10) UNSIGNED NOT NULL,
  `epis_id` int(10) UNSIGNED NOT NULL,
  `data_aviso` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `almoxarife`
--

CREATE TABLE `almoxarife` (
  `id` int(10) UNSIGNED NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `senha` varchar(60) NOT NULL,
  `tipo` varchar(25) DEFAULT 'normal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aviso`
--

CREATE TABLE `aviso` (
  `idaviso` int(10) UNSIGNED NOT NULL,
  `almoxarife_id` int(10) UNSIGNED NOT NULL,
  `conteudo` text NOT NULL,
  `data_aviso` date NOT NULL,
  `visibilidade` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `compras`
--

CREATE TABLE `compras` (
  `idcompra` int(10) UNSIGNED NOT NULL,
  `epis_id` int(10) UNSIGNED NOT NULL,
  `fornecedor_idfornecedor` int(10) UNSIGNED NOT NULL,
  `data_entrega` date NOT NULL,
  `quantidade` int(10) UNSIGNED NOT NULL,
  `preco_total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `devolucao`
--

CREATE TABLE `devolucao` (
  `id` int(10) UNSIGNED NOT NULL,
  `funcionarios_retira_id` int(10) UNSIGNED NOT NULL,
  `data_entrada` date NOT NULL,
  `comentario` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `epis`
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
-- Table structure for table `fornecedor`
--

CREATE TABLE `fornecedor` (
  `idfornecedor` int(10) UNSIGNED NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cnpj` varchar(14) NOT NULL,
  `telefone` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `funcionarios`
--

CREATE TABLE `funcionarios` (
  `idfuncionario` int(10) UNSIGNED NOT NULL,
  `nome_funcionario` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `funcionarios_retira`
--

CREATE TABLE `funcionarios_retira` (
  `id` int(10) UNSIGNED NOT NULL,
  `funcionarios_idfuncionario` int(10) UNSIGNED NOT NULL,
  `epis_id` int(10) UNSIGNED NOT NULL,
  `almoxarife_id` int(10) UNSIGNED NOT NULL,
  `data_retirada` date NOT NULL,
  `quantidade` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alerta`
--
ALTER TABLE `alerta`
  ADD PRIMARY KEY (`idalerta`),
  ADD KEY `alerta_FKIndex1` (`epis_id`);

--
-- Indexes for table `almoxarife`
--
ALTER TABLE `almoxarife`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aviso`
--
ALTER TABLE `aviso`
  ADD PRIMARY KEY (`idaviso`),
  ADD KEY `alertas_FKIndex1` (`almoxarife_id`);

--
-- Indexes for table `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`idcompra`),
  ADD KEY `compras_FKIndex1` (`fornecedor_idfornecedor`),
  ADD KEY `compras_FKIndex2` (`epis_id`);

--
-- Indexes for table `devolucao`
--
ALTER TABLE `devolucao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `devolucao_FKIndex1` (`funcionarios_retira_id`);

--
-- Indexes for table `epis`
--
ALTER TABLE `epis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`idfornecedor`);

--
-- Indexes for table `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`idfuncionario`);

--
-- Indexes for table `funcionarios_retira`
--
ALTER TABLE `funcionarios_retira`
  ADD PRIMARY KEY (`id`),
  ADD KEY `funcionarios_retira_EPIs_FKIndex3` (`almoxarife_id`),
  ADD KEY `funcionarios_retira_FKIndex2` (`epis_id`),
  ADD KEY `funcionarios_retira_FKIndex3` (`funcionarios_idfuncionario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alerta`
--
ALTER TABLE `alerta`
  MODIFY `idalerta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `almoxarife`
--
ALTER TABLE `almoxarife`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `aviso`
--
ALTER TABLE `aviso`
  MODIFY `idaviso` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `compras`
--
ALTER TABLE `compras`
  MODIFY `idcompra` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `devolucao`
--
ALTER TABLE `devolucao`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `epis`
--
ALTER TABLE `epis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `idfornecedor` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `idfuncionario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `funcionarios_retira`
--
ALTER TABLE `funcionarios_retira`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alerta`
--
ALTER TABLE `alerta`
  ADD CONSTRAINT `alerta_ibfk_1` FOREIGN KEY (`epis_id`) REFERENCES `epis` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `aviso`
--
ALTER TABLE `aviso`
  ADD CONSTRAINT `aviso_ibfk_1` FOREIGN KEY (`almoxarife_id`) REFERENCES `almoxarife` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`fornecedor_idfornecedor`) REFERENCES `fornecedor` (`idfornecedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`epis_id`) REFERENCES `epis` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `devolucao`
--
ALTER TABLE `devolucao`
  ADD CONSTRAINT `devolucao_ibfk_1` FOREIGN KEY (`funcionarios_retira_id`) REFERENCES `funcionarios_retira` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `funcionarios_retira`
--
ALTER TABLE `funcionarios_retira`
  ADD CONSTRAINT `funcionarios_retira_ibfk_1` FOREIGN KEY (`almoxarife_id`) REFERENCES `almoxarife` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `funcionarios_retira_ibfk_2` FOREIGN KEY (`epis_id`) REFERENCES `epis` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
