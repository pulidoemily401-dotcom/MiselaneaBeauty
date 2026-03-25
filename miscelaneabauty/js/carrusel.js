const slides = document.querySelector('.slides');
const total = document.querySelectorAll('.slide').length;
const dots = document.querySelectorAll('.dot');
let current = 0;

function goTo(index) {
    current = (index + total) % total;
    slides.style.transform = `translateX(-${current * 100}%)`;
    dots.forEach(d => d.classList.remove('active'));
    dots[current].classList.add('active');
}

dots.forEach((dot, i) => dot.addEventListener('click', () => {
    goTo(i);
    resetTimer();
}));

let timer = setInterval(() => goTo(current + 1), 4000);

function resetTimer() {
    clearInterval(timer);
    timer = setInterval(() => goTo(current + 1), 4000);
}