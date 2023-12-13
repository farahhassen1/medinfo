<?php
include '../controller/PrescriptionController.php';
include '../model/type.php';
$error = "";
$typep = null;
$typepController = new typepController();
if (
    isset($_POST["typename"]) &&
    isset($_POST["typedescription"])
) {
    if (
        !empty($_POST['typename']) ||
        !empty($_POST["typedescription"])
    ) {
        foreach ($_POST as $key => $value) {
            echo "Key: $key, Value: $value<br>";
        }
        $typep = new typep(
            null,
            $_POST['typename'],
            $_POST['typedescription']
        );
        var_dump($typep);
        
        $typepController->updatetypep($typep, $_POST['idtype']);

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
    <title>Upadte</title>
</head>

<body>
    <button><a href="elements.php">Back to list</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_POST['idtype'])) {
        $typep = $typepController->showtypep($_POST['idtype']);
        
    ?>

        <form action="updatetypep.php" method="POST">
            <table>
            <tr>
                    <td><label for="idtype ">Id :</label></td>
                    <td>
                        <input type="text" id="id" name="idtype" value="<?php echo $_POST['idtype'] ?>" readonly />
                        <span id="erreurNom" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="typename">Type Name :</label></td>
                    <td>
                        <input type="text" id="typename" name="typename" value="<?php echo $typep['typename'] ?>" />
                        <span id="erreurtypename" style="color: red"></span>
                        
                    </td>
                    <div id="erreurtypename" class="error-message error-message-red" ></div>
                </tr>
                <tr>
                    <td><label for="typedescription">Type Description :</label></td>
                    <td>
                        <textarea type="text" id="typedescription" name="typedescription" value="<?php echo $typep['typedescription'] ?>"></textarea>
                        <span id="erreurtypedescription" style="color: red"></span>
                    </td>
                    <div id="erreurtypedescription" class="error-message error-message-red" ></div>
                </tr>
                <td>
                    <input type="submit" value="Save">
                </td>
                <td>
                    <input type="reset" value="Reset">
                </td>
            </table>

        </form>
        <script>
        function validateForm() {
            var typename = document.getElementById('typename').value;
            var typedescription = document.getElementById('typedescription').value;

            var nameRegex = /^[a-zA-Z\s]+$/;
            var namereg = /^[a-zA-Z0-9\s]+$/;

            var isValid = true;

            if (!typename.match(nameRegex)) {
                document.getElementById('erreurtypename').innerHTML = 'Name can only contain letters and spaces and can\'t be empty';
                isValid = false;
            }

            if (!typedescription.match(namereg)) {
                document.getElementById('erreurtypedescription').innerHTML = 'Description can only contain letters, numbers, and spaces and can\'t be empty';
                isValid = false;
            }

            return isValid;
        }
    </script>

    <?php
    }
    ?>
</body>

</html>