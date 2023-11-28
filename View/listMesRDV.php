<?php
include "../Controller/RDVC.php";

$c = new rdvC();
$tab = $c->listRDV();

?>
<!DOCTYPE html>
<html lang="en">
<head>
     <!-- Meta Tags -->
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
    <title>Appointment List</title>

    <!-- Ajoutez ici vos liens vers les fichiers CSS ou utilisez les styles en ligne -->
    <style>
    table {
        width: 100%;
        border-collapse: collapse;
        border: 3px solid  #007bff;
    }

    th, td {
        padding: 10px;
        text-align: center;
    }

    th {
        background-color: #eee;
    }

    .button {
        width: 100px;
        height: 30px;
        background-color: #007bff;
        color: #ffffff;
        font-weight: bold;
        text-align: center;
        border-radius: 5px;
    }
    </style>
</head>
<body>
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
                    <li><i class="fa fa-phone"></i>+216 71 458 225</li>
                    <li><i class="fa fa-envelope"></i><a href="mailto:MedInfo@gmail.com">MedInfo@gmail.com</a></li>
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
									<a href="index.php"><img src="frontoffice/img/logo.png" alt="#"></a>
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
											<li class="active"><a href="frontoffice/index.php">Home <i class="icofont-rounded-down"></i></a>
											<li><a href="#">Doctos </a></li>
											<li><a href="#">Services </a></li>
											<li><a href="listMesRDV.php">My appointments <i class="icofont-rounded-down"></i></a>
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
								<a href="addRDV.php" class="btn">Get Appointment</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Header Inner -->
		</header>
<center>
    <h1>My Appointements</h1>
    <h2>
        <a href="addRDV.php"> New Appointment</a>
    </h2>
</center>
<div class="container-fluid">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
<table border="1" align="center" width="70%">
    <tr>
        <th>Date</th>
        <th>Time</th>
        <th>Symptoms</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>


    <?php
    foreach ($tab as $rdv) {
    ?>
    
        <tr>
            <td><?= $rdv['date']; ?></td>
            <td><?= $rdv['heure']; ?></td>
            <td><?= $rdv['commentaire']; ?></td>
            <td align="center">
                <form method="POST" action="updateRDV.php">
                    <input type="submit" name="update" value="Update" class="button">
                    <input type="hidden" value=<?PHP echo $rdv['idRDV']; ?> name="idRDV">
                </form>
            </td>
			<td>
                <a href="deleteRDV.php?id=<?php echo $rdv['idRDV']; ?>">Delete</a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>
<script>
    const deleteButtons = document.querySelectorAll('.button');

for (const button of deleteButtons) {
  button.addEventListener('mouseover', () => {
    button.style.backgroundColor = 'green';
    button.querySelector('span').style.color = 'red';
  });

  button.addEventListener('mouseout', () => {
    button.style.backgroundColor = '#007bff';
    button.querySelector('span').style.color = '#ffffff';
  });
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
