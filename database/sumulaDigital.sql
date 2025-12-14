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




-- ----------------------------------------------------------
-- APARELHO: ASSIMÉTRICAS / BARRA
-- ----------------------------------------------------------


-- Grupo 1: Suspensão (ID 8)
INSERT INTO nivel (ponto, exercicio, idGrupo) VALUES 

(1, 'Deslocamento b.a. na suspensão, ponta a ponta', 8),


(2, 'Embalos na suspensão 2x BB com joelhos flexionados', 8),


(3, 'Embalos na suspensão 2x', 8),

(3, 'Educativo p/ quipe 1 – (Pernas unidas deslizamento à frente saindo da banqueta ou plinto com mãos iniciando na barra)', 8),


(4, 'Educativo p/ quipe2 (Saltando do trampolim c/ pernas unidas)', 8),

(4, 'Tomada de embalo (quadril à frente na altura da barra)', 8),

(4, 'Oitavão do apoio de pés na b.b. p/ b.a.', 8),


(5, 'Quipe na b.b.', 8),

(5, 'Quipe na b.a.', 8),

(5, 'Oitavão do apoio b.a.', 8),

(5, 'Giro gigante', 8);




-- Grupo 2: Apoios e Lançamentos (ID 9)
INSERT INTO nivel (ponto, exercicio, idGrupo) VALUES

(1, 'Saltar ao apoio', 9),


(2, 'Lançamento atrás mostrar que o quadril descola da barra', 9),


(3, 'Lançamento de pernas até a altura da barra', 9),


(4, 'Lançamento acima da Horizontal', 9),


(5, 'Lançamento á 45º', 9);




-- Grupo 3: Circulares próximos (ID 10)
INSERT INTO nivel (ponto, exercicio, idGrupo) VALUES

(1, 'Do apoio, girar p/ frente', 10),


(3, 'Giro de quadril p/ trás', 10),

(3, 'Oitava c/ impulso do chão ou da Rampa', 10),


(4, 'Oitava à força b.b.', 10),

(4, 'Giro de quadril p/ frente', 10),


(5, 'Oitava à força b.a.', 10),

(5, 'Lançamento acima da Horizontal', 10),

(5, 'Giro de quadril livre', 10);




-- Grupo 4: Saídas (ID 11)
INSERT INTO nivel (ponto, exercicio, idGrupo) VALUES

(1, 'Do apoio, girar p/ frente', 11),


(2, 'Saída: lançamento e solta atrás', 11),


(3, 'Do apoio sublance com ou sem apoio dos pés b.b.', 11),

(3, 'Grupadinho salto extensão entre as barras', 11),


(4, 'Saída sublance c/ apoio dos pés b.a.', 11),


(5, 'Saída sublance c/ apoio dos pés e 180° ou 360° de giro b.a.', 11),

(5, 'Saída de mortal para frente ou trás b.a. (suspensão)', 11);




-- Grupo 5: Livres (ID 12)
INSERT INTO nivel (ponto, exercicio, idGrupo) VALUES

(1, 'Sustentar queixo na altura da barra', 12),

(1, 'Em suspensão, elevação de pernas flexionadas e unidas até encostar no peito 2``', 12),

(1, 'Pé no buraco solta atrás b.b', 12),

(1, 'Envelope 1 (Pé no buraco e solta à pm no apoio (solo ) b.b)', 12),


(2, 'Canoinha na suspensão 2``', 12),

(2, 'Envelope 2 (Pé no buraco, vai e volta b.b).', 12),


(3, 'Deslocamento no apoio b.b. ponta a ponta', 12),

(3, '2 puxadas b.a.(passar o queixo da barra)', 12),

(3, 'Envelope 3 (Pé no buraco, vai e volta b.a.)', 12),


(4, 'Canivete (Em suspensão, elevação de pernas estendidas mínimo 135°)', 12),

(4, 'Grupadinho pegando na b.a.', 12);




-- ----------------------------------------------------------
-- APARELHO: TRAVE DE EQUILÍBRIO
-- ----------------------------------------------------------


-- Grupo 1: Giros (ID 13)
INSERT INTO nivel (ponto, exercicio, idGrupo) VALUES

(1, 'Rotação de 360º (caminhando)', 13),


(2, 'Giro de 180º sobre os 2 pés em meia ponta', 13),


(3, 'Giro de 180º sobre 1 Perna', 13),


(4, 'Giro de 180º sobre 1 perna terminando na meia ponta + 180º na meia ponta', 13),


(5, 'Giro de 360º sobre 1 perna', 13);




-- Grupo 2: Saltos (ID 14)
INSERT INTO nivel (ponto, exercicio, idGrupo) VALUES

(1, 'Salto extensão', 14),

(1, 'Salto gatinho', 14),


(2, 'Extensão c/ 180° de giro', 14),

(2, 'Salto grupado', 14),

(2, 'Salto tesoura', 14),

(2, 'Salto extensão na posição transversal', 14),


(3, 'Salto gatinho c/ 180° de giro', 14),

(3, 'Salto grupado c/ 180° de giro', 14),


(4, 'Salto grupado na posição transversal', 14),

(4, 'Salto Wolf', 14),

