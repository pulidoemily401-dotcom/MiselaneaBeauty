<?php
class idtipodocuModel{
    private $conn; 
    private $table = "idtipodocu"; 


    public function __construct($db)
    {
        $this->conn = $db; 
    }

    public function insertIdtipodocu($documento)
{
    $query = "INSERT INTO " . $this->table . "(documento) VALUES (?)" ; 

    $stmt = $this->conn->prepare($query);
    $stmt->execute ([$documento]);
}
}