<?php
/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 3/7/2017
 * Time: 6:43 PM
 */

namespace framework\core;


use framework\libs\Authenticate;
use framework\User;

abstract class UserInterface implements IUserInterface {
    protected static $auth;
    protected static $htmlString;
    protected static $User;

    public function __construct(string &$authType) {
        self::$auth = new Authenticate($authType);
        //self::$User =& $User;

    }

    public static function constructHtmlString(string &$html) {
        if (self::$auth) {
            self::$htmlString =& $html;
            UserInterface::showUI();
        }

    }

    private static function showUI () {
        echo self::$htmlString;
    }
}