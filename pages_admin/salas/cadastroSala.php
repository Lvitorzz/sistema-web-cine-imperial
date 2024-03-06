<?php

require_once("../../controllers/SalaController.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numeroSala = $_POST["numeroSala"];
    $qtdPessoas = $_POST["qtdPessoas"];

    $salaController = new SalaController();

    $resultado = $salaController->cadastrarSala($numeroSala, $qtdPessoas);

    if ($resultado) {
        echo "Sala cadastrada com sucesso!";
        header("Location: ../salas/sala.php");
        exit();
    } else {
        echo "Erro ao cadastrar a sala.";
    }
}
?>