<?php

require_once("../../controllers/IngressoController.php");
$ingressoController = new IngressoController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idFilme = $_POST["idFilme"];
    $idSala = $_POST["idSala"];
    $idSessao = $_POST["idSessao"];
    $idCliente = $_POST["idCliente"];
    $quantidade = $_POST["quantidade"];
    $valorUnitario = $_POST["valor"];
    

    $resultado = $ingressoController->createIngresso($idFilme, $idSala, $idSessao, $idCliente, $quantidade, $valorUnitario);

    if ($resultado) {
        echo "Ingresso!";
        header("Location: ../pagamento/pagamento.php");
        exit();
    } else {
        echo "Erro ao cadastrar ingresso.";
    }

}

?>