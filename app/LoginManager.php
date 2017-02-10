<?php

/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 2/8/2017
 * Time: 7:31 PM
 */

error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 1);

include_once('ILogin.php');

class LoginManager extends ILogin {

    protected $role;

    public function checkLogin() {
        $this->doLogin();
    }

    protected function doLogin() {
        $this->role = $_SESSION['user']['role'];

        switch ($_SESSION['user']['role']) {
            case null:
                header("Location: ../index.php");
                die("Redirecting to: ../index.php");
                break;
            case "user":
                header("Location: ../home/index.html");
                die("Redirecting to: ../home/index.html");
                break;
            case "moderator":
                header("Location: ../admin/index.html");
                die("Redirecting to: ../admin/index.html");
                break;
            case "admin":
                header("Location: ../admin/index.html");
                die("Redirecting to: ../admin/index.html");
                break;
        }


    }

}