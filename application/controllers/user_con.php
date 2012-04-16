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
                if($status=="single") {$this->set('single',''); $status="SINGLE";}
                else if($status=="relation") {$this->set('relation','');$status="IN RELATIONSHIP";}
                else if($status=="married") {$this->set('married','');$status="MARRIED";}
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
                                                                                $this->set('error_avatar', 'Please upload jpeg or jpg image.');
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
                                                                                                        "'.$status.'"
                                                                                            )';
                                                                                    $this->_model->query($insert);
                                                                                    $id = $this->_model->query('select * from user where USERNAME="'.$username.'"');
                                                                                    if(count($id)>0){ // ada
                                                                                        $data = Array (
                                                                                            'login' => true,
                                                                                            'username' => $username,
                                                                                            'nama' => $name,
                                                                                            'id' =>$id[0]['ID_USER'],
                                                                                            'avatar' =>$image
                                                                                                );
                                                                                        $_SESSION = $data;
                                                                                        $this->redirect(BASE_URL.'user_con/profile/'.$id[0]['ID_USER'].'/1');
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
            $email = $_POST['email'];
            $gender = $_POST['gender'];
            $status = $_POST['status'];
            $avatar = $_FILES['avatar'];
            $about = $_POST['about'];
            $gender = $gender=="male" ? "LAKI" : "PEREMPUAN";
            
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
                            $update = 'update user set EMAIL="'.$email.'", AVATAR="'.$image.'", STATUS="'.$status.'", GENDER="'.$gender.'", ABOUT_ME="'.$about.'"
                                where ID_USER="'.$id.'"';
                            $this->_model->query($update);
                            
                            $check = $this->_model->query('select * from narcism where ID_USER='.$_SESSION['id'].'');
                            if(count($check)>0){
                                $update = 'update narcism set CHANGE_PICTURE="'.($check[0]['CHANGE_PICTURE']+1).'"
                                    where ID_USER="'.$_SESSION['id'].'"';
                                $this->_model->query($update);                                
                            }else{
                                $insert = 'insert into narcism (ID_USER, CHANGE_PICTURE) 
                                    values ('.$_SESSION['id'].', "1"
                                        )';
                                $this->_model->query($insert);                                
                            }
                            $this->redirect(BASE_URL.'user_con/profile/'.$id);                        
                        }else{
                            echo 'gambar gagal diupload';
                        }
                    }else{
                        echo 'gambar error ';                                
                    }
                }
            }else{
                $update = 'update user set EMAIL="'.$email.'", STATUS="'.$status.'", GENDER="'.$gender.'", ABOUT_ME="'.$about.'"
                    where ID_USER="'.$id.'"';
                $this->_model->query($update);
                $this->redirect(BASE_URL.'user_con/profile/'.$id.'/1');
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
        function profile($id, $achieve=-1){
            if(!empty($_SESSION['login'])){
                $message = $this->_model->query('select * from message inner join user on message.ID_FROM=user.ID_USER where ID_TO='.$_SESSION['id'].'');
                if(count($message)>0){
                    $this->set('message_box', $message);
                }
                $achievement = $this->_model->query('select * from user_achievement natural join achievement where ID_USER='.$_SESSION['id'].'');            
                if(count($achievement)>0){
                    $this->set('list_achievement', $achievement);
                }
            }            
            if(empty($id)){
                $this->redirect(BASE_URL.'user_con/error_display/0');
            }
            if($achieve!=-1){
                $this->checkAlay();
                $this->checkNarcism();
                $this->checkStatus();
                $this->checkThreeAchievement();
                $this->checkUltimate();                
            }
            $user = $this->_model->query('select * from user where ID_USER='.$id.'');
            if(count($user)>0){
                if($user[0]['GENDER']=="LAKI")
                    $user[0]['GENDER'] = "Male";
                else if($user[0]['GENDER']=="PEREMPUAN")
                    $user[0]['GENDER'] = "Female";
                else
                    $user[0]['GENDER'] = "none";
                if($user[0]['STATUS'] == "SINGLE")
                    $user[0]['STATUS'] = "Single";
                else if($user[0]['STATUS'] == "IN RELATIONSHIP")
                    $user[0]['STATUS'] = "In Relationship";
                else if($user[0]['STATUS'] == "MARRIED")
                    $user[0]['STATUS'] = "Married";
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
            $account = $this->_model->test('select * from user where USERNAME="'.$username.'" and PASSWORD="'.md5($password).'"');
            
            //echo $username."<br>";
            //echo $password."<br>";
            if(count($account)==1){
                $data = Array (
                    'login' => true,
                    'username' => $account[0]['USERNAME'],
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

                    if(!empty($_SESSION['id'])){
                        $user_like = $this->_model->query('select * from like_dislike where ID_KONTEN='.$konten[$i]['ID_KONTEN'].' AND ID_USER='.$_SESSION['id'].'');
                        if(count($user_like)>0){
                        //echo 'asd';
                            $konten[$i]['STATUS_USER']=$user_like[0]['STATUS'];
                        }
                    }
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
            if(strlen($username)>45 || strlen($pass)>45){
                echo -1;
            }else{
                $result = $this->_model->query('select * from user where USERNAME="'.$username.'" AND PASSWORD="'.md5($pass).'"');
                if(count($result)>0) echo $result[0]['ID_USER'];
                else echo -1;
            }
        }
        function ajax_check_availability_username($username){
            $result = $this->_model->query('select * from user where USERNAME="'.$username.'"');
            if(count($result)>0) {
                echo 1;
            }
            else echo 0;
        }
        function ajax_check_availability_email($email){
            $result = $this->_model->query('select * from user where EMAIL="'.$email.'"');
            if(count($result)>0) {
                if(!empty($_SESSION['login'])){
                    $result = $this->_model->query('select * from user where EMAIL="'.$email.'" AND ID_USER='.$_SESSION['id'].'');                    
                    if(count($result)>0) {
                        echo 0;                        
                    }else{
                        echo 1;                
                    }                    
                }else echo 1;
            }
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
        
        function ajax_scrolling_profile($index, $id_user){
            $response = "";
            $content = $this->getContentUser($id_user);
            //echo count($konten).':'.$index;
            if(count($content)<$index-3){
                echo -1;
            }else{
                for($i=$index-3;$i<$index;$i++){
                        if(!empty($content[$i])){
                                    echo '
                                <li><div class="top-post"">
                                     <div class="top-';
                                    if($user['KONTEN'][$i]['ID_TYPE']==1) echo 'link';
                                        else if($content[$i]['ID_TYPE']==2) echo 'image';
                                        else if($content[$i][$i]['ID_TYPE']==3) echo 'video';
                                    echo '">
                                        <div class="contenttitle"><a href="'.BASE_URL.'content_con/content/'.$content[$i]['ID_KONTEN'].'">'.$content[$i]['JUDUL'].'</a></div>
                                        <div style="align:center;font-size:12px" class="uploaded" id="time'.$content[$i]['ID_KONTEN'].'"></div>
                                        <script type="text/javascript">setInterval(';echo "'timerContent"; echo '("'.BASE_URL.'","time",'.$content[$i]['ID_KONTEN'].',"'.$content[$i]['WAKTU'].'");'; echo "'"; echo ',250)</script>
                                        <div class="view">';
                                    
                                    if($content[$i]['ID_TYPE']==1) echo '
                                        <div class="view-link-url"><a href="'.$content[$i]['LINK'].'">'.$content[$i]['LINK'].'</a></div>
                                        <div class="view-link-desc">'.$content[$i]['DESKRIPSI'].'</div>
                                        ';
                                        else if($content[$i]['ID_TYPE']==2) echo '
                                            <div class="view-image">
                                                <img src="'.BASE_URL.'image/'.$content[$i]['LINK'].'" width="260" alt="'.$content[$i]['JUDUL'].'">
                                            </div>
                                            ';
                                        else if($content[$i]['ID_TYPE']==3) echo '
                                            <div class="view-video">
                                                <div class="view"><iframe width="240" height="180" src="'.$content[$i]['LINK'].'" ></iframe></div>
                                            </div>
                                            ';
                                    
                                    
                                        echo '</div>
                                        <div class="basic-features">
                                            <div class="paketjempol">
                                                <div class="likemini"></div>
                                                <div class="jumlahlike" id="like'.$content[$i]['ID_KONTEN'].'">'.$content[$i]['LIKE'].'</div>
                                                <div class="commentmini"></div>
                                                <div class="jumlahkomen" id="comment'.$content[$i]['ID_KONTEN'].'">'.count($content[$i]['KOMENTAR']).'</div>
                                                <br/>';
                            if(!empty($_SESSION['login'])){
                                if(!empty($content[$i]['STATUS_USER'])){
                                    echo $content[$i]['STATUS_USER']=="LIKE" 
                                    ? 
                                    '
                                    <div class="likebutton_pressed" id="likebutton'.$content[$i]['ID_KONTEN'].'"><a onclick="unlike(\''.BASE_URL.'\','.$content[$i]['ID_KONTEN'].')"></a></div>
                                    <div class="dislikebutton" id="dislikebutton'.$content[$i]['ID_KONTEN'].'"><a onclick="undislike(\''.BASE_URL.'\','.$content[$i]['ID_KONTEN'].')"></a></div>
                                    '
                                    : 
                                    '
                                    <div class="likebutton" id="likebutton'.$content[$i]['ID_KONTEN'].'"><a onclick="like(\''.BASE_URL.'\','.$content[$i]['ID_KONTEN'].')"></a></div>
                                    <div class="dislikebutton_pressed" id="dislikebutton'.$content[$i]['ID_KONTEN'].'"><a onclick="undislike(\''.BASE_URL.'\','.$content[$i]['ID_KONTEN'].')"></a></div>
                                    ';
                                }else{
                                    echo
                                    '<div class="likebutton" id="likebutton'.$content[$i]['ID_KONTEN'].'"><a onclick="like(\''.BASE_URL.'\','.$content[$i]['ID_KONTEN'].')"></a></div>
                                    <div class="dislikebutton" id="dislikebutton'.$content[$i]['ID_KONTEN'].'"><a onclick="dislike(\''.BASE_URL.'\','.$content[$i]['ID_KONTEN'].')"></a></div>';
                                }
                            }else{
                                echo '
                                    <div class="likebutton" id="likebutton'.$content[$i]['ID_KONTEN'].'"><a href="#"></a></div>
                                    <div class="dislikebutton" id="dislikebutton'.$content[$i]['ID_KONTEN'].'"><a href="#"></a></div>
                                    ';
                            }
                                            echo '</div>
                                        </div>
                                    </div>
                                </div>
                            </li>                                        
                                        ';
                                
                            }

                }
                echo $response;      
            }
        }        

        function checkAlay(){
            $achieve= false;
            if(!empty($_SESSION['id'])){
                $ach = $this->_model->query('select * from user where ID_USER='.$_SESSION['id'].'');                
                if(count($ach)>0){ // berhak mendapat achievement
                    $subject = $ach[0]['USERNAME'];
                    if(preg_match('/[A-Za-z]/', $subject) && preg_match('/[0-9]/', $subject)) {
                        $get_achieve = $this->_model->query('select * from user_achievement where ID_USER='.$_SESSION['id'].' AND ID_ACHIEVEMENT=10');
                        if(count($get_achieve)<=0){ // belum pernah dapet achievementnya
                            $insert = 'insert into user_achievement (ID_USER, ID_ACHIEVEMENT) 
                                values ('.$_SESSION['id'].', "10"
                                    )';
                            $this->_model->query($insert);
                            $achievement=$this->_model->query('select * from achievement where ID_ACHIEVEMENT=10');
                            if(count($achievement)>0)
                                $this->set('achievement', $achievement[0]);
                                $achieve = true;
                            }
                        }
                }
            }            
            return $achieve;                                                            
        }
        function checkNarcism(){
            $achieve= false;
            if(!empty($_SESSION['id'])){
                $ach = $this->_model->query('select * from narcism where ID_USER='.$_SESSION['id'].'');
                if(count($ach)>0 && $ach[0]['CHANGE_PICTURE']>=2){ // berhak mendapat achievement
                    $get_achieve = $this->_model->query('select * from user_achievement where ID_USER='.$_SESSION['id'].' AND ID_ACHIEVEMENT=11');
                    if(count($get_achieve)<=0){ // belum pernah dapet achievementnya
                        $insert = 'insert into user_achievement (ID_USER, ID_ACHIEVEMENT) 
                            values ('.$_SESSION['id'].', "11"
                                )';
                        $this->_model->query($insert);
                        $achievement=$this->_model->query('select * from achievement where ID_ACHIEVEMENT=11');
                        if(count($achievement)>0)
                        $this->set('achievement', $achievement[0]);
                        $achieve = true;
                    }
                }
            }            
            return $achieve;            
            
        }
        function checkStatus(){
            $achieve= false;
            if(!empty($_SESSION['id'])){
                $ach = $this->_model->query('select * from user where ID_USER='.$_SESSION['id'].'');
                if(count($ach)>0 && $ach[0]['STATUS']=="IN RELATIONSHIP"){ // berhak mendapat achievement
                    $get_achieve = $this->_model->query('select * from user_achievement where ID_USER='.$_SESSION['id'].' AND ID_ACHIEVEMENT=12');
                    if(count($get_achieve)<=0){ // belum pernah dapet achievementnya
                        $insert = 'insert into user_achievement (ID_USER, ID_ACHIEVEMENT) 
                            values ('.$_SESSION['id'].', "12"
                                )';
                        $this->_model->query($insert);
                        $achievement=$this->_model->query('select * from achievement where ID_ACHIEVEMENT=12');
                        if(count($achievement)>0)
                            //echo 'asd';
                            $this->set('achievement', $achievement[0]);
                        $achieve = true;
                    }
                }
            }            
            return $achieve;            
        }        

        function checkThreeAchievement(){
            $achieve= false;
            if(!empty($_SESSION['id'])){
                $ach = $this->_model->query('select * from user_achievement where ID_USER='.$_SESSION['id'].'');
                if(count($ach)>=3){ // berhak mendapat achievement
                    $get_achieve = $this->_model->query('select * from user_achievement where ID_USER='.$_SESSION['id'].' AND ID_ACHIEVEMENT=8');
                    if(count($get_achieve)<=0){ // belum pernah dapet achievementnya
                        $insert = 'insert into user_achievement (ID_USER, ID_ACHIEVEMENT) 
                            values ('.$_SESSION['id'].', "8"
                                )';
                        $this->_model->query($insert);
                        $achievement=$this->_model->query('select * from achievement where ID_ACHIEVEMENT=8');
                        if(count($achievement)>0)
                        $this->set('achievement', $achievement[0]);
                        $achieve = true;
                    }
                }
            }            
            return $achieve;                                                
        }
        function checkUltimate(){
            $achieve= false;
            if(!empty($_SESSION['id'])){
                $ach = $this->_model->query('select * from user_achievement where ID_USER='.$_SESSION['id'].'');
                if(count($ach)>=11){ // berhak mendapat achievement
                    $get_achieve = $this->_model->query('select * from user_achievement where ID_USER='.$_SESSION['id'].' AND ID_ACHIEVEMENT=9');
                    if(count($get_achieve)<=0){ // belum pernah dapet achievementnya
                        $insert = 'insert into user_achievement (ID_USER, ID_ACHIEVEMENT) 
                            values ('.$_SESSION['id'].', "9"
                                )';
                        $this->_model->query($insert);
                        $achievement=$this->_model->query('select * from achievement where ID_ACHIEVEMENT=9');
                        if(count($achievement)>0)
                        $this->set('achievement', $achievement[0]);
                        $achieve = true;
                    }
                }
            }            
            return $achieve;                                                            
        }        
}
