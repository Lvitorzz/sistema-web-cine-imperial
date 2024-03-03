<?php
require_once("../../controllers/filmeController.php");

$filmeController = new FilmeController();

$filmesCartaz = $filmeController->listarFilmesCartaz();
$filmesBreve = $filmeController->listarFilmesBreve();

if (isset($_GET['excluir_id'])) {
    $idExcluir = $_GET['excluir_id'];
    $tipoFilme = $_GET['tipo_filme']; // Adicione isso para obter o tipo do filme

    $exclusaoSucesso = false;

    // Verifica o tipo do filme e chama o método correspondente
    if ($tipoFilme === 'cartaz') {
        $exclusaoSucesso = $filmeController->excluirFilmeCartaz($idExcluir);
    } elseif ($tipoFilme === 'breve') {
        $exclusaoSucesso = $filmeController->excluirFilmeBreve($idExcluir);
    }

    if ($exclusaoSucesso) {
        echo '<script>alert("Filme excluído com sucesso!");</script>';
    } else {
        echo '<script>alert("Erro ao excluir o Filme.");</script>';
    }
}

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
    <a href="../admin/admin.html"><button>Voltar ao painel</button></a>

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
    <div id="editarModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="fecharEditarModal()">&times;</span>
            <h2>Editar Nome do Filme</h2>
            <form id="edicaoForm" action="editarFilme.php" method="post">
                <input type="hidden" id="idFilmeEditar" name="idFilmeEditar">
                <label for="novoNomeFilme">Novo Nome do Filme:</label>
                <input type="text" id="novoNomeFilme" name="novoNomeFilme" required>

                <button type="submit" onclick="fecharEditarModal()">Salvar</button>
            </form>
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
                <th>excluir filme</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($filmesCartaz as $filme) : ?>
                <tr>
                    <td><?php echo $filme->getIdFilme(); ?></td>
                    <td><?php echo $filme->getNomeFilme(); ?></td>
                    <td>
                        <a href="?excluir_id=<?php echo $filme->getIdFilme(); ?>&tipo_filme=cartaz" onclick="return confirm('Tem certeza que deseja excluir este filme?')">
                            <i class="fas fa-trash-alt"></i>
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
                <th>excluir filme</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($filmesBreve as $filme) : ?>
                <tr>
                    <td><?php echo $filme->getIdFilme(); ?></td>
                    <td><?php echo $filme->getNomeFilme(); ?></td>
                    <td>
                        <a href="?excluir_id=<?php echo $filme->getIdFilme(); ?>&tipo_filme=breve" onclick="return confirm('Tem certeza que deseja excluir este filme?')">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script src="filmes.js"></script>
</body>

</html>