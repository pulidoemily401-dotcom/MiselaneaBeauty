<?php
class usuarioModel{
    private $conn; 
    private $table = "usuario"; 


    public function __construct($db)
    {
        $this->conn = $db; 
    }

    public function insertUsuario($nombrecompleto,$correoelectronic ,$telefono,$numerodocumen,
           $tipogenero,$contra,$rol, $idtipo)
{
    $query = "INSERT INTO " . $this->table . "(nombrecompleto,correoelectronic ,telefono,numerodocumen,
           tipogenero,contra,rol, idtipo) VALUES (?,?,?,?,?,?,?,?)" ; 

    $stmt = $this->conn->prepare($query);
    $stmt->execute ([$nombrecompleto,$correoelectronic ,$telefono,$numerodocumen,
           $tipogenero,$contra,$rol, $idtipo]);
}


 public function getUsuario($numerodocumen)
 {
   $query = "SELECT * FROM " . $this->table  . " WHERE numerodocumen LIKE ? "; 
   $stmt = $this->conn->prepare($query); 
   $stmt->execute(["%" . $numerodocumen . "%"]); 
   return $stmt->fetchAll(PDO::FETCH_ASSOC); 
 }

}