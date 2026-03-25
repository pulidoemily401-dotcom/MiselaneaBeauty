<?php
require_once "./model/devolucionModel.php";
require_once "./config/database.php";

class devolucionController {
    private $db;
    private $devolucionModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->devolucionModel = new DevolucionModel($this->db);
    }

 public function insertDevolucion() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $idproducto        = $_POST["idproducto"];
        $cantidad          = $_POST["cantidad"];
        $fechaingreso      = $_POST["fechaingreso"];
        $idfactura         = $_POST["idfactura"];
        $descripcionmotivo = $_POST["descripcionmotivo"];

        $this->devolucionModel->insertDevolucion($idproducto, $cantidad, $fechaingreso, $idfactura, $descripcionmotivo);

        // Sumar stock al producto devuelto
        $stmt = $this->db->prepare("UPDATE producto SET stock = stock + ? WHERE idproducto = ?");
        $stmt->execute([$cantidad, $idproducto]);
    }
}

   
    public function listDevolu() {
        return $this->devolucionModel->getDevolucion();
    }

    public function listDevolucionByUsuario($numerodocumen) {
    return $this->devolucionModel->getDevolucionByUsuario($numerodocumen);
}

    
    public function listDevolucionByFactura($idfactura) {
        return $this->devolucionModel->getDevolucionByFactura($idfactura);
    }

   
    public function getDevolucionById($id) {
        return $this->devolucionModel->getDevolucionById($id);
    }

   
    public function Eliminar() {
        $iddevolucion = $_POST["iddevolucion"] ?? "";
        return $this->devolucionModel->Eliminar($iddevolucion);
    }

  
    public function actualizar() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $idproducto        = $_POST["idproducto"];
            $cantidad          = $_POST["cantidad"];
            $fechaingreso      = $_POST["fechaingreso"];
            $idfactura         = $_POST["idfactura"];
            $descripcionmotivo = $_POST["descripcionmotivo"];
            $iddevolucion      = $_POST["iddevolucion"];

            $this->devolucionModel->actualizar($idproducto, $cantidad, $fechaingreso, $idfactura, $descripcionmotivo, $iddevolucion);
        }
    }
}