<?php

/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 2/10/2017
 * Time: 11:16 AM
 */
abstract class ILogin {
    public abstract function checkLogin();
    protected abstract function doLogin();
    protected $username;
    protected $password;
    protected $encryptedPass;
    protected $validatePass;
    protected $stmt;
    protected $login_ok = false;
    protected $_USER;
    protected $userID;

}