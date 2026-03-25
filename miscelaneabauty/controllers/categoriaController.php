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
        $this->db = $database->getConnection();
        $this->categoriaModel = new CategoriaModel($this->db);
    }

    public function insertCategoria()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $nombre = $_POST["nombre"];
            $descripcion = $_POST["descripcion"];
            $this->categoriaModel->insertCategoria($nombre, $descripcion);
        }
    }

    public function listCategoria()
    {
        $nombre = $_GET["nombre"] ?? "";
        return $this->categoriaModel->getCategoria($nombre);
    }

    // MÉTODO PARA MOSTRAR EL FORMULARIO DE ACTUALIZACIÓN
    public function mostrarFormularioActualizar()
    {
        $idcategoria = $_GET['id'] ?? null;  // Cambié 'idcategoria' por 'id'
        
        if ($idcategoria) {
           
            $categoria = $this->categoriaModel->obtenerCategoriaPorId($idcategoria);
            
           
            require_once './views/actualizar_categoria.php';
        } else {
          
            header("Location: index.php?action=dashBoard");
        }
    }
    public function obtenerCategoriaPorId($idcategoria)
{
    return $this->categoriaModel->obtenerCategoriaPorId($idcategoria);
}

    public function Eliminar()
    {
        $idcategoria = $_POST["idcategoria"] ?? "";
        return $this->categoriaModel->Eliminar($idcategoria);
    }

    public function actualizar()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") { 
            $nombre = $_POST["nombre"];
            $descripcion = $_POST["descripcion"];
            $idcategoria = $_POST["idcategoria"];
            
            $this->categoriaModel->actualizar($nombre, $descripcion, $idcategoria);
            
     
            header("Location: index.php?action=dashBoard");
        }
    }
}