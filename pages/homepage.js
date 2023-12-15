var filmes=[
    "Wonka",
    "Godzilla Minus One",
    "Thanksgiving"
];  


const response = await fetch(
    `http://www.omdbapi.com/?t=${filmes[0]}&apikey=e182b070`
  );
  const data = await response.json();
  const filmeContainer = document.getElementById("filme_inicio");
  filmeContainer.innerHTML = `<h1>${data.Title}<h1/>`;

