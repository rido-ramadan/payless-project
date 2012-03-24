<?php

class User_con extends Controller {

	function index(){
		$this->set('display','Success - My Todo List App');
		$this->loadView("login_view.php");
	}
	function login($something=0){
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
            $name = $_POST['name'];
            $password = $_POST['password'];
            $confirm = $_POST['confirm'];
            $email = $_POST['email'];
            $birthdate = $_POST['birthdate'];
            $avatar = $_FILES['avatar'];
            $gender = $_POST['gender'];
            $about = $_POST['about'];
            if(strlen($username)>45 || strlen($password)>45 || strlen($confirm)>45 
                    || strlen($email)>45 || strlen($birthdate)>45 || 
                    strlen($gender)>45 || strlen($about)>45 ){
                    $this->redirect(BASE_URL.'user_con/register');
                    }
            else{
                if(strlen($username)<5) echo 'username kurang dari 5';
                else{
                    if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) echo 'username format salah';
                    else{
                        if($this->checkUsername($username)==1) echo 'username sudah ada';
                        else{
                            //if(!preg_match('/^([0-9]{4})+\-([0-9]{2})+\-([0-9]{2})$/', $name)) echo 'nama salah';
                            if(!preg_match('/^([A-Za-z0-9])+([ ])+([A-Za-z0-9])/', $name)) echo 'nama salah';
                            else{
                                if(strlen($password)<8) echo 'password kurang dari 8';
                                else {
                                    if($password==$username) echo 'password tidak boleh sama dengan username';
                                    else {
                                        if($password=="" || $password!=$confirm) echo 'password harus sama dengan confirm password';
                                        else{
                                            //if(!preg_match('/^([A-Za-z0-9])+([A-Za-z0-9])$/',$password)) echo 'password salah';
                                            if(!preg_match('/^[a-zA-Z0-9]+$/',$password)) echo 'password salah';
                                            else{
                                                if(!preg_match('/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/', $email)) echo 'email salah';
                                                else {
                                                    if($this->checkEmail($email)) echo 'email sudah ada';
                                                    else{
                                                        if(!preg_match('/^([0-9]{4})+\-([0-9]{2})+\-([0-9]{2})$/', $birthdate)) echo 'tanggal salah';
                                                        else{
                                                            if(empty($gender) || $gender=="none") echo 'gender kosong';
                                                            else{
                                                                if($avatar['type']!='image/jpg' && 
                                                                        $avatar['type']!='image/jpeg' && 
                                                                        $avatar['type']!='image/pjpeg') 
                                                                        echo 'format gambar salah';
                                                                else {
                                                                    if($avatar['size'] > 0 || $avatar['error'] == 0){ //check if the file is corrupt or error
                                                                        $move = move_uploaded_file($avatar['tmp_name'], 'upload/'.$avatar['name']); //save image to the folder
                                                                        if($move){
    //                                                                        $data = Array(
    //                                                                            'USERNAME'=>$username,
    //                                                                            'PASSWORD'=> md5($password),
    //                                                                            'NANA'=> $name,
    //                                                                            'TGL_LAHIR'=> $birthdate,
    //                                                                            'EMAIL'=> $email,
    //                                                                            'AVATAR'=>$avatar[BASE_URL.'upload/'.$avatar['name']],
    //                                                                            'GENDER'=>$gender,
    //                                                                            'ABOUT_ME'=>$about,
    //                                                                            'STATUS'=>'SINGLE'
    //                                                                        );
                                                                            $image = BASE_URL.'upload/'.$avatar['name'];
                                                                            $gender = ($gender=="male")? "LAKI" : "PEREMPUAN";
                                                                            $insert = 'insert into user (USERNAME, PASSWORD, NAMA, TGL_LAHIR, EMAIL, AVATAR, GENDER, ABOUT_ME, STATUS) 
                                                                                values ("'.$username.'", "'.md5($password).'",
                                                                                    "'.$name.'", "'.$birthdate.'",
                                                                                        "'.$email.'", "'.$image.'",
                                                                                            "'.$gender.'", "'.$about.'",
                                                                                                "SINGLE"
                                                                                    )';
                                                                            $this->_model->query($insert);
                                                                            $id = $this->_model->query('select * from user where USERNAME="'.$username.'"');
                                                                            if(count($id)>0){ // ada
                                                                                $data = Array (
                                                                                    'login' => true,
                                                                                    'nama' => $name,
                                                                                    'id' =>$id[0]['ID_USER'],
                                                                                    'avatar' =>$image
                                                                                        );
                                                                                $_SESSION = $data;
                                                                                $this->redirect(BASE_URL.'user_con/profile/'.$id[0]['ID_USER']);
                                                                            }else{

                                                                            }

                                                                        }else{
                                                                            echo 'file error';
                                                                        }
                                                                    }
                                                                }
                                                                //if($_FILES['avatar']['extension'])
                                                                //if(ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG") {
                                                                // $valid = true;
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                $this->loadView("header_view.php");
                $this->loadView("register_view.php");		
                $this->loadView("footer_view.php"); 
            }
    //            
//            if(strlen($username)>45 || strlen($password)>45 || strlen($confirm)>45 
//                    || strlen($email)>45 || strlen($birthdate)>45 || 
//                    strlen($gender)>45 || strlen($about)>45 ){
//                    $this->redirect(BASE_URL.'user_con/register');
//                    }
//            else{
//                //$this->redirect(BASE_URL.'home_con');
//                $query = $this->_model->query('select * from user where USERNAME="'.$username.'" OR EMAIL="'.$email.'"');
//                if(count($query)>0){
//                    echo 'username atau email sudah ada';
//                }else{
//                    $data = Array(
//                        'USERNAME' => 
//                    )
//                }
//            }
            
        }
        function edit_user(){
            if(empty($_SESSION['login'])){
                $this->redirect(BASE_URL.'user_con/error_display/0');
            }
            $id = $_SESSION['id'];
            $pass = $_POST['password'];
            $newpass = $_POST['newpass'];
            $confirm = $_POST['confirm'];
            $email = $_POST['email'];
            $gender = $_POST['gender'];
            $status = $_POST['status'];
            $avatar = $_FILES['avatar'];
            $about = $_POST['about'];
            $gender = $gender=="male" ? "LAKI" : "PEREMPUAN";
            
            if(strlen($pass)>45 || strlen($newpass)>45 || strlen($confirm)>45 
                    || strlen($email)>45 || strlen($about)>100 ){
                    $this->redirect(BASE_URL.'user_con/register');
                    }
            else{
                if(empty($pass)&&empty($newpass)&&empty($confirm)){
                    if(!empty($avatar['name'])) {
                        if($avatar['type']!='image/jpg' && 
                                $avatar['type']!='image/jpeg' && 
                                $avatar['type']!='image/pjpeg') 
                                echo 'format gambar salah';
                        else {                            
                            if($avatar['size'] > 0 || $avatar['error'] == 0){ //check if the file is corrupt or error
                                $move = move_uploaded_file($avatar['tmp_name'], 'avatar/'.$avatar['name']); //save image to the folder
                                if($move){
                                    $image = BASE_URL.'avatar/'.$avatar['name'];
                                    $update = 'update user set EMAIL="'.$email.'", AVATAR="'.$image.'", GENDER="'.$gender.'", ABOUT_ME="'.$about.'"
                                        where ID_USER="'.$id.'"';
                                    $this->_model->query($update);
                                    $this->redirect(BASE_URL.'user_con/profile/'.$id);                        
                                }else{
                                    echo 'gambar gagal diupload';
                                }
                            }else{
                                echo 'gambar error ';                                
                            }
                        }
                    }else{
                        $update = 'update user set EMAIL="'.$email.'", GENDER="'.$gender.'", ABOUT_ME="'.$about.'"
                            where ID_USER="'.$id.'"';
                        $this->_model->query($update);
                        $this->redirect(BASE_URL.'user_con/profile/'.$id);
                    }
                }
            }
            
        }
        function checkUsername($username){
            $query = $this->_model->query('select * from user where USERNAME="'.$username.'"');
            if(count($query)>0){
                return 1;
            }else
                return 0;
        }
        function checkEmail($email){
            $query = $this->_model->query('select * from user where USERNAME="'.$email.'"');
            if(count($query)>0){
                return 1;
            }else
                return 0;
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
                    'id' =>$account[0]['ID_USER'],
                    'avatar' =>$account[0]['AVATAR']
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
