-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02/10/2024 às 22:10
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.0.28

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
  `idaluguel` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario_aluguel` int(11) NOT NULL,
  `id_adm_aluguel` int(11) NOT NULL,
  `id_equip_aluguel` int(11) NOT NULL,
  `obs_aluguel` varchar(45) DEFAULT NULL,  -- Alterado para permitir NULL
  `aluguel_data_saida` date NOT NULL,
  `aluguel_data_devolucao` date NOT NULL,
  PRIMARY KEY (`idaluguel`),
  KEY `fk_usuario_aluguel` (`id_usuario_aluguel`),
  KEY `fk_adm_aluguel` (`id_adm_aluguel`),
  KEY `fk_equip_aluguel` (`id_equip_aluguel`),
  CONSTRAINT `fk_usuario_aluguel` FOREIGN KEY (`id_usuario_aluguel`) REFERENCES `usuario_comum` (`id_usuario`),
  CONSTRAINT `fk_adm_aluguel` FOREIGN KEY (`id_adm_aluguel`) REFERENCES `usuario_administrador` (`id_administrador`),
  CONSTRAINT `fk_equip_aluguel` FOREIGN KEY (`id_equip_aluguel`) REFERENCES `equipamentos` (`id_equipamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `equipamentos`
--

CREATE TABLE `equipamentos` (
  `idequipamento` int(11) NOT NULL,
  `nome_equipamento` varchar(45) NOT NULL,
  `tipo_equipamento` varchar(45) NOT NULL,
  `status_equipamento` tinyint(4) NOT NULL,
  `patrimonio_equipamento` varchar(45) NOT NULL,
  `obs_equipamento` varchar(45) NOT NULL,
  `id_adm_alteracao` int(11) NOT NULL,
  `data_entrada` date NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `equipamentos`
--

INSERT INTO `equipamentos` (`idequipamento`, `nome_equipamento`, `tipo_equipamento`, `status_equipamento`, `patrimonio_equipamento`, `obs_equipamento`, `id_adm_alteracao`, `data_entrada`, `data_saida`) VALUES
(21, 'monitor', 'computador', 0, '656565', 'ok', 1, '2024-09-30', '2024-09-30'),
(22, 'monitor', 'computador', 0, '656565', 'ok', 1, '2024-09-30', '2024-09-30'),
(23, 'monitor', 'computador', 0, '656565', 'ok', 1, '2024-09-30', '2024-09-30'),
(24, 'monitor', 'computador', 0, '656565', 'ok', 1, '2024-09-30', '2024-09-30'),
(25, 'monitor', 'computador', 0, '656565', 'ok', 1, '2024-09-30', '2024-09-30'),
(26, 'teclado', 'computador', 0, '656565', 'esta funcional', 1, '2024-09-30', '2024-09-30'),
(27, 'teclado', 'computador', 0, '656565', 'ok', 1, '2024-10-01', '2024-10-02');

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
  `setor_administrador` varchar(45) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario_administrador`
--

INSERT INTO `usuario_administrador` (`id_usuario_administrador`, `nome_administrador`, `email_administrador`, `cpf_administrador`, `senha_administrador`, `data_nasc_administrador`, `contato_administrador`, `cargo_administrador`, `setor_administrador`, `tipo_usuario_administrador`) VALUES
(1, 'Ana Silva', 'ana.silva@email.com', '211.111.111-11', 'senha321', '1985-06-11', '(11) 99999-2222', 'Gerente', 'TI', 1),
(2, 'Bruno Souza', 'bruno.souza@email.com', '222.333.222-22', 'senha321', '1990-03-16', '(11) 98888-3333', 'Supervisor', 'Recursos Humanos', 1),
(3, 'Carla Silva', 'carla.silva@email.com', '333.444.333-33', 'senha321', '1982-12-21', '(11) 97777-4444', 'Coordenadora', 'Administração', 1),
(4, 'Diego Mendes', 'diego.mendes@email.com', '444.555.444-44', 'senha321', '1994-08-09', '(11) 96666-5555', 'Líder de Equipe', 'Servicos gerais', 1),
(5, 'Elisa Costa', 'elisa.costa@email.com', '555.666.555-55', 'senha321', '1989-11-26', '(11) 95555-6666', 'Diretora', 'TI', 0),
(6, 'brendo', '123@gmail.com', '12345678912', '$2y$10$sfWhQ/pyqZaVVfuP10bnQ.34d1ci4OyQHH5ImT', '2024-09-30', '68991615105210', 'Gerente', 'TI', 0),
(7, 'brendo', '321@gmail.com', '12345678912', '$2y$10$gPSYOsm9zeDkOjxckrkduuy/cVqnh58HB9enWV', '2024-09-30', '68991615105210', 'Gerente', 'TI', 0),
(8, 'brendo', '321@gmail.com', '12345678912', '$2y$10$RkoCqud/gBS9SIgOy7Dh7uKkfdrBoNyNPcgkJ.Be25Q60pSmPWpTW', '2024-09-30', '68991615105210', 'Gerente', 'TI', 0),
(9, 'brendos', 'abc@gmail.com', '12345678912', '$2y$10$7TdGjU40Tee0Nu9WN4V.sui8Pjxf11/RNZDmh0EW88Xkz8vQ4Y5P6', '2024-09-30', '68991615105210', 'Gerente', 'TI', 0),
(10, 'brendos', 'abc@gmail.com', '12345678912', '$2y$10$gEiWmV7ETp72RqYba1A8D.cVdjDrjDgASWi.TaBPDdrLH5LgeZ9om', '2024-09-30', '68991615105210', 'Gerente', 'TI', 0),
(11, 'teste', 'teste@gmail.com', '061.174.482-10', '$2y$10$ka0zwXF7BiwJUKD6cIv6KezqKAIcg6PQK8JUig24/7ePQJJLXyosm', '2024-10-02', '(55) 55555-5555', 'teste', 'teste', 0),
(12, 'LUCASBAITOLA', 'LUCAS@gmail.com', '183.072.802-49', '$2y$10$quZaay7M0Cipax8NL5AhjuxCY9tCWAVy6Rw5zX.PopqPKDuvSL.ea', '2024-10-01', '(55) 55555-5555', 'faxineiro', 'rh', 0);

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
  `senha_usuario` varchar(45) NOT NULL,
  `data_nasc_usuario` date NOT NULL,
  `setor_usuario` varchar(45) NOT NULL,
  `cargo_usuario` varchar(45) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario_comum`
--

INSERT INTO `usuario_comum` (`id_USUARIO_COMUM`, `nome_usuario`, `email_usuario`, `cpf_usuario`, `contato_usuario`, `senha_usuario`, `data_nasc_usuario`, `setor_usuario`, `cargo_usuario`, `status_usuario`) VALUES
(1, 'Ana Souza', 'ana.souza@email.com', '111.111.111-11', '(11) 99999-1111', 'senha123', '1985-06-10', 'TI', 'Assistente', 1),
(2, 'Bruno Lima', 'bruno.lima@email.com', '222.222.222-22', '(11) 98888-2222', 'senha123', '1990-03-15', 'Recursos Humanos', 'Técnico Administrativo', 0),
(3, 'Carla Mendes', 'carla.mendes@email.com', '333.333.333-33', '(11) 97777-3333', 'senha123', '1982-12-20', 'Administração', 'Assistente', 1),
(4, 'Diego Costa', 'diego.costa@email.com', '444.444.444-44', '(11) 96666-4444', 'senha123', '1994-08-08', 'Servicos gerais', 'Assistente', 0),
(5, 'Elisa Martins', 'elisa.martins@email.com', '555.555.555-55', '(11) 95555-5555', 'senha123', '1989-11-25', 'TI', 'Suporte', 1),
(6, 'Fábio Oliveira', 'fabio.oliveira@email.com', '666.666.666-66', '(11) 94444-6666', 'senha123', '1995-02-19', 'Recursos Humanos', 'Gerente', 1),
(7, 'Gabriela Freitas', 'gabriela.freitas@email.com', '777.777.777-77', '(11) 93333-7777', 'senha123', '1987-09-12', 'Administração', 'Técnico Administrativo', 0),
(8, 'Henrique Silva', 'henrique.silva@email.com', '888.888.888-88', '(11) 92222-8888', 'senha123', '1993-07-14', 'Servicos gerais', 'Suporte', 1),
(9, 'Isabela Santos', 'isabela.santos@email.com', '999.999.999-99', '(11) 91111-9999', 'senha123', '1984-01-30', 'TI', 'Assistente', 0),
(10, 'João Ribeiro', 'joao.ribeiro@email.com', '101.101.101-01', '(11) 91010-1010', 'senha123', '1991-06-05', 'Recursos Humanos', 'Gerente', 1),
(11, 'Karina Lopes', 'karina.lopes@email.com', '202.202.202-02', '(11) 92020-2020', 'senha123', '1983-10-21', 'Administração', 'Técnico Administrativo', 0),
(12, 'Lucas Ferreira', 'lucas.ferreira@email.com', '303.303.303-03', '(11) 93030-3030', 'senha123', '1996-04-18', 'Servicos gerais', 'Suporte', 1),
(13, 'Mariana Gomes', 'mariana.gomes@email.com', '404.404.404-04', '(11) 94040-4040', 'senha123', '1992-03-07', 'TI', 'Assistente', 1),
(14, 'Nicolas Rocha', 'nicolas.rocha@email.com', '505.505.505-05', '(11) 95050-5050', 'senha123', '1990-12-16', 'Recursos Humanos', 'Gerente', 0),
(15, 'Olivia Almeida', 'olivia.almeida@email.com', '606.606.606-06', '(11) 96060-6060', 'senha123', '1988-02-22', 'Administração', 'Técnico Administrativo', 1),
(16, 'Pedro Cardoso', 'pedro.cardoso@email.com', '707.707.707-07', '(11) 97070-7070', 'senha123', '1986-11-04', 'Servicos gerais', 'Suporte', 0),
(17, 'Quenia Castro', 'quenia.castro@email.com', '808.808.808-08', '(11) 98080-8080', 'senha123', '1991-05-25', 'TI', 'Assistente', 1),
(18, 'Rafael Cunha', 'rafael.cunha@email.com', '909.909.909-09', '(11) 99090-9090', 'senha123', '1994-08-30', 'Recursos Humanos', 'Gerente', 1),
(19, 'Sofia Araújo', 'sofia.araujo@email.com', '010.010.010-10', '(11) 91010-0101', 'senha123', '1993-09-13', 'Administração', 'Técnico Administrativo', 0),
(20, 'Thiago Barros', 'thiago.barros@email.com', '111.111.111-12', '(11) 91111-0111', 'senha123', '1997-12-06', 'Servicos gerais', 'Suporte', 1),
(21, 'Ursula Rezende', 'ursula.rezende@email.com', '121.121.121-13', '(11) 92121-0121', 'senha123', '1987-07-21', 'TI', 'Assistente', 0),
(22, 'Vinícius Ramos', 'vinicius.ramos@email.com', '131.131.131-14', '(11) 93131-0131', 'senha123', '1992-10-18', 'Recursos Humanos', 'Gerente', 1),
(23, 'Wagner Santana', 'wagner.santana@email.com', '141.141.141-15', '(11) 94141-0141', 'senha123', '1996-04-26', 'Administração', 'Técnico Administrativo', 1),
(24, 'Xênia Assis', 'xenia.assis@email.com', '151.151.151-16', '(11) 95151-0151', 'senha123', '1995-05-02', 'Servicos gerais', 'Suporte', 0),
(25, 'Yago Morais', 'yago.morais@email.com', '161.161.161-17', '(11) 96161-0161', 'senha123', '1984-02-14', 'TI', 'Assistente', 1),
(26, 'Zélia Duarte', 'zelia.duarte@email.com', '171.171.171-18', '(11) 97171-0171', 'senha123', '1993-01-29', 'Recursos Humanos', 'Gerente', 1),
(27, 'Arthur Nogueira', 'arthur.nogueira@email.com', '181.181.181-19', '(11) 98181-0181', 'senha123', '1990-03-19', 'Administração', 'Técnico Administrativo', 0),
(28, 'Beatriz Lima', 'beatriz.lima@email.com', '191.191.191-20', '(11) 99191-0191', 'senha123', '1986-06-09', 'Servicos gerais', 'Suporte', 1),
(29, 'Caio Sousa', 'caio.sousa@email.com', '202.202.202-21', '(11) 90202-0202', 'senha123', '1997-11-17', 'TI', 'Assistente', 0),
(30, 'Daniel Oliveira', 'daniel.oliveira@email.com', '212.212.212-22', '(11) 91212-0212', 'senha123', '1988-12-30', 'Recursos Humanos', 'Gerente', 1);

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
  MODIFY `idaluguel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `equipamentos`
--
ALTER TABLE `equipamentos`
  MODIFY `idequipamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `usuario_administrador`
--
ALTER TABLE `usuario_administrador`
  MODIFY `id_usuario_administrador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `usuario_comum`
--
ALTER TABLE `usuario_comum`
  MODIFY `id_USUARIO_COMUM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
