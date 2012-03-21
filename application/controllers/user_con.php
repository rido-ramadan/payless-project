<?php

class User_con extends Controller {

	function index(){
		$this->set('display','Success - My Todo List App');
		$this->loadView("login_view.php");
	}
	function login($something=0){
		session_start();
		if(isset($_SESSION['views']))
			$_SESSION['views'] = $_SESSION['views']+ 1;
		else
			$_SESSION['views'] = 1;
		echo "views = ". $_SESSION['views']."<br>"; 
		
		if($_SESSION['views']>=5) $this->destroy();

		echo "ini something=".$something."<br>";
		$this->set('display','Berhasil pindah');
		$this->loadView("login_view.php");		
	}
        function logout(){
            $this->destroy();
            $this->redirect(BASE_URL."home_con/");
        }
	function destroy(){
            session_start();
            session_destroy();
	}
        function redirect($url){
                header( 'Location: '.$url ) ;            
        }
	function validate(){
            $username= $_POST['username'];
            $password= $_POST['password'];
            if(strlen($username)>45 || strlen($password)>45){
                $this->redirect(BASE_URL.'login_con/error_display/0');
            }
            $account = $this->_model->test('select * from user where USERNAME="'.$username.'" and PASSWORD="'.$password.'"');
            
            //echo $username."<br>";
            //echo $password."<br>";
            if(count($account)==1){
                
                $this->set('user',$account[0]);
                $this->loadView("header_view.php");
                $this->loadView("home_view.php");		
                $this->loadView("footer_view.php");
            }else{
                $this->error_display(1);
            }
            
//            $result = $this->_model->test("select * from user");
//            $todo = $_POST['todo'];
//            $this->set('display',$todo);
//            $this->set('result',$result);
//            $this->loadView("login_view.php");		
		
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
	function delete($id = null) {
		$this->set('title','Success - My Todo List App');
		$this->set('todo',$this->Item->query('delete from items where id = \''.mysql_real_escape_string($id).'\''));	
	}
}
