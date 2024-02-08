<?php

require_once("../../db/Conexao.php");


class SessaoController
{
    private $conn;

    public function __construct()
    {
        $conexao = new Conexao();
        $this->conn = $conexao->conectar();
    }

    public function cadastrarSessao($idSala, $idFilme, $dia, $horario, $audio)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO sessao (idSala, idFilme, dia, horario, audio) VALUES (?, ?, ?, ?, ?)");

            $stmt->bind_param("iisss", $idSala, $idFilme, $dia, $horario, $audio);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao cadastrar a sessão: " . $e->getMessage();
            return false;
        }
    }
}

?>