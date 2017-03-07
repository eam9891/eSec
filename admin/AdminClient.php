<?php

/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 2/11/2017
 * Time: 5:55 PM
 */

namespace admin {

    error_reporting(E_ALL | E_STRICT);
    ini_set("display_errors", 1);

    spl_autoload_register(function($class) {
        include $_SERVER['DOCUMENT_ROOT'] . "/undergroundartschool/" . str_replace('\\', '/', $class) . '.php';

    });


    use framework\libs\Authenticate;


    class AdminClient {

        private $class;
        private $method;
        private $params;
        private $auth;



        public function __construct() {

            $this->auth = new Authenticate("admin");

            $isEverythingSet = false;

            if (!empty($_POST['request'])) {
                $this->class = $_POST['request'];
                unset($_POST['request']);
                $isEverythingSet = true;
            }

            if (!empty($_POST['method'])) {
                $this->method = $_POST['method'];
                unset($_POST['method']);
                $isEverythingSet = true;
            }

            if (!empty($_POST['params'])) {
                $this->params = $_POST['params'];
                unset($_POST['params']);
                $isEverythingSet = true;
            }

            if ($isEverythingSet) {

                $this->class = str_replace('_', '\\', $this->class);
                $class = new $this->class();
                $method = $this->method;
                $class->$method($this->params);

            }
        }
    }

    $worker = new AdminClient();
}