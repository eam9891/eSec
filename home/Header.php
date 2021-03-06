<?php
/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 3/3/2017
 * Time: 2:34 PM
 */

namespace home {

    use framework\libs\Authenticate;
    use framework\User;

    class Header extends IUserInterface {

        public function __construct(User &$USER) {
            $username = $USER->getUsername();
            $userRole = $USER->getRole();
            $email = $USER->getEmail();
            self::$htmlString = <<<headerUI

<style>
    .navbar-nav {
        margin: 0;
    }
</style>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
    
        <!-- User Profile Dropdown -->
        <div class="navbar-right pull-right">
            <ul class="nav navbar-nav navbar-right pull-right" style="margin-right: 10px;">
   
                <li class="dropdown pull-right" style=" margin-top: 5px;">
                    <a class="dropdown-toggle profileButton " data-toggle="dropdown" style="padding: 0; ">
                        <span class="pull-right align-middle" style="margin-left: 10px;">
                            <img src="../images/img_avatar2.png" class="img-circle" 
                                height="30" width="30" alt="Avatar"><br>
                                <span class="glyphicon glyphicon-option-horizontal" style="margin-left: 8px; "></span>
                        </span>
                        <span class="pull-right">
                            <span class="pull-left">$username</span><br>
                            <span class=" pull-left">
                                <small>$userRole</small>
                            </span>
                        </spam>
                        
                        
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="navbar-login">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <p class="text-center">
                                            <span class="glyphicon glyphicon-user icon-size"></span>
                                        </p>
                                    </div>
                                    <div class="col-lg-8">
                                        <p class="text-left"><strong>$username</strong></p>
                                        <p class="text-left small">$email</p>
                                        <p class="text-left">
                                            <a href="#" class="btn btn-primary btn-block btn-sm">Profile</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="divider navbar-login-session-bg"></li>
                        <li>
                            <a href="#">
                                Account Settings 
                                <span class="glyphicon glyphicon-cog pull-right"></span>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                User stats 
                                <span class="glyphicon glyphicon-stats pull-right"></span>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                Messages 
                                <span class="badge pull-right"> 42 </span>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                Favourites Snippets 
                                <span class="glyphicon glyphicon-heart pull-right"></span>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <button> 
                                Sign Out 
                                <span class="glyphicon glyphicon-log-out pull-right"></span>
                            </button>
                        </li>
                    </ul>
                </li>
            </ul>
            
        </div>

        <!-- Site Title/Logo and mobile dropdown button -->
        <div class="navbar-header pull-left">
            <!--<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>-->
            <a class="navbar-brand" href="">Underground Art School</a>
        </div>

       
    </div>
</nav>

headerUI;
            parent::__construct("user", $USER, self::$htmlString);
        }
    }
}