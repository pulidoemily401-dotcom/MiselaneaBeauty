<?php
class idtipodocuModel{
    private $conn; 
    private $table = "idtipodocu"; 

    public function __construct($db)
    {
        $this->conn = $db; 
    }

    public function InsertIdtipodocu($documento)
    {
        $query = "INSERT INTO " . $this->table . "(documento) VALUES (?)"; 
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$documento]);
    }

    public function getTipoDocum($documento)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE documento LIKE ?"; 
        $stmt = $this->conn->prepare($query); 
        $stmt->execute(["%" . $documento . "%"]); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function getTipoById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE idtipo = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function Eliminar($idtipo) 
    {
        $query = "DELETE FROM " . $this->table . " WHERE idtipo = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$idtipo]);
    }

    public function actualizar($documento, $idtipo)
    {
        $query = "UPDATE " . $this->table . " SET documento = ? WHERE idtipo = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$documento, $idtipo]);
    }
}