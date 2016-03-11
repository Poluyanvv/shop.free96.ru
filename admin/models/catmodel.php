<?php

/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 03.03.2016
 * Time: 20:09
 */
class CatModel
{
    /* @var $mysqli Mysqli  */
    public $mysqli;
    public function __construct()
    {
        $this->mysqli  = Register::get('mysqli');
    }
    public static function getAll(){
        /* @var $mysqli Mysqli  */
        $mysqli = Register::get('mysqli');
        $sql = "SELECT id, cat_title FROM cat";
        if(!$result = $mysqli->query($sql)) {
            return false;
        } else {
            $items = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
            return $items;
        }
    }
    /*
    public static function getFirstLevel(){

        $mysqli = Register::get('mysqli');
        $sql = "SELECT id, cat_title FROM cat WHERE id_parent_cat = '0'";
        if(!$result = $mysqli->query($sql)) {
            return false;
        } else {
            $items = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
            return $items;
        }
    }
*/
    public static function getParentCat($id=0)
    {
        /* @var $mysqli Mysqli */
        $mysqli = Register::get('mysqli');
        $sql = "SELECT id, cat_title, cat_descr, img_cat FROM cat WHERE id_parent_cat = (?)";
        $stmt = $mysqli->stmt_init();
        if (!$stmt->prepare($sql)) {
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
    public static function saveCat($data){
        /* @var $mysqli Mysqli */
        $mysqli = Register::get('mysqli');
        $sql = "INSERT INTO cat ( cat_title, id_parent_cat, cat_descr) VALUES (?, ?,?)";
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($sql)) {
            return false;
        } else {
            $stmt->bind_param ("sis",$data['cat_title'], $data['id_parent_cat'],$data['cat_descr']);
            if($stmt->execute()){
                return $stmt->insert_id;
            }
            return false;
        }

    }

    public static function updateCat($data,$cat_id){
        /* @var $mysqli Mysqli */
        $mysqli = Register::get('mysqli');
        $sql = "UPDATE cat SET cat_title=?, id_parent_cat=?, cat_descr=? WHERE id=?";
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($sql)) {
            return false;
        } else {
            $stmt->bind_param ("sisi",$data['cat_title'], $data['id_parent_cat'],$data['cat_descr'],$cat_id);
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
    public static function deleteCat($id){
        /* @var $mysqli Mysqli */
        $mysqli = Register::get('mysqli');
        $sql = "DELETE FROM cat WHERE id=(?)";
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

    public static function getCatByCatId($id){
        /* @var $mysqli Mysqli */
        $mysqli = Register::get('mysqli');
        $sql = "SELECT id, id_parent_cat, cat_title, cat_descr, img_cat FROM cat  WHERE id = (?)";
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
    public static function stripTagsInputData (array $data = array() ){
        foreach($data as $key => $value){
            $data[$key] = strip_tags(trim($value));
        }
        return $data;
    }
    public static function uploadImg(){
        //TODO: Унифицировать функцию. директорию и размеры передать в параметрах
        $patch = Application::getUploadDir(true).DIRECTORY_SEPARATOR .'cat' .DIRECTORY_SEPARATOR;

        $fileName = $_FILES['upload_img']['name'];
        $file_ext = @strtolower( @array_pop( @explode(".", $fileName)));

        if (!in_array($file_ext, array('php','php3','php4','php5','phtml','asp','aspx','ascx','jsp','cfm','cfc','pl','bat','exe','dll','reg','cgi'))) {
            $image =  time() . '-' . Helper::transliterate($_FILES['upload_img']['name']);
            move_uploaded_file($_FILES['upload_img']['tmp_name'],$patch . $image);
            Helper::img_resize($patch . $image, $patch . $image, 400, 400, $rgb = 0xFFFFFF, $quality = 100);
            Helper::img_resize($patch . $image, $patch . 'small_' . $image, 180, 180, $rgb = 0xFFFFFF, $quality = 100);
            return $image;
        }
        return false;

    }

    public static function insertImg($id, $img=NULL ){
        /* @var $mysqli Mysqli */
        $mysqli = Register::get('mysqli');
        $sql = "UPDATE cat SET img_cat=? WHERE id=?";
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($sql)) {
            return false;
        } else {
            $stmt->bind_param ("si",$img, $id);
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }



}