<!DOCTYPE html >
<html>
    <head>
        <title>Payless Project &raquo; Versi Link</title>
        <link sizes="16x16" type="image/png" href="img/favicon.png" rel="icon">
        <script type="text/javascript" src="js/style.js"></script>
        <link rel="stylesheet" type="text/css" href="css/header1.css" id="header">
    </head>
    <body onload="randomlike(); inisialisasi();">
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

        <div class="detbox">
            <div class="dettop"></div>
            <div class="detmain">
                <div class="contentlist">
                    <div class="paketkonten linkpost">
                        <div class="left iconcontent">
                            <div class="iconlink"></div>
                        </div>
                        <div class="headertext judul">
                            <div class="title"><a href="link.html">9GAG - Just For Fun</a></div>
                            <div class="uploader"><a href="user-profile_view.php">EdgarDrake</a></div>
                            <div class="uploaded">2 days ago</div>
                        </div>
                        <div class="content">
                            <a href="http://www.9gag.com"> www.9gag.com </a>
                            <p> deskripsinya link ini </p>
                        </div>
                        <div class="paketjempol">
                            <div class="likemini"></div>
                            <div class="jumlahlike"></div>
                            <div class="commentmini"></div>
                            <div class="jumlahkomen"></div>
                            <br/>
                            <div class="likebutton" onclick="voteplus(this.num)"><a></a></div>
                            <div class="dislikebutton" onclick="votemin(this.num)"><a></a></div>
                            <div class="tags">
                                Tags : <br/>
                                <ul class="tag">
                                    <li>9gag</li>
                                    <li>funny</li>
                                    <li>rage comics</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="commentlist">
                        <div class="commenttop"></div>
                        <div class="commentcontainer">
                            <div id="superbaru">

                            </div>
                            <div class="comment">
                                <div class="avatar">
                                    <img src="img/avatar.png" alt="avatar" width="64" />
                                </div>
                                <div class="isikomen">
                                    <div class="del-comment right"><a></a></div>
                                    <div class="namecomment">username</div>
                                    <div class="timecomment">Mon, 07 Mar 2012 18:06:56 GMT</div>
                                    comment nomor satu tentu saja ini
                                </div>
                            </div>
                            <div class="comment">
                                <div class="avatar">
                                    <img src="img/avatar.png" alt="avatar" width="64" />
                                </div>
                                <div class="isikomen">
                                    <div class="namecomment">username</div>
                                    <div class="timecomment">Mon, 07 Mar 2012 16:06:56 GMT</div>
								comment nomor dua tentu saja ini
                                </div>
                            </div>
                            <div class="comment">
                                <div class="avatar">
                                    <img src="img/avatar.png" alt="avatar" width="64" />
                                </div>
                                <div class="isikomen">
                                    <div class="del-comment right"><a></a></div>
                                    <div class="namecomment">username</div>
                                    <div class="timecomment">Mon, 07 Mar 2012 10:00:12 GMT</div>
                                    <div>comment nomor tiga tentu saja ini</div>
                                </div>
                            </div>
                            <div class="comment" style="border-bottom:0px">
                                <div class="avatar">
                                    <img src="img/avatar.png" alt="avatar" width="64" />
                                </div>
                                <div class="isikomen">
                                    <form action="" method="post">
                                        <div class="your-comment"><textarea rows="2" cols="72" id="ucomment"></textarea></div>
                                        <div class="submit-your-comment"><input type="submit" value="Comment" onclick="comment()"/></div>
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
            </div>
            <div class="detbot"></div>
        </div>
        <!-- ::::::::::::::::::::: START OF FOOTER PART ::::::::::::::::::::: -->
        <div class="footer">
            &copy; Payless Project 2012. Created by: <a href="http://masphei.ungu.com">Masphei</a>, <a href="http://personanonymous.wordpress.com">Edgar Drake</a>, <a href="http://marchygabe.tumblr.com">Marchy Gabe</a>
        </div>
        <!-- ::::::::::::::::::::: END OF FOOTER PART ::::::::::::::::::::: -->
        <script type="text/javascript" src="js/navigasi.js"></script>
        <script type="text/javascript" src="js/styleBox.js"></script>
    </body>
</html>