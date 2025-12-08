<?php

require_once __DIR__ . '/../../config/Conecta.php'; 
require_once 'Usuario.php';

class UsuarioDAO {

    private $conexao;

    public function __construct() {
        $database = new Conecta();
        $this->conexao = $database->getConexao();
    }

    public function logar(Usuario $usuario) {
        try {
            $sql = "SELECT * FROM usuario WHERE email = :email AND senha = :senha";
            $stmt = $this->conexao->prepare($sql);
            
            // Vincula os valores do model
            $stmt->bindValue(':email', $usuario->getEmail());
            $stmt->bindValue(':senha', $usuario->getSenha());
            
            $stmt->execute();

            // Se achou uma linha, retorna os dados
            if ($stmt->rowCount() > 0) {
                return $stmt->fetch(PDO::FETCH_ASSOC); 
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }
}

?>