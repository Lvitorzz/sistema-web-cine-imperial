<?php

class UsuarioModel
{
    private $id;
    private $nome;
    private $apelido;
    private $email;
    private $cpf;
    private $telefone;
    private $senha;

    public function __construct($id, $nome, $apelido, $email, $cpf, $telefone, $senha)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->apelido = $apelido;
        $this->email = $email;
        $this->cpf = $cpf;
        $this->telefone = $telefone;
        $this->senha = $senha;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getApelido()
    {
        return $this->apelido;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function getSenha()
    {
        return $this->senha;
    }
}
?>