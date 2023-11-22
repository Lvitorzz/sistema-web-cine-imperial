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
    'Sáb': 'Sábado',
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



document.addEventListener('DOMContentLoaded', function () {
  var quantidadeInputs = document.querySelectorAll('table tbody input[type="number"]');
  quantidadeInputs.forEach(function (input) {
      input.addEventListener('input', calcularTotais);
  });
});

function calcularTotais() {
  var linhas = document.querySelectorAll('table tbody tr');
  var totalIngressos = 0;
  var totalValor = 0;
  var detalhesCompra = ''; // Variável para acumular detalhes da compra

  linhas.forEach(function (linha, index) {
      if (index < linhas.length) {
          var quantidade = parseInt(linha.querySelector('select').value, 10);
          
          // Verifica se a quantidade é maior que zero antes de continuar
          if (quantidade > 0) {
              var precoUnitario = parseFloat(linha.querySelector('td:nth-child(2)').textContent.replace('R$', '').replace(',', '.'));

              if (index === 3) {
                  quantidade *= 4;
                  precoUnitario /= 4;
              }
              else if (index === 4) {
                  quantidade *= 2;
                  precoUnitario /= 2;
              }

              var subtotal = quantidade * precoUnitario;

              linha.querySelector('td:nth-child(4)').textContent = 'R$' + subtotal.toFixed(2);

              totalIngressos += quantidade;
              totalValor += subtotal;

              // Acumula detalhes da compra no formato desejado
              detalhesCompra += `${linha.querySelector('td:first-child').textContent} ${quantidade} x R$${precoUnitario.toFixed(2)}= R$${subtotal.toFixed(2)}\n`;
          }
      }
  });

  // Atualiza o elemento 'detalhes-compra' com a string acumulada
  document.getElementById('detalhes-compra').textContent = detalhesCompra;

  document.getElementById('quant-ingressos').textContent = totalIngressos;
  document.getElementById('valor-pagar').textContent = 'R$' + totalValor.toFixed(2);
}