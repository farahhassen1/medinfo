<?php

include '../Controller/RDVC.php';
include '../Model/RDV.php';
$error = "";

// create client
$rdv = null;

// create an instance of the controller
$RDVC = new rdvC();
if (isset($_POST["date"]) && isset($_POST["heure"]) && isset($_POST["commentaire"]))
 {
    if (!empty($_POST['date']) && !empty($_POST['heure']) && !empty($_POST["commentaire"]))
     {
        $rdv = new rdv( null, $_POST['date'], $_POST['heure'], $_POST['commentaire']);
        $RDVC->addRDV($rdv);
        header('Location:listRDV.php');
    } else
        $error = "Missing information";
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {background-color: #f9f8f8; }
        img {border-radius: 8px;}
        .intro{ width:300px;margin:0 auto;}
  </style>
    <title>Rendez-vous</title>
</head>

<body>
    <a href="listRDV.php">Back to list </a>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>
    <h2 style="color:darkblue">Prendre un Rendez-vous</h2>
    <div>
        <form action="" method="POST">
            <table align="center">
                <tr>
                    <td><label for="date">date :</label></td>
                    <td>
                        <input type="date" id="date" name="date" required/>
                        <span id="erreurdate" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="heure">Heure:</label></td>
                    <td>
                        <input type="time" id="heure" name="heure" />
                        <span id="erreurheure" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="commentaire">commentaire :</label></td>
                    <td>
                        <input type="text" id="commentaire" name="commentaire" />
                        <span id="erreurcommentaire" style="color: red"></span>
                    </td>
                </tr>
            
                <td>
                    <input id="validerButton"type="submit" value="Save">
                </td>
                <td>
                    <input type="reset" value="Reset">
                </td>
            </table>
        </form>
    </div>
    <div class="intro">
        <img src="image1.png" alt="" style="width:400px">
    </div>
    <script src="index.js"> </script>
</body>

</html>
?>