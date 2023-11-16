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

let filme = `${filmeNome}`;
async function getMovieInfo(filme) {
  const response = await fetch(
    `http://www.omdbapi.com/?t=${filme}&apikey=e182b070`
  );
  const data = await response.json();
  const posterConteiner = document.getElementById("poster");
  posterConteiner.innerHTML = `<img src="${data.Poster}" alt="${data.Title} Poster"/>`;

  nomeFilme = data.Title;
}
getMovieInfo(filme);

function diaCompleto(diaEscolhido) {
  const diasDaSemana = {
    'Seg': 'Segunda-feira',
    'Ter': 'Terça-feira',
    'Qua': 'Quarta-feira',
    'Qui': 'Quinta-feira',
    'Sex': 'Sexta-feira',
    'Sab': 'Sábado',
    'Dom': 'Domingo'
  };

  if (diaEscolhido in diasDaSemana) {
    return diasDaSemana[diaEscolhido];
  } else {
    return 'Dia inválido';
  }
}

function dataDia(str) {
  const partes = str.split(' ');

  const data = `${partes[1]}/${new Date().getFullYear()}`;

  return data;
}

const nomeDia = diaCompleto(diaEscolhido.substring(0, 3));
const data = dataDia(diaEscolhido);

filmeNomeElement.textContent = `${filmeNome}`;
diaEscolhidoElement.textContent = `Data: ${data} - ${nomeDia}`;
horarioEscolhidoElement.textContent = `Horário: ${horarioEscolhido}`;
salaEscolhidaElement.textContent = `Sala: 0${salaEscolhida}`;
audioEscolhidoElement.textContent = `Sessão: ${audioEscolhido}`;
