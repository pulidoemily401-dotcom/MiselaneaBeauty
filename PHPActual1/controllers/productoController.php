<?php
require_once "./model/productoModel.php";
require_once "./config/database.php";

class productoController
{
    private $db;
    private $productoModel;


    public function __construct()
    {
        $database = new Database();
        $this->db =$database->getConnection();
        $this->productoModel = new ProductoModel($this->db);
    }
    public function insertProducto()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            
            $precio = $_POST["precio"];
            $cantidad  = $_POST["cantidad"];
            $nombre = $_POST["nombre"];
            $descripcion = $_POST["descripcion"];
            $idcategoria = $_POST["idcategoria"];
             $stock= $_POST["stock"];
            $fechaingreso = $_POST["fechaingreso"];
             $idmarca = $_POST["idmarca"];
            
             $imagen = $_FILES["imagen"]["name"];   
$target_dir = "photo/";              
$target_file = $target_dir . $imagen;  

move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file);






            $this->productoModel->insertProducto($precio ,$cantidad ,$nombre,$descripcion,
           $imagen,$idcategoria,$stock, $fechaingreso, $idmarca);
            
        }
    }

    public function listProducto()
    {
        $nombre = $_GET ["nombre"] ??  ""; 
        return $this->productoModel->getProducto($nombre); 
    }

}