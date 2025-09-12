<?php

namespace core;

class Get extends \core\RequestMethod
{
    public function __construct()
    {
        parent::__construct($_GET);
    }
}