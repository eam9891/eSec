<?php
/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 3/4/2017
 * Time: 6:15 PM
 */

namespace framework\blog {

    use framework\libs\Authenticate;
    use framework\User;

    class NewPost {
        private $user;
        public function newPost(array $jsonUserObj) {

            $auth = new Authenticate("contributor");
            if ($auth) {
                $this->user = $jsonUserObj['username'];

                echo <<<newPost

                <script>
                
                    tinymce.init({
                        selector: "textarea.editable",
                        
                        theme: 'modern',
                        setup: function (editor) {
                            editor.on('change', function () {
                                editor.save();
                            });
                        },
                        plugins: [
                            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                            'searchreplace wordcount visualblocks visualchars code fullscreen',
                            'insertdatetime media nonbreaking save table contextmenu directionality',
                            'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
                        ],
                        toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                        toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
                        image_advtab: true,
                        templates: [
                            { title: 'Test template 1', content: 'Test 1' },
                            { title: 'Test template 2', content: 'Test 2' }
                        ],
                        content_css: [
                            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                            '//www.tinymce.com/css/codepen.min.css'
                        ]
                    });
                    
                    $(document).on('focusin', function(e) {
                        if ($(e.target).closest(".mce-window").length) {
                            e.stopImmediatePropagation();
                        }
                    });
                    
                    $('#submitPost').on('submit' , function(){
                        // save TinyMCE instances before serialize
                        tinyMCE.triggerSave();
                        var dataString = $(this).serialize();
                        loader();
                        $.ajax({
                            type: "POST",
                            url: "../framework/blog/SubmitPost.php",
                            data: dataString,
                            cache: false,
                            success : function(data) {
                                $("#blog").html(data);
                            }
                        });
                        return false;
                    });
                    
                    
                </script>
                
                
                
                
                <form id="submitPost">
                    
                    <div class="form-group">
                        <label for="postTitle">Title: </label>
                        <input type="text" class="form-control" id="postTitle" name="postTitle">
                    </div>
                    
                    <textarea class="editable" type="text" id="postCont" name="postCont" >
                        <h1 style="font-size: 40px; text-align: center; width: 100%">Enter your Post Title Here</h1><br>
                        <p style="text-align: center; font-size: 15px;">
                            <img title="TinyMCE Logo" src="//www.tinymce.com/images/glyph-tinymce@2x.png" alt="TinyMCE Logo" width="110" height="97" />
                        </p>
                        
                        <h5 style="text-align: center;">Note, this is not an "enterprise/premium" demo.<br>Visit the <a href="https://www.tinymce.com/pricing/#demo-enterprise">pricing page</a> to demo our premium plugins.</h5>
                        <p>Please try out the features provided in this full featured example.</p>
                        <p>Note that any <b>MoxieManager</b> file and image management functionality in this example is part of our commercial offering – the demo is to show the integration.</h2>
                        
                        <h2>Got questions or need help?</h2>
                        <ul>
                            <li>Our <a href="//www.tinymce.com/docs/">documentation</a> is a great resource for learning how to configure TinyMCE.</li>
                            <li>Have a specific question? Visit the <a href="http://community.tinymce.com/forum/">Community Forum</a>.</li>
                            <li>We also offer enterprise grade support as part of <a href="http://tinymce.com/pricing">TinyMCE Enterprise</a>.</li>
                        </ul>
                    
                        <h2>A simple table to play with</h2>
                        <table style="text-align: center;">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Cost</th>
                                    <th>Really?</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>TinyMCE</td>
                                    <td>Free</td>
                                    <td>YES!</td>
                                </tr>
                                <tr>
                                    <td>Plupload</td>
                                    <td>Free</td>
                                    <td>YES!</td>
                                </tr>
                            </tbody>
                        </table>
                    
                        <h2>Found a bug?</h2>
                        <p>If you think you have found a bug please create an issue on the <a href="https://github.com/tinymce/tinymce/issues">GitHub repo</a> to report it to the developers.</p>
                        
                        <h2>Finally ...</h2>
                        <p>Don't forget to check out our other product <a href="http://www.plupload.com" target="_blank">Plupload</a>, your ultimate upload solution featuring HTML5 upload support.</p>
                        <p>Thanks for supporting TinyMCE! We hope it helps you and your users create great content.<br>All the best from the TinyMCE team.</p>
                    </textarea>
                    
                    <input type="hidden" id="postAuthor" name="postAuthor" value=$this->user>
                    
                    <button type='submit' name='request' value='SubmitPost'>Submit Post</button>
                </form>
                
         
newPost;
            }
        }


    }
}