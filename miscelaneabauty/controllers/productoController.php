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
            $nombre = $_POST["nombre"];
            $descripcion = $_POST["descripcion"];
            $idcategoria = $_POST["idcategoria"];
            $stock = $_POST["stock"];
            $fechaingreso = $_POST["fechaingreso"];
            $idmarca = $_POST["idmarca"];
            
            $imagen = $_FILES["imagen"]["name"];   
            $target_dir = "photo/";              
            $target_file = $target_dir . $imagen;  

            move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file);

            $this->productoModel->insertProducto($precio, $nombre, $descripcion,
                $imagen, $idcategoria, $stock, $fechaingreso, $idmarca);
        }
    }

    public function listProducto()
    {
        $nombre = $_GET ["nombre"] ??  ""; 
        return $this->productoModel->getProducto($nombre); 
    }

    public function Eliminar()
    {
        $idproducto  = $_POST["idproducto"] ?? "";
        $productoEliminar = $this->productoModel->Eliminar($idproducto);
        return $this->productoModel->Eliminar($idproducto);
    }

    // ✅ AGREGA ESTE MÉTODO NUEVO
    public function obtenerProductoParaActualizar()
    {
        $idproducto = $_GET['idproducto'] ?? null;
        
        if (!$idproducto) {
            return null;
        }
        
        return $this->productoModel->obtenerProductoPorId($idproducto);
    }

    public function actualizar()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") { 
            $precio = $_POST["precio"];
            $nombre = $_POST["nombre"];
            $descripcion = $_POST["descripcion"];
            $idcategoria = $_POST["idcategoria"];
            $stock = $_POST["stock"];
            $fechaingreso = $_POST["fechaingreso"];
            $idmarca = $_POST["idmarca"];
            $idproducto = $_POST["idproducto"];

            // Verificar si se subió una nueva imagen
            if (!empty($_FILES["imagen"]["name"])) {
                $photo = $_FILES["imagen"]["name"];
                $target_dir = "photo/";
                $target_file = $target_dir . basename($photo);
                
                if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
                    // Opcional: eliminar imagen anterior
                    if (!empty($_POST["imagen_actual"]) && file_exists("photo/" . $_POST["imagen_actual"])) {
                        unlink("photo/" . $_POST["imagen_actual"]);
                    }
                }
            } else {
                // Mantener la imagen actual
                $photo = $_POST["imagen_actual"];
            }

            $this->productoModel->actualizar($precio, $nombre, $descripcion,
                $photo, $idcategoria, $stock, $fechaingreso, $idmarca, $idproducto);
        }
    }
}