<script type="text/javascript">
    <?php if(!empty($gate)) {?>
    setInterval('scroll("<?php echo BASE_URL?>",<?php if(!empty($current_tag)) echo $current_tag; else echo '-1'?>, <?php if(!empty($current_sort)) echo $current_sort; else echo '-1'?>);', 1000);
    <?php }else{?>
    setInterval('scroll_tag("<?php echo BASE_URL?>","<?php if(!empty($input_tag_from_text)) echo $input_tag_from_text;?>");', 1000);
    <?php }?>
</script>
<div id='postedComment'>
            <center>
            </center>
        </div>
<div class="pagebar">
    <div class="notification">
        Show contents by filter: <b id="filtermethod">
        <?php 
            $isi_input_tag="";
            if(empty($current_list_tag)) echo 'NO FILTER';
            else{
                for($j=0;$j<count($current_list_tag);$j++){
                    echo $current_list_tag[$j];
                    $isi_input_tag.=$current_list_tag[$j];
                    if(($j+1)!=count($current_list_tag)){
                        echo ', ';
                        $isi_input_tag.=", ";
                    }
                }
            }
        ?>
        
        </b>| sorted by: <b id="sortingmethod">
        <?php 
            if(!empty($current_sort)){
                if($current_sort==-1) echo "Newest";
                else if($current_sort==1) echo 'Most Popular';
                else echo 'Most Commented';
            }
        ?></b>
    </div>
</div>

        <div class="detbox">
            <div class="dettop"></div>
            <div class="detmain">
                <div class="contentlist" >

                            <?php
//                                if(!empty($konten)){
                                    echo '<ul class="listcontents" id="contentDownList">';
//                                    
//                                    for($i=0;$i<count($konten);$i++){
//                                        echo '
//                                    <li>
//                                    <div class="paketkonten ';
//                                        if($konten[$i]['ID_TYPE']==1) echo 'link';
//                                        else if($konten[$i]['ID_TYPE']==2) echo 'image';
//                                        else if($konten[$i]['ID_TYPE']==3) echo 'video';
//                                        
//                                        echo 'post">
//                                        <div class="left iconcontent">
//                                            <div class="icon';
//                                        if($konten[$i]['ID_TYPE']==1) echo 'link';
//                                        else if($konten[$i]['ID_TYPE']==2) echo 'photo';
//                                        else if($konten[$i]['ID_TYPE']==3) echo 'video';
//                                        
//                                        echo '"></div>
//                                        </div>
//                                        <div class="headertext judul">
//                                            <div class="title"><a href="'.BASE_URL.'content_con/content/'.$konten[$i]['ID_KONTEN'].'">'.$konten[$i]['JUDUL'].'</a></div>
//                                            <div class="uploader"><a href="'.BASE_URL.'user_con/profile/'.$konten[$i]['ID_USER'].'">'.$konten[$i]['NAMA'].'</a></div>
//                                            <div class="uploaded">'.$konten[$i]['WAKTU'].'</div>
//                                        </div>
//                                        <div class="content">';
//                                        if($konten[$i]['ID_TYPE']==1) 
//                                            echo '
//                                            <a href="'.$konten[$i]['LINK'].'"> '.$konten[$i]['LINK'].' </a>
//                                            <p> '.$konten[$i]['DESKRIPSI'].' </p>
//                                                ';
//                                        else if($konten[$i]['ID_TYPE']==2) echo '
//                                            <img src="'.BASE_URL.'image/'.$konten[$i]['LINK'].'" width="320" alt="beach">
//                                            ';
//                                        else if($konten[$i]['ID_TYPE']==3) echo '
//                                            <iframe width="320" height="240" src="'.$konten[$i]['LINK'].'" frameborder="0" allowfullscreen></iframe>
//                                            ';
//                                        
//                                            
//                                        echo '</div>
//                                        <div class="paketjempol">
//                                            <div class="likemini"></div>
//                                            <div class="jumlahlike">'.$konten[$i]['LIKE'].'</div>
//                                            <div class="commentmini"></div>
//                                            <div class="jumlahkomen">'.count($konten[$i]['KOMENTAR']).'</div>
//                                            <br/>';
//                                            if(!empty($_SESSION['login'])){
//                                                echo '
//                                                    <div class="likebutton"><a href="'.BASE_URL.'content_con/like/'.$konten[$i]['ID_KONTEN'].'"></a></div>
//                                                    <div class="dislikebutton" "><a href="'.BASE_URL.'content_con/dislike/'.$konten[$i]['ID_KONTEN'].'"></a></div>';
//                                                }
//                                            echo '<div class="tags">
//                                                Tags : <br/>
//                                                <ul class="tag">';
//                                                    for($j=0;$j<count($konten[$i]['TAG']);$j++){
//                                                        echo '
//                                                            <li><a href="'.BASE_URL.'content_con/list_content/'.$konten[$i]['TAG'][$j]['ID_TAG'].'">'.$konten[$i]['TAG'][$j]['NAMA_TAG'].'</a></li>
//                                                            ';
//                                                    }
//                                                echo '</ul>
//                                            </div>
//                                        </div>
//                                    </div>
//                                </li>
//                                ';
//                                        
//                                        
//                                        
//                                    }
                                    echo '</ul>';
