<div class="page-header">
<h3>Каталог товаров<?=isset($cat['cat_title'])? ' / '.$cat['cat_title']:''?></h3>
    </div>
<?php
if(isset($products) && !empty($products)){
    ?>
    <div class="table-responsive">
    <table  class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>Id</th>
            <th>Наименование товара</th>
            <th>Цена</th>
            <th>Редактировать</th>
            <th>Удалить</th>
        </tr>
        </thead>
        <?php
        foreach($products as $product){
            ?>
            <tr>
                <td><?=$product['id']?></td>
                <td><?=$product['title']?></td>
                <td><?=$product['price']?></td>
                <td><a title="Редактировать" href="/admin/product/edit/?edit_id=<?=$product['id']?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
                <td><a title="Удалить" href="/admin/product/delete/?id=<?=$product['id']?>"><span class="glyphicon glyphicon-remove"></span></a></td>
            </tr>
            <?php
        }

        ?>
    </table>
    </div>
    <?php
} else {
    echo "<div class=\"alert alert-warning\">В этой категории нет товаров.</div>";
}
?>
<a class="btn btn-primary" href="/admin/product/add/">Добавить товар?</a>


