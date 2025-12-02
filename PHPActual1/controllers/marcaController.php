<?php
require_once "./model/marcaModel.php";
require_once "./config/database.php";

class marcaController
{
    private $db;
    private $marcaModel;


    public function __construct()
    {
        $database = new Database();
        $this->db =$database->getConnection();
        $this->marcaModel = new marcaModel($this->db);
    }
    public function insertMarca()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            
            $marca = $_POST["marca"];
          
            
          

            $this->marcaModel->insertMarca($marca);
            
        }
    }

     public function listMarca(){
       $marca = $_GET ["marca"] ??  ""; 
        return $this->marcaModel->getMarca($marca); 
    }
}