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
include_once ('Bouncer.php');
include_once ('User.php');

session_start();

class Security extends ILogin {

    protected $userSalt;
    protected $realPass;

    public function checkLogin($username, $password) {

        $this->username = $username;
        $this->password = $password;

        $this->login_ok = false;

        // First we get the users credentials using the User class.
        $usr = new User();
        $USER = $usr->getUser($this->username);

        // If the USER object return a name here we know it is a registered username and can continue
        if ($USER->getUsername()) {

            // Using the password submitted by the user and the salt stored in the database,
            // we can now check to see whether the passwords match by hashing the submitted password
            // and comparing it to the hashed version already stored in the database.
            $this->validatePass = new Encryption();
            $this->encryptedPass = $this->validatePass->eCrypt($this->password, $USER->getSalt());

            // If they match, then we can successfully log the user in.
            if ($this->encryptedPass == $USER->getPassword()) {

                // Flip login_ok to true
                $this->login_ok = true;

                // Flip active to true
                $USER->setActive(true);

                // To be safe lets unset all of the sensitive values here.
                unset($_POST['username']);
                unset($_POST['password']);

                // The Bouncer will take care of redirecting users based on access level.
                $bouncer = new Bouncer($this->login_ok, $USER);
                $bouncer->secureSession();


            } else {

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
}
