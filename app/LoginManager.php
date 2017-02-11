<?php

/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 2/8/2017
 * Time: 7:31 PM
 */

error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 1);

class LoginManager extends ILogin {

    protected $role;

    public function checkLogin() {
        $this->doLogin();
    }

    protected function doLogin() {
        $this->secureSession();
    }

    public function secureSession() {
        $userID = $_SESSION['user']['userID'];
        $worker = new User();
        $_USER = $worker->getUser($userID);
        $role = $_USER->getRole();

        switch ($role) {
            case null:
                header("Location: 192.168.0.36/undergroundartschool/index.php");
                break;
            case "user":
                header("Location: 192.168.0.36/undergroundartschool/home/index.php");
                break;
            case "moderator":
                header("Location: 192.168.0.36/undergroundartschool/admin/index.php");
                break;
            case "admin":
                header("Location: 192.168.0.36/undergroundartschool/admin/index.php");
                break;
        }
        return $_USER;
    }

}