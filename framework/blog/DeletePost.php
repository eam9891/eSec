<?php
/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 3/5/2017
 * Time: 9:09 PM
 */

namespace framework\blog;

error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 1);

spl_autoload_register(function($class) {
    include $_SERVER['DOCUMENT_ROOT'] . "/undergroundartschool/" . str_replace('\\', '/', $class) . '.php';

});

use framework\database\Database;
use framework\libs\Authenticate;

class DeletePost {
    private $auth, $postID, $table, $postPublished, $query_params;

    public function __construct() {
        $this->auth = new Authenticate("admin");
        if ($this->auth) {
            $this->deletePost();
        }
    }

    private function deletePost() {

        if (isset($_POST['postID'])) {
            $this->postID = $_POST['postID'];
            unset($_POST['postID']);
        } else {
            $error = "No post ID set!";
        }
        if (isset($_POST['postPublished'])) {
            $this->postPublished = $_POST['postPublished'];
            unset($_POST['postPublished']);
        }

        if ($this->postPublished) {
            $this->table = "blogMain";
        } else {
            $this->table = "blogSubmissions";
        }

        if (!isset($error)) {
            $db = new Database();
            $query = "DELETE FROM $this->table WHERE postID = $this->postID";
            $db = $db->connect();
            $db->exec($query);

            header("Location: index.php");
        } else {
            echo $error;
        }



    }

}

$worker = new DeletePost();