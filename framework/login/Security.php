<?php

/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 2/9/2017
 * Time: 10:27 PM
 */

namespace framework\login;

error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 1);

session_start();

use framework\User;
use framework\libs\Encryption;

class Security extends ILogin {

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

                // The Bouncer will take care of redirecting users based on access level.
                $bouncer = new Login($this->login_ok, $USER);
                $bouncer->secureSession();


            } else {
                header("Location: http://192.168.0.132/undergroundartschool/");
                die("Redirecting to: http://192.168.0.132/undergroundartschool/");
            }
        } else {
            header("Location: http://192.168.0.132/undergroundartschool/");
            die("Redirecting to: http://192.168.0.132/undergroundartschool/");
        }
    }
}
