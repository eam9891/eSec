<?php

    /**
    * Created by PhpStorm.
    * User: Ethan
    * Date: 2/11/2017
    * Time: 6:07 PM
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

class ViewBlog {

    public function request() {
        $this->showBlog();

    }
    private function showBlog() {
        $db = new Database();
        $db = $db->connect();

        echo <<<'TAG'

        <style>
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
        </style>
        
        <link rel="stylesheet" type="text/css" href="style/normal.css">
        <table>
            <tr>
                <th>Title</th>
                <th>Date</th>
                <th>Action</th>
            </tr>

TAG;

            $query = 'SELECT postID, postTitle, postDate FROM blogMain ORDER BY postID DESC';
            $stmt = $db->query($query);

            while($row = $stmt->fetch()){
                echo'<tr>';
                    echo'<td>'.$row['postTitle'].'</td>';
                    echo'<td>'.date('jS M Y', strtotime($row['postDate'])).'</td>';
                    echo'<td>';
                        echo'<a href="editPost.php?id='.$row['postID'].'">Edit</a>&nbsp';
                        echo'<a href="javascript:delpost('.$row['postID'].','.$row['postTitle'].')">Delete</a>';
                    echo '</td>';
                echo '</tr>';
            }
        echo'</table>';

    }
}