<?php
require_once "./model/idtipodocuModel.php";
require_once "./config/database.php";

class idtipodocuController
{
    private $db;
    private $idtipodocuModel;


    public function __construct()
    {
        $database = new Database();
        $this->db =$database->getConnection();
        $this->idtipodocuModel = new IdtipodocuModel($this->db);
    }
    public function insertIdtipodocu()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            
            $documento = $_POST["documento"];
            
            
          

            $this->idtipodocuModel->insertIdtipodocu($documento);
            
        }
    }

   


     public function listTipoDocum(){
       $documento = $_GET ["documento"] ??  ""; 
        return $this->idtipodocuModeñ->getTipoDocum($documento); 
    }
}