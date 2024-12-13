<?php

class SalaModel
{
    private $idSala;
    private $numeroSala;
    private $qtdPessoas;

    public function __construct($idSala, $numeroSala, $qtdPessoas)
    {
        $this->idSala = $idSala;
        $this->numeroSala = $numeroSala;
        $this->qtdPessoas = $qtdPessoas;        
    }

    public function getIdSala()
    {
        return $this->idSala;
    }

    public function getNumeroSala()
    {
        return $this->numeroSala;
    }

    public function getQtdPessoas()
    {
        return $this->qtdPessoas;
    }
}

?>