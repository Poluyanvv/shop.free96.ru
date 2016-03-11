<?php

/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 05.03.2016
 * Time: 13:23
 */
class PageModel
{
    /* @var $mysqli Mysqli  */
    public $mysqli;
    public function __construct()
    {
        $this->mysqli  = Register::get('mysqli');
    }

    public  function getById($id){

        $sql = "SELECT id, title, description, keywords,page_info FROM pages  WHERE id = (?)";
        $stmt = $this->mysqli->stmt_init();
        if(!$stmt->prepare($sql)) {
            return false;
        } else {
            $stmt->bind_param ("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $item = $result->fetch_assoc();
            $stmt->close();
            return $item;
        }

    }

}