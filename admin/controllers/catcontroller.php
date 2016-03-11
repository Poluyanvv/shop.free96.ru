<?php

/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 03.03.2016
 * Time: 20:36
 */
class CatController extends IAdminController
{

    public function index() {

        $mod = new CatModel();
        if(!$parent_cat = $this->request('parent_cat')){
            $parent_cat = 0;
        } else{
            $this->view->cat = CatModel::getCatByCatId($parent_cat);
        }
        //$this->view->cat_id = $parent_cat;
        $this->view->cats = $mod->getParentCat($parent_cat);
        $this->view->render('cat');
    }
    public function add(){
        $this->view->cats = CatModel::getAll();
        //$this->view->cat_edit['id_parent_cat'] = $this->request('id_parent_cat');
        $this->view->render('cat_add');
    }

    public function save(){
        $data = $this->request('form');
        if($id = $data['edit_id']){
            CatModel::updateCat($data, $data['edit_id']);
        } else {
            $id = CatModel::saveCat($data);
        }
        if($data['del_img']){
            CatModel::insertImg($id);
            // TODO: Настроить возможность удаления катринки (физического файла)
        }
        if(is_uploaded_file($_FILES['upload_img']['tmp_name'])) {
            CatModel::insertImg($id,CatModel::uploadImg());
        }

        header('Location: /admin/cat/?parent_cat='.$data['id_parent_cat']);
    }
    public function edit(){
        $this->view->cats = CatModel::getAll();
        $this->view->cat_edit = CatModel::getCatByCatId($this->request('id_cat'));
        $this->view->render('cat_add');

    }

    public function delete(){
        //$data = CatModel::getCatByCatId($this->request('id_cat'));
        CatModel::deleteCat($this->request('id_cat'));
        header('Location:' . $_SERVER['HTTP_REFERER']);
        //header('Location: /admin/cat/?parent_cat='.$data['id_parent_cat']);


    }


}