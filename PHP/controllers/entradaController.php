<?php
require_once "./model/entradaModel.php";
require_once "./config/database.php";

class entradaController
{
    private $db;
    private $entradaModel;


    public function __construct()
    {
        $database = new Database();
        $this->db =$database->getConnection();
        $this->entradaModel = new EntradaModel($this->db);
    }
    public function insertEntrada()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            
            $idproducto= $_POST["idproducto"];
            $idusuario = $_POST["idusuario"];
            $cantidad = $_POST["cantidad"];
            $fechaentrada  = $_POST["fechaentrada"];
            
             
            $this->entradaModel->insertEntrada($idproducto, $idusuario, $cantidad, $fechaentrada);
            
        }
    }
}