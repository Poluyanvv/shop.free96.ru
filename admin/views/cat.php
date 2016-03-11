<?php
/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 03.03.2016
 * Time: 18:53
 */
?>
<div class="page-header">
<h3>Каталог товаров <?=isset($cat['cat_title'])? ' / '.$cat['cat_title']:''?></h3>
</div>
<?php

if(isset($cats) && !empty($cats)){
    ?>
<div class="table-responsive">
    <table  class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>Id</th>
            <th>Категория</th>
            <th>Товары</th>
            <th>Подкат.</th>
            <th>Редакт.</th>
            <th>Удалить</th>
        </tr>
        </thead>
        <?php
        foreach($cats as $cat){
            ?>
            <tr>
                <td><?=$cat['id']?></td>
                <td><?=$cat['cat_title']?></td>
                <td><a href="/admin/product/?id_cat=<?=$cat['id']?>">Товары</a></td>
                <td><a href="/admin/cat/?parent_cat=<?=$cat['id']?>">Подкатегории</a></td>
                <td><a title="Редактировать" href="/admin/cat/edit/?id_cat=<?=$cat['id']?>"><span class="glyphicon glyphicon-pencil"></a></td>
                <td><a title="Удалить" href="/admin/cat/delete/?id_cat=<?=$cat['id']?>"><span class="glyphicon glyphicon-remove"></span></a></td>
            </tr>
            <?php
        }

        ?>
    </table>
    </div>
    <?php
} else {
    echo "<div class=\"alert alert-warning\">В этой категории нет подкатегорий.</div>";
}
?>
<a class="btn btn-primary" href="/admin/cat/add/?id_parent_cat=<?=$cat_id?>">Добавить категорию?</a>

