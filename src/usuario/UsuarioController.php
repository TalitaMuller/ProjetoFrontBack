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
            } else {

                header("Location: ../../index.php?erro=login_invalido");
            }
        } else {
            header("Location: ../../index.php?erro=campos_vazios");
        }
    }

    public function sair() {
        session_destroy();
        header("Location: ../../index.php");
    }
}




$controller = new UsuarioController();


// Verifica qual ação veio do formulário
if (isset($_POST['acao'])) {
    
    if ($_POST['acao'] == 'logar') {
        $controller->logar();
    }
    
} else if (isset($_GET['acao'])) {
    
    if ($_GET['acao'] == 'sair') {
        $controller->sair();
    }
}






?>