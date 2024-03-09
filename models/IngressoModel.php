<?php

class IngressoModel
{
    private $idIngresso;
    private $nomeFilme;
    private $numeroSala;
    private $tipoAudio;
    private $nomeCliente;
    private $dataSessao;
    private $horarioSessao;

    public function __construct($idIngresso, $nomeFilme, $numeroSala, $tipoAudio, $nomeCliente, $dataSessao, $horarioSessao)
    {
        $this->idIngresso = $idIngresso;
        $this->nomeFilme = $nomeFilme;
        $this->numeroSala = $numeroSala;
        $this->tipoAudio = $tipoAudio;
        $this->nomeCliente = $nomeCliente;
        $this->dataSessao = $dataSessao;
        $this->horarioSessao = $horarioSessao;
    }

    public function getIdIngresso()
    {
        return $this->idIngresso;
    }

    public function getNomeFilme()
    {
        return $this->nomeFilme;
    }

    public function getNumeroSala()
    {
        return $this->numeroSala;
    }

    public function getTipoAudio()
    {
        return $this->tipoAudio;
    }

    public function getNomeCliente()
    {
        return $this->nomeCliente;
    }

    public function getDataSessao()
    {
        return $this->dataSessao;
    }

    public function getHorarioSessao()
    {
        return $this->horarioSessao;
    }
}
?>