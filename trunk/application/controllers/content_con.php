<?php

class Content_con extends Controller {

	function index(){
            $this->redirect(BASE_URL.'content_con/list_content');
	}
        function list_content($id_tag=-1, $sort=-1, $achieve = -1){
            if($achieve!=-1){
                $this->checkFirstPost();
                $this->checkMorePost();
                $this->checkThreeAchievement();
                $this->checkUltimate();
            }
            
            $list_tag = $this->_model->query('select * from tag');
                if(count($list_tag)>0){
                        $this->set('list_tag',$list_tag);
                }
            $current_list_tag = $this->_model->query('select * from tag where ID_TAG='.$id_tag.'');
            if(count($current_list_tag)>0){
                $current_list_tag[0] = $current_list_tag[0]['NAMA_TAG'];
                $this->set('current_list_tag',$current_list_tag);
            }
            
            if($id_tag==-1){ // no tags
                $konten= $this->getContent();
            }else{
                $konten = $this->getContentFromTag($id_tag);                
            }
            
            if($sort==-1){ // sort waktu
                $konten=  $this->orderKontenByTime($konten);
            }else if($sort==1){ // sort like
                $konten=  $this->orderKontenByLike($konten);
            }else if($sort==2){ // sort komentar
                $konten=  $this->orderKontenByKomentar($konten);                    
            }
            $this->set('current_sort', $sort);
            $this->set('current_tag', $id_tag);
            $this->set('konten', $konten);
            $this->set('gate', 1);
            $this->set('title_page', 'Contents');
            $this->loadView("header_view.php");
            $this->loadView("list_content_view.php");		
            $this->loadView("footer_view.php");            
        }
        
