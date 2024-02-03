<?php

class FilmeModel
{
    private $idFilme;
    private $nomeFilme;

    public function __construct($idFilme, $nomeFilme)
    {
        $this->idFilme = $idFilme;
        $this->nomeFilme = $nomeFilme;
        
    }

    public function getIdFilme()
    {
        return $this->idFilme;
    }

    public function getNomeFilme()
    {
        return $this->nomeFilme;
    }
}

?>