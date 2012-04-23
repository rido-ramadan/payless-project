<script type="text/javascript">
    //setInterval('checkNewContent()', 1000);
    //interval=setInterval('scrollComment("<?php echo BASE_URL?>",<?php if(!empty($content)) echo $content['ID_KONTEN']; else echo '-1'?>);', 1000);
</script>    
        <div class="detbox">
            <div class="dettop"></div>
            <div class="detmain">
                <?php 
                            if(!empty($content)){?>
                <div class="contentlist">
                    <div class="paketkonten linkpost">
                        <div class="left iconcontent">
                        <?php
                                if($content['ID_TYPE']==1)
                                    echo '
                                    <div class="iconlink"></div>
                                        ';
                                else if($content['ID_TYPE']==2)
                                    echo '
                                    <div class="iconphoto"></div>
                                        ';
                                else
                                    echo '
                                    <div class="iconvideo"></div>
                                        ';
                        ?>
                    </div>
                    <div class="headertext judul">
                        <div class="title"><a href="#"><?php echo $content['JUDUL']?></a></div>
                        <div class="uploader"><a href="<?php echo BASE_URL.'user_con/profile/'.$content['ID_USER']?>"><?php echo $content['NAMA']?></a></div>
                        <div class="uploaded" <?php echo 'id="time'.$content['ID_KONTEN'].'"';?>></div>
                        <div class="uploaded" ></div>
                        <?php 
                            echo '<script type="text/javascript">setInterval(';echo "'timerContent"; echo '("'.BASE_URL.'","time",'.$content['ID_KONTEN'].',"'.$content['WAKTU'].'");'; echo "'"; echo ',250)</script>';
                        ?>
                    </div>
                    <div class="content">
                        <?php
                            if($content['ID_TYPE']==1)
                                echo '<a href="'.$content['LINK'].'"> '.$content['LINK'].' </a>
                                <p> '.$content['DESKRIPSI'].' </p>';
                            else if($content['ID_TYPE']==2)
                                echo '
                                <img src="'.BASE_URL.'image/'.$content['LINK'].'" width="320" alt="beach">
                                    ';
                            else
                                echo '
                                <iframe width="320" height="240" src="'.$content['LINK'].'" frameborder="0" allowfullscreen></iframe>
                                    ';
                        ?>
                    </div>
                <div class="paketjempol">
                    <div class="views"></div>
                    <div class="viewcount" <?php echo 'id="view'.$content['ID_KONTEN'].'"'?>></div><br/>
                            <div class="likemini"></div>
                            <div class="jumlahlike" <?php echo 'id="like'.$content['ID_KONTEN'].'"'?>></div>
                            <div class="commentmini"></div>
                            <div class="jumlahkomen" <?php echo 'id="comment'.$content['ID_KONTEN'].'"'?>></div>
                            <br/>
                            <?php 
                            if(!empty($_SESSION['login'])){
                                if(!empty($content['STATUS_USER'])){
                                    echo $content['STATUS_USER']=="LIKE" 
                                    ? 
                                    '
                                    <div class="likebutton_pressed" id="likebutton'.$content['ID_KONTEN'].'"><a onclick="unlike(\''.BASE_URL.'\','.$content['ID_KONTEN'].')"></a></div>
                                    <div class="dislikebutton" id="dislikebutton'.$content['ID_KONTEN'].'"><a onclick="undislike(\''.BASE_URL.'\','.$content['ID_KONTEN'].')"></a></div>
                                    '
                                    : 
                                    '
                                    <div class="likebutton" id="likebutton'.$content['ID_KONTEN'].'"><a onclick="like(\''.BASE_URL.'\','.$content['ID_KONTEN'].')"></a></div>
                                    <div class="dislikebutton_pressed" id="dislikebutton'.$content['ID_KONTEN'].'"><a onclick="undislike(\''.BASE_URL.'\','.$content['ID_KONTEN'].')"></a></div>
                                    ';
                                }else{
                                    echo
                                    '<div class="likebutton" id="likebutton'.$content['ID_KONTEN'].'"><a onclick="like(\''.BASE_URL.'\','.$content['ID_KONTEN'].')"></a></div>
                                    <div class="dislikebutton" id="dislikebutton'.$content['ID_KONTEN'].'"><a onclick="dislike(\''.BASE_URL.'\','.$content['ID_KONTEN'].')"></a></div>';
                                }
                            }else{
                                echo '
                                    <div class="likebutton" id="likebutton'.$content['ID_KONTEN'].'"><a href="#"></a></div>
                                    <div class="dislikebutton" id="dislikebutton'.$content['ID_KONTEN'].'"><a href="#"></a></div>
                                    ';
                            }
                            ?>
                            <div class="tags">
                                Tags : <br/>
                                <ul class="tag">
                                    <?php
                                        for($j=0;$j<count($content['TAG']);$j++){
                                            echo '
                                                <li>'.$content['TAG'][$j]['NAMA_TAG'].'</li>
                                                ';
                                        }
                                    
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="commentlist" id="commentlist">
                        <div class="commenttop"></div>
                        <div class="commentcontainer" >
                            <div id="commentDownList">
                            <!--<div id="superbaru">

                            </div>-->
                    <?php
//                        if(!empty($content['KOMENTAR'])){
//                            for($i=0;$i<count($content['KOMENTAR']);$i++){
//                                echo '
//                            <div class="comment" id="comment'.$content['KOMENTAR'][$i]['ID_KOMENTAR'].'">
//                                <div class="avatar">
//                                    <img src="'.BASE_URL.'avatar/'.$content['KOMENTAR'][$i]['AVATAR'].'" alt="avatar" width="64" />
//                                </div>
//                                <div class="isikomen">';
//                                if(!empty($_SESSION['login']) && $content['KOMENTAR'][$i]['ID_USER']==$_SESSION['id']){
//                                    echo 
//                                    '<a onclick="delete_comment(\''.BASE_URL.'\', '.$content['KOMENTAR'][$i]['ID_KOMENTAR'].')"><div class="del-comment right"></div></a>';
//                                }
//                                echo
//                                    '<div class="namecomment">'.$content['KOMENTAR'][$i]['USERNAME'].'</div>
//                                    <div class="timecomment">'.$content['KOMENTAR'][$i]['WAKTU'].'</div>
//								'.$content['KOMENTAR'][$i]['ISI'].'
//                                </div>
//                            </div>
//                                    ';
//                            }
//                        }
                    echo '</div>';
                        if(!empty($_SESSION['login'])){
                            echo '
                                <div class="comment" style="border-bottom:0px">
                                    <div class="avatar">
                                        <img src="'.BASE_URL.'avatar/'.$_SESSION['avatar'].'" alt="avatar" width="64" />
                                    </div>                                
                                    <div class="isikomen">
                                        <form method="post" action="'.BASE_URL.'content_con/submit_comment/'.$content['ID_KONTEN'].'">
                                            <div class="your-comment"><textarea rows="2" cols="72" id="ucomment" name="komentar"></textarea></div>
                                            <div class="submit-your-comment"><input type="button" onclick="submit_comment(\''.BASE_URL.'\', '.$content['ID_KONTEN'].')" value="Comment" /></div>
                                        </form>
                                    </div>
                                </div>';
                        }
                        ?>

                        </div><!--
                        <div class="paketgantihalaman">
                            <div class="buttonprevious" onclick="window.location.href='contents.html'">PREVIOUS</div>
                            <div class="buttonnext" onclick="window.location.href='contents.html'">NEXT</div>
                        </div>-->
                    </div>
                </div>
                <div class="filtermethod">
                    <div class="ads" style="margin-top: 40px">
                        <div class="headertext" style="margin: 0 0 0 10px;">Advertisements</div>
                        <div class="advertises">
                            <img src="<?php echo BASE_URL ?>img/teh_kotak_ads.jpg" alt="Teh Kotak Broo...">
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
            <div class="detbot"></div>
        </div>