<?php
ini_set('session.cookie_path', '/');
session_start();
require_once '../config/database.php';
$database = new Database();
$conn     = $database->getConnection();
$error    = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
$sesionIniciada = isset($_SESSION['numerodocumen']) ? 'true' : 'false';

// Consultar stock actualizado de TODOS los productos desde la BD
$stmtStock = $conn->prepare("SELECT idproducto, stock FROM producto");
$stmtStock->execute();
$stockDB = [];
while ($row = $stmtStock->fetch(PDO::FETCH_ASSOC)) {
    $stockDB[$row['idproducto']] = (int)$row['stock'];
}
// Convertir a JSON para pasarlo al JS
$stockJson = json_encode($stockDB);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Carrito – Miscelánea Beauty</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Urbanist:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/carrito.css">
</head>
<body>

<header class="navbar">
    <a href="index.php" class="logo">Miscelánea Beauty</a>
    <ul class="nav-links">
        <li><a href="index.php">Inicio</a></li>
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

<section class="carrito-section">
    <h1 class="carrito-titulo">
        <i class="bi bi-cart3"></i> Tu Carrito
        <span class="carrito-count" id="totalItemsBadge"></span>
    </h1>
    <?php if ($error): ?>
        <div class="alerta-error">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>
    <div id="carritoContenido"></div>
</section>

<div class="modal-overlay" id="modalPago">
    <div class="modal-pago">
        <button class="modal-close" onclick="cerrarModalPago()">✕</button>
        <div id="paso1">
            <h2><i class="bi bi-credit-card-2-front"></i> ¿Cómo quieres pagar?</h2>
            <div class="metodos-grid">
                <div class="metodo-btn nequi" onclick="seleccionarMetodo('nequi')">
                    <img src="../img/nequi.jpeg" alt="Nequi" onerror="this.style.display='none'">
                    Nequi
                </div>
                <div class="metodo-btn bancolombia" onclick="seleccionarMetodo('bancolombia')">
                    <img src="../img/bancolombia.jpeg" alt="Bancolombia" onerror="this.style.display='none'">
                    Bancolombia
                </div>
            </div>
        </div>
        <div class="panel-qr nequi-panel" id="panelNequi">
            <h2 style="color:#6a1b9a;"><i class="bi bi-phone"></i> Pagar con Nequi</h2>
            <img class="qr-img" src="../img/nequi.jpeg" alt="QR Nequi">
            <p class="qr-info">Escanea el QR desde tu app Nequi</p>
            <p class="qr-total" id="totalNequi"></p>
            <div class="instruccion">
                📲 Abre Nequi → <strong>Pagar</strong> → <strong>Escanear QR</strong> y apunta la cámara al código de arriba.
            </div>
            <form action="../controllers/generarfacturas.php" method="POST">
                <input type="hidden" name="metodopago" value="nequi">
                <input type="hidden" name="carrito_json" id="carritoJsonNequi">
                <button type="submit" class="btn-confirmar nequi-btn">
                    <i class="bi bi-check-circle"></i> Ya pagué, confirmar pedido
                </button>
            </form>
            <button class="btn-volver-metodos" onclick="volverMetodos()">← Cambiar método de pago</button>
        </div>
        <div class="panel-qr bancolombia-panel" id="panelBancolombia">
            <h2 style="color:#f57f17;"><i class="bi bi-bank"></i> Pagar con Bancolombia</h2>
            <img class="qr-img" src="../img/bancolombia.jpeg" alt="QR Bancolombia">
            <p class="qr-info">Escanea el QR desde tu app Bancolombia</p>
            <p class="qr-total" id="totalBancolombia"></p>
            <div class="instruccion" style="background:#fffde7;border-color:#f9a825;color:#f57f17;">
                🏦 Abre Bancolombia → <strong>Pagar y transferir</strong> → <strong>Código QR</strong> y apunta la cámara al código de arriba.
            </div>
            <form action="../controllers/generarfacturas.php" method="POST">
                <input type="hidden" name="metodopago" value="bancolombia">
                <input type="hidden" name="carrito_json" id="carritoJsonBancolombia">
                <button type="submit" class="btn-confirmar bancolombia-btn">
                    <i class="bi bi-check-circle"></i> Ya pagué, confirmar pedido
                </button>
            </form>
            <button class="btn-volver-metodos" onclick="volverMetodos()">← Cambiar método de pago</button>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="footer-content">
        <div class="footer-col">
            <h4>Miscelánea Beauty</h4>
            <p>Tu forma de cuidarte, es nuestra forma de amarte 💚</p>
        </div>
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
const SESION_INICIADA = <?= $sesionIniciada ?>;
// Stock actualizado desde la base de datos (se recarga cada vez que se abre la página)
const STOCK_DB = <?= $stockJson ?>;

