<?php

include '../controller/PrescriptionController.php';
include '../model/type.php';

$error = "";

$typep = null;
$typepController = new typepController();

if (isset($_POST["typename"]) && isset($_POST["typedescription"])) {
    if (!empty($_POST["typename"]) && !empty($_POST["typedescription"])) {
        $typep = new typep(
            null,
            $_POST["typename"],
            $_POST["typedescription"]
        );

        $typepController->addtypep($typep);
        header('Location:elements.php');
    } else {
        $error = "Missing information";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Prescription Type</title>
    <link href="css2/bootstrap.min.css" rel="stylesheet">
    <link href="css2/font-awesome.min.css" rel="stylesheet">
    <link href="css2/datepicker3.css" rel="stylesheet">
    <link href="css2/styles.css" rel="stylesheet">

    <style>
        body {
            background-color: #f3f3f4;
        }

        .container {
            margin-top: 50px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
        }

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
    <div class="container">
        <a href="elements.php">Back to list</a>
        <hr>

        <div id="error">
            <?php echo $error; ?>
        </div>

        <form action="" method="POST" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="typename">Type Name:</label>
                <input type="text" id="typename" name="typename">
                <div class="error-message" id="typename-error"></div>
            </div>

            <div class="form-group">
                <label for="typedescription">Type Description:</label>
                <textarea id="typedescription" name="typedescription" rows="4"></textarea>
                <div class="error-message" id="typedescription-error"></div>
            </div>

            <button type="submit" class="btn btn-primary">Add Prescription Type</button>
        </form>
    </div>

    <script>
        function validateForm() {
            var typename = document.getElementById('typename').value;
            var typedescription = document.getElementById('typedescription').value;

            var nameRegex = /^[a-zA-Z\s]+$/;
            var namereg = /^[a-zA-Z0-9\s]+$/;

            var isValid = true;

            if (!typename.match(nameRegex)) {
                document.getElementById('typename-error').innerHTML = 'Name can only contain letters and spaces and can\'t be empty';
                isValid = false;
            }

            if (!typedescription.match(namereg)) {
                document.getElementById('typedescription-error').innerHTML = 'Description can only contain letters, numbers, and spaces and can\'t be empty';
                isValid = false;
            }

            return isValid;
        }
    </script>

    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/chart.min.js"></script>
    <script src="js/chart-data.js"></script>
    <script src="js/easypiechart.js"></script>
    <script src="js/easypiechart-data.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/custom.js"></script>
</body>

<?php if ($error) : ?>
    <p style="color: red;"><?php echo $error; ?></p>
<?php endif; ?>

</html>
