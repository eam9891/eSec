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
                        theme: 'modern',
                        plugins: [
                            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                            'searchreplace wordcount visualblocks visualchars code fullscreen',
                            'insertdatetime media nonbreaking save table contextmenu directionality',
                            'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
                        ],
                        toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                        toolbar2: 'print preview media | fontselect forecolor backcolor emoticons | codesample',
                        image_advtab: true,
                        templates: [
                            { title: 'Test template 1', content: 'Test 1' },
                            { title: 'Test template 2', content: 'Test 2' }
                        ],
                        content_css: [
                            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                            '//www.tinymce.com/css/codepen.min.css'
                        ],
                        font_formats: 'Andale Mono=andale mono,times;Arial=arial,helvetica,sans-serif;Arial Black=arial black,avant garde;Book Antiqua=book antiqua,palatino;Comic Sans MS=comic sans ms,sans-serif;Courier New=courier new,courier;Georgia=georgia,palatino;Helvetica=helvetica;Impact=impact,chicago;Symbol=symbol;Tahoma=tahoma,arial,helvetica,sans-serif;Terminal=terminal,monaco;Times New Roman=times new roman,times;Trebuchet MS=trebuchet ms,geneva;Verdana=verdana,geneva;Webdings=webdings;Wingdings=wingdings,zapf dingbats'
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
                
                
                
                
                
                
                <div class="editable">
                    
                
                    <h1>
                        <input type='text'  id="postTitle" name='postTitle' placeholder="Enter Post Title Here">
                    </h1>
                
                    <p>
                        <textarea  id="postDesc" name='postDesc' cols='60' rows='10' placeholder="Enter Description Here"></textarea>
                    </p>
                
                    <p>
                        <textarea  id="postCont" name='postCont' cols='60' rows='10' placeholder="Enter Content Here"></textarea>
                    </p>
                        
                    
                   
                    
                </div>
                <input type="hidden" id="postAuthor" name="postAuthor" value=$this->user>
                <p><button id='submitPost' type='submit' name='request' value='SubmitPost'>Submit Post</button></p>
                
                
            
newPost;
        }

    }
}