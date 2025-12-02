<?php
require_once "./model/salidaModel.php";
require_once "./config/database.php";

class salidaController
{
    private $db;
    private $salidaModel;


    public function __construct()
    {
        $database = new Database();
        $this->db =$database->getConnection();
        $this->salidaModel = new SalidaModel($this->db);
    }
    public function insertSalida()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            
            $idproducto = $_POST["idproducto"];
            $fechasalida  = $_POST["fechasalida"];
            $cantidad = $_POST["cantidad"];
           
            
          

            $this->salidaModel->insertSalida($idproducto, $fechasalida, $cantidad);
            
        }
    }

     public function listsalida()
    {
        $fechasalida = $_GET ["fechasalida"] ??  ""; 
        return $this->salidaModel->getSalida($fechasalida); 
    }

}