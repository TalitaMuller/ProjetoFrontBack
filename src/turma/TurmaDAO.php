<?php
require_once __DIR__ . '/../../config/Conecta.php';

class TurmaDAO {
    private $conexao;

    public function __construct() {
        $database = new Conecta();
        $this->conexao = $database->getConexao();
    }

    public function cadastrar($turma) {
        $sql = "INSERT INTO turma (nome, idEntidade) VALUES (?, ?)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $turma->getNome());
        $stmt->bindValue(2, $turma->getIdEntidade());
        return $stmt->execute();
    }

    public function listar() {
        // Faz o JOIN para mostrar o nome da Entidade na lista
        $sql = "SELECT t.*, e.nome as nome_entidade 
                FROM turma t 
                LEFT JOIN entidade e ON t.idEntidade = e.id 
                ORDER BY t.nome ASC";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $sql = "SELECT * FROM turma WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar($turma) {
        $sql = "UPDATE turma SET nome = ?, idEntidade = ? WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $turma->getNome());
        $stmt->bindValue(2, $turma->getIdEntidade());
        $stmt->bindValue(3, $turma->getId());
        return $stmt->execute();
    }

    public function excluir($id) {
        $sql = "DELETE FROM turma WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }
}
?>