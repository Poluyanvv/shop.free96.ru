<?php
class PatchController {
	private $_controller, $_action, $_params = array();
	private $defaultController = 'IndexController';
	private $defaultAction = 'index';
	private $request_uri;

	public function __construct($request_uri = null) {
        if($request_uri){
            $this->request_uri = $request_uri;
        } else{
            $this->request_uri = $_SERVER['REQUEST_URI'];
        }
	}
	private function patchRequestUri($request_uri){

        $basePath = Application::getHttpRoot();
        $request_uri = preg_replace('#^'.$basePath.'#','',$request_uri);
        $request_uri = preg_replace('/\?.*?$/','',$request_uri);
		$splits = explode('/', trim($request_uri,'/'));

		//Какой сontroller использовать?
		$this->_controller = !empty($splits[0]) ? ucfirst($splits[0]).'Controller' : $this->defaultController;

		//Какой action использовать?
		$this->_action = !empty($splits[1]) ? $splits[1] : $this->defaultAction;
		//Есть ли параметры и их значения?
		if(!empty($splits[2])){
            for($i=2; $i<count($splits); $i=$i+2){
                if(!empty($splits[$i+1])) {
                    $params[strtolower(strip_tags(trim($splits[$i])))] = strtolower(strip_tags(trim($splits[$i+1])));
                }
            }
            if(!empty($params)) {
                $this->_params = $params;
            }
		}
	}

	public function route() {
        $this->patchRequestUri($this->request_uri);
		if(class_exists($this->_controller)) {
			$rc = new ReflectionClass($this->_controller);
				if($rc->hasMethod($this->_action)) {
					$class = $rc->newInstance();
                    $action = $rc->getMethod($this->_action);
                    $class->action = $this->_action;
                    $class->view = new View(Application::getBaseTemplate());
                    $class->request = new Request($this->_params);
                    if($class->_before_action = $rc->getMethod('beforeAction')){
                        $class->_before_action->invoke($class);
                    }
                    $action->invoke($class);
				} else {
					throw new Exception("Error Action");
				}
		} else {
			throw new Exception("Error Controller");
		}
	}
}