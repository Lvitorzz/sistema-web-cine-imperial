<?php
require_once("../../controllers/sessaoController.php");

if (isset($_GET['id'])) {
    $idFilme = $_GET['id'];

    $sessaoController = new SessaoController();
    $sessoes = $sessaoController->listarSessoesPorFilme($idFilme);
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
    <title>Escolher data e horario</title>
    <link rel="stylesheet" href="../../css/padrao.css">
    <link rel="stylesheet" href="dataHorario.css">
</head>

<body>
    <div class="container-data-horario">
        <section class="filme" id="filme">
            <div class="info-filme">
                <div class="titulo-filme" id="titulo">

                </div>
                <div class="infos" id="info">
                    <div class="poster" id="poster">

                    </div>
                    <div class="detalhes" id="detalhes">
                        <div class="botoes">
                            <button>Comentarios</button>
                            <button>Sinopse</button>
                            <button id="trailer-btn">Trailer</button>
                        </div>
                    </div>
                </div>
                <div id="trailer-container" style="margin-left: 20px; margin-top: 10px;">

                </div>

            </div>
        </section>
        <hr>
        <section class="data-horario">
            <h1>Escolha o dia e o horario para assistir este filme</h1>
            <div class="container-data" id="data-container">

            </div>
            <div class="info-cinema">
                <h1>Ingressos Plus</h1>
            </div>

            <div class="horario-container" id="horario-container">
                <div class="sessao-audio" id="dublado-container">
                    <h2>Dublado</h2>
                    <?php foreach ($sessoes as $sessao) : ?>
                        <?php if ($sessao->getAudio() == 'dublado') : ?>
                            <a class="sessao-button" href="../escolherIngresso/escolherIngresso.php?id_sessao=<?php echo $sessao->getIdSessao(); ?>" class="sessao-link">
                                <button style="background-color: #120F26; border: none; color: white;">
                                    <span>
                                        <?php
                                        $dataSessao = new DateTime($sessao->getDia());
                                        $nomeDia = [
                                            'Sunday' => 'Domingo',
                                            'Monday' => 'Segunda-feira',
                                            'Tuesday' => 'Terça-feira',
                                            'Wednesday' => 'Quarta-feira',
                                            'Thursday' => 'Quinta-feira',
                                            'Friday' => 'Sexta-feira',
                                            'Saturday' => 'Sábado'
                                        ];

                                        echo $dataSessao->format('d/m') . ' - ' . $nomeDia[$dataSessao->format('l')];
                                        ?>
                                    </span>
                                    <span><?php echo substr($sessao->getHorario(), 0, 5); ?></span>
                                </button>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

                <div class="sessao-audio" id="legendado-container">
                <h2>Legendado</h2>
                    <?php foreach ($sessoes as $sessao) : ?>
                        <?php if ($sessao->getAudio() == 'legendado') : ?>
                            <a class="sessao-button" href="../escolherIngresso/escolherIngresso.php?id_sessao=<?php echo $sessao->getIdSessao(); ?>" class="sessao-link">
                                <button style="background-color: #120F26; border: none; color: white;">
                                    <span>
                                        <?php
                                        $dataSessao = new DateTime($sessao->getDia());
                                        $nomeDia = [
                                            'Sunday' => 'Domingo',
                                            'Monday' => 'Segunda-feira',
                                            'Tuesday' => 'Terça-feira',
                                            'Wednesday' => 'Quarta-feira',
                                            'Thursday' => 'Quinta-feira',
                                            'Friday' => 'Sexta-feira',
                                            'Saturday' => 'Sábado'
                                        ];

                                        echo $dataSessao->format('d/m') . ' - ' . $nomeDia[$dataSessao->format('l')];
                                        ?>
                                    </span>
                                    <span><?php echo substr($sessao->getHorario(), 0, 5); ?></span>
                                </button>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>

        </section>
    </div>

    <div class="imagem-full-width">
        <img src="/imgs/Baixe.png" alt="Imagem de largura total">
    </div>

    <footer>

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
        <?php
        session_start();
        if (isset($_SESSION['usuario'])) {
            echo '<p id="logado">1</p>';
        } else {
            echo '<p id="logado">2</p>';
        }
        ?>
    </footer>
    <script src="escolherFilme.js"></script>
</body>

</html>