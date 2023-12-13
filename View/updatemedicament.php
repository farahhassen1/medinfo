<?php

include '../controller/medicament_functions.php';
include '../model/fabricant.php';
include '../model/medicament.php';
$c = new fabricantc();
$tab = $c->listFabricant();
$error = "";

// create client
$medicament = null;
// create an instance of the controller
$medicamentc = new medicamentc();


if (
    isset($_POST["nom_medicament"]) &&
    isset($_POST["id_fabricant"]) &&
    isset($_POST["date_prescription"]) 
) {
    if (
        !empty($_POST['nom_medicament']) &&
        !empty($_POST["id_fabricant"]) &&
        !empty($_POST["date_prescription"]) 
    ) {
        foreach ($_POST as $key => $value) {
            echo "Key: $key, Value: $value<br>";
        }
        $medicament = new medicaments(
            null,
            $_POST['nom_medicament'],
            $_POST['id_fabricant'],
            $_POST['date_prescription']
        );
        var_dump($medicament);
        
        $medicamentc->updateMedicament($medicament, $_POST['id_medicament']);

        header('Location:medical.php');
    } 
}



?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fabricantadd.css">
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

        <form action="updatemedicament.php" method="POST" id="compile">
            <table  class="blue-white-table">
            <tr>
                    <td><label for="id_medicament">Medication ID :</label></td>
                    <td>
                        <input type="text" id="id_medicament" name="id_medicament" value="<?php echo $_POST['id_medicament'] ?>" readonly />
                        <span id="erreurID" ></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="nom_medicament">Medication Name :</label></td>
                    <td>
                        <input type="text" id="nom_medicament" name="nom_medicament" value="<?php echo $medicament['nom_medicament'] ?>" />
                        <span id="erreurNom" ></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="id_fabricant">Fabricant ID:</label></td>
                <td><select name="id_fabricant">
                <?php
                foreach ($tab as $fabricant) {?>
                    <option value="<?= $fabricant['id_fabricant']; ?>">
                <?= $fabricant['nom_fabricant']; ?>
            </option>
                    <?php
                }?>
                </select>
                        <span id="erreurFabricant"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="date_prescription">Date :</label></td>
                    <td>
                        <input type="date" id="date_prescription" name="date_prescription" value="<?php echo $medicament['date_prescription'] ?>" />
                        <span id="erreurdate" ></span>
                    </td>
                </tr>


                <td>
                    <input type="submit" onclick="valider()" value="Save">
                </td>
                <td>
                    <input type="reset" value="Reset" onclick="clearErrors()">
                </td>
            </table>

        </form>
    <?php
    }
    ?>
    <script src="add.js"></script>
</body>

</html>