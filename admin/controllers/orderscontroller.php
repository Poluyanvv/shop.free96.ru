<?php

/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 08.03.2016
 * Time: 23:04
 */
class OrdersController extends IAdminController
{
    public function index(){
        $mod_order = new OrdersModel();
        $this->view->orders = array_reverse($mod_order->getAll());
        $this->view->render('orders');
    }

    public function delete (){
        $mod = new OrdersModel();
        $id = (int)$this->request('id');
        $mod->deleteOrderById($id);
        header('Location:/admin/orders');

    }
    public function order(){
        $mod = new OrdersModel();
        $id = (int)$this->request('id');
        $this->view->order_info = $mod->getOrderInfo($id);
        $this->view->order_items = $mod->getOrderItems($id);
        $this->view->render('order');
    }
    public function deleteItem(){
        $mod = new OrdersModel();
        $id = (int)$this->request('id');
        $mod->deleteItemById($id);
        header('Location:'.$_SERVER['HTTP_REFERER']);

    }
    public function editOrder(){
        $mod = new OrdersModel();
        $id = (int)$this->request('id');
        $this->view->order_data = $mod->getOrderInfo($id);
        $this->view->items = $mod->getOrderItems($id);

        $this->view->render('editorder');
    }
    public function updateOrder(){
        $mod = new OrdersModel();
        $order_data = $this->request('form');
        $order_items = $this->request('item');
        var_dump($order_items);
        $mod->updateOrderData($order_data);
        $mod->updateOrderItems($order_items);
        var_dump($order_items);
        header('Location:/admin/orders/order/?id='.$order_data['id']);

    }
    //TODO: Настроить страницу редактирования заказа

}