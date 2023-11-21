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
        
        $factureC->updateFacture($facture, $_POST['id_facture']);

        header('Location:listFacture.php');
    } else
        $error = "Missing information";
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
		<header class="header" >
			<!-- Topbar -->
			<div class="topbar">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-md-5 col-12">
							<!-- Contact -->
							<ul class="top-link">
								<li><a href="#">About</a></li>
								<li><a href="#">Doctors</a></li>
								<li><a href="#">Contact</a></li>
								<li><a href="#">FAQ</a></li>
							</ul>
							<!-- End Contact -->
						</div>
						<div class="col-lg-6 col-md-7 col-12">
							<!-- Top Contact -->
							<ul class="top-contact">
								<li><i class="fa fa-phone"></i>+216 52184176</li>
								<li><i class="fa fa-envelope"></i><a href="mailto:mohamed.kadi@esprit.tn">mohamed.kadi@esprit.tn</a></li>
							</ul>
							<!-- End Top Contact -->
						</div>
					</div>
				</div>
			</div>
			
			
								<!--/ End Main Menu -->
							</div>
							<div class="col-lg-2 col-12">
								
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Header Inner -->
		</header>
		<!-- End Header Area -->
        
</head>

<body>
    <button><a href="facture.php">Back to list</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_POST['id_facture'])) {
        $facture = $factureC->showFacture($_POST['id_facture']);
        
    ?>

        <form action="" method="POST">
            <table>
            <tr>
                    <td><label for="nom">id_facture:</label></td>
                    <td>
                        <input type="text" id="id_facture" name="id_facture" value="<?php echo $_POST['id_facture'] ?>" readonly />
                        <span id="erreurNom" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="nom">montant:</label></td>
                    <td>
                        <input type="text" id="nom" name="montant" value="<?php echo $facture['montant'] ?>" />
                        <span id="erreurMontant" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="date_facture">date :</label></td>
                    <td>
                        <input type="date" id="date" name="date_facture" value="<?php echo $facture['date_facture'] ?>" />
                        <span id="erreurDate_facture" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="descreption">description :</label></td>
                    <td>
                        <input type="text" id="descreption" name="descreption" value="<?php echo $facture['descreption'] ?>" />
                        <span id="erreurDescreption" style="color: red"></span>
                    </td>
                </tr>
                
            
                   


                <td>
                    <input type="submit" value="Save" onclick="validerDate()">
                </td>
                <td>
                    <input type="reset" value="Reset">
                </td>
            </table>

        </form>
    <?php
    }
    ?>
     <script src="control.js">
        </script>
</body>

</html>