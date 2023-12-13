<?php
include '../controller/PrescriptionController.php';
$clientC = new PrescriptionController();
$clientC->deletePrescription($_GET["id"]);
header('Location:elements.php');
?>