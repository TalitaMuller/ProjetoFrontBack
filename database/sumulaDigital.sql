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



USE sumulaDigital;



-- ==========================================================
-- 4. POPULANDO A TABELA NIVEL (EXERCÍCIOS)
-- ==========================================================

-- ----------------------------------------------------------
-- APARELHO: SALTO
-- ----------------------------------------------------------

-- Grupo 1: Saltos Verticais (ID 1)
INSERT INTO nivel (ponto, exercicio, idGrupo) VALUES

(1, 'Salto extensão (trampolim ou minitrampolim)', 1),

(1, 'Salto grupado (trampolim ou minitrampolim)', 1),

(1, 'Salto afastado (trampolim ou minitrampolim)', 1),

(1, 'Salto extensão c/ trampolim + rolo p/frente', 1),


(2, 'Salto extensão c/ 180° de giro (trampolim ou minitrampolim)', 1),

(2, 'Salto carpado (minitrampolim)', 1),

(2, 'Rolo Voado (trampolim ou minitrampolim)', 1),


(3, 'Salto extensão c/ 360° de giro (trampolim ou minitrampolim)', 1),

(3, 'Salto carpado c/ 180° de giro (minitrampolim)', 1),

(3, 'Borboleta aterrissagem sobre as duas pernas (minitrampolim)', 1),


(4, 'Mortal grupado (minitrampolim)', 1),

(4, 'Mortal carpado (minitrampolim)', 1),

(4, 'Peixe (trampolim)', 1),


(5, 'Mortal grupado ou carpado c/ 180° ou 360° de giro (minitrampolim)', 1),

(5, 'Mortal estendido (minitrampolim)', 1);



-- Grupo 2: Saltos sobre o aparelho (ID 2)
INSERT INTO nivel (ponto, exercicio, idGrupo) VALUES

(1, 'Salto extensão para cima do plinto (trampolim)', 2),


(2, 'Flanco c/ apoio (cavalo ou plinto, trampolim ou minitrampolim)', 2),

(2, 'Grupado c/ apoio (cavalo ou plinto, trampolim ou minitrampolim)', 2),

(2, 'Afastado c/ apoio (cavalo ou plinto, trampolim ou minitrampolim)', 2),


(3, 'Flanco* direto (cavalo ou plinto, trampolim ou minitrampolim)', 2),

(3, 'Grupado direto (cavalo ou plinto, trampolim ou minitrampolim)', 2),

(3, 'Afastado direto (cavalo ou plinto, trampolim ou minitrampolim)', 2),


(4, 'Reversão (plinto de 80 cm a 1m. de altura, ou cavalo com minitrampolim)', 2),

(4, 'Flanco* com o quadril alto - pernas flexionadas (cavalo ou plinto, trampolim ou minitrampolim)', 2),

(4, 'Rodante (plinto de 80 cm a 1m. de altura ou cavalo com minitrampolim)', 2),



(5, 'Reversão (cavalo ou mesa, com trampolim)', 2),

(5, 'Rodante (cavalo ou mesa, com trampolim)', 2),

(5, 'Reversão c/ 180° de giro no 2º vôo (cavalo ou mesa, com trampolim ou minitrampolim)', 2),

(5, 'Rodante c/ 180° de giro no 2º vôo (cavalo ou mesa, com trampolim ou minitrampolim)', 2);



-- ----------------------------------------------------------
-- APARELHO: SOLO
-- ----------------------------------------------------------

-- Grupo 1: Tensões e posturais (ID 3)
INSERT INTO nivel (ponto, exercicio, idGrupo) VALUES

(1, 'Caranguejo', 3),

(1, 'Canoinha estendida 2"', 3),

(1, 'Macaquinho (3 apoios)', 3),

(1, 'Burrinho (impulso à parada de mãos)', 3),


(2, 'Vela', 3),

(2, 'Balança da canoinha estendida 2X', 3),

(2, 'Parada de cabeça 1”', 3),

(2, 'Parada de mãos', 3),


(3, 'Avião ou Y (equilíbrio sobre uma perna', 3),

(3, 'Espacato qualquer um (marcar 2”)', 3),

(3, 'Cachorrinho ou carpadinho encostar o peito no solo ou nas pernas', 3),


(4, 'Esquadro afastado ou carpado (marcar 2”)', 3),

(4, 'Parada de mãos subindo à força', 3),


(5, 'Esquadro afastado subindo à parada de mãos', 3);



