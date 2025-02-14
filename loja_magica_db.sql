-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14/02/2025 às 01:55
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
-- Banco de dados: `loja_magica_db`
--
CREATE DATABASE IF NOT EXISTS `loja_magica_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `loja_magica_db`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `client_order_history`
--

CREATE TABLE `client_order_history` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `client_name` varchar(200) DEFAULT NULL,
  `client_email` varchar(100) DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL,
  `last_order_date` date DEFAULT NULL,
  `last_order_value` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `store_order`
--

CREATE TABLE `store_order` (
  `id` int(11) NOT NULL,
  `store_id` varchar(100) DEFAULT NULL,
  `store_name` varchar(100) DEFAULT NULL,
  `store_location` varchar(100) DEFAULT NULL,
  `product_description` varchar(100) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `client_order_history`
--
ALTER TABLE `client_order_history`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `store_order`
--
ALTER TABLE `store_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `client_order_history`
--
ALTER TABLE `client_order_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `store_order`
--
ALTER TABLE `store_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
