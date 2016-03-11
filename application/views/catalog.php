<?php
if(!empty($cat) && isset($cat)){
    ?>
<div class="row">
    <div class="container">
    <div class="page-header">
        <h1><?=$cat['cat_title']?></h1>
    </div>
        <?=(isset($cat)&&!empty($cat['cat_descr']))?$cat['cat_descr']:'';?>
</div>
</div>
<?php
}
if(isset($parent_cats) && !empty($parent_cats)){
?>
<div class="row">

<?php
    foreach($parent_cats as $parent_cat){ ?>
    <div class="col-sm-6 col-md-3">
        <div class="thumbnail">
                <?php
                if(isset($parent_cat['img_cat'])) {
                    ?>
                    <img class="img-responsive" src="/media/cat/small_<?= $parent_cat['img_cat'] ?>"/>
                    <?php
                } else {
                    ?>
                    <img class="img-responsive" title="no foto" src=""/>
                    <?php
                }
                    ?>
            <div class="caption">
                <h3> <a href="/catalog/cat/id_cat/<?=$parent_cat['id']?>/"> <?=$parent_cat['cat_title'];?></a></h3>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

<?php } ?>

<?php
    if(empty($products) && empty($parent_cats)){
        echo '<div class="alert alert-danger">Нет товаров в каталоге</div>';

    }
    if( isset($products) && !empty($products)){
        ?>
        <div class="row">
        <?php
        foreach($products as $product){
            ?>
                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <?php
                        if(isset($product['img_prod'])) {
                            ?>
                            <img class="img-responsive" src="/media/product/small_<?= $product['img_prod'] ?>"/>
                            <?php
                        } else {
                            ?>
                            <img class="img-responsive" title="no foto" src=""/>
                            <?php
                        }
                        ?>
                        <div class="caption">
                            <h4><a href="/catalog/product/id_prod/<?=$product['id']?>/"><?=$product['title']?></a></h4>
                          <!--  <p><?/*=$product['description']*/?></p>-->
                            <div class="price-cat"><?=$product['price']?><span> руб.</span></div>
                            <p><a href="http://shop.free96.ru/catalog/product/id_prod/<?=$product['id']?>/" class="btn btn-default" role="button">Подробнее</a>
                                <a href="/cart/addtocart/?id=<?=$product['id']?>&quant=1&price=<?=$product['price']?>" class="btn btn-primary" role="button">Купить</a></p>
                        </div>
                    </div>
                </div>
        <?php } ?>
        </div>
    <?php } ?>
