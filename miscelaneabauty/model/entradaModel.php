<?php
class EntradaModel
{
    private $conn;
    private $table = "entrada";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function insertEntrada($idproducto, $numerodocumen, $cantidad, $fechaentrada)
    {
        $query = "INSERT INTO " . $this->table . " (idproducto, numerodocumen, cantidad, fechaentrada) VALUES (?,?,?,?)";
        $stmt  = $this->conn->prepare($query);
        $stmt->execute([$idproducto, $numerodocumen, $cantidad, $fechaentrada]);
    }

    public function getEntrada($numerodocumen)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE numerodocumen LIKE ?";
        $stmt  = $this->conn->prepare($query);
        $stmt->execute(["%" . $numerodocumen . "%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEntradaPorId($identrada)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE identrada = ?";
        $stmt  = $this->conn->prepare($query);
        $stmt->execute([$identrada]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function Eliminar($identrada)
    {
        $query = "DELETE FROM " . $this->table . " WHERE identrada = ?";
        $stmt  = $this->conn->prepare($query);
        return $stmt->execute([$identrada]);
    }

    public function actualizar($idproducto, $numerodocumen, $cantidad, $fechaentrada, $identrada)
    {
        $query = "UPDATE " . $this->table . " SET idproducto=?, numerodocumen=?, cantidad=?, fechaentrada=? WHERE identrada=?";
        $stmt  = $this->conn->prepare($query);
        $stmt->execute([$idproducto, $numerodocumen, $cantidad, $fechaentrada, $identrada]);
    }
}