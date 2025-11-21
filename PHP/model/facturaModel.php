<?php
class facturaModel{
    private $conn; 
    private $table = "factura"; 


    public function __construct($db)
    {
        $this->conn = $db; 
    }

    public function insertFactura($fechayhora, $idusuario, $totalfactura)
{
    $query = "INSERT INTO " . $this->table . "(fechayhora, idusuario, totalfactura) VALUES (?,?,?)" ; 

    $stmt = $this->conn->prepare($query);
    $stmt->execute ([$fechayhora, $idusuario, $totalfactura]);
}
}