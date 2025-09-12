<?php

namespace core;

class Post extends \core\RequestMethod
{
    public function __construct()
    {
        parent::__construct($_POST);
    }
}