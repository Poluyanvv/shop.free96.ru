<?php
/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 06.03.2016
 * Time: 22:08
 */
?>
<div class="jumbotron">
    <h1>Акция!</h1>
    <p>Кто возьмет билетов пачку, тот получит водокачку!</p>
    <p><a class="btn btn-primary btn-lg" role="button">Подробнее</a></p>
</div>
<?php
if( isset($products) && !empty($products)){
?>
    <h2>Популярные товары</h2>
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

<div style="text-align: justify">
    <p>Shop.by — интернет-магазин гаджетов, созданный гиками для людей.</p>
    <p>Мы не стремимся «нагреться» на покупателях и ржаветь на задворках интернета. Мы действительно влюблены в электронику, следим за ее новинками и рады делиться всем самым интересным, о чем узнали.</p>
    <p>Для eShop.by мы выбрали гаджеты, которые приводят в восторг. В том числе и нас. Про каждый товар хочется кричать: «Представляете, что бывает!» Мы намеренно не идем по пути расширения ассортимента, отказываясь от устройств, которые не несут в себе новой идеи или ценности.</p>
    <p>Мы — те самые ребята, что вызвали переполох среди интернет-магазинов гаджетов, начав открыто освещать процесс создания бизнес Madrobots в прямом эфире. Так мы нажили себе массу подражателей, открыли глаза на мир «интернет вещей» десяткам тысяч людей, но и заключили много интересных партнерств.</p>

</div>