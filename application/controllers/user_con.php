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
        function register(){
            $this->loadView("header_view.php");
            $this->loadView("register_view.php");		
            $this->loadView("footer_view.php");            
        }
        function validate_register(){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirm = $_POST['confirm'];
            $email = $_POST['email'];
            $birthdate = $_POST['birthdate'];
            //$avatar = $_POST['avatar'];
            $gender = $_POST['gender'];
            $about = $_POST['about'];
            $this->redirect(BASE_URL.'home_con');
            
        }
        function profile($id){
            if(empty($id) || empty($_SESSION['login'])){
                $this->redirect(BASE_URL.'user_con/error_display/0');
            }
            $user = $this->_model->query('select * from user where ID_USER='.$id.'');
            if(count($user)>0){
                if($user[0]['GENDER']=="LAKI")
                    $user[0]['GENDER'] = "Male";
                else
                    $user[0]['GENDER'] = "Female";
                $query_komentar = $this->_model->query('select * from komentar where ID_USER='.$id.'');
                $komentar = count($query_komentar);
                $query_post = $this->_model->query('select * from konten where ID_USER='.$id.'');
                $post = count($query_post);
                $user[0]['KOMENTAR'] = $komentar;
                $user[0]['POST'] = $post;
                if($post>0){
                    $user[0]['KONTEN']= $query_post;
                }
                $query_achv = $this->_model->query('select * from user_achievement natural join achievement where ID_USER='.$id.'');
                if(count($query_achv)>0){
                    $user[0]['ACHIEVEMENT'] = $query_achv;
                }

                $this->set('user', $user[0]);
            }
            $this->loadView("header_view.php");
            $this->loadView("profile_view.php");		
            $this->loadView("footer_view.php");
            
        }
        function logout(){
            $this->destroy();
            $this->redirect(BASE_URL."home_con/");
        }
	function validate_login(){
            $username= $_POST['username'];
            $password= $_POST['password'];
            if(strlen($username)>45 || strlen($password)>45){
                $this->redirect(BASE_URL.'login_con/error_display/0');
            }
            $account = $this->_model->test('select * from user where USERNAME="'.$username.'" and PASSWORD="'.$password.'"');
            
            //echo $username."<br>";
            //echo $password."<br>";
            if(count($account)==1){
                $data = Array (
                    'login' => true,
                    'nama' => $account[0]['NAMA'],
                    'id' =>$account[0]['ID_USER']
                        );
                $_SESSION = $data;
                //echo $_SESSION['nama'];
                //$this->set('user',$account[0]);
                $this->redirect(BASE_URL.'home_con/');
            }else{
                $this->redirect(BASE_URL.'login_con/error_display/1');
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
