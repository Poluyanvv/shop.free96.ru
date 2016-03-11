<?php
/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 03.03.2016
 * Time: 21:35
 */
?>
<div class="page-header">
    <h3>Добавление категории товаров</h3>
    </div>
<form action="/admin/cat/save/" method="post" id="form" enctype="multipart/form-data" class="form-horizontal order-save" role="form">
    <?php
    if(isset($cat_edit)){
        ?>
        <input type="hidden" name="form[edit_id]" value="<?=$cat_edit['id']?>">
    <?php
    }
    ?>
    <div class="form-group">
        <label for="cat_title" class="col-sm-2 control-label">Категория</label>
        <div class="col-sm-10">
            <input type="text" name="form[cat_title]" class="form-control" id="cat_title" value="<?=isset($cat_edit['cat_title'])?$cat_edit['cat_title']:''?>">
        </div>
    </div>
    <div class="form-group">
        <label for="id_parent_cat" class="col-sm-2 control-label">Родительская категория</label>
        <div class="col-sm-10">
            <select name="form[id_parent_cat]" id="id_parent_cat" class="form-control">
                <option value="0"></option>
                <?php
                foreach($cats as $cat){
                    ?>
                    <option value="<?=$cat['id']?>" <?=isset($cat_edit['id_parent_cat']) && $cat_edit['id_parent_cat']==$cat['id']?'selected="selected"':''?>><?=$cat['cat_title']?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="tinymce" class="col-sm-2 control-label">Описание</label>
        <div class="col-sm-10">
            <textarea class="form-control" rows="5"  name="form[cat_descr]" id="tinymce"><?=isset($cat_edit['cat_descr'])?$cat_edit['cat_descr']:''?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="upload_img" class="col-sm-2 control-label">Картинка</label>
        <div class="col-sm-10">
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
            <input type="file" name="upload_img" id="upload_img" />
            <?=isset($cat_edit['img_cat'])?'<a target="_blank" href="/media/cat/'.$cat_edit['img_cat'].'">'.$cat_edit['img_cat'].'</a>':'Картинка не установлена.'?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <?php
                if (isset($cat_edit['img_cat'])) {
                    ?>
                    <label>
                        <input type="checkbox" name="form[del_img]" value="1" id="del_img"/>
                        Удалить картинку</label>
                <?php }    ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Сохранить</button>
        </div>
    </div>
</form>
