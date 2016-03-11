<!DOCTYPE html>
<html>
<head>
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
<script type="text/javascript" src="/media-templates/js/tinymce/js/tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: "textarea#tinymce",
            theme: "modern",
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
            ],
            content_css: "css/content.css",
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
            style_formats: [
                {title: 'Bold text', inline: 'b'},
                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                {title: 'Example 1', inline: 'span', classes: 'example1'},
                {title: 'Example 2', inline: 'span', classes: 'example2'},
                {title: 'Table styles'},
                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
            ]
        });
    </script>

<?/*=$this->block('blocks/head');*/?>
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
            <a class="navbar-brand" href="/admin/">Панель управления</a>
        </div>
        <div class="navbar-collapse collapse ">
            <ul class="nav navbar-nav hidden-lg hidden-md hidden-sm" >
                <li><a href="/admin/">Статистика</a></li>
                <li><a href="/admin/orders/" >Заказы</a></li>
                <li><a href="/admin/cat/" >Каталог товаров</a></li>
                <li><a href="/admin/page/" >Текстовые страницы</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a title="Просмотр сайта" href="/" target="_blank">Просмотр сайта</a></li>
                <li><a title="Выйти" href="/admin/security/logout/"><span class="glyphicon glyphicon-log-out"></span></a></li>

            </ul>
        </div>

    </div>
</div>
<div class="container">
    <div class="row">
         <div class="col-sm-3 col-md-2 sidebar hidden-xs">
             <?=$this->block('menu_left');?>
         </div>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <?php $this->content();?>
    </div>
    </div>
</div>
</body>
</html>