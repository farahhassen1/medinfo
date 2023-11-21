<?php
include 'C:/xampp/htdocs/test/LocalArt/Model/user.php';
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

    public function addUser($id_user, $nom, $email, $password, $state)
    {
        try {
            $user = new user($id_user, $nom, $email, $password, $state);
            $result = $user->Adduser($id_user, $nom, $email, $password, $state);
            return $result;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function deleteUser($id_user)
    {
        try {
            $user = new user(0,'0','0','0','0');
            $result = $user->Deleteuser($id_user);
            return $result;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function updateUser($id_user, $nom, $email, $password, $state)
    {
        try {
            $user = new user($id_user, $nom, $email, $password, $state);
            $result = $user->Updateuser($id_user, $nom, $email, $password, $state);
            return $result;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
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
}
?>