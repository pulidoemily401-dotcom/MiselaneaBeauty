<?php
class facturaModel{
    private $conn; 
    private $table = "factura"; 

    public function __construct($db)
    {
        $this->conn = $db; 
    }

    public function insertFactura($fechayhora, $numerodocumen)
    {
        $query = "INSERT INTO " . $this->table . "(fechayhora, numerodocumen) VALUES (?,?)"; 
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$fechayhora, $numerodocumen]);
    }

    public function getFactura($numerodocumen)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE numerodocumen LIKE ?"; 
        $stmt = $this->conn->prepare($query); 
        $stmt->execute(["%" . $numerodocumen . "%"]); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function getFacturaById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE idfactura = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ✅ NUEVO: Verifica si la factura tiene detalles asociados
    public function tieneDetalles($idfactura)
    {
        $query = "SELECT COUNT(*) FROM detallefactura WHERE idfactura = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$idfactura]);
        return $stmt->fetchColumn() > 0;
    }

    public function Eliminar($idfacturaE) 
    {
        $query = "DELETE FROM " . $this->table . " WHERE idfactura = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$idfacturaE]);
    }

    public function actualizar($fechayhora, $numerodocumen, $idfactura)
    {
        $query = "UPDATE " . $this->table . " SET fechayhora=?, numerodocumen=? WHERE idfactura=?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$fechayhora, $numerodocumen, $idfactura]);
    }
}