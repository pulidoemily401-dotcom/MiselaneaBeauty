<?php
class detalleModel {
    private $conn;
    private $table = "detallefactura";

    public function __construct($db) {
        $this->conn = $db;
    }

   
    public function insertDetalle($idproducto, $idfactura, $cantidad, $preciouni, $valortotalcadapro) {
        try {
            $query = "INSERT INTO " . $this->table . " (idproducto, idfactura, cantidad, preciouni, valortotalcadapro) 
                      VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            return $stmt->execute([$idproducto, $idfactura, $cantidad, $preciouni, $valortotalcadapro]);
        } catch (PDOException $e) {
            error_log("Error al insertar detalle: " . $e->getMessage());
            return false;
        }
    }

    public function getDetalle() {
        try {
            $query = "SELECT d.*, 
                             p.nombre AS nombreproducto, 
                             f.numerodocumen
                      FROM " . $this->table . " d
                      LEFT JOIN producto p ON d.idproducto = p.idproducto
                      LEFT JOIN factura f ON d.idfactura = f.idfactura
                      ORDER BY d.iddetallefactura DESC";
            $stmt = $this->conn->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al listar detalles: " . $e->getMessage());
            return [];
        }
    }

   
    public function getDetalleByFactura($idfactura) {
        try {
            $query = "SELECT d.*, 
                             p.nombre AS nombreproducto, 
                             f.numerodocumen
                      FROM " . $this->table . " d
                      LEFT JOIN producto p ON d.idproducto = p.idproducto
                      LEFT JOIN factura f ON d.idfactura = f.idfactura
                      WHERE d.idfactura = ?
                      ORDER BY d.iddetallefactura DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$idfactura]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al buscar detalles por factura: " . $e->getMessage());
            return [];
        }
    }

    
    public function getDetalleById($iddetallefactura) {
        try {
            $query = "SELECT * FROM " . $this->table . " WHERE iddetallefactura = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$iddetallefactura]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener detalle por ID: " . $e->getMessage());
            return false;
        }
    }

   
    public function Eliminar($iddetallefactura) {
        try {
            $query = "DELETE FROM " . $this->table . " WHERE iddetallefactura = ?";
            $stmt = $this->conn->prepare($query);
            return $stmt->execute([$iddetallefactura]);
        } catch (PDOException $e) {
            error_log("Error al eliminar detalle: " . $e->getMessage());
            return false;
        }
    }

    
    public function actualizar($idproducto, $idfactura, $cantidad, $preciouni, $valortotalcadapro, $iddetallefactura) {
        try {
            $query = "UPDATE " . $this->table . " 
                      SET idproducto = ?, 
                          idfactura = ?, 
                          cantidad = ?, 
                          preciouni = ?, 
                          valortotalcadapro = ? 
                      WHERE iddetallefactura = ?";
            $stmt = $this->conn->prepare($query);
            return $stmt->execute([$idproducto, $idfactura, $cantidad, $preciouni, $valortotalcadapro, $iddetallefactura]);
        } catch (PDOException $e) {
            error_log("Error al actualizar detalle: " . $e->getMessage());
            return false;
        }
    }
}