<?php
/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 04.03.2016
 * Time: 21:21
 */

?>
<div class="page-header">
<h3>Добавление категории товаров</h3>
    </div>
<form action="/admin/product/save/" method="post" id="form" enctype="multipart/form-data" class="form-horizontal order-save" role="form">
    <?php
    if(isset($product_edit)){
        ?>
        <input type="hidden" name="form[edit_id]" value="<?=$product_edit['id']?>">
        <?php
    }
    ?>

    <div class="form-group">
        <label for="title" class="col-sm-2 control-label">Наименование</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="form[title]" id="title" value="<?=isset($product_edit['title'])?$product_edit['title']:''?>"/>        </div>
    </div>
    <div class="form-group">
        <label for="id_cat" class="col-sm-2 control-label">Категория</label>
        <div class="col-sm-10">
                <select name="form[id_cat]" id="id_cat" class="form-control">
                    <option value="0"></option>
                    <?php
                    foreach($cats as $cat){
                        ?>
                        <option value="<?=$cat['id']?>" <?=isset($product_edit['id_cat']) && $product_edit['id_cat']==$cat['id']?'selected="selected"':''?>><?=$cat['cat_title']?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    <div class="form-group">
        <label for="tinymce" class="col-sm-2 control-label">Описание</label>
        <div class="col-sm-10">
            <textarea class="form-control" rows="5"  name="form[description]" id="tinymce"><?=isset($product_edit['description'])?$product_edit['description']:''?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="price" class="col-sm-2 control-label">Цена</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="form[price]" id="price" value="<?=isset($product_edit['price'])?$product_edit['price']:''?>"/>
        </div>
    </div>

    <div class="form-group">
        <label for="upload_img" class="col-sm-2 control-label">Картинка</label>
        <div class="col-sm-10">
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
            <input type="file" name="upload_img" id="upload_img" />
            <?=isset($product_edit['img_prod'])?'<a target="_blank" href="/media/product/'.$product_edit['img_prod'].'">'.$product_edit['img_prod'].'</a>':'Картинка не установлена.'?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <?php
                if (isset($product_edit['img_prod'])) {
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
