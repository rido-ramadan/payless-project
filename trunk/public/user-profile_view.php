<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Payless Project &raquo; My Profile</title>
        <link sizes="16x16" type="image/png" href="img/favicon.png" rel="icon">
        <script type="text/javascript" src="js/style.js"></script>
        <link rel="stylesheet" type="text/css" href="css/header1.css" id="header">
    </head>
    <body>
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
        <!-- ::::::::::::::::::::: START OF BODY PART ::::::::::::::::::::: -->
        <div class="detbox">
            <div class="dettop"></div>
            <div class="detmain">
                <div class="userheader">EdgarDrake's Profile</div>
                <div class="useravatar">
                    <img src="img/avatar.jpg" alt="EdgarDrake">
                </div>
                <div class="userdata">
                    <div class="subtitle left ">USER INFORMATION</div>
                    <div class="edituser left clearfix" onclick="editProfile()">EDIT</div>
                    <div class="lhs left">FULL NAME</div>
                    <div class="rhs left clearfix">Edgar Drake</div>
                    <div class="lhs left">E-MAIL</div>
                    <div class="rhs left clearfix">edgar.drake@gmail.com</div>
                    <div class="lhs left">GENDER</div>
                    <div class="rhs left clearfix">Male</div>
                    <div class="lhs left">STATUS</div>
                    <div class="rhs left clearfix">In a Relationship</div>
                    <div class="lhs left">BIRTHDATE</div>
                    <div class="rhs left clearfix">20-03-1991</div>
                    <div class="lhs left">ABOUT ME</div>
                    <div class="rhs left clearfix">
                        I am just me, it's nothing unusual for a programmer like me to have some account on a payless project like this. Afterall, it is I who the one who made this. OK, that's it.
                    </div>
                    <div class="lhs left"># COMMENTS</div>
                    <div class="rhs left clearfix">50</div>
                    <div class="lhs left"># UPLOADS</div>
                    <div class="rhs left clearfix">10</div>
                    <div class="lhs left">POST LIST</div>
                    <div class="clear">
                        <ul>
                            <li>
                                <div class="top-post"">
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
                            </li>
                            <li>
                                <div class="top-post">
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
                            </li>
                            <li>
                                <div class="top-post">
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
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="userachievement">
                    <div class="subtitle left ">ACHIEVEMENTS</div>
                    <div class="clearfix"></div>
                    <!-- ACHIEVEMENT LIST -->
                    <ul>
                        <li>
                            <div class="achievement">
                                <div class="ach_logo"><img src="img/i've moved on.png" alt=""></div>
                                <div class="ach_detail">
                                    <div class="ach_name">I've Moved On</div>
                                    <div class="ach_how">You're not alone anymore</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="achievement">
                                <div class="ach_logo"></div>
                                <div class="ach_detail">
                                    <div class="ach_name">Hello, World</div>
                                    <div class="ach_how">Upload a post once</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="achievement">
                                <div class="ach_logo"></div>
                                <div class="ach_detail">
                                    <div class="ach_name">Quality or Quantity</div>
                                    <div class="ach_how">Upload a post ten times</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="achievement">
                                <div class="ach_logo"></div>
                                <div class="ach_detail">
                                    <div class="ach_name">Spik!</div>
                                    <div class="ach_how">Comment on a post once</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="achievement">
                                <div class="ach_logo"></div>
                                <div class="ach_detail">
                                    <div class="ach_name">Il Commentatore</div>
                                    <div class="ach_how">Comment on posts 20 times</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="achievement">
                                <div class="ach_logo"></div>
                                <div class="ach_detail">
                                    <div class="ach_name">Achievements Hunters</div>
                                    <div class="ach_how">Not enough with 3 achievements? We reward one more</div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="detbot"></div>
        </div>
        <div style="height: 10px;"></div>

        <!-- EDIT DIV POP OUT -->
        <div class="edituserdata" id="edituserdata">
            <div class="edittop"></div>
            <div class="editmain">
                <div class="subtitle" style="margin: 0 20px;">EDIT PROFILE DATA</div>
                <div class="txtfieldbox width90" style="border-top: 0; padding-top: 10px;">
                    <div class="left txtboxlabel">EMAIL</div>
                    <div class="right">
                        <input class="txtfield" type="text" size="30" name="email" onkeydown="ProcessEmail(this)" onkeyup="ProcessEmail(this)" />
                    </div>
                    <div class="clear"></div>
                    <div class="error" id="emailError">Wrong email format.</div>
                </div>
                <div class="txtfieldbox width90">
                    <div class="left txtboxlabel">OLD PASSWORD</div>
                    <div class="right">
                        <input class="txtfield" type="password" size="30" name="password" onkeydown="ProcessPassword(this)" onkeyup="ProcessPassword(this)" />
                    </div>
                    <div class="clear"></div>
                    <div class="error" id="passwordError">Password must be at least 8 character.</div>
                </div>
                <div class="txtfieldbox width90">
                    <div class="left txtboxlabel">NEW PASSWORD</div>
                    <div class="right">
                        <input class="txtfield" type="password" size="30" name="newpass" onkeydown="ProcessPassword(this)" onkeyup="ProcessPassword(this)" />
                    </div>
                    <div class="clear"></div>
                    <div class="error" id="passwordError">Password must be at least 8 character.</div>
                </div>
                <div class="txtfieldbox width90">
                    <div class="left txtboxlabel">CONFIRM PASSWORD</div>
                    <div class="right">
                        <input class="txtfield" type="password" size="30" name="confirm" onkeydown="ProcessCPassword(this)" onkeyup="ProcessCPassword(this)" />
                    </div>
                    <div class="clear"></div>
                    <div class="error" id="cpasswordError">The password is not match.</div>
                </div>
                <div class="txtfieldbox width90">
                    <div class="left txtboxlabel">GENDER</div>
                    <div class="right">
                        <select class="txtfield" name="gender" onchange="ProcessGender(this)" style="width: 215px"><option value="none">--Select--</option><option value="male">Male</option><option value="female">Female</option></select>
                    </div>
                    <div class="clear"></div>
                    <div class="error" id="genderError">You must select a gender.</div>
                </div>
                <div class="txtfieldbox width90">
                    <div class="left txtboxlabel">STATUS</div>
                    <div class="right">
                        <select class="txtfield" name="status" onchange="ProcessGender(this)" style="width: 215px"><option value="none">--Select--</option><option value="single">Forever Alone</option><option value="relation">In a Relationship</option></select>
                    </div>
                    <div class="clear"></div>
                    <div class="error" id="genderError">Please choose your status</div>
                </div>
                <div class="txtfieldbox width90">
                    <div class="left txtboxlabel">AVATAR UPLOAD</div>
                    <div class="right">
                        <input class="txtfield" type="file" name="avatar" onchange="ProcessAvatar(this)" accept="image/jpg, image/jpeg"/>
                    </div>
                    <div class="clear"></div>
                    <div class="error" id="avatarError">Please upload jpeg image.</div>
                </div>
                <div class="txtfieldbox width90">
                    <div class="left txtboxlabel">ABOUT ME</div>
                    <div class="right">
                        <textarea rows="5" cols="24" name="about"></textarea>
                    </div>
                    <div class="clear"></div>
                    <div class="error" id="avatarError">Please upload jpeg image.</div>
                </div>
                <div class="txtfieldbox width90">
                    <div class="right">
                        <input class="joinbutton" type="submit" name="edit" value="Edit my Account!" />
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="editbot"></div>
        </div>
        <!---------------------->

        <!-- ::::::::::::::::::::: END OF BODY PART ::::::::::::::::::::: -->
        <!-- ::::::::::::::::::::: START OF FOOTER PART ::::::::::::::::::::: -->
        <div class="footer">
            &copy; Payless Project 2012. Created by: <a href="http://masphei.ungu.com">Masphei</a>, <a href="http://personanonymous.wordpress.com">Edgar Drake</a>, <a href="http://marchygabe.tumblr.com">Marchy Gabe</a>
        </div>
        <!-- ::::::::::::::::::::: END OF FOOTER PART ::::::::::::::::::::: -->
        <script type="text/javascript" src="js/register.js"></script>
        <script type="text/javascript" src="js/styleBox.js"></script>
    </body>
</html>