<?php

require_once("../../db/Conexao.php");
require_once("../../models/SalaModel.php");

class SalaController
{
    private $conn;

    public function __construct()
    {
        $conexao = new Conexao();
        $this->conn = $conexao->conectar();
    }

    public function cadastrarSala($numeroSala, $qtdPessoas)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO salas (numeroSala, qtdPessoas) VALUES (?, ?)");

            $stmt->bind_param("ii", $numeroSala, $qtdPessoas);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao cadastrar a sala: " . $e->getMessage();
            return false;
        }
    }

    public function listarSalas()
    {
        try {
            $query = "SELECT * FROM salas";
            $result = $this->conn->query($query);

            if ($result) {
                $salas = array();

                while ($row = $result->fetch_assoc()) {
                    $sala = new SalaModel(
                        $row['idSala'],
                        $row['numeroSala'],
                        $row['qtdPessoas']
                    );
                
                    $salas[] = $sala;
                }

                return $salas;
            } else {
                echo "Erro ao listar salas do banco de dados.";
                return false;
            }
        } catch (PDOException $e) {
            echo "Erro ao executar a consulta: " . $e->getMessage();
            return false;
        }
    }

    public function excluirSala($idsala)
    {
        try {
            $stmt = $this->conn->prepare("DELETE FROM salas WHERE idSala = ?");
            $stmt->bind_param("i", $idSala);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao excluir a sala: " . $e->getMessage();
            return false;
        }
    }
}