(4, 'Salto sissone ou salto espacato', 14),


(5, 'Salto de voo', 14),

(5, 'Wolf c/ meio giro (180°)', 14);




-- Grupo 3: Acrobáticos e PM (ID 15)
INSERT INTO nivel (ponto, exercicio, idGrupo) VALUES

(1, 'Sentar e levantar c/ apoio das mãos', 15),


(2, 'Sentar e levantar s/ apoio das mãos', 15),


(3, 'Impulso à parada de mãos (afastamento anteroposterior, uma perna deve chegar à vertical)', 15),

(3, 'Roda (altura da trave até 60 cm)', 15),

(3, 'Rolo p/ frente finalizando afastado', 15),


(4, 'Rolo para frente', 15),

(4, 'Parada de mãos longitudinal', 15),

(4, 'Roda (Estrelinha)', 15),


(5, 'Rolo para frente sem mãos', 15),

(5, 'Arco para frente', 15),

(5, 'Arco para trás', 15);




-- Grupo 4: Saídas (ID 16)
INSERT INTO nivel (ponto, exercicio, idGrupo) VALUES

(1, 'Saída: Extensão, Grupado', 16),


(2, 'Saída: Afastado', 16),

(3, 'Saída: Rodante', 16),


(4, 'Saída: Reversão', 16),

(4, 'Saída: Borboleta (aterrissagem de pernas unidas)', 16),


(5, 'Saída: Roda na ponta da trave + salto extensão de costas', 16),

(5, 'Saída: Mortal para frente', 16),

(5, 'Saída: Mortal de costas', 16);




-- Grupo 5: Livres (Trave) (ID 17)
INSERT INTO nivel (ponto, exercicio, idGrupo) VALUES

(1, 'Entrada transversal: flanco', 17),

(1, 'Caminhar p/ frente', 17),

(1, 'Caminhar de lado', 17),

(1, 'Caminhar de costas', 17),

(1, 'Lançamento de pernas à frente (2x cada perna)', 17),

(1, 'Chassê', 17),


(2, 'Entrada transversal: grupada ou afastada', 17),

(2, 'Avião 2"', 17),


(3, 'Entrada: passagem de 1 das pernas entre os braços – posição cavalgada e sustentar 2"', 17),

(3, 'Vela 2” c/ o quadril alto (mãos segurando em baixo da trave na altura da cabeça)', 17),


(4, 'Entrada: espacato de frente 180º (trave média ou alta)', 17),

(4, 'Entrada: esquadro afastado (longitudinal, trave média ou alta)', 17),

(4, 'Posição de equilíbrio Y - 2” acima de 90°', 17),

(4, 'Ponchê com abertura 180º', 17),


(5, 'Entrada: esquadro afastado (transversal)', 17),

(5, 'Parada de mãos na transversal e retorna à trave', 17);




-- ----------------------------------------------------------
-- APARELHO: PARALELAS SIMÉTRICAS
-- ----------------------------------------------------------


-- Grupo 1: Apoios (ID 18)
INSERT INTO nivel (ponto, exercicio, idGrupo) VALUES

(1, 'Deslocamento em 4 apoios de frente, lado ou dorsal', 18),


(2, 'Deslocamento no apoio', 18),


(3, 'Flexão e extensão dos braços no apoio 2x', 18),


(4, 'Balanços no apoio', 18),


(5, 'Balanços no apoio acima de 45º', 18);




-- Grupo 2: Suspensões (ID 19)
INSERT INTO nivel (ponto, exercicio, idGrupo) VALUES

(1, 'Deslocamento na suspensão com pernas estendidas', 19),


(2, 'Deslocamento na suspensão com pernas grupadas', 19),


(3, 'Balanços na suspensão com pernas grupadas', 19),


(4, 'Balanços na suspensão com pernas estendidas', 19),


(5, 'Balanços no apoio braquial', 19);




-- Grupo 3: Forças Estáticas (ID 20)
INSERT INTO nivel (ponto, exercicio, idGrupo) VALUES

(1, 'Vela estendida 1"', 20),


(2, 'Vela carpada 1"', 20),


(3, 'Da suspensão, subir ao apoio com auxílio das pernas', 20),


(4, 'Dominação traseira', 20),


(5, 'Parada de ombros 1"', 20);




-- Grupo 4: Esquadros (ID 21)
INSERT INTO nivel (ponto, exercicio, idGrupo) VALUES

(1, 'Esquadro grupado na suspensão 1"', 21),


(2, 'Esquadro carpado na suspensão 1"', 21),


(3, 'Esquadro grupado no apoio 1"', 21),


(4, 'Esquadro carpado no apoio 1"', 21),


(5, 'Esquadro alto no apoio 1"', 21);




-- Grupo 5: Saídas (Simétricas) (ID 22)
INSERT INTO nivel (ponto, exercicio, idGrupo) VALUES

(1, 'Passagem grupada das pernas entre os braços e solta atrás', 22),


(2, 'Passagem grupada das pernas entre os braços vai e volta', 22),


(3, 'Passagem carpada das pernas entre os braços vai e volta', 22),


(4, 'Saída pelo balanço atrás no apoio', 22),


(5, 'Saída pela frente com meia volta do balanço no apoio', 22);