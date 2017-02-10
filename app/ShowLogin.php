<?php

/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 2/10/2017
 * Time: 2:05 AM
 */

class ShowLogin {

    private $showUI;

    public function getUI() {
        $this->showUI = <<<UI

            <form action="app/LoginClient.php" method="POST">
                <div class="imgcontainer">
                    <!--<img src="images/img_avatar2.png" alt="Avatar" class="avatar">-->
                    <h2>Login</h2>
                </div>
    
                <div class="container">
                    <label><b>Username</b></label>
                    <input type="text" placeholder="Enter Username" name="username" required>
    
                    <label><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="password" required>
    
                    <button type="submit">Login</button>
                    <input type="checkbox" checked="checked"> Remember me
                </div>
    
                <div class="container" style="background-color:#f1f1f1">
                    <button type="button" class="cancelbtn">Cancel</button>
                    <span class="psw">Forgot <a href="#">password?</a></span>
                    <button onclick="document.getElementById('registerID').style.display='block'"
                            class="registerButton"
                            style="width:auto;"
                    >
                        Register now for free!
                    </button>
                </div>
            </form>
        
        
UI;

        return $this->showUI;

    }
}

