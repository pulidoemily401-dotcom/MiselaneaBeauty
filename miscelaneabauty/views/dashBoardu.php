<?php
if (!isset($_SESSION["idrol"]) || $_SESSION["idrol"] != 3) {
    header("Location: index.php");
    exit();
}

require_once "./config/database.php";
$database = new Database();
$conn = $database->getConnection();

$stmtCat = $conn->prepare("SELECT idcategoria, nombre FROM categoria ORDER BY nombre");
$stmtCat->execute();
$categorias = $stmtCat->fetchAll(PDO::FETCH_ASSOC);

$buscar  = $_GET['buscar']   ?? '';
$catFilt = $_GET['categoria'] ?? '';

if ($catFilt && is_numeric($catFilt)) {
    $stmtProd = $conn->prepare("SELECT p.*, c.nombre AS cat_nombre FROM producto p JOIN categoria c ON p.idcategoria=c.idcategoria WHERE p.idcategoria=:id AND p.nombre LIKE :b");
    $stmtProd->bindParam(':id', $catFilt);
    $stmtProd->bindValue(':b', '%'.$buscar.'%');
} else {
    $stmtProd = $conn->prepare("SELECT p.*, c.nombre AS cat_nombre FROM producto p JOIN categoria c ON p.idcategoria=c.idcategoria WHERE p.nombre LIKE :b");
    $stmtProd->bindValue(':b', '%'.$buscar.'%');
}
$stmtProd->execute();
$productos = $stmtProd->fetchAll(PDO::FETCH_ASSOC);

$nombre   = $_SESSION["nombrecompleto"];
$partes   = explode(' ', trim($nombre));

