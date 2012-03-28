<?php

class Home_con extends Controller {
    function index(){
		$list_tag = $this->_model->query('select * from tag');
		if(count($list_tag)>0){
			$this->set('list_tag',$list_tag);
		}
			//for($i=0;$i<count($list_tag);$i++)
				//echo $list_tag[$i]['NAMA_TAG'];
		$konten = $this->_model->query('select * from konten');
		//echo count($konten);
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
				
				if(count($komen)>0){
                                    $konten[$i]['KOMENTAR'] = count($komen);
				}else $konten[$i]['KOMENTAR'] = 0;
                                
				$konten[$i]['LIKE'] = $sum_like;
				$konten[$i]['DISLIKE'] = $sum_dislike;
                                switch($konten[$i]['ID_TYPE']){
                                    case 1:
                                        $konten[$i]['TYPE']='link';
                                        break;
                                    case 2:
                                        $konten[$i]['TYPE']='image';
                                        break;
                                    case 3:
                                        $konten[$i]['TYPE']='video';
                                        break;
                                }
//				switch($konten[$i]['ID_TYPE']){
//					case 1:
//						$konten[$i]['JUDUL'] = 'VERSI LINK';
//						break;
//					case 2:
//						$konten[$i]['JUDUL'] = 'VERSI IMAGE';
//						break;
//					case 3:
//						$konten[$i]['JUDUL'] = 'VERSI VIDEO';
//						break;
//				}
			}
			
