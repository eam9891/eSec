<?php

/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 2/11/2017
 * Time: 6:07 PM
 */

error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 1);

include_once ("../app/Database.php");

class ViewBlog {

    public function returnRequest() {
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
        
        
TAG;
        echo'<table>';
            echo'<tr>';
                echo'<th>Title</th>';
                echo'<th>Date</th>';
                echo'<th>Action</th>';
            echo'</tr>';


            $query = 'SELECT postID, postTitle, postDate FROM front_blog ORDER BY postID DESC';
            $stmt = $db->query($query);

            while($row = $stmt->fetch()){
                echo'<tr>';
                    echo'<td>'.$row['postTitle'].'</td>';
                    echo'<td>'.date('jS M Y', strtotime($row['postDate'])).'</td>';
                    echo'<td>';
                        echo'<a href="edit-post.php?id='.$row['postID'].'">Edit</a>';
                        echo'<a href="javascript:delpost('.$row['postID'].','.$row['postTitle'].')">Delete</a>';
                    echo '</td>';
                echo '</tr>';
            }



        echo'</table>';
    }
}