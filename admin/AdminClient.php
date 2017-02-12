<?php

/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 2/11/2017
 * Time: 5:55 PM
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

class AdminClient {
    private $request;
    private $callClass;

    public function __construct() {
        $this->request = $_POST['request'];
        $this->callClass = new $this->request();
        echo $this->callClass->returnRequest();
    }
}
$worker = new AdminClient();