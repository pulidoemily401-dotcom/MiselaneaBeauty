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
            
           
            $cantidad = $_POST["cantidad"];
            $fechaingreso = $_POST["fechaingreso"];
            $descripcionmotivo  = $_POST["descripcionmotivo"];
            
            
          

            $this->devolucionModel->insertDevolucion($cantidad, $fechaingreso, $descripcionmotivo );
            
        }
    }
}