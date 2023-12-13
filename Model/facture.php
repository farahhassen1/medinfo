<?php
class facture
{
    private ?int $id_facture = null;
    private ?string $montant= null;
    private ?string $date_facture = null;
    private ?string $descreption = null;
    private ?string $idRDV = null;
   
    

    public function __construct($id_facture = null, $montant,$date_facture, $descreption, $idRDV)
    {
        $this->id_facture = $id_facture;
        $this->montant = $montant;
        $this->date_facture = $date_facture;
        $this->descreption = $descreption;
        $this->idRDV = $idRDV;
       
        
        
    }


    public function getidFacture()
    {
        return $this->id_facture;
    }


    public function getMontant()
    {
        return $this->montant;
    }


    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }


    public function getdate_facture()
    {
        return $this->date_facture;
    }


    public function setdate_facture($date_facture)
    {
        $this->date_facture = $date_facture;

        return $this;
    }


    public function getDescreption()
    {
        return $this->descreption;
    }


    public function setDescreption($descreption)
    {
        $this->descreption = $descreption;

        return $this;
    }
    public function setIdRDV($idRDV)
    {
        $this->idRDV = $idRDV;
        return $this;
    }
    public function getIdRDV()
    {
        return $this->idRDV;
    }


    

  }
