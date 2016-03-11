<?php
/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 23.02.2016
 * Time: 13:14
 */
class CatalogController extends IController
{
    public function index(){
        $mod = new CatalogModel();
        $this->view->cat = array('cat_title' => 'Каталог товаров');

        $this->view->seo = array(
            'title' =>$this->view->cat['cat_title'],
            'keywords' =>$this->view->cat['cat_title'],
            'description' =>$this->view->cat['cat_title'] );

        $this->view->parent_cats = $mod->getParentCat();
        $output = $this->view->render('catalog');
    }
    public function cat (){
        $mod = new CatalogModel();
        $cat_id = (int)$this->request('id_cat');
        if(!$this->view->cat = $mod->getCatByCatId($cat_id)){
            throw new Exception ("Bad category number");
        }

        $this->view->seo = array(
            'title' =>$this->view->cat['cat_title'],
            'keywords' =>$this->view->cat['cat_title'],
            'description' =>$this->view->cat['cat_title'] );

        $this->view->parent_cats = $mod->getParentCat($cat_id);
        $this->view->products = $mod->getProductByCatId($cat_id);
        $this->view->render('catalog');

    }
    public function product (){
        $mod = new CatalogModel();
        $product_id = (int)$this->request('id_prod');
        if(!$this->view->product = $mod->getProductById($product_id)){
            throw new Exception ("Bad product number");
        }
        $this->view->seo = array(
            'title' =>$this->view->product['title'],
            'keywords' =>$this->view->product['title'],
            'description' =>$this->view->product['title'] );
        $this->view->render($this->action);
    }
}