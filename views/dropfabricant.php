<?php

include '../controller/medicament_functions.php';
$fabricantc = new fabricantc();
$fabricantc->deleteFabricant($_GET["id_fabricant"]);
header('Location:medical.php');
?>