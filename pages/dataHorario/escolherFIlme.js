const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const filme = urlParams.get('titulo');
const idFilme = urlParams.get('id')

async function listarSessoesDB(idFilme) {
  try {
    const response = await fetch('listarSessoes.php');

    if (!response.ok) {
      throw new Error(`Erro na requisição: ${response.status} - ${response.statusText}`);
    }

    const text = await response.text();
    const sessoes = JSON.parse(text);

    const horarioContainer = document.getElementById('horario-container');

    const sessoesDoFilme = sessoes.filter(sessao => sessao.idFilme === idFilme);

    sessoesDoFilme.forEach(sessao => {
      if (sessao.dia && typeof sessao.dia === 'string' && sessao.horario && typeof sessao.horario === 'string') {
        const dataFormatada = sessao.dia.split(' ')[0];
        const dataSessao = new Date(dataFormatada);

        if (!isNaN(dataSessao.getTime())) {
          const diaSemana = dataSessao.toLocaleDateString('pt-BR', { weekday: 'short' });
          const horariosSessao = sessao.horario.split(',').map(horario => horario.trim());

          const button = document.createElement('button');
          button.textContent = `Data da sessão: ${dataSessao.toLocaleDateString()} - Dia da semana: ${diaSemana} - Horários: ${horariosSessao.join(', ')}`;

          // Adicionando botão diretamente à div "horario-container"
          horarioContainer.appendChild(button);

          // Adicionar um evento de clique ao botão (se necessário)
          button.addEventListener('click', () => {
            escolherHorario(sessao);
            console.log('Botão clicado:', sessao);
          });

        } else {
          console.error(`Formato de data inválido: ${sessao.data}`);
        }
      } else {
        console.error(`Propriedades 'data' ou 'horario' ausentes ou não são strings: ${JSON.stringify(sessao)}`);
      }
    });

  } catch (error) {
    console.error('Erro ao processar resposta:', error);
  }
}


listarSessoesDB(idFilme);

let nomeFilme = '';
async function getMovieInfo(filme) {
  
  const response = await fetch(
    `http://www.omdbapi.com/?t=${filme}&apikey=e182b070`
  );
  const data = await response.json();
  const filmeContainer = document.getElementById("titulo");
  const infoContainer = document.getElementById("detalhes");
  const posterConteiner = document.getElementById("poster");

  filmeContainer.innerHTML = `<h1>${data.Title}<h1/>`;
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

document.addEventListener("DOMContentLoaded", function () {
  const trailerBotao = document.getElementById("trailer-btn");
  trailerBotao.addEventListener("click", function () {
    searchAndEmbedTrailer(filme);
  });

  async function searchAndEmbedTrailer(filme) {
    const response = await fetch(
      `https://www.googleapis.com/youtube/v3/search?part=snippet&maxResults=1&q=${filme} trailer&key=AIzaSyBiqHWgvNikzG8mdBUUhEB8CI8Fsq9hLao`
    );
    const data = await response.json();

    const videoId = data.items[0].id.videoId;
    const videoContainer = document.getElementById("trailer-container");
    videoContainer.innerHTML = `<iframe width="500" height="280"
    src="https://www.youtube.com/embed/${videoId}" frameborder="0" allowfullscreen></iframe>`;
  }
});

function escolherHorario(sessao) { 
        if(conteudoLogado == 1){
          const dia = diaSelecionado;
          const info = horarioBotao.id;
          const splitInfo = info.split('-');
          const salaNumero = splitInfo[0].substring(4);
          const salaEscolhida = `${salaNumero}`;
          const audioEscolhido = splitInfo[1];
          const horario = horarioBotao.textContent;
    
          localStorage.setItem('sala', salaEscolhida);
          localStorage.setItem('tipoAudio', audioEscolhido);
          localStorage.setItem('filme', nomeFilme);
          localStorage.setItem('dia', dia);
          localStorage.setItem('horario', horario);
    
          window.location.href = '../../pages/escolherIngresso/escolherIngresso.php';
        }else{
          window.location.href = '../../pages/login/login.html';
        }
      }

