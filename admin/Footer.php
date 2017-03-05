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
        public function __construct(Authenticate $auth, User &$USER) {
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
                    
                    $('#submitPost').on('click' , function(){
                        loader();
                        var dataString = 'submit='+ $(this).val();
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
                })
                
                
            
              
            
            
                // Network Utility
                function networkUtility(str) {
                    var xmlhttp;
            
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
            
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("txtHint").innerHTML = this.responseText;
                        }
                    };
            
                    xmlhttp.open("GET", "SystemInfo.php?q=" + str, true);
                    xmlhttp.send();
            
                }
                // Load the default network selection (Total download and upload bytes)
                window.onload = networkUtility(3);
        
        </script>
        </body>
        </html>
        
footerUI;

            parent::__construct($auth, $USER, self::$htmlString);
        }
    }
}