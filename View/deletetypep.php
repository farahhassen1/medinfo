<?php
include '../controller/PrescriptionController.php';
$clientC = new typepController ();
$clientC->deletetypep($_GET["idtype"]);
header('Location:backAnis.php');
?>