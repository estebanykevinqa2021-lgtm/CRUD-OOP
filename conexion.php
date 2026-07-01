<?php
class Conexion {
    protected $host = "localhost";
    protected $user = "root";
    protected $pass = "";
    protected $db = "inventariodb";
    protected $conn;

    public function conexion() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db;charset=utf8", $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    // Método para cerrar la conexión
    public function cerrar() {
        $this->conn = null;
    }
}
?>