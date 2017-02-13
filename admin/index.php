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

    <link rel="stylesheet" type="text/css" href="../style/framework.css">
    <link rel="stylesheet" type="text/css" href="../style/loginForm.css">
    <link rel="stylesheet" type="text/css" href="../style/normal.css">
    <link rel="stylesheet" type="text/css" href="../style/modals.css">
    <style>

        #adminNav {
            padding-left: 0;
        }

        #adminNav li {
            margin-left: 10px;
            margin-right: 10px;
            list-style: none;

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
            /*height:calc(100vh - 4px);
            width:calc(100vw - 4px);*/
            width: 100%;
            height: 100%;
            border: 0;
            overflow: hidden;
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
<header><img src="../images/banner.jpg"></header>
<div class="row">
    <div class="col-3 col-m-3 menu">

        <div class="imgcontainer">
            <img src="../images/img_avatar2.png" alt="Avatar" class="avatar">
            <h3><?= $USER->getUsername(); ?></h3>
            <code><?= $USER->getRole(); ?></code>
        </div>
        <div class="container">

        </div>
        <div class="container" style="background-color:#f1f1f1">

        </div>

    </div>

    <div class="col-6 col-m-9 blog">
        <iframe name="display" align="center">Stuff</iframe>
    </div>

    <div class="col-3 col-m-12">
        <form name="adminTools" action="AdminClient.php" method="POST" target="display">
            <ul id="adminNav">
                <li><button type="submit" name="request" value="ViewBlog"> Edit Blog </button></li>
                <li><button type="submit" name="request" value="ArticleFactory"> View Blog </button></li>
                <li><button type="submit" name="request" value="ViewUsers"> Users </button></li>
                <li><button type="submit" name="request" value="NewPost"> New Post </button></li>
                <li><button type="submit" name="request" value="SystemStats"> System Stats </button></li>

            </ul>
        </form>
    </div>

</div>

</body>
</html>