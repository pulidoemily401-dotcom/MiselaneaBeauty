<?php
ini_set('session.cookie_path', '/');
session_start();
$totalItemsCarrito = isset($_SESSION['carrito']) ? array_sum(array_column($_SESSION['carrito'], 'cantidad')) : 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nosotros - Miscelánea Beauty</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Urbanist:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/styles.css">

</head>
<body>
<header class="navbar">
    <a href="index.php" class="logo"><i class=""></i> Miscelánea Beauty</a>
    <ul class="nav-links">
        <li><a href="index.php">Inicio</a></li>
        <li><a href="productos.php">Tienda</a></li>
        <li><a href="nosotros.php" class="active">Nosotros</a></li>
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
                <a href="../index.php?action=misDevolucion">
    <i class="bi bi-arrow-return-left"></i> Mis devoluciones
</a>
                <a href="../index.php?action=misFacturas"><i class="bi bi-receipt"></i> Mis facturas</a>
                <hr class="dropdown-divider">
                <a href="./index.php?action=logout" class="logout-link"><i class="bi bi-box-arrow-right"></i> Cerrar Sesión</a>
            </div>
        </div>
    <?php else: ?>
        <a href="../index.php?action=login" class="btn-login"><i class="bi bi-person"></i> Iniciar Sesión</a>
    <?php endif; ?>
</header>

<section class="about-page">
    <div class="about-hero">
        <h1>Sobre Nosotros</h1>
        <p>En Miscelánea Beauty nos dedicamos a ofrecerte los mejores productos de belleza y cuidado personal.</p>
    </div>
    <div class="about-content">
        <div class="about-grid">
            <div class="about-card">
                <i class="bi bi-heart-fill"></i>
                <h3>Nuestra Misión</h3>
                <p>Ofrecer productos originales de marcas reconocidas en belleza y cuidado personal, brindando buen servicio y precios accesibles para nuestros clientes.</p>
            </div>
            <div class="about-card">
                <i class="bi bi-eye-fill"></i>
                <h3>Nuestra Visión</h3>
                <p>Consolidarnos como una miscelánea de belleza líder en Ibagué, reconocidos por nuestra calidad y servicio excepcional.</p>
            </div>
        </div>
        <h2 class="values-title">Nuestros Valores</h2>
        <div class="values-grid">
            <div class="value-item"><i class="bi bi-heart-fill"></i><h4>Compromiso</h4></div>
            <div class="value-item"><i class="bi bi-star-fill"></i><h4>Calidad</h4></div>
            <div class="value-item"><i class="bi bi-people-fill"></i><h4>Servicio</h4></div>
            <div class="value-item"><i class="bi bi-shield-check"></i><h4>Honestidad</h4></div>
        </div>
    </div>
</section>

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
                    <li><a href="../index.php?action=misFacturas"><i class="bi bi-receipt"></i> Mis facturas</a></li>
                    <li><a href="./index.php?action=logout" style="color:#dc2626;"><i class="bi bi-box-arrow-right"></i> Cerrar sesión</a></li>
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