function getCarrito() {
    return JSON.parse(localStorage.getItem('carrito_beauty') || '[]');
}
function saveCarrito(c) {
    localStorage.setItem('carrito_beauty', JSON.stringify(c));
}
function fmt(n) {
    return '$' + Number(n).toLocaleString('es-CO');
}
function actualizarContador() {
    const total = getCarrito().reduce((s, i) => s + i.qty, 0);
    const badge = document.getElementById('cartBadge');
    if (badge) badge.textContent = total > 0 ? total : '';
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

// Al cargar, sincronizar stock del carrito con la BD
function sincronizarStock() {
    let c = getCarrito();
    let cambios = false;
    c = c.map(item => {
        const stockActual = STOCK_DB[item.idproducto];
        if (stockActual === undefined) return item; // producto no encontrado, dejarlo
        // Actualizar stock desde BD
        if (item.stock !== stockActual) {
            item.stock = stockActual;
            cambios = true;
        }
        // Si qty supera el stock actual, ajustar
        if (item.qty > stockActual) {
            item.qty = stockActual;
            cambios = true;
            mostrarToast('⚠ Cantidad ajustada por cambio de stock en ' + item.nombre);
        }
        return item;
    }).filter(item => item.qty > 0); // eliminar items con qty 0
    if (cambios) saveCarrito(c);
    return c;
}

function renderPagina() {
    const carrito    = sincronizarStock();
    const badge2     = document.getElementById('totalItemsBadge');
    const content    = document.getElementById('carritoContenido');
    const totalItems = carrito.reduce((s, i) => s + i.qty, 0);

    actualizarContador();
    if (badge2) badge2.textContent = totalItems + (totalItems !== 1 ? ' productos' : ' producto');

    if (carrito.length === 0) {
        content.innerHTML = `
            <div class="carrito-vacio">
                <i class="bi bi-cart-x"></i>
                <p>Tu carrito está vacío</p>
                <a href="productos.php" class="btn-volver">Ver productos</a>
            </div>`;
        return;
    }

    let filas = '', subtotal = 0;
    carrito.forEach(item => {
        subtotal += item.precio * item.qty;
        const ne    = item.nombre.replace(/'/g, "\\'");
        // Usar stock de la BD en tiempo real
        const stock = STOCK_DB[item.idproducto] !== undefined ? STOCK_DB[item.idproducto] : (item.stock || 0);
        const img   = item.imagen
            ? `<img src="../photo/${encodeURIComponent(item.imagen)}" alt="${item.nombre}" onerror="this.style.display='none'">`
            : '';

        const btnMas = item.qty >= stock
            ? `<button class="btn-cant" disabled style="opacity:0.4;cursor:not-allowed;">+</button>`
            : `<button class="btn-cant" onclick="cambiarQty('${ne}', 1)">+</button>`;

        filas += `
        <tr>
            <td class="td-producto">${img}<span>${item.nombre}</span></td>
            <td>${fmt(item.precio)}</td>
            <td>
                <div class="controles-cantidad">
                    <button class="btn-cant" onclick="cambiarQty('${ne}', -1)">−</button>
                    <span>${item.qty}</span>
                    ${btnMas}
                </div>
            </td>
            <td>${fmt(item.precio * item.qty)}</td>
            <td><button class="btn-eliminar" onclick="eliminarItem('${ne}')"><i class="bi bi-trash3"></i></button></td>
        </tr>`;
    });

    const btnComprar = SESION_INICIADA
        ? `<button type="button" class="btn-comprar" onclick="abrirModalPago()"><i class="bi bi-bag-check"></i> Comprar ahora</button>`
        : `<div class="aviso-login"><i class="bi bi-info-circle-fill"></i> Debes <a href="../index.php?action=login">iniciar sesión</a> para comprar.</div>
           <a href="../index.php?action=login" class="btn-comprar btn-comprar-link"><i class="bi bi-person"></i> Iniciar Sesión para comprar</a>`;

    content.innerHTML = `
    <div class="carrito-layout">
        <div class="carrito-tabla-wrap">
            <table class="carrito-tabla">
                <thead><tr><th>Producto</th><th>Precio</th><th>Cantidad</th><th>Subtotal</th><th></th></tr></thead>
                <tbody>${filas}</tbody>
            </table>
            <div class="carrito-acciones">
                <a href="productos.php" class="btn-volver"><i class="bi bi-arrow-left"></i> Seguir comprando</a>
                <button class="btn-vaciar" onclick="vaciarCarrito()"><i class="bi bi-trash"></i> Vaciar carrito</button>
            </div>
        </div>
        <div class="resumen-box">
            <h3>Resumen del pedido</h3>
            <div class="resumen-linea"><span>Subtotal</span><span>${fmt(subtotal)}</span></div>
            <div class="resumen-total"><span>Total</span><span id="resTotal">${fmt(subtotal)}</span></div>
            ${btnComprar}
        </div>
    </div>`;
}

function cambiarQty(nombre, delta) {
    const c   = getCarrito();
    const idx = c.findIndex(x => x.nombre === nombre);
    if (idx > -1) {
        const stock = STOCK_DB[c[idx].idproducto] !== undefined ? STOCK_DB[c[idx].idproducto] : (c[idx].stock || 0);
        if (delta > 0 && c[idx].qty >= stock) {
            mostrarToast('⚠ Stock máximo: solo hay ' + stock + ' unidades disponibles');
            return;
        }
        c[idx].qty += delta;
        if (c[idx].qty <= 0) c.splice(idx, 1);
        saveCarrito(c);
    }
    renderPagina();
}

function eliminarItem(nombre) {
    saveCarrito(getCarrito().filter(i => i.nombre !== nombre));
    renderPagina();
}

function vaciarCarrito() {
    localStorage.removeItem('carrito_beauty');
    renderPagina();
}

function abrirModalPago() {
    const c     = getCarrito();
    const total = fmt(c.reduce((s, i) => s + i.precio * i.qty, 0));
    document.getElementById('totalNequi').textContent       = 'Total a pagar: ' + total;
    document.getElementById('totalBancolombia').textContent = 'Total a pagar: ' + total;
    document.getElementById('carritoJsonNequi').value       = JSON.stringify(c);
    document.getElementById('carritoJsonBancolombia').value = JSON.stringify(c);
    document.getElementById('modalPago').classList.add('active');
    volverMetodos();
}
function cerrarModalPago() {
    document.getElementById('modalPago').classList.remove('active');
}
function seleccionarMetodo(m) {
    document.getElementById('paso1').style.display = 'none';
    document.getElementById('panelNequi').classList.remove('active');
    document.getElementById('panelBancolombia').classList.remove('active');
    document.getElementById(m === 'nequi' ? 'panelNequi' : 'panelBancolombia').classList.add('active');
}
function volverMetodos() {
    document.getElementById('paso1').style.display = 'block';
    document.getElementById('panelNequi').classList.remove('active');
    document.getElementById('panelBancolombia').classList.remove('active');
}
document.getElementById('modalPago').addEventListener('click', function(e) {
    if (e.target === this) cerrarModalPago();
});

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

renderPagina();
</script>
</body>
</html>