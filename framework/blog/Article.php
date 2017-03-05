<?php

/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 2/12/2017
 * Time: 1:51 AM
 */

namespace framework\blog;

class Article {
    public $id, $title, $date, $description, $author, $content, $published;
    public function __construct($id, $title, $date, $description, $author, $content, $published) {
        $this->id = $id;
        $this->title = $title;
        $this->date = $date;
        $this->description = $description;
        $this->author = $author;
        $this->content = $content;
        $this->published = $published;
    }

    public function write(IBlogWriter $writer) {
        return $writer->write($this);
    }




}