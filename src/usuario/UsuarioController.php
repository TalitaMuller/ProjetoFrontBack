<?php

session_start();

require_once 'Usuario.php';
require_once 'UsuarioDAO.php';

class UsuarioController {

    public function logar() {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        if (!empty($email) && !empty($senha)) {
            $usuario = new Usuario();
            $usuario->setEmail($email);
            $usuario->setSenha($senha);

            $usuarioDAO = new UsuarioDAO();
            $resultado = $usuarioDAO->logar($usuario);

            if ($resultado) {
                $_SESSION['logado'] = true;
                $_SESSION['usuario_id'] = $resultado['id'];
                $_SESSION['usuario_nome'] = $resultado['nome'];
                
                header("Location: ../../home.php");
                exit;
            } else {
                header("Location: ../../index.php?erro=login_invalido");
                exit;
            }
        } else {
            header("Location: ../../index.php?erro=campos_vazios");
            exit;
        }
    }

    public function sair() {
        session_destroy();
        header("Location: ../../index.php");
        exit;
    }

    public function cadastrar() {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $confirma_senha = $_POST['confirma_senha'];

        // Caminho da view de cadastro 
        $url_erro = "Location: views/cadastrar.php"; 

        // Campos vazios
        if (empty($nome) || empty($email) || empty($senha) || empty($confirma_senha)) {
            header("$url_erro?erro=campos_vazios");
            exit;
        }

        // Senhas iguais
        if ($senha !== $confirma_senha) {
            header("$url_erro?erro=senhas_diferentes");
            exit;
        }

        // Validação de Senha Forte
        if (strlen($senha) < 8) {
            header("$url_erro?erro=senha_curta");
            exit;
        }
        if (!preg_match('/[A-Z]/', $senha)) {
            header("$url_erro?erro=senha_sem_maiuscula");
            exit;
        }
        if (!preg_match('/[a-z]/', $senha)) {
            header("$url_erro?erro=senha_sem_minuscula");
            exit;
        }
        if (!preg_match('/[0-9]/', $senha)) {
            header("$url_erro?erro=senha_sem_numero");
            exit;
        }
        if (!preg_match('/[^A-Za-z0-9]/', $senha)) {
            header("$url_erro?erro=senha_sem_simbolo");
            exit;
        }

        try {
            $usuarioDAO = new UsuarioDAO();
            $usuarioDAO->cadastrar($nome, $email, $senha);

            header("Location: ../../index.php?msg=cadastrado");
            exit;

        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { 
                header("$url_erro?erro=email_existente");
            } else {
                header("$url_erro?erro=erro_banco");
            }
            exit;
        }
    }

    public function atualizar() {
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: ../../index.php?erro=acesso_negado");
            exit;
        }

        $id = $_SESSION['usuario_id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $nova_senha = $_POST['nova_senha'];

        $dao = new UsuarioDAO();

        // Atualiza Nome e Email
        $dao->atualizarDados($id, $nome, $email);
        
        // Atualiza a sessão para o nome novo aparecer no topo
        $_SESSION['usuario_nome'] = $nome;

        // Se digitou senha nova
        if (!empty($nova_senha)) {
            if (strlen($nova_senha) < 6) {
                header("Location: views/perfil.php?erro=senha_curta");
                exit;
            }
            $dao->atualizarSenha($id, $nova_senha);
        }

        // Redireciona com parâmetro MSG para o JavaScript pegar
        header("Location: views/perfil.php?msg=atualizado");
        exit;
    }

    public function excluir() {
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: ../../index.php");
            exit;
        }

        $id = $_SESSION['usuario_id'];
        $dao = new UsuarioDAO();

        if ($dao->excluir($id)) {
            session_destroy();
            // Avisa no login que a conta foi excluída
            header("Location: ../../index.php?msg=conta_excluida");
            exit;
        } else {
            header("Location: views/perfil.php?erro=erro_excluir");
            exit;
        }
    }
}

// --- ROTEADOR ---
$controller = new UsuarioController();

if (isset($_POST['acao'])) {
    if ($_POST['acao'] == 'logar') {
        $controller->logar();
    }
    else if ($_POST['acao'] == 'cadastrar') {
        $controller->cadastrar();
    }
    else if ($_POST['acao'] == 'atualizar') {
        $controller->atualizar();
    }
} else if (isset($_GET['acao'])) {
    if ($_GET['acao'] == 'sair') {
        $controller->sair();
    }
    else if ($_GET['acao'] == 'excluir_conta') { 
        $controller->excluir(); 
    }
}
?>