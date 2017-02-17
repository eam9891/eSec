<?php include_once ('app/blog/ArticleFactory.php'); ?>
<!DOCTYPE html>
<html>
<title>Underground Art School</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<style>
    body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-grey">

<!-- w3-content defines a container for fixed size centered content,
and is wrapped around the whole page content, except for the footer in this example -->
<div class="w3-content" style="max-width:1400px">

    <!-- Header -->
    <header class="w3-container w3-center w3-padding-16">
        <h1 style="width: auto;"><b>Underground Art School</b></h1>
        <button onclick="document.getElementById('id01').style.display='block'"
                class="w3-right w3-btn w3-border w3-round-large w3-ripple w3-light-grey">
            Sign Up
        </button>
        <button onclick="document.getElementById('id02').style.display='block'"
                class="w3-right w3-btn w3-border w3-round-large w3-ripple w3-light-grey">
            Login
        </button>
    </header>

    <!-- Grid -->
    <div class="w3-row">
        <!-- Introduction menu -->
        <div class="w3-col l2">
            <!-- About Card -->
            <div class="w3-card-2 w3-margin w3-margin-top">
                <img src="/w3images/avatar_g.jpg" style="width:100%">
                <div class="w3-container w3-white">
                    <h4><b>A community for All Artists</b></h4>
                    <p>

                    </p>
                </div>
            </div><hr>

            <!-- Posts -->
            <div class="w3-card-2 w3-margin">
                <div class="w3-container w3-padding">
                    <h4>Popular Posts</h4>
                </div>
                <ul class="w3-ul w3-hoverable w3-white">
                    <li class="w3-padding-16">
                        <img src="/images/banner.jpg" alt="Image" class="w3-left w3-margin-right" style="width:50px">
                        <span class="w3-large">Lorem</span><br>
                        <span>Sed mattis nunc</span>
                    </li>
                    <li class="w3-padding-16">
                        <img src="/w3images/gondol.jpg" alt="Image" class="w3-left w3-margin-right" style="width:50px">
                        <span class="w3-large">Ipsum</span><br>
                        <span>Praes tinci sed</span>
                    </li>
                    <li class="w3-padding-16">
                        <img src="/w3images/skies.jpg" alt="Image" class="w3-left w3-margin-right" style="width:50px">
                        <span class="w3-large">Dorum</span><br>
                        <span>Ultricies congue</span>
                    </li>
                    <li class="w3-padding-16 w3-hide-medium w3-hide-small">
                        <img src="/w3images/rock.jpg" alt="Image" class="w3-left w3-margin-right" style="width:50px">
                        <span class="w3-large">Mingsum</span><br>
                        <span>Lorem ipsum dipsum</span>
                    </li>
                </ul>
            </div>
            <hr>

            <!-- Labels / tags -->
            <div class="w3-card-2 w3-margin">
                <div class="w3-container w3-padding">
                    <h4>Tags</h4>
                </div>
                <div class="w3-container w3-white">
                    <p><span class="w3-tag w3-black w3-margin-bottom">Travel</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">New York</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">London</span>
                        <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">IKEA</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">NORWAY</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">DIY</span>
                        <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Ideas</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Baby</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Family</span>
                        <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">News</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Clothing</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Shopping</span>
                        <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Sports</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Games</span>
                    </p>
                </div>
            </div>

            <!-- END Introduction Menu -->
        </div>
        <!-- Blog entries -->
        <div class="w3-col l8 s12">

            <?php
                $blog = new ArticleFactory();
                $blog->request("mainBlog");
            ?>

            <!-- END BLOG ENTRIES -->
        </div>

        <!-- Introduction menu -->
        <div class="w3-col l2">
            <!-- About Card -->
            <div class="w3-card-2 w3-margin w3-margin-top">
                <img src="/w3images/avatar_g.jpg" style="width:100%">
                <div class="w3-container w3-white">
                    <h4><b>A community for All Artists</b></h4>
                    <p>

                    </p>
                </div>
            </div><hr>

            <!-- Posts -->
            <div class="w3-card-2 w3-margin">
                <div class="w3-container w3-padding">
                    <h4>Popular Posts</h4>
                </div>
                <ul class="w3-ul w3-hoverable w3-white">
                    <li class="w3-padding-16">
                        <img src="/images/banner.jpg" alt="Image" class="w3-left w3-margin-right" style="width:50px">
                        <span class="w3-large">Lorem</span><br>
                        <span>Sed mattis nunc</span>
                    </li>
                    <li class="w3-padding-16">
                        <img src="/w3images/gondol.jpg" alt="Image" class="w3-left w3-margin-right" style="width:50px">
                        <span class="w3-large">Ipsum</span><br>
                        <span>Praes tinci sed</span>
                    </li>
                    <li class="w3-padding-16">
                        <img src="/w3images/skies.jpg" alt="Image" class="w3-left w3-margin-right" style="width:50px">
                        <span class="w3-large">Dorum</span><br>
                        <span>Ultricies congue</span>
                    </li>
                    <li class="w3-padding-16 w3-hide-medium w3-hide-small">
                        <img src="/w3images/rock.jpg" alt="Image" class="w3-left w3-margin-right" style="width:50px">
                        <span class="w3-large">Mingsum</span><br>
                        <span>Lorem ipsum dipsum</span>
                    </li>
                </ul>
            </div>
            <hr>

            <!-- Labels / tags -->
            <div class="w3-card-2 w3-margin">
                <div class="w3-container w3-padding">
                    <h4>Tags</h4>
                </div>
                <div class="w3-container w3-white">
                    <p><span class="w3-tag w3-black w3-margin-bottom">Travel</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">New York</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">London</span>
                        <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">IKEA</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">NORWAY</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">DIY</span>
                        <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Ideas</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Baby</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Family</span>
                        <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">News</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Clothing</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Shopping</span>
                        <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Sports</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Games</span>
                    </p>
                </div>
            </div>

            <!-- END Introduction Menu -->
        </div>

        <!-- END GRID -->
    </div><br>

    <!-- Login Modal -->
    <div id="id02" class="w3-modal">
        <div class="w3-modal-content w3-card-8 w3-animate-top" style="max-width:600px">

            <div class="w3-center"><br>
                <span onclick="document.getElementById('id02').style.display='none'" class="w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright" title="Close Modal">&times;</span>
                <img src="images/img_avatar2.png" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top">
            </div>

            <form class="w3-container" action="app/LoginClient.php" method="POST">
                <div class="w3-section">
                    <label><b>Username</b></label>
                    <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Username" name="username" required>
                    <label><b>Password</b></label>
                    <input class="w3-input w3-border" type="password" placeholder="Enter Password" name="password" required>
                    <button class="w3-btn-block w3-green w3-section w3-padding" type="submit">Login</button>
                    <input class="w3-check w3-margin-top" type="checkbox" checked="checked"> Remember me
                </div>
            </form>

            <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-btn w3-red">Cancel</button>
                <span class="w3-right w3-padding w3-hide-small">Forgot <a href="#">password?</a></span>
            </div>

        </div>
    </div>
    <!-- END w3-content -->
</div>

<!-- Footer -->
<footer class="w3-container w3-dark-grey w3-padding-32 w3-margin-top">
    <button class="w3-btn w3-disabled w3-padding-large w3-margin-bottom">Previous</button>
    <button class="w3-btn w3-padding-large w3-margin-bottom">Next »</button>
    <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer>

</body>
</html>