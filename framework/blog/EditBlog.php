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

    use framework\libs\AjaxHandler;
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



                echo $tableHead = <<<tableHead

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
                
tableHead;

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


                $deletePost = "framework_blog_DeletePost";
                $publish = "framework_blog_PublishPost";
                $editPost = "framework_blog_EditPost";

                echo $string = <<<ajaxRequest

                    <script>
                    
                        $('.editPost').on('click' , function(){
                            loader();
                            
                            $.ajax({
                                type: "POST",
                                url: "AdminClient.php",
                                data: {
                                    'request' : '$editPost',
                                    'method'  : 'editPost',
                                    'params'  : {
                                        'postID' : $(this).val(),
                                        'postPublished' : $('.postPublished').val()
                                    }
                                },
                                cache: false,
                                success : function(data) {
                                    $("#display").html(data);
                                }
                            });
                            return false;
                        });
                    
                        $('.deletePost').on('click' , function(){
                            loader();
                            
                            $.ajax({
                                type: "POST",
                                url: "AdminClient.php",
                                data: {
                                    'request' : '$deletePost',
                                    'method'  : 'deletePost',
                                    'params'  : {
                                        'postID' : $(this).val(),
                                        'postPublished' : $('.postPublished').val()
                                    }
                                },
                                cache: false,
                                success : function(data) {
                                    $("#display").html(data);
                                }
                            });
                            return false;
                        });
                        
                        $('.publishPost').on('click' , function(){
                            loader();
                            
                            $.ajax({
                                type: "POST",
                                url: "AdminClient.php",
                                data: {
                                    'request' : '$publish',
                                    'method'  : 'publishPost',
                                    'params'  : {
                                        'postID' : $(this).val()
                                    }
                                },
                                cache: false,
                                success : function(data) {
                                    $("#display").html(data);
                                }
                            });
                            return false;
                        });
                    </script>
                    </tbody>
                    </table>
                    </div>
               
ajaxRequest;


            }

        }

    }
}