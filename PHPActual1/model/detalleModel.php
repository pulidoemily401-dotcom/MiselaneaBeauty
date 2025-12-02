<?php
class detalleModel{
    private $conn; 
    private $table = "detallefactura"; 


    public function __construct($db)
    {
        $this->conn = $db; 
    }

    public function insertDetalle( $idproducto, $cantidad, $preciouni, $valortotalcadapro)
{
    $query = "INSERT INTO " . $this->table . "(idproducto, cantidad, preciouni, valortotalcadapro) VALUES (?,?,?,?)" ; 

    $stmt = $this->conn->prepare($query);
    $stmt->execute ([$idproducto, $cantidad, $preciouni, $valortotalcadapro]);
}




 public function getDetalle(){
  $query = "SELECT * FROM  " .$this->table; 
     $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
}

}