<?php

/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 05.03.2016
 * Time: 22:12
 */
class PageController extends IAdminController
{
    public function index(){
        $mod = new PageModel();
        $this->view->pages = $mod->getAllPages();
        $this->view->render('page');
    }
    public function edit(){
        $this->view->page_edit = PageModel::getPageById($this->request('id_page'));
        $this->view->render('page_add');

    }
    public function save(){
        $data = $this->request('form');
        PageModel::updatePage($data, $data['edit_id']);
        header('Location: /admin/page/');
    }
    public function delete(){
        PageModel::deletePage($this->request('id_page'));
        header('Location:' . $_SERVER['HTTP_REFERER']);
    }

}
