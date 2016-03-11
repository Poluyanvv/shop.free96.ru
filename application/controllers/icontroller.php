<?php
class IController extends Controller{
    public $seo;
    public function beforeAction ()
    {

        parent::beforeAction();
        $this->view->catalog_main = CatalogModel::getParentCat();
        if (isset($_SESSION['shop_cart']) && !empty($_SESSION['shop_cart'])) {
            $this->view->cart_count = count($_SESSION['shop_cart']);
        } else {
            $this->view->cart_count = 0;
        }
        $this->view->seo = array('title' => 'Интернет-магазин Shop.by', 'keywords' => 'Интернет-магазин Shop.by', 'description' => 'Интернет-магазин Shop.by');
    }
}
