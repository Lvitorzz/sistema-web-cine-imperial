// var filmes=[
//     "Wish",
//     "Wonka",
//     "Godzilla Minus One",
//     "Thanksgiving"
// ];

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

  // async function getMovieInfo(filmes) {
  
  //   const response = await fetch(
  //       `http://www.omdbapi.com/?t=${filmes[1]}&apikey=e182b070`
  //     );
  //   const data = await response.json();
  
  //   const filmeContainer = document.getElementById("filme_inicio");
  //   const posterConteiner = document.getElementById("poster_inicio");
  //   posterConteiner.innerHTML = `<img src="${data.Poster}" alt="${data.Title} Poster"/>`;
  //   filmeContainer.innerHTML = `<h1>${data.Title}<h1/>`;
  
  //   nomeFilme = data.Title;
  // }
  // getMovieInfo(filmes);
