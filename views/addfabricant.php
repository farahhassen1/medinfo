<?php

include '../controller/medicament_functions.php';
include '../model/fabricant.php';
$error = "";

// create fabricant
$fabricant = null;

// create an instance of the controller
$fabricantc = new fabricantc();
if (
    isset($_POST["nom_fabricant"]) &&
    isset($_POST["adress_fabricant"]) &&
    isset($_POST["contact"])
) {
    if (
        !empty($_POST["nom_fabricant"]) &&
        !empty($_POST["adress_fabricant"]) &&
        !empty($_POST["contact"])
    ) {
        $fabricant = new fabricant(
            null,
            $_POST['nom_fabricant'],
            $_POST['adress_fabricant'],
            $_POST['contact']
        );
        $fabricantc->addFabricant($fabricant);
        header('Location:medical.php');
    } 
}


?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="addmed.css">
    <title>Fabricant</title>
</head>

<body>
    <a href="medical.php">Back to list </a>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <form action="addfabricant.php" method="POST" id="compile">
        <table class="blue-white-table">
            <tr>
                <td><label for="nom_fabricant">fabricant Name :</label></td>
                <td>
                    <input type="text" id="nom_fabricant" oninput="validateName()" name="nom_fabricant" />
                    <span id="erreurNom"></span>
                </td>
            </tr>
            <tr>
                <td><label for="adress_fabricant">Adress Fabricant :</label></td>
                <td>
                    <textarea type="text" id="adress_fabricant" oninput="validateAdress()" name="adress_fabricant"></textarea>
                    <span id="erreurAdress" ></span>
                </td>
            </tr>
            <tr>
                <td><label for="contact">contact :</label></td>
                <td>
                    <input type="text" id="contact" oninput="validateContact()" name="contact" />
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
    <script src="fabricant1.js"></script>
</body>

</html>