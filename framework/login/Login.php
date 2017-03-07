<?php

/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 2/17/2017
 * Time: 2:20 AM
 */

namespace framework\login;

error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 1);

use framework\User;

class Login {
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
            $_SESSION['username'] = $this->USER->getUsername();

            switch ($this->USER->getRole()) {
                case null:
                    header("Location: http://192.168.0.132/undergroundartschool/");
                    die("Redirecting to: http://192.168.0.132/undergroundartschool/");
                    break;
                case "user":
                    header("Location: http://192.168.0.132/undergroundartschool/home/");
                    die("Redirecting to: http://192.168.0.132/undergroundartschool/home/");
                    break;
                case "moderator":
                    header("Location: http://192.168.0.132/undergroundartschool/admin/");
                    die("Redirecting to: http://192.168.0.132/undergroundartschool/admin/");
                    break;
                case "admin":
                    header("Location: http://192.168.0.132/undergroundartschool/admin/");
                    die("Redirecting to: http://192.168.0.132/undergroundartschool/admin/");
                    break;
            }
        } else {

            header("Location: http://192.168.0.132/undergroundartschool/");
            die("Redirecting to: http://192.168.0.132/undergroundartschool/");
        }
    }
}