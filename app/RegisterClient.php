<?php

/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 2/7/2017
 * Time: 3:36 PM
 */

error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 1);

// Autoload given function name.
function includeAll($className)
{
    include_once($className . '.php');
}
//Register
spl_autoload_register('includeAll');

class RegisterClient {

    public function __construct($user, $pw, $email) {

        $register = new Register();
        $register->doRegistration($user, $pw, $email);
    }
}
$worker = new RegisterClient($_POST['username'], $_POST['password'], $_POST['email']);
