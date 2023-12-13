<?php
require '../config.php';

//Fabricants

class fabricantc
{
    public function listFabricant()
    {
        $sql = "SELECT * FROM fabricants";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addFabricant($fabricants)
    {
        $sql = "INSERT INTO fabricants  
        VALUES (NULL,:nom_fabricant, :adress_fabricant, :contact)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([ 
                'nom_fabricant' => $fabricants->getnom_fabricant(),
                'adress_fabricant' => $fabricants->getadress_fabricant(),
                'contact' => $fabricants->getcontact()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function deleteFabricant($id_fabricant)
    {
        $sql = "DELETE FROM fabricants WHERE id_fabricant = :id_fabricant";
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
        $sql = "SELECT * from fabricants where id_fabricant = $id_fabricant";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $fabricants = $query->fetch();
            return $fabricants;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    
    function updateFabricant($fabricants, $id_fabricant)
    {   
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE fabricants SET 
                    nom_fabricant = :nom_fabricant, 
                    adress_fabricant = :adress_fabricant, 
                    contact = :contact
                WHERE id_fabricant= :id_fabricant'
            );
            
            $query->execute([
                'id_fabricant' => $id_fabricant,
                'nom_fabricant' => $fabricants->getnom_fabricant(),
                'adress_fabricant' => $fabricants->getadress_fabricant(),
                'contact' => $fabricants->getcontact()
            ]);
            
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function searchFabricant($search_term) {

        // Prepare the SQL statement to search for fabricants
        $stmt = $pdo->prepare("SELECT * FROM fabricants WHERE nom_fabricant LIKE :search");
        $stmt->bindValue(':search', '%' . $search_term . '%');
        $stmt->execute();

        // Fetch fabricant data
        $filtered_results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $filtered_results;
    }
}
/// MEDICALS
class medicamentc
{
    
    public function listMedicament()
    {
        $sql = "SELECT * FROM medicaments";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addMedicament($medicaments)
    {
        $sql = "INSERT INTO medicaments
        VALUES (NULL,:nom_medicament, :id_fabricant, :date_prescription)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([ 
                'nom_medicament' => $medicaments->getnom_medicament(),
                'id_fabricant' => $medicaments->getid_fabricant(),
                'date_prescription' => $medicaments->getdate_prescription()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function deleteMedicament($id_medicament)
    {
        $sql = "DELETE FROM medicaments WHERE id_medicament = :id_medicament";
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
        $sql = "SELECT * from medicaments where id_medicament = $id_medicament";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $medicaments = $query->fetch();
            return $medicaments;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    
    function updateMedicament($medicaments, $id_medicament)
    {   
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE medicaments SET 
                    nom_medicament = :nom_medicament, 
                    id_fabricant = :id_fabricant, 
                    date_prescription = :date_prescription
                WHERE id_medicament= :id_medicament'
            );
            
            $query->execute([
                'id_medicament' => $id_medicament,
                'nom_medicament' => $medicaments->getnom_medicament(),
                'id_fabricant' => $medicaments->getid_fabricant(),
                'date_prescription' => $medicaments->getdate_prescription()
            ]);
            
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}
?>