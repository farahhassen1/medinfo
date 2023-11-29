<?php
include "../controller/factureC.php";

$c = new factureC();
$tab = $c->listFacture();
$c2 = new payementC();
$tab2 = $c2->listPayement();

?>

<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="keywords" content="Site keywords here">
		<meta name="description" content="">
		<meta name='copyright' content=''>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
		
  <link rel="stylesheet" href="css/bootstrap.min.css">
  
<center>
    <h1>List of facture</h1>
    <h2>
        <a href="addFacture.php">Add facture</a>
    </h2>
</center>
<table class="tab" border="1" align="center" width="70%">
    <tr>
        <th>Id Facture</th>
        <th>montant</th>
        <th>date</th>
        <th>descreption</th>
       
        
    </tr>


    <?php
    foreach ($tab as $facture) {
    ?>




        <tr>
            <td><?= $facture['id_facture']; ?></td>
            <td><?= $facture['montant']; ?></td>
            <td><?= $facture['date_facture']; ?></td>
            <td><?= $facture['descreption']; ?></td>
           
            
           
           
        </tr>
    <?php
    }
    ?>
</table>






<!--///////////////////////////////////////////////////////payement/////!-->
<center>
    <h1>List of payement</h1>
    <h2>
        <a href="addpayement.php">Add payement</a>
    </h2>
</center>
<table class="tab" border="1" align="center" width="70%">
    <tr>
        <th>Id payement</th>
        <th>date_payement</th>
        <th>descreption</th>
        <th>image_mp</th>
        <th>id_facture</th>

        
     
    </tr>


    <?php
    foreach ($tab2 as $payement) {
    ?>




        <tr>
            <td><?= $payement['id_payement']; ?></td>
            <td><?= $payement['date_payement']; ?></td>
            <td><?= $payement['descreption']; ?></td>
            <td><?= $payement['image_mp']; ?></td>
            <td><?= $payement['id_facture']; ?></td>
           
           
           
            
          
           
            
        </tr>
    <?php
    }
    ?>
</table>
<a href="facture.php">go to admin space</a>