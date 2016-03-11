<?php
/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 29.02.2016
 * Time: 16:21
 */
class CartController extends IController
{
    public function index(){
        $mod = new CartModel();
        $this->view->cart_items = $mod->getCartItems();
        $this->view->render('cart');
}
    public function addToCart (){
        $mod = new CartModel();
        $prod_id = (int)$this->request('id');
        $prod_quant = (int)$this->request('quant');
        $prod_price = (int)$this->request('price');
        $mod->addToCart($prod_id,$prod_quant,$prod_price);
        header('Location:' . $_SERVER['HTTP_REFERER']);
    }
    public function deleteItem(){
        $mod = new CartModel();
        $pron_id = (int)$this->request('id');
        unset($_SESSION['shop_cart'][$pron_id]);
        header('Location: /cart/');
    }

    public function saveOrder(){
        $mod = new CartModel();
        $order_data = $mod->stripTagsInputData($this->request('form'));
        $order_error = $mod->filterInputData($order_data);
        if (empty($order_error)){
            $order_id = $mod->saveOrderData($order_data);
            $order_items = $mod->getCartItems();
            $mod->saveOrderItems($order_items, $order_id);
            $mod->clearCart();
            header('Location: /cart/orderinfo/?order_num='.$_SESSION['order_num']);
        } else {
            $this->view->cart_items = $mod->getCartItems();
            $this->view->error = $order_error;
            $this->view->order_data = $order_data;
            //header('Location: /cart/');
            $this->view->render('cart');


        }
    }
    public function orderInfo(){
        unset($_SESSION['order_num']);
        $mod = new CartModel();
        $res = $mod->getOrderInfo($this->request('order_num'));
        if (count($res)<=0){
            throw new Exception ("Error order number");
        }
        $this->view->order_info = $res;
        $this->view->items = $mod->getItemsInfo($res['id']);
        $this->view->render('order');
    }
}