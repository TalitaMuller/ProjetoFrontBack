<?php

require_once __DIR__ . '/../../config/Conecta.php'; 

class NivelDAO {

    private $conexao;

    public function __construct() {
        $database = new Conecta();
        $this->conexao = $database->getConexao();
    }

    // Busca todos os exercícios de um aparelho, já trazendo o nome do grupo
    public function listarPorAparelho($idAparelho) {

        $sql = "SELECT 
                    n.id as id_nivel,
                    n.ponto,
                    n.exercicio,
                    g.nome as nome_grupo,
                    g.numero as num_grupo
                FROM nivel n
                INNER JOIN grupo g ON n.idGrupo = g.id
                WHERE g.idAparelho = :idAparelho
                ORDER BY g.id, n.ponto ASC";
        
        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(':idAparelho', $idAparelho);

        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>