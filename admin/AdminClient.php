<?php

/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 2/11/2017
 * Time: 5:55 PM
 */

error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 1);


include_once ('ViewBlog.php');
include_once ('../app/blog/ArticleFactory.php');

class AdminClient {
    private $request;
    private $callClass;

    public function __construct() {
        $this->request = $_POST['request'];
        $this->callClass = new $this->request();
        echo $this->callClass->adminRequest();
    }
}
$worker = new AdminClient();