<?php
require_once "./model/rolModel.php";
require_once "./config/database.php";

class rolController
{
    private $db;
    private $rolModel;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->rolModel = new rolModel($this->db);
    }

    public function insertRol()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $nombrerol = $_POST["nombrerol"];
            $this->rolModel->insertRol($nombrerol);
        }
    }

    public function listRol(){
        $nombrerol = $_GET["nombrerol"] ?? ""; 
        return $this->rolModel->getRol($nombrerol); 
    }

    // NUEVO MÉTODO - Obtener rol por ID
    public function obtenerRolPorId($idrol)
    {
        return $this->rolModel->obtenerRolPorId($idrol);
    }

    public function Eliminar()
    {
        $idrol = $_POST["idrol"] ?? "";
        return $this->rolModel->Eliminar($idrol);
    }

    public function actualizar()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") { 
            $nombrerol = $_POST["nombrerol"];
            $idrol = $_POST["idrol"];
            $this->rolModel->actualizar($nombrerol, $idrol);
            
            header("Location: index.php?action=listRol");
            exit();
        }
    }
}