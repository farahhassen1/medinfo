<?php
include "../controller/factureC.php";

$c = new factureC();
$tab = $c->listFacture();

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
        <th>Update</th>
        <th>Delete</th>
     
    </tr>


    <?php
    foreach ($tab as $facture) {
    ?>




        <tr>
            <td><?= $facture['id_facture']; ?></td>
            <td><?= $facture['montant']; ?></td>
            <td><?= $facture['date_facture']; ?></td>
            <td><?= $facture['descreption']; ?></td>
           
            
           
            <td align="center">
                <form method="POST" action="updatefacture.php">
                    <input type="submit" name="update" value="Update">
                    <input type="hidden" value=<?PHP echo $facture['id_facture']; ?> name="id_facture">
                </form>
            </td>
            <td>
                <a class="btn" href="deleteFacture.php?id_facture=<?php echo $facture['id_facture']; ?>">Delete</a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>