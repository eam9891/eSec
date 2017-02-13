<?php

/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 2/12/2017
 * Time: 2:02 AM
 */
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 1);

// Autoload given function name.
function includeAll($className)
{
    include_once('app/blog/' . $className . '.php');
    include_once($className . '.php');
}
//Register
spl_autoload_register('includeAll');


class ArticleFactory {
    public function __construct() {


    }
    public function showBlog() {
        $query = '
            SELECT postID, postTitle, postDate, postDescription, postAuthor 
            FROM blogMain 
            ORDER BY postID DESC
        ';
        $openConn = new Database();
        $conn = $openConn->connect();
        $stmt = $conn->query($query);
        while ($row = $stmt->fetch()) {
            $article = new Article(
                $row['postID'],
                $row['postTitle'],
                $row['postDate'],
                $row['postDescription'],
                $row['postAuthor']
            );

            /*try {
                $writer = GetWriters::getWriter();
            }
            catch (Exception $e) {
                $writer = new ArticleWriter();
            }*/
            $writer = new ArticleWriter();
            echo $article->write($writer);
        }
    }
}