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

    }

    public function deletePost(array $params) {


        if ($this->auth) {
            if (isset($params['postID'])) {
                $this->postID = $params['postID'];
                unset($params['postID']);
            } else {
                $error = "No post ID set!";
            }
            if (isset($params['postPublished'])) {
                $this->postPublished = $params['postPublished'];
                unset($params['postPublished']);
            }

            if ($this->postPublished) {
                $this->table = "blogMain";
            } else {
                $this->table = "blogSubmissions";
            }

            if (!isset($error)) {

                $query = "SELECT * FROM $this->table WHERE postID = $this->postID";
                Database::query($query);



                header("Location: index.php");
            } else {
                echo $error;
            }
        }
    }

}
