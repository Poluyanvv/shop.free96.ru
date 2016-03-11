<?php
/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 05.03.2016
 * Time: 13:21
 */
class PageController extends IController
{
    public function index(){
        $mod = new PageModel();
        $id = (int)$this->request('id_page');
        if(!$page = $mod->getById($id)){
            throw new Exception ("Error page number");
        }
        $this->view->page = $page;
        $this->view->seo = array(
            'title' => $page['title'],
            'keywords' => $page['keywords'],
            'description' => $page['description']);
        $this->view->render('page');
    }
}