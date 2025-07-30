<?php

namespace core;

class Session
{

    public function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public function setValues($array) {
        foreach ($array as $key => $value) {
            $this->set($key, $value);
        }
    }
public
function get($name)
{
    return $_SESSION[$name];
}

}