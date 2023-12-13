<?php

include '../controller/PrescriptionController.php';
include '../model/Prescription.php';

$error = "";

$prescription = null;
$prescriptionController = new PrescriptionController();
$typepController = new typepController();
$prescriptionTypes = $typepController->listtypep();

if (isset($_POST["doctor_name"]) && isset($_POST["website_name"]) && isset($_POST["patient_name"]) && isset($_POST["prescription_date"]) && isset($_POST["prescription_text"]) && isset($_POST["doctor_stamp"])) {
    if (!empty($_POST["doctor_name"]) && !empty($_POST["website_name"]) && !empty($_POST["patient_name"]) && !empty($_POST["prescription_date"]) && !empty($_POST["prescription_text"]) && !empty($_POST["doctor_stamp"]) && ($_POST["typep"] !== "none")) {
        $prescription = new Prescription(
            null,
            $_POST["doctor_name"],
            $_POST["website_name"],
            $_POST["patient_name"],
            $_POST["prescription_date"],
            $_POST["prescription_text"],
            $_POST["doctor_stamp"],
            $_POST["typep"]
        );

        $prescriptionController->addPrescription($prescription);
        header('Location: MyprescriptionsM.php');
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
    .error-message {
            font-size: 14px;
            margin-top: 5px;
            color: red;
        }

        .success-message {
            font-size: 14px;
            margin-top: 5px;
            color: green;
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
											<li ><a href="frontoffice/index.php">Home <i class="icofont-rounded-down"></i></a>
                                            <li class="active"><a href="addprescription.php">Prescriptions<i class="icofont-rounded-down"></i></a>
                                            <?php
													if (isset($_SESSION["state"]) && $_SESSION["state"] == "Doctor") {
														
														echo '<li><a href="addprescription.php">Prescriptions<i class="icofont-rounded-down"></i></a>';
													} 
													?>
											<?php
													if (isset($_SESSION["state"]) && $_SESSION["state"] == "Patient") {
														
														echo '<li ><a href="MyprescriptionsC.php">My Prescriptions<i class="icofont-rounded-down"></i></a>
														';
													} ?>
											<ul class="dropdown">
													
													
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
											<li><a href="listpayement.php">payement <i class="icofont-rounded-down"></i></a>
												<ul class="dropdown">
													<li><a href="listFacture.php">facture</a></li>
												</ul>
											</li>
											<li><a href="#">Medications<i class="icofont-rounded-down"></i></a>
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
		<!-- End Header Area -->
    
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <form action="" method="POST" onsubmit="return validateForm()">
                    <div>
                        <label for="doctor_name">Doctor's Name:</label>
                        <input type="text" id="doctor_name" name="doctor_name" >
                        <div id=doctornameerror class="error-message error-message-red">
                        </div>
                    </div>

                    <div>
                        <label for="website_name">Website Name:</label>
                        <input type="text" id="website_name" name="website_name" >
                        <div id=websitenameerror class="error-message error-message-red">
                        </div>
                    </div>

                    <div>
                        <label for="patient_name">Patient Name:</label>
                        <input type="text" id="patient_name" name="patient_name" >
                        <div id=patientnameerror class="error-message error-message-red">
                        </div>
                    </div>

                    <div>
                        <label for="prescription_date">Prescription Date:</label>
                        <input type="date" id="prescription_date" name="prescription_date" >
                        <div id=dateerror class="error-message error-message-red">
                        </div>
                    </div>

                    <div>
                        <label for="prescription_text">Prescription Text:</label>
                        <textarea id="prescription_text" name="prescription_text" rows="4" ></textarea>
                        <div id=prescriptiontexterror class="error-message error-message-red">
                        </div>
                    </div>

                    <div>
                        <label for="doctor_stamp">Doctor's Stamp:</label>
                        <input type="file" id="doctor_stamp" name="doctor_stamp" >
                    </div>
                    <br>

                    <div>
                <label for="typep">Choose a Prescription type:</label>
                <select name="typep" id="typep">
                <option value="none" selected disabled hidden>Select an Option</option>     
                <?php
                // Populate dropdown options
                foreach ($prescriptionTypes as $prescriptionTypes) {
                    echo "<option value=\"{$prescriptionTypes['idtype']}\">{$prescriptionTypes['typename']}</option>";
                }
                ?>
              </select>
                <div id=selecterror class="error-message error-message-red"></div>
                <br>   
                <br>
                <br>
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
            document.getElementById('doctornameerror').innerHTML = 'Doctor can only contain letters, numbers, and spaces and cant be empty';
               isValid = false;
           }

           if (!websiteName.match(nameRegex)) {
            document.getElementById('websitenameerror').innerHTML = 'website name can only contain letters, numbers, and spaces and cant be empty';
               isValid = false;
           }

           if (!patientName.match(nameRegex)) {
            document.getElementById('patientnameerror').innerHTML = 'patient name can only contain letters, numbers, and spaces and cant be empty';
               isValid = false;
           }

           if (prescriptionDate.trim() === "") {
            document.getElementById('dateerror').innerHTML = 'Please set a Date';
               isValid = false;
           }
           
        
           if (!prescriptionText.match(namereg)) {
            document.getElementById('prescriptiontexterror').innerHTML = 'text can only contain letters, numbers, and spaces and cant be empty';
               isValid = false;
           }

           if (prescriptiontype.trim() === "") {
            document.getElementById('selecterror').innerHTML = 'Please select a prescription type';
               isValid = false;
           }

           return isValid;
       }
    </script><?php if ($error) : ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
</body>

</html>
