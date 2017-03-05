<?php

/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 2/28/2017
 * Time: 3:43 PM
 */

namespace framework\libs;

class Loader {
    public $worker;
    public function __construct() {

        error_reporting(E_ALL);
        ini_set("display_errors", 1);

        spl_autoload_register(function($class) {
            include '/var/www/html/undergroundartschool/' . str_replace('\\', '/', $class) . '.php';
        });
    }
}
$this->worker = new Loader();