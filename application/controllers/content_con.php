<?php

class Content_con extends Controller {

	function index(){
            $this->redirect(BASE_URL.'content_con/list_content');
	}
        function list_content(){
            $this->loadView("header_view.php");
            $this->loadView("list_content_view.php");		
            $this->loadView("footer_view.php");            
        }
        function post(){
            $this->loadView("header_view.php");
            $this->loadView("post_view.php");		
            $this->loadView("footer_view.php");            
            
        }
        function content($id){
            if(!empty($id)){
                switch ($id){
                    case 1:// link
                        $this->set('content',Array('JUDUL'=>'LINK', 'ISI'=>'sesuatu'));
                        $this->loadView("header_view.php");
                        $this->loadView("content_view.php");		
                        $this->loadView("footer_view.php");                            
                        break;
                    case 2: // image
                        $this->set('content',Array('JUDUL'=>'IMAGE', 'ISI'=>'sesuatu'));
                        $this->loadView("header_view.php");
                        $this->loadView("content_view.php");		
                        $this->loadView("footer_view.php");                            
                        break;
                    case 3: // video
                        $this->set('content',Array('JUDUL'=>'VIDEO', 'ISI'=>'sesuatu'));
                        $this->loadView("header_view.php");
                        $this->loadView("content_view.php");		
                        $this->loadView("footer_view.php");                            
                        break;
                }
            }else{
                
            }
        }
        function error_display($no=0){
            $error_message="";
            switch($no){
                case 0:
                    $error_message="Terdapat Kesalahan";
                    break;
                case 1:
                    $error_message="Login tidak valid";
                    
                    break;
            }
            $this->set('error_message',$error_message);
            $this->loadView("header_view.php");
            $this->loadView("error_view.php");		
            $this->loadView("footer_view.php");
        }
}
