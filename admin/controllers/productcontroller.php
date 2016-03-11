<?php

/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 03.03.2016
 * Time: 20:56
 */
class ProductController extends IAdminController
{

    public function index() {

        $mod = new ProductModel();
        $mod_cat = new CatModel();

        $id_cat = $this->request('id_cat');
        $this->view->cat = $mod_cat->getCatByCatId($id_cat);
        $this->view->products = $mod->getProductByCatId($id_cat);
        $this->view->render('product');
    }

    public function add(){
        $this->view->cats = CatModel::getAll();
        //$this->view->cat_edit['id_parent_cat'] = $this->request('id_parent_cat');
        $this->view->render('product_add');
    }

    public function save(){
        $data = $this->request('form');
        if($id = $data['edit_id']){
            ProductModel::updateProduct($data, $data['edit_id']);
        } else {
            $id = ProductModel::saveProduct($data);
        }
        if($data['del_img']){
            ProductModel::insertImg($id);
            // TODO: Настроить возможность удаления катринки (физического файла)
        }

        if(is_uploaded_file($_FILES['upload_img']['tmp_name'])) {
            ProductModel::insertImg($id,ProductModel::uploadImg());
        }
        header('Location: /admin/product/?id_cat='.$data['id_cat']);
    }

    public function edit(){
        $this->view->cats = CatModel::getAll();
        $this->view->product_edit = ProductModel::getProductById($this->request('edit_id'));
        $this->view->render('product_add');

    }
    public function delete(){
        ProductModel::deleteProduct($this->request('id'));
        header('Location:' . $_SERVER['HTTP_REFERER']);
    }

}