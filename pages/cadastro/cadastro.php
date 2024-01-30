<?php

require_once("../../controllers/UsuarioController.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $apelido = $_POST["apelido"];
    $email = $_POST["email"];
    $cpf = $_POST["cpf"];
    $telefone = $_POST["telefone"];
    $senha = $_POST["senha"];
    $senha2 = $_POST["senha2"];

    $usuarioController = new UsuarioController();

    if ($usuarioController->cadastrarUsuario($nome, $apelido, $email, $cpf, $telefone, $senha)) {
        echo "Usuário cadastrado com sucesso!";
        
    }else{
        echo "Erro ao cadastrar usuário.";
    }
}
?>