<?php

include '../controller/medicament_functions.php';
include '../model/medicament.php';
$error = "";

// create client
$medicament = null;
// create an instance of the controller
$medicamentc = new medicamentc();


if (
    isset($_POST["nom_medicament"]) &&
    isset($_POST["fabricant"]) &&
    isset($_POST["date_prescription"]) 
) {
    if (
        !empty($_POST['nom_medicament']) &&
        !empty($_POST["fabricant"]) &&
        !empty($_POST["date_prescription"]) 
    ) {
        foreach ($_POST as $key => $value) {
            echo "Key: $key, Value: $value<br>";
        }
        $medicament = new medicament(
            null,
            $_POST['nom_medicament'],
            $_POST['fabricant'],
            $_POST['date_prescription']
        );
        var_dump($medicament);
        
        $medicamentc->updateMedicament($medicament, $_POST['id_medicament']);

        header('Location:medical.php');
    } else
        $error = "Missing information";
}



?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Display</title>
</head>

<body>
    <button><a href="medical.php">Back to list</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_POST['id_medicament'])) {
        $medicament = $medicamentc->showMedicament($_POST['id_medicament']);
        
    ?>

        <form action="" method="POST">
            <table>
            <tr>
                    <td><label for="id_medicament">MEDICAL ID :</label></td>
                    <td>
                        <input type="text" id="id_medicament" name="id_medicament" value="<?php echo $_POST['id_medicament'] ?>" readonly />
                        <span id="erreurID" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="nom_medicament">Medical Name :</label></td>
                    <td>
                        <input type="text" id="nom_medicament" name="nom_medicament" value="<?php echo $medicament['nom_medicament'] ?>" />
                        <span id="erreurNom" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="fabricant">Fabricant :</label></td>
                    <td>
                        <input type="text" id="fabricant" name="fabricant" value="<?php echo $medicament['fabricant'] ?>" />
                        <span id="erreurfabricant" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="date_prescription">Date :</label></td>
                    <td>
                        <input type="date" id="date_prescription" name="date_prescription" value="<?php echo $medicament['date_prescription'] ?>" />
                        <span id="erreurdate_prescription" style="color: red"></span>
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
    <?php
    }
    ?>
    <script src="add.js"></script>
</body>

</html>