        function getContentFromTag($id_tag){
            $result= Array();
            $konten = $this->getContent();
            $tag_konten = $this->_model->query('select * from konten_tag where ID_TAG='.$id_tag.'');
            $counter=0;
            for($i=0;$i<count($tag_konten);$i++){
                $search_konten = $this->getContentFromId($konten, $tag_konten[$i]['ID_KONTEN']);
                if($search_konten!=null){
                    if($this->getContentFromId($result, $search_konten['ID_KONTEN'])==null){
                        $result[$counter]= $search_konten;
                        $counter+=1;
                        //echo 'konten judul:'.$search_konten['JUDUL'].' dimasukkan<br>';
                    }
                    
                }
            }
            return $result;
        }
        function getContentFromMoreTag($tag){
            $result= Array();
            $konten = $this->getContent();
            for($r=0;$r<count($tag);$r++){
                $tag_konten = $this->_model->query('select * from konten_tag where ID_TAG='.$tag[$r]['ID_TAG'].'');
                $counter=0;
                for($i=0;$i<count($tag_konten);$i++){
                    $search_konten = $this->getContentFromId($konten, $tag_konten[$i]['ID_KONTEN']);
                    if($search_konten!=null){
                        if($this->getContentFromId($result, $search_konten['ID_KONTEN'])==null){
                            $result[$counter]= $search_konten;
                            $counter+=1;
                            //echo 'konten judul:'.$search_konten['JUDUL'].' dimasukkan<br>';
                        }

                    }
                }
            }
            return $result;
        }
        function submit_tag($input_tag=-1){
            if(empty($_POST['input_tag'])){
                $this->redirect(BASE_URL.'content_con');
            }
            if($input_tag!=-1){
                $input = $input_tag;
            }else
                $input = $_POST['input_tag'];
            $input = explode(',', $input);
            $tag = Array();
            foreach ($input as $value) {
                $value = str_replace ("\"", "", $value);
                $value = str_replace ("'", "", $value);
                $white = str_replace (" ", "", $value);
                if(!empty($white)){
                    $value = explode(' ', $value);
                    $one_tag="";
                    for($i=0;$i<count($value);$i++){
                        if(!empty($value[$i])){
                        $one_tag.=$value[$i];
                        if(($i+1)!=count($value)) 
                            $one_tag=$one_tag." ";
                        }
                    }
                    //echo 'satu tag='.$one_tag.';<br>';
                    array_push($tag, $one_tag);
                }
                //if(!empty($value))
                //echo $value .";<br>";
            }            
            if(count($tag)>0){
                $query='select * from konten_tag natural join tag where NAMA_TAG=';
                for($i=0;$i<count($tag);$i++){
                    $query.='"'.$tag[$i].'"';
                    if(($i+1)!=count($tag)){
                        $query.=' OR NAMA_TAG=';
                    }
                }
                $this->set('current_list_tag', $tag);
                //echo $query.'<br>';
                $tag_konten = $this->_model->query($query);            
                //echo count($tag_konten);
                $konten = $this->getContentFromMoreTag($tag_konten);
                //for($i=0;$i<count($konten);$i++){
                    //echo $konten[$i]['JUDUL']."<br>";
                //}

                // mekanisme sorting
                $sort = -1;
                if(!empty($_POST['Sorting'])){
                    $sort = $_POST['Sorting'];
                }
                if($sort==-1){ // sort waktu
                    $konten=  $this->orderKontenByTime($konten);
                }else if($sort==1){ // sort like
                    $konten=  $this->orderKontenByLike($konten);
                }else if($sort==2){ // sort komentar
                    $konten=  $this->orderKontenByKomentar($konten);                    
                }
                $this->set('current_sort',$sort);
                
                $this->set('konten',$konten);
                $this->loadView("header_view.php");
                $this->loadView("list_content_view.php");		
                $this->loadView("footer_view.php");            
                
            }
            
        }
        // POST
        function post(){
            if(empty($_SESSION['login'])){
                $this->redirect(BASE_URL.'user_con/error_display/0');                
            }
            
            $this->set('title_page', 'Upload Post');
            $this->loadView("header_view.php");
            $this->loadView("post_view.php");		
            $this->loadView("footer_view.php");            
            
        }
        function submit_post(){
            if(empty($_SESSION['login'])){
                $this->redirect(BASE_URL.'user_con/error_display/0');                
            }          
            $valid=false;
            $this->set('radio_click',$_POST['type']);
            if(empty($_POST['title'])){
                $this->set('empty','title');                
            }else{
                $post_type = $_POST['type'];
                $this->set('post_title',$_POST['title']);                                
                if($post_type=="Link"){
                    if(!empty($_POST['link'])){
                        $this->set('post_link',$_POST['link']);            
                        if($this->isValidURL($_POST['link'])) {
                            if(!empty($_POST['description'])){
                                // sukses
                                $valid = true;
                                $id_user = $_SESSION['id'];
                                $id_type = 1;
                                $waktu = date("Y-m-d H:i:s");
                                $judul = $_POST['title'];
                                $link = $_POST['link'];
                                $desc = $_POST['description'];
                                $insert = 'insert into konten (ID_USER, ID_TYPE, WAKTU, JUDUL, LINK, DESKRIPSI) 
                                    values ("'.$id_user.'", "'.$id_type.'",
                                        "'.$waktu.'", "'.$judul.'",
                                            "'.$link.'", "'.$desc.'"
                                        )';
                                $this->_model->query($insert);
                                $this->input_tags_in_last_konten($_POST['tags']);
                            }
                            else{
                                if(empty($_POST['description']))
                                    $this->set('empty','description');
                            }
                        }else{
                            echo 'tidak valid';
                        }
                    }
                    else{
                        if(empty($_POST['link']))
                            $this->set('empty','link');
                    }
                }
                else if($_POST['type']=="Image"){
                    if(!empty($_FILES['picture']['name'])){
                        $valid=true;

                        $fileName = $_FILES['picture']['name']; //get the file name
                        $fileSize = $_FILES['picture']['size']; //get the size
                        $fileError = $_FILES['picture']['error']; //get the error when upload
                        if($fileSize > 0 || $fileError == 0){ //check if the file is corrupt or error
                        $move = move_uploaded_file($_FILES['picture']['tmp_name'], 'image/'.$fileName); //save image to the folder
                        if($move){
                            $valid = true;
                            $id_user = $_SESSION['id'];
                            $id_type = 2;
                            $waktu = date("Y-m-d H:i:s");
                            $judul = $_POST['title'];
                            $link = $fileName;
                            $desc = "";
                            $insert = 'insert into konten (ID_USER, ID_TYPE, WAKTU, JUDUL, LINK, DESKRIPSI) 
                                values ("'.$id_user.'", "'.$id_type.'",
                                    "'.$waktu.'", "'.$judul.'",
                                        "'.$link.'", "'.$desc.'"
                                    )';
                            $this->_model->query($insert);
                            $this->input_tags_in_last_konten($_POST['tags']);

                        } else{
                            //echo "<h3>Failed! </h3>";
                        }
                        } else {
                            //echo "Failed to Upload : ".$fileError;
                        }                    
                    
                    }
                    else{
                        $this->set('empty','image');
                    }
                }
                else if($_POST['type']=="Video"){
                    $link = $_POST['link'];
                    if(!$this->isContainYoutube($link)) echo 'tidak ada youtube';
                    else if(!$this->isContainWatch($link)) echo 'tidak ada watch';
                    else if (!$this->isContainV($link)) echo 'tidak ada v';
                    else if (!$this->isContainCode($link)) echo 'tidak ada kode';
                    else 
                    if(!empty($_POST['link'])){
                        $pos = strpos($_POST['link'], "?v=");

                        if ($pos !== false) {
                            $pos = strpos($_POST['link'], "?v=");
                            $kode = substr($_POST['link'], $pos+3);
                            $kode = explode("&",$kode);
                            $kode[0];
                            $valid = true;
                            $id_user = $_SESSION['id'];
                            $id_type = 3;
                            $waktu = date("Y-m-d H:i:s");
                            $judul = $_POST['title'];
                            $link = "http://www.youtube.com/embed/".$kode[0];
                            $desc = "";
                            $insert = 'insert into konten (ID_USER, ID_TYPE, WAKTU, JUDUL, LINK, DESKRIPSI) 
                                values ("'.$id_user.'", "'.$id_type.'",
                                    "'.$waktu.'", "'.$judul.'",
                                        "'.$link.'", "'.$desc.'"
                                    )';
                            $this->_model->query($insert);
                            $this->input_tags_in_last_konten($_POST['tags']);
                                 
                        } else {
                             echo "The string '$findme' was not found in the string '$mystring'";
                        }
                    }
                    else{
                        if(empty($_POST['link']))
                            $this->set('empty','link');
                    }
                }
            }
            if(!$valid){ // gagal
                $this->loadView("header_view.php");
                $this->loadView("post_view.php");		
                $this->loadView("footer_view.php");            					
            }else{ // berhasil
                $this->redirect(BASE_URL.'content_con/list_content/-1/-1/1');
                
            }
            
        }
        function input_tags_in_last_konten($input_tags){
            $input = $input_tags;
            $tag = Array();
            if(empty($input)) $tag[0] ='uncategorized';
            else{
                $input = explode(',', $input);
                foreach ($input as $value) {
                    $value = str_replace ("\"", "", $value);
                    $value = str_replace ("'", "", $value);
                    $white = str_replace (" ", "", $value);
                    if(!empty($white)){
                        $value = explode(' ', $value);
                        $one_tag="";
                        for($i=0;$i<count($value);$i++){
                            if(!empty($value[$i])){
                            $one_tag.=$value[$i];
                            if(($i+1)!=count($value)) 
                                $one_tag=$one_tag." ";
                            }
                        }
                        //echo 'satu tag='.$one_tag.';<br>';
                        array_push($tag, $one_tag);
                    }
                    //if(!empty($value))
                    //echo $value .";<br>";
                }            
            }
            if(count($tag)>0){
                $query='select max(ID_KONTEN) as max from konten';                
                $tes = $this->_model->query($query);
                $id_konten= $tes[0]['max'];
                for($i=0;$i<count($tag);$i++){
                     $query='select * from tag where NAMA_TAG="'.$tag[$i].'"';
                      $query=$this->_model->query($query);
                     if(count($query)>0){ // sudah ada
                         //echo $tag[$i];
                         //echo count($query);
                         //echo $query[0]['ID_TAG'];
                         
                           $insert = 'insert into konten_tag (ID_KONTEN, ID_TAG) 
                                values ('.$id_konten.', '.$query[0]['ID_TAG'].' 
                                    )';
                            $this->_model->query($insert);
                     }else{ // tag belum ada
                            $insert = 'insert into tag (NAMA_TAG) 
                                values ("'.$tag[$i].'")';
                            $this->_model->query($insert);   
                            
                            $query='select max(ID_TAG) as max from tag';                
                            $max = $this->_model->query($query);
                            $id_tag= $max[0]['max'];
                            
                            $insert = 'insert into konten_tag (ID_KONTEN, ID_TAG) 
                                values ('.$id_konten.', '.$id_tag.' 
                                    )';
                            $this->_model->query($insert);                         
                     }
                }   
            }
        }
        function isContainYoutube($url){
            return preg_match('/(http:\/\/)?www.youtube.com\/?/', $url);
        }
        function isContainWatch($url){
            return preg_match('/\/watch\?/', $url);
        }
        function isContainV($url){
            return preg_match('/\?v=/', $url);
        }
            function isContainCode($url){
            return preg_match('/(http:\/\/)?www.youtube.com\/watch\?v=+([0-9A-Za-z]{10,12})/', $url);
        }
        function isValidURL($url){
            return preg_match('/(http:\/\/)?www+\.([a-zA-Z0-9]{1,30})+\.([\.\/a-zA-Z0-9]{0,10})/', $url);
        }
        function dateInputFormatSQL($tanggal){
            $cd = strtotime($tanggal);
              $newdate = date('Y-m-d H:m:s', mktime(date('h',$cd),
                date('i',$cd), date('s',$cd), date('m',$cd),
                date('d',$cd), date('Y',$cd)));
                return $newdate;
        }
        function dateOutputFormatSQLDate($tanggal){
                $cd = strtotime($tanggal);
              $newdate = date('d/m/Y', mktime(date('h',$cd),
                date('i',$cd), date('s',$cd), date('m',$cd),
                date('d',$cd), date('Y',$cd)));
                return $newdate;
                

        }
        function content($id, $achieve=-1){
            if(!empty($id)){
                if($achieve!=-1){
                    $this->checkFirstComment();
                    $this->checkMoreComment();
                }
                $konten = $this->getContentFromId($this->getContent(),$id);
                if(!empty($konten)){
                    if($konten!=null){
                        $komentar = $this->_model->query('select * from komentar natural join user where ID_KONTEN='.$konten['ID_KONTEN'].' order by WAKTU desc');
                        $konten['KOMENTAR'] = $komentar;
                        $this->set('content',$konten);
                        $this->loadView("header_view.php");
                        $this->loadView("content_view.php");		
                        $this->loadView("footer_view.php");            					
                    }
                }
            }else{
                
            }
        }
        
