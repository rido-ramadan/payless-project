<?php

class Template {

    protected $variables = array();
    protected $_controller;
    protected $_action = Array();

    //function __construct($controller,$action) {
    function __construct($controller) {
        $this->_controller = $controller;
        //$this->_action[0] = $action;
    }

    /** Set Variables * */
    function set($name, $value) {
        $this->variables[$name] = $value;
    }

    function loadView($fileName) {
        //echo "load=".$fileName."<br>";
        $this->_action[count($this->_action)] = $fileName;
    }

    function setAction($name) {
        echo "ngisi=" . $name . "<br>";
        echo "length=" . count($this->_action) . "<br>";
        $this->_action[0] = $name;
        echo "isi=" . $this->_action[0] . "<br>";
    }

    /** Display Template * */
    function renderView() {
        //echo count($this->_action);
        extract($this->variables);
        for ($i = 0; $i < count($this->_action); $i++) {
            if (file_exists(ROOT . DS . 'application' . DS . 'views' . DS . $this->_action[$i])) {
                include (ROOT . DS . 'application' . DS . 'views' . DS . $this->_action[$i]);
            }
        }
    }

    function render() {
        echo "isi render=" . $this->_action[0] . "<br>";

        extract($this->variables);

        if (file_exists(ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . 'header.php')) {
            echo "A";
            include (ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . 'header.php');
        } else {
            echo "A";
            include (ROOT . DS . 'application' . DS . 'views' . DS . 'header.php');
        }

        echo "B";
        include (ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . $this->_action[0] . '.php');
        echo "B";

        if (file_exists(ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . 'footer.php')) {
            echo "A";
            include (ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . 'footer.php');
        } else {
            echo "A";
            include (ROOT . DS . 'application' . DS . 'views' . DS . 'footer.php');
        }
    }

}
