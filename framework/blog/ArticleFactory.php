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

class ArticleFactory {


    public function getBlog($thisBlog) {
        $blog = $thisBlog['whichBlog'];
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


}

