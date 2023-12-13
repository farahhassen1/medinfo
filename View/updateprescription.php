<?php
include '../controller/PrescriptionController.php';
include '../model/Prescription.php';
$error = "";
$prescription = null;
$prescriptionController = new PrescriptionController();
if (
    isset($_POST["doctor_name"]) &&
    isset($_POST["website_name"]) &&
    isset($_POST["patient_name"]) &&
    isset($_POST["prescription_date"]) &&
    isset($_POST["prescription_text"]) &&
    isset($_POST["doctor_stamp"]) 
) {
    if (
        !empty($_POST['doctor_name']) &&
        !empty($_POST["website_name"]) &&
        !empty($_POST["patient_name"]) &&
        !empty($_POST["prescription_date"])&&
        !empty($_POST["prescription_text"]) &&
        !empty($_POST["doctor_stamp"])
    ) {
        foreach ($_POST as $key => $value) {
            echo "Key: $key, Value: $value<br>";
        }
        $prescription = new prescription(
            null,
            $_POST['doctor_name'],
            $_POST['website_name'],
            $_POST['patient_name'],
            $_POST['prescription_date'],
            $_POST['prescription_text'],
            $_POST['doctor_stamp'],
            $_POST['idtype']

        );
        var_dump($prescription);
        
        $prescriptionController->updatePrescription($prescription, $_POST['id']);

        header('Location:elements.php');
    } else
        $error = "Missing information";
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css2/bootstrap.min.css" rel="stylesheet">
	<link href="css2/font-awesome.min.css" rel="stylesheet">
	<link href="css2/datepicker3.css" rel="stylesheet">
	<link href="css2/styles.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
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
    <title>Upadte</title>
</head>

<body>
    <button><a href="elements.php">Back to list</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_POST['id'])) {
        $prescription = $prescriptionController->showPrescription($_POST['id']);
        
    ?>

        <form action="updateprescription.php" method="POST">
            <table>
            <tr>
                    <td><label for="id ">Id :</label></td>
                    <td>
                        <input type="text" id="id" name="id" value="<?php echo $_POST['id'] ?>" readonly />
                        <span id="erreurNom" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="doctor_name">Doctor Name :</label></td>
                    <td>
                        <input type="text" id="doctor_name" name="doctor_name" value="<?php echo $prescription['doctor_name'] ?>" />
                        <span id="erreurNom" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="website_name">website name :</label></td>
                    <td>
                        <input type="text" id="website_name" name="website_name" value="<?php echo $prescription['website_name'] ?>" />
                        <span id="erreurwebsite_name" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="patient_name">Patient name :</label></td>
                    <td>
                        <input type="text" id="patient_name" name="patient_name" value="<?php echo $prescription['patient_name'] ?>" />
                        <span id="erreurpatient_name" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="prescription_date">Prescription Date :</label></td>
                    <td>
                        <input type="date" id="prescription_date" name="prescription_date" value="<?php echo $prescription['prescription_date'] ?>" />
                        <span id="erreurprescription_date" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="prescription_text">Prescription Text :</label></td>
                    <td>
                        <textarea type="text" id="prescription_text" name="prescription_text" value="<?php echo $prescription['prescription_text'] ?>"></textarea>
                        <span id="erreurprescription_text" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="doctor_stamp">doctor stamp :</label></td>
                    <td>
                        <input type="text" id="doctor_stamp" name="doctor_stamp" value="<?php echo $prescription['doctor_stamp'] ?>" />
                        <span id="erreurdoctor_stamp" style="color: red"></span>
                    </td>
                </tr>

                <td>
                    <input type="submit" value="Save">
                </td>
                <td>
                    <input type="reset" value="Reset">
                </td>
            </table>

        </form>
    <?php
    }
    ?>
</body>

</html>