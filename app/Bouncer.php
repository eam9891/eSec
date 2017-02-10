<?php

/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 2/9/2017
 * Time: 10:27 PM
 */

include_once('ILogin.php');
include_once('LoginManager.php');
include_once('Database.php');
include_once('Encryption.php');

class Bouncer extends ILogin {

    public function checkLogin() {
        $this->username = $_POST['username'];
        $this->password = $_POST['password'];

        // First we will query the database and fetch the users details
        // selectAll is part of a custom wrapper around the pdo library.
        // This cleans up your code and makes it easier to query the database
        $row = Database::selectAll("users", "username = ?", [$this->username]);

        // If row returns true here we know the username is valid and registered
        if ($row) {

            // Using the password submitted by the user and the salt stored in the database,
            // we can now check to see whether the passwords match by hashing the submitted password
            // and comparing it to the hashed version already stored in the database.
            $this->validatePass = new Encryption();
            $this->encryptedPass = $this->validatePass->eCrypt($this->password, $row['salt']);

            // If they match, then we can successfully log the user in.
            if ($this->encryptedPass === $row['password']) {

                $this->login_ok = true;
                // Here I am preparing to store the $row array into the $_SESSION by
                // removing the salt and password values from it.  Although $_SESSION is
                // stored on the server-side, there is no reason to store sensitive values
                // in it unless you have to.
                unset($row['salt']);
                unset($row['password']);

                // This stores the user's data into the session at the index 'user'.
                // We will use this index in the Bouncer class to determine whether
                // or not the user is logged in and what their role is.
                //  We can also use it to retrieve the user's details.
                session_start();
                $_SESSION['user'] = $row;

                // Before we redirect the user we will flip the status of active to 1
                // This value is 0 by default and is used to determine if the user is logged in or not.
                // When they logout will we flip it back to 0.
                $query_params = array(
                    ':x' => 1,
                    ':y' => $_SESSION['user']['userID']
                );
                $this->stmt = Database::update("users", "active=:x WHERE userID=:y", $query_params);

                $this->doLogin();

            } else {

                // TODO: Implement some error reporting
                header("Location: ../index.php");
                die("Redirecting to: ../index.php");
            }
        } else {
            // TODO: Implement some error reporting
            header("Location: ../index.php");
            die("Redirecting to: ../index.php");
        }
    }

    protected function doLogin()
    {
        if ($this->login_ok) {
            $logMeIn = new LoginManager();
            $logMeIn->checkLogin();
        } else {
            // TODO: Implement some error reporting
            header("Location: ../index.php");
            die("Redirecting to: ../index.php");
        }
    }
}
$bouncer = new Bouncer();