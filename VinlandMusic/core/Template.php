<?php

namespace core;

class Template
{

    public $filePath;
    public $paramsArray;
    public function __set($name, $value) {
        \core\Core::get()->template->setParam($name, $value);
    }
    function __construct($filePath) {
        $this->filePath = $filePath;
        $this->paramsArray = [];
    }

    public function setParam($paramName, $paramValue) {
        $this->paramsArray[$paramName] = $paramValue;
    }

    public function setParams($params) {
        foreach ($params as $key => $value) {
            $this->setParam($key, $value);
        }
    }

    function getParams() {
        return $this->paramsArray;
    }

    public function getHTML() {
        ob_start();
        extract($this->paramsArray);
        include $this->filePath;
        $str = ob_get_contents();
        ob_end_clean();
        return $str;
    }

    public function display() {
        echo $this->getHTML();
    }

}