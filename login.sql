-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 08-Mar-2023 às 00:57
-- Versão do servidor: 5.7.40
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
-- Estrutura da tabela `instituicao`
--

DROP TABLE IF EXISTS `instituicao`;
CREATE TABLE IF NOT EXISTS `instituicao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cnpj` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chave` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sits_instituicao_id` int(11) NOT NULL DEFAULT '3',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `instituicao`
--

INSERT INTO `instituicao` (`id`, `nome`, `email`, `cnpj`, `senha`, `chave`, `sits_instituicao_id`) VALUES
(10, '12345', '12@testando.com', '21215464987894', '12345', '$2y$10$PvEa0cBggI0Q9opnJg3Y/uTUFTv51xiLGtj4ypT9jPyTByPKZxR5G', 3),
(9, '1', '12@testando.com', '21215464987894', '12345', '$2y$10$2UEkGsPiMyLZt8fyL6g9kOl6aqQhVBYcqnPXi.jZX/yPI4QX8NOUC', 3),
(8, 'Saulo', 'saulo@testando.com', '21215464987894', '12345', '$2y$10$byvIv7T1T8vqJH0Xp1njyOZYbmPxNtT7hYHGHTJEtiikd.wBknoeO', 3),
(7, 'saulo', 'saulo@testando.com', '21215464987894', '12345', '$2y$10$ENBBtSuqUoJaFS27W.3sIea4Yp0LnMZypHaFZQxQMoIrr4pbvTGHy', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sits_usuarios`
--

DROP TABLE IF EXISTS `sits_usuarios`;
CREATE TABLE IF NOT EXISTS `sits_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(24) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(24) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(24) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chave` varchar(220) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sits_usuario_id` int(11) NOT NULL DEFAULT '3',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `chave`, `sits_usuario_id`) VALUES
(59, 's', 'sa@testando.com', '12345', NULL, 1),
(58, 'saulo', 's@testando.com', '12345', '$2y$10$pEISobWaV6dNitMzb1Q6HOTW9iLIFC3vKVvvfW5nQScba1w9n4Xcy', 3),
(57, 'saulo', 'test@testando.com', '12345', NULL, 1),
(55, 'SAULO', 'test@testando.com', '12345', NULL, 1),
(56, '12345', '123@testando.com', '123456', NULL, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
