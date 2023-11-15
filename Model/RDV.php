<?php
class rdv
{
    private ?int $idRDV = null;
    private string $date ;
    private string $heure;
    private string $commentaire ;
    public function __construct($idRDV = null, $d, $h,$c)
    {
        $this->id = $idRDV;
        $this->date = $d;
        $this->heure = $h;
        $this->commentaire=$c;
    }
    public function getIdRDV()
    {
        return $this->idRDV;
    }
    public function getDate()
    {
        return $this->date;
    } 
    public function getHeure()
    {
        return $this->heure;
    }
    public function getCommentaire()
    {
        return $this->commentaire;
    }
    public function setIdRDV($idRDV)
    {
        $this->idRDV = $idRDV;
        return $this;
    }
    public function setDate($date)
    {
        $this->date=$date;
        return $this;
    } 
    public function setHeure($heure)
    {
        $this->heure=$heure;
        return $this;
    }
    public function setCommentaire($commentaire)
    {
        $this->commentaire=$commentaire;
        return $this;
    }
  
}
?>