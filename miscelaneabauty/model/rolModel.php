<?php
class rolModel{
    private $conn; 
    private $table = "rol"; 

    public function __construct($db)
    {
        $this->conn = $db; 
    }

    public function insertRol($nombrerol)
    {
        $query = "INSERT INTO " . $this->table . "(nombrerol) VALUES (?)"; 
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$nombrerol]);
    }

    public function getRol($nombrerol = "")
    {
        $query = "SELECT * FROM " . $this->table . " WHERE nombrerol LIKE ?"; 
        $stmt = $this->conn->prepare($query); 
        $stmt->execute(["%" . $nombrerol . "%"]); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    // NUEVO MÉTODO - Obtener rol por ID
    public function obtenerRolPorId($idrol)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE idrol = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$idrol]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function Eliminar($idrolE) {
        $query = "DELETE FROM " . $this->table . " WHERE idrol = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$idrolE]);
    }

    public function actualizar($nombrerol, $idrol)
    {
        $query = "UPDATE " . $this->table . " SET nombrerol = ? WHERE idrol = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$nombrerol, $idrol]);
    }
}