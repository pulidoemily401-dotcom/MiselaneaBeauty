<?php
require_once "./model/entradaModel.php";
require_once "./model/productoModel.php";
require_once "./config/database.php";

class EntradaController
{
    private $db;
    private $entradaModel;
    private $productoModel;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->entradaModel = new EntradaModel($this->db);
        $this->productoModel = new ProductoModel($this->db);
    }

    public function insertEntrada()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $idproducto    = $_POST["idproducto"];
            $numerodocumen = $_POST["numerodocumen"];
            $cantidad      = $_POST["cantidad"];
            $fechaentrada  = $_POST["fechaentrada"];

            // 1. Insertar el registro de entrada
            $this->entradaModel->insertEntrada($idproducto, $numerodocumen, $cantidad, $fechaentrada);

            // 2. Actualizar el stock del producto (SUMAR)
            $this->productoModel->actualizarStock($idproducto, $cantidad, 'entrada');

            $_SESSION['mensaje_ok'] = 'Entrada registrada exitosamente';
            header("Location: index.php?action=listentrada");
            exit;
        }
    }

    public function listentrada()
    {
        $numerodocumen = $_GET["numerodocumen"] ?? "";
        return $this->entradaModel->getEntrada($numerodocumen);
    }

    public function Eliminar()
    {
        $identrada = $_POST["identrada"] ?? "";

        // Obtener la entrada antes de eliminar para revertir stock
        $entrada = $this->entradaModel->getEntradaPorId($identrada);

        if ($entrada) {
            $this->entradaModel->Eliminar($identrada);
        } else {
            $_SESSION['mensaje_error'] = 'No se encontró la entrada a eliminar';
        }

        header("Location: index.php?action=listentrada");
        exit;
    }

    public function actualizar()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $identrada     = $_POST["identrada"];
            $idproducto    = $_POST["idproducto"];
            $numerodocumen = $_POST["numerodocumen"];
            $cantidad      = $_POST["cantidad"];
            $fechaentrada  = $_POST["fechaentrada"];

            // Obtener datos anteriores para revertir stock
            $entradaAnterior = $this->entradaModel->getEntradaPorId($identrada);

            if ($entradaAnterior) {
           
                $this->productoModel->actualizarStock($entradaAnterior['idproducto'], $entradaAnterior['cantidad'], 'salida');

                $this->entradaModel->actualizar($idproducto, $numerodocumen, $cantidad, $fechaentrada, $identrada);

                $this->productoModel->actualizarStock($idproducto, $cantidad, 'entrada');

                $_SESSION['mensaje_ok'] = 'Entrada actualizada exitosamente';
            } else {
                $_SESSION['mensaje_error'] = 'No se encontró la entrada a actualizar';
            }

            header("Location: index.php?action=listentrada");
            exit;
        }
    }

    public function getEntradaById($identrada)
    {
        return $this->entradaModel->getEntradaPorId($identrada);
    }
}