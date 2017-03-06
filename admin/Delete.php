<?php
/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 3/5/2017
 * Time: 10:49 PM
 */

namespace admin;


use framework\libs\Authenticate;

class Delete {
    public function __construct() {
        $auth = new Authenticate("admin");
        if ($auth) {

        }
    }
}