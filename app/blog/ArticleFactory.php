<?php

/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 2/12/2017
 * Time: 2:02 AM
 */
class DisplayArticles {
    public function __construct() {
        $article = new Article('Polymorphism', 'Steve', time(), 0);

        try {
            $writer = ArticleFactory::getWriter();
        }
        catch (Exception $e) {
            $writer = new ArticleXMLWriter();
        }

        echo $article->write($writer);
    }
}