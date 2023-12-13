<?php

include '../controller/factureC.php';
include '../model/payement.php';
include '../model/facture.php';
$error = "";

// create client
$payement = null;
// create an instance of the controller
$payementC = new payementC();

if (
    isset($_POST["date_payement"]) &&
    isset($_POST["descreption"]) &&
    isset($_POST["image_mp"]) &&
    isset($_POST["id_facture"]) 
   
) {
    if (
        !empty($_POST['date_payement']) &&
        !empty($_POST["descreption"]) &&
        !empty($_POST["image_mp"])&&
        !empty($_POST["id_facture"])
        
    ) {
        foreach ($_POST as $key => $value) {
            echo "Key: $key, Value: $value<br>";
        }
        $payement = new payement(
            null,
            $_POST['date_payement'],
            $_POST['descreption'],
            $_POST['image_mp'],
            $_POST['id_facture']
           
        );
        var_dump($payement);
        
        $payementC->updatepayement($payement, $_POST['id_payement']);

        header('Location:listpayement.php');
    } else
        $error = "Missing information";
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
    <button><a href="listFacture.php">Back to list</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_POST['id_payement'])) {
        $payement = $payementC->showpayement($_POST['id_payement']);
        
    ?>

        <form action="" method="POST">
            <table class="blue-white-table" >
            <tr>
                    <td><label for="id_facture">id_facture :</label></td>
                    <td>
                        <input type="int" id="id_facture" name="id_facture" value="<?php echo $payement['id_facture'] ?>" readonly/>
                        <span id="erreurDid" style="color: red"></span>
                    </td>
                </tr>
            <tr>
                    <td><label for="nom">id_payement:</label></td>
                    <td>
                        <input type="text" id="id_" name="id_payement" value="<?php echo $_POST['id_payement'] ?>" readonly />
                        <span id="erreurNom" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="nom">date_payement:</label></td>
                    <td>
                        <input type="date" id="date" name="date_payement" value="<?php echo $payement['date_payement'] ?>" oninput="validerDate()" />
                        <span id="erreurDate" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="descreption">descreption :</label></td>
                    <td>
                       <textarea id="descreption" name="descreption" value="<?php echo $facture['descreption'] ?>"oninput="validerDescription()" ></textarea>
                        <span id="erreurDescription" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="image_mp">image_mp :</label></td>
                    <td>
                        <input type="text" id="image_mp" name="image_mp" value="<?php echo $payement['image_mp'] ?>" />
                        <span id="erreurdescreption" style="color: red"></span>
                    </td>
                </tr>
                
                
            
                   


                <td>
                    <input type="submit" value="Save" >
                </td>
                <td>
                    <input type="reset" value="Reset">
                </td>
            </table>

        </form>
    <?php
    }
    ?>
     <script src="control.js"></script>
</body>

</html>