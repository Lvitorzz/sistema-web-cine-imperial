<?php

require_once("../../db/Conexao.php");
require_once("../../models/UsuarioModel.php");

class UsuarioController
{
    private $conn;

    public function __construct()
    {
        $conexao = new Conexao();
        $this->conn = $conexao->conectar();
    }

    public function cadastrarUsuario($nome, $apelido, $email, $cpf, $telefone, $senha)
    {
        $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "INSERT INTO clientes (nome, apelido, email, cpf, telefone, senha) 
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssss", $nome, $apelido, $email, $cpf, $telefone, $senhaCriptografada);

        return $stmt->execute();
    }

    public function listarUsuarios()
    {
        $usuarios = array();
        $sql = "SELECT * FROM clientes";
        $result = $this->conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            $usuario = new UsuarioModel(
                $row['id'],
                $row['nome'],
                $row['apelido'],
                $row['email'],
                $row['cpf'],
                $row['telefone'],
                $row['senha']
            );

            $usuarios[] = $usuario;
        }

        return $usuarios;
    }

    public function buscarUsuarioPorId($id)
    {
        $sql = "SELECT * FROM clientes WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            return new UsuarioModel(
                $row['id'],
                $row['nome'],
                $row['apelido'],
                $row['email'],
                $row['cpf'],
                $row['telefone'],
                $row['senha']
            );
        }

        return null;
    }

    public function atualizarUsuario($id, $nome, $apelido, $email, $cpf, $telefone, $senha)
    {
        $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "UPDATE clientes 
                SET nome = ?, apelido = ?, email = ?, cpf = ?, telefone = ?, senha = ? 
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssssi", $nome, $apelido, $email, $cpf, $telefone, $senhaCriptografada, $id);

        return $stmt->execute();
    }

    public function excluirUsuario($id)
    {
        $sql = "DELETE FROM clientes WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    public function autenticarUsuario($email, $senha)
    {
        try {
            $sql = "SELECT * FROM clientes WHERE email = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();

            $result = $stmt->get_result();
            $usuario = $result->fetch_assoc();

            if ($usuario) {
                $user = new UsuarioModel(
                    $usuario['id'],
                    $usuario['nome'],
                    $usuario['apelido'],
                    $usuario['email'],
                    $usuario['cpf'],
                    $usuario['telefone'],
                    $usuario['senha']
                );

                if (password_verify($senha, $user->getSenha())) {
                    return $user;
                } else {
                    echo "Senha incorreta";
                    return false;
                }
            }

        } catch (Exception $e) {
            echo "Erro ao autenticar usuário: " . $e->getMessage();
            return false;
        }
    }
}

?>