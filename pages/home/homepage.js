async function getMovieInfoFromDB(tipo) {
  try {
    const response = await fetch('listarFilmes.php');

    if (!response.ok) {
      throw new Error(`Erro na requisição: ${response.status} - ${response.statusText}`);
    }

    const text = await response.text();
    const filmes = JSON.parse(text);

    const filteredFilmes = filmes.filter(filme => {
      return tipo === 'cartaz' ? filme.tipo === 'Cartaz' : filme.tipo === 'Breve';
    });

    displayMovies(filteredFilmes);
  } catch (error) {
    console.error('Erro ao processar resposta:', error);
  }
}

async function displayMovies(filmes) {
  const filmeContainer = document.getElementById("filmeContainer");
  filmeContainer.innerHTML = '';

  for (const filme of filmes) {
    const response = await fetch(`http://www.omdbapi.com/?t=${filme.nomeFilme}&apikey=e182b070`);
    const data = await response.json();

    if (data.Error) {
      console.error(`Erro na API ${filme.nomeFilme}: ${data.Error}`);
      continue;
    }

    const filmeDiv = document.createElement("div");
    filmeDiv.classList.add("filmeCard");
    filmeDiv.innerHTML = `
        <h1>${data.Title}</h1>
        <img src="${data.Poster}" alt="${data.Title} Poster"/>
    `;

    if (filme.tipo === 'Cartaz') {
      filmeDiv.addEventListener("click", function () {
        window.location.href = `../../pages/dataHorario/dataHorario.php?titulo=${encodeURIComponent(data.Title)}`;
      });
    }

    filmeContainer.appendChild(filmeDiv);
  }
}

document.addEventListener("DOMContentLoaded", function () {
  getMovieInfoFromDB('cartaz');
});

document.getElementById("cartaz").addEventListener("click", function () {
  getMovieInfoFromDB('cartaz');
});

document.getElementById("breve").addEventListener("click", function () {
  getMovieInfoFromDB('breve');
});



  function toggleMenu() {
    var opcoesMenu = document.getElementById("opcoes-menu");
    opcoesMenu.style.display = (opcoesMenu.style.display === 'block') ? 'none' : 'block';
  }
  
  document.addEventListener('click', function(event) {
    var menu = document.getElementById("opcoes-menu");
    var button = document.querySelector("button");
  
    if (event.target !== menu && event.target !== button && !menu.contains(event.target)) {
        menu.style.display = 'none';
    }
  });