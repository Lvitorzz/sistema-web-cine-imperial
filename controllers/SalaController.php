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

    public function excluirSala($idSala)
{
    try {
        $stmt_check_sessions = $this->conn->prepare("SELECT COUNT(*) FROM sessao WHERE idSala = ?");
        $stmt_check_sessions->bind_param("i", $idSala);
        $stmt_check_sessions->execute();
        $stmt_check_sessions->bind_result($count);
        $stmt_check_sessions->fetch();
        $stmt_check_sessions->close();

        if ($count > 0) {
            echo "<script>alert('Não é possível excluir a sala porque existem sessões cadastradas para ela.');</script>";
            return false;
        }
        
        $stmt_delete_sala = $this->conn->prepare("DELETE FROM salas WHERE idSala = ?");
        $stmt_delete_sala->bind_param("i", $idSala);

        return $stmt_delete_sala->execute();
    } catch (PDOException $e) {
        echo "Erro ao excluir a sala: " . $e->getMessage();
        return false;
    }
}
}
