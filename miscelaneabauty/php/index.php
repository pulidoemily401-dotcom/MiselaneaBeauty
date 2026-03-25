<?php
ini_set('session.cookie_path', '/');
session_start();
require_once '../config/database.php';
$database = new Database();
$conn = $database->getConnection();

$stmt = $conn->prepare("SELECT nombre, descripcion FROM categoria");
$stmt->execute();
$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmtTop = $conn->prepare("
    SELECT p.nombre, p.precio, p.imagen, p.idproducto AS id,
           SUM(df.cantidad) as total_vendido
    FROM producto p
    JOIN detallefactura df ON df.idproducto = p.idproducto
    GROUP BY p.idproducto
    ORDER BY total_vendido DESC
    LIMIT 8
");
$stmtTop->execute();
$topProductos = $stmtTop->fetchAll(PDO::FETCH_ASSOC);

$totalItemsCarrito = 0;
if (isset($_SESSION['carrito'])) {
    $totalItemsCarrito = array_sum(array_column($_SESSION['carrito'], 'cantidad'));
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Miscelánea Beauty</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Urbanist:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/marcas-topventas.css">
</head>
<body>

<header class="navbar">
    <a href="index.php" class="logo">Miscelánea Beauty</a>
    <ul class="nav-links">
        <li><a href="index.php" class="active">Inicio</a></li>
        <li><a href="productos.php">Tienda</a></li>
        <li><a href="nosotros.php">Nosotros</a></li>
        <li><a href="contacto.php">Contacto</a></li>
    </ul>
    <button class="menu-toggle" onclick="toggleMenu()" aria-label="Menú">
        <i class="bi bi-list"></i>
    </button>
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
                <a href="../index.php?action=misDevolucion"><i class="bi bi-arrow-return-left"></i> Mis devoluciones</a>
                <a href="../index.php?action=misFacturas"><i class="bi bi-receipt"></i> Mis facturas</a>
                <hr class="dropdown-divider">
                <a href="../index.php?action=logout" class="logout-link"><i class="bi bi-box-arrow-right"></i> Cerrar Sesión</a>
            </div>
        </div>
    <?php else: ?>
        <a href="../index.php?action=login" class="btn-login"><i class="bi bi-person"></i> Iniciar Sesión</a>
    <?php endif; ?>
</header>

<section class="carousel-section">
    <div class="carousel">
        <button class="carousel-btn prev" onclick="moverSlide(-1)"><i class="bi bi-chevron-left"></i></button>
        <button class="carousel-btn next" onclick="moverSlide(1)"><i class="bi bi-chevron-right"></i></button>
        <div class="slides">
            <div class="slide" style="background: linear-gradient(135deg, #fdf6ee 0%, #f5e6d0 100%);">
                <div class="slide-content">
                    <div class="slide-text">
                        <h2>Perfumes & Fragancias</h2>
                        <p>Aromas memorables, duraderos e ingredientes de alta calidad</p>
                        <a href="productos.php" class="slide-btn">¡Ver todos!</a>
                    </div>
                    <div class="slide-img"><img src="../img/nuevaimg.png" alt="Perfumes Yanbal"></div>
                </div>
            </div>
            <div class="slide" style="background: linear-gradient(135deg, #eef5ee 0%, #d0e8d5 100%);">
                <div class="slide-content">
                    <div class="slide-text">
                        <h2>Cuidado Corporal Natural</h2>
                        <p>Lociones, aceites y cremas hidratantes con ingredientes naturales</p>
                        <a href="productos.php" class="slide-btn" style="background:#4a7c59;">¡Descubrir!</a>
                    </div>
                    <div class="slide-img"><img src="../img/otro.png" alt="Cuidado Corporal Natura"></div>
                </div>
            </div>
            <div class="slide" style="background: linear-gradient(135deg, #fce8f0 0%, #f5c6d8 100%);">
                <div class="slide-content">
                    <div class="slide-text">
                        <h2>Cuidado Capilar</h2>
                        <p>Shampoos, acondicionadores y tratamientos para un cabello fuerte y brillante</p>
                        <a href="productos.php" class="slide-btn" style="background:#c2185b;">¡Explorar!</a>
                    </div>
                    <div class="slide-img"><img src="../img/uu.png" alt="Maquillaje Esika"></div>
                </div>
            </div>
            <div class="slide" style="background: linear-gradient(135deg, #eaf0fb 0%, #c8d8f5 100%);">
                <div class="slide-content">
                    <div class="slide-text">
                        <h2>Cuidado Facial</h2>
                        <p>Cremas, sérums y tratamientos para una piel radiante y saludable</p>
                        <a href="productos.php" class="slide-btn" style="background:#1a4fa0;">¡Ver más!</a>
                    </div>
                    <div class="slide-img"><img src="../img/rr.png" alt="Cuidado Facial Avon"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="dots">
        <div class="dot active" onclick="irASlide(0)"></div>
        <div class="dot" onclick="irASlide(1)"></div>
        <div class="dot" onclick="irASlide(2)"></div>
        <div class="dot" onclick="irASlide(3)"></div>
    </div>
</section>

<section class="marcas-nueva">
    <div class="marcas-header">
        <h2>Nuestras Marcas</h2>
        <p>Contamos con soluciones para cada una de las necesidades de tu piel</p>
    </div>
    <div class="marcas-cards-grid">
        <div class="marca-big-card marca-yanbal">
            <img src="../img/yanbaln.png" alt="Yanbal" class="marca-bg-img">
            <div class="marca-overlay"></div>
            <span class="marca-nombre">YANBAL</span>
        </div>
        <div class="marca-big-card marca-natura">
            <img src="../img/naturaa.jpg" alt="Natura" class="marca-bg-img">
            <div class="marca-overlay"></div>
            <span class="marca-nombre">NATURA</span>
        </div>
        <div class="marca-big-card marca-esika">
            <img src="../img/esikaa.webp" alt="Ésika" class="marca-bg-img">
            <div class="marca-overlay"></div>
            <span class="marca-nombre">ÉSIKA</span>
        </div>
        <div class="marca-big-card marca-avon">
            <img src="../img/avonn.jpg" alt="Avon" class="marca-bg-img">
            <div class="marca-overlay"></div>
            <span class="marca-nombre">AVON</span>
        </div>
    </div>
</section>

<section class="top-ventas">
    <div class="tv-header">
        <span class="tv-badge"><i class="bi bi-fire"></i> Lo más vendido</span>
        <h2>Top de Ventas</h2>
        <p>Los favoritos de nuestras clientas este mes</p>
    </div>
    <div class="tv-grid">
        <?php if (!empty($topProductos)): ?>
            <?php foreach ($topProductos as $rank => $prod): ?>
                <div class="tv-card">
                    <div class="tv-rank rank-<?= $rank + 1 ?>">#<?= $rank + 1 ?></div>
                    <div class="tv-img-wrap">
                        <img src="../photo/<?= rawurlencode($prod['imagen'] ?? '') ?>" alt="<?= htmlspecialchars($prod['nombre']) ?>">
                    </div>
                    <div class="tv-info">
                        <h4><?= htmlspecialchars($prod['nombre']) ?></h4>
                        <span class="tv-price">$<?= number_format($prod['precio'], 0, ',', '.') ?></span>
                        <span class="tv-sold"><i class="bi bi-bag-check-fill"></i> <?= $prod['total_vendido'] ?> vendidos</span>
                    </div>
                    <a href="productos.php?id=<?= $prod['id'] ?>" class="tv-btn">Ver producto</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align:center; color:#888; padding:2rem;">Aún no hay productos vendidos.</p>
        <?php endif; ?>
    </div>
    <div class="tv-footer">
        <a href="productos.php" class="tv-ver-mas">Ver todos los productos <i class="bi bi-arrow-right"></i></a>
    </div>
</section>

<section class="hero">
    <div>
        <h1>Resalta tu belleza natural</h1>
        <p>Descubre productos únicos de Yanbal, Natura, Ésika y Avon diseñados para cuidar tu piel y realzar tu esencia.</p>
        <div class="hero-buttons">
            <a href="productos.php" class="btn-primary">Comprar Ahora</a>
            <a href="nosotros.php" class="btn-outline">Conócenos</a>
        </div>
    </div>
</section>

<section class="categories">
    <h2>Nuestras Categorías</h2>
    <div class="categories-grid">
        <?php
        $iconos = ['bi-droplet-fill','bi-flower2','bi-bag-heart-fill','bi-brush-fill','bi-sun-fill','bi-stars'];
        foreach ($categorias as $i => $cat): ?>
            <div class="category-card">
                <i class="bi <?= $iconos[$i % count($iconos)] ?>"></i>
                <h3><?= htmlspecialchars($cat['nombre']) ?></h3>
                <p><?= htmlspecialchars($cat['descripcion'] ?? '') ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<footer class="footer">
    <div class="footer-content">
        <div class="footer-col"><h4>Miscelánea Beauty</h4><p>Tu forma de cuidarte, es nuestra forma de amarte 💚</p></div>
        <div class="footer-col">
            <h4>Enlaces</h4>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="productos.php">Tienda Online</a></li>
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
                    <li><a href="../index.php?action=logout" style="color:#dc2626;"><i class="bi bi-box-arrow-right"></i> Cerrar sesión</a></li>
                </ul>
            <?php else: ?>
                <h4>Contacto</h4>
                <p>Tel: 3203748195</p>
                <p>Email: info@miscelaneabeauty.com</p>
            <?php endif; ?>
        </div>
    </div>
    <div class="footer-bottom"><p>© 2026 Miscelánea Beauty. Todos los derechos reservados.</p></div>
</footer>

<script src="../js/carrusel.js"></script>
<script src="../js/marcas-topventas.js"></script>
<script src="../js/main.js"></script>
</body>
</html>