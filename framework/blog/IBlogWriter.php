<?php

/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 2/12/2017
 * Time: 1:45 AM
 */
namespace framework\blog;

interface IBlogWriter {
    /**
     * @param \framework\blog\Article $obj
     *
     * @return mixed
     */
    public function write(Article $obj);
}