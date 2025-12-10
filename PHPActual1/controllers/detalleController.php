<?php
require_once "./model/detalleModel.php";
require_once "./config/database.php";

class detalleController
{
    private $db;
    private $detalleModel;


    public function __construct()
    {
        $database = new Database();
        $this->db =$database->getConnection();
        $this->detalleModel = new DetalleModel($this->db);
    }
    public function insertDetalle()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            
             $idproducto = $_POST["idproducto"];
            $cantidad = $_POST["cantidad"];
            $preciouni = $_POST["preciouni"];
            $valortotalcadapro= $_POST["valortotalcadapro"];
             
            
          

            $this->detalleModel->insertDetalle($idproducto, $cantidad, $preciouni, $valortotalcadapro);
            
        }
    }

        public function listDetalle(){
        return $this->detalleModel->getDetalle(); 
    }
}
