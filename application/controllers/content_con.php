<?php

class Content_con extends Controller {

	function index(){
            $this->redirect(BASE_URL.'content_con/list_content');
	}
        function setListAchievement(){
            if(!empty($_SESSION['login'])){
                $achievement = $this->_model->query('select * from user_achievement natural join achievement where ID_USER='.$_SESSION['id'].'');            
                if(count($achievement)>0){
                    $this->set('list_achievement', $achievement);
                }
                $message = $this->_model->query('select * from message inner join user on message.ID_FROM=user.ID_USER where ID_TO='.$_SESSION['id'].'');
                if(count($message)>0){
                    $this->set('message_box', $message);
                }
            }            
        }
        function list_content($submit_tag=-1,$id_tag=-1, $sort=-1, $achieve = -1){
            $this->setListAchievement();
            if($submit_tag!=-1){
                if(empty($_POST['input_tag'])){
                    $this->redirect(BASE_URL.'content_con');
                }
                $input = $_POST['input_tag'];
                $sort = $_POST['sortmethod'];
                $tag = $this->explodeTag($input);
                $this->set('input_tag_from_text', $input);

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

                    $list_tag = $this->_model->query('select * from tag');
                    if(count($list_tag)>0){
                            $this->set('list_tag',$list_tag);
                    }

                    if($sort==-1){ // sort waktu
                        $konten=  $this->orderKontenByTime($konten);
                    }else if($sort==1){ // sort like
                        $konten=  $this->orderKontenByLike($konten);
                    }else if($sort==2){ // sort komentar
                        $konten=  $this->orderKontenByKomentar($konten);                    
                    }else if($sort==3){ // sort view
                        $konten=  $this->orderKontenByView($konten);                    
                    }
                    $this->set('current_sort',$sort);

                    $this->set('konten',$konten);
                    $this->loadView("header_view.php");
                    $this->loadView("list_content_view.php");		
                    $this->loadView("footer_view.php");
                }                
            }else{

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
                }else if($sort==3){ // sort view
                    $konten=  $this->orderKontenByView($konten);                    
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
        function explodeTag($input1){
            $input = explode(',', $input1);
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
            return $tag;
        }
        function submit_tag($input_tag=-1){
            if(empty($_POST['input_tag'])){
                $this->redirect(BASE_URL.'content_con');
            }
            if($input_tag!=-1){
                $input = $input_tag;
            }else $input = $_POST['input_tag'];
            
            $tag = $this->explodeTag($input);
            $this->set('input_tag_from_text', $input);

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

                $list_tag = $this->_model->query('select * from tag');
                if(count($list_tag)>0){
                        $this->set('list_tag',$list_tag);
                }

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
                }else if($sort==3){ // sort view
                    $konten=  $this->orderKontenByView($konten);                    
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
                    if(!empty($_POST['link-input'])){
                        $this->set('post_link',$_POST['link-input']);            
                        if($this->isValidURL($_POST['link-input'])) {
                            if(!empty($_POST['description'])){
                                // sukses
                                $valid = true;
                                $id_user = $_SESSION['id'];
                                $id_type = 1;
                                $waktu = date("Y-m-d H:i:s");
                                $judul = $_POST['title'];
                                $link = $_POST['link-input'];
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
                        if($_FILES['picture']['type']!='image/jpg' && 
                            $_FILES['picture']['type']!='image/jpeg' && 
                            $_FILES['picture']['type']!='image/pjpeg'){ 
                            $this->set('empty','image');
                            }else{
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
                    
                    }
                    else{
                        $this->set('empty','image');
                    }
                }
                else if($_POST['type']=="Video"){
                    $link = $_POST['link-input'];
                    if(!$this->isContainYoutube($link)) echo 'tidak ada youtube';
                    else if(!$this->isContainWatch($link)) echo 'tidak ada watch';
                    else if (!$this->isContainV($link)) echo 'tidak ada v';
                    else if (!$this->isContainCode($link)) echo 'tidak ada kode';
                    else 
                    if(!empty($_POST['link-input'])){
                        $pos = strpos($_POST['link-input'], "?v=");

                        if ($pos !== false) {
                            $pos = strpos($_POST['link-input'], "?v=");
                            $kode = substr($_POST['link-input'], $pos+3);
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
                $this->redirect(BASE_URL.'content_con/list_content/-1/-1/-1/1');
                
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
            if(!empty($_SESSION['login']) && $id>0){
                $message = $this->_model->query('select * from message inner join user on message.ID_FROM=user.ID_USER where ID_TO='.$_SESSION['id'].'');
                if(count($message)>0){
                    $this->set('message_box', $message);
                }
                $viewed = $this->_model->query('select * from konten_view where ID_KONTEN='.$id.' AND ID_USER='.$_SESSION['id'].'');
                if(count($viewed)<=0){
                    $insert = 'insert into konten_view (ID_KONTEN, ID_USER) 
                        values ("'.$id.'", "'.$_SESSION['id'].'")';
                    $this->_model->query($insert);                
                }
            }
            $this->setListAchievement();
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
        function unlike($id_konten){
            if(empty($_SESSION['login'])){
                $this->redirect(BASE_URL.'user_con/error_display/0');
            }
            $user_like = $this->_model->query('select * from like_dislike where ID_KONTEN="'.$id_konten.'" AND ID_USER="'.$_SESSION['id'].'"');
            if(count($user_like)>0){ // sudah ada
                $delete = 'delete from like_dislike where ID_KONTEN="'.$id_konten.'" AND ID_USER="'.$_SESSION['id'].'" AND STATUS="LIKE"';
                $this->_model->query($delete);
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
        function undislike($id_konten){
            if(empty($_SESSION['login'])){
                $this->redirect(BASE_URL.'user_con/error_display/0');
            }
            $user_like = $this->_model->query('select * from like_dislike where ID_KONTEN="'.$id_konten.'" AND ID_USER="'.$_SESSION['id'].'"');
            if(count($user_like)>0){ // sudah ada
                $delete = 'delete from like_dislike where ID_KONTEN="'.$id_konten.'" AND ID_USER="'.$_SESSION['id'].'" AND STATUS="DISLIKE"';
                $this->_model->query($delete);
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

                    $view = $this->_model->query('select * from konten_view where ID_KONTEN='.$konten[$i]['ID_KONTEN'].'');
                    $konten[$i]['VIEW'] = count($view);
                    
//                    echo "like=".$sum_like."<br>";
//                    echo "dislike=".$sum_dislike."<br>";
                    //user like
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
                $this->redirect(BASE_URL.'content_con/list_content/-1/'.$tag.'/'.$sort);
            }else{ // submit tag
                $this->redirect(BASE_URL.'content_con/submit_tag/-1/'.$tag);                
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
        function orderKontenByView($konten){
            $result = $konten;
            for($x = 0; $x < count($result); $x++) {
              for($y = 0; $y < count($result); $y++) {
                if($result[$x]['VIEW'] > $result[$y]['VIEW']) {
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
                        $achievement=$this->_model->query('select * from achievement where ID_ACHIEVEMENT=1');
                        if(count($achievement)>0)
                        $this->set('achievement', $achievement[0]);
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
                        $achievement=$this->_model->query('select * from achievement where ID_ACHIEVEMENT=2');
                        if(count($achievement)>0)
                        $this->set('achievement', $achievement[0]);
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
                        $achievement=$this->_model->query('select * from achievement where ID_ACHIEVEMENT=3');
                        if(count($achievement)>0)
                        $this->set('achievement', $achievement[0]);
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
                        $achievement=$this->_model->query('select * from achievement where ID_ACHIEVEMENT=4');
                        if(count($achievement)>0)
                        $this->set('achievement', $achievement[0]);
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
                if($like[0]['like']>=99){ // berhak mendapat first achievement
                    $get_achieve = $this->_model->query('select * from user_achievement where ID_USER='.$_SESSION['id'].' AND ID_ACHIEVEMENT=5');
                    if(count($get_achieve)<=0){ // belum pernah dapet achievementnya
                        $insert = 'insert into user_achievement (ID_USER, ID_ACHIEVEMENT) 
                            values ('.$_SESSION['id'].', "5"
                                )';
                        $this->_model->query($insert);
                        $achievement=$this->_model->query('select * from achievement where ID_ACHIEVEMENT=5');
                        if(count($achievement)>0)
                        $this->set('achievement', $achievement[0]);
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
                if($like[0]['like']>=99){ // berhak mendapat first achievement
                    $get_achieve = $this->_model->query('select * from user_achievement where ID_USER='.$_SESSION['id'].' AND ID_ACHIEVEMENT=6');
                    if(count($get_achieve)<=0){ // belum pernah dapet achievementnya
                        $insert = 'insert into user_achievement (ID_USER, ID_ACHIEVEMENT) 
                            values ('.$_SESSION['id'].', "6"
                                )';
                        $this->_model->query($insert);
                        $achievement=$this->_model->query('select * from achievement where ID_ACHIEVEMENT=6');
                        if(count($achievement)>0)
                        $this->set('achievement', $achievement[0]);
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
                        $achievement=$this->_model->query('select * from achievement where ID_ACHIEVEMENT=7');
                        if(count($achievement)>0)
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
        
        function ajax_scrolling_content($index, $id_tag=-1, $sort=-1){
            $response = "";
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
            }else if($sort==3){ // sort view
                $konten=  $this->orderKontenByView($konten);                    
            }
            
            //echo count($konten).':'.$index;
            for($i=$index-3;$i<$index;$i++){
                if(!empty($konten[$i])){
                        echo '
                    <li>
                    <div class="paketkonten ';
                        if($konten[$i]['ID_TYPE']==1) echo 'link';
                        else if($konten[$i]['ID_TYPE']==2) echo 'image';
                        else if($konten[$i]['ID_TYPE']==3) echo 'video';

                        echo 'post">
                        <div class="left iconcontent">
                            <div class="icon';
                        if($konten[$i]['ID_TYPE']==1) echo 'link';
                        else if($konten[$i]['ID_TYPE']==2) echo 'photo';
                        else if($konten[$i]['ID_TYPE']==3) echo 'video';

                        echo '"></div>
                        </div>
                        <div class="headertext judul">
                            <div class="title"><a href="'.BASE_URL.'content_con/content/'.$konten[$i]['ID_KONTEN'].'">'.$konten[$i]['JUDUL'].'</a></div>
                            <div class="uploader"><a href="'.BASE_URL.'user_con/profile/'.$konten[$i]['ID_USER'].'">'.$konten[$i]['NAMA'].'</a></div>
                            <div class="uploaded" id="time'.$konten[$i]['ID_KONTEN'].'"></div>
                                <script type="text/javascript">setInterval(';echo "'timerContent"; echo '("'.BASE_URL.'","time",'.$konten[$i]['ID_KONTEN'].',"'.$konten[$i]['WAKTU'].'");'; echo "'"; echo ',250)</script>
                        </div>
                        <div class="content">';
                        if($konten[$i]['ID_TYPE']==1) 
                            echo '
                            <a href="'.$konten[$i]['LINK'].'"> '.$konten[$i]['LINK'].' </a>
                            <p> '.$konten[$i]['DESKRIPSI'].' </p>
                                ';
                        else if($konten[$i]['ID_TYPE']==2) echo '
                            <img src="'.BASE_URL.'image/'.$konten[$i]['LINK'].'" width="320" alt="beach">
                            ';
                        else if($konten[$i]['ID_TYPE']==3) echo '
                            <iframe width="320" height="240" src="'.$konten[$i]['LINK'].'" frameborder="0" allowfullscreen></iframe>
                            ';


                        echo '</div>
                        <div class="paketjempol">
                            <div class="views"></div>
                            <div class="viewcount" id="view'.$konten[$i]['ID_KONTEN'].'"></div><br/>
                            <div class="likemini"></div>
                            <div class="jumlahlike" id="like'.$konten[$i]['ID_KONTEN'].'"></div>
                            <div class="commentmini"></div>
                            <div class="jumlahkomen" id="comment'.$konten[$i]['ID_KONTEN'].'"></div>
                            <br/>';
                            if(!empty($_SESSION['login'])){
                                if(!empty($konten[$i]['STATUS_USER'])){
                                    echo $konten[$i]['STATUS_USER']=="LIKE" 
                                    ? 
                                    '
                                    <div class="likebutton_pressed" id="likebutton'.$konten[$i]['ID_KONTEN'].'"><a onclick="unlike(\''.BASE_URL.'\','.$konten[$i]['ID_KONTEN'].')"></a></div>
                                    <div class="dislikebutton" id="dislikebutton'.$konten[$i]['ID_KONTEN'].'"><a onclick="undislike(\''.BASE_URL.'\','.$konten[$i]['ID_KONTEN'].')"></a></div>
                                    '
                                    : 
                                    '
                                    <div class="likebutton" id="likebutton'.$konten[$i]['ID_KONTEN'].'"><a onclick="like(\''.BASE_URL.'\','.$konten[$i]['ID_KONTEN'].')"></a></div>
                                    <div class="dislikebutton_pressed" id="dislikebutton'.$konten[$i]['ID_KONTEN'].'"><a onclick="undislike(\''.BASE_URL.'\','.$konten[$i]['ID_KONTEN'].')"></a></div>
                                    ';
                                }else{
                                    echo
                                    '<div class="likebutton" id="likebutton'.$konten[$i]['ID_KONTEN'].'"><a onclick="like(\''.BASE_URL.'\','.$konten[$i]['ID_KONTEN'].')"></a></div>
                                    <div class="dislikebutton" id="dislikebutton'.$konten[$i]['ID_KONTEN'].'"><a onclick="dislike(\''.BASE_URL.'\','.$konten[$i]['ID_KONTEN'].')"></a></div>';
                                }
                            }else{
                                echo '
                                    <div class="likebutton" id="likebutton'.$konten[$i]['ID_KONTEN'].'"><a href="#"></a></div>
                                    <div class="dislikebutton" id="dislikebutton'.$konten[$i]['ID_KONTEN'].'"><a href="#"></a></div>
                                    ';
                            }
                            echo '<div class="tags">
                                Tags : <br/>
                                <ul class="tag">';
                                    for($j=0;$j<count($konten[$i]['TAG']);$j++){
                                        echo '
                                            <li><a href="'.BASE_URL.'content_con/list_content/-1/'.$konten[$i]['TAG'][$j]['ID_TAG'].'">'.$konten[$i]['TAG'][$j]['NAMA_TAG'].'</a></li>
                                            ';
                                    }
                                echo '</ul>
                            </div>
                        </div>
                    </div>
                </li>
                ';



                }

            }
            echo $response;            
        }
        function ajax_scrolling_tag($index, $input, $sort=-1){
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
               $tag_konten = $this->_model->query($query);            
                //echo count($tag_konten);
                $konten = $this->getContentFromMoreTag($tag_konten);
                //for($i=0;$i<count($konten);$i++){
                    //echo $konten[$i]['JUDUL']."<br>";
                //}

                if($sort==-1){ // sort waktu
                    $konten=  $this->orderKontenByTime($konten);
                }else if($sort==1){ // sort like
                    $konten=  $this->orderKontenByLike($konten);
                }else if($sort==2){ // sort komentar
                    $konten=  $this->orderKontenByKomentar($konten);                    
                }else if($sort==3){ // sort view
                    $konten=  $this->orderKontenByView($konten);                    
                }
                

                for($i=$index-3;$i<$index;$i++){
                    if(!empty($konten[$i])){
                            echo '
                        <li>
                        <div class="paketkonten ';
                            if($konten[$i]['ID_TYPE']==1) echo 'link';
                            else if($konten[$i]['ID_TYPE']==2) echo 'image';
                            else if($konten[$i]['ID_TYPE']==3) echo 'video';

                            echo 'post">
                            <div class="left iconcontent">
                                <div class="icon';
                            if($konten[$i]['ID_TYPE']==1) echo 'link';
                            else if($konten[$i]['ID_TYPE']==2) echo 'photo';
                            else if($konten[$i]['ID_TYPE']==3) echo 'video';

                            echo '"></div>
                            </div>
                            <div class="headertext judul">
                                <div class="title"><a href="'.BASE_URL.'content_con/content/'.$konten[$i]['ID_KONTEN'].'">'.$konten[$i]['JUDUL'].'</a></div>
                                <div class="uploader"><a href="'.BASE_URL.'user_con/profile/'.$konten[$i]['ID_USER'].'">'.$konten[$i]['NAMA'].'</a></div>
                                <div class="uploaded" id="time'.$konten[$i]['ID_KONTEN'].'"></div>
                                <script type="text/javascript">setInterval(';echo "'timerContent"; echo '("'.BASE_URL.'","time",'.$konten[$i]['ID_KONTEN'].',"'.$konten[$i]['WAKTU'].'");'; echo "'"; echo ',250)</script>
                            </div>
                            <div class="content">';
                            if($konten[$i]['ID_TYPE']==1) 
                                echo '
                                <a href="'.$konten[$i]['LINK'].'"> '.$konten[$i]['LINK'].' </a>
                                <p> '.$konten[$i]['DESKRIPSI'].' </p>
                                    ';
                            else if($konten[$i]['ID_TYPE']==2) echo '
                                <img src="'.BASE_URL.'image/'.$konten[$i]['LINK'].'" width="320" alt="beach">
                                ';
                            else if($konten[$i]['ID_TYPE']==3) echo '
                                <iframe width="320" height="240" src="'.$konten[$i]['LINK'].'" frameborder="0" allowfullscreen></iframe>
                                ';


                            echo '</div>
                            <div class="paketjempol">
                                <div class="views"></div>
                                <div class="viewcount" id="view'.$konten[$i]['ID_KONTEN'].'"></div><br/>
                                <div class="likemini"></div>
                                <div class="jumlahlike" id="like'.$konten[$i]['ID_KONTEN'].'"></div>
                                <div class="commentmini"></div>
                                <div class="jumlahkomen" id="comment'.$konten[$i]['ID_KONTEN'].'"></div>
                                <br/>';
                            if(!empty($_SESSION['login'])){
                                if(!empty($konten[$i]['STATUS_USER'])){
                                    echo $konten[$i]['STATUS_USER']=="LIKE" 
                                    ? 
                                    '
                                    <div class="likebutton_pressed" id="likebutton'.$konten[$i]['ID_KONTEN'].'"><a onclick="unlike(\''.BASE_URL.'\','.$konten[$i]['ID_KONTEN'].')"></a></div>
                                    <div class="dislikebutton" id="dislikebutton'.$konten[$i]['ID_KONTEN'].'"><a onclick="undislike(\''.BASE_URL.'\','.$konten[$i]['ID_KONTEN'].')"></a></div>
                                    '
                                    : 
                                    '
                                    <div class="likebutton" id="likebutton'.$konten[$i]['ID_KONTEN'].'"><a onclick="like(\''.BASE_URL.'\','.$konten[$i]['ID_KONTEN'].')"></a></div>
                                    <div class="dislikebutton_pressed" id="dislikebutton'.$konten[$i]['ID_KONTEN'].'"><a onclick="undislike(\''.BASE_URL.'\','.$konten[$i]['ID_KONTEN'].')"></a></div>
                                    ';
                                }else{
                                    echo
                                    '<div class="likebutton" id="likebutton'.$konten[$i]['ID_KONTEN'].'"><a onclick="like(\''.BASE_URL.'\','.$konten[$i]['ID_KONTEN'].')"></a></div>
                                    <div class="dislikebutton" id="dislikebutton'.$konten[$i]['ID_KONTEN'].'"><a onclick="dislike(\''.BASE_URL.'\','.$konten[$i]['ID_KONTEN'].')"></a></div>';
                                }
                            }else{
                                echo '
                                    <div class="likebutton" id="likebutton'.$konten[$i]['ID_KONTEN'].'"><a href="#"></a></div>
                                    <div class="dislikebutton" id="dislikebutton'.$konten[$i]['ID_KONTEN'].'"><a href="#"></a></div>
                                    ';
                            }
                            echo '<div class="tags">
                                    Tags : <br/>
                                    <ul class="tag">';
                                        for($j=0;$j<count($konten[$i]['TAG']);$j++){
                                            echo '
                                                <li><a href="'.BASE_URL.'content_con/list_content/-1/'.$konten[$i]['TAG'][$j]['ID_TAG'].'">'.$konten[$i]['TAG'][$j]['NAMA_TAG'].'</a></li>
                                                ';
                                        }
                                    echo '</ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    ';



                    }

                }                
            }
            
        }
        
        function ajax_submit_comment($id_content, $comment){
            $insert = 'insert into komentar (ID_KONTEN, ISI, WAKTU, ID_USER) 
                values ("'.$id_content.'", "'.$comment.'",
                    "'.date('Y-m-d H:i:s').'", "'.$_SESSION['id'].'"
                    )';
            $this->_model->query($insert);
            $comment = $this->_model->query('select * from komentar where ID_KONTEN="'.$id_content.'" AND ID_USER="'.$_SESSION['id'].'" order by WAKTU desc');
            $user = $this->_model->query('select * from user where ID_USER="'.$_SESSION['id'].'"');
            if(count($user)>0){
                $comment[0]['USERNAME'] = $user[0]['USERNAME'];
                $comment[0]['AVATAR'] = $user[0]['AVATAR'];
            }else{
                
            }
            if(count($comment)>0)
            echo                             
                '<div class="comment" id="comment'.$comment[0]['ID_KOMENTAR'].'">
                                <div class="avatar">
                                    <img src="'.BASE_URL.'avatar/'.$comment[0]['AVATAR'].'" alt="avatar" width="64" />
                                </div>
                                <div class="isikomen">';
                                if(!empty($_SESSION['login']) && $comment[0]['ID_USER']==$_SESSION['id']){
                                    echo 
                                    '<a onclick="delete_comment(\''.BASE_URL.'\', '.$comment[0]['ID_KOMENTAR'].')"><div class="del-comment right"></div></a>';
                                }
                                echo
                                    '<div class="namecomment">'.$comment[0]['USERNAME'].'</div>
                                    <div class="timecomment" id="time'.$comment[0]['ID_KOMENTAR'].'"></div>
                                <script type="text/javascript">setInterval(';echo "'timerCommentar"; echo '("'.BASE_URL.'","time",'.$comment[0]['ID_KOMENTAR'].',"'.$comment[0]['WAKTU'].'");'; echo "'"; echo ',250)</script>
                                            '.$comment[0]['ISI'].'
                                </div>
                            </div>';
        }
        
        function ajax_delete_comment($comment){
            $delete= 'delete from komentar where ID_KOMENTAR='.$comment.'';
            $this->_model->query($delete);
        }
        function update_like($id_content){
            $konten_like = $this->_model->query('select * from like_dislike where ID_KONTEN='.$id_content.'');
            $sum = 0;
            for($j=0;$j<count($konten_like);$j++){
                if($konten_like[$j]['STATUS']=="LIKE") $sum+=1;
                if($konten_like[$j]['STATUS']=="DISLIKE") $sum-=1;
            }
            echo $sum;
        }
        
        function update_comment($id_content){
            $komentar = $this->_model->query('select * from komentar where ID_KONTEN='.$id_content.'');
            echo count($komentar);
        }
        function update_view($id_content){
            $view = $this->_model->query('select * from konten_view where ID_KONTEN='.$id_content.'');
            echo count($view);
        }
        function ajax_unlike($id_konten){
            $user_like = $this->_model->query('select * from like_dislike where ID_KONTEN="'.$id_konten.'" AND ID_USER="'.$_SESSION['id'].'"');
            if(count($user_like)>0){ // sudah ada
                $delete = 'delete from like_dislike where ID_KONTEN="'.$id_konten.'" AND ID_USER="'.$_SESSION['id'].'" AND STATUS="LIKE"';
                $this->_model->query($delete);
            }                        
        }
        function ajax_undislike($id_konten){
            $user_like = $this->_model->query('select * from like_dislike where ID_KONTEN="'.$id_konten.'" AND ID_USER="'.$_SESSION['id'].'"');
            if(count($user_like)>0){ // sudah ada
                $delete = 'delete from like_dislike where ID_KONTEN="'.$id_konten.'" AND ID_USER="'.$_SESSION['id'].'" AND STATUS="DISLIKE"';
                $this->_model->query($delete);
            }                        
        }
        function ajax_like($id_konten){
            $user_like = $this->_model->query('select * from like_dislike where ID_KONTEN="'.$id_konten.'" AND ID_USER="'.$_SESSION['id'].'"');
            if(count($user_like)<=0){ // kosong
                $insert = 'insert into like_dislike (ID_KONTEN, ID_USER, STATUS) 
                                    values ("'.$id_konten.'", "'.$_SESSION['id'].'",
                                        "LIKE")';
                $this->_model->query($insert);
            }else{
                $update = 'update like_dislike set STATUS="LIKE"
                                        where ID_KONTEN="'.$id_konten.'" AND ID_USER="'.$_SESSION['id'].'"';
                $this->_model->query($update);                
            }
        }
        function ajax_dislike($id_konten){
            $user_like = $this->_model->query('select * from like_dislike where ID_KONTEN="'.$id_konten.'" AND ID_USER="'.$_SESSION['id'].'"');
            if(count($user_like)<=0){ // kosong
                $insert = 'insert into like_dislike (ID_KONTEN, ID_USER, STATUS) 
                                    values ("'.$id_konten.'", "'.$_SESSION['id'].'",
                                        "DISLIKE")';
                $this->_model->query($insert);
            }else{
                $update = 'update like_dislike set STATUS="DISLIKE"
                                        where ID_KONTEN="'.$id_konten.'" AND ID_USER="'.$_SESSION['id'].'"';
                $this->_model->query($update);                
                
            }                        
        }
        
        
        
        function ajax_scrolling_comment($index, $id_content){
            $response = "";
            $comment = $this->_model->query('select * from komentar natural join user where ID_KONTEN='.$id_content.'');
            //echo count($konten).':'.$index;
            if(count($comment)<$index-3){
                echo -1;
            }else{
                for($i=$index-3;$i<$index;$i++){
                    if(!empty($comment[$i])){
                                echo '
                            <div class="comment" id="comment'.$comment[$i]['ID_KOMENTAR'].'">
                                <div class="avatar">
                                    <img src="'.BASE_URL.'avatar/'.$comment[$i]['AVATAR'].'" alt="avatar" width="64" />
                                </div>
                                <div class="isikomen">';
                                if(!empty($_SESSION['login']) && $comment[$i]['ID_USER']==$_SESSION['id']){
                                    echo 
                                    '<a onclick="delete_comment(\''.BASE_URL.'\', '.$comment[$i]['ID_KOMENTAR'].')"><div class="del-comment right"></div></a>';
                                }
                                echo
                                    '<div class="namecomment">'.$comment[$i]['USERNAME'].'</div>
                                    <div class="timecomment" id="time'.$comment[$i]['ID_KOMENTAR'].'"></div>
                                <script type="text/javascript">setInterval(';echo "'timerCommentar"; echo '("'.BASE_URL.'","time",'.$comment[$i]['ID_KOMENTAR'].',"'.$comment[$i]['WAKTU'].'");'; echo "'"; echo ',250)</script>
                                            '.$comment[$i]['ISI'].'
                                </div>
                            </div>
                                    ';



                    }

                }
                echo $response;      
            }
        }
        
        function check_achievement(){
            if($this->checkFirstPost()){
                $achievement=$this->_model->query('select * from achievement where ID_ACHIEVEMENT=1');
                if(count($achievement)>0)
                    $achievement = $achievement[0];
                    echo '<script type="text/javascript">showAchievement("'.$achievement['NAMA'].'", "'.$achievement['DESKRIPSI'].'", "'.BASE_URL.'img/achievements/'.$achievement['GAMBAR'].'")</script>';
            }
            if($this->checkFirstComment()) {
                $achievement=$this->_model->query('select * from achievement where ID_ACHIEVEMENT=3');
                if(count($achievement)>0)
                    $achievement = $achievement[0];
                    echo '<script type="text/javascript">showAchievement("'.$achievement['NAMA'].'", "'.$achievement['DESKRIPSI'].'", "'.BASE_URL.'img/achievements/'.$achievement['GAMBAR'].'")</script>';
            }
            if($this->checkMoreComment()){
                $achievement=$this->_model->query('select * from achievement where ID_ACHIEVEMENT=4');
                if(count($achievement)>0)
                    $achievement = $achievement[0];
                    echo '<script type="text/javascript">showAchievement("'.$achievement['NAMA'].'", "'.$achievement['DESKRIPSI'].'", "'.BASE_URL.'img/achievements/'.$achievement['GAMBAR'].'")</script>';
            }
            if($this->checkMorePost()){
                $achievement=$this->_model->query('select * from achievement where ID_ACHIEVEMENT=2');
                if(count($achievement)>0)
                    $achievement = $achievement[0];
                    echo '<script type="text/javascript">showAchievement("'.$achievement['NAMA'].'", "'.$achievement['DESKRIPSI'].'", "'.BASE_URL.'img/achievements/'.$achievement['GAMBAR'].'")</script>';
            }
            if($this->checkMoreLike()){
                $achievement=$this->_model->query('select * from achievement where ID_ACHIEVEMENT=5');
                if(count($achievement)>0)
                    $achievement = $achievement[0];
                    echo '<script type="text/javascript">showAchievement("'.$achievement['NAMA'].'", "'.$achievement['DESKRIPSI'].'", "'.BASE_URL.'img/achievements/'.$achievement['GAMBAR'].'")</script>';
            }
            if($this->checkMoreDislike()){
                $achievement=$this->_model->query('select * from achievement where ID_ACHIEVEMENT=6');
                if(count($achievement)>0)
                    $achievement = $achievement[0];
                    echo '<script type="text/javascript">showAchievement("'.$achievement['NAMA'].'", "'.$achievement['DESKRIPSI'].'", "'.BASE_URL.'img/achievements/'.$achievement['GAMBAR'].'")</script>';
            }
            if($this->checkPeopleComment()){
                $achievement=$this->_model->query('select * from achievement where ID_ACHIEVEMENT=7');
                if(count($achievement)>0)
                    $achievement = $achievement[0];
                    echo '<script type="text/javascript">showAchievement("'.$achievement['NAMA'].'", "'.$achievement['DESKRIPSI'].'", "'.BASE_URL.'img/achievements/'.$achievement['GAMBAR'].'")</script>';                
            }
            if($this->checkThreeAchievement()){
                $achievement=$this->_model->query('select * from achievement where ID_ACHIEVEMENT=8');
                if(count($achievement)>0)
                    $achievement = $achievement[0];
                    echo '<script type="text/javascript">showAchievement("'.$achievement['NAMA'].'", "'.$achievement['DESKRIPSI'].'", "'.BASE_URL.'img/achievements/'.$achievement['GAMBAR'].'")</script>';                
            }
            if($this->checkUltimate()){
                $achievement=$this->_model->query('select * from achievement where ID_ACHIEVEMENT=9');
                if(count($achievement)>0)
                    $achievement = $achievement[0];
                    echo '<script type="text/javascript">showAchievement("'.$achievement['NAMA'].'", "'.$achievement['DESKRIPSI'].'", "'.BASE_URL.'img/achievements/'.$achievement['GAMBAR'].'")</script>';                
            }
        }
        function ajax_scrolling_search($index, $id_tag=-1, $sort=-1){
            $response = "";
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
            }else if($sort==3){ // sort view
                $konten=  $this->orderKontenByView($konten);                    
            }
            
            //echo count($konten).':'.$index;
            for($i=$index-3;$i<$index;$i++){
                if(!empty($konten[$i])){
                        echo '
                    <li>
                    <div class="paketkonten ';
                        if($konten[$i]['ID_TYPE']==1) echo 'link';
                        else if($konten[$i]['ID_TYPE']==2) echo 'image';
                        else if($konten[$i]['ID_TYPE']==3) echo 'video';

                        echo 'post">
                        <div class="left iconcontent">
                            <div class="icon';
                        if($konten[$i]['ID_TYPE']==1) echo 'link';
                        else if($konten[$i]['ID_TYPE']==2) echo 'photo';
                        else if($konten[$i]['ID_TYPE']==3) echo 'video';

                        echo '"></div>
                        </div>
                        <div class="headertext judul">
                            <div class="title"><a href="'.BASE_URL.'content_con/content/'.$konten[$i]['ID_KONTEN'].'">'.$konten[$i]['JUDUL'].'</a></div>
                            <div class="uploader"><a href="'.BASE_URL.'user_con/profile/'.$konten[$i]['ID_USER'].'">'.$konten[$i]['NAMA'].'</a></div>
                            <div class="uploaded" id="time'.$konten[$i]['ID_KONTEN'].'"></div>
                                <script type="text/javascript">setInterval(';echo "'timerContent"; echo '("'.BASE_URL.'","time",'.$konten[$i]['ID_KONTEN'].',"'.$konten[$i]['WAKTU'].'");'; echo "'"; echo ',250)</script>
                        </div>
                        <div class="content">';
                        if($konten[$i]['ID_TYPE']==1) 
                            echo '
                            <a href="'.$konten[$i]['LINK'].'"> '.$konten[$i]['LINK'].' </a>
                            <p> '.$konten[$i]['DESKRIPSI'].' </p>
                                ';
                        else if($konten[$i]['ID_TYPE']==2) echo '
                            <img src="'.BASE_URL.'image/'.$konten[$i]['LINK'].'" width="320" alt="beach">
                            ';
                        else if($konten[$i]['ID_TYPE']==3) echo '
                            <iframe width="320" height="240" src="'.$konten[$i]['LINK'].'" frameborder="0" allowfullscreen></iframe>
                            ';


                        echo '</div>
                        <div class="paketjempol">
                            <div class="views"></div>
                            <div class="viewcount" id="view'.$konten[$i]['ID_KONTEN'].'"></div><br/>
                            <div class="likemini"></div>
                            <div class="jumlahlike" id="like'.$konten[$i]['ID_KONTEN'].'"></div>
                            <div class="commentmini"></div>
                            <div class="jumlahkomen" id="comment'.$konten[$i]['ID_KONTEN'].'"></div>
                            <br/>';
                            if(!empty($_SESSION['login'])){
                                if(!empty($konten[$i]['STATUS_USER'])){
                                    echo $konten[$i]['STATUS_USER']=="LIKE" 
                                    ? 
                                    '
                                    <div class="likebutton_pressed" id="likebutton'.$konten[$i]['ID_KONTEN'].'"><a onclick="unlike(\''.BASE_URL.'\','.$konten[$i]['ID_KONTEN'].')"></a></div>
                                    <div class="dislikebutton" id="dislikebutton'.$konten[$i]['ID_KONTEN'].'"><a onclick="undislike(\''.BASE_URL.'\','.$konten[$i]['ID_KONTEN'].')"></a></div>
                                    '
                                    : 
                                    '
                                    <div class="likebutton" id="likebutton'.$konten[$i]['ID_KONTEN'].'"><a onclick="like(\''.BASE_URL.'\','.$konten[$i]['ID_KONTEN'].')"></a></div>
                                    <div class="dislikebutton_pressed" id="dislikebutton'.$konten[$i]['ID_KONTEN'].'"><a onclick="undislike(\''.BASE_URL.'\','.$konten[$i]['ID_KONTEN'].')"></a></div>
                                    ';
                                }else{
                                    echo
                                    '<div class="likebutton" id="likebutton'.$konten[$i]['ID_KONTEN'].'"><a onclick="like(\''.BASE_URL.'\','.$konten[$i]['ID_KONTEN'].')"></a></div>
                                    <div class="dislikebutton" id="dislikebutton'.$konten[$i]['ID_KONTEN'].'"><a onclick="dislike(\''.BASE_URL.'\','.$konten[$i]['ID_KONTEN'].')"></a></div>';
                                }
                            }else{
                                echo '
                                    <div class="likebutton" id="likebutton'.$konten[$i]['ID_KONTEN'].'"><a href="#"></a></div>
                                    <div class="dislikebutton" id="dislikebutton'.$konten[$i]['ID_KONTEN'].'"><a href="#"></a></div>
                                    ';
                            }
                            echo '<div class="tags">
                                Tags : <br/>
                                <ul class="tag">';
                                    for($j=0;$j<count($konten[$i]['TAG']);$j++){
                                        echo '
                                            <li><a href="'.BASE_URL.'content_con/list_content/-1/'.$konten[$i]['TAG'][$j]['ID_TAG'].'">'.$konten[$i]['TAG'][$j]['NAMA_TAG'].'</a></li>
                                            ';
                                    }
                                echo '</ul>
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
