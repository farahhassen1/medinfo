<?php

include '../controller/factureC.php';
include '../model/facture.php';
$error = "";

// create client
$facture = null;
// create an instance of the controller
$factureC = new factureC();

if (
    isset($_POST["montant"]) &&
    isset($_POST["date_facture"]) &&
    isset($_POST["descreption"])
) {
    if (
        !empty($_POST['montant']) &&
        !empty($_POST["date_facture"]) &&
        !empty($_POST["descreption"])
    ) {
        foreach ($_POST as $key => $value) {
            echo "Key: $key, Value: $value<br>";
        }
        $facture = new facture(
            null,
            $_POST['montant'],
            $_POST['date_facture'],
            $_POST['descreption']
        );
        var_dump($facture);
        
        $factureC->updatefacture($facture, $_POST['id_facture']);

        header('Location:facture.php');
    } else {
        $error = "Missing information";
    }
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Display</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="css/nice-select.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- icofont CSS -->
    <link rel="stylesheet" href="css/icofont.css">
    <!-- Slicknav -->
    <link rel="stylesheet" href="css/slicknav.min.css">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="css/owl-carousel.css">
    <!-- Datepicker CSS -->
    <link rel="stylesheet" href="css/datepicker.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="css/animate.min.css">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="css/magnific-popup.css">

    <!-- Medipro CSS -->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">

</head>

<body>
    <!-- Header Area -->
    <header class="header">
        <!-- Topbar -->
        <div class="topbar">
            <!-- ... Your existing topbar code ... -->
        </div>
        <!-- End Topbar -->
        <!-- Header Inner -->
        <div class="header-inner">
            <!-- ... Your existing header code ... -->
        </div>
        <!--/ End Header Inner -->
    </header>
    <!-- End Header Area -->

    <button><a href="listFacture.php">Back to list</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_POST['id_facture'])) {
        $facture = $factureC->showFacture($_POST['id_facture']);
    ?>

    <form action="" method="POST" id="myForm">
        <table>
            <tr>
                <td><label for="id_facture">id_facture:</label></td>
                <td>
                    <input type="text" id="id_" name="id_facture" value="<?php echo $_POST['id_facture'] ?>" readonly />
                    <span id="erreurNom" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="montant">montant:</label></td>
                <td>
                    <input type="text" id="montant" name="montant" placeholder="<?php echo $facture['montant'] ?>" oninput="validerMontant()" />
                    <span id="erreurMontant" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="descreption">descreption :</label></td>
                <td>
                    <textarea id="descreption" name="descreption" placeholder="<?php echo $facture['descreption'] ?>" oninput="validerDescription()"></textarea>
                    <span id="erreurDescription" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="date">date_facture :</label></td>
                <td>
                    <input type="date" id="date" name="date_facture" placeholder="<?php echo $facture['date_facture'] ?>" oninput="validerDate()" />
                    <span id="erreurDate" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" value="Save" >
                    <input type="reset" value="Reset">
                </td>
            </tr>
        </table>
    </form>

    <?php
    }
    ?>
    <script src="control.js"></script>
</body>

</html>
