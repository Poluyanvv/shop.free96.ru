<?php

/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 28.02.2016
 * Time: 14:24
 */
class Database
{
    private $_connection;
    private static $_db;

    private function __construct()
    {
        $this->_connection = new Mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if($this->_connection->connect_error){
            throw new Exception ('Ошибка подключения к базе данных. (' .$this->_connection->connect_errno . ') '
                    . self::$_db->connect_error);
        }
    }

    final public static function getInstance (){
        if(self::$_db === NULL) {
            $className = __CLASS__;
            self::$_db = new $className;
        }
        return self::$_db;
    }
    final public function getConnection() {

        return $this->_connection;
    }

    final private function __clone() {
    }

    public function close(){
        unset($this->_connection);
    }
}