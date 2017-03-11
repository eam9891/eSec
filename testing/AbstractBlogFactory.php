<?php
/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 3/9/2017
 * Time: 7:31 PM
 */

namespace framework\testing;


abstract class AbstractBlogFactory {
    abstract function getView();
    abstract function getPosts();
    abstract function editBlog();

}