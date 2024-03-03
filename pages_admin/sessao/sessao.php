<?php
require_once("../../controllers/filmeController.php");

$filmeController = new FilmeController();

$filmes = $filmeController->listarFilmesCartaz();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Sessão</title>
    <link rel="stylesheet" href="sessao.css">
</head>

<body>
<a href="../admin/admin.html"><button>Voltar ao painel</button></a>
    <h2>Cadastrar Sessão</h2>
    <form action="cadastroSessao.php" method="post">
        <label for="idSala">ID da Sala:</label>
        <input type="number" name="idSala" required>

        <label for="idFilme">Filme:</label>
        <select name="idFilme" required>
            <?php
            foreach ($filmes as $filme) {
                echo "<option value=\"{$filme->getIdFilme()}\">{$filme->getNomeFilme()}</option>";
            }
            ?>
        </select>

        <label for="dia">Dia:</label>
        <input type="date" name="dia" required>

        <label for="horario">Horário:</label>
        <input type="time" name="horario" required>

        <label for="audio">Áudio:</label>
        <select name="audio" required>
            <option value="dublado">Dublado</option>
            <option value="legendado">Legendado</option>
        </select>

        <button type="submit">Cadastrar Sessão</button>
    </form>

    <a href="sessoesCadastradas.php">
        <button>Ver sessoes cadastradas</button>
    </a>
</body>

</html>