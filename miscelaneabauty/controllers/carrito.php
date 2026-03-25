<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_path', '/');
    session_start();
}
require_once __DIR__ . '/../config/database.php';
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}
$accion     = $_POST['accion'] ?? $_GET['accion'] ?? '';
$idproducto = isset($_POST['idproducto']) ? (int)$_POST['idproducto'] : 0;
$database = new Database();
$pdo      = $database->getConnection();
switch ($accion) {
    case 'agregar':
        $stmt = $pdo->prepare("SELECT idproducto, nombre, precio, stock, imagen FROM producto WHERE idproducto = ?");
        $stmt->execute([$idproducto]);
        $producto = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$producto) {
            echo json_encode(['ok' => false, 'msg' => 'Producto no encontrado']);
            exit;
        }
        $carrito = &$_SESSION['carrito'];
        if (isset($carrito[$idproducto])) {
            if ($carrito[$idproducto]['cantidad'] >= $producto['stock']) {
                echo json_encode(['ok' => false, 'msg' => 'Stock insuficiente']);
                exit;
            }
            $carrito[$idproducto]['cantidad']++;
        } else {
            if ($producto['stock'] <= 0) {
                echo json_encode(['ok' => false, 'msg' => 'Producto sin stock']);
                exit;
            }
            $carrito[$idproducto] = [
                'idproducto' => $producto['idproducto'],
                'nombre'     => $producto['nombre'],
                'precio'     => $producto['precio'],
                'imagen'     => $producto['imagen'],
                'cantidad'   => 1,
                'stock'      => $producto['stock'],
            ];
        }
        $carrito[$idproducto]['subtotal'] = $carrito[$idproducto]['precio'] * $carrito[$idproducto]['cantidad'];
        echo json_encode([
            'ok'      => true,
            'msg'     => 'Producto agregado',
            'carrito' => resumenCarrito(),
        ]);
        break;
    case 'restar':
        if (isset($_SESSION['carrito'][$idproducto])) {
            $_SESSION['carrito'][$idproducto]['cantidad']--;
            if ($_SESSION['carrito'][$idproducto]['cantidad'] <= 0) {
                unset($_SESSION['carrito'][$idproducto]);
            } else {
                $_SESSION['carrito'][$idproducto]['subtotal'] =
                    $_SESSION['carrito'][$idproducto]['precio'] * $_SESSION['carrito'][$idproducto]['cantidad'];
            }
        }
        echo json_encode(['ok' => true, 'carrito' => resumenCarrito()]);
        break;
    case 'eliminar':
        unset($_SESSION['carrito'][$idproducto]);
        echo json_encode(['ok' => true, 'carrito' => resumenCarrito()]);
        break;
    case 'vaciar':
        $_SESSION['carrito'] = [];
        echo json_encode(['ok' => true, 'carrito' => resumenCarrito()]);
        break;
    case 'resumen':
        echo json_encode(['ok' => true, 'carrito' => resumenCarrito()]);
        break;
    default:
        echo json_encode(['ok' => false, 'msg' => 'Acción no válida']);
        break;
}
function resumenCarrito(): array {
    $items      = array_values($_SESSION['carrito']);
    $subtotal   = array_sum(array_column($items, 'subtotal'));
    $total      = $subtotal;
    $totalItems = array_sum(array_column($items, 'cantidad'));
    return [
        'items'      => $items,
        'subtotal'   => $subtotal,
        'iva'        => 0,
        'total'      => $total,
        'totalItems' => $totalItems,
    ];
}