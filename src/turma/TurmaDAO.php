<?php

require_once __DIR__ . '/../../config/Conecta.php'; 
require_once 'Turma.php';

class TurmaDAO {
    private $conexao;

    public function __construct() {
        $database = new Conecta();
        $this->conexao = $database->getConexao();
    }

    public function inserir(Turma $turma) {
        try {
            
            $sql = "INSERT INTO turma (nome, idEntidade) VALUES (:nome, :idEntidade)";
            $stmt = $this->conexao->prepare($sql);
            
            $stmt->bindValue(':nome', $turma->getNome());
            $stmt->bindValue(':idEntidade', $turma->getIdEntidade());
            
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function listar() {
        try {

            $sql = "SELECT t.*, e.nome as nome_entidade 
                    FROM turma t 
                    JOIN entidade e ON t.idEntidade = e.id 
                    ORDER BY t.nome ASC";

            $stmt = $this->conexao->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return [];
        }
    }
}



?>