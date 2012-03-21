<?php

class Home_con extends Controller {
    function index(){
        $this->set('display','Success - My Todo List App');
        $this->loadView("header_view.php");
        $this->loadView("home_view.php");
        $this->loadView("footer_view.php");
    }
}
