<?php
/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 2/12/2017
 * Time: 1:04 AM
 */

namespace admin;

error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 1);

spl_autoload_register(function($class) {
    include '/var/www/html/undergroundartschool/' . str_replace('\\', '/', $class) . '.php';
});

use framework\database\Database;

$worker = new Database();
$db = $worker->connect();

//if not logged in redirect to login page
//if(!$user->is_logged_in()){ header('Location: login.php'); }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin - Edit Post</title>
    <link rel="stylesheet" href="../public/style/normal.css">
    <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: "textarea",
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        });
    </script>
</head>
<body>

<div id="wrapper">


    <p><a href="./">Blog Admin Index</a></p>

    <h2>Edit Post</h2>


    <?php

    //if form has been submitted process it
    if(isset($_POST['submit'])){

        $_POST = array_map( 'stripslashes', $_POST );

        //collect form data
        extract($_POST);

        //very basic validation
        if($postID ==''){
            $error[] = 'This post is missing a valid id!.';
        }

        if($postTitle ==''){
            $error[] = 'Please enter the title.';
        }

        if($postDesc ==''){
            $error[] = 'Please enter the description.';
        }

        if($postCont ==''){
            $error[] = 'Please enter the content.';
        }

        if(!isset($error)){

            try {

                //insert into database
                $stmt = $db->prepare('
                    UPDATE blogMain 
                    SET postTitle = :postTitle, 
                    postDescription = :postDesc, 
                    postContent = :postCont 
                    WHERE postID = :postID
                ') ;
                $stmt->execute(array(
                    ':postTitle' => $postTitle,
                    ':postDesc' => $postDesc,
                    ':postCont' => $postCont,
                    ':postID' => $postID
                ));

                //redirect to index page
                header('Location: index.php?action=updated');
                exit;

            } catch(PDOException $e) {
                echo $e->getMessage();
            }

        }

    }

    ?>


    <?php
    //check for any errors
    if(isset($error)){
        foreach($error as $error){
            echo $error.'<br />';
        }
    }

    try {

        $stmt = $db->prepare('
            SELECT postID, postTitle, postDescription, postContent 
            FROM blogMain 
            WHERE postID = :postID
        ') ;
        $stmt->execute(array(':postID' => $_GET['id']));
        $row = $stmt->fetch();

    } catch(PDOException $e) {
        echo $e->getMessage();
    }

    ?>

    <form action='' method='post'>
        <input type='hidden' name='postID' value='<?php echo $row['postID'];?>'>

        <p><label>Title</label><br />
            <input type='text' name='postTitle' value='<?php echo $row['postTitle'];?>'></p>

        <p><label>Description</label><br />
            <textarea name='postDesc' cols='60' rows='10'><?php echo $row['postDesc'];?></textarea></p>

        <p><label>Content</label><br />
            <textarea name='postCont' cols='60' rows='10'><?php echo $row['postCont'];?></textarea></p>

        <p><input type='submit' name='submit' value='Update'></p>

    </form>

</div>

</body>
</html>

