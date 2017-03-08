<?php
/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 3/4/2017
 * Time: 9:21 AM
 */

namespace framework\core;


use framework\User;

interface IUserInterface {


    /**
     * IUserInterface constructor.
     *
     * @param string          $authRole
     *
     */
    public function __construct(string &$authRole);
}