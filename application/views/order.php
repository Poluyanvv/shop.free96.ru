<?php
/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 01.03.2016
 * Time: 14:02
 */
/*var_dump($order_info);
var_dump($items);
*/
?>
<div class="page-header">
    <h1 >Ваш заказ № <?=$order_info['id']?>  от <?=$order_info['date_time']?></h1>
</div>
<table class="table table-striped table-bordered table-hover">
        <tr>
        <th>Имя</th>
        <td><?=$order_info['name']?></td>
    </tr>
    <tr>
        <th>Телефон</th>
        <td><?=$order_info['tel']?></td>
    </tr>
    <tr bgcolor="#f1f1f1">
        <th>E-mail</th>
        <td><?=$order_info['email']?></td>
    </tr>
        <tr>
            <th>Адрес доставки</th>
            <td><?=$order_info['adress']?></td>
        </tr>
    <?php if ($order_info['message']){?>
        <tr>
            <th>Коментарий</th>
            <td><?=$order_info['message']?></td>
        </tr>
    <?php }?>
</table>

<h2 >Список товаров</h2>
<div class="table-responsive">
<table  class="table table-striped table-bordered table-hover">
    <tr>
        <th>№ п/п</th>
        <th>Наименование</th>
        <th>Цена</b></th>
        <th>Кол-во</th>
        <th>Стоимость</th>
    </tr>
    <?php $sum=$sum_blr=$i=0;?>
    <?php foreach ($items as $element){?>
        <?php $i++;?>
        <tr bgcolor="<?=($i%2)?'#f1f1f1':'';?>">
            <td><?=$i?></td>
            <td><?=$element['title']?></td>
            <td><?=$element['price']?> руб.</td>
            <td><?=$element['quantity']?></td>
            <td><?=$element['quantity']*$element['price']?> руб.</td>
        </tr>
        <?php $sum += ($element['quantity']*$element['price']);?>
    <?php }?>
        <tr>
            <td colspan="4" class="t-right"><b>Итого:</b></td>
            <td colspan="1" align="left"><?=$sum?> руб.</td>
        </tr>
</table>
</div>