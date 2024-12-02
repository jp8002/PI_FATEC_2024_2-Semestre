-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2024 at 06:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `atualiza_estoque`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `atualiza_estoque` (IN `id_epi` INT, IN `quantidade` INT, IN `acao` CHAR)   begin
		
		if acao = "R" then
			UPDATE epis SET estoque = estoque - quantidade WHERE id = id_epi; 
		
		ELSEif acao = "D" then
			UPDATE epis SET estoque = estoque + quantidade WHERE id = id_epi; 
		end if;
	END$$

DROP PROCEDURE IF EXISTS `cadastrar_fornecedor`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `cadastrar_fornecedor` (IN `nome` CHAR(100), IN `cnpj` CHAR(14), `telefone` CHAR(11))   BEGIN

	INSERT INTO fornecedor VALUES(null, nome, cnpj, telefone);

END$$

DROP PROCEDURE IF EXISTS `cadastrar_funcionario`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `cadastrar_funcionario` (IN `nome` CHAR(25))   BEGIN

	INSERT INTO funcionarios VALUES(null, nome);

END$$

DROP PROCEDURE IF EXISTS `registrar_devolucao`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `registrar_devolucao` (IN `id_retirada` INT, IN `comentario` CHAR(255))   begin
  
  	UPDATE funcionarios_retira  SET devolvido = 1, data_devolucao	= NOW(), comentario_devolucao = comentario WHERE id = id_retirada;  
  
  END$$

DROP PROCEDURE IF EXISTS `registrar_saida`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `registrar_saida` (IN `idepi` INT, IN `idalmoxarife` INT, IN `nquantidade` INT, IN `id_funcionario` INT)   BEGIN 
		
		INSERT INTO funcionarios_retira (epis_id, almoxarife_id, data_retirada, quantidade, funcionarios_idfuncionario)
				 VALUES (idepi, idalmoxarife, NOW(), nquantidade, id_funcionario);
	
	END$$

DROP PROCEDURE IF EXISTS `ver_entradas`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ver_entradas` ()   BEGIN

	SELECT fr.id, f.nome_funcionario, e.nome, fr.data_retirada, fr.data_devolucao, fr.comentario_devolucao 
	FROM funcionarios_retira fr, epis e, funcionarios f 
	where fr.funcionarios_idfuncionario = f.idfuncionario and fr.epis_id = e.id and fr.devolvido = 1; 

END$$

DROP PROCEDURE IF EXISTS `ver_estoque`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ver_estoque` (IN `pesquisa` CHAR(45))   BEGIN

	SELECT * FROM epis e WHERE e.nome like pesquisa;

END$$

DROP PROCEDURE IF EXISTS `ver_saidas`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ver_saidas` ()   BEGIN

	SELECT fr.id, e.nome, f.nome_funcionario, fr.quantidade, fr.data_retirada, a.usuario 
	FROM funcionarios_retira fr, almoxarife a, epis e, funcionarios f 
	WHERE fr.epis_id = e.id and fr.almoxarife_id = a.id and fr.funcionarios_idfuncionario = f.idfuncionario;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `almoxarife`
--

DROP TABLE IF EXISTS `almoxarife`;
CREATE TABLE `almoxarife` (
  `id` int(10) UNSIGNED NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `senha` varchar(60) NOT NULL,
  `tipo` varchar(25) DEFAULT 'normal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `almoxarife`
--

INSERT INTO `almoxarife` (`id`, `usuario`, `senha`, `tipo`) VALUES
(1, 'adm', '$2a$12$5ws2ttzW4bk8.W11ZS5JzefOiZ4YHUV.CE2dsqJ32QcOCEp9Ka6Zu
', 'supervisor');

-- --------------------------------------------------------

--
-- Table structure for table `aviso`
--

DROP TABLE IF EXISTS `aviso`;
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

DROP TABLE IF EXISTS `compras`;
CREATE TABLE `compras` (
  `idcompra` int(10) UNSIGNED NOT NULL,
  `epis_id` int(10) UNSIGNED NOT NULL,
  `fornecedor_idfornecedor` int(10) UNSIGNED NOT NULL,
  `data_entrega` date NOT NULL,
  `quantidade` int(10) UNSIGNED NOT NULL,
  `preco_total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `compras`
--
DROP TRIGGER IF EXISTS `TGR_compra_epi`;
DELIMITER $$
CREATE TRIGGER `TGR_compra_epi` AFTER INSERT ON `compras` FOR EACH ROW begin
		
		UPDATE epis e SET estoque = estoque + NEW.quantidade WHERE NEW.epis_id= e.id;
	
	END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `epis`
--

DROP TABLE IF EXISTS `epis`;
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

DROP TABLE IF EXISTS `fornecedor`;
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

DROP TABLE IF EXISTS `funcionarios`;
CREATE TABLE `funcionarios` (
  `idfuncionario` int(10) UNSIGNED NOT NULL,
  `nome_funcionario` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `funcionarios_retira`
--

DROP TABLE IF EXISTS `funcionarios_retira`;
CREATE TABLE `funcionarios_retira` (
  `id` int(10) UNSIGNED NOT NULL,
  `funcionarios_idfuncionario` int(10) UNSIGNED NOT NULL,
  `epis_id` int(10) UNSIGNED NOT NULL,
  `almoxarife_id` int(10) UNSIGNED NOT NULL,
  `data_retirada` date NOT NULL,
  `quantidade` int(10) UNSIGNED NOT NULL,
  `devolvido` tinyint(1) DEFAULT 0,
  `data_devolucao` date NOT NULL,
  `comentario_devolucao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `funcionarios_retira`
--
DROP TRIGGER IF EXISTS `TGR_devolve_epi`;
DELIMITER $$
CREATE TRIGGER `TGR_devolve_epi` AFTER UPDATE ON `funcionarios_retira` FOR EACH ROW begin
		
		CALL atualiza_estoque(OLD.epis_id, old.quantidade, "D");
	
	END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `TRG_retirada_epi`;
DELIMITER $$
CREATE TRIGGER `TRG_retirada_epi` AFTER INSERT ON `funcionarios_retira` FOR EACH ROW BEGIN 
	
		CALL atualiza_estoque(NEW.epis_id, NEW.quantidade ,"R");
	
	END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `almoxarife`
--
ALTER TABLE `almoxarife`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- Constraints for table `aviso`
--
ALTER TABLE `aviso`
  ADD CONSTRAINT `aviso_ibfk_1` FOREIGN KEY (`almoxarife_id`) REFERENCES `almoxarife` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`fornecedor_idfornecedor`) REFERENCES `fornecedor` (`idfornecedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`epis_id`) REFERENCES `epis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `funcionarios_retira`
--
ALTER TABLE `funcionarios_retira`
  ADD CONSTRAINT `funcionarios_retira_ibfk_1` FOREIGN KEY (`almoxarife_id`) REFERENCES `almoxarife` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `funcionarios_retira_ibfk_2` FOREIGN KEY (`epis_id`) REFERENCES `epis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `funcionarios_retira_ibfk_3` FOREIGN KEY (`funcionarios_idfuncionario`) REFERENCES `funcionarios` (`idfuncionario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
