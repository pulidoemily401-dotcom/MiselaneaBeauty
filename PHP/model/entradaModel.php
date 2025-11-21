<?php
class entradaModel{
    private $conn; 
    private $table = "entrada"; 


    public function __construct($db)
    {
        $this->conn = $db; 
    }

    public function insertEntrada($idproducto, $idusuario, $cantidad, $fechaentrada)
{
    $query = "INSERT INTO " . $this->table . "(idproducto, idusuario, cantidad, fechaentrada) VALUES (?,?,?,?)" ; 

    $stmt = $this->conn->prepare($query);
    $stmt->execute ([$idproducto, $idusuario, $cantidad, $fechaentrada]);
}
}