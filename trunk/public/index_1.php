<!DOCTYPE html>
<html>
    <head>
        <title>Payless Project &raquo; Homepage</title>
        <script type="text/javascript" src="js/style.js"></script>
        <script type="text/javascript" src="js/navigasi.js"></script>
        <link type="text/css" rel="stylesheet" href="css/header1.css" />
    </head>
    <body onload="randomlike(); randomkomen(); inisialisasi()">
        <!-- ::::::::::::::::::::: START OF HEADER PART ::::::::::::::::::::: -->
        <div class="topbox">
            <div class="nav1">
                <div style="display:inline-block"><a id="logoButton" href="index.php"><img src="images/logo.png" alt="logo" /></a></div>
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
                <div class="left"><img src="images/divide.png" alt="" /></div>
                <div id="sort2" class="left nav3act"><a href="contents_view.php">Contents</a></div>
                <div class="left"><img src="images/divide.png" alt="" /></div>
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

        <!-- ::::::::::::::::::::: START OF BODY PART ::::::::::::::::::::: -->
        <div class="giantbox">
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
        </div>
        <!-- ::::::::::::::::::::: END OF BODY PART ::::::::::::::::::::: -->

        <!-- ::::::::::::::::::::: START OF FOOTER PART ::::::::::::::::::::: -->
        <div class="footer">
            &copy; Payless Project 2012. Created by: <a href="http://masphei.ungu.com">Masphei</a>, <a href="http://personanonymous.wordpress.com">Edgar Drake</a>, <a href="http://marchygabe.tumblr.com">Marchy Gabe</a>
        </div>
        <!-- ::::::::::::::::::::: END OF FOOTER PART ::::::::::::::::::::: -->
        
        <script type="text/javascript" src="js/styleBox.js"></script>
    </body>
</html>