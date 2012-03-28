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
                <div class="right mini-avatar">
                    <img src="img/avatar.jpg" width="36" height="36" alt="avatar">
                </div>
                <div class="right themes">
                    Hello Edgar Drake
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
        <script type="text/javascript" src="js/search.js"></script>
        <!-- ::::::::::::::::::::: END OF HEADER PART ::::::::::::::::::::: -->
        <div class="pagebar">
            <div class="notification">
                Showing results for: <b id="filtermethod">funny</b>
            </div>
        </div>

        <div class="detbox">
            <div class="dettop"></div>
            <!-- ::::: USE THIS ONE IF YOUR SEARCH RESULT RETURN NONE ::::: -->
            <div class="detmain hidden" id="result-none" style="text-align: center">
                <div class="headertext" style="text-align: center;">Sorry, we can't find  what you are looking for</div>
                <div class="error404">
                    Unfortunately, we can't find what you are looking for. Maybe you can try another words.
                </div>
            </div>
            <!-- ::::: ELSE USE THIS ONE WHEN THERE ARE SOME RESULTS ::::: -->
            <div class="detmain" id="result-some">
                <div class="contentlist">
                    <ul class="listcontents">
                        <li>
                            <div class="search-user-box">
                                <div class="search-user-avatar">
                                    <a href=""><img src="img/avatar.jpg" alt="EdgarDrake"></a>
                                </div>
                                <div class="search-user-detail">
                                    <div class="search-user-username"><a href="">EdgarDrake</a></div>
                                    <div class="search-user-fullname">Rido Ramadan</div>
                                    <div class="search-user-email">edgar@drake.com</div>
                                    <div class="search-user-about">
                                        <blockquote>"I'm just a normal game developer ever"</blockquote>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
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
                        </li>
                        <li>
                            <div class="paketkonten imagepost">
                                <div class=" left iconcontent">
                                    <div class="iconphoto"></div>
                                </div>
                                <div class="headertext judul">
                                    <div class="title"><a href="link.html">Sunny Beach</a></div>
                                    <div class="uploader"><a href="user-profile_view.php">EdgarDrake</a></div>
                                    <div class="uploaded">3 days ago</div>
                                </div>
                                <div class="content">
                                    <img src="img/pemandangan.jpg" width="320" alt="beach">
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
                        </li>
                        <li>
                            <div class="paketkonten videopost">
                                <div class=" left iconcontent">
                                    <div class="iconvideo"></div>
                                </div>
                                <div class="headertext judul">
                                    <div class="title"><a href="link.html">Video Clip</a></div>
                                    <div class="uploader"><a href="user-profile_view.php">EdgarDrake</a></div>
                                    <div class="uploaded">3 days ago</div>
                                </div>
                                <div class="content">
                                    <iframe width="320" height="240" src="http://www.youtube.com/embed/MGtLGuSaVOI" frameborder="0" allowfullscreen></iframe>
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
                        </li>
                    </ul>
                </div>
                <div class="filtermethod">
                    <div class="inputtag">
                        <div class="headertext" style="margin: 10px 0 0 15px;">Filter by Tags</div>
                        <form name="filtertag" action="" method="post">
                            <div class="tagbar">
                                <span class="sbox_l"></span>
                                <span class="sbox">
                                    <input style="outline-width:0px;" type="text" name="inputtag" placeholder="input tags" >
                                </span>
                                <span class="sbox_r" id="srch_clear"></span>
                            </div>
                            <div class="tagsubmit">
                                <input type="submit" name="submittag" value="Submit">
                            </div>
                        </form>
                    </div>
                    <div class="tagclouds">
                        <div class="headertext" style="margin: 0 0 0 10px;">Choose a Tag</div>
                        <div class="tagcloudscontent">
                            9gag Funny Star Wars Pokemon Tugas Besar Artificial Intelligence Angry Birds
                        </div>
                    </div>
                    <div class="sorting">
                        <div class="headertext" style="margin: 0 0 0 10px;">Sort</div>
                        Sort by:
                        <div class="sortingmethod">
                            <select name="sortmethod" onchange="">
                                <option value="newest">Newest First</option>
                                <option value="popularity">Most Popular First</option>
                                <option value="mostcommented">Most Commented First</option>
                            </select>
                        </div>
                    </div>
                    <div class="ads">
                        <div class="headertext" style="margin: 0 0 0 10px;">Advertisements</div>
                    </div>
                </div>

                <div class="paketgantihalaman">
                    <div class="buttonprevious" onclick="window.location.href='contents.html'">PREVIOUS</div>
                    <div class="buttonnext" onclick="window.location.href='contents.html'">NEXT</div>
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