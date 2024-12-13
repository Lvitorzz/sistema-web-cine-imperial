<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
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