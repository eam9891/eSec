<?php
    /**
     * Created by PhpStorm.
     * User: Ethan
     * Date: 2/11/2017
     * Time: 9:03 PM
     */
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
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin - Add Post</title>
    <link rel="stylesheet" href="../style/normal.css">
    <script src="http://cloud.tinymce.com/stable/tinymce.min.js?apiKey=q51gr2pl1firxabxen6o39fc0gu7vd7m6hwzim9v9pqh68a7"></script>
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
    <h2>Add Post</h2>

    <?php

    //if form has been submitted process it
    if(isset($_POST['submit'])){

        $_POST = array_map( 'stripslashes', $_POST );

        //collect form data
        extract($_POST);

        //very basic validation
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
                $query = 'INSERT INTO front_blog (postTitle,postDescription,postContent,postDate) VALUES (:postTitle, :postDesc, :postCont, :postDate)';
                $query_params = array(
                    ':postTitle' => $postTitle,
                    ':postDesc' => $postDesc,
                    ':postCont' => $postCont,
                    ':postDate' => date('Y-m-d H:i:s')
                );
                $db->insert($query, $query_params);

                //redirect to index page
                header('Location: index.php?action=added');
                exit;

            } catch(PDOException $e) {
                echo $e->getMessage();
            }

        }

    }

    //check for any errors
    if(isset($error)){
        foreach($error as $error){
            echo '<p class="error">'.$error.'</p>';
        }
    }
    ?>

    <form action='' method='post'>

        <p><label>Title</label><br />
            <input type='text' name='postTitle' value='<?php if(isset($error)){ echo $_POST['postTitle'];}?>'></p>

        <p><label>Description</label><br />
            <textarea name='postDesc' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['postDesc'];}?></textarea></p>

        <p><label>Content</label><br />
            <textarea name='postCont' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['postCont'];}?></textarea></p>

        <p><input type='submit' name='submit' value='Submit'></p>

    </form>

</div>
