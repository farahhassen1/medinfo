<?php
class article {
    private ?int $idarticle = null;
    private string $titrearticle;
    private string $contenuarticle;
    private string $datepubliarticle;
    private int $id_user;

    public function __construct($idarticle, $titrearticle, $contenuarticle, $datepubliarticle, $id_user) {
        $this->idarticle = $idarticle;
        $this->titrearticle = $titrearticle;
        $this->contenuarticle = $contenuarticle;
        $this->datepubliarticle = $datepubliarticle;
        $this->id_user = $id_user;
    }
 
    public function getidarticle()
    {
        return $this->idarticle;
    }


    public function getdatepubliarticle()
    {
        return $this->datepubliarticle;
    }

    

    public function setdatepubliarticle($datepubliarticle)
    {
        $this->datepubliarticle = $datepubliarticle;

        return $this;
    }


    public function gettitrearticle()
    {
        return $this->titrearticle;
    }


    public function settitrearticle($titrearticle)
    {
        $this->titrearticle = $titrearticle;

        return $this;
    }


    public function getcontenuarticle()
    {
        return $this->contenuarticle;
    }


    public function setcontenuarticle($contenuarticle)
    {
        $this->contenuarticle = $contenuarticle;

        return $this;
    }


    public function getiduser()
    {
        return $this->id_user;
    }


    public function setiduser($id_user)
    {
        $this->id_user = $id_user;

        return $this;
    }

}
