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

    class EditBlog {

        public function request(array $params) {
            $tinyMce = new TinyMCE();
            $tinyMce->destroy();
            $auth = new Authenticate("admin");
            $ajax = new AjaxHandler();
            if ($auth) {

                echo $tableHead = <<<tableHead

<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            
            <strong><i>
                Admin >> Edit Blog
            </i></strong>
            
            <select class="form-control" style="width: 20%; float: right;">
                <option value="" disabled selected>Order By: </option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="1">3</option>
            </select>
            <tr>
                <th>Title</th>
                <th>Date</th>
                <th>Author</th>
                <th>Action</th>
            </tr>
            
            
        </thead>
        <tbody style="text-align: left;">    
                
tableHead;

                $editBlog = new ArticleFactory();
                $editBlog->editBlog((array) $params);

                $data = array(
                    "request" => "framework_blog_EditBlog",
                    "method" => "request",
                    "params" => $params

                );
                $successRequest = $ajax->ajaxRequest("AdminClient.php", (array) $data);
                $deletePost = "framework_blog_DeletePost";
                $publish = "framework_blog_PublishPost";
                $editPost = "framework_blog_EditPost";
                $revertPost = "framework_blog_RevertPost";

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
            success : function() {
                $successRequest
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
            success : function() {
                $successRequest
            }
        });
        return false;
    });
    
    $('.revertPost').on('click' , function(){
        loader();
        
        $.ajax({
            type: "POST",
            url: "AdminClient.php",
            data: {
                'request' : '$revertPost',
                'method'  : 'revertPost',
                'params'  : {
                    'postID' : $(this).val()
                }
            },
            cache: false,
            success : function() {
                $successRequest
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