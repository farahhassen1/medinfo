<?php

include '../controller/medicament_functions.php';
include '../model/medicament.php';

$error = "";

// create medicament
$medicament = null;

// create an instance of the controller
$medicamentc = new medicamentc();
if (
    isset($_POST["nom_medicament"]) &&
    isset($_POST["fabricant"]) &&
    isset($_POST["date_prescription"])
) {
    if (
        !empty($_POST["nom_medicament"]) &&
        !empty($_POST["fabricant"]) &&
        !empty($_POST["date_prescription"])
    ) {
        $medicament = new medicament(
            null,
            $_POST['nom_medicament'],
            $_POST['fabricant'],
            $_POST['date_prescription']
        );
        $medicamentc->addMedicament($medicament);
        header('Location:medical.php');
    } else
        $error = "Missing information";
}


?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="addmed.css">
    <title>Medicals </title>
</head>

<body>
    <a href="medical.php">Back to list </a>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <form action="" method="POST">
        <table class="blue-white-table">
            <tr>
                <td><label for="nom_medicament">Medical Name :</label></td>
                <td>
                    <input type="text" id="nom_medicament" name="nom_medicament" />
                    <span id="erreurNom" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="fabricant">Fabricant :</label></td>
                <td>
                    <input type="text" id="fabricant" name="fabricant" />
                    <span id="erreurFabricant" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="date_prescription">Expiration Date :</label></td>
                <td>
                    <input type="date" id="date_prescription" name="date_prescription" />
                    <span id="erreurdate" style="color: red"></span>
                </td>
            </tr>


            <td>
                <input type="submit" onclick="valider()" value="Save">
            </td>
            <td>
                <input type="reset" value="Reset">
            </td>
        </table>

    </form>
    <script src="add.js"></script>
</body>

</html>