<?php
/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 05.03.2016
 * Time: 22:13
 */
//var_dump($pages);
?>
<div class="page-header">
    <h3>Текстовые стриницы</h3>
</div>
    <?php
if(isset($pages) && (count($pages)>0)){
    ?>
    <div class="table-responsive">
    <table  class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
        <th>id</th>
        <th>заголовок</th>
            <th>Редактировать</th>
            <th>Удалить</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($pages as $page) {
            ?>
            <tr>
                <td><?=$page['id']?></td>
                <td><?=$page['title']?></td>
                <td><a title="Редактировать" href="/admin/page/edit/?id_page=<?=$page['id']?>"><span class="glyphicon glyphicon-pencil"></a></td>
                <td><a title="Удалить" href="/admin/page/delete/?id_page=<?=$page['id']?>"><span class="glyphicon glyphicon-remove"></span></a></td>
            </tr>

            <?php
        }
            ?>
        </tbody>
    </table>
    </div>
<?php
}