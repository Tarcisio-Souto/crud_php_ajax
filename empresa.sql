-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19-Jun-2021 às 23:09
-- Versão do servidor: 10.4.18-MariaDB
-- versão do PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `empresa`
--

CREATE DATABASE `empresa`;
USE `empresa`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `anotacao`
--

CREATE TABLE `anotacao` (
  `id_anotacao` int(11) NOT NULL,
  `descricao` text DEFAULT NULL,
  `fk_id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro_empresa`
--

CREATE TABLE `cadastro_empresa` (
  `id_empresa` int(11) NOT NULL,
  `nome_empresarial` varchar(100) DEFAULT NULL,
  `data_abertura` date DEFAULT NULL,
  `porte` varchar(20) DEFAULT NULL,
  `situacao_cadastral` varchar(20) DEFAULT NULL,
  `cnpj` varchar(18) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cadastro_empresa`
--

INSERT INTO `cadastro_empresa` (`id_empresa`, `nome_empresarial`, `data_abertura`, `porte`, `situacao_cadastral`, `cnpj`) VALUES
(1, 'Tarcisio Developer', '1993-02-26', 'ME', 'Ativa', '85.337.752/0001-03');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoas`
--

CREATE TABLE `pessoas` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `dataNasc` date DEFAULT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `idade` varchar(3) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pessoas`
--

INSERT INTO `pessoas` (`id`, `nome`, `dataNasc`, `cpf`, `celular`, `idade`, `email`, `senha`) VALUES
(39, 'admin', '1993-02-26', '111.222.333-44', '(27) 99999-9999', '28', 'tss.labsi@gmail.com', '205db7c302d87a8dabae9d3924d4a7e0');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `anotacao`
--
ALTER TABLE `anotacao`
  ADD PRIMARY KEY (`id_anotacao`),
  ADD KEY `fkIdUsuario` (`fk_id_usuario`);

--
-- Índices para tabela `cadastro_empresa`
--
ALTER TABLE `cadastro_empresa`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Índices para tabela `pessoas`
--
ALTER TABLE `pessoas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `anotacao`
--
ALTER TABLE `anotacao`
  MODIFY `id_anotacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `pessoas`
--
ALTER TABLE `pessoas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `anotacao`
--
ALTER TABLE `anotacao`
  ADD CONSTRAINT `fkIdUsuario` FOREIGN KEY (`fk_id_usuario`) REFERENCES `pessoas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
