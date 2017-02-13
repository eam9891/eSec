<?php

/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 2/12/2017
 * Time: 1:51 AM
 */
class Article {
    public $id, $title, $date, $description, $author;
    public function __construct($id, $title, $date, $description, $author) {
        $this->id = $id;
        $this->title = $title;
        $this->date = $date;
        $this->description = $description;
        $this->author = $author;
    }

    public function write(IBlogWriter $writer) {
        return $writer->write($this);
    }




}