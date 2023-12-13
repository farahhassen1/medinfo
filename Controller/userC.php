<?php
require '../config1.php';
class UserC
{
    public function getAllUsers()
    {
        try {
            $user = new user(0,'0','0','0','0');
            $users = $user->Getuser();
            return $users;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    public function getUserById($id_user){
        try {
            $userc = new user(0,'0','0','0','0');
            $users = $userc->Getuser();
            foreach($users as $user){
                if ($user['id_user'] == $id_user ) {
                    $userFinal = $user;
                }
            }
            return $userFinal;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }


    public function Getuser() {
        try {
            $db = config::getConnexion(); // Get the PDO connection using the config class

            $query = $db->prepare('SELECT * FROM user');
            $query->execute();

            $result = $query->fetchAll(PDO::FETCH_ASSOC);

            if ($result) {
                return $result; // Return the result to the caller
            } else {
                return null; // No records found
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    public function Adduser($id_user ,$name, $username, $email, $password, $state): bool
    {
        try {
            $db = config::getConnexion(); // Get the PDO connection using the config class
    
            $query = $db->prepare('INSERT INTO user (id_user, name, username, email, password, state) VALUES (?, ?, ?, ?, ?)');
            $query->execute([$id_user, $name, $username, $email, $password, $state]);
    
            // Check if the query was successful
            if ($query->rowCount() > 0) {
                return true; // Player added successfully
            } else {
                return false; // Player not added
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false; // An error occurred
        }
    }

    public function Deleteuser($id_user): bool {
        try {
            $db = config::getConnexion(); // Get the db connection using the config class

            $query = $db->prepare('DELETE FROM user WHERE id_user = ?');
            $query->execute([$id_user]);

            // Check if the query was successful
            if ($query->rowCount() > 0) {
                return true; // User deleted successfully
            } else {
                return false; // User not found or not deleted
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false; // An error occurred
        }
    }

    public function Updateuser($id_user, $name, $username, $email, $password, $state): bool
    {
        try {
            $db = config::getConnexion();

            $query = $db->prepare('UPDATE user SET name=?, username=?, email=?, password=?, state=? WHERE id_user = ?');
            $query->execute([$name, $username, $email, $password, $state, $id_user]);

            // Check if the query was successful
            if ($query->rowCount() > 0) {
                return true; // User updated successfully
            } else {
                return false; // User not found or not updated
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false; // An error occurred
        }
    }





}
?>