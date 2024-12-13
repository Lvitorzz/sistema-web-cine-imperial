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
            f.nomeFilme AS nomeFilme,
            s.numeroSala AS numeroSala,
            se.audio AS tipoAudio,
            u.nome AS nomeCliente,
            se.dia AS dataSessao,
            se.horario AS horarioSessao,
            i.quantidade,
            i.valorTotal
        FROM
            ingressos i
            JOIN filmes_cartaz f ON i.idFilme = f.idFilme
            JOIN salas s ON i.idSala = s.idSala
            JOIN sessao se ON i.idSessao = se.idSessao
            JOIN clientes u ON i.idCliente = u.id
        WHERE
            i.idCliente = ?;";

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
                    $row['horarioSessao'],
                    $row['quantidade'],
                    $row['valorTotal']
                );
                $ingressos[] = $ingresso;
            }

            return $ingressos;
        } else {
            return array();
        }
    }
}
