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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Underground Art School </title>

    <script language="JavaScript" type="text/javascript">
        function delpost(id, title)
        {
            if (confirm("Are you sure you want to delete '" + title + "'"))
            {
                window.location.href = 'index.php?delpost=' + id;
            }
        }
    </script>
    <style>



        #wrapper {
            margin:auto;
            width:900px;
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
            width: 100%;
            height: 500px;
        }


    </style>

</head>
<body>
<div class="header">
    <img src="../images/banner.jpg">
</div>
<div id="wrapper">
    <h1>UAS Admin Portal</h1>
    <form name="adminTools" action="AdminClient.php" method="POST" target="display">
        <button type="submit" name="request" value="ViewBlog"> View Blog </button><br>
        <button type="submit" name="request" value="ViewUsers"> Users </button><br>
        <button type="submit" name="request" value="NewPost"> New Post </button><br>
        <button type="submit" name="request" value="SystemStats"> System Stats </button><br>
    </form>
    <br>

    <iframe name="display" align="center">Stuff</iframe>



</div>

</body>
</html>