			$this->set('content_most_like',$this->orderKontenByLike($konten));
			$this->set('content_most_comment',$this->orderKontenByKomentar($konten));
		}
        $this->set('title_page', 'Homepage');
        $this->loadView("header_view.php");
        $this->loadView("home_view.php");
        $this->loadView("footer_view.php");
    }
    function submit_search(){
        $search = $_POST['search'];
        $filter = $_POST['srch_op'];
        echo substr_count("asdasdasdkjhasd asd asd ssa", 'as'); 
        if(!empty($search) && !empty($filter) && strlen($search)<45){
            if($filter=='filter-none'){
                $user = $this->_model->query('select * from user');
                $result_user =$this->filterUser($user, $search);
                $this->set('search_result', $result_user);

                $konten = $this->getContent();
                $result_konten =$this->filterKonten($konten, $search);
                $this->set('search_result', $result_user);
                
            }else if($filter=='filter-user'){
                $user = $this->_model->query('select * from user');
                $result =$this->filterUser($user, $search);
                $this->set('search_result', $result);

            }else if($filter=='filter-cont'){
                $konten = $this->getContent();
                $result =$this->filterKonten($konten, $search);
                $this->set('search_result', $result);
                
            }
            $this->loadView("header_view.php");
            $this->loadView("search_view.php");
            $this->loadView("footer_view.php");
        }else{
            $this->redirect(BASE_URL.'home_con/');
        }
    }
    function filterUser($user, $filter){
        $result = Array();
        $counter=0;
        $filter = strtolower($filter);
        for($i=0;$i<count($user);$i++){
            //echo $user[$i]['NAMA'].' :<br>';
            //echo strpos($user[$i]['NAMA'], $filter).'<br>';
            $user[$i]['JENIS'] = 'user';
            if(strpos(strtolower($user[$i]['NAMA']), $filter)!==false){
                //echo $user[$i]['NAMA'].' ada<br>';
                
                if(!$this->existUser($result, $user[$i]['ID_USER'])){
                    $result[$counter] = $user[$i];
                    $result[$counter]['JENIS'] = 'user';
//                    echo $user[$i]['NAMA'].'<br>';
                    $counter+=1;
                }
            }else if(strpos(strtolower($user[$i]['EMAIL']), $filter)!==false){
                if(!$this->existUser($result, $user[$i]['ID_USER'])){
                    $result[$counter] = $user[$i];
                    $result[$counter]['JENIS'] = 'user';
//                    echo $user[$i]['EMAIL'].'<br>';
                    $counter+=1;
                }
            }else if(strpos(strtolower ($user[$i]['ABOUT_ME']), $filter)!==false){
                if(!$this->existUser($result, $user[$i]['ID_USER'])){
                    $result[$counter] = $user[$i];
                    $result[$counter]['JENIS'] = 'user';
//                    echo $user[$i]['ABOUT_ME'].'<br>';
                    $counter+=1;
                }
            }
        }
        return $result;
    }
    function existUser($user, $id){
        $found = false;
        $counter=0;
        while((!$found)&&($counter<count($user))){
            if($user[$counter]['ID_USER']==$id){
                $found = true;
            }
            $counter+=1;
        }
        return $found;
    }
    function filterKonten($konten, $filter){
        $result = Array();
        $counter=0;
        $filter = strtolower($filter);
        for($i=0;$i<count($konten);$i++){
            //echo $user[$i]['NAMA'].' :<br>';
            //echo strpos($user[$i]['NAMA'], $filter).'<br>';
            if(strpos(strtolower($konten[$i]['JUDUL']), $filter)!==false){
                //echo $user[$i]['NAMA'].' ada<br>';
                
                if(!$this->existUser($result, $konten[$i]['ID_KONTEN'])){
                    $result[$counter] = $konten[$i];
                    $result[$counter]['JENIS'] = 'konten';
//                    echo $konten[$i]['JUDUL'].'<br>';
                    $counter+=1;
                }
            }else{ // tag
                for($j=0;$j<count($konten[$i]['TAG']);$j++){
                    if(strpos(strtolower($konten[$i]['TAG'][$j]['NAMA_TAG']), $filter)!==false){
                        if(!$this->existKonten($result, $konten[$i]['ID_KONTEN'])){
                            $result[$counter] = $konten[$i];
                            $result[$counter]['JENIS'] = 'konten';
//                            echo $konten[$i]['JUDUL'].'<br>';
//                            echo $konten[$i]['TAG'][$j]['NAMA_TAG'].'<br>';
                            $counter+=1;
                        }                        
                    }
                }
            }
        }
        return $result;
    }
    function existKonten($konten, $id){
        $found = false;
        $counter=0;
        while((!$found)&&($counter<count($konten))){
            if($konten[$counter]['ID_USER']==$id){
                $found = true;
            }
            $counter+=1;
        }
        return $found;
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
    function ajax_search($str, $method){
        $query = $this->_model->query('select * from user');
        for($i=0;$i<count($query);$i++){
            $username[$i]=$query[$i]['NAMA'];
            $link_user[$i]=BASE_URL.'user_con/profile/'.$query[$i]['ID_USER'];
        }

        $query2 = $this->_model->query('select * from konten');
        for($i=0;$i<count($query2);$i++){
            $content[$i]=$query2[$i]['JUDUL'];
            $link_content[$i]=BASE_URL.'content_con/content/'.$query2[$i]['ID_KONTEN'];
        }

        $nofilter = $username;
        $nofilter_link = $link_user;
        foreach ($content as $value) {
            $nofilter[] = $value;
        }
        foreach ($link_content as $value) {
            $nofilter_link[] = $value;
        }

        //get the q parameter from URL
        $q = $str;
        $f = $method;

        if ($f == "filter-none") {
            $a = $nofilter;
            $b = $nofilter_link;
        } else if ($f == "filter-user") {
            $a = $username;
            $b = $link_user;
        } else if ($f == "filter-cont") {
            $a = $content;
            $b = $link_content;
        }

        //lookup all hints from array if length of q>0
        if (strlen($q) > 0) {
            $hint = "";
            for ($i = 0; $i < count($a); $i++) {
                if (strtolower($q) == strtolower(substr($a[$i], 0, strlen($q)))) {
                    if ($hint == "") {
                        //echo "hint kosong=".$hint;
                        $hint = "<li>" . "<a href='".$b[$i]."'>" . $a[$i] . '</a>' . "</li>";
                    } 
                    else {
                        //echo "hint isi=".$hint;
                        $hint = $hint . "<li>" . "<a href='".$b[$i]."'>" . $a[$i] . '</a>' . "</li>";
                    }
                }
            }
        }

        // Set output to "no suggestion" if no hint were found
        // or to the correct values
        if ($hint == "") {
            $response = "No Suggestion";
        } else {
            $response = $hint;
        }

        //output the response
        echo $response;        
    }
}
