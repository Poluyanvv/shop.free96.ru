<?php

/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 23.02.2016
 * Time: 13:17
 */
class CatalogModel {
    /* @var $mysqli Mysqli  */
    public $mysqli;
    public function __construct()
    {
        $this->mysqli  = Register::get('mysqli');
    }


    public function selectAllItems(){ //TODO: переделать на подготовленный запрос
        $sql = "SELECT id, id_cat, title, description, price, img_prod FROM product";
        if(!$result = $this->mysqli->query($sql)) {
            return false;
        } else {
            $items = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
            return $items;
        }
    }
    public function getCatByCatId($id){
        $sql = "SELECT id, cat_title, cat_descr FROM cat  WHERE id = (?)";
        $stmt = $this->mysqli->stmt_init();
        if(!$stmt->prepare($sql)) {
            return false;
        } else {
            $stmt->bind_param ("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $items = $result->fetch_assoc();
            $stmt->close();
            return $items;
        }
    }
    public function getProductByCatId($id){
        $sql = "SELECT id, title, description, price, img_prod FROM product  WHERE id_cat = (?)";
        $stmt = $this->mysqli->stmt_init();
        if(!$stmt->prepare($sql)) {
            return false;
        } else {
            $stmt->bind_param ("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $items = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $items;
        }
    }
    public static function getParentCat($id=0){
        /* @var $mysqli Mysqli  */
        $mysqli = Register::get('mysqli');
        $sql = "SELECT id, cat_title, cat_descr, img_cat FROM cat WHERE id_parent_cat = (?)";
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($sql)) {
            return false;
        } else {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $items = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $items;
        }
    }
    public function getProductById($id){
        $sql = "SELECT id, title, description, price, img_prod FROM product  WHERE id = (?)";
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
    public function getProductByShowId(){
        $sql = "SELECT id, title, description, price, img_prod FROM product  WHERE show_on_main = '1'";
        if(!$result = $this->mysqli->query($sql)) {
            return false;
        } else {
            $items = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
            return $items;
        }
    }
}