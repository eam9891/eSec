<?php

/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 2/7/2017
 * Time: 1:13 PM
 */

error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 1);
function __autoload($class_name)
{
    include $class_name.'.php';
}

class LoginClient {
    private $login;
    public function __construct() {
        $this->login = new Bouncer();
        $this->login->checkLogin();
    }
}
$worker = new LoginClient();
