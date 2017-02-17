<?php
session_start();

error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 1);

include_once ('../app/Database.php');
include_once ('../app/User.php');

$db = new Database();
$usr = new User();

$USER = $usr->getUser($_SESSION['id']);
if ($USER->getRole() !== "admin") {
    header("Location: ../index.php");
    die("Redirecting to: ../index.php");
}

//show message from add / edit page
if(isset($_GET['delpost'])){
    //DELETE FROM front_blog WHERE postID = :postID
    //$stmt->execute(array(':postID' => $_GET['delpost']));
    $db->deleteWhere("front_blog", "postID = ?", $_GET['delpost']);
    header('Location: index.php?action=deleted');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Underground Art School </title>


    <link rel="stylesheet" type="text/css" href="adminTools.css">
    <link rel="stylesheet" type="text/css" href="../style/userPanel.css">

    <script src="../jquery-3.1.1.min.js"></script>
</head>
<body>
    <header><img src="../images/uas.png" class="header"></header>
    <div class="userPanel">
        <div class="imgcontainer">
            <img src="../images/img_avatar2.png" alt="Avatar" class="avatar">
            <h3><?= $USER->getUsername(); ?></h3>
            <code><?= $USER->getRole(); ?></code>
        </div>


        <form id="adminTools" name="adminTools">
            <div class="menuTitle">Blog</div>
            <ul id="adminNav">
                <li><button id="editBlog" value="ViewBlog" class="adminButton"> Edit Blog </button></li>
                <li><button id="showBlog" value="ArticleFactory" class="adminButton"> Show Blog </button></li>
                <li><button id="newPost" value="NewPost" class="adminButton"> New Post </button></li>

            </ul>

            <div class="menuTitle">Users</div>
            <ul id="adminNav">
                <li><button id="adminButton" value="ViewUsers" class="adminButton"> Users </button></li>
                <li><button id="adminButton" value="SystemStats" class="adminButton"> Artist Contributions </button></li>
            </ul>

            <div class="menuTitle">System</div>
            <ul id="adminNav">
                <li><button id="adminButton" value="SystemStats" class="adminButton"> System Stats </button></li>
            </ul>
        </form>

    </div>
    <!-- top tiles -->

    <!-- Server Uptime
    <div class="stats">
            <span class="uptime_percent green pull-right">
                <i class="fa fa-sort-asc"></i> 99.99%
            </span>
        <span class="count_top">
                <i class="fa fa-clock-o"></i> Server Uptime
            </span>
        <div class="count" >
            <div id="refresh" class="green">
                <?php

                //$ut = $ServerInfo->Uptime();
                //echo "$ut[days]:$ut[hours]:$ut[mins]:$ut[secs] ";
                ?>
            </div>
        </div>
        <span class="count_bottom">
                Days : Hours : Minutes : Seconds
            </span>
    </div>-->

    <!-- Total Users
    <div class="stats">
        <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
        <div class="count green">
            <?php
            //include("numUsers.php");
            //echo $numberOfUsers;
            ?>
        </div>
        <span class="count_bottom"><i class="green">4% </i> From last Week</span>
    </div>-->

    <!-- System Load
    <div class="stats">
        <span class="count_top"><i class="fa fa-user"></i> System Load</span>
        <div class="count green">
            <div id="refreshLoad">

            </div>
        </div>
        <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
    </div>-->

    <!-- Network Activity
    <div class="stats">
        <form class="pull-right">
            <label class="select">
                <select name="Network" onchange="networkUtility(this.value)">
                    <option value="1" class="styledOption">Upload</option>
                    <option value="2">Download</option>
                    <option value="3" selected>Total</option>
                </select>
            </label>
        </form>
        <span class="count_top">
                <i class="fa fa-user"></i>
                Network
            </span>
        <div class="count green">
            <div id="txtHint"><b></b></div>
        </div>
        <span class="count_bottom">
                <i class="green"><i class="fa fa-sort-asc"></i> 34% </i>
                From last Week
            </span>
    </div>-->


    <!-- /top tiles -->
    <div id="blog"></div>
    <div id="wait" style="display:none;width:69px;height:89px;border:1px solid black;position:absolute;top:50%;left:50%;padding:2px;">
        <img src='../images/loader.gif' width="64" height="64" /><br>Loading..
    </div>





<script>
    function loader() {
        $(document).ajaxStart(function(){
            $("#wait").css("display", "block");
        });
        $(document).ajaxComplete(function(){
            $("#wait").css("display", "none");
        });
    }

    $(function(){
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
    });


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