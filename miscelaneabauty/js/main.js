/* ══════════════════════════════════════
   main.js — Funciones globales del sitio
   ══════════════════════════════════════ */

function toggleDropdown() {
    document.getElementById('userDropdown')?.classList.toggle('show');
}

function toggleUserMenu() {
    document.getElementById('userDropdown')?.classList.toggle('show');
}

document.addEventListener('click', function(e) {
    const menu = document.querySelector('.user-menu');
    if (menu && !menu.contains(e.target)) {
        document.getElementById('userDropdown')?.classList.remove('show');
    }
});

function toggleMenu() {
    document.querySelector('.nav-links')?.classList.toggle('open');
}

// Scroll suave
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) target.scrollIntoView({ behavior: 'smooth' });
    });
});

// Formulario contacto
const contactForm = document.querySelector('.contact-form form');
if (contactForm) {
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        alert('¡Gracias por tu mensaje! Te contactaremos pronto.');
        this.reset();
    });
}