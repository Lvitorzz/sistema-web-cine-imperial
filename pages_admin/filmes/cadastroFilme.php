<?php

require_once("../../controllers/FilmeController.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nomeFilme = $_POST["nomeFilme"];
    $tipoFilme = $_POST["tipoFilme"];
    
    $filmeController = new FilmeController();

    if ($tipoFilme === "cartaz") {
        if ($filmeController->cadastrarFilmeCartaz($nomeFilme)) {
            header("Location: filmes.php");
            exit;
        } else {
            echo "Erro ao cadastrar filme.";
        }
    } elseif ($tipoFilme === "breve") {
        if ($filmeController->cadastrarFilmeBreve($nomeFilme)) {
            header("Location: filmes.php");
            exit;
        } else {
            echo "Erro ao cadastrar filme.";
        }
    }
}
?>