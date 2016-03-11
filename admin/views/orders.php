<?php
/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 08.03.2016
 * Time: 23:04
 */
//var_dump($orders);
?>
<div class="page-header">
<h3>Список заказов</h3>
</div>
<?php
    if(isset($orders) && !empty($orders)){
    ?>
    <div class="table-responsive">
        <table  class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>Номер заказ / Дата</th>
                <th>Клиент</th>
                <th>Адрес доставки / Комментарий</th>
                <th>Подробнее</th>
                <th>Удалить</th>
            </tr>
            </thead>
            <?php
            foreach($orders as $order){
                ?>
                <tr>
                    <td>№ <b><?=$order['id']?></b><br/>
                    от <?=$order['date_time']?></td>
                    <td><?=$order['name']?> <br/><?=$order['email']?> <br/><?=$order['tel']?></td>
                    <td><?=$order['adress']?> <br/><?=$order['message']?></td>
                    <td><a title="Просмотреть" href="/admin/orders/order/?id=<?=$order['id']?>"><span class="glyphicon glyphicon-list-alt"></span></a></td>
                    <td><a title="Удалить" href="/admin/orders/delete/?id=<?=$order['id']?>"><span class="glyphicon glyphicon-remove"></span></a></td>
                </tr>
                <?php
            }

            ?>
        </table>
    </div>
<?php
} else {
    echo "<div class=\"alert alert-warning\">В системе нет заказов.</div>";
}
?>