<?php
// Ajuste os caminhos conforme necessário
require_once 'ItemSumula.php';
require_once 'ItemSumulaDAO.php';

class ItemSumulaController {

    public function salvar() {
        $idGinasta = $_POST['idGinasta'];
        $idAparelho = $_POST['idAparelho'];
        
        $exerciciosSelecionados = isset($_POST['exercicios_selecionados']) ? $_POST['exercicios_selecionados'] : [];

        $dao = new ItemSumulaDAO();

        try {
            // Limpa as notas antigas (para evitar duplicação ou manter itens desmarcados)
            $dao->limparNotasAnteriores($idGinasta, $idAparelho);

            // Salva as novas notas marcadas
            foreach ($exerciciosSelecionados as $idNivel) {
                $item = new ItemSumula();
                $item->setIdGinasta($idGinasta);
                $item->setIdNivel($idNivel);

                $dao->cadastrar($item);
            }

            // Redireciona para o Boletim
            header("Location: views/boletim.php?idGinasta=$idGinasta&idAparelho=$idAparelho");
            exit;

        } catch (Exception $e) {
            echo "Erro ao salvar: " . $e->getMessage();
            echo "<br><a href='views/montar.php?idGinasta=$idGinasta&idAparelho=$idAparelho'>Voltar</a>";
        }
    }
}

// --- ROTEADOR ---

$controller = new ItemSumulaController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['acao']) && $_POST['acao'] == 'salvar') {
        $controller->salvar();
    } 
    
    else {
        $controller->salvar();
    }
} 
else {
    header('Location: ../../home.php');
}
?>