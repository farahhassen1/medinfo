<?php

include '../Controller/RDVC.php';
include '../Model/RDV.php';
include "oindex.html";

$error = "";

// create client
$rdv = null;
// create an instance of the controller
$RDVC = new rdvC();

if (isset($_POST["date"]) && isset($_POST["heure"]) && isset($_POST["commentaire"]))
 {
    if (!empty($_POST['date']) && !empty($_POST['heure']) && !empty($_POST["commentaire"]))
     {
        /*foreach ($_POST as $key => $value) {
            echo "Key: $key, Value: $value<br>";
        }*/
        $rdv = new rdv( null, $_POST['date'], $_POST['heure'], $_POST['commentaire']);
        //var_dump($rdv);
        $RDVC->updateRDV($rdv, $_POST['idRDV']);
        //header('Location:listRDV.php');
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
    <button><a href="listRDV.php">Back to list</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_POST['idRDV'])) {
        $rdv = $RDVC->showRDV($_POST['idRDV']);  
    ?>

        <form action="" method="POST"onsubmit="return validerFormulaire(); ">
            <table>
            <tr>
                    <td><label for="nom">IdRDV :</label></td>
                    <td>
                        <input type="text" id="idRDV" name="idRDV" value="<?php echo $_POST['idRDV'] ?>" readonly />
                        <span id="erreurIdRDV" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="date">Date :</label></td>
                    <td>
                        <input type="date" id="date" name="date" value="<?php echo $rdv['date'] ?>" />
                        <span id="erreurDate" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="heure">Heure :</label></td>
                    <td>
                        <input type="time" id="heure" name="heure" value="<?php echo $rdv['heure'] ?>" />
                        <span id="erreurHeure" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="commentaire">Commentaire:</label></td>
                    <td>
                        <input type="text" id="commentaire" name="commentaire" value="<?php echo $rdv['commentaire'] ?>" />
                        <span id="erreurCommentaire" style="color: red"></span>
                    </td>
                </tr>
                <td>
                    <input type="submit" value="Save">
                </td>
                <td>
                    <input type="reset" value="Reset">
                </td>
            </table>

        </form>
    <?php
    }
    ?>
    <script src="ControleDeSaisie.js"> </script>
</body>

</html>