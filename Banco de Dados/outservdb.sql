-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03/06/2024 às 21:51
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
-- Banco de dados: `outservdb`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `permission`
--

INSERT INTO `permission` (`id`, `nome`, `description`) VALUES
(1, 'add_user', 'Insere novos usuarios no sistema'),
(2, 'Add_profiles', 'Adicionar novos perfis'),
(3, 'add_perms', 'Adicionar novas permissoes ao sistema'),
(4, 'edit_user', 'Edita usuarios');

-- --------------------------------------------------------

--
-- Estrutura para tabela `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `profile`
--

INSERT INTO `profile` (`id`, `nome`, `description`) VALUES
(0, 'Regular_User', 'Usuario comum, nao faz nada de especial'),
(1, 'Administrator', 'Pode fazer tudo que um adm tem direito');

-- --------------------------------------------------------

--
-- Estrutura para tabela `profile_permission`
--

CREATE TABLE `profile_permission` (
  `id` int(11) NOT NULL,
  `IDprofile` int(11) NOT NULL,
  `IDpermission` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `profile_permission`
--

INSERT INTO `profile_permission` (`id`, `IDprofile`, `IDpermission`) VALUES
(1, 1, 2),
(2, 0, 1),
(3, 1, 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user` varchar(25) NOT NULL,
  `password` char(255) NOT NULL,
  `email` varchar(319) NOT NULL,
  `idProfile` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `user`
--

INSERT INTO `user` (`id`, `user`, `password`, `email`, `idProfile`) VALUES
(2, 'squidward', '$2y$10$X4ZARV3jJl9CRv4HQkWI9ewGvH5x0mtH7B.0lj6jn49VjlJFbgYBe', 'squid123@bikinibottom.com', 1),
(6, 'PatrickStar', '$2y$10$wYuJe94OUDvi01T0vH8sS.8JbjmEBoXP8eM0UsajMznmKmhROvnNW', 'patrick.star@bikinibottom.com', 0),
(7, 'SandySquirrel', 'texas10', 'sandy@bikinibottom.com', 1),
(8, 'Mario', '$2y$10$Ih1nb7BcXy3MJRUiDPG3/u3xHkSLUs7bfX1NZhEBzEIeQXwIWFTzK', 'mario123@mamamia.com', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `profile_permission`
--
ALTER TABLE `profile_permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkey_profile` (`IDprofile`),
  ADD KEY `fkey_permission` (`IDpermission`);

--
-- Índices de tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_profile` (`idProfile`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `profile_permission`
--
ALTER TABLE `profile_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `profile_permission`
--
ALTER TABLE `profile_permission`
  ADD CONSTRAINT `fkey_permission` FOREIGN KEY (`IDpermission`) REFERENCES `permission` (`id`),
  ADD CONSTRAINT `fkey_profile` FOREIGN KEY (`IDprofile`) REFERENCES `profile` (`id`);

--
-- Restrições para tabelas `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_profile` FOREIGN KEY (`idProfile`) REFERENCES `profile` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
