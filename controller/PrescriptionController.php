<?php

require '../config.php';

class PrescriptionController
{
    public function addPrescription($prescription)
    {
        $sql = "INSERT INTO prescription VALUES (NULL, :doctor_name, :website_name, :patient_name, :prescription_date, :prescription_text, :doctor_stamp)";
        $db = Config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'doctor_name' => $prescription->getDoctorName(),
                'website_name' => $prescription->getWebsiteName(),
                'patient_name' => $prescription->getPatientName(),
                'prescription_date' => $prescription->getPrescriptionDate(),
                'prescription_text' => $prescription->getPrescriptionText(),
                'doctor_stamp' => $prescription->getDoctorStamp()
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
            $prescriptions = $query->fetchAll();
            return $prescriptions;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }

    }

