<?php

/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 03.03.2016
 * Time: 19:28
 */

class IAdminController extends Controller{


    public function beforeAction ()
    {
        parent::beforeAction();
        if(!SecurityModel::isAuthed()){
            header('Location: /admin/security/login/');
        }


    }


}