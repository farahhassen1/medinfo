<?php
include '../Controller/RDVC.php';
$RDVC = new rdvC();
$RDVC->deleteRDV($_GET["id"]);
header('Location:listRDV.php');
?>