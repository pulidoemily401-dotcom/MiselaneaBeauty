<?php
require_once "./model/usuarioModel.php";
require_once "./config/database.php";

class usuarioController
{
    private $db;
    private $usuarioModel;


    public function __construct()
    {
        $database = new Database();
        $this->db =$database->getConnection();
        $this->usuarioModel = new UsuarioModel($this->db);
    }
    public function insertUsuario()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            
            $nombrecompleto = $_POST["nombrecompleto"];
            $correoelectronic  = $_POST["email"];
            $telefono = $_POST["telefono"];
            $numerodocumen = $_POST["numero_documento"];
            $tipogenero = $_POST["tipo_genero"];
             $contra= $_POST["password"];
            $rol = $_POST["rol"];
             $idtipo = $_POST["tipo_documento"];
            
          

            $this->usuarioModel->insertUsuario($nombrecompleto,$correoelectronic ,$telefono,$numerodocumen,
           $tipogenero,$contra,$rol, $idtipo);
            
        }
    }

    
    public function listUsuario()
    {
        $numerodocumen = $_GET ["numerodocumen"] ??  ""; 
        return $this->usuarioModel->getUsuario($numerodocumen); 
    }


  
}