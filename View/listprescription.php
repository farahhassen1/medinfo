
<?php

include '../controller/PrescriptionController.php';


$typepController = new TypepController(); 
$prescriptionTypes = $typepController->listtypep();

$c = new PrescriptionController();
$result = $c->listPrescriptions(); // Assuming this returns a PDOStatement object

// Fetch data into an array
$prescriptions = $result;

// Check if a search query is provided
if (isset($_GET['search_query']) && !empty($_GET['search_query'])) {
    $search_query = $_GET['search_query'];

    // Filter medications based on the search query
    $filtered_medications = array_filter($prescriptions, function ($prescription) use ($search_query) {
        // Customize this condition based on your data structure
        return strpos(strtolower($prescription['patient_name']), strtolower($search_query)) !== false;
    });

    // Check if any medications are found after filtering
    if (empty($filtered_medications)) {
        // No medications found for the search query
        $no_results_message = "No Fabricant found for '$search_query'";
    }

    // Assign the filtered medications to be displayed
    $display_medications = $filtered_medications;
    $prescriptions = $display_medications; 
} else {
    // If no search query, display all medications
    $display_medications = $prescriptions;
}



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
   

    <div style="display: flex; justify-content: space-between;">
    <form role="search" method="GET">
        <div class="form-row align-items-center">
            <div class="col-auto">
                <input type="text" class="form-control" placeholder="Search Fabricant" style="width: 200px;" name="search_query">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>


        <?php if (isset($no_results_message)) { ?>
    <div class="alert alert-info" role="alert"><center>
        <?= $no_results_message; ?></center>
    </div>
<?php 
} ?>
<?php if (!empty($prescriptions)) { ?>



    <table border="1" align="center" width="70%">
        <tr>
            <th>ID</th>
            <th>Doctor's Name</th>
            <th>Website Name</th>
            <th>Patient Name</th>
            <th>Prescription Date</th>
            <th>Prescription Text</th>
            <th>Doctor's Stamp</th>
            <th>Prescription Type</th>
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
            <td><?= $prescription['typep']; ?></td>
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
    <?php
}
?>


</body>

</html>





