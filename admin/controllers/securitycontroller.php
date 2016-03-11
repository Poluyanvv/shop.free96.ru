<?php

/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 04.03.2016
 * Time: 15:10
 */
class SecurityController extends Controller
{
    /* @var $request Request */
    public function login(){
        if(SecurityModel::isAuthed()){
            header('Location: /admin/index/');
        }
        if ($this->isPost()) {
            $login = $this->request('login');
            $pass = md5(md5($this->request('password')));
            $remember = (int)$this->request('remember',0);
            $user = SecurityModel::getUserData($login);
            if($user['pass'] == $pass){
                SecurityModel::saveAuthData($user,$remember);
                header('Location: /admin/index/');
            }
        }
        $this->view->setLayout('simple');
        $this->view->render('login');
    }

    public function logout (){
        SecurityModel::logout();
        header('Location: /admin/security/login/');
    }

}