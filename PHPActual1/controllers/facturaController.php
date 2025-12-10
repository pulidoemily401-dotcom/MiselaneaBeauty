<?php
require_once "./model/facturaModel.php";
require_once "./config/database.php";

class facturaController
{
    private $db;
    private $facturaModel;


    public function __construct()
    {
        $database = new Database();
        $this->db =$database->getConnection();
        $this->facturaModel = new FacturaModel($this->db);
    }
    public function insertFactura()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            
            $fechayhora= $_POST["fechayhora"];
            $numerodocumen = $_POST["numerodocumen"];
            $totalfactura = $_POST["totalfactura"];
           
            
             
            $this->facturaModel->insertFactura($fechayhora, $numerodocumen, $totalfactura);
            
        }
    }

    
    public function listFactura()
    {
        $numerodocumen = $_GET ["numerodocumen"] ??  ""; 
        return $this->facturaModel->getFactura($numerodocumen); 
    }

}