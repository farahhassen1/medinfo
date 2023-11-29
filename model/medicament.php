<?php
class medicament
{
    private ?int $id_medicament = null;
    private ?string $nom_medicament = null;
    private ?int $id_fabricant = null;
    private ?string $date_prescription = null;

    public function __construct($id_medicament = null, $nom_medicament, $id_fabricant, $date_prescription)
    {
        $this->id_medicament = $id_medicament;
        $this->nom_medicament = $nom_medicament;
        $this->id_fabricant = $id_fabricant;
        $this->date_prescription = $date_prescription;
    }
    
    public function getid_medicament()
    {
        return $this->id_medicament;
    }


    public function getnom_medicament()
    {
        return $this->nom_medicament;
    }


    public function setnom_medicament($nom_medicament)
    {
        $this->nom_medicament = $nom_medicament;

        return $this;
    }


    public function getid_fabricant()
    {
        return $this->id_fabricant;
    }


    public function setid_fabricant($id_fabricant)
    {
        $this->id_fabricant = $id_fabricant;

        return $this;
    }


    public function getdate_prescription()
    {
        return $this->date_prescription;
    }


    public function setdate_prescription($date_prescription)
    {
        $this->date_prescription = $date_prescription;

        return $this;
    }
}
?>