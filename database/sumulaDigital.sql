CREATE DATABASE sumulaDigital;
USE sumulaDigital;




-- 1. Tabela Usuario
CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);




-- 2. Tabela Entidade
CREATE TABLE entidade (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);





-- 3. Tabela Turma
CREATE TABLE turma (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    idEntidade INT NOT NULL,
    FOREIGN KEY (idEntidade) REFERENCES entidade(id)
);




-- 4. Tabela Ginasta
CREATE TABLE ginasta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    anoNasc INT(4) NOT NULL,
    foto VARCHAR(255) DEFAULT 'perfilPadrao.png',
    idTurma INT NOT NULL,
    FOREIGN KEY (idTurma) REFERENCES turma(id)
);





-- 5. Tabela Aparelho
CREATE TABLE aparelho (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    quantExerc INT NOT NULL
);




-- 6. Tabela Grupo
CREATE TABLE grupo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    numero INT,
    idAparelho INT NOT NULL,
    FOREIGN KEY (idAparelho) REFERENCES aparelho(id)
);




-- 7. Tabela Nivel 
CREATE TABLE nivel (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ponto INT NOT NULL, 
    exercicio VARCHAR(255) NOT NULL, 
    idGrupo INT NOT NULL,
    FOREIGN KEY (idGrupo) REFERENCES grupo(id)
);




-- 8. Tabela ItemSumula
CREATE TABLE itemsumula (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idGinasta INT NOT NULL,
    idNivel INT NOT NULL,
    FOREIGN KEY (idGinasta) REFERENCES ginasta(id),
    FOREIGN KEY (idNivel) REFERENCES nivel(id)
);




-- ==========================================================
-- POVOANDO O BANCO 
-- ==========================================================




-- 1. Inserindo Usuário de Teste
INSERT INTO usuario (nome, email, senha) VALUES 
('Talita', 'talita@gmail.com', '12345');




-- 2. Inserindo Aparelhos e seus Limites 
INSERT INTO aparelho (id, nome, quantExerc) VALUES 
(1, 'Salto', 2),
(2, 'Solo', 8),
(3, 'Paralelas Assimétricas ou Barra Fixa', 5),
(4, 'Trave de Equilíbrio ou Paralelas Simétricas', 5);




-- 3. Inserindo Grupos dos Aparelhos




-- Grupos do Salto 
INSERT INTO grupo (nome, numero, idAparelho) VALUES 
('Saltos verticais', 1, 1),
('Saltos sobre o aparelho', 2, 1);




-- Grupos do Solo 
INSERT INTO grupo (nome, numero, idAparelho) VALUES 
('Tensões e posturais', 1, 2),
('Rolamentos', 2, 2),
('Acrobáticos com passagem pelo apoio invertido', 3, 2),
('Saltos e giros Ginásticos', 4, 2),
('Livres', NULL, 2);




-- Grupos de Paralelas Assimétricas ou Barra Fixa 
INSERT INTO grupo (nome, numero, idAparelho) VALUES 
('Suspensão', 1, 3),
('Apoios e Lançamentos', 2, 3),
('Circulares próximos', 3, 3),
('Saídas', 4, 3),
('Livres', NULL,  3);




-- Grupos de Trave de Equilíbrio ou Paralelas Simétricas 

-- Trave de Equilíbrio
INSERT INTO grupo (nome, numero, idAparelho) VALUES 
('Giros', 1, 4),
('Saltos', 2, 4),
('Acrobáticos e PM', 3, 4),
('Saídas', 4, 4),
('Livres', NULL, 4);




-- Paralelas Simétricas 
INSERT INTO grupo (nome, numero, idAparelho) VALUES 
('Apoios', 1, 4),
('Suspensões', 2, 4),
('Forças Estáticas', 3, 4),
('Esquadros', 4, 4),
('Saídas', 5, 4);






