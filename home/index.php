<?php

namespace home;

error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 1);

spl_autoload_register(function($class) {
    include '/var/www/html/undergroundartschool/' . str_replace('\\', '/', $class) . '.php';

});

use framework\libs\Authenticate;
use framework\User;

$auth = new Authenticate("user");
$usr = new User();
$USER = $usr->getUser($_SESSION['username']);


//show message from add / edit page
/*if(isset($_GET['delpost'])){
    //DELETE FROM front_blog WHERE postID = :postID
    //$stmt->execute(array(':postID' => $_GET['delpost']));
    $db->deleteWhere("front_blog", "postID = ?", $_GET['delpost']);
    header('Location: index.php?action=deleted');
    exit;
}*/

$head   = new Head  ($auth, $USER);
$header = new Header($auth, $USER);
$body   = new Body  ($auth, $USER);
$footer = new Footer($auth, $USER);
?>




