<?php

    error_reporting(E_ALL | E_STRICT);
    ini_set("display_errors", 1);


    $worker = new LoginManager();
    $_USER = $worker->secureSession();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

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
        #adminmenu {
            padding-left: 0;
        }

        #adminmenu li {
            float: left;
            list-style: none;
            margin-right: 20px;
        }
        #wrapper {
            margin:auto;
            width:900px;
        }
        p,li {
            color: #555555;
            font-size: 16px;
            line-height: 1.5em;
        }

        a {
            color: #EF1F2F;
            text-decoration: none;
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

        table {width:98%; text-align:left; border:1px solid #DDDDDD; font-size:12px; color:#000;background:#fff; margin-bottom:10px;}
        table th {background-color:#E5E5E5; border:1px solid #BBBBBB; padding:3px 6px; font-weight:normal; color:#000;}
        table tr td {border:1px solid #DDDDDD; padding:5px 6px;}
        table tr.alt td {background-color:#E2E2E2;}
        table tr:hover {background-color:#F0F0F0; color:#000;}

    </style>

</head>
<body>
<div id="wrapper">
    <h1>Secure Admin Page!</h1>

    <ul id='adminmenu'>
        <li><a href='index.php'>Blog</a></li>
        <li><a href='users.php'>Users</a></li>
        <li><a href="../" target="_blank">View Website</a></li>
        <li><a href='logout.php'>Logout</a></li>
    </ul>
    <div class='clear'></div>
    <hr />

    <?php
    //show message from add / edit page
    if(isset($_GET['action'])){
        echo '<h3>Post '.$_GET['action'].'.</h3>';
    }
    ?>

    <table>
        <tr>
            <th>Title</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        <?php

        try {

            $query = 'SELECT postID, postTitle, postDate FROM front_blog ORDER BY postID DESC';
            $openConn = new Database();
            $conn = $openConn->connect();

            $stmt = $conn->query($query);


            while($row = $stmt->fetch()){

                echo '<tr>';
                echo '<td>'.$row['postTitle'].'</td>';
                echo '<td>'.date('jS M Y', strtotime($row['postDate'])).'</td>';
                ?>

                <td>
                    <a href="edit-post.php?id=<?php echo $row['postID'];?>">Edit</a> |
                    <a href="javascript:delpost('<?php echo $row['postID'];?>','<?php echo $row['postTitle'];?>')">Delete</a>
                </td>

                <?php
                echo '</tr>';

            }

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        ?>
    </table>

    <p><a href='add-post.php'>Add Post</a></p>
</div>

</body>
</html>