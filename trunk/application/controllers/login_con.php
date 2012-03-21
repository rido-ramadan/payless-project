<?php

class Login_con extends Controller {

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
	function destroy(){
		session_destroy();
	}
	function validate(){
		$result = $this->_model->test("select * from user");
		$todo = $_POST['todo'];
		$this->set('display',$todo);
		$this->set('result',$result);
		$this->loadView("login_view.php");		
		
	}
	function delete($id = null) {
		$this->set('title','Success - My Todo List App');
		$this->set('todo',$this->Item->query('delete from items where id = \''.mysql_real_escape_string($id).'\''));	
	}
}
