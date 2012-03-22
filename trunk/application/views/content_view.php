
        <div class="detbox">
            <div class="dettop"></div>
            <div class="detmain">
                <div class="paketkontenmasuk">
                    <div class="left iconcontent">
                        <img src="img/icon-link.png" alt="icon"/>
                    </div>
                    <div class="headertext judul">
                        <a href=""><?php if(!empty($content)) echo $content['JUDUL']?></a>
                    </div>
                    <div class="contentmasuk">
                        <?php if(!empty($content)) echo $content['LINK']?>
                    </div>
                </div>
                <div class="right paketjempol">
						<div class="left likebutton" onclick="voteplus(this.num)"></div>
						<div class="dislikebutton" onclick="votemin(this.num)"></div>
					</div>
				<div class="tulisan"> <div class="jumlahlike" style="display:inline-block"> <?php if(!empty($content)) echo $content['LIKE']?></div> likes </div>

                <div class="commenttop"></div>
                <div class="commentcontainer">

                    <div id="superbaru">

						</div>

                        <div class="comment">
                            <div class="left avatar">
                                <img style="/*float:left;*/ margin: 2px;" src="img/avatar.png" alt="avatar" width="64" />
                            </div>
                            <div class="isikomen">
                                <br/><div class="namecomment">username</div><div class="timecomment">Mon, 07 Mar 2012 18:06:56 GMT</div>
								comment nomor satu tentu saja ini
                            </div>
                        </div>
                        <div class="comment">
                            <div class="left avatar">
                                <img style="/*float:left;*/ margin: 2px;" src="img/avatar.png" alt="avatar" width="64" />
                            </div>
                            <div class="isikomen">
                                <br/><div class="namecomment">username</div><div class="timecomment">Mon, 07 Mar 2012 16:06:56 GMT</div>
								comment nomor dua tentu saja ini
                            </div>
                        </div>
                        <div class="comment">	<div class="left avatar">
                                <img style="margin: 2px;" src="img/avatar.png" alt="avatar" width="64" />
                            </div>
                            <div class="isikomen">
                                <br/><div class="namecomment">username</div><div class="timecomment">Mon, 07 Mar 2012 10:00:12 GMT</div>
								<div>comment nomor tiga tentu saja ini</div>
                            </div>
                        </div>
                    <div class="comment" style="border-bottom:0px">
						<div class="isikomen">
							<div><textarea rows="3" cols="59" id="ucomment"></textarea></div>
                            <input style="margin-left:425px" type="submit" value="Comment" onclick="comment()"/>
						</div>
					</div>
                </div>
                <div class="commentbottom"></div>
            </div>
            <div class="detbot"></div>
        </div>