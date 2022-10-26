-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2022 at 12:13 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cadastro`
--
CREATE DATABASE IF NOT EXISTS `cadastro` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cadastro`;

-- --------------------------------------------------------

--
-- Table structure for table `contatos`
--

CREATE TABLE `contatos` (
  `primary_key` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `nome` varchar(256) DEFAULT NULL,
  `telefone` varchar(16) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dados`
--

CREATE TABLE `dados` (
  `primary_key` int(11) NOT NULL,
  `nome` varchar(256) NOT NULL,
  `nome_apelido` varchar(256) DEFAULT NULL,
  `cpf` int(11) NOT NULL,
  `data_nascimento` varchar(10) NOT NULL,
  `telefone` varchar(16) NOT NULL,
  `email` varchar(64) NOT NULL,
  `endereco` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`endereco`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contatos`
--
ALTER TABLE `contatos`
  ADD PRIMARY KEY (`primary_key`);

--
-- Indexes for table `dados`
--
ALTER TABLE `dados`
  ADD PRIMARY KEY (`primary_key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contatos`
--
ALTER TABLE `contatos`
  MODIFY `primary_key` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dados`
--
ALTER TABLE `dados`
  MODIFY `primary_key` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
