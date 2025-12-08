<?php

session_start();

require_once 'Turma.php';
require_once 'TurmaDAO.php';

class TurmaController {

    public function cadastrar() {
        $nome = $_POST['nome'];
        $idEntidade = $_POST['idEntidade']; 

        if (!empty($nome) && !empty($idEntidade)) {
            $turma = new Turma();
            $turma->setNome($nome);
            $turma->setIdEntidade($idEntidade);

            $turmaDAO = new TurmaDAO();
            
            if ($turmaDAO ->inserir($turma)) {
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


$controller = new TurmaController();

if (isset($_POST['acao']) && $_POST['acao'] == 'cadastrar') {
    $controller->cadastrar();
}


?>