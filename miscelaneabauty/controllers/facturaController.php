<?php
require_once "./model/facturaModel.php";
require_once "./config/database.php";

class facturaController
{
    private $db;
    private $facturaModel;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->facturaModel = new FacturaModel($this->db);
    }

    public function listFactura()
    {
        $numerodocumen = $_GET["idusuario"] ?? "";
        return $this->facturaModel->getFactura($numerodocumen);
    }

    public function getFacturaById($id)
    {
        
        return $this->facturaModel->getFacturaById($id);
    }

    public function insertFactura()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fechayhora = $_POST["fechayhora"] ?? date('Y-m-d H:i:s');
            $numerodocumen = $_POST["numerodocumen"];
           
            
            if($this->facturaModel->insertFactura($fechayhora, $numerodocumen)){
                $_SESSION['mensaje_ok'] = "Factura creada exitosamente";
            } else {
                $_SESSION['mensaje_error'] = "Error al crear la factura";
            }
        }
    }

    public function actualizar()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fechayhora = $_POST["fechayhora"];
            $numerodocumen = $_POST["numerodocumen"];
           
            $idfactura = $_POST["idfactura"];
            
            if($this->facturaModel->actualizar($fechayhora, $numerodocumen, $idfactura)){
                $_SESSION['mensaje_ok'] = "Factura actualizada exitosamente";
                return true;
            } else {
                $_SESSION['mensaje_error'] = "Error al actualizar la factura";
                return false;
            }
        }
    }

   
   
   public function listFacturaByUsuario($numerodocumen) {
    return $this->facturaModel->getFactura($numerodocumen);
}

   public function Eliminar()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $idfactura = $_POST["idfactura"] ?? "";

       
        if ($this->facturaModel->tieneDetalles($idfactura)) {
            $_SESSION['mensaje_error'] = "⚠️ No se puede eliminar la factura #" . $idfactura . 
                                         " porque tiene detalles asociados. Debe eliminarlos primero.";
            header("Location: index.php?action=listFactura");
            exit();
        }

        if ($this->facturaModel->Eliminar($idfactura)) {
            $_SESSION['mensaje_ok'] = "Factura eliminada exitosamente";
        } else {
            $_SESSION['mensaje_error'] = "Error al eliminar la factura";
        }

        header("Location: index.php?action=listFactura");
        exit();
    }
}
}