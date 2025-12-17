<?php
require_once __DIR__ . '/../../config/Conecta.php';

class EntidadeDAO {
    private $conexao;

    public function __construct() {
        $database = new Conecta();
        $this->conexao = $database->getConexao();
    }

    public function cadastrar($entidade) {
        $sql = "INSERT INTO entidade (nome) VALUES (?)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $entidade->getNome());
        return $stmt->execute();
    }

    public function listar() {
        $sql = "SELECT * FROM entidade ORDER BY nome ASC";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $sql = "SELECT * FROM entidade WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar($entidade) {
        $sql = "UPDATE entidade SET nome = ? WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $entidade->getNome());
        $stmt->bindValue(2, $entidade->getId());
        return $stmt->execute();
    }

    public function excluir($id) {
        $sql = "DELETE FROM entidade WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }
}
?>