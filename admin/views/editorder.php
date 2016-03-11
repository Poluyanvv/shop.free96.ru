<?php
/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 09.03.2016
 * Time: 22:52
 */
?>
<div class="page-header">
    <h3>Заказ № <?=$order_data['id']?>  от <?=$order_data['date_time']?></h3>
</div>
<form action="/admin/orders/updateorder/" method="POST" id="form" class="form-horizontal order-save" role="form">
    <input hidden type="text" name="form[id]"  id="id" value="<?=$order_data['id']?>">

    <div class="form-group">
            <label for="form_name" class="col-sm-2 control-label">Имя</label>
            <div class="col-sm-10">
                <input type="text" name="form[name]" class="form-control" id="form_name" placeholder="ФИО" value="<?=(isset($order_data)&&!empty($order_data['name']))?$order_data['name']:'';?>">
</div>
</div>
<div class="form-group">
    <label for="form_phone" class="col-sm-2 control-label">Телефон</label>
    <div class="col-sm-10">
        <input type="text" name="form[phone]" class="form-control" id="form_phone" placeholder="+375-29-662-58-86" value="<?=(isset($order_data)&&!empty($order_data['tel']))?$order_data['tel']:'';?>">
    </div>
</div>
<div class="form-group">
    <label for="form_email" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
        <input type="email" name="form[email]" class="form-control" id="form_email" placeholder="example@example.com" value="<?=(isset($order_data)&&!empty($order_data['email']))?$order_data['email']:'';?>">
    </div>
</div>
<div class="form-group">
    <label for="form_address" class="col-sm-2 control-label">Адрес доставки</label>
    <div class="col-sm-10">
        <textarea name="form[address]" class="form-control" id="form_address"  rows="3" placeholder="г. Минск, ул. Притыцкого 78, кв.91"><?=(isset($order_data)&&!empty($order_data['adress']))?$order_data['adress']:'';?></textarea>
    </div>
</div>
<div class="form-group">
    <label for="form_message" class="col-sm-2 control-label">Комментарий </label>
    <div class="col-sm-10">
        <textarea name="form[message]"  class="form-control" rows="3" id="form_message" placeholder="Комментарий"><?=(isset($order_data)&&!empty($order_data['message']))?$order_data['message']:'';?></textarea>
    </div>
</div>
    <div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
        <th>№ п/п</th>
        <th>Товар</th>
        <th>Стоимость</th>
        <th>Кол-во</th>

        </tr>
        </thead>
        <tbody>
        <?php
        $i=1;
        $sum = 0;
        foreach ($items as $item ) {
            ?>
            <tr>
                <td>
                    <input hidden type="text" name="item[<?=$item['id']?>][id]"  id="id" value="<?=(isset($item)&&!empty($item['id']))?$item['id']:'';?>">
                    <?= $i ?></td>

                <td><?= $item['title'] ?></td>
                <td>
                    <input type="text" name="item[<?=$item['id']?>][price]"  id="price" placeholder="" value="<?=(isset($item)&&!empty($item['price']))?$item['price']:'';?>">
                </td>
                <td>
                    <input type="text" name="item[<?=$item['id']?>][quantity]"  id="quantity" placeholder="" value="<?=(isset($item)&&!empty($item['quantity']))?$item['quantity']:'';?>">
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>
        <div class="form-group">
            <label for="form_message" class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
                <input type="submit" value="Сохранить" class="btn btn-primary"/>
            </div>
        </div>
</form>