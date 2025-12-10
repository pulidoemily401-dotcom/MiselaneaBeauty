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
}