-- Grupo 2: Rolamentos (ID 4)
INSERT INTO nivel (ponto, exercicio, idGrupo) VALUES 
(1, 'Canoinha grupada', 4),

(1, 'Rolo para frente grupado (rampa)', 4),

(1, 'Rolo para frente afastado (rampa)', 4),

(1, 'Rolo para frente grupado', 4),

(1, 'Rolo de costas grupado (rampa)', 4),

(1, 'Rolo de costas afastado (rampa)', 4),


(2, 'Rolo para frente afastado (90º de abertura)', 4),

(2, 'Rolo de costas grupado', 4),

(2, 'Rolo de costas afastado', 4),

(2, 'Rolo de costas carpado (rampa)', 4),

(2, 'Rolo voado', 4),


(3, 'Rolo para frente carpado', 4),

(3, 'Rolo de costas carpado (inicio e fim na posição)', 4),


(4, 'Rolo para trás á prancha com braços estendidos', 4),

(4, 'Rolo para frente subindo carpado (início e fim na posição)', 4),

(4, 'Peixe c/ grande fase de vôo', 4),

(4, 'Rolo de costas à parada de mãos (braços flexionados)', 4),


(5, 'Rolo de costas à parada de mãos “de braços estendidos”', 4);




-- Grupo 3: Acrobáticos (ID 5)
INSERT INTO nivel (ponto, exercicio, idGrupo) VALUES 

(1, 'Educativo para roda (plinto) passar sobre o plinto', 5),


(2, 'Parada de mãos rolo', 5),

(2, 'Roda', 5),


(3, 'Parada de mãos ponte (completa ou sem subir)', 5),

(3, 'Ponte e lança a perna (passando p/ outro lado)', 5),

(3, 'Roda com 1 mão', 5),

(3, 'Rodante', 5),


(4, 'Parada de mãos rolo subindo na posição carpada', 5),

(4, 'Arco para frente', 5),

(4, 'Arco para trás', 5),

(4, 'Reversão c/ 1 perna', 5),

(4, 'Reversão com pernas unidas + salto extensão', 5),


(5, 'Rodante + flic', 5),

(5, 'Rodante + 2 flics', 5),

(5, 'Reversão + reversão (ambas c/ 1 perna e s/ passos)', 5),

(5, 'Reversão com 1 perna + reversão c/ pernas unidas (s/ passos)', 5),

(5, 'Reversão + peixe (s/ passos)', 5),

(5, 'Flic para frente', 5);



-- Grupo 4: Saltos e giros Ginásticos (ID 6)
INSERT INTO nivel (ponto, exercicio, idGrupo) VALUES 

(1, 'Salto Tesoura', 6),

(1, 'Salto Gatinho', 6),

(1, 'Salto extensão', 6),

(1, 'Salto extensão c/ 180° de giro', 6),

(1, 'Salto grupado', 6),


(2, 'Salto grupado c/ 180° de Giro', 6),

(2, 'Salto extensão c/360° de Giro', 6),

(2, 'Giro de 360° sobre uma Perna', 6),


(3, 'Sissone ou salto espacato', 6),

(3, 'Salto de vôo', 6),

(3, 'Salto grupado c/ 360° de giro', 6),

(3, 'Salto extensão c/ 540° de giro', 6),

(3, 'Giro de 540° sobre 1 perna', 6),


(4, 'Salto extensão c/ 720º de Giro', 6),

(4, 'Giro sobre uma perna c/ 720°', 6),


(5, 'Salto cortada', 6);



-- Livres (ID 7)
INSERT INTO nivel (ponto, exercicio, idGrupo) VALUES 

(1, 'Armar a ponte do chão', 7),

(1, 'Burrinho (impulso à parada de mãos)', 7),


(2, 'Parada de mãos c/ 180° de giro', 7),

(2, 'Ponte de cima', 7),


(3, 'Parada de mãos c/ 360° de Giro', 7),

(3, 'Da parada de cabeça subir à parada de mãos', 7),

(3, 'Quipe de cabeça', 7),


(4, 'Reversão sem mãos (1 perna) com auxílio de um trampolim', 7), 

(4, 'Roda sem mãos (borboleta) com auxílio de um trampolim', 7),


(5, 'Rodante + mortal de costas', 7),

(5, 'Reversão s/ mãos (1 perna)', 7),

(5, 'Reversão + mortal de frente (s/ passos)', 7),

(5, 'Mortal para frente', 7),

(5, 'Roda sem mãos (borboleta)', 7),

(5, 'Mortal de costas parado', 7);

