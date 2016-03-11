<?php

/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 03.03.2016
 * Time: 20:58
 */
class ProductModel
{
    /* @var $mysqli Mysqli  */
    public $mysqli;
    public function __construct()
    {
        $this->mysqli  = Register::get('mysqli');
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

    public static function getProductById($id){
        /* @var $mysqli Mysqli */
        $mysqli = Register::get('mysqli');
        $sql = "SELECT id, id_cat, title, description, price, img_prod FROM product  WHERE id = (?)";
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

    public static function saveProduct($data){
        /* @var $mysqli Mysqli */
        $mysqli = Register::get('mysqli');
        $sql = "INSERT INTO product (id_cat,title,description,price) VALUES (?, ?, ?, ?)";
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($sql)) {
            return false;
        } else {
            $stmt->bind_param ("issi",$data['id_cat'], $data['title'],$data['description'], $data['price']);
            if($stmt->execute()){
                return $stmt->insert_id;
            }
            return false;
        }
    }

    public static function updateProduct($data,$product_id){
        /* @var $mysqli Mysqli */
        $mysqli = Register::get('mysqli');
        $sql = "UPDATE product SET id_cat=?, title=?, description=?,price=?  WHERE id=?";
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($sql)) {
            return false;
        } else {
            $stmt->bind_param ("issii",$data['id_cat'], $data['title'],$data['description'], $data['price'],$product_id);
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }

    public static function deleteProduct($id){
        /* @var $mysqli Mysqli */
        $mysqli = Register::get('mysqli');
        $sql = "DELETE FROM product WHERE id=(?)";
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

    public static function uploadImg(){
        //TODO: Унифицировать функцию. директорию и размеры передать в параметрах
        $patch = Application::getUploadDir(true).DIRECTORY_SEPARATOR .'product' .DIRECTORY_SEPARATOR;

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
        $sql = "UPDATE product SET img_prod=? WHERE id=?";
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