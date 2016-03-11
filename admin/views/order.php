<?php
/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 09.03.2016
 * Time: 0:53
 */

?>
<div class="page-header">
    <h3>Заказ № <?=$order_info['id']?>  от <?=$order_info['date_time']?></h3>
</div>
<div class="table-responsive">
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
    </div>
<?php
if(isset($order_items) && count($order_items)>0) {
    ?>
    <h4>Список товаров</h4>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <tr>
                <th>№ п/п</th>
                <th>Наименование</th>
                <th>Цена</b></th>
                <th>Кол-во</th>
                <th>Стоимость</th>
                <th>Удалить</th>
            </tr>
            <?php $sum = $sum_blr = $i = 0; ?>
            <?php foreach ($order_items as $element) { ?>
                <?php $i++; ?>
                <tr bgcolor="<?= ($i % 2) ? '#f1f1f1' : ''; ?>">
                    <td><?= $i ?></td>
                    <td><?= $element['title'] ?></td>
                    <td><?= $element['price'] ?> руб.</td>
                    <td><?= $element['quantity'] ?></td>
                    <td><?= $element['quantity'] * $element['price'] ?> руб.</td>
                    <td><a title="Удалить" href="/admin/orders/deleteitem/?id=<?= $element['id'] ?>"><span
                                class="glyphicon glyphicon-remove"></span></a></td>
                </tr>
                <?php $sum += ($element['quantity'] * $element['price']); ?>
            <?php } ?>
            <tr>
                <td colspan="4" class="t-right"><b>Итого:</b></td>
                <td align="left"><?= $sum ?> руб.</td>
                <td
                </td>
            </tr>
        </table>
    </div>
    <a class="btn btn-primary" href="/admin/orders/editorder/?id=<?=$order_info['id']?>">Редактировать заказ</a>
    <?php
} else{
    echo "<div class=\"alert alert-warning\">В этом заказе нет позиций!</div>";
}