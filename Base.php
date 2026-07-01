<?php
require_once 'conexion.php';
require_once 'articulo.php';

class Crud extends Conexion {
    
    public function guardar(Articulo $producto) {
        try {
            $db = $this->conexion();
            $sql = "INSERT INTO articulo (descripcion, fecha_adquisicion, cantidad, precio, total) 
                    VALUES (:descripcion, :fecha_adquisicion, :cantidad, :precio, :total)";
            
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':descripcion', $producto->descripcion);
            $stmt->bindParam(':fecha_adquisicion', $producto->fecha_adquisicion);
            $stmt->bindParam(':cantidad', $producto->cantidad);
            $stmt->bindParam(':precio', $producto->precio);
            $stmt->bindParam(':total', $producto->total);
            
            $stmt->execute();
            $this->cerrar();
            return true;
        } catch (PDOException $e) {
            echo "Error al guardar: " . $e->getMessage();
            return false;
        }
    }

    public function obtenerProductos() {
        try {
            $db = $this->conexion();
            $sql = "SELECT * FROM articulo";
            $stmt = $db->query($sql);
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $this->cerrar();
            return $resultados;
        } catch (PDOException $e) {
            echo "Error al consultar: " . $e->getMessage();
            return [];
        }
    }

    public function obtenerProdXId($id) {
        try {
            $db = $this->conexion();
            $sql = "SELECT * FROM articulo WHERE idproducto = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->cerrar();
            return $resultado;
        } catch (PDOException $e) {
            echo "Error al buscar: " . $e->getMessage();
            return null;
        }
    }

    public function actualizar(Articulo $producto) {
        try {
            $db = $this->conexion();
            $sql = "UPDATE articulo SET 
                    descripcion = :descripcion, 
                    fecha_adquisicion = :fecha_adquisicion, 
                    cantidad = :cantidad, 
                    precio = :precio, 
                    total = :total 
                    WHERE idproducto = :id";
            
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':descripcion', $producto->descripcion);
            $stmt->bindParam(':fecha_adquisicion', $producto->fecha_adquisicion);
            $stmt->bindParam(':cantidad', $producto->cantidad);
            $stmt->bindParam(':precio', $producto->precio);
            $stmt->bindParam(':total', $producto->total);
            $stmt->bindParam(':id', $producto->idproducto, PDO::PARAM_INT);
            
            $stmt->execute();
            $this->cerrar();
            return true;
        } catch (PDOException $e) {
            echo "Error al actualizar: " . $e->getMessage();
            return false;
        }
    }

    public function eliminar($id) {
        try {
            $db = $this->conexion();
            $sql = "DELETE FROM articulo WHERE idproducto = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $this->cerrar();
            return true;
        } catch (PDOException $e) {
            echo "Error al eliminar: " . $e->getMessage();
            return false;
        }
    }
}
?>