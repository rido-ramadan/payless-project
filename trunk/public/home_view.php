<!DOCTYPE html>
<html>
    <head>
        <title>Payless Project &raquo; Contents</title>
        <link sizes="16x16" type="image/png" href="img/favicon.png" rel="icon">
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
                <div class="left"><div class="divide"></div></div>
                <div id="sort2" class="left nav3act"><a href="contents_view.php">Contents</a></div>
                <div class="left"><div class="divide"></div></div>
                <div id="sort1" class="left"><a href="newpost_view.php">Upload Post</a></div>
                <form action="" method="post" name="srch">
                    <div class="right searchbutton">
                        <input id="filtersearch" type="submit" name="search" value="Search"/>
                    </div>
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
                </form>
            </div>
        </div>
        <div id="overlay" onclick="closeAll()"></div>
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
                <div class="close"><a class="closelogin" onclick="closePopUp()"></a></div>
                <div class="do-login"><input type="submit" class="loginbutton login" id="loginButton" alt="Log In" value="Log In"></div>
                <!--span><a class="loginbutton login" id="loginButton" alt="Log In"></a></span-->
            </div>
        </div>
        <script type="text/javascript" src="js/divPop.js"></script>
        <!-- ::::::::::::::::::::: END OF HEADER PART ::::::::::::::::::::: -->
        <div class="pagebar">
            <div class="notification">
                MOST POPULAR CONTENTS
            </div>
        </div>

        <div class="detbox" style="padding-left:51px;">
            <div class="top-post" id="commented-1">
                <div class="top-image">
                    <div class="contenttitle"><a href="image_view.php">Sunny Beach</a></div>
                    <div class="view">
                        <div class="view-image">
                            <img src="img/pemandangan.jpg" width="260" alt="Suuny Beach">
                        </div>
                    </div>
                    <div class="basic-features">
                        <div class="paketjempol">
                            <div class="likemini"></div>
                            <div class="jumlahlike"></div>
                            <div class="commentmini"></div>
                            <div class="jumlahkomen"></div>
                            <br/>
                            <div class="likebutton" onclick="voteplus(this.num)"><a></a></div>
                            <div class="dislikebutton" onclick="votemin(this.num)"><a></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="top-post" id="commented-2">
                <div class="top-link">
                    <div class="contenttitle"><a href="link_view.php">Encrypted Google</a></div>
                    <div class="view">
                        <div class="view-link-url"><a href="https://encrypted.google.com">https://encrypted.google.com</a></div>
                        <div class="view-link-desc">Google SSL Searchm with encrypted data search. Remember though the data you're searching for is encrypted, ISP still can trace what URL you're browsing in.</div>
                    </div>
                    <div class="basic-features">
                        <div class="paketjempol">
                            <div class="likemini"></div>
                            <div class="jumlahlike"></div>
                            <div class="commentmini"></div>
                            <div class="jumlahkomen"></div>
                            <br/>
                            <div class="likebutton" onclick="voteplus(this.num)"><a></a></div>
                            <div class="dislikebutton" onclick="votemin(this.num)"><a></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="top-post" id="commented-3">
                <div class="top-video">
                    <div class="contenttitle"><a href="link_view.php">Skyrim Easter Eggs</a></div>
                    <div class="view">
                        <div class="view-video">
                            <div class="view"><iframe width="240" height="180" src="http://www.youtube.com/embed/I28EkJ32nwQ" ></iframe></div>
                        </div>
                    </div>
                    <div class="basic-features">
                        <div class="paketjempol">
                            <div class="likemini"></div>
                            <div class="jumlahlike"></div>
                            <div class="commentmini"></div>
                            <div class="jumlahkomen"></div>
                            <br/>
                            <div class="likebutton" onclick="voteplus(this.num)"><a></a></div>
                            <div class="dislikebutton" onclick="votemin(this.num)"><a></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pagebar" style="margin-top: 20px;">
            <div class="notification">
                MOST COMMENTED CONTENTS
            </div>
        </div>

        <div class="detbox" style="padding-left:51px;">
            <div class="top-post" id="popular-1">
                <div class="top-image">
                    <div class="contenttitle"><a href="image_view.php">Sunny Beach</a></div>
                    <div class="view">
                        <div class="view-image">
                            <img src="img/pemandangan.jpg" width="260" alt="Suuny Beach">
                        </div>
                    </div>
                    <div class="basic-features">
                        <div class="paketjempol">
                            <div class="likemini"></div>
                            <div class="jumlahlike"></div>
                            <div class="commentmini"></div>
                            <div class="jumlahkomen"></div>
                            <br/>
                            <div class="likebutton" onclick="voteplus(this.num)"><a></a></div>
                            <div class="dislikebutton" onclick="votemin(this.num)"><a></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="top-post" id="popular-2">
                <div class="top-link">
                    <div class="contenttitle"><a href="link_view.php">Encrypted Google</a></div>
                    <div class="view">
                        <div class="view-link-url"><a href="https://encrypted.google.com">https://encrypted.google.com</a></div>
                        <div class="view-link-desc">Google SSL Searchm with encrypted data search. Remember though the data you're searching for is encrypted, ISP still can trace what URL you're browsing in.</div>
                    </div>
                    <div class="basic-features">
                        <div class="paketjempol">
                            <div class="likemini"></div>
                            <div class="jumlahlike"></div>
                            <div class="commentmini"></div>
                            <div class="jumlahkomen"></div>
                            <br/>
                            <div class="likebutton" onclick="voteplus(this.num)"><a></a></div>
                            <div class="dislikebutton" onclick="votemin(this.num)"><a></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="top-post" id="popular-3">
                <div class="top-video">
                    <div class="contenttitle"><a href="link_view.php">Skyrim Easter Eggs</a></div>
                    <div class="view">
                        <div class="view-video">
                            <div class="view"><iframe width="240" height="180" src="http://www.youtube.com/embed/I28EkJ32nwQ" ></iframe></div>
                        </div>
                    </div>
                    <div class="basic-features">
                        <div class="paketjempol">
                            <div class="likemini"></div>
                            <div class="jumlahlike"></div>
                            <div class="commentmini"></div>
                            <div class="jumlahkomen"></div>
                            <br/>
                            <div class="likebutton" onclick="voteplus(this.num)"><a></a></div>
                            <div class="dislikebutton" onclick="votemin(this.num)"><a></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ::::::::::::::::::::: START OF FOOTER PART ::::::::::::::::::::: -->
        <div class="footer">
            &copy; Payless Project 2012. Created by: <a href="http://masphei.ungu.com">Masphei</a>, <a href="http://personanonymous.wordpress.com">Edgar Drake</a>, <a href="http://marchygabe.tumblr.com">Marchy Gabe</a>
        </div>
        <!-- ::::::::::::::::::::: END OF FOOTER PART ::::::::::::::::::::: -->
        <script type="text/javascript" src="js/styleBox.js"></script>
    </body>
</html>