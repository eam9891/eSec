<?php
/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 3/4/2017
 * Time: 7:03 PM
 */

namespace app\admin;

use framework\database\Database;
use framework\libs\Authenticate;


class SubmitPost {
    private $postTitle, $postDesc, $postCont, $postAuthor, $role;

    public function __construct() {

        $auth = new Authenticate("admin");

        //if form has been submitted process it
        if(isset($_POST['submit'])){

            if(isset($_POST['user'])) {
                $this->postAuthor = $_POST['user'];
            }
            if(isset($_POST['role'])) {
                $this->role = $_POST['role'];
            }
            if(isset($_POST['postTitle'])) {
                $this->postTitle = $_POST['postTitle'];
            } else {
                $error[] = 'Please enter the title.';
            }
            if(isset($_POST['postDesc'])) {
                $this->postDesc = $_POST['postDesc'];
            } else {
                $error[] = 'Please enter the description.';
            }
            if(isset($_POST['postCont'])) {
                $this->postCont = $_POST['postCont'];
            } else {
                $error[] = 'Please enter the content.';
            }


            if(!isset($error)){

                try {
                    $db = new Database();
                    //insert into database
                    $query = '
                            INSERT INTO blogSubmissions (postTitle,postDescription,postContent,postDate,postAuthor) 
                            VALUES (:postTitle, :postDesc, :postCont, :postDate, :postAuthor)
                        ';
                    $query_params = array(
                        ':postTitle' => $this->postTitle,
                        ':postDesc' => $this->postDesc,
                        ':postCont' => $this->postCont,
                        ':postDate' => date('Y-m-d H:i:s'),
                        ':postAuthor' => $this->postAuthor
                    );
                    $db->insert($query, $query_params);

                    //redirect to index page
                    header('Location: 192.168.0.132/undergroundartschool/'.$this->role.'/');
                    exit;

                } catch(\PDOException $e) {
                    echo $e->getMessage();
                }

            }
        }
    }
}