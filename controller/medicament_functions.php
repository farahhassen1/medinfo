<?php
require '../config2.php';
class medicamentc
{
    public function listMedicament()
    {
        $sql = "SELECT * FROM medicament";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addMedicament($medicament)
    {
        $sql = "INSERT INTO medicament  
        VALUES (NULL,:nom_medicament, :fabricant, :date_prescription)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([ 
                'nom_medicament' => $medicament->getnom_medicament(),
                'fabricant' => $medicament->getfabricant(),
                'date_prescription' => $medicament->getdate_prescription()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function deleteMedicament($id_medicament)
    {
        $sql = "DELETE FROM medicament WHERE id_medicament = :id_medicament";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_medicament', $id_medicament);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function showMedicament($id_medicament)
    {
        $sql = "SELECT * from medicament where id_medicament = $id_medicament";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $medicament = $query->fetch();
            return $medicament;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    /*function updateJoueur($joueur, $id)
    {   
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE joueur SET 
                    nom = :nom, 
                    prenom = :prenom, 
                    email = :email, 
                    tel = :tel
                WHERE id= :idJoueur'
            );
            
            $query->execute([
                'idJoueur' => $id,
                'nom' => $joueur->getNom(),
                'prenom' => $joueur->getPrenom(),
                'email' => $joueur->getEmail(),
                'tel' => $joueur->getTel(),
            ]);
            
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }*/
    function updateMedicament($medicament, $id_medicament)
    {   
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE medicament SET 
                    nom_medicament = :nom_medicament, 
                    fabricant = :fabricant, 
                    date_prescription = :date_prescription
                WHERE id_medicament= :id_medicament'
            );
            
            $query->execute([
                'id_medicament' => $id_medicament,
                'nom_medicament' => $medicament->getnom_medicament(),
                'fabricant' => $medicament->getfabricant(),
                'date_prescription' => $medicament->getdate_prescription()
            ]);
            
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}
?>