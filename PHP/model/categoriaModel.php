<?php
class categoriaModel{
    private $conn; 
    private $table = "categoria"; 


    public function __construct($db)
    {
        $this->conn = $db; 
    }

    public function insertCategoria($nombre, $descripcion)
{
    $query = "INSERT INTO " . $this->table . "(nombre, descripcion) VALUES (?,?)" ; 

    $stmt = $this->conn->prepare($query);
    $stmt->execute ([$nombre, $descripcion]);
}
}