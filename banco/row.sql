-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 31-Jul-2019 às 17:37
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
  `id_cliente` int(11) NOT NULL,
  `data_abertura` date NOT NULL,
  `hora_abertura` time(6) NOT NULL,
  `solicitante` varchar(50) NOT NULL,
  `ocorrencia` varchar(250) NOT NULL,
  `status` varchar(20) NOT NULL,
  `data_fechamento` date NOT NULL,
  `hora_fechamento` time(6) NOT NULL,
  `tecnico_fechamento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_chamado`
--

INSERT INTO `tb_chamado` (`id`, `id_usuario`, `id_cliente`, `data_abertura`, `hora_abertura`, `solicitante`, `ocorrencia`, `status`, `data_fechamento`, `hora_fechamento`, `tecnico_fechamento`) VALUES
(65, 6, 1, '2019-07-31', '05:37:00.000000', 'ADFASDF', 'ASDF', '6', '0000-00-00', '00:00:00.000000', 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cliente`
--

CREATE TABLE `tb_cliente` (
  `id` int(11) NOT NULL,
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
(1, '18532091000171', 'HOST AUTOMACAO COMERCIAL LTDA', 'HOST AUTOMACAO', '61999047342', 'leandro@hostautomacao.com.br', 1);

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
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `tecnico_fechamento` (`tecnico_fechamento`),
  ADD KEY `cliente` (`id_cliente`);

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
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `tb_cliente`
--
ALTER TABLE `tb_cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `cliente` FOREIGN KEY (`id_cliente`) REFERENCES `tb_cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
