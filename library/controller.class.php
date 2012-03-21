<?php
class Controller {

	protected $_model;
	protected $_controller;
	protected $_action;
	protected $_template;

	function __construct($model,$controller) {
            session_start();
            $this->_controller = $controller;
            //$this->_action = $action;
            //$this->_model = $model;
            //$this->$model = new $model;
            $this->_model = new Model();
            $this->_template = new Template($controller);
            //$this->_template =& new Template($controller,$action);
	}
        function redirect($url){
                header( 'Location: '.$url ) ;            
        }
	function destroy(){
            session_destroy();
	}
	function set($name,$value) {
            $this->_template->set($name,$value);
	}
	function loadView($fileName){
            $this->_template->loadView($fileName);	
	}
	
	function setAction($name) {
		$this->_template->setAction($name);
	}

	function __destruct() {
		//echo "con";
			$this->_template->renderView();
			//$this->_template->render();
	}

}
