<?php
require_once "./model/detalleModel.php";
require_once "./config/database.php";

class detalleController {
    private $db;
    private $detalleModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->detalleModel = new DetalleModel($this->db);
    }

   
    public function insertDetalle() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $idproducto        = $_POST["idproducto"];
            $idfactura         = $_POST["idfactura"];
            $cantidad          = $_POST["cantidad"];
            $preciouni         = $_POST["preciouni"];
            $valortotalcadapro = $_POST["valortotalcadapro"];

            $this->detalleModel->insertDetalle($idproducto, $idfactura, $cantidad, $preciouni, $valortotalcadapro);
            
            $_SESSION['mensaje_ok'] = 'Detalle de factura registrado exitosamente';
        }
    }

    
    public function listDetalle() {
        // Verificar si hay un filtro por ID de factura
        if (isset($_GET['idfactura']) && !empty($_GET['idfactura'])) {
            $idfactura = trim($_GET['idfactura']);
            return $this->detalleModel->getDetalleByFactura($idfactura);
        } else {
            // Si no hay filtro, mostrar todos
            return $this->detalleModel->getDetalle();
        }
    }

    
    public function listDetalleByFactura($idfactura) {
        return $this->detalleModel->getDetalleByFactura($idfactura);
    }

    
    public function getDetalleById($id) {
        return $this->detalleModel->getDetalleById($id);
    }

    public function Eliminar() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $iddetallefactura = $_POST["iddetallefactura"] ?? "";
            
            if ($this->detalleModel->Eliminar($iddetallefactura)) {
                $_SESSION['mensaje_ok'] = 'Detalle eliminado exitosamente';
            } else {
                $_SESSION['mensaje_error'] = 'Error al eliminar el detalle';
            }
        }
        return true;
    }

    
    public function actualizar() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $idproducto        = $_POST["idproducto"];
            $idfactura         = $_POST["idfactura"];
            $cantidad          = $_POST["cantidad"];
            $preciouni         = $_POST["preciouni"];
            $valortotalcadapro = $_POST["valortotalcadapro"];
            $iddetallefactura  = $_POST["iddetallefactura"];

            $this->detalleModel->actualizar($idproducto, $idfactura, $cantidad, $preciouni, $valortotalcadapro, $iddetallefactura);
            
            $_SESSION['mensaje_ok'] = 'Detalle actualizado exitosamente';
        }
    }
}