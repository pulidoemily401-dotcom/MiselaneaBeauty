<?php
require_once "./model/salidaModel.php";
require_once "./model/productoModel.php";
require_once "./config/database.php";

class SalidaController
{
    private $db;
    private $salidaModel;
    private $productoModel;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->salidaModel = new SalidaModel($this->db);
        $this->productoModel = new ProductoModel($this->db);
    }

    public function insertSalida()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $idproducto  = $_POST["idproducto"];
            $fechasalida = $_POST["fechasalida"];
            $cantidad    = $_POST["cantidad"];

            $stockActual = $this->productoModel->obtenerStock($idproducto);

            if ($stockActual >= $cantidad) {
                $this->salidaModel->insertSalida($idproducto, $fechasalida, $cantidad);
                $this->productoModel->actualizarStock($idproducto, $cantidad, 'salida');

                $_SESSION['mensaje_ok'] = 'Salida registrada exitosamente';
                header("Location: index.php?action=listsalida");
                exit;
            } else {
                $_SESSION['mensaje_error'] = 'Stock insuficiente. Stock disponible: ' . $stockActual;
                header("Location: index.php?action=insertSalida");
                exit;
            }
        }
    }

    public function listsalida()
    {
        $fechasalida = $_GET["fechasalida"] ?? "";
        return $this->salidaModel->getSalida($fechasalida);
    }

    public function getSalidaById($idsalida)
    {
        return $this->salidaModel->getSalidaPorId($idsalida);
    }

    public function Eliminar()
    {
        $idsalida = $_POST["idsalida"] ?? "";

        $salida = $this->salidaModel->getSalidaPorId($idsalida);

        if ($salida) {
            $this->salidaModel->Eliminar($idsalida);
           
        } else {
            $_SESSION['mensaje_error'] = 'No se encontró la salida a eliminar';
        }

        header("Location: index.php?action=listsalida");
        exit;
    }

    public function actualizar()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $idsalida    = $_POST["idsalida"];
            $idproducto  = $_POST["idproducto"];
            $fechasalida = $_POST["fechasalida"];
            $cantidad    = $_POST["cantidad"];

            $salidaAnterior = $this->salidaModel->getSalidaPorId($idsalida);

            if ($salidaAnterior) {
                // 1. Revertir la salida anterior (devolver stock)
                $this->productoModel->actualizarStock($salidaAnterior['idproducto'], $salidaAnterior['cantidad'], 'entrada');

                // 2. Verificar stock disponible para la nueva cantidad
                $stockActual = $this->productoModel->obtenerStock($idproducto);

                if ($stockActual >= $cantidad) {
                    // 3. Actualizar el registro
                    $this->salidaModel->actualizar($idproducto, $fechasalida, $cantidad, $idsalida);

                    // 4. Aplicar nueva salida de stock
                    $this->productoModel->actualizarStock($idproducto, $cantidad, 'salida');

                    $_SESSION['mensaje_ok'] = 'Salida actualizada exitosamente';
                } else {
                    
                    $this->productoModel->actualizarStock($salidaAnterior['idproducto'], $salidaAnterior['cantidad'], 'salida');
                    $_SESSION['mensaje_error'] = 'Stock insuficiente. Stock disponible: ' . $stockActual;
                }
            } else {
                $_SESSION['mensaje_error'] = 'No se encontró la salida a actualizar';
            }

            header("Location: index.php?action=listsalida");
            exit;
        }
    }
}