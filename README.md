# Súmula Digital GA

**Sistema de Gestão e Avaliação para Ginástica Artística**

Projeto final integrado desenvolvido para as disciplinas de **Desenvolvimento Front-End 1** e **Desenvolvimento Back-End 1** do curso Superior de Tecnologia em Sistemas para Internet (IFSul).

## Sobre o Projeto

A **Súmula Digital GA** é uma aplicação web Full Stack desenvolvida para substituir o preenchimento manual de súmulas em competições e treinos de ginástica artística. O sistema automatiza o cálculo de notas, gerencia cadastros de atletas e turmas, e fornece uma interface responsiva para uso em dispositivos móveis pelos treinadores.

### Objetivos Atendidos
Este projeto foi arquitetado para atender simultaneamente aos requisitos de duas áreas:
* **Front-End:** Interface rica, responsiva, acessível e com interatividade via JavaScript (API HTML5, Manipulação de DOM).
* **Back-End:** Arquitetura robusta em MVC, persistência de dados segura com PDO e modelagem relacional completa.

---

## Tecnologias e Ferramentas

### Front-End (Interface & Interatividade)
* **HTML5 Semântico:** Estrutura organizada (`<header>`, `<nav>`, `<main>`) e acessível.
* **CSS3 Moderno:**
    * **Flexbox & Grid:** Layout totalmente responsivo (Mobile-First).
    * **CSS Variables:** Gerenciamento dinâmico de temas (Claro/Escuro).
* **JavaScript (Vanilla ES6+):**
    * **Web Storage API:** Persistência de preferências do usuário (Tema Escuro).
    * **Drag and Drop API:** Upload intuitivo de fotos das ginastas.
    * **Manipulação do DOM:** Filtros de pesquisa em tempo real, Modais e Menus Responsivos.

### Back-End (Regra de Negócio & Dados)
* **Linguagem:** PHP 8+.
* **Arquitetura:** MVC (Model-View-Controller) para separação de responsabilidades.
* **Padrão de Projeto:** DAO (Data Access Object) para abstração do banco de dados.
* **Banco de Dados:** MySQL.
* **Segurança:** Uso de **PDO** (PHP Data Objects) com Prepared Statements para prevenção de SQL Injection.

---

## Funcionalidades Principais

1.  **Autenticação Segura:** Login de usuários e gestão de sessão.
2.  **Gestão Completa (CRUDs):**
    * **Entidades:** Cadastro de clubes e escolas.
    * **Turmas:** Organização de grupos de treino.
    * **Ginastas:** Perfil completo com foto e dados biométricos.
    * **Aparelhos:** Definição dos aparelhos (Trave, Solo, etc.).
3.  **Montagem de Súmula Dinâmica:**
    * Seleção visual de exercícios baseada no regulamento.
    * Cálculo automático da nota de dificuldade (D-Score).
4.  **Boletim e Relatórios:**
    * Geração de boletim visual para impressão ou visualização em tela.
5.  **Experiência do Usuário (UX):**
    * **Modo Escuro (Dark Mode):** Alternância de tema para ambientes com pouca luz.
    * **Busca Rápida:** Filtro instantâneo em todas as listagens.

---

## Modelagem de Dados

O sistema utiliza um banco de dados relacional robusto para garantir a integridade das avaliações.

**Principais Entidades:**
* `Usuario` (Treinadores)
* `Entidade` & `Turma` (Organização)
* `Ginasta` (Atletas)
* `Aparelho`, `Grupo`, `Nivel` (Regras de Negócio da Ginástica)
* `ItemSumula` (Registro das avaliações realizadas)

*[Consulte o Diagrama ER completo na documentação do projeto]*

---

## Como Executar o Projeto

### Pré-requisitos
* Servidor Web (Apache/Nginx) ou ambiente local (XAMPP/Laragon).
* PHP 7.4 ou superior.
* MySQL/MariaDB.

### Passo a Passo

1.  **Clonar o Repositório:**
    ```bash
    git clone [https://github.com/TalitaMuller/ProjetoFrontBack](https://github.com/TalitaMuller/ProjetoFrontBack)
    ```

2.  **Configurar o Banco de Dados:**
    * Crie um banco de dados no MySQL (`sumulaDigital`).
    * Importe o arquivo SQL disponível na pasta `/database/sumulaDigital.sql`.

3.  **Configurar Conexão:**
    * Acesse o arquivo de configuração (`src/config/Conecta.php`).
    * Ajuste as credenciais (`host`, `db_name`, `username`, `password`).

4.  **Executar:**
    * Inicie o servidor Apache e MySQL.
    * Acesse via navegador: `http://localhost/ProjetoFrontBack/`.

---

## Autoria e Acadêmico

**Aluna:** Talita Müller Reis
**Curso Superior:** Tecnologia em Sistemas para Internet (IFSul - Campus Pelotas)
**Disciplinas:**
* Desenvolvimento Front-End 1 (Prof. Rafael Cunha Cardoso)
* Desenvolvimento Back-End 1 (Prof. Marla Cristina da Silva Sopena)

---
*Projeto desenvolvido em Novembro/Dezembro de 2025.*