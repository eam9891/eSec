<?php

/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 2/12/2017
 * Time: 2:33 AM
 */

namespace framework\blog {

    class ArticleWriter implements IBlogWriter {
        public function write(Article $obj)
        {

            $date = date('M jS Y', strtotime($obj->date));
            $time = date('h:i A', strtotime($obj->date));
            echo <<<blogMainUI
        
            <style>
                .panel-footer {
                    height: 50px;
                }
                .blog-panel {
                    margin-bottom: 10px;
                    
                }
            </style>
            
            <div class="panel panel-default blog-panel">
                <div class="panel-heading">
                    <h2>$obj->title</h2>
                    <p>$date</p>
                </div>
                <div class="panel-body" style="height: 400px; overflow: hidden;">$obj->content</div>
                <div class="panel-footer">
                    <p class="pull-left" style="width:50%;">Posted by <a href="">$obj->author</a> at $time</p>
                    <button type="button" class="btn btn-default pull-right"> 
                        <a href="viewPost.php?id=$obj->id"> READ MORE » </a>
                    </button>
                    
                </div>
            </div>
    
    
            
        
blogMainUI;



        }
    }
}

