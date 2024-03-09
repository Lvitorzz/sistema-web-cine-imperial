<?php

require_once("../../db/Conexao.php");
require_once("../../models/IngressoModel.php");

class IngressoController
{
    private $conn;

    public function __construct()
    {
        $conexao = new Conexao();
        $this->conn = $conexao->conectar();
    }

    public function createIngresso($idFilme, $idSala, $idSessao, $idCliente, $quantidade, $valorUnitario)
    {
        $valorTotal = $quantidade * $valorUnitario;
    
        $sql = "INSERT INTO ingressos (idFilme, idSala, idSessao, idCliente, quantidade, valorUnitario, valorTotal) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iiidddd", $idFilme, $idSala, $idSessao, $idCliente, $quantidade, $valorUnitario, $valorTotal);
    
        return $stmt->execute();
    }

    public function ingressosPorCliente($idCliente)
    {
        $sql = "
            SELECT
                i.idIngresso,
                f.nome AS nomeFilme,
                s.numero_sala AS numeroSala,
                se.tipo_audio AS tipoAudio,
                u.nome AS nomeCliente,
                se.data_hora AS dataSessao,
                se.horario AS horarioSessao
            FROM
                Ingressos i
                JOIN Filmes f ON i.idFilme = f.id_filme
                JOIN Salas s ON i.idSala = s.id_sala
                JOIN Sessoes se ON i.idSessao = se.id_sessao
                JOIN Usuarios u ON i.idCliente = u.id_usuario
            WHERE
                i.idCliente = ?;
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $idCliente);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $ingressos = array();
            while ($row = $result->fetch_assoc()) {
                $ingresso = new IngressoModel(
                    $row['idIngresso'],
                    $row['nomeFilme'],
                    $row['numeroSala'],
                    $row['tipoAudio'],
                    $row['nomeCliente'],
                    $row['dataSessao'],
                    $row['horarioSessao']
                );
                $ingressos[] = $ingresso;
            }

            return $ingressos;
        } else {
            return array();
        }
    }
}
