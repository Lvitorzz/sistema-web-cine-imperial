var filmes=[
    "Wish",
    "Wonka",
    "Godzilla Minus One",
    "Thanksgiving"
];  

  async function getMovieInfo(filmes) {
  
    const response = await fetch(
        `http://www.omdbapi.com/?t=${filmes[1]}&apikey=e182b070`
      );
    const data = await response.json();
  
    const filmeContainer = document.getElementById("filme_inicio");
    const posterConteiner = document.getElementById("poster_inicio");
    posterConteiner.innerHTML = `<img src="${data.Poster}" alt="${data.Title} Poster"/>`;
    filmeContainer.innerHTML = `<h1>${data.Title}<h1/>`;
  
    nomeFilme = data.Title;
  }
  getMovieInfo(filmes); //enviar nome do filme selecionado para p escolherFilme.js


  document.getElementById('loginLink').addEventListener('click', function(event) {
    document.getElementById('loginForm').style.display = 'block';
    event.stopPropagation();
});

document.body.addEventListener('click', function() {
    document.getElementById('loginForm').style.display = 'none';
});

document.getElementById('loginForm').addEventListener('click', function(event) {
    event.stopPropagation();
});

function login() {
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    alert('Usuário: ' + username + '\nSenha: ' + password);
    document.getElementById('username').value = '';
    document.getElementById('password').value = '';
    document.getElementById('loginForm').style.display = 'none';
}