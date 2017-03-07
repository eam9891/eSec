<?php
/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 3/5/2017
 * Time: 12:41 PM
 */

namespace admin {

    error_reporting(E_ALL | E_STRICT);
    ini_set("display_errors", 1);

    spl_autoload_register(function($class) {
        include '/var/www/html/undergroundartschool/' . str_replace('\\', '/', $class) . '.php';

    });

    use framework\libs\Authenticate;
    use framework\User;
    use home\Header;

    $auth = new Authenticate("admin");
    $usr = new User();
    $USER = $usr->getUser($_SESSION['username']);

    $head   = new Head  ($USER);
    $header = new Header($USER);
    $body   = new Body  ($USER);
    $footer = new Footer($USER);
}