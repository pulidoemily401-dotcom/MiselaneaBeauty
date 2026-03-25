<?php
require_once "./model/idtipodocuModel.php";
require_once "./config/database.php";

class IdtipodocuController
{
    private $db;
    private $idtipodocuModel;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->idtipodocuModel = new IdtipodocuModel($this->db);
    }
    
    public function insertIdtipodocu()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $documento = $_POST["documento"];
            
            if($this->idtipodocuModel->insertIdtipodocu($documento)){
                $_SESSION['mensaje_ok'] = "Tipo de documento creado exitosamente";
            } else {
                $_SESSION['mensaje_error'] = "Error al crear el tipo de documento";
            }
        }
    }

    public function listTipoDocum(){
        $documento = $_GET["documento"] ?? ""; 
        return $this->idtipodocuModel->getTipoDocum($documento); 
    }

    public function getTipoById($id){
        return $this->idtipodocuModel->getTipoById($id);
    }

    public function Eliminar()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $idtipo = $_POST["idtipo"] ?? "";
            
            if($this->idtipodocuModel->Eliminar($idtipo)){
                $_SESSION['mensaje_ok'] = "Tipo de documento eliminado exitosamente";
            } else {
                $_SESSION['mensaje_error'] = "Error al eliminar el tipo de documento";
            }
        }
    }

    public function actualizar()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") { 
            $documento = $_POST["documento"];
            $idtipo = $_POST["idtipo"];
            
            if($this->idtipodocuModel->actualizar($documento, $idtipo)){
                $_SESSION['mensaje_ok'] = "Tipo de documento actualizado exitosamente";
            } else {
                $_SESSION['mensaje_error'] = "Error al actualizar el tipo de documento";
            }
        }
    }
}