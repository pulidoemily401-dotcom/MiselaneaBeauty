<?php
class marcaModel{
    private $conn; 
    private $table = "marca"; 

    public function __construct($db)
    {
        $this->conn = $db; 
    }

    public function insertMarca($marca)
    {
        $query = "INSERT INTO " . $this->table . "(marca) VALUES (?)" ; 
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$marca]);
    }

    public function getMarca($marca = "")
    {
        $query = "SELECT * FROM " . $this->table  . " WHERE marca LIKE ? "; 
        $stmt = $this->conn->prepare($query); 
        $stmt->execute(["%" . $marca . "%"]); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    // NUEVO MÉTODO - Obtener marca por ID
    public function obtenerMarcaPorId($idmarca)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE idmarca = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$idmarca]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function Eliminar($idmarcaE) {
        $query = "DELETE FROM " . $this->table . " WHERE idmarca = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$idmarcaE]);
    }
  
public function tieneProductos($idmarca)
{
    $query = "SELECT COUNT(*) FROM producto WHERE idmarca = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$idmarca]);
    return $stmt->fetchColumn() > 0;
}

    public function actualizar($marca, $idmarca)
    {
        $query = "UPDATE " . $this->table . " SET marca = ? WHERE idmarca = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$marca, $idmarca]);
    }
}