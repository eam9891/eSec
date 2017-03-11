<?php
/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 3/9/2017
 * Time: 11:31 AM
 */

namespace framework\blog;

error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 1);


use framework\database\Database;
use framework\libs\Authenticate;

class RevertPost {

    private $auth;
    public function __construct() {
        $this->auth = new Authenticate("admin");

    }

    public function revertPost(array $params) {
        $postID = $params['postID'];

        if ($this->auth) {
            if (isset ($postID)) {



                $query = "
                        INSERT INTO blogSubmissions (postID, postTitle, postContent, postDate, postAuthor, postPublished) 
                        SELECT postID, postTitle, postContent, postDate, postAuthor, postPublished 
                        FROM blogMain WHERE postID = $postID
                    ";
                Database::query($query);

                $deleteOld = "DELETE FROM blogMain WHERE postID = $postID";
                Database::query($deleteOld);

                $query = "
                        UPDATE blogSubmissions SET postPublished = false
                    ";
                Database::query($query);

                header("Location: index.php");

            }
        }


    }

}