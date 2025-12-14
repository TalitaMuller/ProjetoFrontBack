<?php

require_once __DIR__ . '/../../config/Conecta.php';

class ItemSumulaDAO {

    private $conexao;

    public function __construct() {
        $database = new Conecta();
        $this->conexao = $database->getConexao();
    }

    // Busca apenas os IDs dos exercícios que essa ginasta marcou
    public function buscarExerciciosRealizados($idGinasta) {

        $sql = "SELECT idNivel FROM itemsumula WHERE idGinasta = ?";
        $stmt = $this->conexao->prepare($sql);

        $stmt->execute([$idGinasta]);
        
        // Retorna um array simples: [1, 5, 12, 40...]
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}

?>