<?php
/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 3/9/2017
 * Time: 7:33 PM
 */

namespace framework\testing;


class FactoryProducer {
    private $whichFactory, $whichMethod;

    public function getFactory(array $params) : AbstractBlogFactory {
        $this->whichFactory = $params['whichFactory'];
        $this->whichMethod = $params['whichMethod'];
    }
}