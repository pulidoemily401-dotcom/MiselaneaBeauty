<?php
ini_set('session.cookie_path', '/');
session_start();
require_once '../config/database.php';

$database = new Database();
$pdo      = $database->getConnection();

// Verificar sesión
if (!isset($_SESSION['numerodocumen'])) {
    header('Location: ../php/index.php?action=login');
    exit;
}

// Solo POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../php/vistacarrito.php');
    exit;
}

// Leer carrito desde JSON enviado por el formulario
$carritoJson = $_POST['carrito_json'] ?? '';
$carrito = json_decode($carritoJson, true);

if (empty($carrito)) {
    $_SESSION['error'] = 'El carrito está vacío.';
    header('Location: ../php/vistacarrito.php');
    exit;
}

$numerodocumen  = (int)$_SESSION['numerodocumen'];
$nombrecompleto = $_SESSION['nombrecompleto'] ?? 'Cliente';
$metodopago     = $_POST['metodopago'] ?? 'No especificado';

try {
    $pdo->beginTransaction();

    // ── 1. VERIFICAR STOCK ────────────────────────────────────────
    foreach ($carrito as $item) {
        $idproducto = (int)($item['idproducto'] ?? 0);
        $cantidad   = (int)($item['qty'] ?? 1);

        $stmt = $pdo->prepare("SELECT stock, nombre FROM producto WHERE idproducto = ?");
        $stmt->execute([$idproducto]);
        $prod = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$prod || $prod['stock'] < $cantidad) {
            throw new Exception("Stock insuficiente para: " . ($item['nombre'] ?? 'producto'));
        }
    }

    // ── 2. INSERTAR FACTURA ───────────────────────────────────────
    $stmtFactura = $pdo->prepare(
        "INSERT INTO factura (fechayhora, numerodocumen) VALUES (NOW(), ?)"
    );
    $stmtFactura->execute([$numerodocumen]);
    $idfactura = $pdo->lastInsertId();

    // ── 3. DETALLE + STOCK + SALIDA ───────────────────────────────
    $stmtDetalle = $pdo->prepare("
        INSERT INTO detallefactura (idfactura, idproducto, cantidad, preciouni, valortotalcadapro)
        VALUES (?, ?, ?, ?, ?)
    ");
    $stmtStock = $pdo->prepare("
        UPDATE producto SET stock = stock - ? WHERE idproducto = ?
    ");
    $stmtSalida = $pdo->prepare("
        INSERT INTO salida (idproducto, fechasalida, cantidad)
        VALUES (?, CURDATE(), ?)
    ");

    $productosTexto = [];
    $subtotal = 0;

    foreach ($carrito as $item) {
        $idproducto = (int)($item['idproducto'] ?? 0);
        $cantidad   = (int)($item['qty'] ?? 1);
        $precio     = (float)($item['precio'] ?? 0);
        $subtotalItem = $precio * $cantidad;
        $subtotal    += $subtotalItem;

        $stmtDetalle->execute([$idfactura, $idproducto, $cantidad, $precio, $subtotalItem]);
        $stmtStock->execute([$cantidad, $idproducto]);
        $stmtSalida->execute([$idproducto, $cantidad]);

        $productosTexto[] = ($item['nombre'] ?? 'Producto') . ' x' . $cantidad;
    }

    // ── 4. GUARDAR NOTIFICACIÓN ───────────────────────────────────
    $iva   = 0;
    $total = $subtotal;

    $stmtNoti = $pdo->prepare("
        INSERT INTO notificacion (idfactura, cliente, numerodocumen, total, metodopago, productos)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $stmtNoti->execute([
        $idfactura,
        $nombrecompleto,
        $numerodocumen,
        $total,
        $metodopago,
        implode(', ', $productosTexto)
    ]);

    $pdo->commit();

    // ── 5. GUARDAR DATOS PARA MOSTRAR LA FACTURA ─────────────────
    $_SESSION['ultima_factura'] = [
        'idfactura' => $idfactura,
        'fecha'     => date('d/m/Y H:i:s'),
        'cliente'   => $nombrecompleto,
        'documento' => $numerodocumen,
        'items'     => array_map(function($item) {
            return [
                'nombre'   => $item['nombre'] ?? '',
                'cantidad' => (int)($item['qty'] ?? 1),
                'precio'   => (float)($item['precio'] ?? 0),
                'subtotal' => (float)($item['precio'] ?? 0) * (int)($item['qty'] ?? 1),
            ];
        }, $carrito),
        'subtotal'  => $subtotal,
        'iva'       => 0,
        'total'     => $subtotal,
    ];

    header('Location: ../php/facturagenerada.php');
    exit;

} catch (Exception $e) {
    $pdo->rollBack();
    $_SESSION['error'] = $e->getMessage();
    header('Location: ../php/vistacarrito.php');
    exit;
}