<?php

namespace App\Lib;

class Request
{
    public $params;
    public $reqMethod;
    public $contentType;

    public function __construct()
    {
        $this->reqMethod = $_SERVER['REQUEST_METHOD'];
        $this->contentType = isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->params = $_POST;
        } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->params = $_GET;
        }
    }


    public function getBody()
    {
        if ($this->reqMethod !== 'POST') {
            return '';
        }

        $body = [];
        foreach ($_POST as $key => $value) {
            $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        return $body;
    }
    public function getParam($key, $default = null)
    {
        return isset($this->params[$key]) ? $this->params[$key] : (isset($this->params[0]) ? $this->params[0] : $default);
    }


    public function setParam($key, $value)
    {
        $this->params[$key] = $value;
    }
}
