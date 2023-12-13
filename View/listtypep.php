<?php

include '../controller/PrescriptionController.php';

$typepController = new typepController();
$prescriptionTypes = $typepController->listtypep();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Prescriptions</title>
</head>

<body>
    <h1>List of Prescription Types</h1>
    <a href="addtypep.php">Add type</a>
    <table border="1" align="center" width="70%">
        <tr>
            <th>ID</th>
            <th>Type Name</th>
            <th>Type Description</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        <?php
    foreach ($prescriptionTypes as $prescriptionTypes) {
    ?>
        <tr>
            <td><?= $prescriptionTypes['idtype']; ?></td>
            <td><?= $prescriptionTypes['typename']; ?></td>
            <td><?= $prescriptionTypes['typedescription']; ?></td>
            <td align="center">
                <form method="POST" action="updatetypep.php">
                    <input type="submit" name="update" value="Update">
                    <input type="hidden" value=<?PHP echo $prescriptionTypes['idtype']; ?> name="idtype">
                </form>
            </td>
            <td>
                <a href="deletetypep.php?idtype=<?php echo $prescriptionTypes['idtype']; ?>">Delete</a>
            </td>
        </tr>
    <?php
    }
    ?>
        
    </table>
</body>

</html>





