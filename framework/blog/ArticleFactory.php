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
    private $db;

    public function __construct($whichBlog, $whichMethod) {
        $this->$whichMethod($whichBlog);
    }

    private function getBlog($thisBlog) {
        $this->db = new Database();
        $blog = $this->db->blog($thisBlog);
        while ($row = $blog->fetch()) {
            $article = new Article(
                $row['postID'],
                $row['postTitle'],
                $row['postDate'],
                $row['postDescription'],
                $row['postAuthor'],
                $row['postContent'],
                $row['postPublished']
            );
            $writer = new ArticleWriter();
            echo $article->write($writer);
        }
    }


}

