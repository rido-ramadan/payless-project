<!DOCTYPE html>
<html>
    <head>
        <title>Payless Project &raquo; Contents</title>
        <script type="text/javascript" src="js/style.js"></script>
        <script type="text/javascript" src="js/navigasi.js"></script>
        <link type="text/css" rel="stylesheet" href="css/header1.css" />
    </head>
    <body onload="randomlike(); randomkomen(); inisialisasi()">
        <!-- ::::::::::::::::::::: START OF HEADER PART ::::::::::::::::::::: -->
        <div class="topbox">
            <div class="nav1">
                <div style="display:inline-block"><a id="logoButton" href="index.php"><img src="img/logo.png" alt="logo" /></a></div>
                <div class="right">
                    <a class="topbutton login" id="loginButton" alt="Log In" onclick="showPopup();"></a>
                    <a class="topbutton signup" href="register_view.php" id="myacctButton" title="Sign Up"></a>
                </div>
            </div>
            <div class="nav2">
                It's a Project without a Payment!
                <div class="right themes">
                    <select name="Tags" onchange="ChangeStyle(this.value)">
                        <option value="1">Select Tags</option>
                        <option value="2">Funny</option>
                        <option value="3">Cool</option>
                        <option value="4">Disgusting</option>
                    </select>
                </div>
            </div>
            <div class="nav3">
                <div id="sort5" class="left"><a href="index.php">Home</a></div>
                <div class="left"><img src="img/divide.png" alt="" /></div>
                <div id="sort2" class="left nav3act"><a href="contents_view.php">Contents</a></div>
                <div class="left"><img src="img/divide.png" alt="" /></div>
                <div id="sort1" class="left"><a href="newpost_view.php">Upload Post</a></div>
                <div class="right">
                    <div id="applesearch">
                        <span class="sbox_l"></span>
                        <span class="sbox">
                            <input style="outline-width:0px;" type="text" id="srch_fld" placeholder="Search" autosave="applestyle_srch" results="5" onkeyup="applesearch.onChange('srch_fld','srch_clear')" />
                        </span>
                        <span class="sbox_r" id="srch_clear"></span>
                    </div>
                </div>
                <div class="right filter">
                    <select name="srch_op" onchange="ChangeStyle(this.value)">
                        <option value="filter-none">No Filter</option>
                        <option value="filter-user">Username</option>
                        <option value="filter-cont">Content</option>
                    </select>
                </div>
            </div>
        </div>
        <div id="overlay"></div>
        <div id="popup" class="popup">
            <div class="loginpopout">
                <div class="topbutton">
                    <span class="lbox_l"></span>
                    <span class="lbox">
                        <input type="text" id="username" placeholder="Username" autosave="applestyle_srch" results="5" onkeyup="applesearch.onChange('srch_fld','srch_clear')" />
                    </span>
                    <span class="lbox_r" id="srch_clear"></span>
                </div>
                <div class="topbutton clear">
                    <span class="lbox_l"></span>
                    <span class="lbox">
                        <input type="password" id="passwd" placeholder="Password" autosave="applestyle_srch" results="5" onkeyup="applesearch.onChange('srch_fld','srch_clear')" />
                    </span>
                    <span class="lbox_r" id="srch_clear"></span>
                </div>
                <span><a class="closelogin" onclick="closePopUp()"></a></span>
                <span><a class="loginbutton login" id="loginButton" alt="Log In"></a></span>
            </div>
        </div>
        <script type="text/javascript" src="js/divPop.js"></script>
        <!-- ::::::::::::::::::::: END OF HEADER PART ::::::::::::::::::::: -->
        
        <div class="detbox">
			<div class="dettop"></div>
			<div class="detmain">

				<div class="paketkonten">
					<div class="left iconcontent">
						<img src="img/icon-link.png">
					</div>
					<div class="headertext judul">
						<a href="link.html">Versi Link</a>
					</div>
					<div class="right paketjempol">
						<img style="float:left; margin: 0px 5px" src="img/like-mini.png">
						<div class="left jumlahlike"></div>
						<img style="float:left; margin: 0px 5px" src="img/comment-mini.png">
						<div class="jumlahkomen"></div>
						<br/>
						<div class="left likebutton" onclick="voteplus(this.num)"></div>
						<div class="dislikebutton" onclick="votemin(this.num)"></div>
					</div>
					<div class="content">
						<a href="http://www.9gag.com"> www.9gag.com </a>
						<p> deskripsinya link ini </p>
					</div>


				</div>

				<div class="paketkonten">
					<div class=" left iconcontent">
						<img src="img/icon-photo.png">
					</div>
					<div class="headertext judul">
						<a href="image.html">Versi Image</a>
					</div>

					<div class="right paketjempol">
						<img style="float:left; margin: 0px 5px" src="img/like-mini.png">
						<div class="left jumlahlike"></div>
						<img style="float:left; margin: 0px 5px" src="img/comment-mini.png">
						<div class="jumlahkomen"></div>
						<br/>
						<div class="left likebutton" onclick="voteplus(this.num)"></div>
						<div class="dislikebutton" onclick="votemin(this.num)"></div>
					</div>

					<div class="content">
						<img src="img/pemandangan.jpg" width="480">
					</div>

				</div>

				<div class="paketkonten">
					<div class=" left iconcontent">
						<img src="img/icon-video.png">
					</div>
					<div class="headertext judul">
						<a href="video.html">Versi Video</a>
					</div>

					<div class="right paketjempol">
						<img style="float:left; margin: 0px 5px" src="img/like-mini.png">
						<div class="left jumlahlike"></div>
						<img style="float:left; margin: 0px 5px" src="img/comment-mini.png">
						<div class="jumlahkomen"></div>
						<br/>
						<div class="left likebutton" onclick="voteplus(this.num)"></div>
						<div class="dislikebutton" onclick="votemin(this.num)"></div>
					</div>

					<div class="content">
						<iframe width="480" height="360" src="http://www.youtube.com/embed/MGtLGuSaVOI" frameborder="0" allowfullscreen></iframe>
					</div>

				</div>

				<div class="paketkonten">
					<div class="left iconcontent">
						<img src="img/icon-link.png">
					</div>
					<div class="headertext judul">
						<a href="link.html">Versi Link</a>
					</div>
					<div class="right paketjempol">
						<img style="float:left; margin: 0px 5px" src="img/like-mini.png">
						<div class="left jumlahlike"></div>
						<img style="float:left; margin: 0px 5px" src="img/comment-mini.png">
						<div class="jumlahkomen"></div>
						<br/>
						<div class="left likebutton" onclick="voteplus(this.num)"></div>
						<div class="dislikebutton" onclick="votemin(this.num)"></div>
					</div>
					<div class="content">
						<a href="http://www.9gag.com"> www.9gag.com </a>
						<p> deskripsinya link ini </p>
					</div>


				</div>

				<div class="paketkonten">
					<div class=" left iconcontent">
						<img src="img/icon-photo.png">
					</div>
					<div class="headertext judul">
						<a href="image.html">Versi Image</a>
					</div>

					<div class="right paketjempol">
						<img style="float:left; margin: 0px 5px" src="img/like-mini.png">
						<div class="left jumlahlike"></div>
						<img style="float:left; margin: 0px 5px" src="img/comment-mini.png">
						<div class="jumlahkomen"></div>
						<br/>
						<div class="left likebutton" onclick="voteplus(this.num)"></div>
						<div class="dislikebutton" onclick="votemin(this.num)"></div>
					</div>

					<div class="content">
						<img src="img/pemandangan.jpg" width="480">
					</div>

				</div>

				<div class="paketkonten">
					<div class=" left iconcontent">
						<img src="img/icon-video.png">
					</div>
					<div class="headertext judul">
						<a href="video.html">Versi Video</a>
					</div>

					<div class="right paketjempol">
						<img style="float:left; margin: 0px 5px" src="img/like-mini.png">
						<div class="left jumlahlike"></div>
						<img style="float:left; margin: 0px 5px" src="img/comment-mini.png">
						<div class="jumlahkomen"></div>
						<br/><div class="left likebutton" onclick="voteplus(this.num)"></div>
						<div class="dislikebutton" onclick="votemin(this.num)"></div>
					</div>

					<div class="content">
						<iframe width="480" height="360" src="http://www.youtube.com/embed/MGtLGuSaVOI" frameborder="0" allowfullscreen></iframe>
					</div>

				</div>

				<div class="paketkonten">
					<div class="left iconcontent">
						<img src="img/icon-link.png">
					</div>
					<div class="headertext judul">
						<a href="link.html">Versi Link</a>
					</div>
					<div class="right paketjempol">
						<img style="float:left; margin: 0px 5px" src="img/like-mini.png">
						<div class="left jumlahlike"></div>
						<img style="float:left; margin: 0px 5px" src="img/comment-mini.png">
						<div class="jumlahkomen"></div>
						<br/><div class="left likebutton" onclick="voteplus(this.num)"></div>
						<div class="dislikebutton" onclick="votemin(this.num)"></div>
					</div>
					<div class="content">
						<a href="http://www.9gag.com"> www.9gag.com </a>
						<p> deskripsinya link ini </p>
					</div>


				</div>

				<div class="paketkonten">
					<div class=" left iconcontent">
						<img src="img/icon-photo.png">
					</div>
					<div class="headertext judul">
						<a href="image.html">Versi Image</a>
					</div>

					<div class="right paketjempol">
						<img style="float:left; margin: 0px 5px" src="img/like-mini.png">
						<div class="left jumlahlike"></div>
						<img style="float:left; margin: 0px 5px" src="img/comment-mini.png">
						<div class="jumlahkomen"></div>
						<br/><div class="left likebutton" onclick="voteplus(this.num)"></div>
						<div class="dislikebutton" onclick="votemin(this.num)"></div>
					</div>

					<div class="content">
						<img src="img/pemandangan.jpg" width="480">
					</div>

				</div>

				<div class="paketkonten">
					<div class=" left iconcontent">
						<img src="img/icon-video.png">
					</div>
					<div class="headertext judul">
						<a href="video.html">Versi Video</a>
					</div>

					<div class="right paketjempol">
						<img style="float:left; margin: 0px 5px" src="img/like-mini.png">
						<div class="left jumlahlike"></div>
						<img style="float:left; margin: 0px 5px" src="img/comment-mini.png">
						<div class="jumlahkomen"></div>
						<br/><div class="left likebutton" onclick="voteplus(this.num)"></div>
						<div class="dislikebutton" onclick="votemin(this.num)"></div>
					</div>

					<div class="content">
						<iframe width="480" height="360" src="http://www.youtube.com/embed/MGtLGuSaVOI" frameborder="0" allowfullscreen></iframe>
					</div>

				</div>

				<div class="paketkonten">
					<div class=" left iconcontent">
						<img src="img/icon-video.png">
					</div>
					<div class="headertext judul">
						<a href="video.html">Versi Video</a>
					</div>

					<div class="right paketjempol">
						<img style="float:left; margin: 0px 5px" src="img/like-mini.png">
						<div class="left jumlahlike"></div>
						<img style="float:left; margin: 0px 5px" src="img/comment-mini.png">
						<div class="jumlahkomen"></div>
						<br/><div class="left likebutton" onclick="voteplus(this.num)"></div>
						<div class="dislikebutton" onclick="votemin(this.num)"></div>
					</div>

					<div class="content">
						<iframe width="480" height="360" src="http://www.youtube.com/embed/MGtLGuSaVOI" frameborder="0" allowfullscreen></iframe>
					</div>

				</div>

				<div class="paketgantihalaman">
					<div class="left buttonprevious" onclick="window.location.href='contents.html'"></div>
					<div class="left buttonnext" onclick="window.location.href='contents.html'"></div>
				</div>
			</div>
			<div class="detbot"></div>
		</div>

        <!-- ::::::::::::::::::::: START OF FOOTER PART ::::::::::::::::::::: -->
        <div class="footer">
            &copy; Payless Project 2012. Created by: <a href="http://masphei.ungu.com">Masphei</a>, <a href="http://personanonymous.wordpress.com">Edgar Drake</a>, <a href="http://marchygabe.tumblr.com">Marchy Gabe</a>
        </div>
        <!-- ::::::::::::::::::::: END OF FOOTER PART ::::::::::::::::::::: -->
        <script type="text/javascript" src="js/styleBox.js"></script>
    </body>
</html>