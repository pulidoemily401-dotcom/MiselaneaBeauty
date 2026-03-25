/* ================================================
   marcas-topventas.js
   JS para: carrusel + dropdown usuario
   Archivo: js/marcas-topventas.js
   ================================================ */

// ── Carrusel ──────────────────────────────────────
let slideActual = 0;
const totalSlides = 4;

function actualizarCarrusel() {
    document.querySelector('.slides').style.transform = `translateX(-${slideActual * 100}%)`;
    document.querySelectorAll('.dot').forEach((dot, i) =>
        dot.classList.toggle('active', i === slideActual)
    );
}

function moverSlide(dir) {
    slideActual = (slideActual + dir + totalSlides) % totalSlides;
    actualizarCarrusel();
}

function irASlide(n) {
    slideActual = n;
    actualizarCarrusel();
}

setInterval(() => moverSlide(1), 5000);

// ── Dropdown usuario ──────────────────────────────
function toggleDropdown() {
    document.getElementById('userDropdown').classList.toggle('show');
}

document.addEventListener('click', function (e) {
    const menu = document.querySelector('.user-menu');
    if (menu && !menu.contains(e.target)) {
        document.getElementById('userDropdown')?.classList.remove('show');
    }
});