        // like / dislike
        function like($id_konten){
            if(empty($_SESSION['login'])){
                $this->redirect(BASE_URL.'user_con/error_display/0');
            }
            $user_like = $this->_model->query('select * from like_dislike where ID_KONTEN="'.$id_konten.'" AND ID_USER="'.$_SESSION['id'].'"');
            if(count($user_like)>0){ // sudah ada
                $update = 'update like_dislike set STATUS="LIKE"
                                        where ID_KONTEN="'.$id_konten.'" AND ID_USER="'.$_SESSION['id'].'"';
                $this->_model->query($update);
            }else{ // belum ada
                $insert = 'insert into like_dislike (ID_KONTEN, ID_USER, STATUS) 
                    values ("'.$id_konten.'", "'.$_SESSION['id'].'",
                        "LIKE")';
                $this->_model->query($insert);                
            }            
            $this->redirect(BASE_URL.'content_con/content/'.$id_konten);
        }
        function dislike($id_konten){
            if(empty($_SESSION['login'])){
                $this->redirect(BASE_URL.'user_con/error_display/0');
            }
            $user_like = $this->_model->query('select * from like_dislike where ID_KONTEN="'.$id_konten.'" AND ID_USER="'.$_SESSION['id'].'"');
            if(count($user_like)>0){ // sudah ada
                $update = 'update like_dislike set STATUS="DISLIKE"
                                        where ID_KONTEN="'.$id_konten.'" AND ID_USER="'.$_SESSION['id'].'"';
                $this->_model->query($update);
            }else{ // belum ada
                $insert = 'insert into like_dislike (ID_KONTEN, ID_USER, STATUS) 
                    values ("'.$id_konten.'", "'.$_SESSION['id'].'",
                        "DISLIKE")';
                $this->_model->query($insert);                
            }            
            $this->redirect(BASE_URL.'content_con/content/'.$id_konten);
        }
        function getContentFromId($konten, $id){
                $result = null;
                $counter=0;
                if(!empty($konten) && count($konten)>0)
                while($counter<count($konten) && $result==null){
                        if($konten[$counter]['ID_KONTEN']==$id) $result = $konten[$counter];
                        $counter+=1;
                }
                return $result;
        }
        function getContent(){
            $result = Array();
            $konten = $this->_model->query('select * from konten natural join user');
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
        // KOMENTAR
        function submit_comment($id_konten){
            if(empty($_SESSION['login'])){
                $this->redirect(BASE_URL.'user_con/error_display/0');
            }
            $komentar = $_POST['komentar'];
            $waktu = date('Y-m-d H:i:s');
            $insert = 'insert into komentar (ID_KONTEN, ISI, WAKTU, ID_USER) 
                values ("'.$id_konten.'", "'.$komentar.'",
                    "'.$waktu.'", "'.$_SESSION['id'].'"
                    )';
            $this->_model->query($insert);
            $this->redirect(BASE_URL.'content_con/content/'.$id_konten.'/1');
            
        }
        function delete_comment($id_content, $id_comment){
            if(empty($_SESSION['login']) || empty($id_comment) || empty($id_content)){
                $this->redirect(BASE_URL.'user_con/error_display/0');
            }
            $delete = 'delete from komentar where ID_KOMENTAR='.$id_comment.'';
            $this->_model->query($delete);
            $this->redirect(BASE_URL.'content_con/content/'.$id_content);
        }
        function sort_content($gate, $tag, $sort){
            if(empty($gate) || empty($sort)){
                $this->redirect(BASE_URL.'content_con/');
            }
            if($gate==1){ // list content
                $this->redirect(BASE_URL.'content_con/list_content/'.$tag.'/'.$sort);
            }else{ // submit tag
                $this->redirect(BASE_URL.'content_con/submit_tag/'.$tag);                
            }
        }
        function orderKontenByTime($konten){
            $result = $konten;
//            for($p=0;$p<count($konten);$p++){
//                echo $konten[$p]['JUDUL'].':'.strtotime($konten[$p]['WAKTU']).'<br>';
//            }
            for($x = 0; $x < count($result); $x++) {
              for($y = 0; $y < count($result); $y++) {
                $time1=strtotime($result[$x]['WAKTU']);
                $time2=strtotime($result[$y]['WAKTU']);
                if($time1 > $time2) {
                  $hold = $result[$x];
                  $result[$x] = $result[$y];
                  $result[$y] = $hold;
                }
              }
            }        
            return $result;
        }
        function orderKontenByLike($konten){
            $result = $konten;
            for($x = 0; $x < count($result); $x++) {
              for($y = 0; $y < count($result); $y++) {
                if($result[$x]['LIKE'] > $result[$y]['LIKE']) {
                  $hold = $result[$x];
                  $result[$x] = $result[$y];
                  $result[$y] = $hold;
                }
              }
            }        
            return $result;
        }
        function orderKontenByKomentar($konten){
            $result = $konten;
            for($x = 0; $x < count($result); $x++) {
              for($y = 0; $y < count($result); $y++) {
                if($result[$x]['KOMENTAR'] > $result[$y]['KOMENTAR']) {
                  $hold = $result[$x];
                  $result[$x] = $result[$y];
                  $result[$y] = $hold;
                }
              }
            }        
            return $result;
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
        function checkFirstPost(){
            $achieve = false;
            if(!empty($_SESSION['id'])){
                $post = $this->_model->query('select * from konten where ID_USER="'.$_SESSION['id'].'"');
                if(count($post)>0){ // berhak mendapat first achievement
                    $get_achieve = $this->_model->query('select * from user_achievement where ID_USER='.$_SESSION['id'].' AND ID_ACHIEVEMENT=1');
                    if(count($get_achieve)<=0){ // belum pernah dapet achievementnya
                        $insert = 'insert into user_achievement (ID_USER, ID_ACHIEVEMENT) 
                            values ('.$_SESSION['id'].', "1"
                                )';
                        $this->_model->query($insert);
                        $achievement=Array();
                        $achievement['NAME'] = "Hello World";
                        $achievement['DESCRIPTION'] = "You Just Post your First Post";
                        $achievement['IMAGE'] = "http://localhost/progin/img/achievements/hello_world.png";
                        $this->set('achievement', $achievement);
                        $achieve = true;
                    }
                }
            }            
            return $achieve;
        }
        function checkMorePost(){
            $achieve=false;
            if(!empty($_SESSION['id'])){
                $post = $this->_model->query('select * from konten where ID_USER="'.$_SESSION['id'].'"');
                if(count($post)>=10){ // berhak mendapat first achievement
                    $get_achieve = $this->_model->query('select * from user_achievement where ID_USER='.$_SESSION['id'].' AND ID_ACHIEVEMENT=2');
                    if(count($get_achieve)<=0){ // belum pernah dapet achievementnya
                        $insert = 'insert into user_achievement (ID_USER, ID_ACHIEVEMENT) 
                            values ('.$_SESSION['id'].', "2"
                                )';
                        $this->_model->query($insert);
                        $achieve = true;
                    }
                }
            }            
            return $achieve;
        }
        function checkFirstComment(){
            $achieve= false;
            if(!empty($_SESSION['id'])){
                $post = $this->_model->query('select * from komentar where ID_USER="'.$_SESSION['id'].'"');
                if(count($post)>0){ // berhak mendapat first achievement
                    $get_achieve = $this->_model->query('select * from user_achievement where ID_USER='.$_SESSION['id'].' AND ID_ACHIEVEMENT=3');
                    if(count($get_achieve)<=0){ // belum pernah dapet achievementnya
                        $insert = 'insert into user_achievement (ID_USER, ID_ACHIEVEMENT) 
                            values ('.$_SESSION['id'].', "3"
                                )';
                        $this->_model->query($insert);
                        $achieve = true;
                    }
                }
            }            
            return $achieve;
        }
        function checkMoreComment(){
            $achieve= false;
            if(!empty($_SESSION['id'])){
                $post = $this->_model->query('select * from komentar where ID_USER="'.$_SESSION['id'].'"');
                if(count($post)>=20){ // berhak mendapat first achievement
                    $get_achieve = $this->_model->query('select * from user_achievement where ID_USER='.$_SESSION['id'].' AND ID_ACHIEVEMENT=4');
                    if(count($get_achieve)<=0){ // belum pernah dapet achievementnya
                        $insert = 'insert into user_achievement (ID_USER, ID_ACHIEVEMENT) 
                            values ('.$_SESSION['id'].', "4"
                                )';
                        $this->_model->query($insert);
                        $achieve = true;
                    }
                }
            }            
            return $achieve;            
        }
        function checkMoreLike(){
            $achieve= false;
            if(!empty($_SESSION['id'])){
                $like = $this->_model->query('SELECT count(konten.ID_KONTEN) as "like" FROM `konten` inner join like_dislike on konten.ID_KONTEN=like_dislike.ID_KONTEN WHERE konten.ID_USER='.$_SESSION['id'].' AND like_dislike.STATUS="LIKE"');
                if($like[0]['like']>=100){ // berhak mendapat first achievement
                    $get_achieve = $this->_model->query('select * from user_achievement where ID_USER='.$_SESSION['id'].' AND ID_ACHIEVEMENT=5');
                    if(count($get_achieve)<=0){ // belum pernah dapet achievementnya
                        $insert = 'insert into user_achievement (ID_USER, ID_ACHIEVEMENT) 
                            values ('.$_SESSION['id'].', "5"
                                )';
                        $this->_model->query($insert);
                        $achieve = true;
                    }
                }
            }            
            return $achieve;            
        }
        function checkMoreDislike(){
            $achieve= false;
            if(!empty($_SESSION['id'])){
                $like = $this->_model->query('SELECT count(konten.ID_KONTEN) as like FROM `konten` inner join like_dislike on konten.ID_KONTEN=like_dislike.ID_KONTEN WHERE konten.ID_USER='.$_SESSION['id'].' AND like_dislike.STATUS="DISLIKE"');
                if($like[0]['like']>=100){ // berhak mendapat first achievement
                    $get_achieve = $this->_model->query('select * from user_achievement where ID_USER='.$_SESSION['id'].' AND ID_ACHIEVEMENT=6');
                    if(count($get_achieve)<=0){ // belum pernah dapet achievementnya
                        $insert = 'insert into user_achievement (ID_USER, ID_ACHIEVEMENT) 
                            values ('.$_SESSION['id'].', "6"
                                )';
                        $this->_model->query($insert);
                        $achieve = true;
                    }
                }
            }            
            return $achieve;                        
        }
        function checkPeopleComment(){
            $achieve= false;
            if(!empty($_SESSION['id'])){
                $like = $this->_model->query('SELECT count(konten.ID_KONTEN) as "like" FROM `konten` inner join komentar on konten.ID_KONTEN=komentar.ID_KONTEN WHERE konten.ID_USER='.$_SESSION['id'].'');
                if($like[0]['like']>=50){ // berhak mendapat first achievement
                    $get_achieve = $this->_model->query('select * from user_achievement where ID_USER='.$_SESSION['id'].' AND ID_ACHIEVEMENT=7');
                    if(count($get_achieve)<=0){ // belum pernah dapet achievementnya
                        $insert = 'insert into user_achievement (ID_USER, ID_ACHIEVEMENT) 
                            values ('.$_SESSION['id'].', "7"
                                )';
                        $this->_model->query($insert);
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
                        $achieve = true;
                    }
                }
            }            
            return $achieve;                                                            
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
                if(count($ach)>0 && $ach[0]['CHANGE_PICTURE']>=3){ // berhak mendapat achievement
                    $get_achieve = $this->_model->query('select * from user_achievement where ID_USER='.$_SESSION['id'].' AND ID_ACHIEVEMENT=12');
                    if(count($get_achieve)<=0){ // belum pernah dapet achievementnya
                        $insert = 'insert into user_achievement (ID_USER, ID_ACHIEVEMENT) 
                            values ('.$_SESSION['id'].', "12"
                                )';
                        $this->_model->query($insert);
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
                    $get_achieve = $this->_model->query('select * from user_achievement where ID_USER='.$_SESSION['id'].' AND ID_ACHIEVEMENT=11');
                    if(count($get_achieve)<=0){ // belum pernah dapet achievementnya
                        $insert = 'insert into user_achievement (ID_USER, ID_ACHIEVEMENT) 
                            values ('.$_SESSION['id'].', "11"
                                )';
                        $this->_model->query($insert);
                        $achieve = true;
                    }
                }
            }            
            return $achieve;            
        }
        
        
        
}
