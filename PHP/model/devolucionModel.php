<?php
class devolucionModel{
    private $conn; 
    private $table = "devolucion"; 


    public function __construct($db)
    {
        $this->conn = $db; 
    }

    public function insertDevolucion( $cantidad, $fechaingreso,  $descrpcionmotivo)
{
    $query = "INSERT INTO " . $this->table . "( cantidad, fechaingreso, descrpcionmotivo) VALUES (?,?,?,?)" ; 

    $stmt = $this->conn->prepare($query);
    $stmt->execute ([ $cantidad, $fechaingreso , $descrpcionmotivo]);
}
}