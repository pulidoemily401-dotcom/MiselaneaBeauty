<?php
ini_set('session.cookie_path', '/');
session_start();
require_once '../config/database.php';
$database = new Database();
$conn = $database->getConnection();
define('IMG_PATH', '../photo/');
$stmtCat = $conn->prepare("SELECT idcategoria, nombre FROM categoria ORDER BY nombre");
$stmtCat->execute();
$categorias = $stmtCat->fetchAll(PDO::FETCH_ASSOC);
$buscar = isset($_GET['buscar']) ? trim($_GET['buscar']) : '';
if (isset($_GET['categoria']) && is_numeric($_GET['categoria'])) {
    $stmtProd = $conn->prepare("SELECT p.*, c.nombre as categoria_nombre FROM producto p JOIN categoria c ON p.idcategoria = c.idcategoria WHERE p.idcategoria = :id AND p.nombre LIKE :buscar");
    $stmtProd->bindParam(':id', $_GET['categoria']);
    $stmtProd->bindValue(':buscar', '%' . $buscar . '%');
} else {
    $stmtProd = $conn->prepare("SELECT p.*, c.nombre as categoria_nombre FROM producto p JOIN categoria c ON p.idcategoria = c.idcategoria WHERE p.nombre LIKE :buscar");
    $stmtProd->bindValue(':buscar', '%' . $buscar . '%');
}
$stmtProd->execute();
$productos = $stmtProd->fetchAll(PDO::FETCH_ASSOC);

// Stock de todos los productos para JS
$stmtStock = $conn->prepare("SELECT idproducto, stock FROM producto");
$stmtStock->execute();
$stockDB = [];
while ($row = $stmtStock->fetch(PDO::FETCH_ASSOC)) {
    $stockDB[$row['idproducto']] = (int)$row['stock'];
}
$stockJson = json_encode($stockDB);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - Miscelánea Beauty</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Urbanist:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<header class="navbar">
    <a href="index.php" class="logo">Miscelánea Beauty</a>
    <ul class="nav-links">
        <li><a href="index.php">Inicio</a></li>
        <li><a href="productos.php" class="active">Tienda</a></li>
        <li><a href="nosotros.php">Nosotros</a></li>
        <li><a href="contacto.php">Contacto</a></li>
    </ul>
    <button class="menu-toggle" onclick="toggleMenu()" aria-label="Menú">
        <i class="bi bi-list"></i>
    </button>
    <form class="search-bar" action="productos.php" method="GET">
        <input type="text" name="buscar" placeholder="Buscar productos..." value="<?= htmlspecialchars($buscar) ?>">
        <button type="submit"><i class="bi bi-search"></i></button>
    </form>
    <a href="vistacarrito.php" class="cart-btn">
        <i class="bi bi-cart3"></i> Carrito
        <span class="cart-badge" id="cartBadge"></span>
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

