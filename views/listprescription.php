<?php

include '../controller/PrescriptionController.php';

$prescriptionController = new PrescriptionController();
$prescriptions = $prescriptionController->listPrescriptions();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Prescriptions</title>
</head>

<body>
    <h1>List of Prescriptions</h1>
    <a href="addprescription.php">Add Prescription</a>
    <table border="1" align="center" width="70%">
        <tr>
            <th>ID</th>
            <th>Doctor's Name</th>
            <th>Website Name</th>
            <th>Patient Name</th>
            <th>Prescription Date</th>
            <th>Prescription Text</th>
            <th>Doctor's Stamp</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        <?php
    foreach ($prescriptions as $prescription) {
    ?>
        <tr>
            <td><?= $prescription['id']; ?></td>
            <td><?= $prescription['doctor_name']; ?></td>
            <td><?= $prescription['website_name']; ?></td>
            <td><?= $prescription['patient_name']; ?></td>
            <td><?= $prescription['prescription_date']; ?></td>
            <td><?= $prescription['prescription_text']; ?></td>
            <td><?= $prescription['doctor_stamp']; ?></td>
            <td align="center">
                <form method="POST" action="updateprescription.php">
                    <input type="submit" name="update" value="Update">
                    <input type="hidden" value=<?PHP echo $prescription['id']; ?> name="id">
                </form>
            </td>
            <td>
                <a href="deleteprescription.php?id=<?php echo $prescription['id']; ?>">Delete</a>
            </td>
        </tr>
    <?php
    }
    ?>
        
    </table>
</body>

</html>





