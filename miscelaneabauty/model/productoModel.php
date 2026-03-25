<?php
class productoModel{
    private $conn; 
    private $table = "producto"; 


    public function __construct($db)
    {
        $this->conn = $db; 
    }

    public function insertProducto($precio, $nombre, $descripcion,
           $imagen, $idcategoria, $stock, $fechaingreso, $idmarca)
    {
        $query = "INSERT INTO " . $this->table . "(precio, nombre, descripcion,
               imagen, idcategoria, stock, fechaingreso, idmarca) VALUES (?,?,?,?,?,?,?,?)" ; 

        $stmt = $this->conn->prepare($query);
        $stmt->execute ([$precio, $nombre, $descripcion,
               $imagen, $idcategoria, $stock, $fechaingreso, $idmarca]);
    }

    public function getProducto($nombre)
    {
       $query = "SELECT 
                    p.*, 
                    c.nombre AS nombre_categoria, 
                    m.marca AS nombre_marca
                 FROM producto p
                 JOIN categoria c ON p.idcategoria = c.idcategoria
                 JOIN marca m ON p.idmarca = m.idmarca
                 WHERE p.nombre LIKE ?";

       $stmt = $this->conn->prepare($query);
       $stmt->execute(["%" . $nombre . "%"]);

       return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Eliminar($idproductoE) {
        $query = "DELETE  FROM " . $this->table . " WHERE idproducto  = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$idproductoE]);
    }

    public function actualizar($precio, $nombre, $descripcion,
               $photo, $idcategoria, $stock, $fechaingreso, $idmarca, $idproducto)
    {
        $query = "UPDATE " . $this->table . " 
                  SET precio=?, nombre=?, descripcion=?, imagen=?, idcategoria=?, stock=?, fechaingreso=?, idmarca=?
                  WHERE idproducto=?";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([$precio, $nombre, $descripcion,
               $photo, $idcategoria, $stock, $fechaingreso, $idmarca, $idproducto]);
    }

  public function obtenerProductoPorId($idproducto)
{
    $query = "SELECT 
                p.*, 
                c.nombre AS nombre_categoria, 
                m.marca AS nombre_marca
              FROM producto p
              JOIN categoria c ON p.idcategoria = c.idcategoria
              JOIN marca m ON p.idmarca = m.idmarca
              WHERE p.idproducto = ?";
    
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$idproducto]);
    
    return $stmt->fetch(PDO::FETCH_ASSOC); // fetch() para UN solo registro
}
    public function actualizarStock($idproducto, $cantidad, $tipo)
    {
        if ($tipo == 'entrada') {
            
            $query = "UPDATE " . $this->table . " SET stock = stock + ? WHERE idproducto = ?";
        } else {
            
            $query = "UPDATE " . $this->table . " SET stock = stock - ? WHERE idproducto = ?";
        }

        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$cantidad, $idproducto]);
    }

    
    public function obtenerStock($idproducto)
    {
        $query = "SELECT stock FROM " . $this->table . " WHERE idproducto = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$idproducto]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado ? $resultado['stock'] : 0;
    }
}