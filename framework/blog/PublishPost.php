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

    spl_autoload_register(function($class) {
        include $_SERVER['DOCUMENT_ROOT'] . "/undergroundartschool/" . str_replace('\\', '/', $class) . '.php';

    });

    use framework\database\Database;
    use framework\libs\Authenticate;

    class PublishPost {
        public function __construct() {
            $auth = new Authenticate("admin");
            if ($auth) {
                $this->publishPost();
            }
        }

        private function publishPost() {
            if (isset ($_POST['postID'])) {
                $id = $_POST['postID'];

                $query = "INSERT INTO blogMain (postID, postTitle, postContent, postDate, postAuthor, postPublished) 
                  SELECT postID, postTitle, postContent, postDate, postAuthor, postPublished FROM blogSubmissions WHERE postID = $id";

                Database::query($query);

                $deleteOld = "DELETE FROM blogSubmissions WHERE postID = $id";
                Database::query($deleteOld);

            }



            header("Location: index.php");
        }
    }

}