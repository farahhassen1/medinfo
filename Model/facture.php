<?php
class facture
{
    private ?int $id_facture = null;
    private ?string $montant= null;
    private ?string $date_facture = null;
    private ?string $descreption = null;
   
    

    public function __construct($id_facture = null, $montant,$date_facture, $descreption)
    {
        $this->id_facture = $id_facture;
        $this->montant = $montant;
        $this->date_facture = $date_facture;
        $this->descreption = $descreption;
       
        
        
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
    


    

  }
