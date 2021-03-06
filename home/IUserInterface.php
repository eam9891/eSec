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
        protected static $USER;


        /**
         * IUserInterface constructor.
         *
         * @param string          $authType
         * @param \framework\User $USER
         * @param                 $html
         */
        public function __construct(string $authType, User &$USER, &$html) {
            self::$auth = new Authenticate($authType);

            self::$USER =& $USER;

            if (self::$auth) {
                self::$htmlString =& $html;
                $this->showUI();
            }
        }

        private function showUI () {
            echo self::$htmlString;
        }
    }
}