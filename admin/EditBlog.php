<?php

/**
    * Created by PhpStorm.
    * User: Ethan
    * Date: 2/11/2017
    * Time: 6:07 PM
    */

namespace admin;

error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 1);


use framework\blog\AdminWriter;
use framework\blog\Article;
use framework\libs\Authenticate;
use framework\database\Database;


class EditBlog {
    private $auth;
    public function request(Authenticate &$auth, $orderBy, $whichOrder) {
        $this->auth = $auth;
        if ($auth) {
            $db = new Database();
            $query = "SELECT * FROM blogMain UNION SELECT * FROM blogSubmissions ORDER BY $orderBy $whichOrder";
            $blogPosts = $db->query($query);
            echo <<<'editBlogUI'
        
            <script>
                $('.deletePost').on('click' , function(){
                      
                        var dataString = { 
                            'postID'        : $(this).val(),
                            'postPublished' : $('.postPublished').val()
                        };
                        
                        loader();
                        $.ajax({
                            type: "POST",
                            url: "DeletePost.php",
                            data: dataString,
                            cache: false,
                            success : function(data) {
                                $("#blog").html(data);
                            }
                        });
                        return false;
                    });
            </script>
        
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Author</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody style="text-align: left;">
      
editBlogUI;
            while($row = $blogPosts->fetch()){
                $article = new Article(
                    $row['postID'],
                    $row['postTitle'],
                    $row['postDate'],
                    $row['postDescription'],
                    $row['postAuthor'],
                    $row['postContent'],
                    $row['postPublished']
                );
                $writer = new AdminWriter($auth, $article);


            }
            echo'</tbody>';
            echo'</table>';
            echo'</div>';
        }

    }

}