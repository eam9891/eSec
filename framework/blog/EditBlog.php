<?php

/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 2/11/2017
 * Time: 6:07 PM
 */

namespace framework\blog {

    error_reporting(E_ALL | E_STRICT);
    ini_set("display_errors", 1);

    use framework\libs\Authenticate;
    use framework\database\Database;


    class EditBlog {
        private $auth;
        public function request(array $params) {
            $orderBy = $params['orderBy'];
            $whichOrder = $params['whichOrder'];
            $auth = new Authenticate("admin");
            if ($auth) {
                $db = new Database();
                $query = "SELECT * FROM blogMain UNION SELECT * FROM blogSubmissions ORDER BY $orderBy $whichOrder";
                $blogPosts = $db->query($query);
                echo <<<'editBlogUI'
        
            <script>
                $('.deletePost').on('click' , function(){
                      
                    var dataString = { 
                        'request'       : 'DeletePost',
                        'postID'        : $(this).val(),
                        'postPublished' : $('.postPublished').val()
                    };
                    
                    loader();
                    $.ajax({
                        type: "POST",
                        url: "AdminClient.php",
                        data: dataString,
                        cache: false,
                        success : function(data) {
                            $("#blog").html(data);
                        }
                    });
                    return false;
                });
                
                $('.publishPost').on('click' , function(){
                      
                    var dataString = { 
                        'request'       : 'PublishPost',
                        'postID'        : $(this).val()
                    };
                    
                    loader();
                    $.ajax({
                        type: "POST",
                        url: "AdminClient.php",
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
                        $row['postAuthor'],
                        $row['postContent'],
                        $row['postPublished']
                    );
                    $writer = new AdminWriter($article);


                }
                echo'</tbody>';
                echo'</table>';
                echo'</div>';
            }

        }

    }
}