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


public function getCategoria($nombre = "")
{
    $sql = "SELECT * FROM categoria WHERE nombre LIKE ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(["%$nombre%"]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function obtenerCategoriaPorId($idcategoria)
{
    $query = "SELECT * FROM categoria WHERE idcategoria = ?";
    
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$idcategoria]);
    
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function Eliminar($idcategoriaE ) {
    $query = "DELETE  FROM " . $this->table . " WHERE idcategoria  = ?";
    $stmt = $this->conn->prepare($query);
    return $stmt->execute([$idcategoriaE]);
}


 public function actualizar($nombre, $descripcion, $idcategoria)

  {
    $query = " UPDATE " . $this->table . " SET nombre=?, descripcion=? 
   WHERE idcategoria=?";

    $stmt = $this->conn->prepare($query);
    $stmt->execute([$nombre, $descripcion, $idcategoria]);
  }

}