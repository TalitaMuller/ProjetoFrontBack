<?php
session_start();
require_once 'Turma.php';
require_once 'TurmaDAO.php';

class TurmaController {

    public function cadastrar() {
        $nome = $_POST['nome'];
        $idEntidade = $_POST['idEntidade'];

        $turma = new Turma();
        $turma->setNome($nome);
        $turma->setIdEntidade($idEntidade);

        $dao = new TurmaDAO();
        
        if ($dao->cadastrar($turma)) {
            header("Location: views/listar.php?msg=cadastrado");
            exit;
        } else {
            header("Location: views/cadastrar.php?erro=banco");
            exit;
        }
    }

    public function atualizar() {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $idEntidade = $_POST['idEntidade'];

        $turma = new Turma();
        $turma->setId($id);
        $turma->setNome($nome);
        $turma->setIdEntidade($idEntidade);

        $dao = new TurmaDAO();
        
        if ($dao->atualizar($turma)) {
            header("Location: views/listar.php?msg=atualizado");
            exit;
        } else {
            header("Location: views/editar.php?id=$id&erro=erro");
            exit;
        }
    }

    public function excluir() {
        $id = $_GET['id'];
        $dao = new TurmaDAO();
        try {
            if ($dao->excluir($id)) {
                header("Location: views/listar.php?msg=excluido");
                exit;
            }
        } catch (PDOException $e) {
            header("Location: views/listar.php?erro=tem_ginastas");
            exit;
        }
    }
}

$controller = new TurmaController();

if (isset($_POST['acao'])) {
    if ($_POST['acao'] == 'cadastrar') $controller->cadastrar();
    else if ($_POST['acao'] == 'atualizar') $controller->atualizar();
} else if (isset($_GET['acao'])) {
    if ($_GET['acao'] == 'excluir') $controller->excluir();
}
?>