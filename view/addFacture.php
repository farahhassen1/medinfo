<?php

include '../controller/factureC.php';
include '../model/facture.php';



$error = "";

// create facture
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
        $facture = new facture(
            null,
            $_POST['montant'],
            $_POST['date_facture'],
            $_POST['descreption']
					
            
            
        );
        $factureC->addfacture($facture);
       header('Location:listFacture.php');
    }/* else
        $error = "Missing information";*/
}


?>
<html lang="en">

<head>
        <!-- Meta Tags -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="keywords" content="Site keywords here">
		<meta name="description" content="">
		<meta name='copyright' content=''>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<!-- Title -->
        <title>Mediplus - Free Medical and Doctor Directory HTML Template.</title>
		
		<!-- Favicon -->
        <link rel="icon" href="img/favicon.png">
		
		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- Nice Select CSS -->
		<link rel="stylesheet" href="css2/ok.css">
		
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
								<li><i class="fa fa-phone"></i>+880 1234 56789</li>
								<li><i class="fa fa-envelope"></i><a href="mailto:support@yourmail.com">support@yourmail.com</a></li>
							</ul>
							<!-- End Top Contact -->
						</div>
					</div>
				</div>
			</div>
			<!-- End Topbar -->
			<!-- Header Inner -->
			<div class="header-inner">
				<div class="container">
					<div class="inner">
						<div class="row">
							<div class="col-lg-3 col-md-3 col-12">
								<!-- Start Logo -->
								<div class="logo">
									<a href="index.php"><img src="img/logo.png" alt="#"></a>
								</div>
								<!-- End Logo -->
								<!-- Mobile Nav -->
								<div class="mobile-nav"></div>
								<!-- End Mobile Nav -->
							</div>
							<div class="col-lg-7 col-md-9 col-12">
								<!-- Main Menu -->
								<div class="main-menu">
									<nav class="navigation">
										<ul class="nav menu">
											<li class="active"><a href="#">Home <i class="icofont-rounded-down"></i></a>
												<ul class="dropdown">
													<li><a href="index.php">Home Page 1</a></li>
												</ul>
											</li>
											<li><a href="#">Doctos </a></li>
											<li><a href="#">Services </a></li>
											<li><a href="#">payement <i class="icofont-rounded-down"></i></a>
												<ul class="dropdown">
													<li><a href="addFacture.php">facture</a></li>
												</ul>
											</li>
											<li><a href="#">Blogs <i class="icofont-rounded-down"></i></a>
												<ul class="dropdown">
													<li><a href="blog-single.html">Blog Details</a></li>
												</ul>
											</li>
											<li><a href="contact.html">Contact Us</a></li>
										</ul>
									</nav>
								</div>
								<!--/ End Main Menu -->
							</div>
							<div class="col-lg-2 col-12">
								<div class="get-quote">
									<a href="appointment.html" class="btn">Book Appointment</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Header Inner -->
			<style>
        .formulaire{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 60vh;
        }

        form {
			width: 60%; /* Ajuster la largeur */
            max-height:700px;
            max-width: 500px; /* Ajuster la largeur maximale */
            margin: 100px;
            padding: 60px; /* Ajuster la hauteur */
            border: 1px solid #007bff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            float: left;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
            color: #007bff;
        }

        input {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="submit"],
        input[type="reset"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-right: 10px;
            cursor: pointer;
            border-radius: 4px;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #0056b3;
        }

        img {
            max-width: 50%;
            height: auto;
            border-radius: 8px;
        }
				
    </style>
		</header>
		
    <a href="facture.php">Back to list </a>
    
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>
<main  class="formulaire">
    <form  id = "myForm" action="addFacture.php" method="POST">
		
        <table>
           

            <tr>
                <td><label for="descreption">Description:</label></td>
                <td>
                    <input type="text" id="descreption" name="descreption" oninput="validerDescription()" />
                    <span id="erreurDescription" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="montant">Montant:</label></td>
                <td>
                    <input type="text" id="montant" name="montant" oninput="validerMontant()" />
                    <span id="erreurMontant"></span>
                </td>
            </tr>
            <tr>
                <td><label for="date">Date:</label></td>
                <td>
                    <input type="date" id="date" name="date_facture" oninput="validerDate()" />
                    <span id="erreurDate" style="color: red"></span>
                </td>
            </tr>

            <tr>
                <td>
                    <input type="submit" value="Save">
                </td>
                <td>
                    <input type="reset" value="Reset">
                </td>
            </tr>
        </table>
    </form>
		<img src ="Facture2.png" alt= "facture_image">
			</main>
    <script src="control.js"></script>
</body>

</html>