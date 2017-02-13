<?php

/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 2/12/2017
 * Time: 2:33 AM
 */
class ArticleWriter implements IBlogWriter {
    public function write(Article $obj)
    {

        echo '<div id="post"><a href="viewPost.php?id='.$obj->id.'">';
            echo '<h1>'.$obj->title.'</h1>';
            echo '<p>'.$obj->description.'</p>';
            echo '<div id="postInfo">Posted on '.date('M jS Y h:i:s A', strtotime($obj->date)).' by '.$obj->author.'</div>';
            echo '<div id="postEndLine"></div>';
        echo '</a></div>';

    }
}