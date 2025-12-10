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



 public function getProducto($nombre)
 {
   $query = "SELECT * FROM " . $this->table  . " WHERE nombre LIKE ? "; 
   $stmt = $this->conn->prepare($query); 
   $stmt->execute(["%" . $nombre . "%"]); 
   return $stmt->fetchAll(PDO::FETCH_ASSOC); 
 }

}