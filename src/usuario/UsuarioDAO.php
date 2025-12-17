<?php
require_once __DIR__ . '/../../config/Conecta.php';

class UsuarioDAO {
    private $conexao;

    public function __construct() {
        $database = new Conecta();
        $this->conexao = $database->getConexao();
    }

    public function cadastrar($nome, $email, $senha) {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuario (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', $senhaHash);
        return $stmt->execute();
    }

    public function logar($usuario) {
        $sql = "SELECT * FROM usuario WHERE email = :email";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':email', $usuario->getEmail());
        $stmt->execute();
        $dadosUsuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dadosUsuario && password_verify($usuario->getSenha(), $dadosUsuario['senha'])) {
            return $dadosUsuario;
        }
        return false;
    }

    // =================================================================
    // NOVOS MÉTODOS 
    // =================================================================

    //Busca dados para preencher a tela
    public function buscarPorId($id) {
        $sql = "SELECT * FROM usuario WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Atualiza só Nome e Email 
    public function atualizarDados($id, $nome, $email) {
        $sql = "UPDATE usuario SET nome = ?, email = ? WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $nome);
        $stmt->bindValue(2, $email);
        $stmt->bindValue(3, $id);
        return $stmt->execute();
    }

    // Atualiza só a Senha 
    public function atualizarSenha($id, $novaSenha) {
        $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
        $sql = "UPDATE usuario SET senha = ? WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $senhaHash);
        $stmt->bindValue(2, $id);
        return $stmt->execute();
    }

    // Excluir conta
    public function excluir($id) {
        $sql = "DELETE FROM usuario WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }
}
?>