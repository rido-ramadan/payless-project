
        
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
                        <div class="uploaded"><?php echo $content['WAKTU']?></div>
                    </div>
                    <div class="content">
                        <a href="<?php echo $content['LINK']?>"> <?php echo $content['LINK']?> </a>
                        <p> <?php echo $content['DESKRIPSI']?> </p>
                    </div>
                <div class="paketjempol">
                            <div class="likemini"></div>
                            <div class="jumlahlike"><?php echo $content['LIKE']?></div>
                            <div class="commentmini"></div>
                            <div class="jumlahkomen"><?php echo count($content['KOMENTAR'])?></div>
                            <br/>
                            <div class="likebutton" onclick="voteplus(this.num)"><a href="<?php echo BASE_URL.'content_con/like/'.$content['ID_KONTEN'];?>"></a></div>
                            <div class="dislikebutton" onclick="votemin(this.num)"><a href="<?php echo BASE_URL.'content_con/dislike/'.$content['ID_KONTEN'];?>"></a></div>
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
                    <div class="commentlist">
                        <div class="commenttop"></div>
                        <div class="commentcontainer">
                            <div id="superbaru">

                            </div>
                    <?php
                        if(!empty($content['KOMENTAR'])){
                            for($i=0;$i<count($content['KOMENTAR']);$i++){
                                echo '
                            <div class="comment">
                                <div class="avatar">
                                    <img src="'.$content['KOMENTAR'][$i]['AVATAR'].'" alt="avatar" width="64" />
                                </div>
                                <div class="isikomen">
                                    <div class="del-comment right"><a></a></div>
                                    <div class="namecomment">'.$content['KOMENTAR'][$i]['USERNAME'].'</div>
                                    <div class="timecomment">'.$content['KOMENTAR'][$i]['WAKTU'].'</div>
								'.$content['KOMENTAR'][$i]['ISI'].'
                                </div>
                            </div>
                                    ';
                            }
                        }
                    ?>
                            <div class="comment" style="border-bottom:0px">
                                <div class="avatar">
                                    <img src="<?php echo $_SESSION['avatar']?>" alt="avatar" width="64" />
                                </div>                                
                                <div class="isikomen">
                                    <form method="post" action="<?php echo BASE_URL.'content_con/submit_comment/'.$content['ID_KONTEN']?>">
                                        <div class="your-comment"><textarea rows="2" cols="72" id="ucomment" name="komentar"></textarea></div>
                                        <div class="submit-your-comment"><input type="submit" value="Comment" /></div>
                                    </form>
                                </div>
                            </div>

                   </div>
                    </div>
                </div>
                <div class="filtermethod">
                    <div class="ads" style="margin-top: 40px">
                        <div class="headertext" style="margin: 0 0 0 10px;">Advertisements</div>
                    </div>
                </div>
                <?php }?>
            </div>
            <div class="detbot"></div>
        </div>