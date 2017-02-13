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


    <style>
        #wrapper {
            margin:auto;
            width:80%;
        }
        #adminNav {
            padding-left: 0;
        }

        #adminNav li {
            float: left;
            list-style: none;
            margin-right: 20px;
        }

        .header {
            background-color: #ffffff;
            text-align: center;
        }
        form input {
            border: 1px solid #999999;
            border-bottom-color: #cccccc;
            border-right-color: #cccccc;
            padding: 5px;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 1.0em;
            margin: 2px;
        }

        table {
            width:98%;
            text-align:left;
            border:1px solid #DDDDDD;
            font-size:12px;
            color:#000;
            background:#fff;
            margin-bottom:10px;
        }
        table th {
            background-color:#E5E5E5;
            border:1px solid #BBBBBB;
            padding:3px 6px;
            font-weight:normal;
            color:#000;
        }
        table tr td {
            border:1px solid #DDDDDD;
            padding:5px 6px;
        }
        table tr.alt td {
            background-color:#E2E2E2;
        }
        table tr:hover {
            background-color:#F0F0F0;
            color:#000;
        }

        iframe {
            height:calc(100vh - 4px);
            width:calc(80vw - 4px);
            border: 0;
        }


    </style>
    <script language="JavaScript" type="text/javascript">
        function delpost(id, title)
        {
            if (confirm("Are you sure you want to delete '" + title + "'"))
            {
                window.location.href = 'index.php?delpost=' + id;
            }
        }
    </script>
</head>
<body>
    <div class="header">
        <img src="../images/banner.jpg">
    </div>
    <div id="wrapper">
        <?php
            //show message from add / edit page
            if(isset($_GET['action'])){
                echo '<h3>Post '.$_GET['action'].'.</h3>';

            }
        ?>
        <form name="adminTools" action="AdminClient.php" method="POST" target="display">
            <ul id="adminNav">
                <li><button type="submit" name="request" value="ViewBlog"> View Blog </button></li>
                <li><button type="submit" name="request" value="ViewUsers"> Users </button></li>
                <li><button type="submit" name="request" value="NewPost"> New Post </button></li>
                <li><button type="submit" name="request" value="SystemStats"> System Stats </button></li>

            </ul>
        </form><br>
        <iframe name="display" align="center">Stuff</iframe>
    </div>
</body>
</html>