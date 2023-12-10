
<!DOCTYPE html>
<html>
<head>
    <title>PDF Example</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Example</h1>
    
    <form method="post" action="generate-pdf.php">

        <tr>
            <td><label for="id_facture">Select Invoice:</label></td>
            <td>
                <select id="select" name="id_facture" > 
                    <?php
                    include '../controller/factureC.php';
                    include '../model/payement.php';
                    include '../model/facture.php';
                    $c2 = new factureC();
                    $tab2 = $c2->listFacture();
                    foreach($tab2 as $facture) {
                        ?>
                        <option value="<?= $facture["id_facture"];?>">
                            <?= $facture["id_facture"] . ' - ' . $facture["descreption"];?>
                        </option>
                        <?php
                        
                    }
                    ?>
                </select>
                <span id="erreurDate" style="color: red"></span>
            </td>
        </tr>

       
        
        <button>Generate PDF</button>
    </form>
</body>
</html>
