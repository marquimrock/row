-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 01-Dez-2018 às 14:15
-- Versão do servidor: 10.1.36-MariaDB
-- versão do PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hostinformatic05`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cliente`
--

CREATE TABLE `tb_cliente` (
  `id` int(8) NOT NULL,
  `cnpj` varchar(14) NOT NULL,
  `razao_social` varchar(50) NOT NULL,
  `nome_fantasia` varchar(50) NOT NULL,
  `telefone` varchar(14) NOT NULL,
  `email` varchar(50) NOT NULL,
  `qnt_pdv` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_cliente`
--

INSERT INTO `tb_cliente` (`id`, `cnpj`, `razao_social`, `nome_fantasia`, `telefone`, `email`, `qnt_pdv`) VALUES
(1, '18532091000171', 'Razao social teste', '', '', '', 2),
(2, '11111111111111', 'Razao social teste', 'Marcos  Antonio Cunha', '6184467878', 'marquim.ti@gmail.com', 1),
(3, '12121212111111', 'teste', 'teste', '6199989', 'marquim.ti@gmail.com', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_licenca`
--

CREATE TABLE `tb_licenca` (
  `id` int(10) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_tipo_licenca` int(11) NOT NULL,
  `serie` varchar(30) NOT NULL,
  `senha` varchar(30) NOT NULL,
  `data_vencimento` datetime NOT NULL,
  `data_inclusao` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_licenca`
--

INSERT INTO `tb_licenca` (`id`, `id_cliente`, `id_tipo_licenca`, `serie`, `senha`, `data_vencimento`, `data_inclusao`, `status`) VALUES
(9, 1, 1, '1', '12345678901234567890', '2018-12-01 00:00:00', '2018-12-01 00:00:00', 0),
(10, 1, 1, '2', '12345678901234567890', '2018-12-01 00:00:00', '2018-12-01 00:00:00', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_tipo_licenca`
--

CREATE TABLE `tb_tipo_licenca` (
  `id` int(10) NOT NULL,
  `codigo` int(10) NOT NULL,
  `sistema` varchar(10) NOT NULL,
  `descricao` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_tipo_licenca`
--

INSERT INTO `tb_tipo_licenca` (`id`, `codigo`, `sistema`, `descricao`) VALUES
(1, 1, 'NFC-e', 'Instalacao');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_cliente`
--
ALTER TABLE `tb_cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_licenca`
--
ALTER TABLE `tb_licenca`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_tipo_licenca` (`id_tipo_licenca`);

--
-- Indexes for table `tb_tipo_licenca`
--
ALTER TABLE `tb_tipo_licenca`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_cliente`
--
ALTER TABLE `tb_cliente`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_licenca`
--
ALTER TABLE `tb_licenca`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_tipo_licenca`
--
ALTER TABLE `tb_tipo_licenca`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tb_licenca`
--
ALTER TABLE `tb_licenca`
  ADD CONSTRAINT `id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `tb_cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_tipo_licenca` FOREIGN KEY (`id_tipo_licenca`) REFERENCES `tb_tipo_licenca` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
