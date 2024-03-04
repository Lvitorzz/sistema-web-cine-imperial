<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Perfil</title>
    <link rel="stylesheet" href="gerenciarUsuario.css">
</head>

<body>
    <?php
    require_once("../../controllers/UsuarioController.php");
    session_start();
    if (isset($_SESSION['usuario'])) {
        $idUsuario = $_SESSION['usuario']['id'];
        $nomeUsuario = $_SESSION['usuario']['nome'];
        $apelidoUsuario = $_SESSION['usuario']['apelido'];
        $emailUsuario = $_SESSION['usuario']['email'];
        $cpfUsuario = $_SESSION['usuario']['cpf'];
        $telefoneUsuario = $_SESSION['usuario']['telefone'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $novoNome = $_POST['nome'];
            $novoApelido = $_POST['apelido'];
            $novoEmail = $_POST['email'];
            $novoCpf = $_POST['cpf'];
            $novoTelefone = $_POST['telefone'];
            $novaSenha = $_POST['senha'];

            $usuarioController = new UsuarioController();
            $atualizacao = $usuarioController->atualizarUsuario(
                $idUsuario,
                $novoNome,
                $novoApelido,
                $novoEmail,
                $novoCpf,
                $novoTelefone,
                $novaSenha
            );

            $_SESSION['usuario']['nome'] = $novoNome;
            $_SESSION['usuario']['apelido'] = $novoApelido;
            $_SESSION['usuario']['email'] = $novoEmail;
            $_SESSION['usuario']['cpf'] = $novoCpf;
            $_SESSION['usuario']['telefone'] = $novoTelefone;

            if ($atualizacao) {
                echo '<script>alert("Perfil atualizado com sucesso!");</script>';
                echo '<script>window.location.href = "gerenciarUsuario.php";</script>';
            } else {
                echo '<script>alert("Erro ao atualizar o perfil.");</script>';
                echo '<script>window.location.reload();</script>';
            }

            
        }
        if (isset($_SESSION['usuario'])) {
            $idUsuario = $_SESSION['usuario']['id'];
            if (isset($_GET['excluir_id'])) {
                $exclusaoSucesso = $usuarioController->excluirUsuario($idUsuario);

                if ($exclusaoSucesso) {
                    echo '<script>alert("Usuário excluído com sucesso!");</script>';
                } else {
                    echo '<script>alert("Erro ao excluir o usuário.");</script>';
                }
                header('Location: gerenciar_perfil.php');
                exit;
            }
        }
    ?>
        <h2>Editar Perfil</h2>
        <form action="gerenciarUsuario.php" method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo $nomeUsuario; ?>" required>

            <label for="apelido">Apelido:</label>
            <input type="text" id="apelido" name="apelido" value="<?php echo $apelidoUsuario; ?>" required>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" value="<?php echo $emailUsuario; ?>" required>

            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" value="<?php echo $cpfUsuario; ?>" required>

            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" value="<?php echo $telefoneUsuario; ?>" required>

            <label for="senha">Nova Senha:</label>
            <input type="password" id="senha" name="senha" placeholder="Deixe em branco para manter a senha atual">

            <button type="submit">Atualizar Perfil</button>
        </form>

        <h2>Excluir Conta</h2>
        <p>Tem certeza que deseja excluir sua conta? Esta ação não pode ser desfeita.</p>
        <div class="btn-deletar">
            <button type="submit" onclick="return confirm('Tem certeza que deseja excluir sua conta? Esta ação não pode ser         desfeita.');">
                <a href="?excluir_id=<?php echo $idUsuario; ?>" style="text-decoration: none; color: inherit;">Excluir Conta</a>
            </button>
        </div>

    <?php
    } else {
        header('Location: login.php');
        exit;
    }
    ?>
</body>

</html>