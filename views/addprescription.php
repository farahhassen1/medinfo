<?php

include '../controller/PrescriptionController.php';
include '../model/Prescription.php';

$error = "";

$prescription = null;
$prescriptionController = new PrescriptionController();

if (isset($_POST["doctor_name"]) && isset($_POST["website_name"]) && isset($_POST["patient_name"]) && isset($_POST["prescription_date"]) && isset($_POST["prescription_text"]) && isset($_POST["doctor_stamp"])) {
    if (!empty($_POST["doctor_name"]) && !empty($_POST["website_name"]) && !empty($_POST["patient_name"]) && !empty($_POST["prescription_date"]) && !empty($_POST["prescription_text"]) && !empty($_POST["doctor_stamp"])) {
        $prescription = new Prescription(
            null,
            $_POST["doctor_name"],
            $_POST["website_name"],
            $_POST["patient_name"],
            $_POST["prescription_date"],
            $_POST["prescription_text"],
            $_POST["doctor_stamp"]
        );

        $prescriptionController->addPrescription($prescription);
        header('Location: listprescription.php');
    } else {
        $error = "Missing information";
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
    <title>Add Prescription</title>
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
<style>
    /* Reset some default styles */
    body, h1, h2, h3, p, ul, li {
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Poppins', sans-serif;
    }

    /* Top Bar Styles */
    .top-bar {
        background-color: #3498db; /* Change to blue color */
        padding: 10px 0;
        color: #fff;
    }

    .top-bar a {
        color: #fff;
        margin-right: 15px;
        text-decoration: none;
    }

    /* Header Styles */
    .header-inner {
        background-color: #fff;
        border-bottom: 1px solid #eee;
        padding: 20px 0;
    }

    .logo img {
        max-width: 100%;
        height: auto;
    }

    .main-menu ul {
        display: flex;
        list-style: none;
    }

    .main-menu ul li {
        margin-right: 20px;
    }

    .main-menu a {
        color: #333;
        text-decoration: none;
        font-weight: 500;
        font-size: 16px;
        transition: color 0.3s ease;
    }

    .main-menu a:hover {
        color: #3498db; /* Change to blue color */
    }

    /* Button Styles */
    .btn {
        background-color: #3498db; /* Change to blue color */
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        display: inline-block;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #2980b9; /* Change to a darker shade of blue on hover */
    }

    /* Form Styles */
    form {
        max-width: 600px;
        margin: 20px auto;
        padding: 20px;
        border: 1px solid #eee;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    form label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
    }

    form input,
    form textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-sizing: border-box;
    }

    form button {
        background-color: #3498db; /* Change to blue color */
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    form button:hover {
        background-color: #2980b9; /* Change to a darker shade of blue on hover */
    }

    /* Additional styles as needed */
</style>


</head>

<body>
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
													<li><a href="404.html">404 Error</a></li>
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
    <a href="elements.php">Back to list</a>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <form action="" method="POST" onsubmit="return validateForm()">
    <div>
            <label for="doctor_name">Doctor's Name:</label>
            <input type="text" id="doctor_name" name="doctor_name" required>
        </div>

        <div>
            <label for="website_name">Website Name:</label>
            <input type="text" id="website_name" name="website_name" required>
        </div>

        <div>
            <label for="patient_name">Patient Name:</label>
            <input type="text" id="patient_name" name="patient_name" required>
        </div>

        <div>
            <label for="prescription_date">Prescription Date:</label>
            <input type="date" id="prescription_date" name="prescription_date" required>
        </div>

        <div>
            <label for="prescription_text">Prescription Text:</label>
            <textarea id="prescription_text" name="prescription_text" rows="4" required></textarea>
        </div>

        <div>
            <label for="doctor_stamp">Doctor's Stamp:</label>
            <input type="text" id="doctor_stamp" name="doctor_stamp" required>
        </div>

        <button type="submit">Submit Prescription</button>
    </form>
    
    <script>
         function validateForm() {
          
           var doctorName = document.getElementById('doctor_name').value;
           var websiteName = document.getElementById('website_name').value;
           var patientName = document.getElementById('patient_name').value;
           var prescriptionDate = document.getElementById('prescription_date').value;
           var prescriptionText = document.getElementById('prescription_text').value;
           var doctorStamp = document.getElementById('doctor_stamp').value;

           var nameRegex = /^[a-zA-Z\s]+$/; 
           var namereg = /^[a-zA-Z0-9\s]+$/;
           
           var isValid = true;

          
           if (!doctorName.match(nameRegex)) {
               alert('Doctor\'s name can only contain letters and spaces.');
               isValid = false;
           }

          
           if (!websiteName.match(nameRegex)) {
               alert('Website name can only contain letters and spaces.');
               isValid = false;
           }

          
           if (!patientName.match(nameRegex)) {
               alert('Patient name can only contain letters and spaces.');
               isValid = false;
           }

         
           if (prescriptionDate.trim() === "") {
               alert('Prescription date is required.');
               isValid = false;
           }
        
           if (!prescriptionText.match(namereg)) {
               alert('prescription Text can only contain letters and spaces and numbers.');
               isValid = false;
           }


           return isValid;
       }
    </script>
</body>
<?php if ($error) : ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
</html>
