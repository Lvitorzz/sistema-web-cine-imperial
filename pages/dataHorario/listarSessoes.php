<?php
header('Content-Type: application/json');
require_once("../../controllers/SessaoController.php");

$sessaoController = new SessaoController();

$sessoes = $sessaoController->listarSessoes();

$sessoesArray = [];

foreach ($sessoes as $sessao) {
    $sessoesArray[] = [
        'idSessao' => $sessao->getIdSessao(),
        'idFilme' => $sessao->getIdFilme(),
        'idSala' => $sessao->getIdSala(),
        'dia' => $sessao->getDia(),
        'horario' => $sessao->getHorario(),
        'audio' => $sessao->getAudio(),
    ];
}

echo json_encode($sessoesArray);
?>