//                                }else{ // tidak ada konten
//                                    echo '<ul class="listcontents">
//                                        <li>
//                                    <div class="paketkonten linkpost">
//                                        <div class="left iconcontent">
//                                            <div class="iconlink"></div>
//                                        </div>
//                                        <div class="headertext judul">
//                                        </div>
//                                        <div class="content">Pencarian tags "';
//                                        if(empty($current_list_tag)) echo 'NO FILTER';
//                                        else{
//                                            for($j=0;$j<count($current_list_tag);$j++){
//                                                echo $current_list_tag[$j];
//                                                if(($j+1)!=count($current_list_tag)){
//                                                    echo ',';
//                                                }
//                                            }
//                                        }
//                                    
//                                    echo '" tidak ditemukan</div>
//
//                                    </div>
//                                </li>
//                                ';
//                                        
//                                        
//                                        
//                                    }
//                                    echo '</ul>';                                
//                                    
                            ?>
                </div>
                <div class="filtermethod">
                    <div class="inputtag">
                        <div class="headertext" style="margin: 10px 0 0 15px;">Filter by Tags</div>
                        <form name="filtertag" action="<?php echo BASE_URL?>content_con/list_content/0" method="post">
                            <div class="tagbar">
                                <span class="sbox_l"></span>
                                <span class="sbox">
                                    <input style="outline-width:0px;" type="text" name="input_tag" value="<?php if(!empty($isi_input_tag)) echo $isi_input_tag?>" placeholder="input tags" >
                                </span>
                                <span class="sbox_r" id="srch_clear"></span>
                            </div>
                            <div class="tagsubmit">
                                <input type="submit"  value="Submit">
                            </div>
                            <div class="sorts">
                                Sort by:
                                <div class="sortingmethod">
                                    <select name="sortmethod" id="Sorting" onchange="sort_content('<?php echo BASE_URL.'content_con/'?>')">
                                        <option value="-1">Newest</option>
                                        <option <?php if(!empty($current_sort) && $current_sort==1) echo 'selected="selected"'?> value="1">Most Popular</option>
                                        <option <?php if(!empty($current_sort) && $current_sort==2) echo 'selected="selected"'?> value="2">Most Commented</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tagclouds">
                        <div class="headertext" style="margin: 0 0 0 10px;">Choose a Tag</div>
                        <div class="tagcloudscontent">
                            <?php 
                                if(!empty($list_tag)){
                                    echo '<a href="#" onclick="tag_link(\''.BASE_URL.'content_con/list_content/-1/-1\')">NO_FILTER</a> ';
                                    for($i=0;$i<count($list_tag);$i++){
                                            //echo '<a href='.BASE_URL.'content_con/list_content/-1/'.$list_tag[$i]['ID_TAG'].'>'.$list_tag[$i]['NAMA_TAG'].'</a>';
                                            echo '<a href="#" onclick="tag_link(\''.BASE_URL.'content_con/list_content/-1/'.$list_tag[$i]['ID_TAG'].'\')">'.$list_tag[$i]['NAMA_TAG'].'</a>';
                                            if(($i+1)!=count($list_tag)){
                                                echo ' ';
                                            }
                                    }                                    
                                }
                            ?>
                        </div>
                    </div>
                    <!--div class="sorting">
                        <div class="headertext" style="margin: 0 0 0 10px;">Sort</div>
                        Sort by:
                        <div class="sortingmethod">
                            <select name="sortmethod" id="Sorting" onchange="sort_content('<?php echo BASE_URL.'content_con/'?>')">
                                <option value="-1">Newest</option>
                                <option <?php if(!empty($current_sort) && $current_sort==1) echo 'selected="selected"'?> value="1">Most Popular</option>
                                <option <?php if(!empty($current_sort) && $current_sort==2) echo 'selected="selected"'?> value="2">Most Commented</option>
                            </select>
                        </div>
                    </div-->
                    <div class="ads">
                        <div class="headertext" style="margin: 0 0 0 10px;">Advertisements</div>
                    </div>
                </div>

                <!--<div class="paketgantihalaman">
                    <div class="buttonprevious" onclick="window.location.href='contents.html'">PREVIOUS</div>
                    <div class="buttonnext" onclick="window.location.href='contents.html'">NEXT</div>
                </div>-->
            </div>
            <div class="detbot"></div>
        </div>