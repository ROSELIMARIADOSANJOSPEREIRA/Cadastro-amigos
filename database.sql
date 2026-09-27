-- ============================================================
-- Banco de Dados: cadastro_amigos
-- Projeto: Sistema de Cadastro de Amigos (CRUD) com Login
-- Disciplina: Desenvolvimento de Sistemas II - Agenda 08
-- ============================================================

-- Cria o banco de dados, caso ele ainda nao exista
CREATE DATABASE IF NOT EXISTS cadastro_amigos;
USE cadastro_amigos;

-- ------------------------------------------------------------
-- Tabela: usuarios
-- Guarda quem tem permissao de acessar o sistema (login)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL, -- a senha e guardada como HASH, nunca em texto puro
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ------------------------------------------------------------
-- Tabela: amigos
-- Guarda os amigos cadastrados por cada usuario logado
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS amigos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    telefone VARCHAR(20),
    email VARCHAR(150),
    cidade VARCHAR(100),
    usuario_id INT NOT NULL,        -- chave estrangeira: de quem e esse amigo
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- ------------------------------------------------------------
-- Usuario de exemplo para testar o sistema
-- IMPORTANTE: a senha nao pode ser digitada aqui em texto puro,
-- ela precisa ser um HASH gerado pelo PHP (funcao password_hash).
-- Passo a passo:
--   1) Rode o arquivo gerar_hash.php no navegador (ex: localhost/cadastro-amigos/gerar_hash.php)
--   2) Copie o hash que aparecer na tela
--   3) Cole no lugar de SUBSTITUA_PELO_HASH_AQUI abaixo e execute este INSERT
-- ------------------------------------------------------------
INSERT INTO usuarios (nome, email, senha) VALUES
('Gabi', 'gabi@escola.com', 'SUBSTITUA_PELO_HASH_AQUI');
