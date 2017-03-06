<?php

/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 2/11/2017
 * Time: 5:55 PM
 */

namespace admin {

    error_reporting(E_ALL | E_STRICT);
    ini_set("display_errors", 1);

    spl_autoload_register(function($class) {
        include $_SERVER['DOCUMENT_ROOT'] . "/undergroundartschool/" . str_replace('\\', '/', $class) . '.php';

    });

    use framework\blog\ArticleFactory;
    use framework\blog\DeletePost;
    use framework\libs\Authenticate;
    use framework\User;

    class AdminClient {
        private $post;
        private $get;
        private $callClass;
        private $auth;
        private $USER;


        public function __construct() {

            $this->auth = new Authenticate("admin");
            $this->USER = new User();
            $this->USER = $this->USER->getUser($_SESSION['username']);

            //if (!empty($_POST['USER'])) {
            //    $this->USER = $_POST['USER'];
            //    unset($_POST['USER']);
            //}

            if (!empty($_POST['request'])) {
                $this->post = $_POST['request'];
                unset($_POST['request']);

                switch ($this->post) {
                    case "EditBlog" :
                        $this->callClass = new EditBlog();
                        echo $this->callClass->request($this->auth, "postID", "DESC");
                        break;
                    case "ArticleFactory" :
                        $this->callClass = new ArticleFactory("blogMain", "getBlog");
                        break;
                    case "NewPost" :
                        $this->callClass = new NewPost($this->auth, $this->USER);
                        break;
                    case "SubmitPost" :
                        $this->callClass = new SubmitPost();
                        break;
                    case "DeletePost" :
                        $this->callClass = new DeletePost();
                        break;
                }


            }

            if (!empty($_GET['request'])) {
                $this->get = $_GET['request'];
                unset($_GET['adminRequest']);
                $this->callClass = new $this->get();
            }



        }
    }


    $worker = new AdminClient();
}