<section class="products-page">
    <h1>Nuestros Productos</h1>
    <p class="products-subtitle">Descubre nuestra selección de productos de belleza</p>
    <div class="products-layout">
        <aside class="categories-sidebar">
            <h3 class="sidebar-title"><i class="bi bi-grid-fill"></i> Categorías</h3>
            <ul class="category-list">
                <li><a href="productos.php" class="category-link <?= !isset($_GET['categoria']) ? 'active' : '' ?>">Todos los productos</a></li>
                <?php foreach ($categorias as $cat): ?>
                <li><a href="productos.php?categoria=<?= $cat['idcategoria'] ?>" class="category-link <?= (isset($_GET['categoria']) && $_GET['categoria'] == $cat['idcategoria']) ? 'active' : '' ?>"><?= htmlspecialchars($cat['nombre']) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </aside>
        <div class="products-main">
            <div class="products-grid">
                <?php if (count($productos) === 0): ?>
                    <p class="no-products">No se encontraron productos<?= $buscar ? ' para "' . htmlspecialchars($buscar) . '"' : '' ?>.</p>
                <?php else: ?>
                    <?php foreach ($productos as $p): ?>
                    <div class="product-card"
                         data-id="<?= $p['idproducto'] ?>"
                         data-nombre="<?= htmlspecialchars($p['nombre'], ENT_QUOTES) ?>"
                         data-precio="<?= $p['precio'] ?>"
                         data-imagen="<?= htmlspecialchars($p['imagen'] ?? '', ENT_QUOTES) ?>"
                         data-stock="<?= (int)$p['stock'] ?>">
                        <button class="btn-fav" onclick="this.classList.toggle('active')"><i class="bi bi-heart-fill"></i></button>
                        <?php if (!empty($p['imagen'])): ?>
                            <img src="<?= IMG_PATH . rawurlencode($p['imagen']) ?>" alt="<?= htmlspecialchars($p['nombre']) ?>" class="product-img" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="product-img-placeholder" style="display:none;"><i class="bi bi-bag-heart"></i></div>
                        <?php else: ?>
                            <div class="product-img-placeholder"><i class="bi bi-bag-heart"></i></div>
                        <?php endif; ?>
                        <div class="product-info">
                            <p class="product-category"><?= htmlspecialchars($p['categoria_nombre']) ?></p>
                            <h3><?= htmlspecialchars($p['nombre']) ?></h3>
                            <p class="product-price">$<?= number_format($p['precio'], 0, ',', '.') ?></p>
                            <?php if ((int)$p['stock'] > 0): ?>
                                <button class="btn-comprar" onclick="agregarDesdeCard(this)">
                                    <i class="bi bi-cart-plus"></i> Agregar al carrito
                                </button>
                            <?php else: ?>
                                <button class="btn-comprar" disabled style="opacity:0.5;cursor:not-allowed;background:#ccc;color:#666;">
                                    <i class="bi bi-x-circle"></i> Sin stock
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
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

<div class="toast-carrito" id="toastCarrito"></div>

<script>
// Stock en tiempo real desde la BD
const STOCK_DB = <?= $stockJson ?>;

function getCarrito() {
    return JSON.parse(localStorage.getItem('carrito_beauty') || '[]');
}
function saveCarrito(c) {
    localStorage.setItem('carrito_beauty', JSON.stringify(c));
}
function actualizarContador() {
    const total = getCarrito().reduce((s, i) => s + i.qty, 0);
    const badge = document.getElementById('cartBadge');
    if (badge) badge.textContent = total > 0 ? total : '';
}

function agregarDesdeCard(btn) {
    const card   = btn.closest('.product-card');
    const id     = parseInt(card.dataset.id);
    const nombre = card.dataset.nombre;
    const precio = parseInt(card.dataset.precio);
    const imagen = card.dataset.imagen;
    // Stock siempre desde STOCK_DB (BD en tiempo real)
    const stock  = STOCK_DB[id] !== undefined ? STOCK_DB[id] : 0;

    const c   = getCarrito();
    const idx = c.findIndex(i => i.idproducto === id);
    const qtyActual = idx > -1 ? c[idx].qty : 0;

    if (qtyActual >= stock) {
        mostrarToast('⚠ Stock insuficiente. Solo hay ' + stock + ' unidades disponibles.');
        return;
    }

    if (idx > -1) {
        c[idx].qty++;
        c[idx].stock = stock; // actualizar stock en localStorage también
    } else {
        c.push({ idproducto: id, nombre, precio, imagen, stock, qty: 1 });
    }
    saveCarrito(c);
    actualizarContador();

    const orig = btn.innerHTML;
    btn.innerHTML = '<i class="bi bi-check-lg"></i> ¡Agregado!';
    btn.style.background = '#9ecb97';
    setTimeout(() => { btn.innerHTML = orig; btn.style.background = ''; }, 1500);
    mostrarToast('✓ Producto agregado al carrito');
}

let toastTimer;
function mostrarToast(msg) {
    const t = document.getElementById('toastCarrito');
    if (!t) return;
    t.textContent = msg;
    t.classList.add('show');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => t.classList.remove('show'), 2500);
}

function toggleDropdown() {
    document.getElementById('userDropdown')?.classList.toggle('show');
}
function toggleMenu() {
    document.querySelector('.nav-links')?.classList.toggle('open');
}
document.addEventListener('click', function(e) {
    const menu = document.querySelector('.user-menu');
    if (menu && !menu.contains(e.target)) {
        document.getElementById('userDropdown')?.classList.remove('show');
    }
});

actualizarContador();
</script>
</body>
</html>