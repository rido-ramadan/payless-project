<div class="pagebar">
    <div class="notification">
        Showing results for: <b id="filtermethod"><?php if(!empty($search_input)) echo $search_input?></b>
    </div>
</div>

<div class="detbox">
    <div class="dettop"></div>
    <!-- ::::: USE THIS ONE IF YOUR SEARCH RESULT RETURN NONE ::::: -->
    <div class="detmain hidden" id="result-none" style="text-align: center">
        <div class="headertext" style="text-align: center;">Sorry, we can't find  what you are looking for</div>
        <div class="error404">
            Unfortunately, we can't find what you are looking for. Maybe you can try another words.
        </div>
    </div>
    <!-- ::::: ELSE USE THIS ONE WHEN THERE ARE SOME RESULTS ::::: -->
    <div class="detmain" id="result-some">
        <div class="contentlist">
    <?php
        if(!empty($search_result)){
            echo '<ul class="listcontents">';
            for($i=0;$i<count($search_result);$i++){
                if($search_result[$i]['JENIS']=='user'){
                    echo '
                        <li>
                            <div class="search-user-box">
                                <div class="search-user-avatar">
                                    <a href=""><img width="140" src="'.BASE_URL.'avatar/'.$search_result[$i]['AVATAR'].'" alt="'.$search_result[$i]['USERNAME'].'"></a>
                                </div>
                                <div class="search-user-detail">
                                    <div class="search-user-username"><a href="">'.$search_result[$i]['USERNAME'].'</a></div>
                                    <div class="search-user-fullname">'.$search_result[$i]['NAMA'].'</div>
                                    <div class="search-user-email">'.$search_result[$i]['EMAIL'].'</div>
                                    <div class="search-user-about">
                                        <blockquote>"'.$search_result[$i]['ABOUT_ME'].'"</blockquote>
                                    </div>
                                </div>
                            </div>
                        </li>';
                }else if($search_result[$i]['JENIS']=='konten'){
                    echo '
                        <li>
                        <div class="paketkonten ';
                            if($search_result[$i]['ID_TYPE']==1) echo 'link';
                            else if($search_result[$i]['ID_TYPE']==2) echo 'image';
                            else if($search_result[$i]['ID_TYPE']==3) echo 'video';

                            echo 'post">
                            <div class="left iconcontent">
                                <div class="icon';
                            if($search_result[$i]['ID_TYPE']==1) echo 'link';
                            else if($search_result[$i]['ID_TYPE']==2) echo 'photo';
                            else if($search_result[$i]['ID_TYPE']==3) echo 'video';

                            echo '"></div>
                            </div>
                            <div class="headertext judul">
                                <div class="title"><a href="'.BASE_URL.'content_con/content/'.$search_result[$i]['ID_KONTEN'].'">'.$search_result[$i]['JUDUL'].'</a></div>
                                <div class="uploader"><a href="'.BASE_URL.'user_con/profile/'.$search_result[$i]['ID_USER'].'">'.$search_result[$i]['NAMA'].'</a></div>
                                <div class="uploaded">'.$search_result[$i]['WAKTU'].'</div>
                            </div>
                            <div class="content">';
                            if($search_result[$i]['ID_TYPE']==1) 
                                echo '
                                <a href="'.$search_result[$i]['LINK'].'"> '.$search_result[$i]['LINK'].' </a>
                                <p> '.$search_result[$i]['DESKRIPSI'].' </p>
                                    ';
                            else if($search_result[$i]['ID_TYPE']==2) echo '
                                <img src="'.BASE_URL.'image/'.$search_result[$i]['LINK'].'" width="320" alt="beach">
                                ';
                            else if($search_result[$i]['ID_TYPE']==3) echo '
                                <iframe width="320" height="240" src="'.$search_result[$i]['LINK'].'" frameborder="0" allowfullscreen></iframe>
                                ';


                            echo '</div>
                            <div class="paketjempol">
                                <div class="likemini"></div>
                                <div class="jumlahlike">'.$search_result[$i]['LIKE'].'</div>
                                <div class="commentmini"></div>
                                <div class="jumlahkomen">'.count($search_result[$i]['KOMENTAR']).'</div>
                                <br/>';
                                if(!empty($_SESSION['login'])){
                                    echo '
                                        <div class="likebutton"><a href="'.BASE_URL.'content_con/like/'.$search_result[$i]['ID_KONTEN'].'"></a></div>
                                        <div class="dislikebutton" "><a href="'.BASE_URL.'content_con/dislike/'.$search_result[$i]['ID_KONTEN'].'"></a></div>';
                                    }
                                echo '<div class="tags">
                                    Tags : <br/>
                                    <ul class="tag">';
                                        for($j=0;$j<count($search_result[$i]['TAG']);$j++){
                                            echo '
                                                <li><a href="'.BASE_URL.'content_con/list_content/'.$search_result[$i]['TAG'][$j]['ID_TAG'].'">'.$search_result[$i]['TAG'][$j]['NAMA_TAG'].'</a></li>
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
            echo '</ul>
        <div class="paketgantihalaman">
            <div class="buttonprevious" >PREVIOUS</div>
            <div class="buttonnext" >NEXT</div>
        </div>
                ';
        }else{
            echo '
            <div class="detmain" id="result-none" style="text-align: center">
                <div class="headertext" style="text-align: center;">Sorry, we can\'t find  what you are looking for</div>
                <div class="error404">
                    Unfortunately, we can\'t find what you are looking for. Maybe you can try another words.
                </div>
            </div>
                ';
        }
    ?>
            
        </div>
        

    </div>
    <div class="detbot"></div>
</div>