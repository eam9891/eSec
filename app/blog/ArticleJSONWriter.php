<?php

/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 2/12/2017
 * Time: 1:50 AM
 */
include_once ('IBlogWriter.php');
class ArticleJSONWriter implements IBlogWriter {
    public function write(Article $obj) {
        $array = array('article' => $obj);
        return json_encode($array);
    }
}