<?php
require '../config.php';
class rdvC
{
    public function listRDV()
    {
        $sql = "SELECT * FROM rdv";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        }
        catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    } 
    function deleteRDV($ide)
    {
        $sql = "DELETE FROM rdv WHERE idRDV = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $ide);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    function addRDV($rdv)
    {
        $sql = "INSERT INTO  rdv VALUES (NULL, :date,:heure, :commentaire)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'date' => $rdv->getDate(),
                'heure' => $rdv->getHeure(),
                'commentaire' => $rdv->getCommentaire(), 
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    function showRDV($id)
    {
        $sql = "SELECT * from rdv where idRDV = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $rdv = $query->fetch();
            return $rdv;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updateRDV($rdv,$id)
    {   
        try {
            $sql ='UPDATE rdv SET date = :date,  heure = :heure, commentaire = :commentaire WHERE idRDV= :id';
            $db = config::getConnexion();
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $id,
                'date' => $rdv->getDate(),
                'heure' => $rdv->getHeure(),
                'commentaire' => $rdv->getCommentaire(),
            ]); 
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
   
}
?>