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

    public function listarSessoesPorFilme($idFilme)
    {
        try {
            $query = "SELECT * FROM sessao WHERE idFilme = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $idFilme);

            if ($stmt->execute()) {
                $result = $stmt->get_result();
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

    public function listarSessaoPorId($idSessao)
    {
        try {
            $query = "SELECT s.*, f.nomeFilme AS nomeFilme, sa.numeroSala 
                  FROM sessao s 
                  JOIN filmes_cartaz f ON s.idFilme = f.idFilme 
                  JOIN salas sa ON s.idSala = sa.idSala 
                  WHERE s.idSessao = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $idSessao);

            if ($stmt->execute()) {
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();

                    $sessao = new SessaoModel(
                        $row['idSessao'],
                        $row['idFilme'],
                        $row['idSala'],
                        $row['dia'],
                        $row['horario'],
                        $row['audio']
                    );

                    $sessao->setNomeFilme($row['nomeFilme']);
                    $sessao->setNumeroSala($row['numeroSala']);

                    return $sessao;
                } else {
                    echo "Nenhuma sessão encontrada com o ID especificado.";
                    return null;
                }
            } else {
                echo "Erro ao recuperar a sessão do banco de dados.";
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
