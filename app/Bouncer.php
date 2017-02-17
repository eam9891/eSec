<?php

/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 2/17/2017
 * Time: 2:20 AM
 */

error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 1);


class Bouncer {
    private $loginOk;
    private $USER;
    public function __construct($loginOK, User $obj) {
        $this->USER = $obj;
        $this->loginOk = $loginOK;
    }
    public function secureSession() {
        // Just to double check if the login was ok before redirection
        if ($this->loginOk) {

            // Just before redirection we start a session and store the username in it.
            // This will be used at the top of each page to validate the user.
            session_start();
            $_SESSION['user'] = $this->USER->getUsername();

            switch ($this->USER->getRole()) {
                case null:
                    header("Location: http://192.168.0.36/undergroundartschool/");
                    die("Redirecting to: http://192.168.0.36/undergroundartschool/");
                    break;
                case "user":
                    header("Location: http://192.168.0.36/undergroundartschool/home/");
                    die("Redirecting to: http://192.168.0.36/undergroundartschool/home/");
                    break;
                case "moderator":
                    header("Location: http://192.168.0.36/undergroundartschool/admin/");
                    die("Redirecting to: http://192.168.0.36/undergroundartschool/admin/");
                    break;
                case "admin":
                    header("Location: http://192.168.0.36/undergroundartschool/admin/");
                    die("Redirecting to: http://192.168.0.36/undergroundartschool/admin/");
                    break;
            }
        } else {
            // TODO: Implement some error reporting
            header("Location: ../index.php");
            die("Redirecting to: ../index.php");
        }
    }
}