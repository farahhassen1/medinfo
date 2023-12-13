<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    //connexion à la base de donnée
    include_once "connexion.php";
    //on récupère le id dans le lien
    $id = $_GET['id'];
    //requête pour afficher les infos d'un employé
    $req = mysqli_query($con, "SELECT * FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($req);

    //vérifier que le bouton ajouter a bien été cliqué
    if (isset($_POST['button'])) {
        //extraction des informations envoyées dans des variables par la methode POST
        extract($_POST);
        //verifier que tous les champs ont été remplis
        if (isset($name) && isset($username) && isset($email) && isset($state)) {
            //requête de modification
            $req = mysqli_query($con, "UPDATE users SET name = '$name' , username = '$username' , email = '$email', state = '$state' WHERE id = $id");
            if ($req) {//si la requête a été effectuée avec succès , on fait une redirection
                header("location: useredit.php");
            } else {//si non
                $message = "Employé non modifié";
            }
        } else {
            //si non
            $message = "Veuillez remplir tous les champs !";
        }
    }
    ?>

    <div class="form user-edit-form">
        <a href="useredit.php" class="back_btn"><img src="images/back.png"> Return</a>
        <h2>Modify user: <?= $row['name'] ?> </h2>
        <p class="erreur_message">
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
        </p>
        <form action="" method="POST" id="editUserForm" class="needs-validation" novalidate>
            <label for="name">Name</label>
            <input type="text" name="name" value="<?= $row['name'] ?>" required>
            <div class="invalid-feedback" id="nameError" style="color: red;"></div>

            <label for="username">Username</label>
            <input type="text" name="username" value="<?= $row['username'] ?>" required>
            <div class="invalid-feedback" id="usernameError" style="color: red;"></div>

            <label for="email">Email</label>
            <input type="email" name="email" value="<?= $row['email'] ?>" required>
            <div class="invalid-feedback" id="emailError" style="color: red;"></div>

            <!-- Add the select dropdown for the state -->
            <label for="state_update">User Type</label>
            <select id="state_update" name="state" onchange="showDoctorDropdown()" required>
                <option value="Admin" <?= ($row['state'] == 'Admin') ? 'selected' : '' ?>>Admin</option>
                <option value="Doctor" <?= ($row['state'] == 'Doctor') ? 'selected' : '' ?>>Doctor</option>
                <option value="Patient" <?= ($row['state'] == 'Patient') ? 'selected' : '' ?>>Patient</option>
            </select>
            <div class="invalid-feedback" id="stateError" style="color: red;"></div>
           
            <!-- Add the additional dropdown for Doctor -->
            <div id="doctorDropdown" style="display: none;">
                <label for="doctorType">Medical Specialtie </label>
                <select id="doctorType" name="doctorType">
                    <option value="Doctor1">Cardiology </option>
                    <option value="Doctor2">Dermatology </option>
                    <option value="Doctor1">Gastroenterology </option>
                    <option value="Doctor2">Orthopedics </option>
                    <option value="Doctor1">Ophthalmology </option>
                    <option value="Doctor2">Obstetrics and Gynecology </option>
                    <option value="Doctor1">Pediatrics </option>
                    <option value="Doctor2">Internal Medicine </option>
                    <option value="Doctor1">Neurology </option>
                    <option value="Doctor2">Psychiatry </option>
                    <option value="Doctor1">Urology </option>
                    <option value="Doctor2">Otolaryngology </option>
                    <option value="Doctor2">Pulmonology </option>
                </select>
            </div>

            <input type="submit" value="update" name="button" id="ajouterButton">
        </form>

        <script>
            function showDoctorDropdown() {
                var userType = document.getElementById('state_update').value;
                var doctorDropdown = document.getElementById('doctorDropdown');

                if (userType === 'Doctor') {
                    doctorDropdown.style.display = 'block';
                } else {
                    doctorDropdown.style.display = 'none';
                }
            }
            
            document.getElementById('editUserForm').addEventListener('submit', function (event) {
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