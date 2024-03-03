<?php

require_once("../../db/Conexao.php");
require_once("../../models/SessaoModel.php");

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

    public function listarSessoes()
    {
        try {
            $query = "SELECT * FROM sessao";
            $result = $this->conn->query($query);

            if ($result) {
                $sessoes = array();

                while ($row = $result->fetch_assoc()) {
                    $sessao = new SessaoModel(
                        $row['idSessao'],
                        $row['idFilme'],
                        $row['idSala'],
                        $row['dia'],
                        $row['horario'],
                        $row['audio']
                    );

                    $sessoes[] = $sessao;
                }

                return $sessoes;
            } else {
                echo "Erro ao recuperar as sessões do banco de dados.";
                return false;
            }
        } catch (PDOException $e) {
            echo "Erro ao executar a consulta: " . $e->getMessage();
            return false;
        }
    }

    public function excluirSessao($idSessao)
    {
        try {
            $stmt = $this->conn->prepare("DELETE FROM sessao WHERE idSessao = ?");
            $stmt->bind_param("i", $idSessao);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao excluir a sessão: " . $e->getMessage();
            return false;
        }
    }
}
