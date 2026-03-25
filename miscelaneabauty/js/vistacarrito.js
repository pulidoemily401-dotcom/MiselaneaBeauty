/* ══════════════════════════════════════
   vistacarrito.js
   Lógica exclusiva de la página del carrito
   ══════════════════════════════════════ */

function fmt(n) {
    return '$' + Number(n).toLocaleString('es-CO');
}

function renderPagina() {
    const carrito    = getCarrito();
    const badge      = document.getElementById('cartBadge');
    const badge2     = document.getElementById('totalItemsBadge');
    const content    = document.getElementById('carritoContenido');
    const totalItems = carrito.reduce((s, i) => s + i.qty, 0);

    if (badge)  badge.textContent  = totalItems > 0 ? totalItems : '';
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

    let filas    = '';
    let subtotal = 0;

    carrito.forEach(item => {
        subtotal += item.precio * item.qty;
        const nombreEsc = item.nombre.replace(/'/g, "\\'");
        const imgSrc    = item.imagen ? `../photo/${encodeURIComponent(item.imagen)}` : '';
        const img       = imgSrc
            ? `<img src="${imgSrc}" alt="${item.nombre}" onerror="this.style.display='none'">`
            : '';

        filas += `
        <tr>
            <td class="td-producto">${img}<span>${item.nombre}</span></td>
            <td>${fmt(item.precio)}</td>
            <td>
                <div class="controles-cantidad">
                    <button class="btn-cant" onclick="cambiarQty('${nombreEsc}', -1)">−</button>
                    <span>${item.qty}</span>
                    <button class="btn-cant" onclick="cambiarQty('${nombreEsc}', 1)">+</button>
                </div>
            </td>
            <td>${fmt(item.precio * item.qty)}</td>
            <td>
                <button class="btn-eliminar" onclick="eliminarItem('${nombreEsc}')" title="Eliminar">
                    <i class="bi bi-trash3"></i>
                </button>
            </td>
        </tr>`;
    });

    const btnComprar = SESION_INICIADA
        ? `<button type="button" class="btn-comprar" onclick="abrirModalPago()">
               <i class="bi bi-bag-check"></i> Comprar ahora
           </button>`
        : `<div class="aviso-login">
               <i class="bi bi-info-circle-fill"></i>
               Debes <a href="../index.php?action=login">iniciar sesión</a> para comprar.
           </div>
           <a href="../index.php?action=login" class="btn-comprar btn-comprar-link">
               <i class="bi bi-person"></i> Iniciar Sesión para comprar
           </a>`;

    content.innerHTML = `
    <div class="carrito-layout">
        <div class="carrito-tabla-wrap">
            <table class="carrito-tabla">
                <thead>
                    <tr>
                        <th>Producto</th><th>Precio</th>
                        <th>Cantidad</th><th>Subtotal</th><th></th>
                    </tr>
                </thead>
                <tbody>${filas}</tbody>
            </table>
            <div class="carrito-acciones">
                <a href="productos.php" class="btn-volver">
                    <i class="bi bi-arrow-left"></i> Seguir comprando
                </a>
                <button class="btn-vaciar" onclick="vaciarCarrito()">
                    <i class="bi bi-trash"></i> Vaciar carrito
                </button>
            </div>
        </div>
        <div class="resumen-box">
            <h3>Resumen del pedido</h3>
            <div class="resumen-linea">
                <span>Subtotal</span><span>${fmt(subtotal)}</span>
            </div>
            <div class="resumen-total">
                <span>Total</span><span id="resTotal">${fmt(subtotal)}</span>
            </div>
            ${btnComprar}
        </div>
    </div>`;
}

function cambiarQty(nombre, delta) {
    const carrito = getCarrito();
    const idx = carrito.findIndex(i => i.nombre === nombre);
    if (idx > -1) {
        carrito[idx].qty += delta;
        if (carrito[idx].qty <= 0) carrito.splice(idx, 1);
        saveCarrito(carrito);
        actualizarContador();
    }
    renderPagina();
}

function eliminarItem(nombre) {
    saveCarrito(getCarrito().filter(i => i.nombre !== nombre));
    actualizarContador();
    renderPagina();
}

function vaciarCarrito() {
    localStorage.removeItem('carrito_beauty');
    actualizarContador();
    renderPagina();
}

// ── MODAL DE PAGO ──
function abrirModalPago() {
    const carrito    = getCarrito();
    const total      = carrito.reduce((s, i) => s + i.precio * i.qty, 0);
    const totalTexto = fmt(total);

    document.getElementById('totalNequi').textContent       = 'Total a pagar: ' + totalTexto;
    document.getElementById('totalBancolombia').textContent = 'Total a pagar: ' + totalTexto;
    document.getElementById('carritoJsonNequi').value       = JSON.stringify(carrito);
    document.getElementById('carritoJsonBancolombia').value = JSON.stringify(carrito);
    document.getElementById('modalPago').classList.add('active');
    volverMetodos();
}

function cerrarModalPago() {
    document.getElementById('modalPago').classList.remove('active');
}

function seleccionarMetodo(metodo) {
    document.getElementById('paso1').style.display = 'none';
    document.getElementById('panelNequi').classList.remove('active');
    document.getElementById('panelBancolombia').classList.remove('active');
    document.getElementById(metodo === 'nequi' ? 'panelNequi' : 'panelBancolombia').classList.add('active');
}

function volverMetodos() {
    document.getElementById('paso1').style.display = 'block';
    document.getElementById('panelNequi').classList.remove('active');
    document.getElementById('panelBancolombia').classList.remove('active');
}

document.getElementById('modalPago').addEventListener('click', function(e) {
    if (e.target === this) cerrarModalPago();
});

// Inicializar
renderPagina();