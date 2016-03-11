<?php

/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 08.03.2016
 * Time: 23:04
 */
class OrdersModel
{
    /* @var $mysqli Mysqli  */
    public $mysqli;
    public function __construct()
    {
        $this->mysqli  = Register::get('mysqli');
    }
    public function getAll(){
        $sql = "SELECT id, date_time, name, email, tel, adress, message, order_num FROM orders";
        if(!$result = $this->mysqli->query($sql)) {
            return false;
        } else {
            $items = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
            return $items;
        }
    }

    public function deleteOrderById($id){
            $sql = "DELETE FROM orders WHERE id=(?)";
            $stmt = $this->mysqli->stmt_init();
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
    public function getOrderInfo($id){
        $sql = "SELECT id, date_time, name, email, tel, adress, message, order_num FROM orders WHERE id = (?)";
        $stmt = $this->mysqli->stmt_init();
        if(!$stmt->prepare($sql)) {
            return false;
        } else {
            $stmt->bind_param ("s", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $order_info = $result->fetch_assoc();
            $stmt->close();
            return $order_info;
        }
    }

    public function getOrderItems($order_id){
        $sql = "SELECT  I.id, P.title, I.quantity, I.price FROM itemorder I INNER JOIN product P ON P.id = I.id_items WHERE I.order_id = (?)";
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
    public function deleteItemById($id)
    {
        $sql = "DELETE FROM itemorder WHERE id=(?)";
        $stmt = $this->mysqli->stmt_init();
        if (!$stmt->prepare($sql)) {
            return false;
        } else {
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                return true;
            }
            return false;
        }
    }

    public function updateOrderData($data){
        $sql = "UPDATE orders SET  name=?, tel=?, email=?, adress=?, message=?";
        $stmt = $this->mysqli->stmt_init();
        if(!$stmt->prepare($sql)) {
            return false;
        } else {
            $_SESSION['order_num'] = $order_num = uniqid();
            $stmt->bind_param ("sssss", $data['name'],$data['phone'],$data['email'],$data['address'],$data['message'] );
            $stmt->execute();
            return true;
        }
    }

    public function updateOrderItems($data){
        $sql = "UPDATE itemorder SET  quantity=?, price=? WHERE id=?";
        $stmt = $this->mysqli->stmt_init();
        if (!$stmt->prepare($sql)) {
            return false;
        } else {
            foreach($data as $value) {
                $stmt->bind_param("iii", $value['quantity'], $value['price'], $value['id']);
                $stmt->execute();
            }
            $stmt->close();
            return true;
        }
    }

}