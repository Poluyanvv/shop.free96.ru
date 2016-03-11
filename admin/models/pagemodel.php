<?php

/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 05.03.2016
 * Time: 22:14
 */
class PageModel
{
    /* @var $mysqli Mysqli  */
    public $mysqli;
    public function __construct()
    {
        $this->mysqli  = Register::get('mysqli');
    }

    public function getAllPages(){
        $sql = "SELECT id, title  FROM pages";
        if(!$result = $this->mysqli->query($sql)) {
            return false;
        } else {
            $items = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
            return $items;
        }
    }

    public static function getPageById($id){
        /* @var $mysqli Mysqli */
        $mysqli = Register::get('mysqli');
        $sql = "SELECT id, title, keywords, description, page_info FROM pages  WHERE id = (?)";
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($sql)) {
            return false;
        } else {
            $stmt->bind_param ("i", $id);
            if($stmt->execute()) {

                $result = $stmt->get_result();
                $items = $result->fetch_assoc();
                $stmt->close();
                return $items;
            } else {
                return false;
            }
        }

    }
    public static function updatePage($data,$page_id){
        /* @var $mysqli Mysqli */
        $mysqli = Register::get('mysqli');
        $sql = "UPDATE pages SET title=?, keywords=?, description=?, page_info=? WHERE id=?";
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($sql)) {
            return false;
        } else {
            $stmt->bind_param ("ssssi",$data['title'], $data['keywords'],$data['description'],$data['page_info'], $page_id);
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
    public static function deletePage($id){
        /* @var $mysqli Mysqli */
        $mysqli = Register::get('mysqli');
        $sql = "DELETE FROM pages WHERE id=(?)";
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($sql)) {
            return false;
        } else {
            $stmt->bind_param ("i",$id);
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }


}