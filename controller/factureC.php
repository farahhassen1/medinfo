<?php

require '../config.php';

class factureC
{

    public function listFacture()
    {
        $sql = "SELECT * FROM facture";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteFacture($id_facture)
    {
        $sql = "DELETE FROM facture WHERE id_facture  = :id_facture";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_facture', $id_facture);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    function addfacture($facture)
    {
        $sql = "INSERT INTO facture 
        VALUES (NULL, :montant, :date_facture, :descreption )";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'montant' => $facture->getMontant(),
                'date_facture' => $facture->getdate_facture(),
                'descreption' => $facture->getDescreption(),
                
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    function showFacture($id)
    {
        $sql = "SELECT * from facture where id_facture = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $facture = $query->fetch();
            return $facture;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updateFacture($facture, $id)
    {   
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE facture SET 
                    montant = :montant,
                    date_facture = :date_facture,
                    descreption = :descreption 
                WHERE id_facture= :id'
            );
            
            $query->execute([
                'id' => $id,  
                'montant' => $facture->getMontant(),
                'date_facture' => $facture->getDate_facture(),
                'descreption' => $facture->getDescreption()
        
            ]);
            
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}
