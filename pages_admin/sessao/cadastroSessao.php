<?php

require_once("../../controllers/SessaoController.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idSala = $_POST["idSala"];
    $idFilme = $_POST["idFilme"];
    $dia = $_POST["dia"];
    $horario = $_POST["horario"];
    $audio = $_POST["audio"];

    $sessaoController = new SessaoController();

    $resultado = $sessaoController->cadastrarSessao($idSala, $idFilme, $dia, $horario, $audio);

    if ($resultado) {
        echo "Sessão cadastrada com sucesso!";
        header("Location: ../sessao/sessao.php");
        exit();
    } else {
        echo "Erro ao cadastrar a sessão.";
    }
}
?>