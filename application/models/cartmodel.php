<?php

/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 29.02.2016
 * Time: 16:59
 */
class CartModel
{
    /* @var $mysqli Mysqli  */
    public $mysqli;
    public function __construct()
    {
        $this->mysqli  = Register::get('mysqli');
    }
    public function getCartItems (){
        $mod = new CatalogModel();
        $cart_items = array();
        if(isset($_SESSION['shop_cart']) && count($_SESSION['shop_cart'])>0){
            foreach ($_SESSION['shop_cart'] as $key => $item){
                $prod = $mod->getProductById($key);
                $item['title'] = $prod['title'];
                $item['id'] = $key;
                $cart_items[] = array_reverse($item);
            }
        }
        return $cart_items;
    }
    public function addToCart($prod_id,$prod_quant,$prod_price )
    {
        if (!isset($_SESSION['shop_cart'])) {
            $_SESSION['shop_cart'];
        }
        if (array_key_exists($prod_id, $_SESSION['shop_cart'])) {
            $_SESSION['shop_cart'][$prod_id]['quantity']++;
        } else {
            $_SESSION['shop_cart'][$prod_id] = array('quantity' => $prod_quant, 'price' => $prod_price);
        }

    }
    public function saveOrderData($data){
        $sql = "INSERT INTO orders (order_num, name, tel, email, adress, message) VALUES (?,?,?,?,?,?)";
        $stmt = $this->mysqli->stmt_init();
        if(!$stmt->prepare($sql)) {
            return false;
        } else {
            $_SESSION['order_num'] = $order_num = uniqid();
            $stmt->bind_param ("ssssss", $order_num, $data['name'],$data['phone'],$data['email'],$data['address'],$data['message'] );
            $stmt->execute();
            return $stmt->insert_id;
        }
    }

    public function saveOrderItems($data, $order_id){
        $sql = "INSERT INTO itemorder (order_id, id_items, quantity, price) VALUES (?,?,?,?)";
        $stmt = $this->mysqli->stmt_init();
        if (!$stmt->prepare($sql)) {
            return false;
        } else {
            foreach($data as $value) {
                $stmt->bind_param("iiii", $order_id, $value['id'], $value['quantity'], $value['price']);
                $stmt->execute();
            }
            $stmt->close();
            return true;
        }
    }
    public function clearCart(){
        unset($_SESSION['shop_cart']);
    }
    public function getOrderInfo($order_num){
        $sql = "SELECT id, date_time, name, email, tel, adress, message, order_num FROM orders WHERE order_num = (?)";
        $stmt = $this->mysqli->stmt_init();
        if(!$stmt->prepare($sql)) {
            return false;
        } else {
            $stmt->bind_param ("s", $order_num);
            $stmt->execute();
            $result = $stmt->get_result();
            $order_info = $result->fetch_assoc();
            $stmt->close();
            return $order_info;
        }
    }
    public function getItemsInfo($order_id){
        $sql = "SELECT  P.title, I.quantity, I.price FROM itemorder I INNER JOIN product P ON P.id = I.id_items WHERE I.order_id = (?)";
        $stmt = $this->mysqli->stmt_init();
        if(!$stmt->prepare($sql)) {
            return false;
        } else {
            $stmt->bind_param ("i",$order_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $items_info = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $items_info;
        }
    }
    public function stripTagsInputData (array $data = array() ){
        foreach($data as $key => $value){
            $data[$key] = strip_tags(trim($value));
         }
        return $data;
    }
    public function filterInputData($data){
        $error = array();
        $parent_tel = '/^[-0-9()+]+$/';
        $parent_name = '/^[a-zA-z0-9а-яА-ЯёЁ]{' . MIN_LENGTH_NAME . ',' . MAX_LENGTH_NAME . '}+$/u';

        if(!preg_match($parent_name,$data['name'])){
             $error['name'] = "Введите корректное имя";
            }
        if(!preg_match($parent_tel,$data['phone'])){
            $error['phone'] = "Введите корректный номер тел.";
        }
        if(!$data['address']){
            $error['address'] = "Введите адрес";
        }
        if (filter_var($data['email'],FILTER_VALIDATE_EMAIL) === false){
            $error['email'] = "Введите корректный Email";

        }
        return $error;
    }


}