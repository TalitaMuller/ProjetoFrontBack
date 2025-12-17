<?php
session_start();
require_once 'Entidade.php';
require_once 'EntidadeDAO.php';

class EntidadeController {

    public function cadastrar() {
        $nome = $_POST['nome'];

        $entidade = new Entidade();
        $entidade->setNome($nome);

        $dao = new EntidadeDAO();
        if ($dao->cadastrar($entidade)) {
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

        $entidade = new Entidade();
        $entidade->setId($id);
        $entidade->setNome($nome);

        $dao = new EntidadeDAO();
        if ($dao->atualizar($entidade)) {
            header("Location: views/listar.php?msg=atualizado");
            exit;
        } else {
            header("Location: views/editar.php?id=$id&erro=erro_atualizar");
            exit;
        }
    }

    public function excluir() {
        $id = $_GET['id'];
        $dao = new EntidadeDAO();
        try {
            if ($dao->excluir($id)) {
                header("Location: views/listar.php?msg=excluido");
                exit;
            }
        } catch (PDOException $e) {
            header("Location: views/listar.php?erro=tem_vinculos");
            exit;
        }
    }
}

$controller = new EntidadeController();

if (isset($_POST['acao'])) {
    if ($_POST['acao'] == 'cadastrar') $controller->cadastrar();
    else if ($_POST['acao'] == 'atualizar') $controller->atualizar();
} else if (isset($_GET['acao'])) {
    if ($_GET['acao'] == 'excluir') $controller->excluir();
}
?>