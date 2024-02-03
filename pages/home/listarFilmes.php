<?php
header('Content-Type: application/json');
require_once("../../controllers/filmeController.php");

$filmeController = new FilmeController();

$filmesCartaz = $filmeController->listarFilmesCartaz();
$filmesBreve = $filmeController->listarFilmesBreve();

$filmesArray = [];

foreach ($filmesCartaz as $filme) {
    $filmesArray[] = [
        'idFilme' => $filme->getIdFilme(),
        'nomeFilme' => $filme->getNomeFilme(),
        'tipo' => 'Cartaz'
    ];
}

foreach ($filmesBreve as $filme) {
    $filmesArray[] = [
        'idFilme' => $filme->getIdFilme(),
        'nomeFilme' => $filme->getNomeFilme(),
        'tipo' => 'Breve'
    ];
}

echo json_encode($filmesArray);
?>