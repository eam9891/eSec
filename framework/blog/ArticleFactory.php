<?php

/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 2/12/2017
 * Time: 2:02 AM
 */

namespace framework\blog;

error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 1);

use framework\database\Database;
use framework\libs\Authenticate;

class ArticleFactory {


    /**
     * @param array $params
     *
     */
    public function getBlog(array $params) {
        $blog = $params['whichBlog'];
        $blog = Database::blog($blog);
        while ($row = $blog->fetch()) {
            $article = new Article(
                $row['postID'],
                $row['postTitle'],
                $row['postDate'],
                $row['postAuthor'],
                $row['postContent'],
                $row['postPublished']
            );
            $writer = new ArticleWriter();
            echo $article->write($writer);
        }
    }

    public function editBlog(array $params){
        $orderBy = $params['orderBy'];
        $whichOrder = $params['whichOrder'];
        $auth = new Authenticate("admin");
        if ($auth) {

            $query = "
                    SELECT postID, postTitle, postContent, postAuthor, postDate, postPublished
                    FROM blogMain UNION SELECT postID, postTitle, postContent, postAuthor, postDate, postPublished
                    FROM blogSubmissions ORDER BY $orderBy $whichOrder
                ";
            $blogPosts = Database::query($query);
            while($row = $blogPosts->fetch()){
                $article = new Article(
                    $row['postID'],
                    $row['postTitle'],
                    $row['postDate'],
                    $row['postAuthor'],
                    $row['postContent'],
                    $row['postPublished']
                );
                $writer = new AdminWriter($article);
            }
        }

    }

    public function getPost (array $params) {
        $postID = $params['postID'];
    }


}

