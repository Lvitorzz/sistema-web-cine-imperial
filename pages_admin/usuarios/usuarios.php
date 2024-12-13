<?php
require_once("../../controllers/UsuarioController.php");

$usuarioController = new UsuarioController();

$usuarios = $usuarioController->listarUsuarios();

if (isset($_GET['excluir_id'])) {
    $idExcluir = $_GET['excluir_id'];


    $exclusaoSucesso = $usuarioController->excluirUsuario($idExcluir);

    if ($exclusaoSucesso) {
        echo '<script>alert("Usuário excluído com sucesso!");</script>';
    } else {
        echo '<script>alert("Erro ao excluir o usuário.");</script>';
    }
}

$usuarios = $usuarioController->listarUsuarios();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Usuários</title>
    <link rel="stylesheet" href="usuarios.css">
</head>
<body>
<a href="../admin/admin.html"><button>Voltar ao painel</button></a>
    <h1>Lista de Usuários Cadastrados</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Apelido</th>
                <th>Email</th>
                <th>CPF</th>
                <th>Telefone</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario) : ?>
                <tr>
                    <td><?php echo $usuario->getId(); ?></td>
                    <td><?php echo $usuario->getNome(); ?></td>
                    <td><?php echo $usuario->getApelido(); ?></td>
                    <td><?php echo $usuario->getEmail(); ?></td>
                    <td><?php echo $usuario->getCpf(); ?></td>
                    <td><?php echo $usuario->getTelefone(); ?></td>
                    <td><a href="?excluir_id=<?php echo $usuario->getId(); ?>" onclick="return confirm('Tem certeza que deseja excluir este usuário?')">Excluir</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
