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
					if($konten_like[$i]['STATUS']=="LIKE") $sum_like+=1;
					if($konten_like[$i]['STATUS']=="DISLIKE") $sum_dislike+=1;
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
						$konten[$i]['JUDUL'] = 'VERSI LINK';
						break;
					case 2:
						$konten[$i]['JUDUL'] = 'VERSI IMAGE';
						break;
					case 3:
						$konten[$i]['JUDUL'] = 'VERSI VIDEO';
						break;
				}
			}
			
			$this->set('content_most_like',$konten);
		}
        $this->set('display','Success - My Todo List App');
        $this->loadView("header_view.php");
        $this->loadView("home_view.php");
        $this->loadView("footer_view.php");
    }
}
