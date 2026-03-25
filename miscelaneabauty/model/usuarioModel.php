<?php
class usuarioModel{
    private $conn; 
    private $table = "usuario"; 

    public function __construct($db)
    {
        $this->conn = $db; 
    }

    public function insertUsuario($nombrecompleto,$correoelectronic,$telefono,
           $tipogenero,$contra,$idrol,$idtipo,$numerodocumen)
    {
        $query = "INSERT INTO " . $this->table . "(nombrecompleto,correoelectronic,telefono,
               tipogenero,contra,idrol,idtipo,numerodocumen) VALUES (?,?,?,?,?,?,?,?)" ; 

        $stmt = $this->conn->prepare($query);
        $stmt->execute([$nombrecompleto,$correoelectronic,$telefono,
               $tipogenero,$contra,$idrol,$idtipo,$numerodocumen]);
    }

    public function getUsuariosConDetalles($numerodocumen = "")
{

    if (!empty($numerodocumen)) {
        $query = "SELECT u.*, r.nombrerol, t.documento
                  FROM " . $this->table . " u
                  INNER JOIN rol r ON u.idrol = r.idrol
                  INNER JOIN idtipodocu t ON u.idtipo = t.idtipo
                  WHERE u.numerodocumen = ?";  
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$numerodocumen]);  
    } else {
     
        $query = "SELECT u.*, r.nombrerol, t.documento
                  FROM " . $this->table . " u
                  INNER JOIN rol r ON u.idrol = r.idrol
                  INNER JOIN idtipodocu t ON u.idtipo = t.idtipo
                  ORDER BY u.nombrecompleto ASC";
                  
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    public function getUsuario($numerodocumen)
    {
       $query = "SELECT * FROM " . $this->table  . " WHERE numerodocumen LIKE ? "; 
       $stmt = $this->conn->prepare($query); 
       $stmt->execute(["%" . $numerodocumen . "%"]); 
       return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function Eliminar($numerodocumenE) {
        $query = "DELETE FROM " . $this->table . " WHERE numerodocumen = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$numerodocumenE]);
    }

    public function tieneFacturas($numerodocumen) {
        $sql = "SELECT COUNT(*) FROM factura WHERE numerodocumen = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$numerodocumen]);
        return $stmt->fetchColumn() > 0;
    }

public function actualizar($nombrecompleto, $correoelectronic, $telefono,
       $tipogenero, $contra, $idrol, $idtipo, $numerodocumen)
{
    if (!empty($contra)) {
        // Si viene contraseña, actualizarla también
        $query = "UPDATE " . $this->table . " SET nombrecompleto=?, correoelectronic=?, 
                  telefono=?, tipogenero=?, contra=?, idrol=?, idtipo=?
                  WHERE numerodocumen=?";
        $params = [$nombrecompleto, $correoelectronic, $telefono,
                   $tipogenero, $contra, $idrol, $idtipo, $numerodocumen];
    } else {
        // Si NO viene contraseña, NO tocarla
        $query = "UPDATE " . $this->table . " SET nombrecompleto=?, correoelectronic=?, 
                  telefono=?, tipogenero=?, idrol=?, idtipo=?
                  WHERE numerodocumen=?";
        $params = [$nombrecompleto, $correoelectronic, $telefono,
                   $tipogenero, $idrol, $idtipo, $numerodocumen];
    }

    $stmt = $this->conn->prepare($query);
    return $stmt->execute($params);
}


    public function buscarPorEmail($email) {
        $query = "SELECT * FROM " . $this->table . " WHERE correoelectronic = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Guardar token de recuperación
    public function guardarTokenRecuperacion($email, $token, $expira) {
        $query = "UPDATE " . $this->table . " SET reset_token = ?, token_expira = ? WHERE correoelectronic = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$token, $expira, $email]);
    }

    // Verificar si el token es válido
   public function verificarToken($token) {
    $query = "SELECT * FROM " . $this->table . " WHERE reset_token = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$token]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

    
    public function actualizarPassword($token, $nuevaPassword) {
       
        $usuario = $this->verificarToken($token);
        
        if(!$usuario) {
            return false;
        }
        
        $query = "UPDATE " . $this->table . " SET contra = ?, reset_token = NULL, token_expira = NULL WHERE reset_token = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$nuevaPassword, $token]);
    }

 

    public function login1($correoelectronic, $contra)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE correoelectronic = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$correoelectronic]); 
        $user = $stmt->fetch(PDO::FETCH_ASSOC); 

        if ($user && $contra === $user["contra"]) { 
            return $user;
        }

        return false;
    }

    public function listUsuariosPorRol($idrol)
{
    $query = "SELECT * FROM usuario WHERE idrol = ?";
    $stmt  = $this->conn->prepare($query);
    $stmt->execute([$idrol]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}