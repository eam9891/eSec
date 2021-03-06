<?php include_once('framework/blog/ArticleFactory.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Underground Art School </title>
    <link rel="stylesheet" type="text/css" href="public/style/framework.css">
    <link rel="stylesheet" type="text/css" href="public/style/loginForm.css">
    <link rel="stylesheet" type="text/css" href="public/style/normal.css">
    <link rel="stylesheet" type="text/css" href="public/style/modals.css">
    <link rel="stylesheet" href="public/style/tablet.css" media="only screen and (min-width: 600px) and (max-width: 1024px)">
    <link rel="stylesheet" href="public/style/mobile.css" media="only screen and (max-width: 600px)">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

</head>
<body>
<header><img src="images/banner.jpg" align="center"></header>
<div class="row">

    <div class="col-3 col-m-3 ">
        <form class="loginForm pull-right" action="framework/login/LoginClient.php" method="POST">
            <div class="imgcontainer">
                <img src="images/img_avatar2.png" alt="Avatar" class="avatar">
                <h3>Login</h3>
            </div>

            <div class="container">
                <input type="text" placeholder="Enter Username" name="username" required>
                <input type="password" placeholder="Enter Password" name="password" required>
                <button class="loginButton" type="submit">Login</button><br>
                <input type="checkbox" checked="checked"> Remember me
            </div>

            <div class="container" style="background-color:#f1f1f1">
                <span class="psw">Forgot <a href="#">password?</a></span>
                <button onclick="document.getElementById('registerID').style.display='block'"
                        class="loginButton"
                        style="width:auto;"
                >
                    Register now for free!
                </button>
            </div>
        </form>
    </div>

    <div class="col-6 col-m-9 blog">
        <div id="blog">
            <?php
                $blog = new ArticleFactory();
                $blog->request("mainBlog");
            ?>
        </div>
    </div>

    <div class="col-3 col-m-12">
        <div class="nav">
            <a href="about.html"><img src="images/about.jpg"></a>
            <a href="read.html"><img src="images/read.jpg"></a>
            <a href="watch.html"><img src="images/watch.jpg"></a>
            <a href="theTeam.html"><img src="images/theTeam.jpg"></a>
            <a href="contact.html"><img src="images/contact.jpg"></a>
            <a href="homework.html"><img src="images/homework.jpg"></a>
            <a href="patrons.html"><img src="images/patrons.jpg"></a>
        </div>
    </div>

</div>

<div class="footer">
    ©Underground Art School™ Posted images are property +
    copyright of their respective creators and/or owners. <br>
    Respect for art=Friendship yo!
</div>

<!-- Register Form Modal -->
<div id="registerID" class="modal">
    <form class="modal-content animate" action="framework/login/RegisterClient.php" method="POST">
        <div class="imgcontainer">
            <span onclick="document.getElementById('registerID').style.display='none'"
                  class="close"
                  title="Close Modal">&times;
            </span>
            <h1>Registration</h1>
            <img src="images/img_avatar2.png" alt="Avatar" class="avatar">
        </div>

        <div class="container">
            <label><b>Enter A Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" required>

            <label><b>Enter A Valid Email Address</b></label>
            <input type="text" placeholder="Enter Email" name="email" required>

            <label><b>Enter A Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>

            <button type="submit">Login</button>
        </div>
        <div class="container" style="background-color:#f1f1f1">
            <button type="button"
                    onclick="document.getElementById('registerID').style.display='none'"
                    class="cancelbtn">
                Cancel
            </button>
        </div>
    </form>
</div>

<!-- Register Modal Script -->
<script>
    // Get the modal
    var modal = document.getElementById('registerID');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
</body>
</html>
