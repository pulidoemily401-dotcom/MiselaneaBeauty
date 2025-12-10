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
    $stmt->execute ([$marca]);
}



public function getMarca($marca)
 {
   $query = "SELECT * FROM " . $this->table  . " WHERE marca LIKE ? "; 
   $stmt = $this->conn->prepare($query); 
   $stmt->execute(["%" . $marca . "%"]); 
   return $stmt->fetchAll(PDO::FETCH_ASSOC); 
 }
}