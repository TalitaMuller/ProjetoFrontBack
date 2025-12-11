<?php

session_start();

require_once 'Ginasta.php';
require_once 'GinastaDAO.php';

class GinastaController {

    public function cadastrar() {
        $nome = $_POST['nome'];
        $anoNasc = $_POST['anoNasc'];
        $idTurma = $_POST['idTurma'];
        
        
        $nome_foto = 'perfilPadrao.png'; // Se não mandar foto, fica a padrão
        
        // Verifica se enviou arquivo e se não deu erro
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            
            // Pega a extensão 
            $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            
            // Cria um nome único 
            $novo_nome = uniqid() . "." . $extensao;
            
            // Define onde salvar 
            $destino = "../../assets/img/" . $novo_nome;
            
            // Tenta mover o arquivo
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $destino)) {
                $nome_foto = $novo_nome; // Se deu certo, usa o novo nome no banco
            }
        }
        

        $ginasta = new Ginasta();
        $ginasta->setNome($nome);
        $ginasta->setAnoNasc($anoNasc);
        $ginasta->setIdTurma($idTurma);
        $ginasta->setFoto($nome_foto);

        $dao = new GinastaDAO();
        
        if ($dao->inserir($ginasta)) {
            header("Location: views/cadastrar.php?sucesso=1");
        } else {
            header("Location: views/cadastrar.php?erro=banco");
        }
    }
}


// Roteador


$controller = new GinastaController();


if (isset($_POST['acao']) && $_POST['acao'] == 'cadastrar') {
    $controller->cadastrar();
}

?>