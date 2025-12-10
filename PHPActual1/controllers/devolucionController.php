<?php
require_once "./model/devolucionModel.php";
require_once "./config/database.php";

class devolucionController
{
    private $db;
    private $devolucionModel;


    public function __construct()
    {
        $database = new Database();
        $this->db =$database->getConnection();
        $this->devolucionModel = new DevolucionModel($this->db);
    }
    public function insertDevolucion()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            
           $idproducto = $_POST["idproducto"];
            $cantidad = $_POST["cantidad"];
            $fechaingreso = $_POST["fechaingreso"];
            $idfactura = $_POST["idfactura"];
            $descripcionmotivo  = $_POST["descripcionmotivo"];
            
            
          

            $this->devolucionModel->insertDevolucion($idproducto, $cantidad, $fechaingreso,  $idfactura,  $descripcionmotivo );
            
        }
    }

      public function listDevolu(){
        return $this->devolucionModel->getDevolu(); 
    }


     public function listDevolucion()
    {
        $idfactura = $_POST ["idfactura"] ??  ""; 
        return $this->devolucionModel->getDevolucion($idfactura); 
    }

}