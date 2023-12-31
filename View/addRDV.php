<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Assuming PHPMailer is in the same directory as your script
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

include '../Controller/RDVC.php';
include '../Model/RDV.php';

$error = "";
$rdv = null;
$RDVC = new rdvC();
// Output the entire session for debugging
//var_dump($_SESSION);
$doctor = null;
$patient = null;
if (isset($_POST["date"]) && isset($_POST["heure"]) && isset($_POST["commentaire"])) {
    if (!empty($_POST['date']) && !empty($_POST['heure']) && !empty($_POST["commentaire"])) {
			if (isset($_SESSION["state"]) && $_SESSION["state"] == "Patient") {
				$patient = $_SESSION["user_id"];
				$doctor = null; // Initialize $doctor if needed
				echo "fffff";
			} else if (isset($_SESSION["state"]) && $_SESSION["state"] == "Doctor") {
				$doctor = $_SESSION["user_id"];
				$patient = null; // Initialize $patient if needed
				echo "hhhhh";
			}
        $rdv = new rdv(null, $_POST['date'], $_POST['heure'], $_POST['commentaire'],$patient);
        $RDVC->addRDV($rdv);

        // Send email
        $to =$_SESSION["email"] ;
        $subject = "Appointment Scheduled";
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'farahhassen96@gmail.com';
            $mail->Password   = 'bwga ulrb amke uysb';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            $mail->setFrom('farahhassen96@gmail.com');
            $mail->addAddress($to);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = "Rendez-vous done. Date: {$_POST['date']}, Heure: {$_POST['heure']}, symptoms: {$_POST['commentaire']}";

            $mail->send();

            //echo 'Email has been sent';
			header('Location:listMesRDV.php');
        } catch (Exception $e) 
		{
            echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        //header('Location:addFeedback.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="keywords" content="Site keywords here">
		<meta name="description" content="">
		<meta name='copyright' content=''>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="frontoffice/css/bootstrap.min.css">
		<!-- Nice Select CSS -->
		<link rel="stylesheet" href="frontoffice/css/nice-select.css">
		<!-- Font Awesome CSS -->
        <link rel="stylesheet" href="frontoffice/css/font-awesome.min.css">
		<!-- icofont CSS -->
        <link rel="stylesheet" href="frontoffice/css/icofont.css">
		<!-- Slicknav -->
		<link rel="stylesheet" href="frontoffice/css/slicknav.min.css">
		<!-- Owl Carousel CSS -->
        <link rel="stylesheet" href="frontoffice/css/owl-carousel.css">
		<!-- Datepicker CSS -->
		<link rel="stylesheet" href="frontoffice/css/datepicker.css">
		<!-- Animate CSS -->
        <link rel="stylesheet" href="frontoffice/css/animate.min.css">
		<!-- Magnific Popup CSS -->
        <link rel="stylesheet" href="frontoffice/css/magnific-popup.css">
		
		<!-- Medipro CSS -->
        <link rel="stylesheet" href="frontoffice/css/normalize.css">
        <link rel="stylesheet" href="frontoffice/style.css">
        <link rel="stylesheet" href="frontoffice/css/responsive.css">
    <style>
        .formulaire{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
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
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
    </style>
    <title>Rendez-vous médical</title>
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
								<li><i class="fa fa-phone"></i>+71 800 000</li>
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
								<a href="index.php"><img  style="width: 100px; height: auto;"src="medinfo.jpg" alt="#"></a>
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
											<li><a href="frontoffice/index.php">Home <i class="icofont-rounded-down"></i></a>
											<li><a href="addprescription.php">Prescriptions<i class="icofont-rounded-down"></i></a>
											<ul class="dropdown">
													<?php
													if (isset($_SESSION["state"]) && $_SESSION["state"] == "Patient") {
														
														echo '<li><a href="MyprescriptionsC.php">My Prescriptions</a></li>';
													} 
													?>
													<?php
													if (isset($_SESSION["state"]) && $_SESSION["state"] == "Doctor") 
													{
														echo '<li><a href="MyprescriptionsM.php">My Prescriptions</a></li>';
													} 
													?>
												</ul>
											</li>
											<li><a href="listMesRDV.php">My appointments <i class="icofont-rounded-down"></i></a>
											</li>
											<li><a href="listpayement.php">payement<i class="icofont-rounded-down"></i></a>
												<ul class="dropdown">
													<li><a href="listFacture.php">facture</a></li></ul>
											<li><a href="#">Pages <i class="icofont-rounded-down"></i></a>
												<ul class="dropdown">
													<li><a href="listMedicament.php">Medications</a></li>
													<li><a href="listfabricant.php">Fabricants</a></li>
												</ul>
											</li>
											<li><a href="displayArticles.php">Articles <i class="icofont-rounded-down"></i></a></li>
										</ul>
									</nav>
								</div>
								<!--/ End Main Menu -->
							</div>
							<?php
								if (isset($_SESSION["user_id"])){
									echo '<div class="col-lg-2 col-12">
                                        		<div class="get-quote">
                                                		<li><a href="frontoffice/logout.php" class="btn">Logout</a></li>
                                        		</div>
                                    		</div>';
								}
								else echo'<div class="col-lg-2 col-12">
												<div class="get-quote">
													<a href="frontoffice/pages-login.php" class="btn">login</a>
												</div>
										</div>'

							?>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Header Inner -->
		</header>
		<br>
		<div class="row">
		<div class="section-title">
			<h2>We Are Always Ready to Help You. Book An Appointment</h2>
				<img src="frontoffice/img/section-img.png" alt="#">
		</div>
	</div>
    <main class="formulaire">
        <form action="" method="POST" onsubmit="return validateForm()" >
            <label for="date">Date :</label>
            <input type="date" id="date" name="date"  />
			<br>
            <span id="dateError" style="color: red;"></span>

            <label for="heure">Heure :</label>
            <input type="time" id="heure" name="heure"  />
            <span id="heureError" style="color: red;"></span>

            <label for="commentaire">Any symptoms?</label>
            <input type="text" id="commentaire" name="commentaire"placeholder="symptoms" />
			<br>
			<span id="commentaireError" style="color: red;"></span>
			 
			
            <div >
                <input type="submit" value="Book An Appointment">
                <input type="reset" value="Reset">
            </div>
           
		</form>
	<img src="image1.png" alt="Image Médicale">
    </main>
    <script>
        function validateForm() {
            var date = document.getElementById("date").value;
            var heure = document.getElementById("heure").value;
			var commentaire=document.getElementById("commentaire").value;

            var dateError = document.getElementById("dateError");
            var heureError = document.getElementById("heureError");
			var commentaireError = document.getElementById("commentaireError");
            dateError.innerHTML = "";
            heureError.innerHTML = "";
			commentaireError.innerHTML = "";
            var isValid = true;

            if (!date) {
                dateError.innerHTML = "ce champ ne peut pas être vide.";
                isValid = false;
            }

            if (!heure) {
                heureError.innerHTML = "ce champ ne peut pas être vide.";
                isValid = false;
            }
			if (!commentaire) {
                commentaireError.innerHTML = "ce champ ne peut pas être vide.";
                isValid = false;
            }
			var datePubObj = new Date(date);
			var dateDebut = new Date('12/01/2023');
			var dateFin = new Date('12/31/2024');

			if (datePubObj < dateDebut || datePubObj > dateFin) 
			{
				dateError.innerHTML = 'La date de rendez-vous doit être entre le 1/12/2023 et le 31/12/2024';
				return false;
			}
            return isValid;
        }
    </script>
	<footer id="footer" class="footer ">
			<!-- Footer Top -->
			<div class="footer-top">
				<div class="container">
					<div class="row">
						<div class="col-lg-3 col-md-6 col-12">
							<div class="single-footer">
								<h2>About Us</h2>
								<p>Lorem ipsum dolor sit am consectetur adipisicing elit do eiusmod tempor incididunt ut labore dolore magna.</p>
								<!-- Social -->
								<ul class="social">
									<li><a href="#"><i class="icofont-facebook"></i></a></li>
									<li><a href="#"><i class="icofont-google-plus"></i></a></li>
									<li><a href="#"><i class="icofont-twitter"></i></a></li>
									<li><a href="#"><i class="icofont-vimeo"></i></a></li>
									<li><a href="#"><i class="icofont-pinterest"></i></a></li>
								</ul>
								<!-- End Social -->
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-12">
							<div class="single-footer f-link">
								<h2>Quick Links</h2>
								<div class="row">
									<div class="col-lg-6 col-md-6 col-12">
										<ul>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Home</a></li>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>About Us</a></li>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Services</a></li>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Our Cases</a></li>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Other Links</a></li>	
										</ul>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<ul>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Consuling</a></li>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Finance</a></li>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Testimonials</a></li>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>FAQ</a></li>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Contact Us</a></li>	
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-12">
							<div class="single-footer">
								<h2>Open Hours</h2>
								<p>Lorem ipsum dolor sit ame consectetur adipisicing elit do eiusmod tempor incididunt.</p>
								<ul class="time-sidual">
									<li class="day">Monday - Fridayp <span>8.00-20.00</span></li>
									<li class="day">Saturday <span>9.00-18.30</span></li>
									<li class="day">Monday - Thusday <span>9.00-15.00</span></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-12">
							<div class="single-footer">
								<h2>Newsletter</h2>
								<p>subscribe to our newsletter to get allour news in your inbox.. Lorem ipsum dolor sit amet, consectetur adipisicing elit,</p>
								<form action="mail/mail.php" method="get" target="_blank" class="newsletter-inner">
									<input name="email" placeholder="Email Address" class="common-input" onfocus="this.placeholder = ''"
										onblur="this.placeholder = 'Your email address'" ="" type="email">
									<button class="button"><i class="icofont icofont-paper-plane"></i></button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Footer Top -->
			<!-- Copyright -->
			<div class="copyright">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-12">
							<div class="copyright-content">
								<p>© Copyright 2021 |  All Rights Reserved by <a href="https://www.wpthemesgrid.com" target="_blank">wpthemesgrid.com</a> </p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Copyright -->
		</footer>
</body>
</html>


