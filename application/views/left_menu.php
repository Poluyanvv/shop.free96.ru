<div class="layout">
    <h3>Меню</h3>
    <ul id="menu" class="menu-list" >
        <?php if (isset($catalog_main) && count($catalog_main)>0){?>
            <?php foreach ($catalog_main as $cm){?>
                <li class="menu_li">
                    <a class="menu_a" href="/catalog/cat/id_cat/<?=$cm['id']?>/" ><?=$cm['cat_title']?></a>
                </li>
            <?php } ?>
        <?php } ?>
    </ul>
</div>