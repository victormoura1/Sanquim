let pagina = 0;
const container = document.getElementById('container');
const carrossel = document.querySelector('.carrossel');

const itens = container.children.length;
let itensPorPagina = calcularItensPorPagina();
let maxPagina = Math.ceil(itens / itensPorPagina) - 1;

function calcularItensPorPagina() {
    const largura = window.innerWidth;
    if (largura >= 1200) return 3;
    if (largura >= 768) return 2;
    return 1;
}

function atualizarMaxPagina() {
    itensPorPagina = calcularItensPorPagina();
    maxPagina = Math.ceil(itens / itensPorPagina) - 1;
}

function calcularDeslocamento() {
    const item = container.querySelector('.item');
    const itemWidth = item.offsetWidth;
    const gap = parseInt(getComputedStyle(container).gap) || 30;
    return pagina * (itemWidth + gap) * itensPorPagina;
}

function mover(direcao) {
    pagina += direcao;

    if (pagina < 0) pagina = 0;
    if (pagina > maxPagina) pagina = maxPagina;

    const deslocamento = calcularDeslocamento();
    container.style.transform = `translateX(-${deslocamento}px)`;
}

window.addEventListener('resize', () => {
    const paginaAnterior = pagina;
    atualizarMaxPagina();

    if (pagina > maxPagina) {
        pagina = maxPagina;
    }

    const deslocamento = calcularDeslocamento();
    container.style.transform = `translateX(-${deslocamento}px)`;
});