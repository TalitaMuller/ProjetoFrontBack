<?php
class Conecta {

    private $host = "localhost";
    private $db_name = "sumulaDigital"; 
    private $username = "root";
    private $password = ""; 
    public $conn;

    public function getConexao() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8", $this->username, $this->password);
            
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch(PDOException $exception) {
            die("Erro de conexão: " . $exception->getMessage());
        }

        return $this->conn;
    }
}
?>