-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 23-Jan-2023 às 21:24
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `login`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `sits_usuarios`
--

DROP TABLE IF EXISTS `sits_usuarios`;
CREATE TABLE IF NOT EXISTS `sits_usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome_situacao` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `sits_usuarios`
--

INSERT INTO `sits_usuarios` (`id`, `nome_situacao`) VALUES
(1, 'ativo'),
(2, 'inativo'),
(3, 'aguardando confirmação');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(24) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(24) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(24) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chave` varchar(220) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sits_usuario_id` int NOT NULL DEFAULT '3',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `chave`, `sits_usuario_id`) VALUES
(45, 'eu', 'eu@testando.com', '$2y$10$6AnMYK2NWWw6aSDgF', NULL, 1),
(46, 'teste2', 'teste@testando.com', '123', NULL, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
