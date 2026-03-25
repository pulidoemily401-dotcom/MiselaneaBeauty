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
        $this->db = $database->getConnection();
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
        $marca = $_GET["marca"] ?? ""; 
        return $this->marcaModel->getMarca($marca); 
    }

    public function obtenerMarcaPorId($idmarca)
    {
        return $this->marcaModel->obtenerMarcaPorId($idmarca);
    }

    public function Eliminar()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $idmarca = $_POST["idmarca"] ?? "";

            // ✅ Verificar si tiene productos asociados
            if ($this->marcaModel->tieneProductos($idmarca)) {
                $_SESSION['mensaje_error'] = "⚠️ No se puede eliminar la marca #" . $idmarca . 
                                             " porque tiene productos asociados. Debe eliminarlos primero.";
                header("Location: index.php?action=listMarca");
                exit();
            }

            if ($this->marcaModel->Eliminar($idmarca)) {
                $_SESSION['mensaje_ok'] = "Marca eliminada exitosamente";
            } else {
                $_SESSION['mensaje_error'] = "Error al eliminar la marca";
            }

            header("Location: index.php?action=listMarca");
            exit();
        }
    }

    public function actualizar()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") { 
            $marca = $_POST["marca"];
            $idmarca = $_POST["idmarca"];
            $this->marcaModel->actualizar($marca, $idmarca);
            
            header("Location: index.php?action=listMarca");
            exit();
        }
    }
}