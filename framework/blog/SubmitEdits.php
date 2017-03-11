<?php
/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 3/9/2017
 * Time: 5:57 PM
 */

namespace framework\blog {


    use framework\database\Database;
    use framework\libs\Authenticate;

    class SubmitEdits {
        private $postTitle, $postCont, $postAuthor, $postTable, $postID;

        public function submitEdits(array $params) {

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

            // Make sure we know which table to store it in
            if(isset($params['postTable'])) {
                $this->postTable = $params['postTable'];
                unset($params['postTable']);
            } else {
                $error[] = 'Error: Undefined Table!';
            }

            // Make sure we know which table to store it in
            if(isset($params['postID'])) {
                $this->postID = $params['postID'];
                unset($params['postID']);
            } else {
                $error[] = 'Error: Undefined postID!';
            }


            if(!isset($error)){


                try {

                    $setString = "
                        postTitle = :postTitle, postContent = :postCont, postAuthor = :postAuthor
                        WHERE postID = :postID
                    ";
                    $query_params = array(
                        ":postID" => $this->postID,
                        ':postTitle' => $this->postTitle,
                        ':postCont' => $this->postCont,
                        ':postAuthor' => $this->postAuthor
                    );
                    Database::update($this->postTable, $setString, $query_params);

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