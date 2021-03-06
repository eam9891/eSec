<?php
/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 3/4/2017
 * Time: 7:03 PM
 */

namespace framework\blog {

    error_reporting(E_ALL | E_STRICT);
    ini_set("display_errors", 1);

    use framework\database\Database;
    use framework\libs\Authenticate;


    class SubmitPost {
        private $postTitle, $postCont, $postAuthor;

        public function submitPost(array $params) {

            $auth = new Authenticate("contributor");

            // Make sure we have an author!
            if(isset($params['postAuthor'])) {
                $this->postAuthor = $params['postAuthor'];
                unset($params['postAuthor']);
            } else {
                $error[] = 'Error: No author for post.';
            }

            // Make sure we have a title
            if(isset($params['postTitle'])) {
                $this->postTitle = $params['postTitle'];
                unset($params['postTitle']);
            } else {
                $error[] = 'Please enter the title.';
            }

            // Make sure we have content
            if(isset($params['postCont'])) {
                $this->postCont = $params['postCont'];
                unset($params['postCont']);
            } else {
                $error[] = 'Please enter the content.';
            }


            if(!isset($error)){

                try {

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
                    Database::insert($query, $query_params);

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
}