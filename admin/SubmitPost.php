<?php
/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 3/4/2017
 * Time: 7:03 PM
 */

namespace admin {

    error_reporting(E_ALL | E_STRICT);
    ini_set("display_errors", 1);

    spl_autoload_register(function($class) {
        include $_SERVER['DOCUMENT_ROOT'] . "/undergroundartschool/" . str_replace('\\', '/', $class) . '.php';

    });

    use framework\database\Database;
    use framework\libs\Authenticate;
    use framework\User;


    class SubmitPost {
        private $postTitle, $postDesc, $postCont, $postAuthor;

        public function __construct() {

            $auth = new Authenticate("contributor");


            if(isset($_POST['postAuthor'])) {
                $this->postAuthor = $_POST['postAuthor'];
                unset($_POST['postAuthor']);
            } else {
                $error[] = 'Error: No author for post.';
            }
            if(isset($_POST['postTitle'])) {
                $this->postTitle = $_POST['postTitle'];
                unset($_POST['postTitle']);
            } else {
                $error[] = 'Please enter the title.';
            }

            if(isset($_POST['postCont'])) {
                $this->postCont = $_POST['postCont'];
                unset($_POST['postCont']);
            } else {
                $error[] = 'Please enter the content.';
            }



            if(!isset($error)){

                try {
                    $db = new Database();
                    //insert into database
                    $query = '
                            INSERT INTO blogSubmissions (postTitle,postContent,postAuthor) 
                            VALUES (:postTitle, :postCont, :postAuthor)
                        ';
                    $query_params = array(
                        ':postTitle' => $this->postTitle,
                        ':postCont' => $this->postCont,
                        ':postAuthor' => $this->postAuthor
                    );
                    $db->insert($query, $query_params);

                    //redirect to index page
                    //header('Location: 192.168.0.132/undergroundartschool/'.$this->role.'/');
                    header("Location: index.php");

                } catch(\PDOException $e) {
                    echo $e->getMessage();
                }

            } else {
                foreach ($error as $err) {
                    echo $err;
                }

            }
        }
    }
    $worker = new SubmitPost();
}