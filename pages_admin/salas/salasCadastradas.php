<?php
require_once("../../controllers/salaController.php");
$salaController = new SalaController();
$salas = $salaController->listarSalas();

if (isset($_GET['excluir_id'])) {
    $idExcluir = $_GET['excluir_id'];


    $exclusaoSala = $salaController->excluirSala($idExcluir);

    if ($exclusaoSala) {
        echo '<script>alert("Sala excluída com sucesso!");</script>';
    } else {
        echo '<script>alert("Erro ao excluir a sala.");</script>';
    }
}

$salas = $salaController->listarSalas();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Salas</title>
    <link rel="stylesheet" href="sala.css">
</head>

<body>
<a href="../admin/admin.html"><button>Voltar ao painel</button></a>
    <h2>Salas Cadastradas</h2>
    <a href="salas.php">
        <button>Cadastrar Nova Sala</button>
    </a>

    <table border="1">
        <thead>
            <tr>
                <th>ID Sala</th>
                <th>Numero Sala</th>
                <th>Quantidade de pessoas</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($salas as $sala) : ?>
            <tr>
                <td><?php echo $sala->getIdSala(); ?></td>
                <td><?php echo $sala->getNumeroSala(); ?></td>
                <td><?php echo $sala->getQtdPessoas(); ?></td>
                <td>
                    <a href="?excluir_id=<?php echo $sala->getIdSala(); ?>" onclick="return confirm('Tem certeza que deseja excluir esta sala?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <br>

    
</body>

</html>