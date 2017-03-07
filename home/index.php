<?php

namespace home;

error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 1);

spl_autoload_register(function($class) {
    include '/var/www/html/undergroundartschool/' . str_replace('\\', '/', $class) . '.php';

});

use framework\libs\Authenticate;
use framework\User;

$auth = new Authenticate("user");
$usr = new User();
$USER = $usr->getUser($_SESSION['username']);


$head   = new Head  ($USER);
$header = new Header($USER);
$body   = new Body  ($USER);
$footer = new Footer($USER);
?>




