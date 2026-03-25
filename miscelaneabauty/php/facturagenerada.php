<?php
ini_set('session.cookie_path', '/');
session_start();
if (!isset($_SESSION['ultima_factura'])) {
    header('Location: productos.php');
    exit;
}
$f = $_SESSION['ultima_factura'];
unset($_SESSION['ultima_factura']);
$totalItemsCarrito = isset($_SESSION['carrito']) ? array_sum(array_column($_SESSION['carrito'], 'cantidad')) : 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Factura #<?= $f['idfactura'] ?> – Miscelánea Beauty</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Urbanist:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/factura.css">

</head>
<body>
<header class="navbar">
    <a href="index.php" class="logo"><i class=""></i> Miscelánea Beauty</a>
    <ul class="nav-links">
        
        <li><a href="index.php">Inicio</a></li>
        <li><a href="productos.php">Tienda</a></li>
        <li><a href="nosotros.php">Nosotros</a></li>
        <li><a href="contacto.php">Contacto</a></li>
    </ul>
    <form class="search-bar" action="productos.php" method="GET">
        <input type="text" name="buscar" placeholder="Buscar productos...">
        <button type="submit"><i class="bi bi-search"></i></button>
    </form>
    <a href="vistacarrito.php" class="cart-btn">
        <i class="bi bi-cart3"></i> Carrito
        <span class="cart-badge"><?= $totalItemsCarrito > 0 ? $totalItemsCarrito : '' ?></span>
    </a>
    <?php if (isset($_SESSION['nombrecompleto'])): ?>
        <div class="user-menu">
            <button class="user-menu-btn" onclick="toggleDropdown()">
                <i class="bi bi-person-fill"></i>
                <?= htmlspecialchars(explode(' ', $_SESSION['nombrecompleto'])[0]) ?>
                <i class="bi bi-chevron-down" style="font-size:.75rem;"></i>
            </button>
            <div class="user-dropdown" id="userDropdown">
                <div class="dropdown-header">Mi cuenta</div>
                <a href="../index.php?action=actualizarusuario"><i class="bi bi-pencil-fill"></i> Actualizar mis datos</a>
                <a href="../index.php?action=misFacturas"><i class="bi bi-receipt"></i> Mis facturas</a>
                <hr class="dropdown-divider">
                <a href="./index.php?action=logout" class="logout-link"><i class="bi bi-box-arrow-right"></i> Cerrar Sesión</a>
            </div>
        </div>
    <?php else: ?>
        <a href="../index.php?action=login" class="btn-login"><i class="bi bi-person"></i> Iniciar Sesión</a>
    <?php endif; ?>
</header>

<div class="factura-section">
    <div class="exito-badge"><i class="bi bi-check-circle-fill"></i> ¡Compra realizada con éxito!</div>
    <div class="factura-box">
        <div class="factura-top">
            <div>
                <h2>Factura de Venta</h2>
                <p style="color:#888;font-size:.9rem;margin:0;">Miscelánea Beauty</p>
            </div>
            <div style="text-align:right;">
                <p class="factura-num"># <?= str_pad($f['idfactura'], 6, '0', STR_PAD_LEFT) ?></p>
                <p class="factura-fecha"><?= $f['fecha'] ?></p>
            </div>
        </div>
        <div class="factura-cliente">
            <p><strong>Cliente:</strong> <?= htmlspecialchars($f['cliente']) ?></p>
            <p><strong>Documento:</strong> <?= number_format($f['documento'], 0, ',', '.') ?></p>
        </div>
        <table class="factura-tabla">
            <thead>
                <tr><th>Producto</th><th>Precio unit.</th><th>Cantidad</th><th>Subtotal</th></tr>
            </thead>
            <tbody>
                <?php foreach ($f['items'] as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['nombre']) ?></td>
                    <td>$<?= number_format($item['precio'], 0, ',', '.') ?></td>
                    <td><?= $item['cantidad'] ?></td>
                    <td>$<?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="factura-totales">
            <div class="linea"><span>Subtotal</span><span>$<?= number_format($f['subtotal'], 0, ',', '.') ?></span></div>
         
            <div class="total-final"><span>Total pagado</span><span>$<?= number_format($f['total'], 0, ',', '.') ?></span></div>
        </div>
        <div class="factura-acciones">
            <a href="productos.php" class="btn-accion verde"><i class="bi bi-bag-heart"></i> Seguir comprando</a>
            <button onclick="window.print()" class="btn-accion"><i class="bi bi-printer-fill"></i> Imprimir factura</button>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="footer-content">
        <div class="footer-col"><h4>Miscelánea Beauty</h4><p>Tu forma de cuidarte, es nuestra forma de amarte 💚</p></div>
        <div class="footer-col">
            <h4>Enlaces</h4>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="productos.php">Tienda</a></li>
                <li><a href="nosotros.php">Nosotros</a></li>
                <li><a href="contacto.php">Contacto</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <?php if (isset($_SESSION['nombrecompleto'])): ?>
                <h4>Mi cuenta</h4>
                <ul>
                    <li><a href="../index.php?action=actualizarusuario"><i class="bi bi-pencil-fill"></i> Actualizar mis datos</a></li>
                     <i class="bi bi-arrow-return-left"></i> Mis devoluciones
</a>
                    <li><a href="../index.php?action=misFacturas"><i class="bi bi-receipt"></i> Mis facturas</a></li>
                    <li><a href="../index.php?action=logout" style="color:#dc2626;"><i class="bi bi-box-arrow-right"></i> Cerrar sesión</a></li>
                </ul>
            <?php else: ?>
                <h4>Contacto</h4>
                <p>Tel: 3203748195</p>
                <p>Ibagué - Tolima, Colombia</p>
                <p>Email: info@miscelaneabeauty.com</p>
            <?php endif; ?>
        </div>
    </div>
    <div class="footer-bottom"><p>© 2026 Miscelánea Beauty. Todos los derechos reservados.</p></div>
</footer>

<script>
function toggleDropdown() { document.getElementById('userDropdown').classList.toggle('show'); }
document.addEventListener('click', function(e) {
    const menu = document.querySelector('.user-menu');
    if (menu && !menu.contains(e.target)) document.getElementById('userDropdown')?.classList.remove('show');
});

// Menú hamburguesa
function toggleMenu() {
    document.querySelector('.nav-links').classList.toggle('open');
}
</script>
</body>
</html>