<?php
include '../controller/factureC.php';
$factureC = new factureC();
$factureC->deleteFacture($_GET["id_facture"]);
header('Location:facture.php');
