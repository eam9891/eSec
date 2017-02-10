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

class Login extends ILogin {

    public function checkLogin() {
        $this->doLogin();

    }

    protected function doLogin() {
        header('../home/index.html');
    }

}