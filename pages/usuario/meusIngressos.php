<?php
require_once("../../controllers/IngressoController.php");

session_start();
if (isset($_SESSION['usuario'])) {
    $idCliente = $_SESSION['usuario']['id'];

    $ingressoController = new IngressoController();
    $ingressos = $ingressoController->ingressosPorCliente($idCliente);
} else {
    echo "erro";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Ingressos</title>
    <link rel="stylesheet" href="../../css/padrao.css">
    <style>
        body {
            background-color: #120F26;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        section {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            gap: 20px;
            padding: 20px;
        }

        .ingresso {
            background-color: #27498C;
            color: #fff;
            border-radius: 8px;
            padding: 15px;
            width: 300px;
            line-height: 2;
        }

        h1 {
            margin-top: 30px;
            color: white;
            text-align: center;
        }

        button {
            width: 20%;
            padding: 10px;
            cursor: pointer;
            background-color: #27498C;
            color: white;
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #1A356E;
        }
    </style>
</head>

<body>
    <h1>Meus ingressos</h1>
    <section>
        <?php
        if (isset($ingressos) && !empty($ingressos)) {
            foreach ($ingressos as $ingresso) {
                $idIngressoAleatorio = bin2hex(random_bytes(5));

                echo '<div class="ingresso">';
                echo '<div id="img-ing">';
                echo '</div>';
                echo '<p><strong>ID de Ingresso:</strong> ' . $idIngressoAleatorio . '</p>';
                echo '<p><strong>Quantidade:</strong> ' . $ingresso->getQuantidade() . '</p>';
                echo '<p><strong>Filme:</strong> ' . $ingresso->getNomeFilme() . '</p>';
                echo '<p><strong>Sala:</strong> ' . $ingresso->getNumeroSala() . '</p>';
                echo '<p><strong>Tipo de Áudio:</strong> ' . $ingresso->getTipoAudio() . '</p>';
                echo '<p><strong>Data da Sessão:</strong> ' . $ingresso->getDataSessao() . '</p>';
                echo '<p><strong>Horário da Sessão:</strong> ' . $ingresso->getHorarioSessao() . '</p>';
                echo '<p><strong>Valor da compra:</strong> ' . $ingresso->getValorTotal() . '</p>';
                echo '</div>';
            }
        } else {
            echo '<p>Você não possui ingressos.</p>';
        }

        ?>
    </section>

    <button onclick="window.location.href='../home/home.php'">Voltar à tela inicial</button>

</body>

</html>