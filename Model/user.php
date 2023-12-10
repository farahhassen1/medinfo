<?php
require 'C:/xampp/htdocs/test/LocalArt/config.php';


// Le reste du code HTML
class user{

    private int $id_user;
    private string $name;
    private string $username;
    public string $email;
    private string $password;
    private string $state;

    public function __construct($id_user,$name,$username,$email,$password,$state) {
    $this->id_user=$id_user;
    $this->name = $name;
    $this->username = $username;
    $this->email = $email;
    $this->password = $password;
    $this->state = $state;
}


    public function getNom()
    {
        return $this->name;
    }
    public function setNom($name)
    {
        $this->name = $name;

        return $this;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
    public function getid_user()
    {
        return $this->id_user;
    }
    public function setid_user($id_user)
    {
        $this->id_user = $id_user;

        return $this;
    }





    
   
}




?>
