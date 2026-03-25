/* ══════════════════════════════════════
   carrito.js — Lógica global del carrito
   Usa localStorage. No hace llamadas PHP.
   ══════════════════════════════════════ */

function getCarrito() {
    return JSON.parse(localStorage.getItem('carrito_beauty') || '[]');
}

function saveCarrito(carrito) {
    localStorage.setItem('carrito_beauty', JSON.stringify(carrito));
}

function formatPrecio(n) {
    return '$' + Number(n).toLocaleString('es-CO');
}

function actualizarContador() {
    const total = getCarrito().reduce((s, i) => s + i.qty, 0);
    document.querySelectorAll('#cartBadge, #cartCount').forEach(el => {
        if (el) el.textContent = total > 0 ? total : '';
    });
}

// Llamada desde productos.php — recibe idproducto y busca datos del producto en el DOM
function agregarAlCarrito(idproducto, btn) {
    const card  = btn.closest('.product-card');
    const nombre = card.querySelector('h3').textContent.trim();
    const precioTexto = card.querySelector('.product-price').textContent.replace(/[^0-9]/g, '');
    const precio = parseInt(precioTexto);
    const imgEl  = card.querySelector('.product-img');
    const imagen = imgEl ? imgEl.src.split('/photo/')[1] || '' : '';

    const carrito = getCarrito();
    const idx = carrito.findIndex(i => i.idproducto === idproducto);
    if (idx > -1) {
        carrito[idx].qty++;
    } else {
        carrito.push({ idproducto, nombre, precio, imagen, qty: 1 });
    }
    saveCarrito(carrito);
    actualizarContador();

    // Feedback visual
    const orig = btn.innerHTML;
    btn.innerHTML = '<i class="bi bi-check-lg"></i> ¡Agregado!';
    btn.style.background = '#9ecb97';
    setTimeout(() => {
        btn.innerHTML = orig;
        btn.style.background = '';
    }, 1500);

    // Toast
    mostrarToast('✓ Producto agregado al carrito');
}

// Toast global
let toastTimer;
function mostrarToast(msg) {
    let t = document.getElementById('toastCarrito');
    if (!t) return;
    t.textContent = msg;
    t.classList.add('show');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => t.classList.remove('show'), 2500);
}

// Inicializar contador al cargar
document.addEventListener('DOMContentLoaded', actualizarContador);
