<?php

require_once("../../db/Conexao.php");
require_once("../../models/FilmeModel.php");

class FilmeController
{
    private $conn;

    public function __construct()
    {
        $conexao = new Conexao();
        $this->conn = $conexao->conectar();
    }

    public function cadastrarFilmeCartaz($nomeFilme)
    {
        $sql = "INSERT INTO filmes_cartaz (nomeFilme) 
                VALUES (?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $nomeFilme);

        return $stmt->execute();
    }

    public function cadastrarFilmeBreve($nomeFilme)
    {
        $sql = "INSERT INTO filmes_breve (nomeFilme) 
                VALUES (?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $nomeFilme);

        return $stmt->execute();
    }

    public function listarFilmesCartaz()
    {
        $filmes = array();
        $sql = "SELECT * FROM filmes_cartaz";
        $result = $this->conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            $filme = new FilmeModel(
                $row['idFilme'],
                $row['nomeFilme']
            );

            $filmes[] = $filme;
        }
        return $filmes;
    }

    public function listarFilmesBreve()
    {
        $filmes = array();
        $sql = "SELECT * FROM filmes_breve";
        $result = $this->conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            $filme = new FilmeModel(
                $row['idFilme'],
                $row['nomeFilme']
            );

            $filmes[] = $filme;
        }
        return $filmes;
    }

    public function excluirFilmeCartaz($idFilme)
    {
        try {
            $stmt = $this->conn->prepare("DELETE FROM filmes_cartaz WHERE idFilme = ?");
            $stmt->bind_param("i", $idFilme);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo "Erro ao excluir o filme cartaz: " . $e->getMessage();
            return false;
        }
    }

    public function excluirFilmeBreve($idFilme)
    {
        try {
            $stmt = $this->conn->prepare("DELETE FROM filmes_breve WHERE idFilme = ?");
            $stmt->bind_param("i", $idFilme);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo "Erro ao excluir o filme breve: " . $e->getMessage();
            return false;
        }
    }
}


?>