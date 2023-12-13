<?php

include '../controller/medicament_functions.php';
include '../model/fabricant.php';
include '../model/medicament.php';

$c = new fabricantc();
$tab = $c->listFabricant();
$error = "";

// create medicament
$medicaments = null;

// create an instance of the controller
$medicamentc = new medicamentc();
if (
    isset($_POST["nom_medicament"]) &&
    isset($_POST["id_fabricant"]) &&
    isset($_POST["date_prescription"])
) {
    if (
        !empty($_POST["nom_medicament"]) &&
        !empty($_POST["id_fabricant"]) &&
        !empty($_POST["date_prescription"])
    ) {
        $medicaments = new medicaments(
            null,
            $_POST['nom_medicament'],
            $_POST['id_fabricant'],
            $_POST['date_prescription']
        );
        $medicamentc->addMedicament($medicaments);
        header('Location:medical.php');
    } 
}


?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fabricantadd.css">
    <title>Medicals</title>
</head>

<body>
    <a href="medical.php">Back to list</a>
    

    <div id="error">
        <?php echo $error; ?>
    </div>

    <form action="addmedicament.php" method="POST" id="compile">
        <table class="blue-white-table">
            <tr>
                <td><label for="nom_medicament">Medication Name :</label></td>
                <td>
                    <input type="text" id="nom_medicament" oninput="validateName()" name="nom_medicament" />
                    <span id="erreurNom"></span>
                </td>
            </tr>
            <tr>
                <td><label for="id_fabricant">Fabricant ID:</label></td>
                <td><select name="id_fabricant" id="id_fabricant" onchange="validateFabricant()">
                    <option>Select a fabricant</option>
                <?php
                foreach ($tab as $fabricant) {?>
                    <option value="<?= $fabricant['id_fabricant']; ?>">
                <?= $fabricant['nom_fabricant']; ?>
            </option>
                    <?php
                }?>
                </select>
                    <span id="erreurFabricant" ></span>
                </td>
            </tr>
            <tr>
                <td><label for="date_prescription">Expiration Date :</label></td>
                <td>
                    <input type="date" id="date_prescription" oninput="validateDate()" name="date_prescription" />
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
    <script src="add.js"></script>
</body>

</html>