<?php
require_once 'Base.php';

class ArticuloCrud extends Database {
    
    public function __construct() {
        $this->conectar();
    }

    public function mostrarTodos() {
        $query = "SELECT * FROM articulo";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function mostrarPorId($id) {
        $query = "SELECT * FROM articulo WHERE idproducto = :id";
        $stmt = $this->conn->prepare($query);
    }

    public function guardar($descripcion, $fecha_adquisicion, $cantidad, $precio) {
        $total = $cantidad * $precio;
        
        $query = "INSERT INTO articulo (descripcion, fecha_adquisicion, cantidad, precio, total) 
                  VALUES (:descripcion, :fecha, :cantidad, :precio, :total)";
        
        $stmt = $this->conn->prepare($query);
        
        return $stmt->execute();
    }

    public function actualizar($id, $descripcion, $fecha_adquisicion, $cantidad, $precio) {
        $total = $cantidad * $precio;
        
        $query = "UPDATE articulo 
                  SET descripcion = :descripcion, fecha_adquisicion = :fecha, cantidad = :cantidad, precio = :precio, total = :total 
                  WHERE idproducto = :id";
        
        $stmt = $this->conn->prepare($query);        
        return $stmt->execute();
    }

    public function eliminar($id) {
        $query = "DELETE FROM articulo WHERE idproducto = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>