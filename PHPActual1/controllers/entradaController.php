<?php
require_once "./model/entradaModel.php";
require_once "./config/database.php";

class entradaController
{
    private $db;
    private $entradaModel;


    public function __construct()
    {
        session_start();
        $database = new Database();
        $this->db =$database->getConnection();
        $this->entradaModel = new EntradaModel($this->db);
    }



    public function insertEntrada()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            
            $idproducto= $_POST["idproducto"];
            $numerodocumen = $_POST["numerodocumen"];
            $cantidad = $_POST["cantidad"];
            $fechaentrada  = $_POST["fechaentrada"];
            
             
            $this->entradaModel->insertEntrada($idproducto, $numerodocumen, $cantidad, $fechaentrada);
            
        }
    }

    public function listentrada()
    {
        $numerodocumen = $_GET ["numerodocumen"] ??  ""; 
        return $this->entradaModel->getEntrada($numerodocumen); 
    }
}