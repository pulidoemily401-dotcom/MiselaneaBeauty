<?php
class devolucionModel{
    private $conn; 
    private $table = "devolucion"; 


    public function __construct($db)
    {
        $this->conn = $db; 
    }

    public function insertDevolucion( $idproducto, $cantidad, $fechaingreso,  $idfactura, $descripcionmotivo)
{
    $query = "INSERT INTO " . $this->table . "( idproducto, cantidad, fechaingreso,  idfactura, descripcionmotivo) VALUES (?,?,?,?,?)" ; 

    $stmt = $this->conn->prepare($query);
    $stmt->execute ([ $idproducto, $cantidad, $fechaingreso ,  $idfactura,  $descripcionmotivo]);
}

public function getDevolu(){
    $query = "SELECT * FROM  " .$this->table; 
    $stmt = $this->conn->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
}

 public function getDevolucion($idfactura)
 {
   $query = "SELECT * FROM " . $this->table  . " WHERE idfactura = ? "; 
   $stmt = $this->conn->prepare($query); 
   $stmt->execute([ $idfactura]); 
   return $stmt->fetchAll(PDO::FETCH_ASSOC); 
 }
}