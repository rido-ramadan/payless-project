<div class="pagebar">
    <div class="notification">
        Show contents by filter: <b id="filtermethod">NO FILTER</b>, sorted by: <b id="sortingmethod">NEWEST</b>
    </div>
</div>

        <div class="detbox">
            <div class="dettop"></div>
            <div class="detmain">
                <div class="contentlist">

                            <?php
                                if(!empty($konten)){
                                    echo '<ul class="listcontents">';
                                    
                                    for($i=0;$i<count($konten);$i++){
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
                                            <div class="uploaded">'.$konten[$i]['WAKTU'].'</div>
                                        </div>
                                        <div class="content">';
                                        if($konten[$i]['ID_TYPE']==1) 
                                            echo '
                                            <a href="'.$konten[$i]['LINK'].'"> '.$konten[$i]['LINK'].' </a>
                                            <p> '.$konten[$i]['DESKRIPSI'].' </p>
                                                ';
                                        else if($konten[$i]['ID_TYPE']==2) echo '
                                            <img src="'.$konten[$i]['LINK'].'" width="320" alt="beach">
                                            ';
                                        else if($konten[$i]['ID_TYPE']==3) echo '
                                            <iframe width="320" height="240" src="'.$konten[$i]['LINK'].'" frameborder="0" allowfullscreen></iframe>
                                            ';
                                        
                                            
                                        echo '</div>
                                        <div class="paketjempol">
                                            <div class="likemini"></div>
                                            <div class="jumlahlike">'.$konten[$i]['LIKE'].'</div>
                                            <div class="commentmini"></div>
                                            <div class="jumlahkomen">'.count($konten[$i]['KOMENTAR']).'</div>
                                            <br/>
                                            <div class="likebutton" ><a href="'.BASE_URL.'content_con/like/'.$konten[$i]['ID_KONTEN'].'"></a></div>
                                            <div class="dislikebutton" "><a href="'.BASE_URL.'content_con/dislike/'.$konten[$i]['ID_KONTEN'].'"></a></div>
                                            <div class="tags">
                                                Tags : <br/>
                                                <ul class="tag">';
                                                    for($j=0;$j<count($konten[$i]['TAG']);$j++){
                                                        echo '
                                                            <li>'.$konten[$i]['TAG'][$j]['NAMA_TAG'].'</li>
                                                            ';
                                                    }
                                                echo '</ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                ';
                                        
                                        
                                        
                                    }
                                    echo '</ul>';
                                }
                            ?>
                </div>
                <div class="filtermethod">
                    <div class="inputtag">
                        <div class="headertext" style="margin: 10px 0 0 15px;">Filter by Tags</div>
                        <form name="filtertag" action="" method="post">
                            <div class="tagbar">
                                <span class="sbox_l"></span>
                                <span class="sbox">
                                    <input style="outline-width:0px;" type="text" name="inputtag" placeholder="input tags" >
                                </span>
                                <span class="sbox_r" id="srch_clear"></span>
                            </div>
                            <div class="tagsubmit">
                                <input type="submit" name="submittag" value="Submit">
                            </div>
                        </form>
                    </div>
                    <div class="tagclouds">
                        <div class="headertext" style="margin: 0 0 0 10px;">Choose a Tag</div>
                        <div class="tagcloudscontent">
                            9gag Funny Star Wars Pokemon Tugas Besar Artificial Intelligence Angry Birds
                        </div>
                    </div>
                    <div class="sorting">
                        <div class="headertext" style="margin: 0 0 0 10px;">Sort</div>
                        Sort by:
                        <div class="sortingmethod">
                            <select name="sortmethod" onchange="">
                                <option value="newest">Newest First</option>
                                <option value="popularity">Most Popular First</option>
                                <option value="mostcommented">Most Commented First</option>
                            </select>
                        </div>
                    </div>
                    <div class="ads">
                        <div class="headertext" style="margin: 0 0 0 10px;">Advertisements</div>
                    </div>
                </div>

                <div class="paketgantihalaman">
                    <div class="buttonprevious" onclick="window.location.href='contents.html'">PREVIOUS</div>
                    <div class="buttonnext" onclick="window.location.href='contents.html'">NEXT</div>
                </div>
            </div>
            <div class="detbot"></div>
        </div>