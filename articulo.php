<?php
class Articulo {
    public $idproducto; 
    public $descripcion;
    public $fecha_adquisicion;
    public $cantidad;
    public $precio;
    public $total;

    public function __construct($descripcion, $fecha_adquisicion, $cantidad, $precio, $idproducto = null) {
        $this->idproducto = $idproducto;
        $this->descripcion = $descripcion;
        $this->fecha_adquisicion = $fecha_adquisicion;
        $this->cantidad = $cantidad;
        $this->precio = $precio;
        $this->total = $this->calcularTotal();
    }

    public function calcularTotal() {
        return $this->cantidad * $this->precio;
    }
}
?>