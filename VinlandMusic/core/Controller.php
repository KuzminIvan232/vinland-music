<?php

namespace core;

class Controller
{
    protected $template;

    public function __construct()
    {
        $module = \core\Core::get()->moduleName;
        $action = \core\Core::get()->actionName;
        $path = "app/views/{$module}/{$action}.php";
        $this->template = new Template($path);
    }

    public function render($pathToView = null)
    {
        if (!empty($pathToView)) {
            $this->template->setTemplateFilePath($pathToView);
        } else {
            return [
                'Content' => $this->template->getHTML()
            ];
        }
    }
}