<?php
/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 3/7/2017
 * Time: 6:39 PM
 */

namespace framework\core {

    abstract class Client {

        private static $class;
        private static $method;
        private static $params = [];
        private static $error = [];
        private static $auth = false;
        private static $User;

        public function __construct() {

            if (self::$auth) {
                if (!empty($_POST['request'])) {
                    self::$class = $_POST['request'];
                    unset($_POST['request']);
                } else {
                    self::$error = "Error: no request!";
                }

                if (!empty($_POST['method'])) {
                    self::$method = $_POST['method'];
                    unset($_POST['method']);
                } else {
                    self::$error = "Error: no method!";
                }

                if (!empty($_POST['params'])) {
                    self::$params = $_POST['params'];
                    unset($_POST['params']);
                } else {
                    self::$error = "Error: no parameters!";
                }

                if (!isset(self::$error)) {
                    $class = str_replace('_', '\\', self::$class);
                    $method = self::$method;
                    $params = self::$params;
                    $worker = new $class((object) self::$User);
                    $worker->$method((array)$params);
                } else {
                    echo self::$error;
                }
            }
        }
    }
}
