<?php

include '../controller/medicament_functions.php';
include '../model/fabricant.php';
$error = "";

// create client
$fabricant = null;
// create an instance of the controller
$fabricantc = new fabricantc();


if (
    isset($_POST["nom_fabricant"]) &&
    isset($_POST["adress_fabricant"]) &&
    isset($_POST["contact"]) 
) {
    if (
        !empty($_POST['nom_fabricant']) &&
        !empty($_POST["adress_fabricant"]) &&
        !empty($_POST["contact"]) 
    ) {
        foreach ($_POST as $key => $value) {
            echo "Key: $key, Value: $value<br>";
        }
        $fabricant = new fabricant(
            null,
            $_POST['nom_fabricant'],
            $_POST['adress_fabricant'],
            $_POST['contact']
        );
        var_dump($fabricant);
        
        $fabricantc->updateFabricant($fabricant, $_POST['id_fabricant']);

        header('Location:medical.php');
    } 
}



?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="addmed.css">
    <title>User Display</title>
</head>

<body>
    <button><a href="medical.php">Back to list</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_POST['id_fabricant'])) {
        $fabricant = $fabricantc->showFabricant($_POST['id_fabricant']);
        
    ?>

        <form action="updateFabricant.php" method="POST" id="compile">
            <table>
            <tr>
                    <td><label for="id_fabricant">Fabricant ID :</label></td>
                    <td>
                        <input type="text" id="id_fabricant" name="id_fabricant" value="<?php echo $_POST['id_fabricant'] ?>" readonly />
                        <span id="erreurID" ></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="nom_fabricant">fabricant Name :</label></td>
                    <td>
                        <input type="text" id="nom_fabricant" name="nom_fabricant" oninput="validateName()" value="<?php echo $fabricant['nom_fabricant'] ?>" />
                        <span id="erreurNom" ></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="adress_fabricant">Adress Fabricant :</label></td>
                    <td>
                        <input type="text" id="adress_fabricant" name="adress_fabricant" oninput="validateAdress()" value="<?php echo $fabricant['adress_fabricant'] ?>" />
                        <span id="erreurAdress"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="contact">contact :</label></td>
                    <td>
                        <input type="text" id="contact" name="contact" oninput="validateContact()" value="<?php echo $fabricant['contact'] ?>" />
                        <span id="erreurContact" ></span>
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
    <script src="fabricant1.js"></script>
</body>

</html>