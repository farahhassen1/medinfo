<?php
 class comment {
    private ?int $idcomment = null;
    private string $datepublicomment;
    private string $contenucomment;
    private int $idarticle;
    

    public function __construct($idcomment, $datepublicomment, $contenucomment, $idarticle) {
        $this->idcomment = $idcomment;
        $this->datepublicomment = $datepublicomment;
        $this->contenucomment = $contenucomment;
        $this->idarticle = $idarticle;
       
    }
 
    




    public function getidarticle()
    {
        return $this->idarticle;
    }

    public function setidarticle($idarticle)
    {
        $this->idarticle = $idarticle;

        return $this;
    }

    public function getidcomment()
    {
        return $this->idcomment;
    }


    public function getdatepublicomment()
    {
        return $this->datepublicomment;
    }


    public function setdatepublicomment($datepublicomment)
    {
        $this->datepublicomment = $datepublicomment;

        return $this;
    }


    public function getcontenucomment()
    {
        return $this->contenucomment;
    }


    public function setcontenucomment($contenucomment)
    {
        $this->contenucomment = $contenucomment;

        return $this;
    }

}
