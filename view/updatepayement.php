<?php

include '../controller/factureC.php';
include '../model/payement.php';
$error = "";

// create client
$payement = null;
// create an instance of the controller
$payementC = new payementC();

if (
    isset($_POST["date_payement"]) &&
    isset($_POST["descreption"]) &&
    isset($_POST["image_mp"]) 
   
) {
    if (
        !empty($_POST['date_payement']) &&
        !empty($_POST["descreption"]) &&
        !empty($_POST["image_mp"]) 
        
    ) {
        foreach ($_POST as $key => $value) {
            echo "Key: $key, Value: $value<br>";
        }
        $payement = new payement(
            null,
            $_POST['date_payement'],
            $_POST['descreption'],
            $_POST['image_mp']
           
        );
        var_dump($payement);
        
        $payementC->updatepayement($payement, $_POST['id_payement']);

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
    <button><a href="payement.php">Back to list</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_POST['id_payement'])) {
        $payement = $payementC->showpayement($_POST['id_payement']);
        
    ?>

        <form action="" method="POST">
            <table>
            <tr>
                    <td><label for="nom">id_facture:</label></td>
                    <td>
                        <input type="text" id="id_" name="id_payement" value="<?php echo $_POST['id_payement'] ?>" readonly />
                        <span id="erreurNom" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="nom">date_payement:</label></td>
                    <td>
                        <input type="date" id="nom" name="date_payement" value="<?php echo $payement['date_payement'] ?>" />
                        <span id="erreurDate_payement" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="descreption">descreption :</label></td>
                    <td>
                       <textarea id="date" name="descreption" value="<?php echo $facture['descreption'] ?>" ></textarea>
                        <span id="erreurdescreption" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="image_mp">image_mp :</label></td>
                    <td>
                        <input type="text" id="image_mp" name="image_mp" value="<?php echo $payement['image_mp'] ?>" />
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
     <script src="control.js"></script>
</body>

</html>