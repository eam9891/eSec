<?php
/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 3/3/2017
 * Time: 2:40 PM
 */

namespace home {

    use framework\libs\Authenticate;
    use framework\User;

    class Footer extends IUserInterface {

        public function __construct(User &$USER) {
            self::$htmlString = <<<footerUI
            <footer class="container-fluid text-center">
                <p>Footer Text</p>
            </footer>
            
            </body>
            </html>
           
footerUI;
            parent::__construct("user", $USER, self::$htmlString);
        }
    }
}