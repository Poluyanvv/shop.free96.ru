<?php

/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 23.02.2016
 * Time: 0:22
 */
class Request
{

    private $get;
    private $post;
    private $request;


    public function __construct($getParams = null)
    {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->request = $_REQUEST;

        if (!empty($getParams)) {
            $this->get = array_merge($getParams, $this->get);
            $this->request = array_merge($getParams, $this->request);
        }
    }

    public function getParam($key, $defaultValue = null)
    {
        if (!empty($this->request[$key])) {
            return $this->request[$key];
        }
        return $defaultValue;
    }

    public function get($key, $defaultValue = null)
    {
        if (!empty($this->get[$key])) {
            return $this->get[$key];
        }
        return $defaultValue;
    }

    public function post($key, $defaultValue = null)
    {
        if (!empty($this->post[$key])) {
            return $this->post[$key];
        }
        return $defaultValue;
    }

    public function isPost()
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            return true;
        }
        return false;

    }

    public function isGet()
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'get') {
            return true;
        }
        return false;
    }
}