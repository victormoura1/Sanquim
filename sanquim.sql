-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25/06/2025 às 15:15
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
-- Banco de dados: `sanquim`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `alunos`
--

CREATE TABLE `alunos` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `ra` varchar(7) NOT NULL,
  `data_nascimento` date DEFAULT NULL,
  `cpf` varchar(20) NOT NULL,
  `rg` varchar(20) NOT NULL,
  `endereco` varchar(50) NOT NULL,
  `bairro` varchar(20) NOT NULL,
  `cidade` varchar(20) NOT NULL,
  `fone` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `alunos`
--

INSERT INTO `alunos` (`id`, `nome`, `ra`, `data_nascimento`, `cpf`, `rg`, `endereco`, `bairro`, `cidade`, `fone`, `email`, `status`) VALUES
(8, 'Victor Moura', '1234001', '2007-02-03', '50699080819', '393722570', 'Rua Jose', 'Linda Chaib', 'Mogi Mirim', '19996401293', 'moura@gmail.com', 1);

--
-- Acionadores `alunos`
--
DELIMITER $$
CREATE TRIGGER `gerar_ra_aluno` BEFORE INSERT ON `alunos` FOR EACH ROW BEGIN
    DECLARE ultimo_ra INT;
    DECLARE proximo_sufixo INT;

    -- Obter o último RA inserido que segue o padrão '1234xxx'
    -- Isso garante que a numeração seja sequencial
    SELECT RA INTO ultimo_ra
    FROM alunos
    WHERE RA LIKE '1234%' -- Filtra apenas os RAs que começam com '1234'
    ORDER BY RA DESC
    LIMIT 1;

    -- Se não houver nenhum RA com o prefixo '1234', comece com '1234001'
    IF ultimo_ra IS NULL THEN
        SET NEW.RA = 1234001;
    ELSE
        -- Extrair o sufixo numérico do último RA (ex: '001' de '1234001')
        -- e converter para inteiro para poder incrementar
        SET proximo_sufixo = CAST(SUBSTRING(CAST(ultimo_ra AS CHAR), 5) AS UNSIGNED) + 1;

        -- Construir o novo RA combinando o prefixo '1234' com o sufixo incrementado
        SET NEW.RA = 1234000 + proximo_sufixo;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `avisos`
--

CREATE TABLE `avisos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `conteudo` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `publicado_por` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `avisos`
--

INSERT INTO `avisos` (`id`, `titulo`, `conteudo`, `data`, `publicado_por`) VALUES
(4, 'Reunião de pais', 'Reuniao de pais dia 14/07/2025', '2025-06-25', 'Administrador Victor');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `nome_curso` varchar(50) NOT NULL,
  `periodo` varchar(50) NOT NULL,
  `carga_horaria` varchar(50) NOT NULL,
  `modalidade` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `disciplinas`
--

CREATE TABLE `disciplinas` (
  `id` int(11) NOT NULL,
  `nome_disciplina` varchar(40) NOT NULL,
  `carga_horaria` varchar(40) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `materiais`
--

CREATE TABLE `materiais` (
  `id` int(11) NOT NULL,
  `titulo_material` varchar(50) NOT NULL,
  `curso` varchar(50) NOT NULL,
  `turma` varchar(50) NOT NULL,
  `disciplina` varchar(50) NOT NULL,
  `formato` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `professores`
--

CREATE TABLE `professores` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cpf` varchar(50) NOT NULL,
  `rg` varchar(50) NOT NULL,
  `endereco` varchar(50) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `fone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `turmas`
--

CREATE TABLE `turmas` (
  `id` int(11) NOT NULL,
  `nome_turma` varchar(50) NOT NULL,
  `curso` varchar(50) NOT NULL,
  `local` varchar(50) NOT NULL,
  `periodo` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `turmas`
--

INSERT INTO `turmas` (`id`, `nome_turma`, `curso`, `local`, `periodo`, `status`) VALUES
(11, 'Turma1', 'Pré-vestibular', 'Mogi Mirim', 'primeiro', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(15) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `nivel` varchar(15) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `senha`, `nivel`, `status`) VALUES
(19, 'professor1', '$2y$10$xgwilbvwiUPZn4n3nRT87.iHectP6WNYYRKmJ7a2n7LKBQ/rmbq6C', 'professor', 1),
(32, 'aluno1', '$2y$10$Tk8gcTv/ZneYK8CIcokrHefjso.uBDTB29jdwYcY4Qg1GmjzI4u4m', 'aluno', 1),
(33, 'Administrador1', '$2y$10$WwggbsCZbwK.SsQ8Po8MTeoPpUjVvCVXBqv6jncNmR4oIHHnlQpqC', 'administrador', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `avisos`
--
ALTER TABLE `avisos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `turmas`
--
ALTER TABLE `turmas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `avisos`
--
ALTER TABLE `avisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `turmas`
--
ALTER TABLE `turmas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
