<?php

/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 2/12/2017
 * Time: 1:45 AM
 */
interface IBlogWriter {
    public function write(Article $obj);
}