<?php
/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 3/7/2017
 * Time: 6:39 PM
 */

namespace framework\core;


use framework\libs\Authenticate;
use framework\User;

abstract class Client implements IUserInterface {

    private static $class;
    private static $method;
    private static $params;
    private static $auth;
    private static $User;
    private static $isEverythingSet = false;

    public function __construct(string &$authRole) {

        self::$auth = new Authenticate($authRole);
        //self::$User =& $User;

        if (self::$auth) {
            $this->getRequests();
        }

    }

    private function getRequests() {

        if (!empty($_POST['request'])) {
            self::$class = $_POST['request'];
            unset($_POST['request']);
            self::$isEverythingSet = true;
        }

        if (!empty($_POST['method'])) {
            self::$method = $_POST['method'];
            unset($_POST['method']);
            self::$isEverythingSet = true;
        }

        if (!empty($_POST['params'])) {
            self::$params = $_POST['params'];
            unset($_POST['params']);
            self::$isEverythingSet = true;
        }

        if (self::$isEverythingSet) {

            $class = str_replace('_', '\\', self::$class);
            $method = self::$method;
            $params = self::$params;

            $worker = new $class(self::$User);
            $worker->$method($params);

        }
    }
}