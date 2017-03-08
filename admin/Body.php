<?php
/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 3/3/2017
 * Time: 6:22 PM
 */

namespace admin;


use framework\libs\Authenticate;
use framework\User;
use home\IUserInterface;

class Body extends IUserInterface {
    public function __construct(User &$USER) {
        $username = $USER->getUsername();
        $userRole = $USER->getRole();
        $email = $USER->getEmail();
        self::$htmlString = <<<headerUI
     
            <div class="container-fluid text-center">
                <div class="row">
            
                    <div class="col-md-3 col-sm-3 ">
                        <div class="well">
                            <img src="../images/img_avatar2.png" class="" height="65" width="65" alt="Avatar">
                            <p>
                                <a href="#">$username</a><br>
                                <small>$userRole</small>
                            </p>
                        </div>
                         
                        <div class="panel-group">
                            <div class="panel panel-default">
                                
                                    
                                <button id="blogToolsButton" class="btn btn-default btn-block" data-toggle="collapse" href="#blogTools" style="width: 100%;"> 
                                    Blog 
                                    <span id="blogToolsArrow" href="" class="glyphicon glyphicon-menu-down pull-right"></span>
                                </button>
                                    
                                
                                <div id="blogTools" class="panel-collapse collapse">
                                    <div class="btn-group-vertical" style="width: 100%;">
                                        <button id="editBlog" value="EditBlog" class="btn btn-default btn-block"> 
                                                Edit Blog 
                                                <span class="badge pull-right"> 12 </span>
                                        </button>
                                        <button id="showBlog" value="ArticleFactory" class="btn btn-default btn-block"> 
                                                Show Blog 
                                        </button>
                                        <button id="newPost" value="NewPost" class="btn btn-default btn-block"> 
                                                New Post 
                                        </button>
                                    </div>
                                    
                                </div>
                                
                                <button id="userToolsButton" class="btn btn-default btn-block" data-toggle="collapse" href="#userTools" style="width: 100%;"> 
                                    Users 
                                    <span id="userToolsArrow" href="" class="glyphicon glyphicon-menu-down pull-right"></span>
                                </button>
                                
                                <div id="userTools" class="panel-collapse collapse">
                                    <div class="btn-group=vertical" style="width: 100%;">
                                        <button id="viewUsers" value="ViewUsers" class="btn btn-default btn-block"> 
                                                View Users 
                                                <span class="badge pull-right"> 12 </span>
                                        </button>
                                        <button id="contributions" value="Contributions" class="btn btn-default btn-block"> 
                                                Artist Contributions
                                        </button>
                                        
                                    </div>
                                </div>
                                
                                <button id="systemInfo" value="SystemInfo" class="btn btn-default btn-block"> 
                                    System Info
                                </button>
                                
                            </div>
                        </div>
                      
                
                    </div>
            
                    <!-- This is where all requests get displayed -->
                    <div class="col-md-9 col-sm-9">
                        <div id="display"></div>
                        <div id="wait" style="display:none;width:69px;height:89px;border:1px solid black;position:absolute;top:50%;left:50%;padding:2px;">
                            <img src='../images/loader.gif' width="64" height="64" /><br>Loading..
                        </div>
                    </div>
                    
                </div>
            </div>
headerUI;
        parent::__construct("admin", $USER, self::$htmlString);
    }
}

?>

