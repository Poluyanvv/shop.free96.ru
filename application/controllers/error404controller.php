<?php

/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 10.03.2016
 * Time: 23:48
 */
class Error404Controller extends IController
{
    public function index(){
        $this->view->render('error404');
    }

}