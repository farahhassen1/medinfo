<?php

include '../controller/medicament_functions.php';
$medicamentc = new medicamentc();
$medicamentc->deleteMedicament($_GET["id_medicament"]);
header('Location:medical.php');
?>