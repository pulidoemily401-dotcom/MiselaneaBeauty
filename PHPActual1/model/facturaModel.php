<?php
class facturaModel{
    private $conn; 
    private $table = "factura"; 


    public function __construct($db)
    {
        $this->conn = $db; 
    }

    public function insertFactura($fechayhora, $numerodocumen, $totalfactura)
{
    $query = "INSERT INTO " . $this->table . "(fechayhora, numerodocumen, totalfactura) VALUES (?,?,?)" ; 

    $stmt = $this->conn->prepare($query);
    $stmt->execute ([$fechayhora, $numerodocumen, $totalfactura]);
}



 public function getFactura($numerodocumen)
 {
   $query = "SELECT * FROM " . $this->table  . " WHERE numerodocumen LIKE ? "; 
   $stmt = $this->conn->prepare($query); 
   $stmt->execute(["%" . $numerodocumen . "%"]); 
   return $stmt->fetchAll(PDO::FETCH_ASSOC); 
 }
}