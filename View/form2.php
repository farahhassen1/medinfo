<!DOCTYPE html>
<html>
<head>
    <title>Generate QR Code</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Generate QR Code</h1>
    
    <form method="get" action="generate2.php">

        <tr>
            <td><label for="id_facture">Select Invoice:</label></td>
            <td>
                <select id="select" name="id_facture" > 
                    <?php
                    include '../controller/factureC.php';
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

        <button type="submit">Generate QR code</button>
    </form>
</body>
</html>