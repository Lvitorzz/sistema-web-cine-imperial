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
}


?>