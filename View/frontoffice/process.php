<?php
require_once('../../config1.php');

if (isset($_POST)) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Use password_hash() for secure hashing

    $sql = "INSERT INTO users (name, username, email, password) VALUES(?,?,?,?)";
    $stmtinsert = $db->prepare($sql);
    
    // Check if the statement is prepared successfully
    if ($stmtinsert) {
        $result = $stmtinsert->execute([$name, $username, $email, $password]);
        if ($result) {
            echo 'Successfully saved.';
        } else {
            echo 'There were errors while saving the data.';
        }
    } else {
        echo 'Error preparing the statement.';
    }
} else {
    echo 'No data';
}
?>
