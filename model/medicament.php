<?php
class medicament
{
    private ?int $id_medicament = null;
    private ?string $nom_medicament = null;
    private ?string $fabricant = null;
    private ?string $date_prescription = null;

    public function __construct($id_medicament = null, $nom_medicament, $fabricant, $date_prescription)
    {
        $this->id_medicament = $id_medicament;
        $this->nom_medicament = $nom_medicament;
        $this->fabricant = $fabricant;
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


    public function getfabricant()
    {
        return $this->fabricant;
    }


    public function setfabricant($fabricant)
    {
        $this->fabricant = $fabricant;

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