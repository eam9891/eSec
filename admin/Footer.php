<?php
/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 3/3/2017
 * Time: 6:27 PM
 */

namespace admin {

    use framework\libs\AjaxHandler;
    use framework\libs\Authenticate;
    use home\IUserInterface;
    use framework\User;

    class Footer extends IUserInterface {


        public function __construct(User &$USER) {

            $editBlog = "framework_blog_EditBlog";
            $showBlog = "framework_blog_ArticleFactory";
            $newPost = "framework_blog_NewPost";
            $ajax = new AjaxHandler();

            $showBlogParams = array(
                "request" => $showBlog,
                "method" => "getBlog",
                "params" => array(
                    "whichBlog" => "blogMain"
                )

            );
            $ShowBlogButton = $ajax->ajaxButton("AdminClient.php", "showBlog", (array) $showBlogParams);



            $userID = $USER->getUserId();
            $username = $USER->getUsername();
            $newPostParams = array(
                "request" => $newPost,
                "method" => "newPost",
                "params" => array(
                    "userID" => "$userID",
                    "username" => "$username"
                )

            );
            $NewPostButton = $ajax->ajaxButton("AdminClient.php", "newPost", (array) $newPostParams);

            $editBlogParams = array(
                "request" => $editBlog,
                "method" => "request",
                "params" => array(
                    "orderBy" => "postID",
                    "whichOrder" => "DESC"
                )

            );
            $EditBlogButton = $ajax->ajaxButton("AdminClient.php", "editBlog", (array) $editBlogParams);
            $EditBlogRequest = $ajax->ajaxRequest("AdminClient.php", (array) $editBlogParams);

            self::$htmlString = <<<footerUI
            
<script>
    
    function loader() {
        $(document).ajaxStart(function(){
            $("#wait").css("display", "block");
        });
        $(document).ajaxComplete(function(){
            $("#wait").css("display", "none");
        });
    }
            
    $EditBlogRequest
        
    $(document).ready(function() {
        
        $('#blogToolsButton').on('click' , function(){
            $('#blogToolsArrow').toggleClass('glyphicon-menu-down').toggleClass('glyphicon-menu-up');
        });
        
        $('#userToolsButton').on('click' , function(){
            $('#userToolsArrow').toggleClass('glyphicon-menu-down').toggleClass('glyphicon-menu-up');
        });
            
            $ShowBlogButton
            $EditBlogButton
            $NewPostButton
        })
     
</script>
</body>
</html>
        
footerUI;

            parent::__construct("admin", $USER, self::$htmlString);
        }


    }
}