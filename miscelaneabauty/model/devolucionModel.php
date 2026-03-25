<?php
class devolucionModel {
    private $conn;
    private $table = "devolucion";

    public function __construct($db) {
        $this->conn = $db;
    }

  
    public function insertDevolucion($idproducto, $cantidad, $fechaingreso, $idfactura, $descripcionmotivo) {
        $query = "INSERT INTO " . $this->table . " (idproducto, cantidad, fechaingreso, idfactura, descripcionmotivo) 
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$idproducto, $cantidad, $fechaingreso, $idfactura, $descripcionmotivo]);
    }

   public function getDevolucionByUsuario($numerodocumen) {
    $query = "SELECT d.*, p.nombre AS nombreproducto, f.numerodocumen
              FROM devolucion d
              LEFT JOIN producto p ON d.idproducto = p.idproducto
              LEFT JOIN factura f ON d.idfactura = f.idfactura
              WHERE f.numerodocumen = ?
              ORDER BY d.iddevolucion DESC";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$numerodocumen]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    public function getDevolucion() {
        $query = "SELECT d.*, p.nombre AS nombreproducto, f.numerodocumen
                  FROM " . $this->table . " d
                  LEFT JOIN producto p ON d.idproducto = p.idproducto
                  LEFT JOIN factura f ON d.idfactura = f.idfactura
                  ORDER BY d.iddevolucion DESC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function getDevolucionByFactura($idfactura) {
        $query = "SELECT d.*, p.nombre AS nombreproducto, f.numerodocumen
                  FROM " . $this->table . " d
                  LEFT JOIN producto p ON d.idproducto = p.idproducto
                  LEFT JOIN factura f ON d.idfactura = f.idfactura
                  WHERE d.idfactura = ? 
                  ORDER BY d.iddevolucion DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$idfactura]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

   
    public function getDevolucionById($iddevolucion) {
        $query = "SELECT * FROM " . $this->table . " WHERE iddevolucion = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$iddevolucion]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

   
    public function Eliminar($iddevolucion) {
        $query = "DELETE FROM " . $this->table . " WHERE iddevolucion = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$iddevolucion]);
    }

   
    public function actualizar($idproducto, $cantidad, $fechaingreso, $idfactura, $descripcionmotivo, $iddevolucion) {
        $query = "UPDATE " . $this->table . " 
                  SET idproducto=?, cantidad=?, fechaingreso=?, idfactura=?, descripcionmotivo=? 
                  WHERE iddevolucion=?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$idproducto, $cantidad, $fechaingreso, $idfactura, $descripcionmotivo, $iddevolucion]);
    }
}