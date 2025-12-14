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

        // Pega os dados do usuário encontrado
        $dadosUsuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Se achou o usuário, verifica a senha criptografada
        if ($dadosUsuario) {

            // password_verify(senha_digitada, senha_do_banco_criptografada)
            if (password_verify($usuario->getSenha(), $dadosUsuario['senha'])) {

                return $dadosUsuario; // Retorna os dados
            }
        }

        // Se não achou o email OU a senha não bateu
        return false;
    }
}
?>