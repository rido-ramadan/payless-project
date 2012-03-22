<?php

class Content_con extends Controller {

	function index(){
            $this->redirect(BASE_URL.'content_con/list_content');
	}
        function list_content(){
            $this->loadView("header_view.php");
            $this->loadView("list_content_view.php");		
            $this->loadView("footer_view.php");            
        }
        function post(){
            $this->loadView("header_view.php");
            $this->loadView("post_view.php");		
            $this->loadView("footer_view.php");            
            
        }
        function content($id){
            if(!empty($id)){
				$konten = $this->getContentFromId($this->getContent(),$id);
				if(!empty($konten)){
					$this->set('content',$konten);
					$this->loadView("header_view.php");
					$this->loadView("content_view.php");		
					$this->loadView("footer_view.php");            					
				}
            }else{
                
            }
        }
		function getContentFromId($konten, $id){
			$result = null;
			$counter=0;
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
						if($konten_like[$i]['STATUS']=="LIKE") $sum_like+=1;
						if($konten_like[$i]['STATUS']=="DISLIKE") $sum_dislike+=1;
					}
					//echo "like=".$sum_like."<br>";
					//echo "dislike=".$sum_dislike."<br>";

					//komentar
					$komen = $this->_model->query('select * from komentar where ID_KONTEN='.$konten[$i]['ID_KONTEN'].'');
					$konten[$i]['KOMENTAR'] = $komen;
					
					$konten[$i]['LIKE'] = $sum_like-$sum_dislike;
					//$konten[$i]['DISLIKE'] = $sum_dislike;
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
				
				$result = $konten;
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
