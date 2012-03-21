<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="utf-8" />
        <title>Payless Project &raquo; My Profile</title>
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
                    <div class="edituser left clearfix">EDIT</div>
                    <div class="lhs left">E-MAIL</div>
                    <div class="rhs left clearfix">edgar.drake@gmail.com</div>
                    <div class="lhs left">GENDER</div>
                    <div class="rhs left clearfix">Gentleman</div>
                    <div class="lhs left">STATUS</div>
                    <div class="rhs left clearfix">In A Relationship</div>
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
                    <div class="rhs left clearfix">
                        <ul>
                            <li><a href="edgardrake/p1.php">Imagine this..</a></li>
                            <li><a href="edgardrake/p2.php">Unbeliavable Food</a></li>
                            <li><a href="edgardrake/p3.php">Outside!</a></li>
                            <li><a href="edgardrake/p4.php">This is Sucks</a></li>
                            <li><a href="edgardrake/p5.php">Featurephone vs Smartphone</a></li>
                            <li><a href="edgardrake/p6.php">Intangible Media</a></li>
                            <li><a href="edgardrake/p7.php">Angry Birds....?</a></li>
                            <li><a href="edgardrake/p8.php">Attack of (Apache) TomCat</a></li>
                            <li><a href="edgardrake/p9.php">Jedi</a></li>
                            <li><a href="edgardrake/p10.php">Macrohard Dominance</a></li>
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
                                <div class="ach_logo"></div>
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