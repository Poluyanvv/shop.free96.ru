<?php

/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 04.03.2016
 * Time: 14:22
 */
class Authorization
{
    public function login($login, $password){
        /* @var $mysqli Mysqli */
        $mysqli = Register::get('mysqli');
        $sql = "SELECT * FROM users WHERE login='".$login."' AND pass='".$password."'";
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($sql)) {
            return false;
        } else {
            $stmt->bind_param ("i", $id);
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


}