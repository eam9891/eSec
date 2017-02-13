<?php

/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 2/12/2017
 * Time: 1:55 AM
 */
class GetWriters {
    public static function getWriter() {
        // grab request variable
        $format = $_REQUEST['format'];
        // construct our class name and check its existence
        $class = 'Article' . $format . 'Writer';
        if(class_exists($class)) {
            // return a new Writer object
            return new $class();
        }
        // otherwise we fail
        throw new Exception('Unsupported format');
    }
}