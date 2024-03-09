<?php
require_once("../../controllers/sessaoController.php");
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../pages/home/home.php");
    exit();
}

if (isset($_GET['id_sessao'])) {
    $idSessao = $_GET['id_sessao'];

    $sessaoController = new SessaoController();
    $sessao = $sessaoController->listarSessaoPorId($idSessao);
} else {

    header("Location: ../../pages/home/home.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escolher Ingresso</title>
    <link rel="stylesheet" href="../../css/padrao.css">
    <link rel="stylesheet" href="escolherIngresso.css">
</head>

<body>
    <section class="escolher-ingressos">
        <div class="texto-escolher-ingresso">
            <h1>ESCOLHER INGRESSOS</h1>
        </div>
    </section>

    <div class="container-escolher-ingressos">
        <section class="escolher-ingressos-info-filme">
            <div class="escolher-ingressos-poster-filme" id="poster">

            </div>
            <div class="escolher-detalhes-ingresso">
                <h2 id="filme-nome"><?php echo $sessao->getNomeFilme(); ?></h2>
                <p id="dia-escolhido"><?php echo $sessao->getDia(); ?></p>
                <p id="horario-escolhido"><?php echo $sessao->getHorario(); ?></p>
                <p id="sala-escolhida"><?php echo $sessao->getNumeroSala(); ?></p>
                <p id="audio-escolhido"><?php echo $sessao->getAudio(); ?></p>
            </div>

            <div class="escolher-ingressos-endereco">
                <div class="escolher-ingressos-endereco-texto">
                    <h2>CinemaPenas - Catu/BA</h2>
                    <h3>R. Barão de Camaçari, 118 - Centro</h3>
                </div>
                <div class="escolher-ingresso-mapa">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d2203.1842076655075!2d-38.376427131987484!3d-12.357064274406161!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1spt-BR!2sbr!4v1696791350248!5m2!1spt-BR!2sbr" width="200" height="120" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </section>

        <section class="container-tipo-ingresso">
            <h1>Selecione o tipo e a quantidade de ingresso</h1>
            <form action="gerarIngresso.php" method="post">
                <input type="number" name="idFilme" hidden value="<?php echo $sessao->getIdFilme(); ?>">
                <input type="number" name="idSala" hidden value="<?php echo $sessao->getIdSala(); ?>">
                <input type="number" name="idSessao" hidden value="<?php echo $sessao->getIdSessao(); ?>">
                <input type="number" name="idCliente" hidden value="<?php echo $_SESSION['usuario']['id']; ?>">
                <input type="number" name="valor" hidden value="29">
            <table>
                <thead>
                    <tr>
                        <th>Ingresso</th>
                        <th>Preço Unitário</th>
                        <th>Quantidade</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Inteira</td>
                        <td>R$29,00</td>
                        <td>
                            <select name="quantidade" onchange="calcularTotais()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                            </select>
                        </td>
                        <td>R$0.00</td>
                    </tr>
                    <tr>
                        <h4 style="text-align: center;">No momento so é possivel comprar Ingresso do tipo 'Inteira'</h4>
                        <h6 style="text-align: center;">Estamos trabalhando para fornecer melhores opções no futuro. :)</h6>
                        <td>Meia</td>
                        <td>R$14,50</td>
                        <td>
                            <select onchange="calcularTotais()" disabled>
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                            </select>
                        </td>
                        <td>R$0.00</td>
                    </tr>
                    <tr>
                        <td>Criança</td>
                        <td>R$14,50</td>
                        <td>
                            <select onchange="calcularTotais()" disabled>
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                            </select>
                        </td>
                        <td>R$0.00</td>
                    </tr>
                    <tr>
                        <td>Pacote Família
                            <div class="tooltip">
                                ?

                            </div>
                            <div class="tooltip-text">Combo de 4 Ingressos por R$20,00 cada.</div>
                        </td>
                        <td>R$60,00</td>
                        <td>
                            <select onchange="calcularTotais('pacoteFamilia')" disabled>
                                <option value="0">0</option>
                                <option value="1">1 Pacote (Total de de 4 Ingresso)</option>
                                <option value="2">2 Pacotes (Total de 8 Ingresso)</option>
                            </select>
                        </td>
                        <td>R$0.00</td>
                    </tr>
                    <tr>
                        <td>Duplo Ingresso
                            <div class="tooltip-dupla">
                                ?

                            </div>
                            <div class="tooltip-text-dupla">2 Ingressos com preço de 1.</div>
                        </td>
                        <td>R$29.00</td>
                        <td>
                            <select onchange="calcularTotais('duplaPagaMeia')" disabled>
                                <option value="0">0</option>
                                <option value="1">1 (Total de 2 Ingressos)</option>
                                <option value="2">2 (Total de 4 Ingressos)</option>
                                <option value="3">3 (Total de 6 Ingressos)</option>
                                <option value="4">4 (Total de 8 Ingressos)</option>
                            </select>
                        </td>
                        <td>R$0.00</td>
                    </tr>
                </tbody>
            </table>
            <input style="background-color: greenyellow; width: 200px; height: 50px; border: none; cursor: pointer;" type="submit" value="Comprar">
            </form>
            

            <div class="info-valores">
                <div class="container-quant-ingressos">
                    <h1 class="txt-quant">Total de Ingressos</h1>
                    <h1 class="quant-ingressos" id="quant-ingressos">0</h1>
                </div>
                <div class="container-valor-pagar">
                    <h1 class="txt-valor-pagar">Valor a Pagar</h1>
                    <h1 class="valor-pagar" id="valor-pagar">R$0,00</h1>
                </div>
            </div>

        </section>

        <section class="container-confirma-ingresso">
            <div>
                <h2>Detalhes da compra</h2>
                <p class="detalhes-compra" id="detalhes-compra"></p>
                <div class="div-continuar">
                    <h3 class="preco-final" id="preco-final">Total: R$00,00</h3>
                    <button id="continuar-btn" class="botao-confirmar-compra" disabled>Continuar</button>
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

    <script>
        function js() {
            let filmeP = '<?php echo $sessao->getNomeFilme(); ?>';
            jsFilme(filmeP);
        }
    </script>
    <script src="ingressos.js"></script>
</body>

</html>