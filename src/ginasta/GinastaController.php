<?php

session_start();

require_once 'Ginasta.php';
require_once 'GinastaDAO.php';

class GinastaController {

    public function cadastrar() {
        $nome = $_POST['nome'];
        $anoNasc = $_POST['anoNasc'];
        $idTurma = $_POST['idTurma'];
        
        $nome_foto = 'perfilPadrao.png'; 
        
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            $novo_nome = uniqid() . "." . $extensao;
            $destino = "../../assets/img/" . $novo_nome; 
            
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $destino)) {
                $nome_foto = $novo_nome;
            }
        }

        $ginasta = new Ginasta();
        $ginasta->setNome($nome);
        $ginasta->setAnoNasc($anoNasc);
        $ginasta->setIdTurma($idTurma);
        $ginasta->setFoto($nome_foto);

        $dao = new GinastaDAO();
        
        if ($dao->cadastrar($ginasta)) { 
            header("Location: views/listar.php?msg=cadastrado");
        } else {
            header("Location: views/cadastrar.php?erro=banco");
        }
    }

    public function atualizar() {
        $id = $_POST['id']; 
        $nome = $_POST['nome'];
        $anoNasc = $_POST['anoNasc'];
        $idTurma = $_POST['idTurma'];
        $foto_atual = $_POST['foto_atual']; // Nome da foto antiga

        $nome_foto = $foto_atual; // Começa valendo a antiga

        // Se enviou uma NOVA foto, faz o upload
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            $novo_nome = uniqid() . "." . $extensao;
            $destino = "../../assets/img/" . $novo_nome;
            
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $destino)) {
                $nome_foto = $novo_nome;
            }
        }

        $ginasta = new Ginasta();
        $ginasta->setId($id); // Importante setar o ID para o UPDATE funcionar
        $ginasta->setNome($nome);
        $ginasta->setAnoNasc($anoNasc);
        $ginasta->setIdTurma($idTurma);
        $ginasta->setFoto($nome_foto);

        $dao = new GinastaDAO();

        if ($dao->atualizar($ginasta)) {
            header("Location: views/listar.php?msg=atualizado");
        } else {
            header("Location: views/editar.php?id=$id&erro=erro_atualizar");
        }
    }

    public function excluir() {
        $id = $_GET['id'];

        $dao = new GinastaDAO();

        try {
            if ($dao->excluir($id)) {
                header("Location: views/listar.php?msg=excluido");
            } else {
                header("Location: views/listar.php?erro=erro_excluir");
            }
        } catch (PDOException $e) {
            header("Location: views/listar.php?erro=tem_notas");
        }
    }
}


// --- ROTEADOR ---

$controller = new GinastaController();

// 1. Verifica se veio dados de formulário (POST)
if (isset($_POST['acao'])) {
    
    if ($_POST['acao'] == 'cadastrar') {
        $controller->cadastrar();
    }
    else if ($_POST['acao'] == 'atualizar') {
        $controller->atualizar();
    }

// 2. Verifica se veio comando pela URL (GET) 
} else if (isset($_GET['acao'])) {
    
    if ($_GET['acao'] == 'excluir') {
        $controller->excluir();
    }
}

?>