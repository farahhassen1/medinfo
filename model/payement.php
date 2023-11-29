<?php
class payement
{
    private ?int $id_payement = null;
    private ?string $date_payement= null;
    private ?string $descreption = null;
    private ?string $image_mp = null;
    private ?int $id_facture = null;

    
    

    public function __construct($id_payement = null, $date_payement,$descreption, $image_mp,$id_facture)
    {
        $this->id_payement = $id_payement;
        $this->date_payement= $date_payement;
        $this->descreption = $descreption;
        $this->image_mp = $image_mp;
        $this->id_facture = $id_facture;
       
        
        
        
    }


    public function getid_payement()
    {
        return $this->id_payement;
    }


    public function getdate_payement()
    {
        return $this->date_payement;
    }


    public function setdate_payement($date_payement)
    {
        $this->date_payement = $date_payement;

        return $this;
    }


    public function getdescreption()
    {
        return $this->descreption;
    }


    public function setdescreption($descreption)
    {
        $this->descreption = $descreption;

        return $this;
    }


    public function getimage_mp()
    {
        return $this->image_mp;
    }


    public function setimage_mp($image_mp)
    {
        $this->image_mp = $image_mp;

        return $this;
    }
    public function getid_facture()
    {
        return $this->id_facture;
    }


    public function setid_facture($id_facture)
    {
        $this->id_facture = $id_facture;

        return $this;
    }
    

    

  }
