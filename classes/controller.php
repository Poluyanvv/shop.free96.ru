<?php
/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 04.03.2016
 * Time: 16:21
 */
class Controller
{
    public $controller, $action,  $view, $request;
    public function beforeAction ()
    {
        if(!session_id())
        session_start();

    }
    public function request($name, $defaultValue = null)
    {
        /* @var $request Request */
        return $this->request->getParam($name, $defaultValue);
    }
    public function post($name, $defaultValue = null)
    {
        /* @var $request Request */
        return $this->request->post($name, $defaultValue);
    }
    public function isPost(){
        return $this->request->isPost();
    }


}