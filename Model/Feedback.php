<?php
class feedback
{
    private ?int $idFeedback = null;
    private string $date ;
    private string $commentaire ;
    private ?int $rdv= null;
    public function __construct($idFeedback = null, $d,$c,$r)
    {
        $this->idFeedback = $idFeedback;
        $this->date = $d;
        $this->commentaire=$c;
        $this->rdv=$r;
    }
    public function getIdFeedback()
    {
        return $this->idFeedback;
    }
    public function setIdFeedback($idFeedback)
    {
        $this->idFeedback=$idFeedback;
        return $this;
    }
    public function getDate()
    {
        return $this->date;
    }
    public function getRDV()
    {
        return $this->rdv;
    }
    public function setDate($date)
    {
        $this->date=$date;
        return $this;
    }
    public function getCommentaire()
    {
        return $this->commentaire;
    }
    public function setCommentaire($commentaire)
    {
        $this->commentaire=$commentaire;
        return $this;
    }
    public function setRDV($rdv)
    {
        $this->rdv=$rdv;
        return $this;
    }
}
?>