<?php

/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 2/12/2017
 * Time: 2:33 AM
 */
include_once ('IBlogWriter.php');
class ArticleWriter implements IBlogWriter {
    public function write(Article $obj)
    {

        //echo '<div id="post"><a href="viewPost.php?id='.$obj->id.'">';
           // echo '<h1>'.$obj->title.'</h1>';
           // echo '<p>'.$obj->description.'</p>';
           // echo '<div id="postInfo">Posted on '.date('M jS Y h:i:s A', strtotime($obj->date)).' by '.$obj->author.'</div>';
           // echo '<div id="postEndLine"></div>';
       // echo '</a></div>';
        $date = date('M jS Y h:i:s A', strtotime($obj->date));

        echo <<<TAG

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>$obj->title</h2>
                    <code>Posted on $date by $obj->author</code>
                </div>
                <div class="panel-body">$obj->description</div>
                <div class="panel-footer">
                    <button type="button" class="btn btn-default"> 
                        <a href="viewPost.php?id=$obj->id"> READ MORE » </a>
                    </button>
                    
                </div>
            </div>


            
        
TAG;



    }
}