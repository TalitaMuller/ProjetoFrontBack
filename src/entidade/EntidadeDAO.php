<?php

require_once __DIR__ . '/../../config/Conecta.php'; 
require_once 'Entidade.php';

class EntidadeDAO {
    private $conexao;

    public function __construct() {
        $database = new Conecta();
        $this->conexao = $database->getConexao();
    }

    public function inserir(Entidade $entidade) {
        try {

            $sql = "INSERT INTO entidade (nome) VALUES (:nome)";

            $stmt = $this->conexao->prepare($sql);

            $stmt->bindValue(':nome', $entidade->getNome());
            
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function listar() {
        try {
            $sql = "SELECT * FROM entidade ORDER BY nome ASC";

            $stmt = $this->conexao->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return [];
        }
    }
}

?>