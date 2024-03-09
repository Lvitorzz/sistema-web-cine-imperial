<?php

class IngressoModel
{
    private $idIngresso;
    private $idFilme;
    private $idSala;
    private $idSessao;
    private $valor;

    public function __construct($idIngresso, $idFilme, $idSala, $idSessao, $valor)
    {
        $this->idIngresso = $idIngresso;
        $this->idFilme = $idFilme;
        $this->idSala = $idSala;
        $this->idSessao = $idSessao;
        $this->valor = $valor;
    }

    public function getIdIngresso()
    {
        return $this->idIngresso;
    }

    public function getIdFilme()
    {
        return $this->idFilme;
    }

    public function getIdSala()
    {
        return $this->idSala;
    }

    public function getIdSessao()
    {
        return $this->idSessao;
    }

    public function getValor()
    {
        return $this->valor;
    }
}
?>