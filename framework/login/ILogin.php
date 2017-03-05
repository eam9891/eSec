<?php

/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 2/10/2017
 * Time: 11:16 AM
 */

namespace framework\login;

abstract class ILogin {

    protected $username;
    protected $password;
    protected $encryptedPass;
    protected $validatePass;
    protected $stmt;
    protected $login_ok = false;
    protected $row;
    protected $userID;

    public abstract function checkLogin($username, $password);
}