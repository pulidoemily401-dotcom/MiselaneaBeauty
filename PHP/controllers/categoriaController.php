<?php
require_once "./model/categoriaModel.php";
require_once "./config/database.php";

class categoriaController
{
    private $db;
    private $categoriaModel;


    public function __construct()
    {
        $database = new Database();
        $this->db =$database->getConnection();
        $this->categoriaModel = new CategoriaModel($this->db);
    }
    public function insertCategoria()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            
            $nombre= $_POST["nombre"];
            $descripcion  = $_POST["descripcion"];
            
             
            
          

            $this->categoriaModel->insertCategoria($nombre, $descripcion);
            
        }
    }
}