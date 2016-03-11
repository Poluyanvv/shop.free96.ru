<?php
/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 05.03.2016
 * Time: 22:40
 */
?>
<div class="page-header">
    <h3>Редактирование текстовой страницы</h3>
</div>
<form action="/admin/page/save/" method="post" id="form" class="form-horizontal order-save" role="form">
<input type="hidden" name="form[edit_id]" value="<?=$page_edit['id']?>">
    <div class="form-group">
        <label for="title" class="col-sm-2 control-label">Заголовок</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="form[title]" id="title" value="<?=isset($page_edit['title'])?$page_edit['title']:''?>"/>
        </div>
    </div>
    <div class="form-group">
        <label for="keywords" class="col-sm-2 control-label">Ключевые слова</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="form[keywords]" id="keywords" value="<?=isset($page_edit['keywords'])?$page_edit['keywords']:''?>"/>
        </div>
    </div>
    <div class="form-group">
        <label for="description" class="col-sm-2 control-label">Метаописание слова</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="form[description]" id="description" value="<?=isset($page_edit['description'])?$page_edit['description']:''?>"/>
        </div>
    </div>
    <div class="form-group">
        <label for="tinymce" class="col-sm-2 control-label">Описание</label>
        <div class="col-sm-10">
            <textarea class="form-control" rows="8"  name="form[page_info]" id="tinymce"><?=isset($page_edit['page_info'])?$page_edit['page_info']:''?></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Сохранить</button>
        </div>
    </div>
</form>