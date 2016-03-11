<!DOCTYPE HTML>
<html lang="ru">
<head>
    <title><?=$seo['title']?></title>
    <meta name="description" content="<?=$seo['description']?>" />
    <meta name="keywords" content="<?=$seo['keywords']?>" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="stylesheet" href="/media-templates/css/main.css" type="text/css" media="screen" />-->
    <link href="/media-templates/bootstrap3/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="/media-templates/bootstrap3/css/bootstrap-theme.css" rel="stylesheet" media="screen">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="/media-templates/bootstrap3/js/bootstrap.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Открыть навигацию</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Shop.by</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Каталог <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <?php if (isset($catalog_main) && count($catalog_main)>0){?>
                            <?php foreach ($catalog_main as $cm){?>
                                <li><a  href="/catalog/cat/id_cat/<?=$cm['id']?>/" ><?=$cm['cat_title']?></a></li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </li>
                <li><a href="/page/?id_page=1">О нас</a></li>
                <li><a href="/page/?id_page=2">Доставка</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/cart/"><span class="glyphicon glyphicon-shopping-cart" ></span>    <span class="badge "><?=$cart_count?></span></a></li>
            </ul>
        </div>
    </div>
</div>
<div class="container">
    <?php $this->content(); ?>
</div>
</body>
</html>