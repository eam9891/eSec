<?php

/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 2/7/2017
 * Time: 1:13 PM
 */

namespace framework\login;

error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 1);

spl_autoload_register(function($class) {
    include '/var/www/html/undergroundartschool/' . str_replace('\\', '/', $class) . '.php';
});

class LoginClient {
    private $login;
    private $username;
    private $password;

    public function __construct() {

        $this->username = $_POST['username'];
        $this->password = $_POST['password'];
        unset ($_POST['username']);
        unset ($_POST['password']);

        $this->login = new Security();
        $this->login->checkLogin($this->username, $this->password);
    }
}
$worker = new LoginClient();
