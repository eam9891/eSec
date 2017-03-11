<?php
/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 3/5/2017
 * Time: 11:29 PM
 */

namespace framework\blog {

    error_reporting(E_ALL | E_STRICT);
    ini_set("display_errors", 1);


    use framework\database\Database;
    use framework\libs\Authenticate;

    class PublishPost {
        private $auth;
        public function __construct() {
            $this->auth = new Authenticate("admin");

        }

        public function publishPost(array $params) {
            $postID = $params['postID'];

            if ($this->auth) {
                if (isset ($postID)) {



                    $query = "
                        INSERT INTO blogMain (postID, postTitle, postContent, postDate, postAuthor, postPublished) 
                        SELECT postID, postTitle, postContent, postDate, postAuthor, postPublished 
                        FROM blogSubmissions WHERE postID = $postID
                    ";
                    Database::query($query);

                    $deleteOld = "DELETE FROM blogSubmissions WHERE postID = $postID";
                    Database::query($deleteOld);

                    $query = "
                        UPDATE blogMain SET postPublished = true
                    ";
                    Database::query($query);

                    header("Location: index.php");

                }
            }


        }
    }

}