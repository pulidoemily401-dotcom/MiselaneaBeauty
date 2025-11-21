<?php
class productoModel{
    private $conn; 
    private $table = "producto"; 


    public function __construct($db)
    {
        $this->conn = $db; 
    }

    public function insertProducto($precio ,$cantidad ,$nombre,$descripcion,
           $imagen,$idcategoria,$stock, $fechaingreso, $idmarca)
{
    $query = "INSERT INTO " . $this->table . "(precio ,cantidad ,nombre,descripcion,
           imagen,idcategoria,stock, fechaingreso, idmarca) VALUES (?,?,?,?,?,?,?,?,?)" ; 

    $stmt = $this->conn->prepare($query);
    $stmt->execute ([$precio ,$cantidad ,$nombre,$descripcion,
           $imagen,$idcategoria,$stock, $fechaingreso, $idmarca]);
}
}