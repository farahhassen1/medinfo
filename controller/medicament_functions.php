<?php
require '../config2.php';

//Fabricants

class fabricantc
{
    public function listFabricant()
    {
        $sql = "SELECT * FROM fabricant";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addFabricant($fabricant)
    {
        $sql = "INSERT INTO fabricant  
        VALUES (NULL,:nom_fabricant, :adress_fabricant, :contact)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([ 
                'nom_fabricant' => $fabricant->getnom_fabricant(),
                'adress_fabricant' => $fabricant->getadress_fabricant(),
                'contact' => $fabricant->getcontact()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function deleteFabricant($id_fabricant)
    {
        $sql = "DELETE FROM fabricant WHERE id_fabricant = :id_fabricant";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_fabricant', $id_fabricant);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function showFabricant($id_fabricant)
    {
        $sql = "SELECT * from fabricant where id_fabricant = $id_fabricant";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $fabricant = $query->fetch();
            return $fabricant;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    
    function updateFabricant($fabricant, $id_fabricant)
    {   
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE fabricant SET 
                    nom_fabricant = :nom_fabricant, 
                    adress_fabricant = :adress_fabricant, 
                    contact = :contact
                WHERE id_fabricant= :id_fabricant'
            );
            
            $query->execute([
                'id_fabricant' => $id_fabricant,
                'nom_fabricant' => $fabricant->getnom_fabricant(),
                'adress_fabricant' => $fabricant->getadress_fabricant(),
                'contact' => $fabricant->getcontact()
            ]);
            
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}
/// MEDICALS
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
        VALUES (NULL,:nom_medicament, :id_fabricant, :date_prescription)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([ 
                'nom_medicament' => $medicament->getnom_medicament(),
                'id_fabricant' => $medicament->getid_fabricant(),
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
    
    function updateMedicament($medicament, $id_medicament)
    {   
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE medicament SET 
                    nom_medicament = :nom_medicament, 
                    id_fabricant = :id_fabricant, 
                    date_prescription = :date_prescription
                WHERE id_medicament= :id_medicament'
            );
            
            $query->execute([
                'id_medicament' => $id_medicament,
                'nom_medicament' => $medicament->getnom_medicament(),
                'id_fabricant' => $medicament->getid_fabricant(),
                'date_prescription' => $medicament->getdate_prescription()
            ]);
            
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}
?>