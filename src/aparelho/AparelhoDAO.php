<?php

require_once __DIR__ . '/../../config/Conecta.php'; 

class AparelhoDAO {

    private $conexao;

    public function __construct() {
        $database = new Conecta();
        $this->conexao = $database->getConexao();
    }

    public function listar() {
        
        $sql = "SELECT * FROM aparelho ORDER BY nome ASC";
        $stmt = $this->conexao->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function buscarPorId($id) {

        $sql = "SELECT * FROM aparelho WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>