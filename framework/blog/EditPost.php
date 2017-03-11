<?php
/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 3/7/2017
 * Time: 7:32 PM
 */

namespace framework\blog;


use framework\database\Database;
use framework\libs\AjaxHandler;
use framework\libs\Authenticate;

class EditPost {
    private $postID, $postPublished, $table;
    private $error = [];
    public function editPost(array $params) {
        $auth = new Authenticate("contributor");
        if ($auth) {
            if (isset($params['postID'])) {
                $this->postID = $params['postID'];
                unset($params['postID']);
            } else {
                $this->error = "No post ID set!";
            }
            if (isset($params['postPublished'])) {
                $this->postPublished = $params['postPublished'];
                unset($params['postPublished']);
            }

            if ($this->postPublished) {
                $this->table = "blogMain";
            } else {
                $this->table = "blogSubmissions";
            }


            $this->doEdit();


        }
    }

    private function doEdit() {


        if (!isset($error)) {

            $query = "SELECT * FROM $this->table WHERE postID = $this->postID";
            $db = Database::query($query);
            $row = $db->fetch();
            $article = new Article(
                $row['postID'],
                $row['postTitle'],
                $row['postDate'],
                $row['postAuthor'],
                $row['postContent'],
                $row['postPublished']
            );

            $ajax = new AjaxHandler();

            $tinyMce = new TinyMCE();
            $editor = $tinyMce->init();

            echo <<<editPost

<form>
    
    <div class="form-group">
        <label for="postTitle"></label>
        <input type="text" class="form-control" id="postTitle" name="postTitle" value="$article->title" required>
        
    </div>
    
    <textarea class="editable" type="text" id="postCont" name="postCont" >
        $article->content
    </textarea>
    
    
    <button type='submit' class="submitEdits destroyTinyMce" >Submit Edit</button>
</form>

<script>

    $('.submitEdits').on('click' , function(){
    
        
        
        loader();
        
        $.ajax({
            type: "POST",
            url: "AdminClient.php",
            data: {
                'request' : 'framework_blog_SubmitEdits',
                'method'  : 'submitEdits',
                'params'  : {
                    'postID' : "$article->id",
                    'postTitle' : $('#postTitle').val(),
                    'postTable' : "$this->table",
                    'postCont' : $('#postCont').val(),
                    'postAuthor' : "$article->author"
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

$editor
editPost;


        } else {
            echo $this->error;
        }
    }
}