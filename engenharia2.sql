-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28/10/2024 às 18:48
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `engenharia2`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluguel`
--

CREATE TABLE `aluguel` (
  `idaluguel` int(11) NOT NULL,
  `id_usuario_aluguel` int(11) NOT NULL,
  `id_adm_aluguel` int(11) DEFAULT NULL,
  `id_equip_aluguel` int(11) NOT NULL,
  `obs_aluguel` varchar(45) NOT NULL,
  `aluguel_data_saida` date NOT NULL,
  `aluguel_data_devolucao` date NOT NULL,
  `status_aluguel` varchar(45) DEFAULT 'pendente',
  `quantidade_solicitada` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `aluguel`
--

INSERT INTO `aluguel` (`idaluguel`, `id_usuario_aluguel`, `id_adm_aluguel`, `id_equip_aluguel`, `obs_aluguel`, `aluguel_data_saida`, `aluguel_data_devolucao`, `status_aluguel`, `quantidade_solicitada`) VALUES
(40, 52, NULL, 26, 's', '2024-10-28', '2024-10-22', 'recusado', 0),
(41, 52, NULL, 28, 'c', '2024-10-28', '2024-10-29', 'aprovado', 0),
(42, 52, NULL, 21, 'c', '2024-10-28', '2024-10-18', 'aprovado', 0),
(43, 52, NULL, 21, 'a', '2024-10-28', '2024-10-04', 'aprovado', 0),
(44, 52, NULL, 21, 'sim', '2024-10-28', '2024-10-28', 'aprovado', 0),
(45, 52, NULL, 28, 'asdasd', '2024-10-28', '2024-10-30', 'aprovado', 0),
(46, 52, NULL, 21, 'x', '2024-10-28', '2024-10-30', 'aprovado', 1),
(47, 52, NULL, 21, 'validação', '2024-10-28', '2024-10-31', 'aprovado', 3),
(48, 52, NULL, 39, 'validação', '2024-10-28', '2024-10-23', 'recusado', 1),
(49, 52, NULL, 38, 'validação', '2024-10-28', '2024-10-08', 'aprovado', 15),
(50, 52, NULL, 28, 'validação', '2024-10-28', '2024-10-22', 'aprovado', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `equipamentos`
--

CREATE TABLE `equipamentos` (
  `idequipamento` int(11) NOT NULL,
  `nome_equipamento` varchar(45) NOT NULL,
  `tipo_equipamento` varchar(45) NOT NULL,
  `status_equipamento` varchar(256) NOT NULL,
  `patrimonio_equipamento` varchar(45) NOT NULL,
  `obs_equipamento` varchar(45) NOT NULL,
  `id_adm_alteracao` int(11) NOT NULL,
  `data_entrada` date NOT NULL,
  `data_saida` date DEFAULT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `equipamentos`
--

INSERT INTO `equipamentos` (`idequipamento`, `nome_equipamento`, `tipo_equipamento`, `status_equipamento`, `patrimonio_equipamento`, `obs_equipamento`, `id_adm_alteracao`, `data_entrada`, `data_saida`, `quantidade`) VALUES
(21, 'monitor', 'computador', 'Funcional', '656565', 'ok', 1, '2024-09-30', '2024-09-30', 1),
(26, 'teclado', 'computador', 'Funcional', '656565', 'esta funcional', 1, '2024-09-30', '2024-09-30', 1),
(28, 'mouse', 'computador', 'Funcional', '656564', 'ok', 1, '2024-10-15', NULL, 1),
(37, 'teste de cadastro', 's', 'Funcional', 's', '', 1, '2024-10-24', NULL, 1),
(38, 'teste de cadastro2', 's', 'Funcional', 's', '', 1, '2024-10-14', NULL, 2),
(39, 'teste de cadastro de equipamento', 'Desktop', 'Funcional', '123456', 'serio', 0, '2024-10-29', NULL, 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario_administrador`
--

CREATE TABLE `usuario_administrador` (
  `id_usuario_administrador` int(11) NOT NULL,
  `nome_administrador` varchar(45) NOT NULL,
  `email_administrador` varchar(45) NOT NULL,
  `cpf_administrador` varchar(45) NOT NULL,
  `senha_administrador` varchar(256) NOT NULL,
  `data_nasc_administrador` date NOT NULL,
  `contato_administrador` varchar(45) NOT NULL,
  `cargo_administrador` varchar(45) NOT NULL,
  `setor_administrador` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario_administrador`
--

INSERT INTO `usuario_administrador` (`id_usuario_administrador`, `nome_administrador`, `email_administrador`, `cpf_administrador`, `senha_administrador`, `data_nasc_administrador`, `contato_administrador`, `cargo_administrador`, `setor_administrador`) VALUES
(16, 'adm', 'adm@gmai.com', '040.975.252-55', '$2y$10$LZ82PR.QTyEjuZxNCfBnzufso3phmJ4T.0Q.ALInHRFQ2baObv3kG', '2024-10-03', '(68) 99927-2750', 'teste', 'TI');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario_comum`
--

CREATE TABLE `usuario_comum` (
  `id_USUARIO_COMUM` int(11) NOT NULL,
  `nome_usuario` varchar(45) NOT NULL,
  `email_usuario` varchar(45) NOT NULL,
  `cpf_usuario` varchar(45) NOT NULL,
  `contato_usuario` varchar(45) NOT NULL,
  `senha_usuario` varchar(256) NOT NULL,
  `data_nasc_usuario` date NOT NULL,
  `setor_usuario` varchar(45) NOT NULL,
  `cargo_usuario` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario_comum`
--

INSERT INTO `usuario_comum` (`id_USUARIO_COMUM`, `nome_usuario`, `email_usuario`, `cpf_usuario`, `contato_usuario`, `senha_usuario`, `data_nasc_usuario`, `setor_usuario`, `cargo_usuario`) VALUES
(52, 'usuario', 'usuario@gmail.com', '18307280249', '68999999999', '$2y$10$U3oYjjKgoAbJ7xOumpY9y.j9G.J3LsAMPuEER.HeUBCfgmvrjNILW', '2024-10-15', 'RH', 'Sim');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `aluguel`
--
ALTER TABLE `aluguel`
  ADD PRIMARY KEY (`idaluguel`);

--
-- Índices de tabela `equipamentos`
--
ALTER TABLE `equipamentos`
  ADD PRIMARY KEY (`idequipamento`);

--
-- Índices de tabela `usuario_administrador`
--
ALTER TABLE `usuario_administrador`
  ADD PRIMARY KEY (`id_usuario_administrador`);

--
-- Índices de tabela `usuario_comum`
--
ALTER TABLE `usuario_comum`
  ADD PRIMARY KEY (`id_USUARIO_COMUM`),
  ADD UNIQUE KEY `id_USUARIO_COMUM_UNIQUE` (`id_USUARIO_COMUM`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aluguel`
--
ALTER TABLE `aluguel`
  MODIFY `idaluguel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de tabela `equipamentos`
--
ALTER TABLE `equipamentos`
  MODIFY `idequipamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de tabela `usuario_administrador`
--
ALTER TABLE `usuario_administrador`
  MODIFY `id_usuario_administrador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `usuario_comum`
--
ALTER TABLE `usuario_comum`
  MODIFY `id_USUARIO_COMUM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
