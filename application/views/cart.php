<?php
/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 29.02.2016
 * Time: 18:59
 */
?>
<div class="page-header">
<h1>Корзина покупок</h1>
</div>
<?php
if(isset($cart_items) && !empty($cart_items)){
?>
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
    <thead>
    <tr>
        <th>№ п/п</th>
        <th>Товар</th>
        <th>Стоимость</th>
        <th>Кол-во</th>
        <th>Сумма</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
<?php
$i=1;
$sum = 0;
    foreach ($cart_items as $item ){
?>
    <tr>
        <td><?=$i?></td>
        <td><?=$item['title']?></td>
        <td><?=$item['price']?></td>
        <td><?=$item['quantity']?></td>
        <td><?=$item['price']*$item['quantity']?> руб.</td>
        <td><a title="Удалить" href="/cart/deleteitem/id/<?=$item['id']?>"><span class="glyphicon glyphicon-remove"></span></a></td>
    </tr>
<?php
$sum=$sum+($item['price']*$item['quantity']);
        $i++;
    }
?>
    <tr>
        <td colspan="4">Итого:</td>
        <td><?=$sum?> руб.</td>
        <td></td>
    </tr>
</tbody>
</table>
</div>
    <form action="/cart/saveorder/" method="POST" id="form" class="form-horizontal order-save" role="form">
        <div class="form-group">
            <label for="form_name" class="col-sm-2 control-label">Имя</label>
            <div class="col-sm-10">
                <input type="text" name="form[name]" class="form-control" id="form_name" placeholder="ФИО" value="<?=(isset($order_data)&&!empty($order_data['name']))?$order_data['name']:'';?>">
                <span class="msg-error"><?=(isset($error)&&!empty($error['name']))?'<span class="msg-error">'.$error['name'].'</span>':'';?></span>
            </div>
        </div>
        <div class="form-group">
            <label for="form_phone" class="col-sm-2 control-label">Телефон</label>
            <div class="col-sm-10">
                <input type="text" name="form[phone]" class="form-control" id="form_phone" placeholder="+375-29-662-58-86" value="<?=(isset($order_data)&&!empty($order_data['phone']))?$order_data['phone']:'';?>">
                <span class="msg-error"><?=(isset($error)&&!empty($error['phone']))?$error['phone']:'';?></span>
            </div>
        </div>
        <div class="form-group">
            <label for="form_email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input type="email" name="form[email]" class="form-control" id="form_email" placeholder="example@example.com" value="<?=(isset($order_data)&&!empty($order_data['email']))?$order_data['email']:'';?>">
                <span class="msg-error"><?=(isset($error)&&!empty($error['email']))?$error['email']:'';?></span>
            </div>
        </div>
        <div class="form-group">
            <label for="form_address" class="col-sm-2 control-label">Адрес доставки</label>
            <div class="col-sm-10">
                <textarea name="form[address]" class="form-control" id="form_address"  rows="3" placeholder="г. Минск, ул. Притыцкого 78, кв.91"><?=(isset($order_data)&&!empty($order_data['address']))?$order_data['address']:'';?></textarea>
                <span class="msg-error"><?=(isset($error)&&!empty($error['address']))?$error['address']:'';?></span>
            </div>
        </div>
        <div class="form-group">
            <label for="form_message" class="col-sm-2 control-label">Комментарий </label>
            <div class="col-sm-10">
                <textarea name="form[message]"  class="form-control" rows="3" id="form_message" placeholder="Комментарий"><?=(isset($order_data)&&!empty($order_data['message']))?$order_data['message']:'';?></textarea>
            </div>
        </div>
         <div class="form-group">
             <label for="form_message" class="col-sm-2 control-label"></label>
             <div class="col-sm-10">
                <input type="submit" value="Оформить заказ" class="btn btn-primary"/>
             </div>
        </div>
    </form>
    <?php
} else {
    echo '<div class="alert alert-warning">Выша корзина пуста.</div>';
}