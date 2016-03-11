<?php
/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 03.03.2016
 * Time: 18:50
 */
class IndexController extends IAdminController {
    public function index() {
        $this->view->render('index');
    }
}