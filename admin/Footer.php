<?php
/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 3/3/2017
 * Time: 6:27 PM
 */

namespace admin {

    use framework\libs\Authenticate;
    use home\IUserInterface;
    use framework\User;

    class Footer extends IUserInterface {
        public function __construct(Authenticate &$auth, User &$USER) {
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
            
                $(document).ready(function() {
                
                    // Default POST request to show the Edit Blog panel
                    loader();
                    var dataString = 'request=EditBlog';
                    $.ajax({
                        type: "POST",
                        url: "AdminClient.php",
                        data: dataString,
                        cache: false,
                        success : function(data) {
                            $("#blog").html(data);
                        }
                    });
                    
                    $('#blogToolsButton').on('click' , function(){
                        $('#blogToolsArrow').toggleClass('glyphicon-menu-down').toggleClass('glyphicon-menu-up');
                    });
                    
                    $('#userToolsButton').on('click' , function(){
                        $('#userToolsArrow').toggleClass('glyphicon-menu-down').toggleClass('glyphicon-menu-up');
                    });
                    
                    $('#showBlog').on('click' , function(){
                        loader();
                        var dataString = 'request='+ $(this).val();
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
            
                    $('#editBlog').on('click' , function(){
                        loader();
                        var dataString = 'request='+ $(this).val();
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
                    
                    $('#newPost').on('click' , function(){
                        loader();
                        var dataString = 'request='+ $(this).val();
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
                    
                    
                  
                })
                
        
        
        </script>
        </body>
        </html>
        
footerUI;

            parent::__construct($auth, $USER, self::$htmlString);
        }
    }
}