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
                'descreption' => $facture->getDescreption()
               
                
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

    function updateFacture($facture, $id_facture)
    {   
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE facture SET 
                    montant = :montant,
                    date_facture = :date_facture,
                    descreption = :descreption
                WHERE id_facture= :id_facture'
            );
            
            $query->execute([
                'id_facture' => $id_facture,  
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


///////////////////////////////////////////////payement///////////////////
class payementC
{
    public function listPayement()
    {
        $sql = "SELECT * FROM payement";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    function addpayement($payement)
    {
        $sql = "INSERT INTO payement
        VALUES (NULL, :date_payement, :descreption, :image_mp, :id_facture)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'date_payement' => $payement->getdate_payement(),
                'descreption' => $payement->getdescreption(),
                'image_mp' => $payement->getimage_mp(),
                'id_facture' => $payement->getid_facture()
               

                
                
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    function showpayement($id_payement)
    {
        $sql = "SELECT * from payement where id_payement = $id_payement";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $payement = $query->fetch();
            return $payement;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    function updatepayement($payement, $id_payement)
    {   
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE payement SET 
                    date_payement = :date_payement,
                    descreption = :descreption,
                    image_mp = :image_mp
                WHERE id_payement= :id_payement'
            );
            
            $query->execute([
                'id_payement' => $id_payement,  
                'date_payement' => $payement->getdate_payement(),
                'descreption' => $payement->getdescreption(),
                'image_mp' => $payement->getimage_mp()
               
        
            ]);
            
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
    function deletepayement($id_payement)
    {
        $sql = "DELETE FROM payement WHERE id_payement  = :id_payement";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_payement', $id_payement);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

}