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
            $status = $_POST['status'];
            $about = $_POST['about'];
            if(strlen($username)>45 || strlen($password)>45 || strlen($confirm)>45 
                    || strlen($email)>45 || strlen($birthdate)>45 || 
                    strlen($gender)>45 || strlen($about)>45 ){
                    $this->redirect(BASE_URL.'user_con/register');
                    }
            else{
                $this->set('username', $username);
                $this->set('nama', $name);
                $this->set('password', $password);
                $this->set('confirm', $confirm);
                $this->set('email', $email);
                $this->set('birthdate', $birthdate);
                $this->set('avatar', $avatar);
                if($gender=="male") $this->set('male','');
                else if($gender=="female") $this->set('female','');
                if($status=="single") $this->set('single','');
                else if($status=="relation") $this->set('relation','');
                else if($status=="married") $this->set('married','');
                $this->set('about', $about);
                if(strlen($username)<5) $this->set('error_username','Username must be at least 5 character.');
                else{
                    if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) $this->set('error_username','Username must be alphanumeric.');
                    else{
                        if($this->checkUsername($username)==1) $this->set('error_username','Username has been taken');
                        else{
                            //if(!preg_match('/^([0-9]{4})+\-([0-9]{2})+\-([0-9]{2})$/', $name)) echo 'nama salah';
                            if(!preg_match('/^([A-Za-z0-9])+([ ])+([A-Za-z0-9])/', $name)) $this->set('error_nama','Please include your last name.');
                            else{
                                if(strlen($password)<8) $this->set('error_password','Password must be at least 8 character.');
                                else {
                                    if($password==$username) $this->set('error_password','Password cannot be same with Username');
                                    else {
                                        if(!preg_match('/^[a-zA-Z0-9]+$/',$password)) $this->set('error_password','The password is must be alphanumeric.');
                                        else{
                                            if($password=="" || $password!=$confirm) $this->set('error_confirm','The password is not match.');
                                            else{
                                            //if(!preg_match('/^([A-Za-z0-9])+([A-Za-z0-9])$/',$password)) echo 'password salah';
                                                if(!preg_match('/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/', $email)) $this->set('error_email','Wrong email format.');
                                                else {
                                                    if($this->checkEmail($email)) $this->set('error_email','Email has been taken.');
                                                    else{
                                                        if(!preg_match('/^([0-9]{4})+\-([0-9]{2})+\-([0-9]{2})$/', $birthdate)) $this->set('error_tanggal', 'Birth date must be written in YYYY-MM-DD.');
                                                        else{
                                                            list( $y, $m, $d ) = preg_split( '/[-\.\/ ]/', $birthdate );
                                                            if(!checkdate( $m, $d, $y )) $this->set('error_tanggal', 'The date is invalid');
                                                            else{
                                                                if(empty($gender) || $gender=="none") $this->set('error_gender', 'You must select a gender.');
                                                                else{
                                                                    if(empty($status) || $status=="none") $this->set('error_status', 'Actually you have a status.');
                                                                    else{
                                                                        if($avatar['type']!='image/jpg' && 
                                                                                $avatar['type']!='image/jpeg' && 
                                                                                $avatar['type']!='image/pjpeg') 
                                                                                $this->set('error_avatar', 'Please upload jpeg image.');
                                                                        else {
                                                                            if($avatar['size'] > 0 || $avatar['error'] == 0){ //check if the file is corrupt or error
                                                                                $move = move_uploaded_file($avatar['tmp_name'], 'avatar/'.$avatar['name']); //save image to the folder
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
                                                                                    $image = $avatar['name'];
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
//            $pass = $_POST['password'];
//            $newpass = $_POST['newpass'];
//            $confirm = $_POST['confirm'];
            $pass="";
            $newpass="";
            $confirm="";
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
                                    $image = $avatar['name'];
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
            $query = $this->_model->query('select * from user where EMAIL="'.$email.'"');
            if(count($query)>0){
                return 1;
            }else
                return 0;
        }
        function profile($id){
            if(empty($id)){
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
                
                $query_post = $this->getContentUser($id);
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
	function validate_login($user=-1,$pass=-1){
            if($user==-1 || $pass==-1){
                $username= $_POST['username'];
                $password= $_POST['password'];
            }
            else{
                $username= $user;
                $password= $pass;
            }
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
                $this->redirect(BASE_URL.'user_con/profile/'.$account[0]['ID_USER']);
            }else{
                $this->redirect(BASE_URL.'login_con/error_display/1');
            }
            
//            $result = $this->_model->test("select * from user");
//            $todo = $_POST['todo'];
//            $this->set('display',$todo);
//            $this->set('result',$result);
//            $this->loadView("login_view.php");		
		
	}
        function getContentUser($id_user){
            $result = Array();
            $konten = $this->_model->query('select * from konten natural join user where konten.ID_USER='.$id_user.'');
            if(count($konten)>0){
                for($i=0;$i<count($konten);$i++){
                    $sum_like = 0;
                    $sum_dislike = 0;
                    //like/dislike
                    $konten_like = $this->_model->query('select * from like_dislike where ID_KONTEN='.$konten[$i]['ID_KONTEN'].'');
                    for($j=0;$j<count($konten_like);$j++){
                            if($konten_like[$j]['STATUS']=="LIKE") $sum_like+=1;
                            if($konten_like[$j]['STATUS']=="DISLIKE") $sum_dislike+=1;
                    }
                    //echo "like=".$sum_like."<br>";
                    //echo "dislike=".$sum_dislike."<br>";

                    //komentar
                    $komen = $this->_model->query('select * from komentar where ID_KONTEN='.$konten[$i]['ID_KONTEN'].'');
                    $konten[$i]['KOMENTAR'] = $komen;

                    $konten[$i]['LIKE'] = $sum_like-$sum_dislike;
                    // tag
                    $tag = $this->_model->query('select * from konten_tag natural join tag where konten_tag.ID_KONTEN="'.$konten[$i]['ID_KONTEN'].'"');
                    $konten[$i]['TAG'] = $tag;
                    
                }
                $result = $konten;
            }
            return $result;
        }
        function ajax_check_username($username){
            $result = $this->_model->query('select * from user where USERNAME="'.$username.'"');
            if(count($result)>0) echo 1;
            else echo 0;
        }
        function ajax_validate_login($username, $pass){
            $result = $this->_model->query('select * from user where USERNAME="'.$username.'" AND PASSWORD="'.$pass.'"');
            if(count($result)>0) echo $result[0]['ID_USER'];
            else echo -1;
        }
        function ajax_check_availability_username($username){
            $result = $this->_model->query('select * from user where USERNAME="'.$username.'"');
            if(count($result)>0) echo 1;
            else echo 0;
        }
        function ajax_check_availability_email($email){
            $result = $this->_model->query('select * from user where EMAIL="'.$email.'"');
            if(count($result)>0) echo 1;
            else echo 0;
        }
        function error_display($no=0){
            $error_message="";
            switch($no){
                case 0:
                    $error_message="Something Wrong...";
                    break;
                case 1:
                    $error_message="Login Invalid!";
                    
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
