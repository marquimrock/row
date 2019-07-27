-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 27-Jul-2019 às 11:28
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
-- Database: `row`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_chamado`
--

CREATE TABLE `tb_chamado` (
  `id` int(20) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time(6) NOT NULL,
  `solicitante` varchar(50) NOT NULL,
  `ocorrencia` varchar(250) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_chamado`
--

INSERT INTO `tb_chamado` (`id`, `id_usuario`, `data`, `hora`, `solicitante`, `ocorrencia`, `status`) VALUES
(20, 6, '2019-07-27', '11:15:00.000000', 'ASDFASDF', 'ASDF', ''),
(21, 6, '2019-07-27', '11:17:00.000000', 'ASDFFFFFF', 'ASDFASFASDFASDF', ''),
(22, 6, '2019-07-27', '11:21:00.000000', 'ASA', 'ASDF', ''),
(23, 6, '2019-07-27', '11:27:00.000000', 'ASFDASDF', 'ASDFASDFASDF', '');

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
(10, 1, 1, '2', '12345678901234567890', '2018-12-01 00:00:00', '2018-12-01 00:00:00', 0),
(14, 2, 1, '2', '1111111', '2018-01-01 00:00:00', '2018-01-01 00:00:00', 0);

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuario`
--

CREATE TABLE `tb_usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `usuario` text NOT NULL,
  `senha` text NOT NULL,
  `adm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_usuario`
--

INSERT INTO `tb_usuario` (`id`, `nome`, `usuario`, `senha`, `adm`) VALUES
(1, 'ADMINISTRADOR', 'ADMIN', 'SE9TVA==', 1),
(2, 'MARCOS', 'MARCOS', 'bWFyY29z', 0),
(3, '', 'teste', 'teste', 0),
(4, '3', 'teste', 'teste', 0),
(6, 'HOST', 'HOST', 'SE9TVA==', 1),
(7, 'TESTE2', 'TESTE2', 'MTIz', 0),
(8, 'ASDF', 'ASDF', 'QVNERg==', 0),
(9, 'ADSF1', 'ADSF1', 'QURGMQ==', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_chamado`
--
ALTER TABLE `tb_chamado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

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
-- Indexes for table `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_chamado`
--
ALTER TABLE `tb_chamado`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tb_cliente`
--
ALTER TABLE `tb_cliente`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_licenca`
--
ALTER TABLE `tb_licenca`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_tipo_licenca`
--
ALTER TABLE `tb_tipo_licenca`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_usuario`
--
ALTER TABLE `tb_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tb_chamado`
--
ALTER TABLE `tb_chamado`
  ADD CONSTRAINT `tb_chamado_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuario` (`id`);

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
