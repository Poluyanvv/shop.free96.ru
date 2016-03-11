<?php
/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 29.02.2016
 * Time: 13:12
 */
if (isset($product) && !empty($product)){
    ?>
    <div class="page-header">
        <h1><?=$product['title']?></h1>
    </div>


        <div class="thumbnail">
            <div class="row">
            <div class="col-sm-6 col-md-6">
                <?php
                if(isset($product['img_prod'])) {
                    ?>
                    <img class="img-responsive" src="/media/product/<?=$product['img_prod'] ?>"/>
                    <?php
                } else {
                    ?>
                    <img class="img-responsive" title="no foto" src=""/>
                    <?php
                }
                ?>
            </div>
            <div class="col-sm-6 col-md-6">
                <div class="caption">
                    <p><?=$product['description']?></p>
                    <div class="price-cat"><?=$product['price']?><span> руб.</span></div>
                    <p><a href="/cart/addtocart/?id=<?=$product['id']?>&quant=1&price=<?=$product['price']?>" class="btn btn-primary" role="button">Купить</a></p>
                </div>
            </div>
        </div>
        </div>

<?php } ?>