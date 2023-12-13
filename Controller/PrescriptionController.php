<?php

require '../config.php';

class PrescriptionController
{
    public function addPrescription($prescription)
    {
        $sql = "INSERT INTO prescription VALUES (NULL, :doctor_name, :website_name, :patient_name, :prescription_date, :prescription_text, :doctor_stamp, :idtype)";
        $db = Config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'doctor_name' => $prescription->getDoctorName(),
                'website_name' => $prescription->getWebsiteName(),
                'patient_name' => $prescription->getPatientName(),
                'prescription_date' => $prescription->getPrescriptionDate(),
                'prescription_text' => $prescription->getPrescriptionText(),
                'doctor_stamp' => $prescription->getDoctorStamp(),
                'idtype' => $prescription->getidtype()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    function showPrescription($id)
    {
        $sql = "SELECT * from prescription where id = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $prescription = $query->fetch();
            return $prescription;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function updatePrescription($prescription, $id)
    {
        $sql = "UPDATE prescription SET
                doctor_name = :doctor_name,
                website_name = :website_name,
                patient_name = :patient_name,
                prescription_date = :prescription_date,
                prescription_text = :prescription_text,
                doctor_stamp = :doctor_stamp
                WHERE id = :id";

        $db = Config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'doctor_name' => $prescription->getDoctorName(),
                'website_name' => $prescription->getWebsiteName(),
                'patient_name' => $prescription->getPatientName(),
                'prescription_date' => $prescription->getPrescriptionDate(),
                'prescription_text' => $prescription->getPrescriptionText(),
                'doctor_stamp' => $prescription->getDoctorStamp(),
                'id' => $id
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function deletePrescription($id)
    {
        $sql = "DELETE FROM prescription WHERE id = :id";
        $db = Config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function listPrescriptions()
    {
        $sql = "SELECT * FROM prescription";
        $db = Config::getConnexion();
    
        try {
            $query = $db->query($sql);
            $prescriptions = $query ->fetchAll();
            // Return the PDOStatement object directly
            return $prescriptions;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return false; // Return false or handle the error appropriately
        }
    }



    }

class typepController
{
    public function addtypep($typep)
    {
        $sql = "INSERT INTO typep VALUES (NULL, :typename,:typedescription)";
        $db = Config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'typename' => $typep->gettypeName(),
                'typedescription' => $typep->gettypedescription(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    function showtypep($idtype)
    {
        $sql = "SELECT * from typep where idtype = $idtype";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $typep = $query->fetch();
            return $typep;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function updatetypep($typep, $idtype)
    {
        $sql = "UPDATE typep SET
                typename = :typename,
                typedescription = :typedescription
                WHERE idtype = :idtype";

        $db = Config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'typename' => $typep->gettypename(),
                'typedescription' => $typep->gettypedescription(),
                'idtype' => $idtype
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function deletetypep($idtype)
    {
        $sql = "DELETE FROM typep WHERE idtype = :idtype";
        $db = Config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute(['idtype' => $idtype]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMsessage();
        }
    }

       
    public function listtypep()
{
    $sql = "SELECT idtype, typename, typedescription FROM typep";
    $db = Config::getConnexion();

    try {
        $query = $db->query($sql);
        $types = $query->fetchAll(PDO::FETCH_ASSOC);
        return $types;
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
        return [];
    }
}

    }