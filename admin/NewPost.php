<?php
/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 3/4/2017
 * Time: 6:15 PM
 */

namespace admin {

    use framework\libs\Authenticate;
    use framework\User;

    class NewPost {
        private $user, $role;
        public function __construct(Authenticate $auth, User &$USER) {
            if ($auth) {
                $this->showUI($USER);
            }
        }

        private function showUI(User &$USER) {
            $this->user = $USER->getUsername();
            $this->role = $USER->getRole();

            echo <<<newPost

                <script>
                    tinymce.init({
                        selector: ".editable",
                        setup: function (editor) {
                            editor.on('change', function () {
                                editor.save();
                            });
                        },
                        plugins: [
                            "advlist autolink lists link image charmap print preview anchor",
                            "searchreplace visualblocks code fullscreen",
                            "insertdatetime media table contextmenu paste"
                        ],
                        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                    });
                    $(document).on('focusin', function(e) {
                        if ($(e.target).closest(".mce-window").length) {
                            e.stopImmediatePropagation();
                        }
                    });
                    
                    $('#submitPost').on('click' , function(){
                       
                        
                        var dataString = { 
                            'postTitle'  : $('#postTitle').val(),
                            'postDesc'   : $('#postDesc').val(),
                            'postCont'   : $('#postCont').val(),
                            'postAuthor' : $('#postAuthor').val()
                        };
                        
                        loader();
                        $.ajax({
                            type: "POST",
                            url: "SubmitPost.php",
                            data: dataString,
                            cache: false,
                            success : function(data) {
                                $("#blog").html(data);
                            }
                        });
                        return false;
                    });
                    
                    
                </script>
                
                
                <h2>Add Post</h2>
                
                
                <p><label>Title</label><br />
                    <input type='text' class="editable" id="postTitle" name='postTitle'></p>
            
                <p><label>Description</label><br />
                    <textarea class="editable" id="postDesc" name='postDesc' cols='60' rows='10'></textarea>
                </p>
            
                <p><label>Content</label><br />
                    <textarea class="editable" id="postCont" name='postCont' cols='60' rows='10'></textarea>
                </p>
                    
                <input type="hidden" id="postAuthor" name="postAuthor" value=$this->user>
               
                <p><button id='submitPost' type='submit' name='request' value='SubmitPost'>Submit Post</button></p>
                
                
            
newPost;
        }

    }
}