<?php
include '../controller/factureC.php';
$payementC = new payementC();
$payementC->deletepayement($_GET["id_payement"]);
header('Location:listFacture.php');
