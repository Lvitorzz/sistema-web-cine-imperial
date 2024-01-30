<?php

require_once("../../controllers/UsuarioController.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $usuarioController = new UsuarioController();

    session_start();

    $usuario = $usuarioController->autenticarUsuario($email, $senha);

    if ($usuario) {
        $_SESSION['usuario'] = array(
            'id' => $usuario->getId(),
            'nome' => $usuario->getNome(),
            'apelido' => $usuario->getApelido(),
            'email' => $usuario->getEmail(),
            'cpf' => $usuario->getCpf(),
            'telefone' => $usuario->getTelefone(),
        );

        header("Location: ../../pages/home/home.php");
        exit();
    } else {
        echo "Erro ao autenticar usuário.";
    }
}
?>