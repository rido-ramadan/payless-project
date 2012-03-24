<?php

class Content_con extends Controller {

	function index(){
            $this->redirect(BASE_URL.'content_con/list_content');
	}
        function list_content($id_tag=-1, $sort=-1){
            $list_tag = $this->_model->query('select * from tag');
                if(count($list_tag)>0){
                        $this->set('list_tag',$list_tag);
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
        function submit_tag(){
            if(empty($_POST['input_tag'])){
                $this->redirect(BASE_URL.'content_con');
            }
            
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
                            $this->redirect(BASE_URL.'content_con');
                        }
                        else{
                            if(empty($_POST['description']))
                                $this->set('empty','description');
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
                            $id_user = $_SESSION['id'];
                            $id_type = 2;
                            $waktu = date("Y-m-d H:i:s");
                            $judul = $_POST['title'];
                            $link = BASE_URL.'image/'.$fileName;
                            $desc = "";
                            $insert = 'insert into konten (ID_USER, ID_TYPE, WAKTU, JUDUL, LINK, DESKRIPSI) 
                                values ("'.$id_user.'", "'.$id_type.'",
                                    "'.$waktu.'", "'.$judul.'",
                                        "'.$link.'", "'.$desc.'"
                                    )';
                            $this->_model->query($insert);
                            $this->redirect(BASE_URL.'content_con');

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
                    if(!empty($_POST['link'])){
                        $valid = true;
                        $id_user = $_SESSION['id'];
                        $id_type = 3;
                        $waktu = date("Y-m-d H:i:s");
                        $judul = $_POST['title'];
                        $link = $_POST['link'];
                        $desc = "";
                        $insert = 'insert into konten (ID_USER, ID_TYPE, WAKTU, JUDUL, LINK, DESKRIPSI) 
                            values ("'.$id_user.'", "'.$id_type.'",
                                "'.$waktu.'", "'.$judul.'",
                                    "'.$link.'", "'.$desc.'"
                                )';
                        $this->_model->query($insert);
                        $this->redirect(BASE_URL.'content_con');
                    }
                    else{
                        if(empty($_POST['link']))
                            $this->set('empty','link');
                    }
                }
            }
            if(!$valid){
                $this->loadView("header_view.php");
                $this->loadView("post_view.php");		
                $this->loadView("footer_view.php");            					
            }else{
                
            }
            
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
        function content($id){
            if(!empty($id)){
                $konten = $this->getContentFromId($this->getContent(),$id);
                if(!empty($konten)){
                    if($konten!=null){
                        $komentar = $this->_model->query('select * from komentar natural join user where ID_KONTEN='.$konten['ID_KONTEN'].'');
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
            $konten = $this->_model->query('select * from konten');
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
                    //$konten[$i]['DISLIKE'] = $sum_dislike;
//                                switch($konten[$i]['ID_TYPE']){
//                                        case 1:
//                                                $konten[$i]['JUDUL'] = 'VERSI LINK';
//                                                break;
//                                        case 2:
//                                                $konten[$i]['JUDUL'] = 'VERSI IMAGE';
//                                                break;
//                                        case 3:
//                                                $konten[$i]['JUDUL'] = 'VERSI VIDEO';
//                                                break;
//                                }
                }
                $result = $konten;
            }
            return $result;
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
}
