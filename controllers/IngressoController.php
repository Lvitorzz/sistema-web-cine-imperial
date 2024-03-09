<?php

require_once("../../db/Conexao.php");
require_once("../../models/IngressoModel.php");

class FilmeController
{
    private $conn;

    public function __construct()
    {
        $conexao = new Conexao();
        $this->conn = $conexao->conectar();
    }

    public function createIngresso($idFilme, $idSala, $idSessao, $valor, $tipo)
    {
        $sql = "INSERT INTO ingressos (idFilme, idSala, idSessao, valor, tipo) 
            VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iiids", $idFilme, $idSala, $idSessao, $valor, $tipo);

        return $stmt->execute();
    }
}
