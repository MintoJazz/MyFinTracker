const inputDinheiro = document.querySelector('.dinheiro');
const inputCentavos = document.querySelector('#valor-centavos');

if (inputDinheiro) inputDinheiro.addEventListener('input', function (e) {
    let raw = e.target.value;

    const negativo = raw.startsWith('-');

    let valorPuro = raw.replace(/\D/g, ''); 

    if (valorPuro === '') {
        e.target.value = negativo ? '-' : '';
        inputCentavos.value = '';
        return;
    }

    const centavos = parseInt(valorPuro, 10);
    inputCentavos.value = negativo ? -centavos : centavos;

    let valorDecimal = centavos / 100;
    const formatado = new Intl.NumberFormat('pt-BR', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(valorDecimal);

    e.target.value = negativo ? '-' + formatado : formatado;
});