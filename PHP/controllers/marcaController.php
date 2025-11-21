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
        $this->db =$database->getConnection();
        $this->marcaModel = new marcaModel($this->db);
    }
    public function insertMarca()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            
            $nombrecompleto = $_POST["nombrecomple"];
          
            
          

            $this->usuarioModel->insertUsuario($nombrecompleto,$correoelectronic ,$telefono,$numerodocumen,
           $tipogenero,$contra,$rol, $idtipo);
            
        }
    }
}