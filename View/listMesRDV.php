<?php
include "../Controller/RDVC.php";
session_start();

$c = new rdvC();
$tab = $c->listRDV();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Medical Appointment Schedule</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="your-medical-info-website/css/style.css"> <!-- Adjust this line to match your actual CSS path -->

    <!-- Add FullCalendar CSS and JS files -->
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    <script src='https://code.jquery.com/jquery-3.6.4.min.js'></script>
    <script src='https://code.jquery.com/ui/1.12.1/jquery-ui.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
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
    /* Your existing styles */

    /* Additional styles for FullCalendar */
    #calendar {
        max-width: 1000px;
        margin: 0 auto;
    }

    /* Style for rendering appointments in light blue */
    .fc-event {
        background-color: #aed9e0; /* Light blue color */
        border-color: #aed9e0; /* Border color */
        color: #fff; /* Text color */
    }

    /* Style for rendering update button in green */
    .fc-event .update-btn {
        background-color: #4caf50; /* Green color for the "Update" button */
        color: #fff;
        border: none;
        padding: 5px 10px;
        margin-right: 5px;
        cursor: pointer;
    }

    /* Style for rendering delete button in red */
    .fc-event .delete-btn {
        background-color: #e74c3c; /* Red color for the "Delete" button */
        color: #fff;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
    }

    /* Style for rendering feedback button in blue */
    .fc-event .feedback-btn {
        background-color: #3498db; /* Blue color for the "Feedback" button */
        color: #fff;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
		align-items: center;
    }

    .fc-event .button-group {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Hover effect for buttons */
    .fc-event .update-btn:hover,
    .fc-event .delete-btn:hover,
    .fc-event .feedback-btn:hover {
        opacity: 0.8;
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
                    <li><i class="fa fa-phone"></i>+216 71 800 000</li>
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
											<li class="active"><a href="frontoffice/index.php">Home <i class="icofont-rounded-down"></i></a>
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
											<li><a href="listMesRDV.php">My appointments </i></a>
											</li>
											<li><a href="listpayement.php">payement <i class="icofont-rounded-down"></i></a>
												<ul class="dropdown">
													<li><a href="listFacture.php">facture</a></li>
													</ul>
                                            </li>
											<li><a href="#">Pages <i class="icofont-rounded-down"></i></a>
												<ul class="dropdown">
													<li><a href="listMedicament.php">Medicals</a></li>
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
    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                <center><h4 class="text-center mb-4" >My Medical Appointment Schedule</h4>
				<h2>
					<?php
						if (isset($_SESSION["state"]) && $_SESSION["state"] == "Patient") {
							echo' <a href="addRDV.php"> New Appointment</a>';
						}
					?>
       
    </h2>
			</center>
                    <!-- Add a container for FullCalendar -->
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </section>
	

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
            // Initialize FullCalendar
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
                events: [
                    <?php
                    foreach ($tab as $rdv) {
                        $start_datetime = $rdv['date'] . ' ' . $rdv['heure'];
                        $end_datetime = date('Y-m-d H:i:s', strtotime($start_datetime . ' +1 hour'));
                        echo "{";
                        echo "id: '" . $rdv['idRDV'] . "',";
                        echo "title: '" . $rdv['commentaire'] . "',";
                        echo "start: '" . $start_datetime . "',";
                        echo "end: '" . $end_datetime . "',";
                        echo "}," . PHP_EOL;
                    }
                    ?>
                ],
				eventRender: function (event, element, view) {
    // Customize the rendering of each event
    element.find('.fc-title').append('<br/>' +
        '<div class="button-group">' +
        '<form method="POST" action="updateRDV.php" style="display: inline;">' +
        '<input type="submit" class="update-btn" name="update" value="Update">' +
        '<input type="hidden" value="' + event.id + '" name="idRDV">' +
        '</form>' +
        '<button class="delete-btn" onclick="deleteEvent(' + event.id + ')">Delete</button>' +
        '</div>'+
        '<button class="feedback-btn" align="center" onclick="AddfeedbackEvent(' + event.id + ')">Add Feedback</button>' );
}


    });
});

function deleteEvent(eventId) {
    // Redirect to the delete page with the event ID
    window.location.href = 'deleteRDV.php?id=' + eventId;
}
function AddfeedbackEvent(eventId) {
    // Redirect to the delete page with the event ID
    window.location.href = 'addFeedback.php?id=' + eventId;
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
