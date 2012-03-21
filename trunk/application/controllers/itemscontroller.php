<?php

class ItemsController extends Controller {
	function view($id = null,$name = null) {
		$this->set('title',$name.' - My Todo List App');
		$this->set('todo',$this->Item->select($id));
	}
	function viewall() {
		$this->set('title','All Items - My Todo List App');
		$result = $this->_model->test("select * from contoh");
		$this->set('todo',$result);
		echo "jumlah=".count($result)."<br>";
		for($i=0;$i<count($result);$i++){
			echo $result[$i]['id']."<br>";
		}
		$this->setAction('viewall');
	}
	function something(){
		echo "Hello";
		$this->loadView("items/header.php");
		$this->loadView("items/viewall.php");
		$this->loadView("items/footer.php");
	}
	function add() {
		$todo = $_POST['todo'];
		$this->set('title','Success - My Todo List App');
		$this->set('todo',$this->Item->query('insert into items (item_name) values (\''.mysql_real_escape_string($todo).'\')'));	
	}	
	function delete($id = null) {
		$this->set('title','Success - My Todo List App');
		$this->set('todo',$this->Item->query('delete from items where id = \''.mysql_real_escape_string($id).'\''));	
	}
}
