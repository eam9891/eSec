<?php
/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 3/3/2017
 * Time: 3:26 PM
 */

namespace home {

    use framework\libs\Authenticate;
    use framework\User;

    abstract class IUserInterface {

        protected static $auth;
        protected static $htmlString;


        public function __construct(Authenticate &$auth, User &$USER, &$html) {
            self::$auth = $auth;

            if (self::$auth) {
                self::$htmlString = &$html;
                $this->showUI();
            }
        }

        private function showUI () {
            echo self::$htmlString;
        }
    }
}