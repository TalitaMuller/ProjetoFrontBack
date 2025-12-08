<?php

session_start();
require_once 'Entidade.php';
require_once 'EntidadeDAO.php';

class EntidadeController {

    public function cadastrar() {
        $nome = $_POST['nome'];

        if (!empty($nome)) {
            $entidade = new Entidade();
            $entidade->setNome($nome);

            $entidadeDAO = new EntidadeDAO();
            
            if ($entidadeDAO->inserir($entidade)) {
                header("Location: views/cadastrar.php?sucesso=1");
            } else {
                header("Location: views/cadastrar.php?erro=banco");
            }
        } else {
            header("Location: views/cadastrar.php?erro=vazio");
        }
    }
}


// ROTEADOR


$controller = new EntidadeController();


if (isset($_POST['acao']) && $_POST['acao'] == 'cadastrar') {
    $controller->cadastrar();
}


?>