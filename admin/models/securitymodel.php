<?php

/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 04.03.2016
 * Time: 15:10
 */
class SecurityModel
{
    public static function getUserData($login){
        /* @var $mysqli Mysqli */
        $login = strip_tags($login);
        $mysqli = Register::get('mysqli');
        $sql = "SELECT * FROM users WHERE login = (?)";
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($sql)) {
            return false;
        } else {
            $stmt->bind_param ("s", $login);
            if($stmt->execute()) {

                $result = $stmt->get_result();
                $user = $result->fetch_assoc();
                $stmt->close();
                return $user;
            } else {
                return false;
            }
        }
    }
    public static function saveAuthData($user,$remember=0){
        $_SESSION['admin']['user'] = $user;
        if ($remember == 1) {
            SecurityModel::setCookies($user['login'], $user['pass']);
        }
    }

    public static function setCookies($login, $pass){
        setcookie("adm_cook_login",$login,time()+(60*60*24*365),"/",$_SERVER['HTTP_HOST']);
        setcookie("adm_cook_pass",$pass,time()+(60*60*24*365),"/",$_SERVER['HTTP_HOST']);

    }

    public static function logout(){
        setcookie("adm_cook_login","",time(),"/",$_SERVER['HTTP_HOST']);
        setcookie("adm_cook_pass","",time(),"/",$_SERVER['HTTP_HOST']);
        unset($_SESSION['admin']['user']);
    }

    public static function isAuthed(){
        if (isset($_SESSION['admin']['user'])) {
            return true;
        }
        $login = (isset($_COOKIE['adm_cook_login'])?$_COOKIE['adm_cook_login']:'');
        $pass = (isset($_COOKIE['adm_cook_pass'])?$_COOKIE['adm_cook_pass']:'');
        if ($login && $pass) {
           $user = self::getUserData($login);
            if($user['pass'] == $pass){
                self::saveAuthData($user);
               return true;
            }
        }
        return false;

    }

}