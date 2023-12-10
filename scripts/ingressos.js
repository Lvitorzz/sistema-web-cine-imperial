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

function etapaAtual(etapaAtual) {
  document.querySelectorAll('.fase div').forEach(function(elemento) {
      elemento.classList.remove('etapa-atual');
  });

  document.getElementById(`etapa${etapaAtual}`).classList.add('etapa-atual');
}
etapaAtual(2);

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
  let detalhesCompra = '';

  linhas.forEach(function (linha, index) {
      if (index < linhas.length) {
          var quantidade = parseInt(linha.querySelector('select').value, 10);
          
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

              detalhesCompra += `\n${linha.querySelector('td:first-child').textContent.substring(0,14)} ${quantidade}x R$${precoUnitario.toFixed(2)} = R$${subtotal.toFixed(2).replace('.', ',')}`;
          }
      }
  });
  
  document.getElementById('detalhes-compra').textContent = detalhesCompra;
  document.getElementById('quant-ingressos').textContent = totalIngressos;
  document.getElementById('valor-pagar').textContent = 'R$' + totalValor.toFixed(2);
  document.getElementById('preco-final').textContent = 'R$' + totalValor.toFixed(2);
}


document.addEventListener('DOMContentLoaded', function () {
  var quantidadeInputs = document.querySelectorAll('table tbody input[type="number"]');
  quantidadeInputs.forEach(function (input) {
      input.addEventListener('input', calcularTotais);
  });

  document.getElementById('continuar-btn').addEventListener('click', criarTicket);
});

function criarTicket() {
  var filme = filmeNome;
  var sala = salaEscolhida;
  var audio = audioEscolhido;
  var data = diaEscolhido;
  var horario = horarioEscolhido;
  var quantidadeIngressos = document.getElementById('quant-ingressos').textContent;
  var valorTotal = document.getElementById('valor-pagar').textContent;

  var ticket = {
      filme: filme,
      sala: sala,
      audio: audio,
      data: data,
      horario: horario,
      quantidadeIngressos: quantidadeIngressos,
      valorTotal: valorTotal
  };
  localStorage.setItem('ticket', JSON.stringify(ticket));
  if (quantidadeIngressos > 0){
    window.location.href = 'pagamento.html';
  } else{
    alert('Selecione pelo menos um ingresso!')
  }
  
}

