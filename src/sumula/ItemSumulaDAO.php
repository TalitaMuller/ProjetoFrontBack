<?php

require_once __DIR__ . '/../../config/Conecta.php';
require_once __DIR__ . '/ItemSumula.php'; 

class ItemSumulaDAO {

    private $conexao;

    public function __construct() {
        $database = new Conecta();
        $this->conexao = $database->getConexao();
    }

    // Método para SALVAR um checkbox marcado
    public function cadastrar(ItemSumula $item) {
        $sql = "INSERT INTO itemsumula (idGinasta, idNivel) VALUES (:idGinasta, :idNivel)";
        $stmt = $this->conexao->prepare($sql);
        
        $stmt->bindValue(':idGinasta', $item->getIdGinasta());
        $stmt->bindValue(':idNivel', $item->getIdNivel());
        
        return $stmt->execute();
    }

    // Método para LIMPAR notas anteriores 
    public function limparNotasAnteriores($idGinasta, $idAparelho) {
        
        
        $sql = "DELETE FROM itemsumula 
                WHERE idGinasta = :idGinasta 
                AND idNivel IN (
                    SELECT n.id 
                    FROM nivel n
                    INNER JOIN grupo g ON n.idGrupo = g.id
                    WHERE g.idAparelho = :idAparelho
                )";
        
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':idGinasta', $idGinasta);
        $stmt->bindValue(':idAparelho', $idAparelho);
        
        return $stmt->execute();
    }

    public function buscarExerciciosRealizados($idGinasta) {
        $sql = "SELECT idNivel FROM itemsumula WHERE idGinasta = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute([$idGinasta]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
?>