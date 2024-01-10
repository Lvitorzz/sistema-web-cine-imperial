function etapaAtual(etapaAtual) {
    document.querySelectorAll('.fase div').forEach(function(elemento) {
        elemento.classList.remove('etapa-atual');
    });
  
    document.getElementById(`etapa${etapaAtual}`).classList.add('etapa-atual');
  }
  etapaAtual(3);


document.addEventListener('DOMContentLoaded', function () {

    var ticket = JSON.parse(localStorage.getItem('ticket'));

    var detalhesIngressoElement = document.getElementById('detalhes-ingresso');
    detalhesIngressoElement.textContent = `
        Filme: ${ticket.filme}
        Sala: ${ticket.sala}
        Audio: ${ticket.audio}
        Data: ${ticket.data}
        Horário: ${ticket.horario}
        Quantidade de Ingressos: ${ticket.quantidadeIngressos}
        Valor Total: ${ticket.valorTotal}
    `;

    document.getElementById('pagar-btn').addEventListener('click', function () {
        var metodoPagamento = document.getElementById('metodo').value;
        alert(`Pagamento efetuado com sucesso!\nMétodo: ${metodoPagamento}`);
    });
});