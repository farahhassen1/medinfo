<?php
class fabricants
{
    private ?int $id_fabricant = null;
    private ?string $nom_fabricant = null;
    private ?string $adress_fabricant = null;
    private ?string $contact = null;

    public function __construct($id_fabricant = null, $nom_fabricant, $adress_fabricant, $contact)
    {
        $this->id_fabricant = $id_fabricant;
        $this->nom_fabricant = $nom_fabricant;
        $this->adress_fabricant = $adress_fabricant;
        $this->contact = $contact;
    }
    
    public function getid_fabricant()
    {
        return $this->id_fabricant;
    }


    public function getnom_fabricant()
    {
        return $this->nom_fabricant;
    }


    public function setnom_fabricant($nom_fabricant)
    {
        $this->nom_fabricant = $nom_fabricant;

        return $this;
    }


    public function getadress_fabricant()
    {
        return $this->adress_fabricant;
    }


    public function setadress_fabricant($adress_fabricant)
    {
        $this->adress_fabricant = $adress_fabricant;

        return $this;
    }


    public function getcontact()
    {
        return $this->contact;
    }


    public function setcontact($contact)
    {
        $this->contact = $contact;

        return $this;
    }
}
?>