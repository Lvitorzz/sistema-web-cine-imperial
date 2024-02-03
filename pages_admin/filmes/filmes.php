<?php
require_once("../../controllers/filmeController.php");

$filmeController = new FilmeController();

$filmesCartaz = $filmeController->listarFilmesCartaz();
$filmesBreve = $filmeController->listarFilmesBreve();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Filmes</title>
    <link rel="stylesheet" href="filmes.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <a href="../../pages/home/home.php">
        <button>Home</button>
    </a>
    
    <div>
        <button onclick="abrirModal()">Cadastrar um novo filme</button>
    </div>
    <div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="fecharModal()">&times;</span>
        <h2>Cadastrar Novo Filme</h2>
        <form id="cadastroForm" action="cadastroFilme.php" method="post">
            <label for="nomeFilme">Nome do Filme:</label>
            <input type="text" id="nomeFilme" name="nomeFilme" required>

            <label>Tipo do Filme:</label>
            <input type="radio" id="tipoCartaz" name="tipoFilme" value="cartaz" checked> Cartaz
            <input type="radio" id="tipoBreve" name="tipoFilme" value="breve"> Em Breve

            <button type="submit" onclick="fecharModal()">Cadastrar</button>
        </form>
    </div>
</div>
</div>
    <div>
        <h1>Filmes em exibição</h1>
    </div>

    <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>retirar filme</th>
            <th>Informações do filme</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($filmesCartaz as $filme) : ?>
            <tr>
                <td><?php echo $filme->getIdFilme(); ?></td>
                <td><?php echo $filme->getNomeFilme(); ?></td>
                <td>
                    <a href="excluir_filme.php?id=<?php echo $filme->getIdFilme(); ?>" onclick="return confirm('Tem certeza que deseja excluir este filme?')">
                        <i class="fas fa-trash-alt"></i>
                    </a>                    
                </td>
                <td>
                <a href="detalhes_filme.php?id=<?php echo $filme->getIdFilme(); ?>">
                        <i class="fas fa-info-circle"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div>
        <h1>Filmes em breve</h1>
    </div>

    <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>retirar filme</th>
            <th>Informações do filme</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($filmesBreve as $filme) : ?>
            <tr>
                <td><?php echo $filme->getIdFilme(); ?></td>
                <td><?php echo $filme->getNomeFilme(); ?></td>
                <td>
                    <a href="excluir_filme.php?id=<?php echo $filme->getIdFilme(); ?>" onclick="return confirm('Tem certeza que deseja excluir este filme?')">
                        <i class="fas fa-trash-alt"></i>
                    </a>                    
                </td>
                <td>
                <a href="detalhes_filme.php?id=<?php echo $filme->getIdFilme(); ?>">
                        <i class="fas fa-info-circle"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

            <script src="filmes.js"></script>
</body>
</html>
