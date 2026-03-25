<?php
class salidaModel{
    private $conn; 
    private $table = "salida"; 

    public function __construct($db)
    {
        $this->conn = $db; 
    }

    public function insertSalida($idproducto, $fechasalida, $cantidad)
    {
        $query = "INSERT INTO " . $this->table . "(idproducto, fechasalida, cantidad) VALUES (?,?,?)" ; 

        $stmt = $this->conn->prepare($query);
        $stmt->execute ([$idproducto, $fechasalida, $cantidad]);
    }

    public function getSalida($fechasalida)
    {
       $query = "SELECT * FROM " . $this->table  . " WHERE fechasalida LIKE ? "; 
       $stmt = $this->conn->prepare($query); 
       $stmt->execute(["%" . $fechasalida . "%"]); 
       return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    // NUEVO MÉTODO: Obtener una salida específica por su ID
    public function getSalidaPorId($idsalida)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE idsalida = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$idsalida]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function Eliminar($idsalidaE) {
        $query = "DELETE FROM " . $this->table . " WHERE idsalida = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$idsalidaE]);
    }

    public function actualizar($idproducto, $fechasalida, $cantidad, $idsalida)
    {
         $query = "UPDATE " . $this->table . " SET idproducto=?, fechasalida=?, cantidad=?
       WHERE idsalida=?";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([$idproducto, $fechasalida, $cantidad, $idsalida]);
    }
}