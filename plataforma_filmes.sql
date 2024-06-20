-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Tempo de geração: 20/06/2024 às 16:30
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
-- Banco de dados: `plataforma_filmes`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `filmes`
--

CREATE TABLE `filmes` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `url` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `filmes`
--

INSERT INTO `filmes` (`id`, `titulo`, `descricao`, `categoria`, `url`) VALUES
(5, 'OS FAROFEIROS 2', 'Os colegas de trabalho Alexandre, Lima, Rocha, Diguinho e suas famílias são presenteados pela empresa com uma viagem para a Bahia. No entanto, problemas e imprevistos podem levar por água abaixo essa viagem dos sonhos.', 'comedia', 'https://www.youtube.com/watch?v=_d5quiHSmKE'),
(6, 'BAD BOYS 4', 'Os brincalhões polícias de Miami, Mike Lowrey e Marcus Burnett, embarcam em uma perigosa missão para limpar o nome do falecido capitão da polícia.', 'ação', 'https://www.youtube.com/watch?v=GhCm4yCOjSE'),
(8, 'Vingadores Ultimato', 'vingadores', 'ficcao cientifica', 'https://www.youtube.com/watch?v=g6ng8iy-l0U');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `tipo` enum('usuario','adm') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `tipo`) VALUES
(8, 'koren', 'koren@gmail.com', '$2y$10$R5/dKjOKqfiP.Nk56BjVcehCDh.onji1j0Gc13/Szu6YHpZQAhrfm', 'usuario'),
(9, 'pedro', 'pedro@gmail.com', '$2y$10$0BSFBjoMwVKOnKwCtMh8buIWs7gPpuemFs.70a8Dlfeueh9zaJ.qW', 'adm'),
(10, 'lucca', 'lucca@gmail.com', '$2y$10$fYtx52ONCRHEv.ikqiixEudqkjBEjesU5QoSyYn6RmvmZvzz/QXBi', 'usuario');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `filmes`
--
ALTER TABLE `filmes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `filmes`
--
ALTER TABLE `filmes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
