<?php

/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 2/12/2017
 * Time: 2:02 AM
 */
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 1);



include_once ('Article.php');
include_once ('ArticleWriter.php');

class ArticleFactory {

    public function __construct() {

    }
    public function adminRequest() {
        $this->showBlog();
    }
    public function showBlog() {

        $db = new Database();
        $blog = $db->blog("blogMain");
        while ($row = $blog->fetch()) {

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
    public function showSubmissions() {
        $db = new Database();
        $blog = $db->blog("blogSubmissions");
        while ($row = $blog->fetch()) {

            $article = new Article(
                $row['postID'],
                $row['postTitle'],
                $row['postDate'],
                $row['postDescription'],
                $row['postAuthor']
            );

            $writer = new ArticleWriter();
            echo $article->write($writer);
        }
    }
}