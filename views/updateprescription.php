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
            $_POST['doctor_stamp']
        );
        var_dump($prescription);
        
        $prescriptionController->updatePrescription($prescription, $_POST['id']);

        header('Location:listprescription.php');
    } else
        $error = "Missing information";
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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