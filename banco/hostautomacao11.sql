-- phpMyAdmin SQL Dump
-- version 3.3.3
-- http://www.phpmyadmin.net
--
-- Servidor: mysql08-farm51.kinghost.net
-- Tempo de Geração: Jan 26, 2019 as 09:19 AM
-- Versão do Servidor: 5.5.43
-- Versão do PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

DROP DATABASE IF EXISTS hostautomacao11;
CREATE DATABASE IF NOT EXISTS hostautomacao11 CHARACTER SET utf8 COLLATE utf8_general_ci;
USE hostautomacao11;
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `tb_codigo_licenca` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `codigo` int(10) NOT NULL,
  `descricao` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `tb_tipo_sistema` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sistema` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `tb_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `usuario` text NOT NULL,
  `senha` text NOT NULL,
  `adm` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `tb_estado` (
  `id` int(2) NOT NULL auto_increment,
  `uf` varchar(10) NOT NULL,
  `nome` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `tb_cidade` (
  `id` int(4) NOT NULL auto_increment,
  `estado` int(2) NOT NULL,
  `uf` varchar(4) NOT NULL,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `tb_cliente` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_cidade` int(11) NOT NULL,
  `id_uf` int(11) NOT NULL,
  `cnpj` varchar(14) NOT NULL,
  `inscricao_estadual` varchar(14) NOT NULL,
  `razao_social` varchar(50) NOT NULL,
  `nome_fantasia` varchar(50) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `logradouro` varchar(45) NOT NULL,
  `numero` varchar(4) NOT NULL,
  `bairro` varchar(25) NOT NULL,
  `telefone` varchar(14) NOT NULL,
  `celular1` varchar(14) NOT NULL,
  `celular2` varchar(14) NOT NULL,
  `email` varchar(50) NOT NULL,
  `qnt_pdv` int(10) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cidade` (`id_cidade`),
  KEY `id_uf` (`id_uf`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `tb_licenca` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `id_codigo_licenca` int(11) NOT NULL,
  `id_tipo_sistema` int(11) NOT NULL,
  `serie` varchar(30) NOT NULL,
  `senha` varchar(30) NOT NULL,
  `data_vencimento` datetime NOT NULL,
  `data_inclusao` datetime NOT NULL,
  `data_utilizacao` datetime DEFAULT NULL,
  `utilizado` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_codigo_licenca` (`id_codigo_licenca`),
  KEY `id_tipo_sistema` (`id_tipo_sistema`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- --------------------------------------------------------

ALTER TABLE `tb_cliente`
  ADD CONSTRAINT `id_uf` FOREIGN KEY (`id_uf`) REFERENCES `tb_estado` (`id`),
  ADD CONSTRAINT `id_cidade` FOREIGN KEY (`id_cidade`) REFERENCES `tb_cidade` (`id`);

ALTER TABLE `tb_licenca`
  ADD CONSTRAINT `id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `tb_cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_codigo_licenca` FOREIGN KEY (`id_codigo_licenca`) REFERENCES `tb_codigo_licenca` (`id`),
  ADD CONSTRAINT `id_tipo_sistema` FOREIGN KEY (`id_tipo_sistema`) REFERENCES `tb_tipo_sistema` (`id`);

ALTER TABLE `tb_licenca` ADD UNIQUE(`senha`);

-- --------------------------------------------------------

INSERT INTO `tb_codigo_licenca` (`id`, `codigo`, `descricao`) VALUES (1, 1, 'Instalacao');
INSERT INTO `tb_codigo_licenca` (`id`, `codigo`, `descricao`) VALUES (2, 3, 'Semestralidade');

-- --------------------------------------------------------

INSERT INTO `tb_tipo_sistema` (`id`, `sistema`) VALUES (1, 'Mobility Pos');
INSERT INTO `tb_tipo_sistema` (`id`, `sistema`) VALUES (2, 'Droid Pdv');
INSERT INTO `tb_tipo_sistema` (`id`, `sistema`) VALUES (3, 'Gestao Home');
INSERT INTO `tb_tipo_sistema` (`id`, `sistema`) VALUES (4, 'Gestao Estoque');
INSERT INTO `tb_tipo_sistema` (`id`, `sistema`) VALUES (5, 'Gestao Nfe');
INSERT INTO `tb_tipo_sistema` (`id`, `sistema`) VALUES (6, 'Delivery');
INSERT INTO `tb_tipo_sistema` (`id`, `sistema`) VALUES (7, 'Premium');
INSERT INTO `tb_tipo_sistema` (`id`, `sistema`) VALUES (8, 'Premium Food');
INSERT INTO `tb_tipo_sistema` (`id`, `sistema`) VALUES (9, 'Enterprise');
INSERT INTO `tb_tipo_sistema` (`id`, `sistema`) VALUES (10, 'Enterprise Food');
INSERT INTO `tb_tipo_sistema` (`id`, `sistema`) VALUES (11, 'TEF POS');
INSERT INTO `tb_tipo_sistema` (`id`, `sistema`) VALUES (12, 'TEF Dedicado');

-- --------------------------------------------------------

INSERT INTO `tb_usuario` (`id`, `nome`, `usuario`, `senha`, `adm`) VALUES (1, 'ADMINISTRADOR', 'ADMIN', 'MTIz', '1');

-- --------------------------------------------------------

INSERT INTO `tb_estado` (`id`, `uf`, `nome`) VALUES (7, 'DF', 'Distrito Federal');
INSERT INTO `tb_estado` (`id`, `uf`, `nome`) VALUES (9, 'GO', 'Goiás');

-- --------------------------------------------------------


INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (1724, 7, 'DF', 'Brasilia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (1725, 7, 'DF', 'Brazlandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (1726, 7, 'DF', 'Candangolandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (1727, 7, 'DF', 'Ceilandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (1728, 7, 'DF', 'Cruzeiro');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (1729, 7, 'DF', 'Gama');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (1730, 7, 'DF', 'Guara');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (1731, 7, 'DF', 'Lago Norte');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (1732, 7, 'DF', 'Lago Sul');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (1733, 7, 'DF', 'Nucleo Bandeirante');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (1734, 7, 'DF', 'Paranoa');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (1735, 7, 'DF', 'Planaltina');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (1736, 7, 'DF', 'Recanto das Emas');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (1737, 7, 'DF', 'Riacho Fundo');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (1738, 7, 'DF', 'Samambaia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (1739, 7, 'DF', 'Santa Maria');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (1740, 7, 'DF', 'Sao Sebastiao');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (1741, 7, 'DF', 'Sobradinho');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (1742, 7, 'DF', 'Taguatinga');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (1995, 9, 'GO', 'Abadia de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (1996, 9, 'GO', 'Abadiania');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (1997, 9, 'GO', 'Acreuna');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (1998, 9, 'GO', 'Adelandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (1999, 9, 'GO', 'Agua Fria de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2000, 9, 'GO', 'Agua Limpa');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2001, 9, 'GO', 'Aguas Lindas de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2002, 9, 'GO', 'Alexania');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2003, 9, 'GO', 'Aloandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2004, 9, 'GO', 'Alto Alvorada');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2005, 9, 'GO', 'Alto Horizonte');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2006, 9, 'GO', 'Alto Paraiso de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2007, 9, 'GO', 'Alvorada do Norte');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2008, 9, 'GO', 'Amaralina');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2009, 9, 'GO', 'Americano do Brasil');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2010, 9, 'GO', 'Amorinopolis');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2011, 9, 'GO', 'Anapolis');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2012, 9, 'GO', 'Anhanguera');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2013, 9, 'GO', 'Anicuns');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2014, 9, 'GO', 'Aparecida');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2015, 9, 'GO', 'Aparecida de Goiania');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2016, 9, 'GO', 'Aparecida de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2017, 9, 'GO', 'Aparecida do Rio Claro');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2018, 9, 'GO', 'Aparecida do Rio Doce');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2019, 9, 'GO', 'Apore');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2020, 9, 'GO', 'Aracu');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2021, 9, 'GO', 'Aragarcas');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2022, 9, 'GO', 'Aragoiania');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2023, 9, 'GO', 'Araguapaz');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2024, 9, 'GO', 'Arenopolis');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2025, 9, 'GO', 'Aruana');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2026, 9, 'GO', 'Aurilandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2027, 9, 'GO', 'Auriverde');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2028, 9, 'GO', 'Avelinopolis');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2029, 9, 'GO', 'Bacilandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2030, 9, 'GO', 'Baliza');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2031, 9, 'GO', 'Bandeirantes');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2032, 9, 'GO', 'Barbosilandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2033, 9, 'GO', 'Barro Alto');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2034, 9, 'GO', 'Bela Vista de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2035, 9, 'GO', 'Bom Jardim de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2036, 9, 'GO', 'Bom Jesus de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2037, 9, 'GO', 'Bonfinopolis');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2038, 9, 'GO', 'Bonopolis');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2039, 9, 'GO', 'Brazabrantes');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2040, 9, 'GO', 'Britania');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2041, 9, 'GO', 'Buenolandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2042, 9, 'GO', 'Buriti Alegre');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2043, 9, 'GO', 'Buriti de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2044, 9, 'GO', 'Buritinopolis');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2045, 9, 'GO', 'Cabeceiras');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2046, 9, 'GO', 'Cachoeira Alta');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2047, 9, 'GO', 'Cachoeira de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2048, 9, 'GO', 'Cachoeira Dourada');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2049, 9, 'GO', 'Cacu');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2050, 9, 'GO', 'Caiaponia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2051, 9, 'GO', 'Caicara');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2052, 9, 'GO', 'Calcilandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2053, 9, 'GO', 'Caldas Novas');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2054, 9, 'GO', 'Caldazinha');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2055, 9, 'GO', 'Calixto');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2056, 9, 'GO', 'Campestre de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2057, 9, 'GO', 'Campinacu');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2058, 9, 'GO', 'Campinorte');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2059, 9, 'GO', 'Campo Alegre de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2060, 9, 'GO', 'Campo Limpo');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2061, 9, 'GO', 'Campolandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2062, 9, 'GO', 'Campos Belos');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2063, 9, 'GO', 'Campos Verdes');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2064, 9, 'GO', 'Cana Brava');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2065, 9, 'GO', 'Canada');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2066, 9, 'GO', 'Capelinha');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2067, 9, 'GO', 'Caraiba');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2068, 9, 'GO', 'Carmo do Rio Verde');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2069, 9, 'GO', 'Castelandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2070, 9, 'GO', 'Castrinopolis');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2071, 9, 'GO', 'Catalao');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2072, 9, 'GO', 'Caturai');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2073, 9, 'GO', 'Cavalcante');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2074, 9, 'GO', 'Cavalheiro');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2075, 9, 'GO', 'Cebrasa');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2076, 9, 'GO', 'Ceres');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2077, 9, 'GO', 'Cezarina');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2078, 9, 'GO', 'Chapadao do Ceu');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2079, 9, 'GO', 'Choupana');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2080, 9, 'GO', 'Cibele');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2081, 9, 'GO', 'Cidade Ocidental');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2082, 9, 'GO', 'Cirilandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2083, 9, 'GO', 'Cocalzinho de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2084, 9, 'GO', 'Colinas do Sul');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2085, 9, 'GO', 'Corrego do Ouro');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2086, 9, 'GO', 'Corrego Rico');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2087, 9, 'GO', 'Corumba de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2088, 9, 'GO', 'Corumbaiba');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2089, 9, 'GO', 'Cristalina');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2090, 9, 'GO', 'Cristianopolis');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2091, 9, 'GO', 'Crixas');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2092, 9, 'GO', 'Crominia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2093, 9, 'GO', 'Cruzeiro do Norte');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2094, 9, 'GO', 'Cumari');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2095, 9, 'GO', 'Damianopolis');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2096, 9, 'GO', 'Damolandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2097, 9, 'GO', 'Davidopolis');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2098, 9, 'GO', 'Davinopolis');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2099, 9, 'GO', 'Diolandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2100, 9, 'GO', 'Diorama');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2101, 9, 'GO', 'Divinopolis de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2102, 9, 'GO', 'Domiciano Ribeiro');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2103, 9, 'GO', 'Doverlandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2104, 9, 'GO', 'Edealina');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2105, 9, 'GO', 'Edeia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2106, 9, 'GO', 'Estrela do Norte');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2107, 9, 'GO', 'Faina');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2108, 9, 'GO', 'Fazenda Nova');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2109, 9, 'GO', 'Firminopolis');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2110, 9, 'GO', 'Flores de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2111, 9, 'GO', 'Formosa');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2112, 9, 'GO', 'Formoso');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2113, 9, 'GO', 'Forte');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2114, 9, 'GO', 'Gameleira de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2115, 9, 'GO', 'Geriacu');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2116, 9, 'GO', 'Goialandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2117, 9, 'GO', 'Goianapolis');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2118, 9, 'GO', 'Goiandira');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2119, 9, 'GO', 'Goianesia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2120, 9, 'GO', 'Goiania');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2121, 9, 'GO', 'Goianira');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2122, 9, 'GO', 'Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2123, 9, 'GO', 'Goiatuba');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2124, 9, 'GO', 'Gouvelandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2125, 9, 'GO', 'Guapo');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2126, 9, 'GO', 'Guaraita');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2127, 9, 'GO', 'Guarani de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2128, 9, 'GO', 'Guarinos');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2129, 9, 'GO', 'Heitorai');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2130, 9, 'GO', 'Hidrolandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2131, 9, 'GO', 'Hidrolina');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2132, 9, 'GO', 'Iaciara');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2133, 9, 'GO', 'Inaciolandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2134, 9, 'GO', 'Indiara');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2135, 9, 'GO', 'Inhumas');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2136, 9, 'GO', 'Interlandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2137, 9, 'GO', 'Ipameri');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2138, 9, 'GO', 'Ipora');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2139, 9, 'GO', 'Israelandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2140, 9, 'GO', 'Itaberai');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2141, 9, 'GO', 'Itaguacu');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2142, 9, 'GO', 'Itaguari');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2143, 9, 'GO', 'Itaguaru');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2144, 9, 'GO', 'Itaja');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2145, 9, 'GO', 'Itapaci');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2146, 9, 'GO', 'Itapirapua');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2147, 9, 'GO', 'Itapuranga');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2148, 9, 'GO', 'Itaruma');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2149, 9, 'GO', 'Itaucu');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2150, 9, 'GO', 'Itumbiara');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2151, 9, 'GO', 'Ivolandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2152, 9, 'GO', 'Jacilandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2153, 9, 'GO', 'Jandaia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2154, 9, 'GO', 'Jaragua');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2155, 9, 'GO', 'Jatai');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2156, 9, 'GO', 'Jaupaci');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2157, 9, 'GO', 'Jeroaquara');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2158, 9, 'GO', 'Jesupolis');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2159, 9, 'GO', 'Joanapolis');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2160, 9, 'GO', 'Joviania');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2161, 9, 'GO', 'Juscelandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2162, 9, 'GO', 'Juscelino Kubitschek');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2163, 9, 'GO', 'Jussara');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2164, 9, 'GO', 'Lagoa do Bauzinho');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2165, 9, 'GO', 'Lagolandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2166, 9, 'GO', 'Leopoldo de Bulhoes');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2167, 9, 'GO', 'Lucilandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2168, 9, 'GO', 'Luziania');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2169, 9, 'GO', 'Mairipotaba');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2170, 9, 'GO', 'Mambai');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2171, 9, 'GO', 'Mara Rosa');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2172, 9, 'GO', 'Marcianopolis');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2173, 9, 'GO', 'Marzagao');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2174, 9, 'GO', 'Matrincha');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2175, 9, 'GO', 'Maurilandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2176, 9, 'GO', 'Meia Ponte');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2177, 9, 'GO', 'Messianopolis');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2178, 9, 'GO', 'Mimoso de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2179, 9, 'GO', 'Minacu');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2180, 9, 'GO', 'Mineiros');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2181, 9, 'GO', 'Moipora');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2182, 9, 'GO', 'Monte Alegre de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2183, 9, 'GO', 'Montes Claros de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2184, 9, 'GO', 'Montividiu');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2185, 9, 'GO', 'Montividiu do Norte');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2186, 9, 'GO', 'Morrinhos');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2187, 9, 'GO', 'Morro Agudo de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2188, 9, 'GO', 'Mossamedes');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2189, 9, 'GO', 'Mozarlandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2190, 9, 'GO', 'Mundo Novo');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2191, 9, 'GO', 'Mutunopolis');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2192, 9, 'GO', 'Natinopolis');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2193, 9, 'GO', 'Nazario');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2194, 9, 'GO', 'Neropolis');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2195, 9, 'GO', 'Niquelandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2196, 9, 'GO', 'Nova America');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2197, 9, 'GO', 'Nova Aurora');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2198, 9, 'GO', 'Nova Crixas');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2199, 9, 'GO', 'Nova Gloria');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2200, 9, 'GO', 'Nova Iguacu de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2201, 9, 'GO', 'Nova Roma');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2202, 9, 'GO', 'Nova Veneza');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2203, 9, 'GO', 'Novo Brasil');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2204, 9, 'GO', 'Novo Gama');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2205, 9, 'GO', 'Novo Planalto');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2206, 9, 'GO', 'Olaria do Angico');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2207, 9, 'GO', 'Olhos D''agua');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2208, 9, 'GO', 'Orizona');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2209, 9, 'GO', 'Ouro Verde de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2210, 9, 'GO', 'Ouroana');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2211, 9, 'GO', 'Ouvidor');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2212, 9, 'GO', 'Padre Bernardo');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2213, 9, 'GO', 'Palestina de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2214, 9, 'GO', 'Palmeiras de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2215, 9, 'GO', 'Palmelo');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2216, 9, 'GO', 'Palminopolis');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2217, 9, 'GO', 'Panama');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2218, 9, 'GO', 'Paranaiguara');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2219, 9, 'GO', 'Parauna');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2220, 9, 'GO', 'Pau-terra');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2221, 9, 'GO', 'Pedra Branca');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2222, 9, 'GO', 'Perolandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2223, 9, 'GO', 'Petrolina de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2224, 9, 'GO', 'Pilar de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2225, 9, 'GO', 'Piloandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2226, 9, 'GO', 'Piracanjuba');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2227, 9, 'GO', 'Piranhas');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2228, 9, 'GO', 'Pirenopolis');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2229, 9, 'GO', 'Pires Belo');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2230, 9, 'GO', 'Pires do Rio');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2231, 9, 'GO', 'Planaltina');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2232, 9, 'GO', 'Pontalina');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2233, 9, 'GO', 'Porangatu');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2234, 9, 'GO', 'Porteirao');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2235, 9, 'GO', 'Portelandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2236, 9, 'GO', 'Posse');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2237, 9, 'GO', 'Posse D''abadia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2238, 9, 'GO', 'Professor Jamil');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2239, 9, 'GO', 'Quirinopolis');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2240, 9, 'GO', 'Registro do Araguaia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2241, 9, 'GO', 'Rialma');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2242, 9, 'GO', 'Rianapolis');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2243, 9, 'GO', 'Rio Quente');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2244, 9, 'GO', 'Rio Verde');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2245, 9, 'GO', 'Riverlandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2246, 9, 'GO', 'Rodrigues Nascimento');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2247, 9, 'GO', 'Rosalandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2248, 9, 'GO', 'Rubiataba');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2249, 9, 'GO', 'Sanclerlandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2250, 9, 'GO', 'Santa Barbara de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2251, 9, 'GO', 'Santa Cruz das Lajes');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2252, 9, 'GO', 'Santa Cruz de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2253, 9, 'GO', 'Santa Fe de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2254, 9, 'GO', 'Santa Helena de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2255, 9, 'GO', 'Santa Isabel');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2256, 9, 'GO', 'Santa Rita do Araguaia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2257, 9, 'GO', 'Santa Rita do Novo Destino');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2258, 9, 'GO', 'Santa Rosa');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2259, 9, 'GO', 'Santa Rosa de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2260, 9, 'GO', 'Santa Tereza de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2261, 9, 'GO', 'Santa Terezinha de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2262, 9, 'GO', 'Santo Antonio da Barra');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2263, 9, 'GO', 'Santo Antonio de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2264, 9, 'GO', 'Santo Antonio do Descoberto');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2265, 9, 'GO', 'Santo Antonio do Rio Verde');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2266, 9, 'GO', 'Sao Domingos');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2267, 9, 'GO', 'Sao Francisco de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2268, 9, 'GO', 'Sao Gabriel de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2269, 9, 'GO', 'Sao Joao');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2270, 9, 'GO', 'Sao Joao D''alianca');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2271, 9, 'GO', 'Sao Joao da Parauna');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2272, 9, 'GO', 'Sao Luis de Montes Belos');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2273, 9, 'GO', 'Sao Luiz do Norte');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2274, 9, 'GO', 'Sao Luiz do Tocantins');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2275, 9, 'GO', 'Sao Miguel do Araguaia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2276, 9, 'GO', 'Sao Miguel do Passa Quatro');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2277, 9, 'GO', 'Sao Patricio');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2278, 9, 'GO', 'Sao Sebastiao do Rio Claro');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2279, 9, 'GO', 'Sao Simao');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2280, 9, 'GO', 'Sao Vicente');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2281, 9, 'GO', 'Sarandi');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2282, 9, 'GO', 'Senador Canedo');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2283, 9, 'GO', 'Serra Dourada');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2284, 9, 'GO', 'Serranopolis');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2285, 9, 'GO', 'Silvania');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2286, 9, 'GO', 'Simolandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2287, 9, 'GO', 'Sitio D''abadia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2288, 9, 'GO', 'Sousania');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2289, 9, 'GO', 'Taquaral de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2290, 9, 'GO', 'Taveira');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2291, 9, 'GO', 'Teresina de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2292, 9, 'GO', 'Terezopolis de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2293, 9, 'GO', 'Termas do Itaja');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2294, 9, 'GO', 'Tres Ranchos');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2295, 9, 'GO', 'Trindade');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2296, 9, 'GO', 'Trombas');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2297, 9, 'GO', 'Tupiracaba');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2298, 9, 'GO', 'Turvania');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2299, 9, 'GO', 'Turvelandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2300, 9, 'GO', 'Uirapuru');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2301, 9, 'GO', 'Uruacu');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2302, 9, 'GO', 'Uruana');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2303, 9, 'GO', 'Uruita');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2304, 9, 'GO', 'Urutai');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2305, 9, 'GO', 'Uva');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2306, 9, 'GO', 'Valdelandia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2307, 9, 'GO', 'Valparaiso de Goias');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2308, 9, 'GO', 'Varjao');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2309, 9, 'GO', 'Vianopolis');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2310, 9, 'GO', 'Vicentinopolis');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2311, 9, 'GO', 'Vila Boa');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2312, 9, 'GO', 'Vila Brasilia');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2313, 9, 'GO', 'Vila Propicio');
INSERT INTO `tb_cidade` (`id`, `estado`, `uf`, `nome`) VALUES (2314, 9, 'GO', 'Vila Sertaneja');

-- --------------------------------------------------------

INSERT INTO `tb_cliente` (`id`, `id_cidade`, `id_uf`, `cnpj`, `inscricao_estadual`, `razao_social`, `nome_fantasia`, `cep`, `logradouro`, `numero`, `bairro`, `telefone`, `celular1`,`celular2`, `email`, `qnt_pdv`, `status`) VALUES 
(1, 2168, 9, '18532091000171', '100503315', 'HOST AUTOMACAO COMERCIAL LTDA', 'HOST AUTOMACAO', '72800000', 'RUA JOSE FRANCO PIMENTEL QD 73 LT 12', 'SN', 'CENTRO', '6136224088', '61992027898', '61999047342', 'leandro@hostautomacao.com.br', 1, 1);


  

