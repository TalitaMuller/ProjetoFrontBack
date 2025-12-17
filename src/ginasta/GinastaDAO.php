<?php
require_once __DIR__ . '/../../config/Conecta.php';

class GinastaDAO {
    private $conexao;

    public function __construct() {
        $database = new Conecta();
        $this->conexao = $database->getConexao();
    }

    public function cadastrar($ginasta) {
        $sql = "INSERT INTO ginasta (nome, anoNasc, idTurma, foto) VALUES (?, ?, ?, ?)";
        $stmt = $this->conexao->prepare($sql);
        
        $stmt->bindValue(1, $ginasta->getNome());
        $stmt->bindValue(2, $ginasta->getAnoNasc());
        $stmt->bindValue(3, $ginasta->getIdTurma());
        $stmt->bindValue(4, $ginasta->getFoto());
        
        return $stmt->execute();
    }

    public function listar() {
        $sql = "SELECT g.*, t.nome as nome_turma 
                FROM ginasta g 
                LEFT JOIN turma t ON g.idTurma = t.id 
                ORDER BY g.nome ASC";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    public function atualizar($ginasta) {
        $sql = "UPDATE ginasta SET nome = ?, anoNasc = ?, idTurma = ?, foto = ? WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        
        $stmt->bindValue(1, $ginasta->getNome());
        $stmt->bindValue(2, $ginasta->getAnoNasc());
        $stmt->bindValue(3, $ginasta->getIdTurma());
        $stmt->bindValue(4, $ginasta->getFoto());
        $stmt->bindValue(5, $ginasta->getId());
        
        return $stmt->execute();
    }

    public function excluir($id) {
        
        // Apagar todas as notas dessa ginasta primeiro
        $sqlLimpaNotas = "DELETE FROM itemsumula WHERE idGinasta = ?";
        $stmtLimpa = $this->conexao->prepare($sqlLimpaNotas);
        $stmtLimpa->bindValue(1, $id);
        $stmtLimpa->execute();

        // Agora que ela está livre, podemos apagar o cadastro dela
        $sqlGinasta = "DELETE FROM ginasta WHERE id = ?";
        $stmt = $this->conexao->prepare($sqlGinasta);
        $stmt->bindValue(1, $id);
        
        return $stmt->execute();
    }
}
?>