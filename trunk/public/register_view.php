<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="utf-8" />
        <title>Payless Project &raquo; Register</title>
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
                    <div class="right">
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
            <div class="detmain" style="text-align: center">
                <div class="headertext">Register in GetRid!</div>
                <span style="color: red; font-size: 1em;">

                </span>
                <form id="registerForm" method="POST" action="contents.html">
                    <div class="left sidesbox">
                        <div class="txtfieldbox" style="border-top: 0; padding-top: 0">
                            <div class="left txtboxlabel">USERNAME</div>
                            <div class="right">
                                <input class="txtfield" type="text" size="30" name="username" value="" onkeydown="ProcessUsername(this)" onkeyup="ProcessUsername(this)" />
                            </div>
                            <div class="clear"></div>
                            <div class="error" id="usernameError">Username must be at least 5 character.</div>
                        </div>
                        <div class="txtfieldbox">
                            <div class="left txtboxlabel">FULL NAME</div>
                            <div class="right">
                                <input class="txtfield" type="text" size="30" name="name" onkeydown="ProcessName(this)" onkeyup="ProcessName(this)" />
                            </div>
                            <div class="clear"></div>
                            <div class="error" id="nameError">Please include your last name.</div>
                        </div>
                        <div class="txtfieldbox">
                            <div class="left txtboxlabel">PASSWORD</div>
                            <div class="right">
                                <input class="txtfield" type="password" size="30" name="password" onkeydown="ProcessPassword(this)" onkeyup="ProcessPassword(this)" />
                            </div>
                            <div class="clear"></div>
                            <div class="error" id="passwordError">Password must be at least 8 character.</div>
                        </div>
                        <div class="txtfieldbox">
                            <div class="left txtboxlabel">CONFIRM PASSWORD</div>
                            <div class="right">
                                <input class="txtfield" type="password" size="30" name="confirm" onkeydown="ProcessCPassword(this)" onkeyup="ProcessCPassword(this)" />
                            </div>
                            <div class="clear"></div>
                            <div class="error" id="cpasswordError">The password is not match.</div>
                        </div>
                    </div>

                    <div class="right sidesbox" style="text-align: left">
                        <div class="txtfieldbox" style="border-top: 0; padding-top: 0">
                            <div class="left txtboxlabel">EMAIL</div>
                            <div class="right">
                                <input class="txtfield" type="text" size="30" name="email" onkeydown="ProcessEmail(this)" onkeyup="ProcessEmail(this)" />
                            </div>
                            <div class="clear"></div>
                            <div class="error" id="emailError">Wrong email format.</div>
                        </div>
                        <div class="txtfieldbox">
                            <div class="left txtboxlabel">BIRTH DATE</div>
                            <div class="right">
                                <input class="txtfield" type="text" size="30" name="birthdate" onkeydown="ProcessBirthdate(this)" onkeyup="ProcessBirthdate(this)" />
                            </div>
                            <div class="clear"></div>
                            <div class="error" id="birthError">Birth date must be written in YYYY-MM-DD.</div>
                        </div>
                        <div class="txtfieldbox">
                            <div class="left txtboxlabel">GENDER</div>
                            <div class="right">
                                <select class="txtfield" name="gender" onchange="ProcessGender(this)" style="width: 215px"><option value="none">- -Select- -</option><option value="male">Male</option><option value="female">Female</option></select>
                            </div>
                            <div class="clear"></div>
                            <div class="error" id="genderError">You must select a gender.</div>
                        </div>
                        <div class="txtfieldbox">
                            <div class="left txtboxlabel">AVATAR UPLOAD</div>
                            <div class="right">
                                <input class="txtfield" type="file" name="avatar" onchange="ProcessAvatar(this)" accept="image/jpg, image/jpeg"/>
                            </div>
                            <div class="clear"></div>
                            <div class="error" id="avatarError">Please upload jpeg image.</div>
                        </div>
                    </div>

                    <div class="clear" style="overflow: auto; padding-top: 15px; text-align: center">
                        <div class="txtboxlabel" style="text-align: center;">ABOUT ME</div>
                        <div><textarea rows="5" cols="106" name="about"></textarea></div>
                        <div class="termsagreements">We Get Rid of the Terms and Agreements in GetRid!</div>
                        <input class="joinbutton" type="submit" name="signup" value="Create my Account!" />
                        <!--<ul class="reasonlist">
                            <li>As a registered user, you can upload your own posts!</li>
                        </ul>-->
                    </div>
                </form>
            </div>
            <div class="detbot"></div>
        </div>
        <div style="height: 10px;"></div>
        <script type="text/javascript" src="js/register.js"></script>
        <script type="text/javascript" src="js/styleBox.js"></script>
    </body>
</html>