<?php
require_once("../../controllers/sessaoController.php");
$sessaoController = new SessaoController();
$sessoes = $sessaoController->listarSessoes();

if (isset($_GET['excluir_id'])) {
    $idExcluir = $_GET['excluir_id'];


    $exclusaoSucesso = $sessaoController->excluirSessao($idExcluir);

    if ($exclusaoSucesso) {
        echo '<script>alert("Sessâo excluída com sucesso!");</script>';
    } else {
        echo '<script>alert("Erro ao excluir a sessâo.");</script>';
    }
}

$sessoes = $sessaoController->listarSessoes();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Sessões</title>
    <link rel="stylesheet" href="sessao.css">
</head>

<body>
<a href="../admin/admin.html"><button>Voltar ao painel</button></a>
    <h2>Sessões Cadastradas</h2>
    <a href="sessao.php">
        <button>Cadastrar Nova Sessão</button>
    </a>

    <table border="1">
        <thead>
            <tr>
                <th>ID Sessão</th>
                <th>ID Filme</th>
                <th>ID Sala</th>
                <th>Dia</th>
                <th>Horário</th>
                <th>Áudio</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($sessoes as $sessao) : ?>
            <tr>
                <td><?php echo $sessao->getIdSessao(); ?></td>
                <td><?php echo $sessao->getIdFilme(); ?></td>
                <td><?php echo $sessao->getIdSala(); ?></td>
                <td><?php echo $sessao->getDia(); ?></td>
                <td><?php echo $sessao->getHorario(); ?></td>
                <td><?php echo $sessao->getAudio(); ?></td>
                <td>
                    <a href="?excluir_id=<?php echo $sessao->getIdSessao(); ?>" onclick="return confirm('Tem certeza que deseja excluir esta sessão?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <br>

    
</body>

</html>