-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02/12/2025 às 23:43
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cervejaria`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cerveja`
--

CREATE TABLE `cerveja` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `tipo` varchar(100) DEFAULT NULL,
  `teor` double DEFAULT NULL,
  `ibu` int(11) DEFAULT NULL,
  `pais_origem` varchar(100) DEFAULT NULL,
  `data_fabri` date DEFAULT NULL,
  `local_degustado` varchar(150) DEFAULT NULL,
  `avaliacao` int(11) DEFAULT NULL,
  `comentarios` text DEFAULT NULL,
  `fabricante` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cerveja`
--

INSERT INTO `cerveja` (`id`, `nome`, `tipo`, `teor`, `ibu`, `pais_origem`, `data_fabri`, `local_degustado`, `avaliacao`, `comentarios`, `fabricante`, `img`) VALUES
(4, 'Amistel', 'IPA', 4, 8, 'Brasil', '2025-11-13', 'Bar do Zé', 4, 'Ruim', 'Haincken', '1764542159_amistel.png'),
(5, 'Schin', 'IPA', 3, 8, 'Brasil', '2025-11-05', 'Bar do Zé', 9, 'Boa!', 'Haincken', '1764555958_skin.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` bigint(20) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`) VALUES
(1, 'Claiton', 'teste@gmail.com', '321'),
(5, 'Lula', 'ladrao@gmail.com', '345'),
(6, 'Rafael', 'pedro@gmail.com', '123'),
(7, 'Cleitom', 'teste@gmail.com', '123');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cerveja`
--
ALTER TABLE `cerveja`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cerveja`
--
ALTER TABLE `cerveja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
