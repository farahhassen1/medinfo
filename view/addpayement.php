<?php

include '../controller/factureC.php';
include '../model/payement.php';
include '../model/facture.php';
$c2 = new payementC();
$tab2 = $c2->listPayement();

$c = new factureC();
$tab = $c->listFacture();

$error = "";


$payement= null;

// create an instance of the controller
$payementC = new payementC();
if (
    isset($_POST["date_payement"]) &&
    isset($_POST["descreption"]) &&
    isset($_POST["image_mp"])&&
		isset($_POST["id_facture"])
		
    
) {
    if (
        !empty($_POST['date_payement']) &&
        !empty($_POST["descreption"]) &&
        !empty($_POST["image_mp"])&&
				!empty($_POST["id_facture"])
				

				
        
       
    ) {
        $payement = new payement(
            null,
            $_POST['date_payement'],
            $_POST['descreption'],
            $_POST['image_mp'],
						$_POST['id_facture']
			
            
            
        );
        $payementC->addpayement($payement);
        header('Location:listpayement.php');
    } else
        $error = "Missing information";
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
													<li><a href="addpayement.php">payement</a></li>
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
		</header>
		
    <a href="listpayement.php">Back to list </a>
    
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <form action="" method="POST" >
        <table>
        <tr>
                <td><label for="date_payement">date_payement :</label></td>
                <td>
                    <input  type="date" id="date_payement" name="date_payement" oninput="validerDate()"/>
                    <span id="erreurDate" style="color: red"></span>
                </td>
            </tr>
            
            <tr>
                <td><label for="descreption">description :</label></td>
                <td>
                    <input type="text" id="descreption" name="descreption" oninput="validerDescription()" />
                    <span id="erreurDescreption" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="image_mp">image_mp :</label></td>
                <td>
                    <input type="file" id="image_mp" name="image_mp" />
                    <span id="erreurDate" style="color: red"></span>
                    
                </td>
            </tr>
						<tr>
    <td><label for="id_facture">select :</label></td>
    <td>
        <select id="select" name="id_facture" > 
            <?php
            foreach($tab as $facture) {
                ?>
                <option value="<?= $facture["id_facture"];?>">
                    <?= $facture["id_facture"] . ' - ' . $facture["descreption"];?>
                </option>
                <?php
            }
            ?>
        </select>
        <span id="erreurDate" style="color: red"></span>
    </td>
</tr>


           
            

            <td>
                <input is="validerButton" type="submit" value="Save">
            </td>
            <td>
                <input type="reset" value="Reset">
            </td>
        </table>

    </form>
		<script src="controlcopy.js"></script>
</body>

</html>