$totalItemsCarrito = 0;
if (isset($_SESSION['carrito'])) {
    $totalItemsCarrito = array_sum(array_column($_SESSION['carrito'], 'cantidad'));
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda | Miscelánea Beauty</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Urbanist:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        .cart-btn { position: relative; display: flex; align-items: center; gap: 0.4rem; background: linear-gradient(135deg, #6abf69, #4caf50); color: white; border-radius: 50px; padding: 0.5rem 1.1rem; text-decoration: none; font-weight: 600; font-size: 0.95rem; transition: opacity 0.2s; }
        .cart-btn:hover { opacity: 0.88; color: white; }
        .cart-badge { background: #dc2626; color: #fff; border-radius: 999px; font-size: 0.72rem; font-weight: 700; min-width: 18px; height: 18px; display: inline-flex; align-items: center; justify-content: center; padding: 0 4px; position: absolute; top: -5px; right: -5px; }
        .store-section { max-width: 1200px; margin: 0 auto; padding: 2rem 1.5rem; }
        .store-top { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.5rem; }
        .store-top h1 { font-family: 'Playfair Display', serif; font-size: 2rem; color: #1a1208; }
        .search-bar-store { display: flex; gap: 0; border: 1.5px solid #d0e8cc; border-radius: 50px; overflow: hidden; background: #fff; }
        .search-bar-store input { border: none; outline: none; padding: 0.55rem 1rem; font-family: 'Urbanist', sans-serif; font-size: 0.9rem; width: 220px; }
        .search-bar-store button { background: #4caf50; border: none; color: white; padding: 0 1rem; cursor: pointer; font-size: 1rem; }
        .cat-filters { display: flex; flex-wrap: wrap; gap: 0.5rem; margin-bottom: 2rem; }
        .cat-btn { background: #fff; border: 1.5px solid #d0e8cc; border-radius: 50px; padding: 0.4rem 1rem; font-size: 0.88rem; font-weight: 500; color: #555; cursor: pointer; text-decoration: none; transition: 0.2s; }
        .cat-btn:hover, .cat-btn.active { background: #4caf50; border-color: #4caf50; color: #fff; }
        .products-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(210px, 1fr)); gap: 1.2rem; }
        .product-card { background: #fff; border: 1px solid #e8f0e6; border-radius: 16px; overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,0.05); transition: transform 0.2s, box-shadow 0.2s; position: relative; }
        .product-card:hover { transform: translateY(-4px); box-shadow: 0 8px 24px rgba(0,0,0,0.1); }
        .btn-fav { position: absolute; top: 10px; right: 10px; background: rgba(255,255,255,0.9); border: none; border-radius: 50%; width: 34px; height: 34px; cursor: pointer; display: flex; align-items: center; justify-content: center; color: #ccc; font-size: 1rem; transition: 0.2s; z-index: 1; }
        .btn-fav.active, .btn-fav:hover { color: #e91e63; }
        .product-img { width: 100%; height: 160px; object-fit: cover; }
        .product-img-placeholder { width: 100%; height: 160px; background: #f0f7ee; display: flex; align-items: center; justify-content: center; font-size: 3rem; color: #a5d6a7; }
        .product-body { padding: 0.9rem 1rem 1rem; }
        .product-cat { font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: #4caf50; margin-bottom: 0.25rem; }
        .product-name { font-weight: 600; font-size: 0.95rem; color: #1a1208; margin-bottom: 0.4rem; line-height: 1.3; }
        .product-price { font-size: 1.1rem; font-weight: 700; color: #2e7d32; margin-bottom: 0.7rem; }
        .btn-comprar { width: 100%; background: linear-gradient(135deg, #6abf69, #4caf50); color: white; border: none; border-radius: 10px; padding: 0.55rem; font-family: 'Urbanist', sans-serif; font-weight: 600; font-size: 0.88rem; cursor: pointer; transition: opacity 0.2s, transform 0.1s; display: flex; align-items: center; justify-content: center; gap: 0.4rem; }
        .btn-comprar:hover { opacity: 0.88; }
        .btn-comprar:active { transform: scale(0.97); }
        .btn-comprar.cargando { opacity: 0.6; pointer-events: none; }
        .welcome-strip { background: linear-gradient(135deg, #c8e6c9, #a5d6a7); border-radius: 14px; padding: 1.2rem 1.8rem; margin-bottom: 2rem; display: flex; align-items: center; justify-content: space-between; }
        .welcome-strip h2 { font-family: 'Playfair Display', serif; font-size: 1.4rem; color: #1b5e20; margin-bottom: 0.2rem; }
        .welcome-strip p  { color: #2e7d32; font-size: 0.9rem; }
        .welcome-strip .wi { font-size: 3rem; color: rgba(255,255,255,0.6); }
        .toast-carrito { position: fixed; bottom: 2rem; right: 2rem; background: #1a1208; color: #fff; padding: 0.75rem 1.3rem; border-radius: 10px; font-size: 0.9rem; font-weight: 500; opacity: 0; transform: translateY(10px); transition: opacity 0.3s, transform 0.3s; pointer-events: none; z-index: 9999; }
        .toast-carrito.show { opacity: 1; transform: translateY(0); }
        .no-products { grid-column: 1/-1; text-align: center; color: #aaa; padding: 3rem; font-size: 1rem; }
    </style>
</head>
<body>

<header class="navbar">
    <a href="index.php?action=dashBoardu" class="logo">
        <i class="bi bi-flower1"></i> Miscelánea Beauty
    </a>
    <ul class="nav-links">
        <li><a href="../php/index.php">Inicio</a></li>
        <li><a href="index.php?action=dashBoardu" class="active">Tienda</a></li>
        <li><a href="../php/nosotros.php">Nosotros</a></li>
        <li><a href="../php/contacto.php">Contacto</a></li>
    </ul>
    <form class="search-bar" action="index.php" method="GET">
        <input type="hidden" name="action" value="dashBoardu">
        <input type="text" name="buscar" placeholder="Buscar productos..." value="<?= htmlspecialchars($buscar) ?>">
        <button type="submit"><i class="bi bi-search"></i></button>
    </form>
    <a href="../php/vistacarrito.php" class="cart-btn">
        <i class="bi bi-cart3"></i> Carrito
        <span class="cart-badge" id="cartBadge"><?= $totalItemsCarrito > 0 ? $totalItemsCarrito : '' ?></span>
    </a>
    <div style="display:flex;align-items:center;gap:1rem;">
        <span style="font-weight:600;color:var(--secondary);font-size:.9rem;">
            <i class="bi bi-person-fill"></i> <?= htmlspecialchars($nombre) ?>
        </span>
        <a href="index.php?action=logout" class="btn-login" style="background:linear-gradient(135deg,#dc2626,#ef4444);">
            <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
        </a>
    </div>
</header>

<div class="store-section">
    <div class="welcome-strip">
        <div>
            <h2>¡Hola, <?= htmlspecialchars($partes[0]) ?>! 🌸</h2>
            <p>Explora nuestros productos y disfruta tu experiencia de compra.</p>
        </div>
        <i class="bi bi-flower1 wi"></i>
    </div>
    <div class="store-top">
        <h1><i class="bi bi-bag-heart-fill" style="color:#4caf50;font-size:1.6rem;"></i> Nuestra Tienda</h1>
        <form class="search-bar-store" action="index.php" method="GET">
            <input type="hidden" name="action" value="dashBoardu">
            <input type="text" name="buscar" placeholder="Buscar productos..." value="<?= htmlspecialchars($buscar) ?>">
            <button type="submit"><i class="bi bi-search"></i></button>
        </form>
    </div>
    <div class="cat-filters">
        <a href="index.php?action=dashBoardu" class="cat-btn <?= !$catFilt ? 'active' : '' ?>">Todos</a>
        <?php foreach ($categorias as $cat): ?>
        <a href="index.php?action=dashBoardu&categoria=<?= $cat['idcategoria'] ?>"
           class="cat-btn <?= $catFilt == $cat['idcategoria'] ? 'active' : '' ?>">
            <?= htmlspecialchars($cat['nombre']) ?>
        </a>
        <?php endforeach; ?>
    </div>
    <div class="products-grid">
        <?php if (empty($productos)): ?>
            <p class="no-products">No se encontraron productos<?= $buscar ? ' para "'.htmlspecialchars($buscar).'"' : '' ?>.</p>
        <?php else: ?>
            <?php foreach ($productos as $p): ?>
            <div class="product-card">
                <button class="btn-fav" onclick="this.classList.toggle('active')">
                    <i class="bi bi-heart-fill"></i>
                </button>
                <?php if (!empty($p['imagen'])): ?>
                    <img src="../photo/<?= urlencode($p['imagen']) ?>"
                         alt="<?= htmlspecialchars($p['nombre']) ?>"
                         class="product-img"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="product-img-placeholder" style="display:none;"><i class="bi bi-bag-heart"></i></div>
                <?php else: ?>
                    <div class="product-img-placeholder"><i class="bi bi-bag-heart"></i></div>
                <?php endif; ?>
                <div class="product-body">
                    <div class="product-cat"><?= htmlspecialchars($p['cat_nombre']) ?></div>
                    <div class="product-name"><?= htmlspecialchars($p['nombre']) ?></div>
                    <div class="product-price">$<?= number_format($p['precio'], 0, ',', '.') ?></div>
                    <button class="btn-comprar" onclick="agregarAlCarrito(<?= $p['idproducto'] ?>, this)">
                        <i class="bi bi-cart-plus"></i> Agregar al carrito
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<footer class="footer">
    <div class="footer-content">
        <div class="footer-col">
            <h4>Miscelánea Beauty</h4>
            <p>Tu forma de cuidarte, es nuestra forma de amarte 💚</p>
        </div>
        <div class="footer-col">
            <h4>Mi cuenta</h4>
            <ul>
                <li><a href="index.php?action=actualizarusuario">Actualizar mis datos</a></li>
                <li><a href="index.php?action=misFacturas">Mis facturas</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Contacto</h4>
            <p>Tel: 3203748195</p>
            <p>Ibagué - Tolima, Colombia</p>
            <p>Email: info@miscelaneabeauty.com</p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© 2026 Miscelánea Beauty. Todos los derechos reservados.</p>
    </div>
</footer>

<div class="toast-carrito" id="toastCarrito"></div>

<script>
function agregarAlCarrito(idproducto, btn) {
    btn.classList.add('cargando');
    btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Agregando...';
    fetch('controllers/carrito.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `accion=agregar&idproducto=${idproducto}`
    })
    .then(r => r.json())
    .then(data => {
        if (data.ok) {
            const badge = document.getElementById('cartBadge');
            badge.textContent = data.carrito.totalItems > 0 ? data.carrito.totalItems : '';
            mostrarToast('✓ ' + data.msg);
            btn.innerHTML = '<i class="bi bi-check-lg"></i> ¡Agregado!';
            btn.style.background = 'linear-gradient(135deg,#388e3c,#2e7d32)';
            setTimeout(() => {
                btn.innerHTML = '<i class="bi bi-cart-plus"></i> Agregar al carrito';
                btn.style.background = '';
                btn.classList.remove('cargando');
            }, 1500);
        } else {
            mostrarToast('⚠ ' + data.msg);
            btn.innerHTML = '<i class="bi bi-cart-plus"></i> Agregar al carrito';
            btn.classList.remove('cargando');
        }
    })
    .catch(() => {
        mostrarToast('❌ Error de conexión');
        btn.innerHTML = '<i class="bi bi-cart-plus"></i> Agregar al carrito';
        btn.classList.remove('cargando');
    });
}
let toastTimer;
function mostrarToast(msg) {
    const t = document.getElementById('toastCarrito');
    t.textContent = msg;
    t.classList.add('show');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => t.classList.remove('show'), 2500);
}
</script>
</body>
</html>