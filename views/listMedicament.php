<?php
include "../controller/medicament_functions.php";
$c = new medicamentC();
$tab = $c->listMedicament();
$c2 = new fabricantc();
$tab2 = $c2->listFabricant();
?>
<!doctype html>
<html class="no-js" lang="zxx">
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
		<link rel="stylesheet" href="addmed.css">
        <link rel="stylesheet" href="listmed.css">
    </head>
    <body>
	
		<!-- Preloader -->
        
        <!-- End Preloader -->
		
	
	
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
													<li><a href="index.html">Home Page 1</a></li>
												</ul>
											</li>
											<li><a href="#">Doctos </a></li>
											<li><a href="#">Services </a></li>
											<li><a href="#">Pages <i class="icofont-rounded-down"></i></a>
												<ul class="dropdown">
													<li><a href="listMedicament.php">Medicals</a></li>
												</ul>
											</li>
											<li><a href="#">Articles <i class="icofont-rounded-down"></i></a>
												<ul class="dropdown">
													<li><a href="displayArticles.php">Article Details</a></li>
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
									<a href="#" class="btn">Login</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Header Inner -->
		</header>
		<!-- End Header Area -->
<center>
    <h1>Medication List</h1>
    </center>
    
    
        
        
  
</div>
      
    </div>
  </div>
  
</div>
    <br><br>

<table border="1" align="center" width="70%" class="styled-table">
    <tr>
        <th>Medication ID</th>
        <th>Medication Name</th>
        <th>Fabricant ID</th>
        <th>Expiration date</th>
        
    </tr>
    <?php
    foreach ($tab as $medicament) {
    ?>
        <tr>
            <td><?= $medicament['id_medicament']; ?></td>
            <td><?= $medicament['nom_medicament']; ?></td>
            <td><?= $medicament['id_fabricant']; ?></td>
            <td><?= $medicament['date_prescription']; ?></td>
            
    <?php
    }
    ?>
</table>
<br>
<hr style="border-width: 50%px; border-color: black;"/>

<center>
    <h1>Fabricant List</h1>
    </center>
    <br><br>

<table border="1" align="center" width="70%" class="styled-table">
    <tr>
        <th>Fabricant ID</th>
        <th>Fabricant Name</th>
        <th>Adress</th>
        <th>Contact</th>
        
    </tr>
    <?php
    foreach ($tab2 as $fabricant) {
    ?>
        <tr>
            <td><?= $fabricant['id_fabricant']; ?></td>
            <td><?= $fabricant['nom_fabricant']; ?></td>
            <td><?= $fabricant['adress_fabricant']; ?></td>
            <td><?= $fabricant['contact']; ?></td>
            
    <?php
    }
    ?>
</table>
<a href="medical.php">Go to Admin's space</a><br><br><br>