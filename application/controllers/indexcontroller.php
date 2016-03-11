<?php
class IndexController extends IController {
	public function index() {
        $mod = new CatalogModel();
        $this->view->products = $mod->getProductByShowId();
        $this->view->render($this->action);
	}
}
