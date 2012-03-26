        <!-- ::::::::::::::::::::: START OF BODY PART ::::::::::::::::::::: -->
        <div class="pagebar">
            <div class="notification">
                MOST POPULAR CONTENTS
            </div>
        </div>


        		<?php
				if(!empty($content_most_like)){
                                    echo '
                            <div class="detbox" style="padding-left:51px;">
                                        ';
					for($i=0;$i<3;$i++){
						if(!empty($content_most_like[$i])){
						echo '
                                <div class="top-post" id="commented-'.($i+1).'">
                                    <div class="top-'.$content_most_like[$i]['TYPE'].'">
                                        <div class="contenttitle"><a href="'.BASE_URL.'content_con/content/'.$content_most_like[$i]['ID_KONTEN'].'">'.$content_most_like[$i]['JUDUL'].'</a></div>
                                        <div class="view">
                                            ';
                                                if($content_most_like[$i]['TYPE']=='link'){
                                                    echo '
                                                <div class="view-link-url"><a href="'.$content_most_like[$i]['LINK'].'">'.$content_most_like[$i]['LINK'].'</a></div>
                                                <div class="view-link-desc">'.$content_most_like[$i]['DESKRIPSI'].'</div>
                                                        ';
                                                }else if($content_most_like[$i]['TYPE']=='image'){
                                                    echo '
                                                        <div class="view-image">
                                                        <img src="'.$content_most_like[$i]['LINK'].'" width="260" alt="'.$content_most_like[$i]['JUDUL'].'">
                                                            </div>
                                                        ';
                                                }else if($content_most_like[$i]['TYPE']=='video'){
                                                    echo '
                                                     <div class="view-video">
                                                        <div class="view"><iframe width="240" height="180" src="'.$content_most_like[$i]['LINK'].'" ></iframe></div>
                                                    </div>
                                                    ';
                                                }
                                                
                                            echo '
                                        </div>
                                        <div class="basic-features">
                                            <div class="paketjempol">
                                                <div class="likemini"></div>
                                                <div class="jumlahlike">'.$content_most_like[$i]['LIKE'].'</div>
                                                <div class="commentmini"></div>
                                                <div class="jumlahkomen">'.$content_most_like[$i]['KOMENTAR'].'</div>
                                                <br/>
                                                <div class="likebutton" onclick="voteplus(this.num)"><a href="'.BASE_URL.'content_con/like/'.$content_most_like[$i]['ID_KONTEN'].'"></a></div>
                                                <div class="dislikebutton" onclick="votemin(this.num)"><a href="'.BASE_URL.'content_con/dislike/'.$content_most_like[$i]['ID_KONTEN'].'"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                                                
                                                
						}
					}
                                        echo '</div>';
				}
                                ?>
                        <div class="pagebar" style="margin-top: 20px;">
                            <div class="notification">
                                MOST COMMENTED CONTENTS
                            </div>
                        </div>
            
            
                                <?php
                                if(!empty($content_most_comment)){
                                    echo '
                                    <div class="detbox" style="padding-left:51px;">
                                        ';
					for($i=0;$i<3;$i++){
						if(!empty($content_most_comment[$i])){
                                                    
                                                    echo '
                                                <div class="top-post" id="popular-'.($i+1).'">
                                                    <div class="top-'.$content_most_comment[$i]['TYPE'].'">
                                                        <div class="contenttitle"><a href="'.BASE_URL.'content_con/content/'.$content_most_comment[$i]['ID_KONTEN'].'">'.$content_most_comment[$i]['JUDUL'].'</a></div>
                                                        <div class="view">';
                                                        
                                                    if($content_most_like[$i]['TYPE']=='link'){
                                                        echo '
                                                    <div class="view-link-url"><a href="'.$content_most_comment[$i]['LINK'].'">'.$content_most_comment[$i]['LINK'].'</a></div>
                                                    <div class="view-link-desc">'.$content_most_comment[$i]['DESKRIPSI'].'</div>
                                                            ';
                                                    }else if($content_most_comment[$i]['TYPE']=='image'){
                                                        echo '
                                                            <div class="view-image">
                                                            <img src="'.$content_most_comment[$i]['LINK'].'" width="260" alt="'.$content_most_comment[$i]['JUDUL'].'">
                                                                </div>
                                                            ';
                                                    }else if($content_most_comment[$i]['TYPE']=='video'){
                                                        echo '
                                                         <div class="view-video">
                                                            <div class="view"><iframe width="240" height="180" src="'.$content_most_comment[$i]['LINK'].'" ></iframe></div>
                                                        </div>
                                                        ';
                                                    }
                                                        echo '</div>
                                                        <div class="basic-features">
                                                            <div class="paketjempol">
                                                                <div class="likemini"></div>
                                                                <div class="jumlahlike">'.$content_most_comment[$i]['LIKE'].'</div>
                                                                <div class="commentmini"></div>
                                                                <div class="jumlahkomen">'.$content_most_comment[$i]['KOMENTAR'].'</div>
                                                                <br/>
                                                                <div class="likebutton" onclick="voteplus(this.num)"><a href="'.BASE_URL.'content_con/like/'.$content_most_comment[$i]['ID_KONTEN'].'"></a></div>
                                                                <div class="dislikebutton" onclick="votemin(this.num)"><a href="'.BASE_URL.'content_con/dislike/'.$content_most_comment[$i]['ID_KONTEN'].'"></a></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                                        
                                                        
                                                        ';
                                                    
						}
					}
                                        echo '
                                            </div>
                                            ';
				}
				?>
			<!--
            <div class="toppost" style="margin-left: 50px;">
                <div class="headertext contenttitle"><a href="image_view.php">Versi Image</a></div>
                <div class="view"><img src="images/pemandangan.jpg" width="225" alt="Image View"></div>
                <div class="likebutton" onclick="voteplus(this.num)" style="margin-top: 70px; margin-left: 86px; float:left;"></div>
                <div class="dislikebutton" onclick="votemin(this.num)" style="margin-top: 70px; margin-left: 163px; position: absolute;"></div>
                <div class="likes">
                    <img class="left" style="margin: 10px 5px 0 -80px;" src="images/like-mini.png" alt="like"/>
                    <div class="left jumlahlike" style="display: inline; margin-left: -55px;"></div>
                    <img class="left" style="margin: 0px 5px; margin-top: 10px;" src="images/comment-mini.png" alt="comment"/>
                    <div class="jumlahkomen" style="display: inline"></div>
                </div>
            </div>

            <div class="left toppost">
                <div class="headertext contenttitle"><a href="video_view.php">Versi Video</a></div>
                <div class="view"><iframe width="240" height="180" src="http://www.youtube.com/embed/MGtLGuSaVOI" ></iframe></div>
                <div class="likebutton" onclick="voteplus(this.num)" style="margin-top: 59px; margin-left: 86px; float:left;"></div>
                <div class="dislikebutton" onclick="votemin(this.num)" style="margin-top: 59px; margin-left: 163px; position: absolute;"></div>
                <div class="likes">
                    <img class="left" style="margin: 10px 5px 0 -80px;" src="images/like-mini.png" alt="like"/>
                    <div class="left jumlahlike" style="display: inline; margin-left: -55px;"></div>
                    <img class="left" style="margin: 0px 5px; margin-top: 10px;" src="images/comment-mini.png" alt="comment"/>
                    <div class="jumlahkomen" style="display: inline"></div>
                </div>
            </div>

            <div class="left toppost">
                <div class="headertext contenttitle"><a href="link_view.php">Versi Link</a></div>
                <div class="view"><img src="images/9gag.png" width="225" alt="9Gag"></div>
                <div class="likebutton" onclick="voteplus(this.num)" style="margin-top: 72px; margin-left: 86px; float:left;"></div>
                <div class="dislikebutton" onclick="votemin(this.num)" style="margin-top: 72px; margin-left: 163px; position: absolute;"></div>
                <div class="likes">
                    <img class="left" style="margin: 10px 5px 0 -80px;" src="images/like-mini.png" alt="like"/>
                    <div class="left jumlahlike" style="display: inline; margin-left: -55px;"></div>
                    <img class="left" style="margin: 0px 5px; margin-top: 10px;" src="images/comment-mini.png" alt="comment"/>
                    <div class="jumlahkomen" style="display: inline"></div>
                </div>
            </div>
			-->
        <!-- ::::::::::::::::::::: END OF BODY PART ::::::::::::::::::::: -->