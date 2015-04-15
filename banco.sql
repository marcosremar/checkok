-- phpMyAdmin SQL Dump
-- version 4.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 15, 2015 at 02:45 PM
-- Server version: 5.5.41-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `meu_banco`
--

-- --------------------------------------------------------

--
-- Table structure for table `pesquisa`
--

CREATE TABLE IF NOT EXISTS `pesquisa` (
  `id_consulta` int(11) NOT NULL,
  `requisicao_temperatura` float DEFAULT NULL,
  `requisicao_tipo` char(1) DEFAULT NULL,
  `resposta_temperatura` float DEFAULT NULL,
  `datahora_consulta` timestamp NULL DEFAULT NULL,
  `ip_requisitante` varchar(16) DEFAULT NULL,
  `xml_gerado` blob
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pesquisa`
--
ALTER TABLE `pesquisa`
  ADD PRIMARY KEY (`id_consulta`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pesquisa`
--
ALTER TABLE `pesquisa`
  MODIFY `id_consulta` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
