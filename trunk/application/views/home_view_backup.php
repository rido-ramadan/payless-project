        <!-- ::::::::::::::::::::: START OF BODY PART ::::::::::::::::::::: -->
        <div class="pagebar">
            <div class="notification">
                MOST POPULAR CONTENTS
            </div>
        </div>


        <div class="giantbox">
			<?php
				if(!empty($content_most_like)){
					for($i=0;$i<3;$i++){
						if(!empty($content_most_like[$i])){
						echo '
							<div class="';
							if($i>0) echo 'left toppost">';
							else echo 'toppost" style="margin-left: 50px;">';
							echo '
								<div class="headertext contenttitle"><a href="'.BASE_URL.'content_con/content/'.$content_most_like[$i]['ID_KONTEN'].'">'.$content_most_like[$i]['JUDUL'].'</a></div>
								<div class="view"><img src="images/pemandangan.jpg" width="225" alt="Image View"></div>';
                                                                
                                                        if((!empty($_SESSION['login']))){
                                                            echo '
								<div class="likebutton" onclick="voteplus(this.num)" style="margin-top: 70px; margin-left: 86px; float:left;"></div>
								<div class="dislikebutton" onclick="votemin(this.num)" style="margin-top: 70px; margin-left: 163px; position: absolute;"></div>
                                                                ';
                                                        }
                                                        
                                                        echo '
								<div class="likes">
									<img class="left" style="margin: 10px 5px 0 -80px;" src="images/like-mini.png" alt="like"/>
									<div class="left jumlahlike" style="display: inline; margin-left: -55px;">'.($content_most_like[$i]['LIKE']-$content_most_like[$i]['DISLIKE']).'</div>
									<img class="left" style="margin: 0px 5px; margin-top: 10px;" src="images/comment-mini.png" alt="comment"/>
									<div class="jumlahkomen" style="display: inline">'.$content_most_like[$i]['KOMENTAR'].'</div>
								</div>
							</div>
							
						';
						}
					}
				}
                                if(!empty($content_most_comment)){
					for($i=0;$i<3;$i++){
						if(!empty($content_most_comment[$i])){
						echo '
							<div class="';
							if($i>0) echo 'left toppost">';
							else echo 'toppost" style="margin-left: 50px;">';
							echo '
								<div class="headertext contenttitle"><a href="'.BASE_URL.'content_con/content/'.$content_most_comment[$i]['ID_KONTEN'].'">'.$content_most_comment[$i]['JUDUL'].'</a></div>
								<div class="view"><img src="images/pemandangan.jpg" width="225" alt="Image View"></div>';
                                                                
                                                        if((!empty($_SESSION['login']))){
                                                            echo '
								<div class="likebutton" onclick="voteplus(this.num)" style="margin-top: 70px; margin-left: 86px; float:left;"></div>
								<div class="dislikebutton" onclick="votemin(this.num)" style="margin-top: 70px; margin-left: 163px; position: absolute;"></div>
                                                                ';
                                                        }
                                                        
                                                        echo '
								<div class="likes">
									<img class="left" style="margin: 10px 5px 0 -80px;" src="images/like-mini.png" alt="like"/>
									<div class="left jumlahlike" style="display: inline; margin-left: -55px;">'.($content_most_comment[$i]['LIKE']-$content_most_comment[$i]['DISLIKE']).'</div>
									<img class="left" style="margin: 0px 5px; margin-top: 10px;" src="images/comment-mini.png" alt="comment"/>
									<div class="jumlahkomen" style="display: inline">'.$content_most_comment[$i]['KOMENTAR'].'</div>
								</div>
							</div>
							
						';
						}
					}
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
        </div>
        <!-- ::::::::::::::::::::: END OF BODY PART ::::::::::::::::::::: -->