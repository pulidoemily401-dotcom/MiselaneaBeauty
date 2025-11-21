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
            $idusuario = $_POST["idusuario"];
            $totalfactura = $_POST["totalfactura"];
           
            
             
            $this->facturaModel->insertFactura($fechayhora, $idusuario, $totalfactura);
            
        }
    }
}