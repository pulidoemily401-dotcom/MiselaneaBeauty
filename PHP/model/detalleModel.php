<?php
class detalleModel{
    private $conn; 
    private $table = "detallefactura"; 


    public function __construct($db)
    {
        $this->conn = $db; 
    }

    public function insertDetalle( $cantidad, $preciouni, $valortotalcadapro)
{
    $query = "INSERT INTO " . $this->table . "(cantidad, preciouni, valortotalcadapro) VALUES (?,?,?)" ; 

    $stmt = $this->conn->prepare($query);
    $stmt->execute ([$cantidad, $preciouni, $valortotalcadapro]);
}
}