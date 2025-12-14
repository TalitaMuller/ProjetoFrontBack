<?php

session_start();

require_once 'Usuario.php';
require_once 'UsuarioDAO.php';

class UsuarioController {

    // --- LOGIN (JÁ EXISTIA) ---
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
            } else {
                header("Location: ../../index.php?erro=login_invalido");
            }
        } else {
            header("Location: ../../index.php?erro=campos_vazios");
        }
    }

    // --- SAIR (JÁ EXISTIA) ---
    public function sair() {
        session_destroy();
        header("Location: ../../index.php");
    }

    // --- CADASTRAR (NOVO!) ---
    // Trouxemos a lógica do salvar.php para cá
    public function cadastrar() {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $confirma_senha = $_POST['confirma_senha'];

        // 1. Validação: Campos vazios
        if (empty($nome) || empty($email) || empty($senha) || empty($confirma_senha)) {
            echo "<script>alert('Preencha todos os campos!'); window.history.back();</script>";
            return;
        }

        // 2. Validação: Senhas iguais
        if ($senha !== $confirma_senha) {
            echo "<script>alert('Erro: As senhas não coincidem!'); window.history.back();</script>";
            return;
        }

        // 3. Validação de Senha Forte (Backend)
        // Se a senha NÃO bater com alguma regra, barra o cadastro
        if (strlen($senha) < 8) {
            echo "<script>alert('A senha deve ter no mínimo 8 caracteres!'); window.history.back();</script>";
            return;
        }
        if (!preg_match('/[A-Z]/', $senha)) {
            echo "<script>alert('A senha precisa de pelo menos uma letra maiúscula!'); window.history.back();</script>";
            return;
        }
        if (!preg_match('/[a-z]/', $senha)) {
            echo "<script>alert('A senha precisa de pelo menos uma letra minúscula!'); window.history.back();</script>";
            return;
        }
        if (!preg_match('/[0-9]/', $senha)) {
            echo "<script>alert('A senha precisa de pelo menos um número!'); window.history.back();</script>";
            return;
        }
        if (!preg_match('/[^A-Za-z0-9]/', $senha)) {
            echo "<script>alert('A senha precisa de pelo menos um símbolo especial (ex: ! @ #) !'); window.history.back();</script>";
            return;
        }

        // Se passou por tudo, tenta salvar
        try {
            $usuarioDAO = new UsuarioDAO();
            $usuarioDAO->cadastrar($nome, $email, $senha);

            echo "<script>
                    alert('Usuário cadastrado com sucesso! Faça login agora.');
                    window.location.href = '../../index.php'; 
                  </script>";

        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { 
                echo "<script>alert('Erro: Este e-mail já está cadastrado!'); window.history.back();</script>";
            } else {
                echo "Erro ao cadastrar: " . $e->getMessage();
            }
        }
    }
    
}

// --- ROTEADOR (QUEM CHAMA AS FUNÇÕES) ---
$controller = new UsuarioController();

// Verifica qual ação veio do formulário
if (isset($_POST['acao'])) {
    
    if ($_POST['acao'] == 'logar') {
        $controller->logar();
    }
    else if ($_POST['acao'] == 'cadastrar') { // Adicionamos essa verificação
        $controller->cadastrar();
    }
    
} else if (isset($_GET['acao'])) {
    
    if ($_GET['acao'] == 'sair') {
        $controller->sair();
    }
}
?>