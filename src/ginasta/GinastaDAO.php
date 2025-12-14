<?php

require_once __DIR__ . '/../../config/Conecta.php'; 
require_once 'Ginasta.php';

class GinastaDAO {
    private $conexao;

    public function __construct() {
        $database = new Conecta();
        $this->conexao = $database->getConexao();
    }

    public function inserir(Ginasta $ginasta) {
        try {

            $sql = "INSERT INTO ginasta (nome, anoNasc, foto, idTurma) VALUES (:nome, :anoNasc, :foto, :idTurma)";
            
            $stmt = $this->conexao->prepare($sql);
            
            $stmt->bindValue(':nome', $ginasta->getNome());
            $stmt->bindValue(':anoNasc', $ginasta->getAnoNasc());
            $stmt->bindValue(':foto', $ginasta->getFoto());
            $stmt->bindValue(':idTurma', $ginasta->getIdTurma());
            
            return $stmt->execute();

        } catch (PDOException $e) {
            return false;
        }
    }

    public function listar() {
        try {

            $sql = "SELECT g.*, t.nome as nome_turma 
                    FROM ginasta g 
                    JOIN turma t ON g.idTurma = t.id 
                    ORDER BY g.nome ASC";

            $stmt = $this->conexao->prepare($sql);


            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return [];
        }
    }


    public function buscarPorId($id) {
        
        $sql = "SELECT g.*, t.nome as nome_turma 
                FROM ginasta g 
                LEFT JOIN turma t ON g.idTurma = t.id 
                WHERE g.id = ?";
        
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute([$id]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>