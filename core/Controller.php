<?php

namespace core;

class Controller
{
    public $isPost = false;
    public $isGet = false;
    public $errorMessages;
    public $post;
    public $get;
    protected $template;

    public function __construct()
    {
        $module = \core\Core::get()->moduleName;
        $action = \core\Core::get()->actionName;
        $path = "app/views/{$module}/{$action}.php";
        $this->template = new Template($path);
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                $this->isPost = true;
                break;
            case 'GET':
                $this->isGet = true;
                break;
        }
        $this->post = new Post;
        $this->get = new Get;
        $this->errorMessages = [];
    }

    public function render($pathToView = null, $data = null)
    {
        if (!empty($pathToView)) {
            $this->template->setTemplateFilePath($pathToView);
        }

        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $this->template->setParam($key, $value);
            }
        }

        return [
            'Content' => $this->template->getHTML()
        ];

    }

    public function redirect($path)
    {
        header('Location: ' . $path);
        die;
    }

    public function addErrorMessage($message = null)
    {
        $this->errorMessages[] = $message;
        $this->template->setParam('error_message', implode('<br />', $this->errorMessages));
    }

    public function clearErrorMessage()
    {
        $this->errorMessages = [];
        $this->template->setParam('error_message', null);
    }

    public function isErrorMessagesExist(): bool
    {
        return count($this->errorMessages) > 0;
    }
}