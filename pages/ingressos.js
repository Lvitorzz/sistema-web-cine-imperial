const filmeNome = localStorage.getItem('filme');
const diaEscolhido = localStorage.getItem('dia');
const horarioEscolhido = localStorage.getItem('horario');
const salaEscolhida = localStorage.getItem('sala');
const audioEscolhido = localStorage.getItem('tipoAudio')
const filmeNomeElement = document.getElementById('filme-nome');
const diaEscolhidoElement = document.getElementById('dia-escolhido');
const horarioEscolhidoElement = document.getElementById('horario-escolhido');
const salaEscolhidaElement = document.getElementById('sala-escolhida');
const audioEscolhidoElement = document.getElementById('audio-escolhido');

filmeNomeElement.textContent = `Nome do Filme: ${filmeNome}`;
diaEscolhidoElement.textContent = `Dia Escolhido: ${diaEscolhido}`;
horarioEscolhidoElement.textContent = `Horário Escolhido: ${horarioEscolhido}`;
salaEscolhidaElement.textContent = `Sala Escolhida: ${salaEscolhida}`;
audioEscolhidoElement.textContent = `Áudio Escolhido: ${audioEscolhido}`;