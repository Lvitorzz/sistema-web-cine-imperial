<?php

class SessaoModel
{
    private $idSessao;
    private $idSala;
    private $idFilme;
    private $dia;
    private $horario;
    private $audio;
    private $nomeFilme;
    private $numeroSala;

    public function __construct($idSessao, $idFilme, $idSala, $dia, $horario, $audio)
    {
        $this->idSessao = $idSessao;
        $this->idFilme = $idFilme;
        $this->idSala = $idSala;
        $this->dia = $dia;      
        $this->horario = $horario;
        $this->audio = $audio;
    }

    public function getIdSessao()
    {
        return $this->idSessao;
    }

    public function getIdSala()
    {
        return $this->idSala;
    }

    public function getIdFilme()
    {
        return $this->idFilme;
    }

    public function getDia()
    {
        return $this->dia;
    }

    public function getHorario()
    {
        return $this->horario;
    }

    public function getAudio()
    {
        return $this->audio;
    }

    public function setNomeFilme($nomeFilme)
    {
        $this->nomeFilme = $nomeFilme;
    }

    public function getNomeFilme()
    {
        return $this->nomeFilme;
    }

    public function setNumeroSala($numeroSala)
    {
        $this->numeroSala = $numeroSala;
    }

    public function getNumeroSala()
    {
        return $this->numeroSala;
    }
    
}

?>