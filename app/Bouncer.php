<?php

/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 2/9/2017
 * Time: 10:27 PM
 */

error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 1);

include_once ('Database.php');
include_once ('Encryption.php');
include_once ('ILogin.php');

session_start();

class Bouncer extends ILogin {

    public function checkLogin($username, $password) {

        $this->username = $username;
        $this->password = $password;
        // First we will query the database and fetch the users details
        // selectAll is part of a custom wrapper around the pdo library.
        // This cleans up your code and makes it easier to query the database
        $this->row = Database::selectAll("users", "username = ?", [$this->username]);


        // If row returns true here we know the username is valid and registered
        if ($this->row) {

            // Using the password submitted by the user and the salt stored in the database,
            // we can now check to see whether the passwords match by hashing the submitted password
            // and comparing it to the hashed version already stored in the database.
            $this->validatePass = new Encryption();
            $this->encryptedPass = $this->validatePass->eCrypt($this->password, $this->row['salt']);

            // If they match, then we can successfully log the user in.
            if ($this->encryptedPass == $this->row['password']) {

                // Flip status to true
                $this->login_ok = true;

                // Before we redirect the user we will flip the status of active to 1
                // This value is 0 by default and is used to determine if the user is logged in or not.
                // When they logout will we flip it back to 0.
                $query_params = array(':x' => 1, ':y' => $this->row['role']);
                $this->stmt = Database::update("users", "active=:x WHERE userID=:y", $query_params);

                // This sets the users ID in the session. $_SESSION is a super global array stored
                // on the server side. This is useful when you need to access variables across multiple
                // pages. We will use this on the secured pages to check if the user is actually
                // logged in and what their role is.
                $_SESSION['id'] = $this->row['userID'];

                // Before redirecting the user, lets unset all of the sensitive values.
                unset($this->row['email']);
                unset($this->row['username']);
                unset($this->row['salt']);
                unset($this->row['password']);
                unset($_POST['username']);
                unset($_POST['password']);

                $this->secureSession();

            } else {
                echo "Fuck";
                //echo $password;
                //echo $this->row['username'];
                // TODO: Implement some error reporting
                //header("Location: ../index.php");
                //die("Redirecting to: ../index.php");
            }
        } else {
            // TODO: Implement some error reporting

            header("Location: ../index.php");
            die("Redirecting to: ../index.php");
        }
    }

    private function secureSession() {
        if ($this->login_ok) {
            switch ($this->row['role']) {
                case null:
                    header("Location: http://192.168.0.36/undergroundartschool/index.php");
                    die("Redirecting to: http://192.168.0.36/undergroundartschool/index.php");
                    break;
                case "user":
                    header("Location: http://192.168.0.36/undergroundartschool/home/index.php");
                    die("Redirecting to: http://192.168.0.36/undergroundartschool/home/index.php");
                    break;
                case "moderator":
                    header("Location: http://192.168.0.36/undergroundartschool/admin/index.php");
                    die("Redirecting to: http://192.168.0.36/undergroundartschool/admin/index.php");
                    break;
                case "admin":
                    header("Location: http://192.168.0.36/undergroundartschool/admin/index.php");
                    die("Redirecting to: http://192.168.0.36/undergroundartschool/admin/index.php");
                    break;
            }
        } else {
            // TODO: Implement some error reporting
            header("Location: ../index.php");
            die("Redirecting to: ../index.php");
        }
    }
}
