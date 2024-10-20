-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2024 at 07:57 PM
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
-- Table structure for table `almoxarife`
--

CREATE TABLE `almoxarife` (
  `id` int(10) UNSIGNED NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `senha` varchar(60) NOT NULL
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
-- Table structure for table `funcionarios_retira`
--

CREATE TABLE `funcionarios_retira` (
  `id` int(10) UNSIGNED NOT NULL,
  `epis_id` int(10) UNSIGNED NOT NULL,
  `almoxarife_id` int(10) UNSIGNED NOT NULL,
  `data_retirada` date NOT NULL,
  `quantidade` int(10) UNSIGNED NOT NULL,
  `nome_funcionario` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `almoxarife`
--
ALTER TABLE `almoxarife`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `funcionarios_retira`
--
ALTER TABLE `funcionarios_retira`
  ADD PRIMARY KEY (`id`,`epis_id`),
  ADD KEY `funcionarios_has_EPIs_FKIndex2` (`epis_id`),
  ADD KEY `funcionarios_retira_EPIs_FKIndex3` (`almoxarife_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `almoxarife`
--
ALTER TABLE `almoxarife`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `funcionarios_retira`
--
ALTER TABLE `funcionarios_retira`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `devolucao`
--
ALTER TABLE `devolucao`
  ADD CONSTRAINT `devolucao_ibfk_1` FOREIGN KEY (`funcionarios_retira_id`) REFERENCES `funcionarios_retira` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `funcionarios_retira`
--
ALTER TABLE `funcionarios_retira`
  ADD CONSTRAINT `funcionarios_retira_ibfk_1` FOREIGN KEY (`epis_id`) REFERENCES `epis` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `funcionarios_retira_ibfk_2` FOREIGN KEY (`almoxarife_id`) REFERENCES `almoxarife` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
