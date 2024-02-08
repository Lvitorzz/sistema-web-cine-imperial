<?php
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header("Location: ../../pages/home/home.php");
        exit();
    } 
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Pagamento</title>
    <link rel="stylesheet" href="../../css/padrao.css">
    <link rel="stylesheet" href="pagamento.css">

<body>
    <div class="card-pagamento-header">
        <h1>REALIZAR PAGAMENTO</h1>
    </div>
    <section class="pagar-ingressos">
        <div class="detalhes-filme-pagamento">
            <h3>Verifique as informações do seu pedido antes de confirmar</h3>
            <p id="detalhes-ingresso"></p>
            <div class="metodo-pagamento">
                <label for="metodo">Escolha o Método de Pagamento:</label>
                <select class="selecionar-metodo-pagamento" id="metodo" name="metodo">
                    <option value="credito">Cartão de Crédito</option>
                    <option value="debito">Cartão de Débito</option>
                    <option value="pix">PIX</option>
                </select>
            </div>
            <div class="container-pagar-btn">
                <button class="pagar-btn" id="pagar-btn">Pagar</button>
            </div>

        </div>

    </section>
    </div>

    <footer>
        <div class="imagem-full-width">
            <img src="../../imgs/Baixe.png" alt="Imagem de largura total">
        </div>
        <div class="container-footer">
            <div class="coluna-footer">
                <h2>Menu</h2>
                <p><a href="#">Filmes</a></p>
                <p><a href="#">Serviços</a></p>
                <p><a href="#">Noticias</a></p>
                <p><a href="#">Shop</a></p>
            </div>

            <div class="coluna-footer">
                <h2>Institucional</h2>
                <p><a href="#">Quem somos</a></p>
                <p><a href="#">Nosso app</a></p>
            </div>

            <div class="coluna-footer">
                <h2>Políticas</h2>
                <p><a href="#">Privacidade e Segurança</a></p>
                <p><a href="#">Meia-entrada</a></p>
                <p><a href="#">Trocas e Cancelamentos</a></p>
            </div>

            <div class="coluna-footer">
                <h2>Redes sociais</h2>
                <p><i class="fab fa-facebook"></i><a href="#">Facebook</a></p>
                <p><i class="fab fa-instagram"></i> <a href="#">Cine Golden</a></p>
                <p><i class="fab fa-instagram"></i><a href="#">Cine Itaguari</a></p>
                <p><i class="fab fa-instagram"></i><a href="#">Vila Geek</a></p>
                <p><i class="fab fa-instagram"></i><a href="#">Cine Cariri</a></p>
            </div>
        </div>
        <div style="width: 100%; justify-content: center; display: flex;">
            <hr style="width: 80%;">
        </div>
        <div class="direitos-reservados">
            <p>&copy; 2023 CineImperial. Todos os direitos reservados.</p>
        </div>
    </footer>
    <script src="pagamento.js"></script>
</body>

</html>