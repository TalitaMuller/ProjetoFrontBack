<?php
require_once '../../../config/Conecta.php';

// Verifica se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Recebe os IDs da Ginasta e do Aparelho
    $idGinasta = $_POST['idGinasta'];
    $idAparelho = $_POST['idAparelho'];
    
    // Recebe os exercícios marcados (se nenhum for marcado, cria um array vazio)
    $exerciciosSelecionados = isset($_POST['exercicios_selecionados']) ? $_POST['exercicios_selecionados'] : [];

    try {
        $database = new Conecta();
        $conexao = $database->getConexao();

        if (!empty($exerciciosSelecionados)) {
            $sql = "INSERT INTO itemsumula (idGinasta, idNivel) VALUES (:idGinasta, :idNivel)";
            $stmt = $conexao->prepare($sql);

            foreach ($exerciciosSelecionados as $idNivel) {
                $stmt->bindValue(':idGinasta', $idGinasta);
                $stmt->bindValue(':idNivel', $idNivel);
                $stmt->execute();
            }
        }

        echo "<script>
                alert('Avaliação salva com sucesso! ');
                window.location.href = '../../../home.php'; 
              </script>";

    } catch (PDOException $e) {
        echo "<h3 style='color:red'>Erro ao salvar:</h3>";
        echo "<p>" . $e->getMessage() . "</p>";
        echo "<a href='selecionar.php'>Voltar</a>";
    }

} else {
    // Se tentar entrar na página direto sem enviar o formulário
    header('Location: selecionar.php');
}
?>