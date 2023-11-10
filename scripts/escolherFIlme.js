const dias = ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"];
const horariosSala1Legendado = {
  Dom: ["13:00"],
  Seg: ["18:00"],
  Ter: ["18:00"],
  Qua: ["18:00"],
  Qui: ["18:00", "22:00"],
  Sex: ["18:00", "22:00"],
  Sáb: ["13:00", "21:00"],
};

const horariosSala2Legendado = {
  Dom: ["22:00"],
  Seg: ["13:00"],
  Ter: ["13:00"],
  Qua: ["13:00"],
  Qui: ["13:00", "23:00"],
  Sex: ["13:00", "23:00"],
  Sáb: ["22:00"],
};

const horariosSala1Dublado = {
  Dom: ["15:00", "19:00", "22:00"],
  Seg: ["15:00", "21:00"],
  Ter: ["15:00", "21:00"],
  Qua: ["15:00", "21:00"],
  Qui: ["15:00"],
  Sex: ["15:00"],
  Sáb: ["15:00", "18:00"],
};

const horariosSala2Dublado = {
  Dom: ["13:00", "16:00"],
  Seg: ["16:00", "20:00"],
  Ter: ["16:00", "20:00"],
  Qua: ["16:00", "20:00"],
  Qui: ["16:00", "20:00"],
  Sex: ["16:00", "20:00"],
  Sáb: ["13:00", "16:00", "19:00"],
};

const dataContainer = document.getElementById("data-container");
const sala1LegendadoContainer = document.querySelector(".sala1-legendado");
const sala1DubladoContainer = document.querySelector(".sala1-dublado");
const sala2LegendadoContainer = document.querySelector(".sala2-legendado");
const sala2DubladoContainer = document.querySelector(".sala2-dublado");

for (let i = 0; i < 7; i++) {
  const date = new Date();
  date.setDate(date.getDate() + i);

  const dia = dias[date.getDay()];
  const data = `${date.getDate()}/${date.getMonth() + 1}`;

  const botao = document.createElement("button");
  botao.classList.add("dia-btn");
  botao.innerHTML = `<p>${dia}</p><p>${data}</p>`;

  botao.addEventListener("click", function () {
    dataSelecionada(botao, dia);
  });

  dataContainer.appendChild(botao);
}

let botaoSelecionado = null;
function dataSelecionada(botao, dia) {
  if (botaoSelecionado) {
    botaoSelecionado.classList.remove("selecionado");
  }
  botaoSelecionado = botao;
  botao.classList.add("selecionado");

  const horariosSala1LegendadoDoDia = horariosSala1Legendado[dia];
  const horariosSala1DubladoDoDia = horariosSala1Dublado[dia];
  const horariosSala2LegendadoDoDia = horariosSala2Legendado[dia];
  const horariosSala2DubladoDoDia = horariosSala2Dublado[dia];

  sala1LegendadoContainer.innerHTML = "<h2>Sala 1 - Legendado</h2>";
  sala1DubladoContainer.innerHTML = "<h2>Sala 1 - Dublado</h2>";
  sala2LegendadoContainer.innerHTML = "<h2>Sala 2 - Legendado</h2>";
  sala2DubladoContainer.innerHTML = "<h2>Sala 2 - Dublado</h2>";

  horariosSala1LegendadoDoDia.forEach((horario) => {
    const horarioBotao = document.createElement("button");
    horarioBotao.classList.add("horario-btn");
    horarioBotao.id = `sala1-Legendado`;
    horarioBotao.textContent = horario;
    sala1LegendadoContainer.appendChild(horarioBotao);
  });

  horariosSala1DubladoDoDia.forEach((horario) => {
    const horarioBotao = document.createElement("button");
    horarioBotao.classList.add("horario-btn");
    horarioBotao.id = `sala1-Dublado`;
    horarioBotao.textContent = horario;
    sala1DubladoContainer.appendChild(horarioBotao);
  });

  horariosSala2LegendadoDoDia.forEach((horario) => {
    const horarioBotao = document.createElement("button");
    horarioBotao.classList.add("horario-btn");
    horarioBotao.id = `sala2-Legendado`;
    horarioBotao.textContent = horario;
    sala2LegendadoContainer.appendChild(horarioBotao);
  });

  horariosSala2DubladoDoDia.forEach((horario) => {
    const horarioBotao = document.createElement("button");
    horarioBotao.classList.add("horario-btn");
    horarioBotao.id = `sala2-Dublado`;
    horarioBotao.textContent = horario;
    sala2DubladoContainer.appendChild(horarioBotao);
  });

  escolherHorario();
}

let filme = "the batman";
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

function escolherHorario() {
  const horarioBotoes = document.querySelectorAll('.horario-btn');
  const diaSelecionado = botaoSelecionado.textContent.split('\n')[0];

  horarioBotoes.forEach((horarioBotao) => {
    horarioBotao.addEventListener('click', function() {
      const dia = diaSelecionado;
      const info = horarioBotao.id;
      const splitInfo = info.split('-');
      const salaNumero = splitInfo[0].substring(4);
      const salaEscolhida = `Sala ${salaNumero}`;
      const audioEscolhido = splitInfo[1];
      const horario = horarioBotao.textContent;

      localStorage.setItem('sala', salaEscolhida);
      localStorage.setItem('tipoAudio', audioEscolhido);
      localStorage.setItem('filme', nomeFilme);
      localStorage.setItem('dia', dia);
      localStorage.setItem('horario', horario);

      window.location.href = 'escolherIngresso.html';
    });
  });
}

