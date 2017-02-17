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
$usr = new User();

$USER = $usr->getUser($_SESSION['id']);
if ($USER->getRole() !== "admin") {
    header("Location: ../index.php");
    die("Redirecting to: ../index.php");

}

class AdminClient {
    private $post;
    private $get;
    private $callClass;

    public function __construct() {
        if (!empty($_POST['request'])) {
            $this->post = $_POST['request'];
            //unset($_POST['request']);
            $this->callClass = new $this->post();
        }
        if (!empty($_GET['request'])) {
            $this->get = $_GET['request'];
            //unset($_GET['adminRequest']);
            $this->callClass = new $this->get();
        }
        $this->callClass->request();
    }
}
$worker = new AdminClient();