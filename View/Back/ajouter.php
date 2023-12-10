<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    // ...
    include_once "connexion.php";

    if (isset($_POST['button'])) {
        extract($_POST);

        if (isset($name) && isset($username) && isset($email) && isset($state)) {
            // Use prepared statement to prevent SQL injection
            $stmt = $con->prepare("INSERT INTO users (name, username, email, state) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $username, $email, $state);

            // Execute the statement
            if ($stmt->execute()) {
                header("location: index.php");
                exit(); // Make sure to exit after the redirect
            } else {
                $message = "Employé non ajouté";
            }

            // Close the statement
            $stmt->close();
        } else {
            $message = "Veuillez remplir tous les champs !";
        }

        // Close the connection
        $con->close();
    }
    // ...
    ?>

    <div class="form user-add-form">
        <a href="index.php" class="back_btn"><img src="images/back.png"> Return</a>
        <h2>Add user</h2>
        <p class="erreur_message">
            <?php
            // si la variable message existe, affichons son contenu
            if (isset($message)) {
                echo $message;
            }
            ?>
        </p>
        <form action="" method="POST" id="addUserForm" class="needs-validation" novalidate>
            <label for="name">Name</label>
            <input type="text" name="name" required>
            <div class="invalid-feedback" id="nameError" style="color: #dc3545;"></div>

            <label for="username">Username</label>
            <input type="text" name="username" required>
            <div class="invalid-feedback" id="usernameError" style="color: #dc3545;"></div>

            <label for="email">Email</label>
            <input type="email" name="email" required>
            <div class="invalid-feedback" id="emailError" style="color: #dc3545;"></div>

            <!-- Add the select dropdown for the state -->
            <label for="state_update">User Type</label>
            <select id="state_update" name="state" required>
                <option value="Admin">Admin</option>
                <option value="Doctor">Doctor</option>
                <option value="Patient">Patient</option>
            </select>
            <div class="invalid-feedback" id="stateError" style="color: #dc3545;"></div>

            <input type="submit" value="Add User" name="button" id="ajouterButton">
        </form>

        <script>
            document.getElementById('addUserForm').addEventListener('submit', function (event) {
                var name = document.getElementsByName('name')[0].value.trim();
                var username = document.getElementsByName('username')[0].value.trim();
                var email = document.getElementsByName('email')[0].value.trim();
                var state = document.getElementById('state_update').value.trim();

                var isValid = true;

                if (name === "") {
                    isValid = false;
                    document.getElementById('nameError').textContent = 'Please enter your name.';
                } else {
                    document.getElementById('nameError').textContent = '';
                }

                if (username === "") {
                    isValid = false;
                    document.getElementById('usernameError').textContent = 'Please choose a username.';
                } else {
                    document.getElementById('usernameError').textContent = '';
                }

                if (email === "" || !isValidEmail(email)) {
                    isValid = false;
                    document.getElementById('emailError').textContent = 'Please enter a valid email address.';
                } else {
                    document.getElementById('emailError').textContent = '';
                }

                if (state === "") {
                    isValid = false;
                    document.getElementById('stateError').textContent = 'Please select a user type.';
                } else {
                    document.getElementById('stateError').textContent = '';
                }

                if (!isValid) {
                    event.preventDefault();
                }
            });

            function isValidEmail(email) {
                // You can add a more sophisticated email validation logic here if needed
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }
        </script>
    </div>
</body>

</html>
