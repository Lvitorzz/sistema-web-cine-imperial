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

  infoContainer.insertAdjacentHTML(
    "afterbegin",
    `
            <h2><strong>Genero:</strong> ${data.Genre}</h2>
            <h2><strong>Duração:</strong> ${data.Runtime}</h2>
            <h2><strong>Classificação:</strong> ${data.Rated}</h2>
            <h2><strong>Avaliação:</strong> ${data.imdbRating}</h2>          
        `
  );

  nomeFilme = data.Title;
}
getMovieInfo(filme);

filmeNomeElement.textContent = `${filmeNome}`;
diaEscolhidoElement.textContent = `Dia Escolhido: ${diaEscolhido}`;
horarioEscolhidoElement.textContent = `Horário Escolhido: ${horarioEscolhido}`;
salaEscolhidaElement.textContent = `${salaEscolhida}`;
audioEscolhidoElement.textContent = `${audioEscolhido}`;