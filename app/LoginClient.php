<?php

/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 2/7/2017
 * Time: 1:13 PM
 */

error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 1);

include_once ('Bouncer.php');

class LoginClient {
    private $login;


    public function __construct() {

        $this->login = new Bouncer();
        $this->login->checkLogin($_POST['username'], $_POST['password']);
    }
}
$worker = new LoginClient();
